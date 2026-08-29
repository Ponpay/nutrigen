import sys, json, time
sys.path.insert(0, r"C:\Users\bintang\Documents\Hackathon\nutrigen\.hermes-qa")
from qa_driver import new_tab, nav, ev, sync_status, fill, submit_form, js_errors, body_snippet, click, BASE

tab = new_tab("about:blank")
issues = []
def note(sev, area, title, detail):
    issues.append({"severity": sev, "area": area, "title": title, "detail": detail})
    print(f"[{sev}] {area} :: {title}\n       {detail}", flush=True)

def login(email, pw):
    tab.send("Network.clearBrowserCookies")
    nav(tab, "/login")
    fill(tab, "input[name=email]", email); fill(tab, "input[name=password]", pw)
    submit_form(tab); time.sleep(2.0)

def click_nav_link(start_path, needle, expect_contains):
    nav(tab, start_path)
    before = ev(tab, "location.pathname")
    clicked = ev(tab, "(() => { const a=[...document.querySelectorAll('a[href]')].find(x=>{const h=x.getAttribute('href')||''; return h.indexOf(%s)!==-1;}); if(a){a.click(); return a.getAttribute('href');} return null; })()" % json.dumps(needle))
    time.sleep(2.2)
    after = ev(tab, "location.pathname")
    title = ev(tab, "document.title")
    errs = js_errors(tab)
    ok = clicked is not None and expect_contains in (after or "")
    print(f"  {before} -> klik '{needle}' ({clicked}) -> {after} | title={title!r} ok={ok} errs={len(errs)}")
    if not ok:
        note("MEDIUM", "Navigasi", f"Klik link '{needle}' dari {before} tidak bernavigasi seperti diharapkan",
             f"href={clicked} after={after} errs={errs}")
    if errs:
        note("MEDIUM", "Navigasi", f"JS error saat klik '{needle}'", "; ".join(errs))

print("### KADER nav clicks ###")
login("kader@nutrigen.com","password")
click_nav_link("/kader/dashboard", "/kader/balita", "/kader/balita")
click_nav_link("/kader/dashboard", "/kader/jadwal", "/kader/jadwal")
click_nav_link("/kader/dashboard", "/kader/laporan", "/kader/laporan")
click_nav_link("/kader/dashboard", "/kader/profil", "/kader/profil")

print("### PUSKESMAS nav clicks ###")
login("puskesmas@nutrigen.com","password")
click_nav_link("/puskesmas/dashboard", "/puskesmas/balita", "/puskesmas/balita")
click_nav_link("/puskesmas/dashboard", "/puskesmas/validasi", "/puskesmas/validasi")
click_nav_link("/puskesmas/dashboard", "/puskesmas/laporan", "/puskesmas/laporan")
click_nav_link("/puskesmas/dashboard", "/puskesmas/posyandu", "/puskesmas/posyandu")
click_nav_link("/puskesmas/dashboard", "/puskesmas/pengaturan", "/puskesmas/pengaturan")

print("### PORTAL child-selector -> pilih anak ###")
nav(tab, "/dev/portal-ibu/1/pilih-anak")
kids = ev(tab, "Array.from(document.querySelectorAll('a[href]')).map(a=>a.getAttribute('href')).filter(h=>h&&h.indexOf('portal-ibu')!==-1)")
print("  child-selector links=", len(kids or []))
if kids:
    first = kids[0]
    st = sync_status(tab, first)
    print(f"  klik anak -> status {st} (href={first[:80]})")
    if st not in (200,302):
        note("HIGH", "Portal Ibu", "Pilih anak menghasilkan status non-200", f"href={first} status={st}")

print("\nISSUES COUNT:", len(issues))
with open(r"C:\Users\bintang\Documents\Hackathon\nutrigen\.hermes-qa\nav.json","w",encoding="utf-8") as f:
    json.dump(issues, f, ensure_ascii=False, indent=2)
print("saved nav.json")
