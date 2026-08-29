import sys, json, time
sys.path.insert(0, r"C:\Users\bintang\Documents\Hackathon\nutrigen\.hermes-qa")
from qa_driver import new_tab, nav, ev, sync_status, fill, submit_form, js_errors, body_snippet, click, BASE

tab = new_tab("about:blank")
issues = []

def note(sev, area, title, detail):
    issues.append({"severity": sev, "area": area, "title": title, "detail": detail})
    print(f"[{sev}] {area} :: {title}\n       {detail}", flush=True)

# ============ A. PORTAL IBU: internal nav links (signed URL) ============
print("### A. PORTAL IBU internal links ###")
for page in ["home","growth","nutrition","posyandu"]:
    nav(tab, f"/dev/portal-ibu/1/{page}")
    links = ev(tab, "Array.from(document.querySelectorAll('a[href]')).map(a=>a.getAttribute('href')).filter(h=>h && h.indexOf('portal-ibu')!==-1)")
    links = list(set(links or []))
    bad = []
    ok = 0
    for h in links:
        st = sync_status(tab, h)   # absolut signed URL
        if st == 200:
            ok += 1
        else:
            bad.append((h, st))
    print(f"  page={page}: links={len(links)} ok=200:{ok} bad={bad}")
    for h, st in bad:
        note("HIGH", "Portal Ibu", f"Link internal {page} menghasilkan {st}",
             f"href={h} status={st} (signed URL invalid/TINGGI-01)")
    if not bad:
        print(f"  -> {page}: semua link internal OK ({ok})")

# ============ B. EMPTY FORM SUBMIT (validasi form) ============
print("\n### B. EMPTY FORM SUBMIT ###")
def try_empty(area, login_href, form_path, expect_redirect_back=True):
    tab.send("Network.clearBrowserCookies")
    nav(tab, "/login")
    if login_href:
        fill(tab, "input[name=email]", login_href["email"])
        fill(tab, "input[name=password]", login_href["password"])
        submit_form(tab)
        time.sleep(2.0)
    nav(tab, form_path)
    before_path = ev(tab, "location.pathname")
    submit_form(tab)
    time.sleep(2.2)
    after_path = ev(tab, "location.pathname")
    title = ev(tab, "document.title")
    errs = js_errors(tab)
    sn = body_snippet(tab, 200)
    print(f"  {area}: before={before_path} after={after_path} title={title!r} errs={len(errs)}")
    # Harusnya balik ke form (validation errors) BUKAN 500; tidak boleh ada JS error.
    if errs:
        note("MEDIUM", area, "JS error saat submit kosong", "; ".join(errs))
    if title and "500" in str(title):
        note("HIGH", area, f"Submit kosong menyebabkan 500 di {form_path}", f"title={title!r} body={sn}")

KADER = {"email":"kader@nutrigen.com","password":"password"}
PUSKS = {"email":"puskesmas@nutrigen.com","password":"password"}

try_empty("Kader balita.create", KADER, "/kader/balita/baru")
try_empty("Kader balita.edit", KADER, "/kader/balita/1/edit")
try_empty("Kader jadwal.create", KADER, "/kader/jadwal/baru")
try_empty("Kader pengukuran (perlu pilih balita)", KADER, "/kader/pengukuran")
try_empty("Puskesmas pengaturan", PUSKS, "/puskesmas/pengaturan")

# ============ C. LOGIN salah password (validasi auth) ============
print("\n### C. LOGIN salah password ###")
tab.send("Network.clearBrowserCookies")
nav(tab, "/login")
fill(tab, "input[name=email]", "puskesmas@nutrigen.com")
fill(tab, "input[name=password]", "salahpassword")
submit_form(tab)
time.sleep(2.0)
pathC = ev(tab, "location.pathname")
snC = body_snippet(tab, 220)
print(f"  after wrong-login path={pathC} snippet={snC!r}")
if pathC != "/login":
    note("MEDIUM", "Login", "Login salah password tidak kembali ke /login", f"path={pathC}")
else:
    print("  -> benar: tetap di /login")

# ============ D. APPROVE (klik tombol) di validasi.review ============
print("\n### D. APPROVE di validasi.review ###")
tab.send("Network.clearBrowserCookies")
nav(tab, "/login")
fill(tab, "input[name=email]", PUSKS["email"]); fill(tab, "input[name=password]", PUSKS["password"]); submit_form(tab); time.sleep(2.0)
nav(tab, "/puskesmas/validasi/3/review")
errs = js_errors(tab); print("  review page errs=", errs)
# cari form approve
submitted = ev(tab, "(() => { const f=document.querySelector('form[action]'); if(!f) return null;"
                     " const a = f.getAttribute('action'); if(!a || !a.includes('/approve')) return null;"
                     " f.requestSubmit(); return a; })()")
if submitted:
    time.sleep(2.5)
    pathD = ev(tab, "location.pathname")
    bodyD = body_snippet(tab, 260)
    errsD = js_errors(tab)
    print(f"  approve form submitted action={submitted} path_after={pathD} errs={len(errsD)}")
    print(f"  body_after={bodyD!r}")
    if errsD:
        note("MEDIUM", "Puskesmas validasi", "JS error saat approve", "; ".join(errsD))
else:
    note("INFO", "Puskesmas validasi", "Tidak menemukan form approve di /puskesmas/validasi/3/review",
         "mungkin tombol via JS/x-on:click; perlu pengecekan manual")

print("\n\nISSUES COUNT:", len(issues))
with open(r"C:\Users\bintang\Documents\Hackathon\nutrigen\.hermes-qa\interactions.json","w",encoding="utf-8") as f:
    json.dump(issues, f, ensure_ascii=False, indent=2)
print("saved interactions.json")
