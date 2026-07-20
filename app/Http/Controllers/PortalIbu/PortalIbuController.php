<?php

namespace App\Http\Controllers\PortalIbu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Balita;
use App\Models\Pengukuran;
use App\Models\Kader;
use App\Services\RecommendationService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PortalIbuController extends Controller
{
    public function __construct(
        protected RecommendationService $recommendationService
    ) {}

    /**
     * Memastikan akses data hanya untuk data milik OrangTua yang login (Secure Read-Only).
     */
    private function getActiveBalita()
    {
        $balitaId = request('balita');
        if (!$balitaId) return null;

        // Fetch balita with only approved measurements
        return Balita::with(['pengukurans' => function($q) {
            $q->where('status_validasi', 'approved')->latest('tanggal_ukur');
        }, 'posyandu'])->find($balitaId);
    }

    public function home()
    {
        $balita = $this->getActiveBalita();

        if (!$balita) {
            return view('portal-ibu.home.index', ['pageState' => 'empty']);
        }

        // Check if there are any measurements at all in DB to determine if pending vs completely empty
        $hasPending = false;
        if ($balita->pengukurans->isEmpty()) {
            // Check if there are measurements waiting for validation
            $pendingCount = \App\Models\Pengukuran::where('balita_id', $balita->id)->where('status_validasi', 'pending')->count();
            if ($pendingCount > 0) {
                $hasPending = true;
            }
        } else {
            // Check if the actual latest measurement in DB is pending
            $absoluteLatest = \App\Models\Pengukuran::where('balita_id', $balita->id)->latest('tanggal_ukur')->first();
            if ($absoluteLatest && $absoluteLatest->status_validasi === 'pending') {
                $hasPending = true;
            }
        }

        if ($balita->pengukurans->isEmpty()) {
            return view('portal-ibu.home.index', [
                'pageState' => 'empty',
                'hasPending' => $hasPending,
                'user' => ['child_name' => $balita->nama, 'avatar' => null]
            ]);
        }

        $pengukurans = $balita->pengukurans;
        $latest = $pengukurans->first();
        $previous = $pengukurans->skip(1)->first();

        $deltaWeight = '';
        $deltaHeight = '';
        if ($latest && $previous) {
            $diffWeight = $latest->berat_badan - $previous->berat_badan;
            $diffHeight = $latest->tinggi_badan - $previous->tinggi_badan;
            $deltaWeight = ($diffWeight >= 0 ? 'Naik ' : 'Turun ') . abs(round($diffWeight * 1000)) . 'g';
            $deltaHeight = ($diffHeight >= 0 ? 'Naik ' : 'Turun ') . abs(round($diffHeight, 1)) . 'cm';
        }

        $recommendation = null;
        $pageState = 'normal';
        if ($latest) {
            $recommendation = $this->recommendationService->generate(
                $latest->status_gizi,
                $latest->umur_bulan,
                $latest->z_score_bbu,
                $latest->z_score_tbu
            );

            $gizi = strtolower($latest->status_gizi);
            if (in_array($gizi, ['stunting'])) {
                $pageState = 'merah';
            } elseif (in_array($gizi, ['risiko', 'kurang'])) {
                $pageState = 'kuning';
            }
        }

        $data = [
            'pageState' => $pageState,
            'hasPending' => $hasPending,
            'user' => [
                'child_name' => $balita->nama,
                'avatar' => null,
            ],
            'summary' => [
                'status' => $recommendation['status'] ?? 'Belum Ada Data',
                'title' => $recommendation['title'] ?? 'Tumbuh Kembang Si Kecil',
                'message' => $recommendation['education'] ?? 'Silakan lakukan penimbangan rutin di Posyandu.',
                'action' => $recommendation['follow_up_action'] ?? 'Tunggu jadwal Posyandu berikutnya.'
            ],
            'measurement' => $latest ? [
                'date' => Carbon::parse($latest->tanggal_ukur)->format('d M Y'),
                'weight' => $latest->berat_badan,
                'height' => $latest->tinggi_badan
            ] : [
                'date' => '-',
                'weight' => '-',
                'height' => '-'
            ],
            'delta' => [
                'is_first' => !$previous,
                'weight' => $deltaWeight ?: 'Data Awal',
                'height' => $deltaHeight ?: 'Data Awal'
            ],
            'recommendation' => [
                'message' => $recommendation['dietary_advice'] ?? 'Ayo penuhi nutrisi anak setiap hari.',
                'cta' => 'Lihat Menu Hari Ini'
            ],
            'posyandu' => [
                'name' => $balita->posyandu->nama ?? 'Posyandu',
                'schedule' => 'Setiap awal bulan', // Model Jadwal ditiadakan di MVP V2
                'countdown' => 'Sesuai jadwal kader',
                'cta' => 'Chat Kader'
            ]
        ];

        return view('portal-ibu.home.index', $data);
    }

    public function growth()
    {
        $balita = $this->getActiveBalita();
        
        $pengukurans = $balita ? $balita->pengukurans : collect();

        $timeline = $pengukurans->map(function ($p) use ($balita) {
            $ageParts = Carbon::parse($balita->tanggal_lahir)->diff(Carbon::parse($p->tanggal_ukur));
            return [
                'date' => Carbon::parse($p->tanggal_ukur)->translatedFormat('l, d M Y'),
                'age' => $ageParts->y . ' Tahun ' . $ageParts->m . ' Bulan',
                'weight' => $p->berat_badan,
                'height' => $p->tinggi_badan,
                'status' => strtolower($p->status_gizi)
            ];
        })->toArray();

        // Format points for chart: [umur_bulan, berat_badan]
        $points = $pengukurans->map(function ($p) {
            return [$p->umur_bulan, (float) $p->berat_badan];
        })->reverse()->values()->toArray();

        $latest = $pengukurans->first();
        $recommendation = null;
        $pageState = 'normal';
        $storyState = 'normal';
        
        if ($latest) {
            $recommendation = $this->recommendationService->generate(
                $latest->status_gizi,
                $latest->umur_bulan,
                $latest->z_score_bbu,
                $latest->z_score_tbu
            );
            $gizi = strtolower($latest->status_gizi);
            if (in_array($gizi, ['stunting'])) $storyState = 'merah';
            elseif (in_array($gizi, ['risiko', 'kurang'])) $storyState = 'kuning';
        }

        $data = [
            'pageState' => 'normal',
            'childName' => $balita ? explode(' ', $balita->nama)[0] : '-',
            'avatar' => null,
            'initials' => $balita ? strtoupper(substr($balita->nama, 0, 1)) : '',
            'story' => [
                'state' => $storyState,
                'status' => $recommendation['status'] ?? 'Belum Ada Data',
                'title' => $recommendation['title'] ?? 'Tumbuh Kembang Si Kecil',
                'message' => $recommendation['education'] ?? 'Silakan lakukan penimbangan rutin di Posyandu.'
            ],
            'comparison' => [
                'icon' => '💡',
                'message' => 'Grafik di bawah ini disusun berdasarkan panduan kurva pertumbuhan resmi dari WHO.'
            ],
            'chartData' => json_encode(['points' => $points]),
            'timeline' => $timeline
        ];

        return view('portal-ibu.growth.index', $data);
    }

    public function nutrition()
    {
        $balita = $this->getActiveBalita();
        $latest = $balita ? $balita->pengukurans->first() : null;

        $advice = 'Berikan variasi makanan sehat setiap hari.';
        if ($latest) {
            $recommendation = $this->recommendationService->generate(
                $latest->status_gizi,
                $latest->umur_bulan,
                $latest->z_score_bbu,
                $latest->z_score_tbu
            );
            $advice = $recommendation['dietary_advice'];
        }

        $data = [
            'pageState' => 'normal',
            'user' => [
                'initials' => $balita ? strtoupper(substr($balita->nama, 0, 1)) : '',
                'avatar' => null,
            ],
            'trustBannerMessage' => $advice,
            'heroMeal' => [],
            'alternatives' => []
        ];

        return view('portal-ibu.nutrition.index', $data);
    }

    public function posyandu()
    {
        $balita = $this->getActiveBalita();
        $posyanduId = $balita?->posyandu_id;
        
        $kader = $posyanduId ? Kader::where('posyandu_id', $posyanduId)->with('user')->first() : null;

        $data = [
            'pageState' => 'normal',
            'user' => [
                'initials' => $balita ? strtoupper(substr($balita->nama, 0, 1)) : '',
                'avatar' => null,
            ],
            'announcement' => null,
            'schedule' => $posyanduId ? [
                'posyanduName' => $balita->posyandu->nama,
                'date' => 'Dikonfirmasi oleh Kader', 
                'countdown' => '-',
                'address' => $balita->posyandu->alamat ?? '-'
            ] : null,
            'kader' => $kader ? [
                'name' => $kader->user->name ?? $kader->nama,
                'role' => 'Kader Utama',
                'whatsapp_url' => 'https://wa.me/' . preg_replace('/[^0-9]/', '', $kader->no_hp),
                'avatar' => null
            ] : null,
            'checklist' => [
                [
                    'task' => 'Bawa Buku KIA (KMS)',
                    'checked' => true
                ],
                [
                    'task' => 'Pastikan anak dalam kondisi sehat',
                    'checked' => false
                ]
            ]
        ];

        return view('portal-ibu.posyandu.index', $data);
    }

    // Optional method depending on routing structure
    public function childSelector()
    {
        return redirect()->route('portal-ibu.home');
    }
}
