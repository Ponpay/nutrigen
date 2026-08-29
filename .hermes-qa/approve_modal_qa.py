import sys, json, time
sys.path.insert(0, r"C:\Users\bintang\Documents\Hackathon\nutrigen\.hermes-qa")
from qa_driver import new_tab, nav, ev, fill, submit_form, js_errors, body_snippet

tab = new_tab("about:blank")
# login puskesmas
tab.send("Network.clearBrowserCookies")
nav(tab, "/login")
fill(tab, "input[name=email]", "puskesmas@nutrigen.com"); fill(tab, "input[name=password]", "password")
submit_form(tab); time.sleep(2.0)

nav(tab, "/puskesmas/validasi/3/review")
# buka modal approve
ev(tab, "window.openApproveModal ? openApproveModal() : null")
time.sleep(1.2)
modal_visible = ev(tab, "(() => { const m=document.getElementById('approveModal'); return m && !m.classList.contains('hidden'); })()")
form_action = ev(tab, "(() => { const f=document.querySelector('#approveModal form, form[action]'); return f?f.getAttribute('action'):null; })()")
errs = js_errors(tab)
print("approveModal visible=", modal_visible, "form action=", form_action, "errs=", len(errs))
# tutup modal
ev(tab, "window.closeApproveModal ? closeApproveModal() : null")
print("modal closed ok; errors=", json.dumps(errs))
