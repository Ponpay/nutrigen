<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DashboardService;
use App\Services\GrowthCalculationService;
use App\Services\RecommendationService;
use App\Services\StatisticsService;
use App\Models\Balita;
use App\Models\Pengukuran;
use App\Models\Posyandu;
use App\Models\OrangTua;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KaderController extends Controller
{
    public function __construct(
        protected DashboardService $dashboardService,
        protected GrowthCalculationService $growthService,
        protected RecommendationService $recommendationService,
        protected StatisticsService $statisticsService
    ) {}

    private function getKaderPosyanduId(): int
    {
        $posyanduId = Auth::user()?->kader?->posyandu_id;
        if (!$posyanduId) {
            abort(403, 'Akses ditolak: Anda tidak memiliki data Kader/Posyandu yang valid.');
        }
        return $posyanduId;
    }

    private function formatDisplayStatus(string $status): string
    {
        return match(strtolower($status)) {
            'stunting' => 'Stunting',
            'risiko', 'kurang' => 'Risiko Stunting',
            'normal' => 'Normal',
            default => $status
        };
    }

    public function dashboard()
    {
        $posyanduId = $this->getKaderPosyanduId();
        

        $priorityBalitas = Balita::where('posyandu_id', $posyanduId)
            ->where(function ($query) {
                $query->doesntHave('pengukurans')
                      ->orWhereHas('latestPengukuran', function ($q) {
                          $q->whereIn('status_gizi', ['Stunting', 'Risiko', 'Kurang', 'stunting', 'risiko', 'kurang']);
                      });
            })
            ->with('latestPengukuran')
            ->take(5)
            ->get();

        $priorityChildren = $priorityBalitas->map(function ($b) {
            $latest = $b->latestPengukuran;
            $age = Carbon::parse($b->tanggal_lahir)->diff(Carbon::now());
            
            $status = $latest ? $latest->status_gizi : 'Belum Ada';
            $statusType = match(strtolower($status)) {
                'stunting' => 'danger',
                'risiko', 'kurang' => 'warning',
                'normal' => 'success',
                default => 'warning'
            };

            return (object) [
                'id' => $b->id,
                'name' => $b->nama,
                'avatar' => null,
                'age' => $age->y . ' Tahun ' . $age->m . ' Bulan',
                'status' => $this->formatDisplayStatus($status),
                'statusType' => $statusType,
            ];
        })->toArray();

        $ds = $this->statisticsService->getKaderDashboardStats($posyanduId);

        $data = [
            'kaderName' => Auth::user()?->kader?->nama ?? Auth::user()->name ?? 'Kader',
            'statTotal' => $ds['total_balita'],
            'statSudah' => $ds['bulan_ini'],
            'statBelum' => max(0, $ds['total_balita'] - $ds['bulan_ini']),
            'statPerlu' => count($priorityChildren),
            'statRevisi' => $ds['perlu_revisi'] ?? 0,
            'priorityChildren' => $priorityChildren,
            'activityName' => 'Penimbangan Rutin',
            'activityTime' => '08.00 - 11.00',
            'activityLocation' => Auth::user()?->kader?->posyandu?->nama ?? 'Posyandu',
            'activityAddress' => Auth::user()?->kader?->posyandu?->alamat ?? '-',
        ];

        return view('kader.dashboard', $data);
    }

    public function daftarBalita(Request $request)
    {
        $posyanduId = $this->getKaderPosyanduId();
        
        $q = $request->input('q');
        $statusGizi = $request->input('status_gizi');
        $filter = $request->input('filter');

        $query = Balita::where('posyandu_id', $posyanduId)
            ->with(['orangTua', 'latestPengukuran', 'pengukurans']);

        if ($q) {
            $query->where(function($subq) use ($q) {
                $subq->where('nama', 'like', "%{$q}%")
                     ->orWhere('nik', 'like', "%{$q}%");
            });
        }

        if ($statusGizi) {
            $query->whereHas('latestPengukuran', function($subq) use ($statusGizi) {
                $statusMap = [
                    'normal' => 'Normal',
                    'kurang' => 'Risiko',
                    'stunting' => 'Stunting'
                ];
                $expected = $statusMap[strtolower($statusGizi)] ?? $statusGizi;
                $subq->where('status_gizi', $expected);
            });
        }

        if ($filter) {
            if ($filter === 'belum_diukur') {
                $thisMonth = Carbon::now()->month;
                $thisMonthYear = Carbon::now()->year;
                $query->whereDoesntHave('pengukurans', function ($subq) use ($thisMonth, $thisMonthYear) {
                    $subq->whereMonth('tanggal_ukur', $thisMonth)
                         ->whereYear('tanggal_ukur', $thisMonthYear);
                });
            } elseif ($filter === 'absen_bulan_lalu') {
                $lastMonth = Carbon::now()->subMonth()->month;
                $lastMonthYear = Carbon::now()->subMonth()->year;
                $query->whereDoesntHave('pengukurans', function ($subq) use ($lastMonth, $lastMonthYear) {
                    $subq->whereMonth('tanggal_ukur', $lastMonth)
                         ->whereYear('tanggal_ukur', $lastMonthYear);
                });
            } elseif ($filter === 'bayi_6_bln') {
                $sixMonthsAgo = Carbon::now()->subMonths(6);
                $query->where('tanggal_lahir', '>=', $sixMonthsAgo);
            } elseif ($filter === 'selesai') {
                $thisMonth = Carbon::now()->month;
                $thisMonthYear = Carbon::now()->year;
                $query->whereHas('pengukurans', function ($subq) use ($thisMonth, $thisMonthYear) {
                    $subq->whereMonth('tanggal_ukur', $thisMonth)
                         ->whereYear('tanggal_ukur', $thisMonthYear);
                });
            } elseif ($filter === 'ditolak') {
                $query->whereHas('pengukurans', function ($subq) {
                    $subq->where('status_validasi', 'rejected');
                });
            }
        }

        $balitas = $query->get();

        $formattedBalitas = $balitas->map(function($b) {
            $latest = $b->latestPengukuran;
            $age = Carbon::parse($b->tanggal_lahir)->diff(Carbon::now());
            
            $status = $latest ? $latest->status_gizi : 'Belum Ada';
            $statusType = match(strtolower($status)) {
                'stunting' => 'danger',
                'risiko', 'kurang' => 'warning',
                'normal' => 'success',
                default => 'warning'
            };

            $hasRejected = $b->pengukurans->where('status_validasi', 'rejected')->isNotEmpty();
            $status_validasi = $latest ? $latest->status_validasi : null;
            $contextTag = null;

            if ($hasRejected) {
                $rejectedRecord = $b->pengukurans->where('status_validasi', 'rejected')->first();
                $contextTag = 'Perlu Revisi: ' . \Illuminate\Support\Str::limit($rejectedRecord->catatan_validator, 30);
            } elseif ($latest && $latest->status_validasi === 'rejected') {
                $contextTag = 'Ditolak: ' . \Illuminate\Support\Str::limit($latest->catatan_validator, 30);
            }

            return [
                'id' => $b->id,
                'name' => $b->nama,
                'age' => $age->y . ' Thn ' . $age->m . ' Bln',
                'mother' => $b->orangTua->nama_ibu ?? '-',
                'nik' => $b->nik,
                'last_measure' => $latest ? Carbon::parse($latest->tanggal_ukur)->translatedFormat('d M Y') : 'Belum Diukur',
                'status' => $this->formatDisplayStatus($status),
                'status_type' => $statusType,
                'status_validasi' => $status_validasi,
                'avatar' => null,
                'context_tag' => $contextTag
            ];
        });

        $ds = $this->statisticsService->getKaderDashboardStats($posyanduId);

        return view('kader.daftar-balita', [
            'balitas' => $formattedBalitas,
            'filters' => $request->all(),
            'statSelesai' => $ds['bulan_ini'],
            'statBelum' => $ds['total_balita'] - $ds['bulan_ini'],
            'posyanduName' => Auth::user()?->kader?->posyandu?->nama ?? 'Posyandu'
        ]);
    }

    public function createBalita()
    {
        $kaderPosyandu = Auth::user()?->kader?->posyandu;
        return view('kader.daftar-balita-baru', [
            'posyanduName' => $kaderPosyandu->nama ?? 'Posyandu'
        ]);
    }

    public function simpanBalita(Request $request)
    {
        // Simple validation for MVP
        $request->validate([
            'nama' => 'required|string',
            'nik' => 'required|digits:16|unique:balitas,nik',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'nama_ibu' => 'required|string',
            'no_hp' => 'required|string',
            'berat_lahir' => 'nullable|numeric|min:1',
            'panjang_lahir' => 'nullable|numeric|min:20',
            'nik_ibu' => 'nullable|string',
            'desa' => 'nullable|string',
            'kecamatan' => 'nullable|string',
        ]);

        $posyanduId = $this->getKaderPosyanduId();

        $alamatJson = json_encode([
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan
        ]);

        // Auto-create OrangTua User if not exists
        $userIbu = User::firstOrCreate(
            ['email' => $request->no_hp . '@nutrigen.com'],
            ['name' => $request->nama_ibu, 'password' => Hash::make('password'), 'role' => 'ibu']
        );

        $orangTua = OrangTua::firstOrCreate(
            ['user_id' => $userIbu->id],
            ['nama_ibu' => $request->nama_ibu, 'nik_ibu' => $request->nik_ibu, 'nama_ayah' => '-', 'no_hp_whatsapp' => $request->no_hp, 'alamat' => $alamatJson]
        );

        Balita::create([
            'orang_tua_id' => $orangTua->id,
            'posyandu_id' => $posyanduId,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'berat_lahir' => $request->berat_lahir,
            'panjang_lahir' => $request->panjang_lahir,
        ]);

        return redirect()->route('balita.index')->with('success', 'Data Balita berhasil disimpan.');
    }

    public function editBalita($id)
    {
        $posyanduId = $this->getKaderPosyanduId();
        $balita = Balita::with('orangTua')->where('posyandu_id', $posyanduId)->findOrFail($id);
        
        $alamatRaw = $balita->orangTua->alamat ?? '';
        $alamatData = json_decode($alamatRaw, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($alamatData)) {
            $desa = $alamatData['desa'] ?? '';
            $kecamatan = $alamatData['kecamatan'] ?? '';
        } else {
            $desa = $alamatRaw;
            $kecamatan = '';
        }

        return view('kader.daftar-balita-baru', [
            'isEdit' => true,
            'balitaId' => $balita->id,
            'childName' => $balita->nama,
            'nik' => $balita->nik,
            'birthDate' => \Carbon\Carbon::parse($balita->tanggal_lahir)->format('Y-m-d'),
            'gender' => $balita->jenis_kelamin,
            'motherName' => $balita->orangTua->nama_ibu ?? '',
            'motherNik' => $balita->orangTua->nik_ibu ?? $balita->orangTua->user->nik ?? '',
            'motherPhone' => $balita->orangTua->no_hp_whatsapp ?? '',
            'address' => $desa,
            'addressSub' => $kecamatan,
            'posyanduName' => $balita->posyandu->nama ?? 'Posyandu'
        ]);
    }

    public function updateBalita(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'nik' => 'required|digits:16|unique:balitas,nik,' . $id,
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'nama_ibu' => 'required|string',
            'no_hp' => 'required|string',
            'berat_lahir' => 'nullable|numeric|min:1',
            'panjang_lahir' => 'nullable|numeric|min:20',
            'nik_ibu' => 'nullable|string',
            'desa' => 'nullable|string',
            'kecamatan' => 'nullable|string',
        ]);

        $posyanduId = $this->getKaderPosyanduId();
        $balita = Balita::where('posyandu_id', $posyanduId)->findOrFail($id);

        $alamatJson = json_encode([
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan
        ]);

        $balita->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'berat_lahir' => $request->berat_lahir,
            'panjang_lahir' => $request->panjang_lahir,
        ]);

        if ($balita->orangTua) {
            $balita->orangTua->update([
                'nama_ibu' => $request->nama_ibu,
                'no_hp_whatsapp' => $request->no_hp,
                'nik_ibu' => $request->nik_ibu,
                'alamat' => $alamatJson,
            ]);
            
            if ($balita->orangTua->user) {
                $balita->orangTua->user->update([
                    'name' => $request->nama_ibu,
                ]);
            }
        }

        return redirect()->route('balita.show', $balita->id)->with('success', 'Data Balita berhasil diperbarui.');
    }

    /**
     * Menghapus data Balita secara permanen (Hard Delete)
     * Beserta seluruh relasinya (Pengukuran, OrangTua, dan User) jika relevan.
     */
    public function hapusBalita(Request $request, $id)
    {
        $posyanduId = $this->getKaderPosyanduId();
        $balita = Balita::where('posyandu_id', $posyanduId)->findOrFail($id);

        $orangTuaId = $balita->orang_tua_id;
        $orangTua = OrangTua::find($orangTuaId);
        $userId = $orangTua ? $orangTua->user_id : null;

        // 1. Delete all measurements (Pengukurans) related to this balita
        Pengukuran::where('balita_id', $balita->id)->delete();

        // 2. Delete the Balita
        $balita->delete();

        // 3. Orphan Cleanup
        // If this OrangTua has no other Balitas, delete the OrangTua and User account
        if ($orangTua) {
            $otherChildrenCount = Balita::where('orang_tua_id', $orangTuaId)->count();
            if ($otherChildrenCount === 0) {
                $orangTua->delete();
                if ($userId) {
                    User::where('id', $userId)->delete();
                }
            }
        }

        return redirect()->route('balita.index')->with('success', 'Data balita dan riwayat pengukuran berhasil dihapus secara permanen.');
    }

    public function profilBalita($id)
    {
        $posyanduId = $this->getKaderPosyanduId();

        $b = Balita::with(['orangTua', 'posyandu', 'latestPengukuran', 'pengukurans' => function($q) {
            $q->orderBy('tanggal_ukur', 'desc')->orderBy('id', 'desc');
        }])->where('posyandu_id', $posyanduId)->findOrFail($id);

        $ageDiff = Carbon::parse($b->tanggal_lahir)->diff(Carbon::now());
        $ageStr = $ageDiff->y > 0 ? $ageDiff->y . ' Tahun ' . $ageDiff->m . ' Bulan' : $ageDiff->m . ' Bulan';

        $measurements = $b->pengukurans->map(function($p) {
            $statusType = match(strtolower($p->status_gizi)) {
                'normal' => 'success',
                'risiko' => 'warning',
                'stunting' => 'danger',
                default => 'success'
            };

            return [
                'id' => $p->id,
                'date' => Carbon::parse($p->tanggal_ukur)->translatedFormat('d M Y'),
                'raw_date' => Carbon::parse($p->tanggal_ukur)->format('Y-m-d'),
                'weight' => $p->berat_badan,
                'weight_trend' => null,
                'height' => $p->tinggi_badan,
                'head_circ' => null,
                'status' => $this->formatDisplayStatus($p->status_gizi),
                'status_type' => $statusType,
                'status_validasi' => $p->status_validasi,
                'catatan_validator' => $p->catatan_validator
            ];
        })->toArray();

        $latestMeasure = count($measurements) > 0 ? $measurements[0] : null;

        $alamatRaw = $b->orangTua->alamat ?? '';
        $alamatData = json_decode($alamatRaw, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($alamatData)) {
            $desa = $alamatData['desa'] ?? '';
            $kecamatan = $alamatData['kecamatan'] ?? '';
        } else {
            $desa = $alamatRaw;
            $kecamatan = '';
        }

        $data = [
            'balitaId'    => $b->id,
            'childName'   => $b->nama,
            'gender'      => $b->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan',
            'age'         => $ageStr,
            'nik'         => $b->nik,
            'motherName'  => $b->orangTua->nama_ibu ?? '-',
            'motherPhone' => $b->orangTua->no_hp_whatsapp ?? '-',
            'posyanduName'=> $b->posyandu->nama ?? '-',
            'address'     => $desa ?: '-',
            'addressSub'  => $kecamatan ?: null,
            'status'      => $latestMeasure ? $latestMeasure['status'] : 'Belum Ada',
            'status_type' => $latestMeasure ? $latestMeasure['status_type'] : 'success',
            'measurements'=> $measurements,
            'latestMeasure'=>$latestMeasure,
        ];

        return view('kader.profil-balita', $data);
    }

    public function pengukuran()
    {
        // Measurements are now handled via modal in the profile page.
        // Redirect to balita index to prevent 500 ViewNotFound errors if accessed directly.
        return redirect()->route('balita.index')->with('info', 'Silakan pilih balita terlebih dahulu untuk melakukan pengukuran.');
    }

    public function simpanPengukuran(Request $request)
    {
        if (!Auth::user()?->kader) {
            abort(403, 'Akses ditolak: Anda tidak memiliki data Kader yang valid.');
        }

        $posyanduId = $this->getKaderPosyanduId();

        $request->validate([
            'balita_id' => 'required|exists:balitas,id',
            'tanggal_ukur' => 'required|date',
            'berat_badan' => 'required|numeric|min:1|max:999.99',
            'tinggi_badan' => 'required|numeric|min:10|max:999.99',
        ]);

        // Pastikan Balita yang diukur berada di Posyandu Kader yang login
        $balita = Balita::where('posyandu_id', $posyanduId)->findOrFail($request->balita_id);
        
        // 1. Panggil GrowthCalculationService (Pure Logic)
        $calc = $this->growthService->calculate(
            Carbon::parse($balita->tanggal_lahir),
            Carbon::parse($request->tanggal_ukur),
            $balita->jenis_kelamin,
            (float) $request->berat_badan,
            (float) $request->tinggi_badan
        );

        // 2. Simpan ke database tanpa menghitung Z-Score di Controller
        $pengukuran = Pengukuran::create([
            'balita_id' => $balita->id,
            'kader_id' => Auth::user()->kader->id,
            'tanggal_ukur' => $request->tanggal_ukur,
            'umur_bulan' => $calc['umur_bulan'],
            'berat_badan' => $request->berat_badan,
            'tinggi_badan' => $request->tinggi_badan,
            'z_score_bbu' => $calc['z_score_bbu'],
            'z_score_tbu' => $calc['z_score_tbu'],
            'status_gizi' => $calc['status_gizi']
        ]);

        // 3. Panggil RecommendationService (Bisa dikirim ke Session atau UI)
        $recommendation = $this->recommendationService->generate(
            $calc['status_gizi'], 
            $calc['umur_bulan'], 
            $calc['z_score_bbu'], 
            $calc['z_score_tbu']
        );

        return redirect()->route('balita.show', $balita->id)
            ->with('success', 'Pengukuran berhasil disimpan. Status: ' . $recommendation['status'])
            ->with('advice', $recommendation['dietary_advice']);
    }

    // Unused MVP methods (kept to prevent route failure)
    public function jadwal() { return view('kader.jadwal', ['jadwals' => [], 'posyanduName' => '']); }
    public function tambahJadwal() { return view('kader.tambah-jadwal'); }
    public function laporan(Request $request) 
    { 
        $posyanduId = $this->getKaderPosyanduId();
        
        // Parsing periode
        $periodeReq = $request->input('periode', Carbon::now()->format('Y-m'));
        $parts = explode('-', $periodeReq);
        $year = (int) $parts[0];
        $month = (int) ($parts[1] ?? Carbon::now()->month);
        
        $stats = $this->statisticsService->getKaderDashboardStats($posyanduId, $month, $year);
        
        $posyanduName = Auth::user()?->kader?->posyandu?->nama ?? 'Posyandu Kader';
        
        Carbon::setLocale('id');
        $periodeLabel = Carbon::createFromDate($year, $month, 1)->translatedFormat('F Y');
        
        $belumDiukur = max(0, $stats['total_balita'] - $stats['bulan_ini']);
        $perluPerhatian = $stats['risiko'] + $stats['stunting'] + ($stats['kurang'] ?? 0);
        $berisiko = $stats['stunting']; 
        $persentase = $stats['total_balita'] > 0 ? round(($stats['bulan_ini'] / $stats['total_balita']) * 100) : 0;
        
        $dataKosong = $stats['total_balita'] === 0 || $stats['bulan_ini'] === 0;

        return view('kader.laporan', [
            'posyanduAktif' => $posyanduName,
            'periode' => $periodeLabel,
            'periodeValue' => $periodeReq,
            'totalBalita' => $stats['total_balita'],
            'sudahDiukur' => $stats['bulan_ini'],
            'belumDiukur' => $belumDiukur,
            'perluPerhatian' => $perluPerhatian,
            'berisiko' => $berisiko,
            'persentase' => $persentase,
            'dataKosong' => $dataKosong
        ]); 
    }

    public function generatePdf(Request $request)
    {
        $posyanduId = $this->getKaderPosyanduId();
        
        // Parsing periode
        $periodeReq = $request->input('periode', Carbon::now()->format('Y-m'));
        $parts = explode('-', $periodeReq);
        $year = (int) $parts[0];
        $month = (int) ($parts[1] ?? Carbon::now()->month);
        
        $stats = $this->statisticsService->getKaderDashboardStats($posyanduId, $month, $year);
        $posyanduName = Auth::user()?->kader?->posyandu?->nama ?? 'Posyandu Kader';
        
        Carbon::setLocale('id');
        $periodeLabel = Carbon::createFromDate($year, $month, 1)->translatedFormat('F Y');
        
        $belumDiukur = max(0, $stats['total_balita'] - $stats['bulan_ini']);
        $perluPerhatian = $stats['risiko'] + $stats['stunting'] + ($stats['kurang'] ?? 0);
        $berisiko = $stats['stunting']; 
        $persentase = $stats['total_balita'] > 0 ? round(($stats['bulan_ini'] / $stats['total_balita']) * 100) : 0;

        // Fetch detailed data for the report (the children measured this month)
        $balitas = Balita::where('posyandu_id', $posyanduId)
            ->whereHas('pengukurans', function($q) use ($month, $year) {
                $q->whereMonth('tanggal_ukur', $month)
                  ->whereYear('tanggal_ukur', $year);
            })
            ->with(['pengukurans' => function($q) use ($month, $year) {
                $q->whereMonth('tanggal_ukur', $month)
                  ->whereYear('tanggal_ukur', $year)
                  ->latest('id');
            }])->get();

        $data = [
            'posyanduAktif' => $posyanduName,
            'periode' => $periodeLabel,
            'totalBalita' => $stats['total_balita'],
            'sudahDiukur' => $stats['bulan_ini'],
            'belumDiukur' => $belumDiukur,
            'perluPerhatian' => $perluPerhatian,
            'berisiko' => $berisiko,
            'persentase' => $persentase,
            'stats' => $stats,
            'balitas' => $balitas,
            'kaderName' => Auth::user()->name
        ];

        return view('kader.laporan-pdf', $data);
    }

    public function detailJadwal($id) { return view('kader.detail-jadwal'); }
    
    public function profilKader()
    {
        $kader = Auth::user()->kader;
        
        $alamatRaw = $kader->posyandu->alamat ?? '';
        $alamatData = json_decode($alamatRaw, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($alamatData)) {
            $desa = $alamatData['desa'] ?? $kader->posyandu->desa ?? '-';
            $kecamatan = $alamatData['kecamatan'] ?? '-';
        } else {
            $desa = $kader->posyandu->desa ?? '-';
            $kecamatan = '-';
        }
        
        return view('kader.profil-kader', [
            'kaderName' => $kader->nama ?? Auth::user()->name,
            'role' => 'Kader Posyandu',
            'email' => Auth::user()->email,
            'phone' => $kader->no_hp ?? '-',
            'posyanduName' => $kader->posyandu->nama ?? '-',
            'desa' => $desa,
            'kecamatan' => $kecamatan,
            'puskesmas' => $kader->posyandu->puskesmas->nama ?? '-',
            'status' => 'Aktif'
        ]);
    }

    public function editProfilKader()
    {
        $kader = Auth::user()->kader;
        return view('kader.edit-profil-kader', [
            'name' => $kader->nama ?? Auth::user()->name,
            'email' => Auth::user()->email,
            'phone' => $kader->no_hp ?? ''
        ]);
    }

    public function updateProfilKader(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20'
        ]);

        $user = Auth::user();
        $kader = $user->kader;

        if ($kader) {
            $kader->update([
                'nama' => $request->nama,
                'no_hp' => $request->no_hp
            ]);
        }

        $user->update([
            'name' => $request->nama
        ]);

        return redirect()->route('kader.profil')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Show rejected measurements for the Kader's Posyandu.
     */
    public function rejectedData(Request $request)
    {
        $posyanduId = $this->getKaderPosyanduId();

        $pengukuran = Pengukuran::whereHas('balita', function ($q) use ($posyanduId) {
            $q->where('posyandu_id', $posyanduId);
        })->where('status_validasi', 'rejected')
            ->with(['balita', 'balita.orangTua'])
            ->get();

        $data = $pengukuran->map(function ($p) {
            return [
                'id' => $p->id,
                'childName' => $p->balita->nama ?? '-',
                'measureDate' => Carbon::parse($p->tanggal_ukur)->translatedFormat('d M Y'),
                'statusGizi' => $p->status_gizi,
                'catatan' => $p->catatan_validator ?? '-',
            ];
        })->toArray();

        return view('kader.rejected', ['rejected' => $data]);
    }

    /**
     * Update a rejected measurement after correction and resubmit.
     */
    public function updatePengukuran(Request $request, $id)
    {
        $request->validate([
            'tanggal_ukur' => 'required|date',
            'berat_badan' => 'required|numeric|min:1|max:999.99',
            'tinggi_badan' => 'required|numeric|min:10|max:999.99',
        ]);

        $pengukuran = Pengukuran::findOrFail($id);
        // Ensure it belongs to this Kader's Posyandu
        $posyanduId = $this->getKaderPosyanduId();
        if ($pengukuran->balita->posyandu_id !== $posyanduId) {
            abort(403, 'Akses ditolak');
        }

        // Panggil GrowthCalculationService (Pure Logic) untuk menghitung ulang Z-Score
        $calc = $this->growthService->calculate(
            Carbon::parse($pengukuran->balita->tanggal_lahir),
            Carbon::parse($request->tanggal_ukur),
            $pengukuran->balita->jenis_kelamin,
            (float) $request->berat_badan,
            (float) $request->tinggi_badan
        );

        // Update measurement fields beserta z-score dan status gizi baru
        $pengukuran->update([
            'tanggal_ukur' => $request->tanggal_ukur,
            'umur_bulan' => $calc['umur_bulan'],
            'berat_badan' => $request->berat_badan,
            'tinggi_badan' => $request->tinggi_badan,
            'z_score_bbu' => $calc['z_score_bbu'],
            'z_score_tbu' => $calc['z_score_tbu'],
            'status_gizi' => $calc['status_gizi'],
            'status_validasi' => 'pending',
            'catatan_validator' => null,
        ]);

        return back()->with('success', 'Pengukuran berhasil diperbaiki dan dikirim kembali untuk validasi.');
    }
}
