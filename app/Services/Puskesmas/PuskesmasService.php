<?php

namespace App\Services\Puskesmas;

use App\Models\Puskesmas;
use App\Models\Posyandu;
use App\Models\Balita;
use App\Models\Validasi;
use App\Models\Pengukuran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PuskesmasService
{
    protected function getPetugas()
    {
        return Auth::user()->petugasPuskesmas()->with('puskesmas')->firstOrFail();
    }

    public function getDashboardData(): array
    {
        $petugas = $this->getPetugas();
        $puskesmasId = $petugas->puskesmas_id;

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Total Balita in Puskesmas
        $totalBalita = Balita::whereHas('pengukurans', function($q) use ($puskesmasId) {
            $q->whereHas('posyandu', function($q2) use ($puskesmasId) {
                $q2->where('puskesmas_id', $puskesmasId);
            });
        })->count();

        // Total Diukur this month
        $pengukuranBulanIniQuery = Pengukuran::whereHas('posyandu', function($q) use ($puskesmasId) {
            $q->where('puskesmas_id', $puskesmasId);
        })->whereMonth('tanggal_ukur', $currentMonth)->whereYear('tanggal_ukur', $currentYear);

        $totalDiukur = $pengukuranBulanIniQuery->count();
        
        $validasisBulanIni = Validasi::whereHas('pengukuran', function($q) use ($puskesmasId, $currentMonth, $currentYear) {
            $q->whereHas('posyandu', function($q2) use ($puskesmasId) {
                $q2->where('puskesmas_id', $puskesmasId);
            })->whereMonth('tanggal_ukur', $currentMonth)->whereYear('tanggal_ukur', $currentYear);
        })->get();

        $validCount = $validasisBulanIni->where('status_validasi', 'valid')->count();
        $pendingCount = $validasisBulanIni->where('status_validasi', 'pending')->count();
        
        // Pending Berisiko / Anomali (Sangat Pendek / Pendek)
        $pendingAnomali = $validasisBulanIni->filter(function($v) {
            return $v->status_validasi === 'pending' && in_array($v->pengukuran->status_stunting, ['Sangat Pendek', 'Pendek']);
        })->count();

        // Distribution (Based on all pengukurans this month)
        $normalCount = $pengukuranBulanIniQuery->clone()->where('status_stunting', 'Normal')->count();
        $perluPerhatianCount = $pengukuranBulanIniQuery->clone()->where('status_stunting', 'Pendek')->count();
        $berisikoCount = $pengukuranBulanIniQuery->clone()->where('status_stunting', 'Sangat Pendek')->count();

        $distTotal = $normalCount + $perluPerhatianCount + $berisikoCount;
        $distTotal = $distTotal > 0 ? $distTotal : 1; // Prevent division by zero

        $stats = [
            'user_name'        => Auth::user()->name . ' (' . $petugas->jabatan . ')',
            'pending_total'    => $pendingCount,
            'pending_anomali'  => $pendingAnomali,
            'pending_berisiko' => $berisikoCount,
            'total_balita'     => $totalBalita,
            'diukur'           => $totalDiukur,
            'valid'            => $validCount,
            'pending'          => $pendingCount,
            'current_month'    => Carbon::now()->translatedFormat('F Y'),
        ];

        $distribution = [
            'normal'           => ['count' => $normalCount, 'percentage' => round(($normalCount/$distTotal)*100)],
            'perlu_perhatian'  => ['count' => $perluPerhatianCount, 'percentage' => round(($perluPerhatianCount/$distTotal)*100)],
            'berisiko'         => ['count' => $berisikoCount, 'percentage' => round(($berisikoCount/$distTotal)*100)],
            'total_diukur'     => $totalDiukur,
        ];

        return ['stats' => $stats, 'distribution' => $distribution];
    }

    public function getValidasiData(array $filters): array
    {
        $petugas = $this->getPetugas();
        $puskesmasId = $petugas->puskesmas_id;

        $tab = $filters['tab'] ?? 'pending';
        
        $validasis = Validasi::with(['pengukuran.balita.ibu', 'pengukuran.posyandu', 'pengukuran.kader.user'])
            ->whereHas('pengukuran.posyandu', function($q) use ($puskesmasId) {
                $q->where('puskesmas_id', $puskesmasId);
            })
            ->when($tab === 'pending', function($q) {
                $q->where('status_validasi', 'pending');
            })
            ->when($tab === 'riwayat', function($q) {
                $q->whereIn('status_validasi', ['valid', 'invalid']);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $children = $validasis->map(function($v) {
            $p = $v->pengukuran;
            $b = $p->balita;
            
            // Map status
            $statusLabel = $p->status_stunting === 'Sangat Pendek' ? 'Berisiko' : ($p->status_stunting === 'Pendek' ? 'Anomali' : 'Normal');
            $statusType = $p->status_stunting === 'Sangat Pendek' ? 'danger' : ($p->status_stunting === 'Pendek' ? 'warning' : 'success');

            // Format z_scores
            $zscores = [
                'BB/U'  => ['val' => $p->z_score_bb_u > 0 ? '+'.$p->z_score_bb_u : $p->z_score_bb_u, 'status' => 'Normal', 'color' => 'emerald'],
                'TB/U'  => ['val' => $p->z_score_tb_u > 0 ? '+'.$p->z_score_tb_u : $p->z_score_tb_u, 'status' => $p->status_stunting, 'color' => $statusType == 'danger' ? 'rose' : ($statusType == 'warning' ? 'amber' : 'emerald')],
                'BB/TB' => ['val' => $p->z_score_bb_tb > 0 ? '+'.$p->z_score_bb_tb : $p->z_score_bb_tb, 'status' => $p->status_gizi, 'color' => 'emerald'],
                'IMT/U' => ['val' => $p->z_score_bb_tb, 'status' => 'Normal', 'color' => 'emerald'], // MVP fallback
            ];

            return [
                'id'          => $v->id,
                'name'        => $b->nama,
                'nik'         => $b->nik,
                'gender'      => $b->jenis_kelamin,
                'age'         => Carbon::parse($b->tanggal_lahir)->diffInMonths(Carbon::parse($p->tanggal_ukur)) . ' bln',
                'indicator'   => 'TB/U',
                'value'       => $p->z_score_tb_u . ' (' . $p->status_stunting . ')',
                'posyandu'    => $p->posyandu->nama,
                'kader'       => $p->kader->user->name,
                'time'        => Carbon::parse($p->created_at)->format('H:i'),
                'date'        => Carbon::parse($p->tanggal_ukur)->translatedFormat('d F Y'),
                'statusType'  => $statusType,
                'statusLabel' => $statusLabel,
                'parent'      => $b->ibu->nama,
                'bb'          => $p->berat_badan . ' kg',
                'tb'          => $p->tinggi_badan . ' cm',
                'zscores'     => $zscores,
                'history'     => [] // Future enhancement
            ];
        })->toArray();

        return ['children' => $children, 'filters' => $filters];
    }

    public function getBalitaData(array $filters): array
    {
        $petugas = $this->getPetugas();
        $puskesmasId = $petugas->puskesmas_id;

        $posyandus = Posyandu::where('puskesmas_id', $puskesmasId)->get(['id', 'nama'])->toArray();

        $balitas = Balita::with(['ibu', 'pengukurans.posyandu', 'pengukurans.validasi.petugasPuskesmas.user'])
            ->whereHas('pengukurans.posyandu', function($q) use ($puskesmasId) {
                $q->where('puskesmas_id', $puskesmasId);
            })->get();

        $children = $balitas->map(function($b) {
            $latestPengukuran = $b->pengukurans->sortByDesc('tanggal_ukur')->first();
            $posyanduName = $latestPengukuran ? $latestPengukuran->posyandu->nama : '-';
            
            $formattedPengukurans = $b->pengukurans->sortByDesc('tanggal_ukur')->map(function($p) use ($b) {
                $arr = [
                    'id'              => $p->id,
                    'umur_bulan'      => Carbon::parse($b->tanggal_lahir)->diffInMonths(Carbon::parse($p->tanggal_ukur)),
                    'berat_badan'     => $p->berat_badan,
                    'tinggi_badan'    => $p->tinggi_badan,
                    'z_score_bb_u'    => $p->z_score_bb_u,
                    'status_gizi'     => $p->status_stunting, // mapping to original DTO
                    'status_validasi' => $p->validasi ? $p->validasi->status_validasi : 'pending',
                    'created_at'      => Carbon::parse($p->created_at)->format('Y-m-d H:i:s'),
                ];

                if ($p->validasi && $p->validasi->petugasPuskesmas) {
                    $arr['validasi'] = [
                        'validator_name' => $p->validasi->petugasPuskesmas->user->name,
                        'status'         => $p->validasi->status_validasi,
                        'catatan'        => $p->validasi->catatan ?? '-',
                        'created_at'     => Carbon::parse($p->validasi->updated_at)->format('Y-m-d H:i:s'),
                    ];
                }
                return $arr;
            })->values()->toArray();

            return [
                'id'            => $b->id,
                'nik'           => $b->nik,
                'nama'          => $b->nama,
                'tanggal_lahir' => Carbon::parse($b->tanggal_lahir)->format('Y-m-d'),
                'jenis_kelamin' => $b->jenis_kelamin,
                'berat_lahir'   => 3.0, // Default as it was removed from migration
                'tinggi_lahir'  => 50.0, // Default
                'ibu'           => ['nama' => $b->ibu->nama, 'no_hp_wa' => $b->ibu->no_hp_wa],
                'posyandu'      => ['nama' => $posyanduName],
                'pengukurans'   => $formattedPengukurans,
            ];
        })->toArray();

        return ['children' => $children, 'posyandus' => $posyandus, 'filters' => $filters];
    }

    public function getPosyanduData(array $filters, $requestedId): array
    {
        $petugas = $this->getPetugas();
        $puskesmasId = $petugas->puskesmas_id;

        $posyandusCollection = Posyandu::where('puskesmas_id', $puskesmasId)
            ->with(['kaders.user', 'jadwals'])
            ->withCount(['pengukurans as diukur_bulan_ini' => function($q) {
                $q->whereMonth('tanggal_ukur', Carbon::now()->month)
                  ->whereYear('tanggal_ukur', Carbon::now()->year);
            }])
            ->get();

        $posyandus = $posyandusCollection->map(function($p) {
            $kaders = $p->kaders->map(function($k) {
                return [
                    'id' => $k->id,
                    'nama' => $k->user->name,
                    'nik' => '1234567890123456', // Dummy since NIK is not in Kader table anymore (only users/ibus/balitas)
                    'no_hp' => $k->no_hp_wa,
                    'aktivitas_bulan_ini' => 10, // Mock
                    'terakhir_aktif' => Carbon::now()->format('Y-m-d'),
                ];
            })->toArray();

            $jadwals = $p->jadwals->map(function($j) {
                return [
                    'id' => $j->id,
                    'judul' => $j->judul,
                    'tanggal' => Carbon::parse($j->tanggal)->format('Y-m-d'),
                    'waktu_mulai' => Carbon::parse($j->waktu_mulai)->format('H:i'),
                    'lokasi' => $j->lokasi,
                ];
            })->toArray();

            $hasJadwal = collect($jadwals)->contains(function($j) {
                return Carbon::parse($j['tanggal'])->month === Carbon::now()->month;
            });

            // Count total balita associated through measurements
            $totalBalita = Balita::whereHas('pengukurans', function($q) use ($p) {
                $q->where('posyandu_id', $p->id);
            })->count();

            return [
                'id'                    => $p->id,
                'nama'                  => $p->nama,
                'desa'                  => '-', // Removed from migration
                'alamat'                => $p->alamat ?? '-',
                'balita_count'          => $totalBalita,
                'kader_count'           => $p->kaders->count(),
                'has_jadwal_this_month' => $hasJadwal,
                'stats'                 => [
                    'total_balita'     => $totalBalita,
                    'diukur_bulan_ini' => $p->diukur_bulan_ini,
                ],
                'kaders' => $kaders,
                'jadwals' => $jadwals,
            ];
        })->toArray();

        $selectedPosyandu = null;
        if ($requestedId) {
            $selectedPosyandu = collect($posyandus)->firstWhere('id', (int) $requestedId);
        }
        if (! $selectedPosyandu && count($posyandus) > 0) {
            $selectedPosyandu = $posyandus[0];
        }

        return ['posyandus' => $posyandus, 'selectedPosyandu' => $selectedPosyandu, 'filters' => $filters];
    }

    public function getLaporanData(array $filters): array
    {
        $petugas = $this->getPetugas();
        $puskesmasId = $petugas->puskesmas_id;

        // Simplified for MVP DTO matching
        $stats = [
            'total_balita'    => Balita::count(),
            'normal'          => Pengukuran::where('status_stunting', 'Normal')->count(),
            'berisiko'        => Pengukuran::where('status_stunting', '!=', 'Normal')->count(),
            'pending_validasi' => Validasi::where('status_validasi', 'pending')->count(),
            'sudah_validasi'  => Validasi::where('status_validasi', '!=', 'pending')->count(),
        ];

        $reports = [
            ['nama_posyandu' => 'Seluruh Posyandu', 'sasaran' => $stats['total_balita'], 'diukur' => $stats['total_balita'], 'normal' => $stats['normal'], 'berisiko' => $stats['berisiko'], 'persentase_hadir' => '100%'],
        ];

        $distribution = [
            'normal'      => $stats['normal'],
            'wasting'     => 0,
            'stunting'    => $stats['berisiko'],
            'underweight' => 0,
        ];

        $trends = [
            ['bulan' => Carbon::now()->subMonths(1)->format('M')],
            ['bulan' => Carbon::now()->format('M')],
        ];

        return ['stats' => $stats, 'reports' => $reports, 'distribution' => $distribution, 'trends' => $trends, 'filters' => $filters];
    }

    public function getPengaturanData(): array
    {
        $petugas = $this->getPetugas();
        $puskesmas = $petugas->puskesmas;

        return [
            'puskesmas' => [
                'nama'           => $puskesmas->nama,
                'kode_registrasi' => $puskesmas->kode_puskesmas,
                'alamat'         => $puskesmas->alamat,
                'logo_url'       => null,
            ],
            'user' => [
                'nama'   => Auth::user()->name,
                'nip'    => $petugas->nip,
                'email'  => Auth::user()->email,
                'no_hp'  => '-', // Removed from migration
            ]
        ];
    }
}
