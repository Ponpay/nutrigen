import sys, json, time
sys.path.insert(0, r"C:\Users\bintang\Documents\Hackathon\nutrigen\.hermes-qa")
from qa_driver import sweep

PUBLIC = [
    {"name":"welcome", "path":"/"},
    {"name":"login", "path":"/login"},
    {"name":"team", "path":"/team"},
    {"name":"forgot-password", "path":"/forgot-password"},
    {"name":"register (harus 404)", "path":"/register"},
]

PUSKESMAS = [
    {"name":"dashboard", "path":"/puskesmas/dashboard"},
    {"name":"balita", "path":"/puskesmas/balita"},
    {"name":"balita.show", "path":"/puskesmas/balita/1"},
    {"name":"laporan", "path":"/puskesmas/laporan"},
    {"name":"validasi", "path":"/puskesmas/validasi"},
    {"name":"validasi.review", "path":"/puskesmas/validasi/3/review"},
    {"name":"validasi.riwayat", "path":"/puskesmas/validasi/3/riwayat"},
    {"name":"posyandu", "path":"/puskesmas/posyandu"},
    {"name":"pengaturan", "path":"/puskesmas/pengaturan"},
    {"name":"pengaturan.petugas", "path":"/puskesmas/pengaturan/petugas"},
    {"name":"pengaturan.keamanan", "path":"/puskesmas/pengaturan/keamanan"},
    {"name":"pengaturan.notifikasi", "path":"/puskesmas/pengaturan/notifikasi"},
]

KADER = [
    {"name":"dashboard", "path":"/kader/dashboard"},
    {"name":"balita.index", "path":"/kader/balita"},
    {"name":"balita.create", "path":"/kader/balita/baru"},
    {"name":"balita.show", "path":"/kader/balita/1"},
    {"name":"balita.edit", "path":"/kader/balita/1/edit"},
    {"name":"pengukuran.create", "path":"/kader/pengukuran"},
    {"name":"jadwal.index", "path":"/kader/jadwal"},
    {"name":"jadwal.create", "path":"/kader/jadwal/baru"},
    {"name":"jadwal.show", "path":"/kader/jadwal/1"},
    {"name":"laporan.index", "path":"/kader/laporan"},
    {"name":"kader.profil", "path":"/kader/profil"},
    {"name":"kader.profil.edit", "path":"/kader/profil/edit"},
]

PORTAL = [
    {"name":"portal.home", "path":"/dev/portal-ibu/1/home"},
    {"name":"portal.growth", "path":"/dev/portal-ibu/1/growth"},
    {"name":"portal.nutrition", "path":"/dev/portal-ibu/1/nutrition"},
    {"name":"portal.posyandu", "path":"/dev/portal-ibu/1/posyandu"},
    {"name":"portal.child-selector", "path":"/dev/portal-ibu/1/pilih-anak"},
]

all_res = {}
all_res["public"] = sweep("PUBLIC (tanpa login)", {}, PUBLIC)
all_res["puskesmas"] = sweep("PUSKESMAS", {"email":"puskesmas@nutrigen.com","password":"password"}, PUSKESMAS)
all_res["kader"] = sweep("KADER", {"email":"kader@nutrigen.com","password":"password"}, KADER)
all_res["portal"] = sweep("PORTAL IBU (dev bridge)", {}, PORTAL)

with open(r"C:\Users\bintang\Documents\Hackathon\nutrigen\.hermes-qa\raw.json","w",encoding="utf-8") as f:
    json.dump(all_res, f, ensure_ascii=False, indent=2)
print("\n\nRAW SAVED to .hermes-qa/raw.json")
