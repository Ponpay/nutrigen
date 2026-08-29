import sys, json, time, urllib.request
sys.path.insert(0, r"C:\Users\bintang\AppData\Local\hermes\skills\software-development\laravel\scripts")
import websocket

DEBUG = "http://127.0.0.1:9222"
BASE = "http://127.0.0.1:8000"

class Tab:
    def __init__(self, ws_url):
        self.ws = websocket.create_connection(ws_url, timeout=30, suppress_origin=True)
        self.ws.settimeout(0.1)
        self.mid = 0
        self.events = []

    def _record(self, msg):
        method = msg.get("method", "")
        if method in ("Runtime.consoleAPICalled", "Runtime.exceptionThrown", "Log.entryAdded"):
            self.events.append(msg)

    def send(self, method, **params):
        self.mid += 1
        mid = self.mid
        self.ws.send(json.dumps({"id": mid, "method": method, "params": params}))
        end = time.time() + 25
        while time.time() < end:
            try:
                raw = self.ws.recv()
            except websocket.WebSocketTimeoutException:
                continue
            except Exception as e:
                raise RuntimeError(f"ws recv err: {e}")
            msg = json.loads(raw)
            if msg.get("id") == mid:
                if "error" in msg:
                    raise RuntimeError(f"{method}: {msg['error']}")
                return msg.get("result", {})
            self._record(msg)
        raise TimeoutError(f"{method} timeout")

    def raw(self, method, **params):
        # Fire-and-forget (enable domains). Response ignored, events recorded.
        self.mid += 1
        self.ws.send(json.dumps({"id": self.mid, "method": method, "params": params}))
        return self.mid

def new_tab(url):
    req = urllib.request.Request(f"{DEBUG}/json/new?{url}", method="PUT")
    with urllib.request.urlopen(req, timeout=15) as r:
        info = json.loads(r.read().decode())
    return Tab(info["webSocketDebuggerUrl"])

def ev(tab, expr):
    res = tab.send("Runtime.evaluate", expression=expr, returnByValue=True)
    exc = res.get("exceptionDetails")
    if exc:
        d = exc.get("exception", {}).get("description", str(exc))
        return {"error": d[:300]}
    return res.get("result", {}).get("value")

def sync_status(tab, path):
    js = "(() => { const xhr=new XMLHttpRequest(); xhr.open('GET', %s, false); try{xhr.send();}catch(e){return 'ERR:'+e.message;} return xhr.status; })()" % json.dumps(path)
    return ev(tab, js)

def nav(tab, path, settle=2.0):
    tab.raw("Runtime.enable")
    tab.raw("Log.enable")
    tab.events.clear()
    tab.send("Page.navigate", url=BASE + path)
    end = time.time() + 15
    while time.time() < end:
        if ev(tab, "document.readyState") == "complete":
            break
        time.sleep(0.3)
    time.sleep(settle)
    return ev(tab, "document.title")

def js_errors(tab):
    out = []
    for e in tab.events:
        m = e.get("method")
        if m == "Runtime.exceptionThrown":
            d = e.get("params", {}).get("exceptionDetails", {})
            out.append("EXC: " + (d.get("exception", {}).get("description") or d.get("text", "")))
        elif m == "Runtime.consoleAPICalled":
            t = e.get("params", {}).get("type")
            if t == "error":
                args = " ".join(str(a.get("value", "")) for a in e.get("params", {}).get("args", []))
                out.append("CONSOLE-ERROR: " + args[:250])
        elif m == "Log.entryAdded":
            lvl = e.get("params", {}).get("level")
            if lvl == "error":
                out.append("LOG-ERROR: " + str(e.get("params", {}).get("text", ""))[:250])
    return out

def fill(tab, selector, text):
    return ev(tab, "(() => { const el=document.querySelector(%s); if(!el) return false;"
                    " el.value=%s; el.dispatchEvent(new Event('input',{bubbles:true}));"
                    " el.dispatchEvent(new Event('change',{bubbles:true})); return true; })()"
                    % (json.dumps(selector), json.dumps(text)))

def click(tab, selector):
    return ev(tab, "(() => { const el=document.querySelector(%s); if(!el) return false; el.click(); return true; })()" % json.dumps(selector))

def submit_form(tab, selector="form"):
    return ev(tab, "(() => { const f=document.querySelector(%s); if(!f) return false;"
                   " (f.requestSubmit?f.requestSubmit():f.submit()); return true; })()" % json.dumps(selector))

def body_snippet(tab, n=260):
    t = ev(tab, "document.body ? document.body.innerText.slice(0,%d) : ''" % n)
    return (t or "").replace("\n", " ").strip()

def p(*a):
    print(*a, flush=True)

def sweep(label, login_href, routes):
    p("\n################ " + label + " ################")
    # Sesi bersih: buang cookie browser agar tidak "terbawa" login role sebelumnya,
    # dan selalu nav ke /login dulu supaya origin halaman terjaga (XHR bisa jalan).
    tab.send("Network.clearBrowserCookies")
    nav(tab, "/login")
    if login_href:
        fill(tab, "input[name=email]", login_href["email"])
        fill(tab, "input[name=password]", login_href["password"])
        submit_form(tab)
        time.sleep(2.0)
        p("after-login path=" + str(ev(tab, "location.pathname")) + " errs=" + json.dumps(js_errors(tab)))
    results = []
    for r in routes:
        st = sync_status(tab, r["path"])
        if st in (200, 302):
            title = nav(tab, r["path"])
            errs = js_errors(tab)
            sn = body_snippet(tab)
            results.append({"path": r["path"], "name": r.get("name", ""), "status": st,
                            "title": title, "errors": errs, "snippet": sn})
            p(f"[OK {st}] {r.get('name',''):24} {r['path']}  title={title!r} errs={len(errs)}")
            for e in errs:
                p("      " + e[:160])
        else:
            results.append({"path": r["path"], "name": r.get("name", ""), "status": st,
                            "title": None, "errors": [], "snippet": None})
            p(f"[## {st}] {r.get('name',''):24} {r['path']}   <-- NON-200")
    return results

tab = new_tab("about:blank")
