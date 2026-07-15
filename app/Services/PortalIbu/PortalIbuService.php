<?php

namespace App\Services\PortalIbu;

class PortalIbuService
{
    protected function getIbu(): ?\App\Models\Ibu
    {
        return request()->authenticated_ibu;
    }

    public function getChildSelectorData(): array
    {
        $ibu = $this->getIbu();
        $balitas = $ibu->balitas()->with(['pengukurans' => function($q) {
            $q->latest('tanggal_ukur');
        }])->get();

        $children = $balitas->map(function ($balita) {
            $latestPengukuran = $balita->pengukurans->first();
            $status = $latestPengukuran ? 'Diukur pada ' . $latestPengukuran->tanggal_ukur->format('d M Y') : 'Belum ada data pengukuran';
            
            return [
                'id' => $balita->id,
                'name' => $balita->nama,
                'initials' => strtoupper(substr($balita->nama, 0, 1)),
                'avatar' => null,
                'age' => \Carbon\Carbon::parse($balita->tanggal_lahir)->diff(\Carbon\Carbon::now())->format('%y Tahun %m Bulan'),
                'status' => $status
            ];
        })->toArray();

        return [
            'pageState' => 'normal',
            'greeting' => 'Selamat pagi, Bunda ' . explode(' ', $ibu->nama)[0],
            'children' => $children
        ];
    }

    public function getHomeData(): array
    {
        $ibu = $this->getIbu();
        // MVP: Assume 1 Balita per Ibu
        $balita = $ibu->balitas()->first();
        
        if (!$balita) {
            return ['pageState' => 'empty']; // Or handle appropriately
        }

        $latestPengukuran = $balita->pengukurans()->latest('tanggal_ukur')->first();
        $previousPengukuran = $balita->pengukurans()->latest('tanggal_ukur')->skip(1)->first();

        // Calculate delta
        $deltaWeight = '';
        $deltaHeight = '';
        if ($latestPengukuran && $previousPengukuran) {
            $diffWeight = $latestPengukuran->berat_badan - $previousPengukuran->berat_badan;
            $diffHeight = $latestPengukuran->tinggi_badan - $previousPengukuran->tinggi_badan;
            $deltaWeight = ($diffWeight >= 0 ? 'Naik ' : 'Turun ') . abs(round($diffWeight * 1000)) . 'g';
            $deltaHeight = ($diffHeight >= 0 ? 'Naik ' : 'Turun ') . abs($diffHeight) . 'cm';
        }

        $nextJadwal = \App\Models\Jadwal::where('tanggal', '>=', now())
            ->orderBy('tanggal', 'asc')
            ->first();

        $countdown = $nextJadwal ? \Carbon\Carbon::parse($nextJadwal->tanggal)->diffForHumans(['parts' => 2]) : 'Belum ada jadwal';

        return [
            'pageState' => 'normal',
            'user' => [
                'child_name' => $balita->nama,
                'avatar' => null,
            ],
            'summary' => [
                'icon' => '🥰',
                'title' => 'Pertumbuhan Hebat!',
                'message' => 'Semua pencapaian di jalur yang benar.'
            ],
            'measurement' => $latestPengukuran ? [
                'date' => $latestPengukuran->tanggal_ukur->format('d M Y'),
                'weight' => $latestPengukuran->berat_badan,
                'height' => $latestPengukuran->tinggi_badan
            ] : [
                'date' => '-',
                'weight' => '-',
                'height' => '-'
            ],
            'delta' => [
                'weight' => $deltaWeight ?: '-',
                'height' => $deltaHeight ?: '-'
            ],
            'recommendation' => [
                'message' => 'Protein hewani sangat baik untuk pertumbuhannya.',
                'cta' => 'Lihat Menu Hari Ini'
            ],
            'posyandu' => $nextJadwal ? [
                'name' => $nextJadwal->posyandu->nama,
                'schedule' => \Carbon\Carbon::parse($nextJadwal->tanggal)->translatedFormat('l, d M Y'),
                'countdown' => $countdown,
                'cta' => 'Chat Kader'
            ] : null
        ];
    }

    public function getGrowthData(): array
    {
        $ibu = $this->getIbu();
        $balita = $ibu->balitas()->first();
        
        $pengukurans = $balita ? $balita->pengukurans()->orderBy('tanggal_ukur', 'desc')->get() : collect();

        $timeline = $pengukurans->map(function ($p) use ($balita) {
            $ageParts = \Carbon\Carbon::parse($balita->tanggal_lahir)->diff(\Carbon\Carbon::parse($p->tanggal_ukur));
            return [
                'date' => $p->tanggal_ukur->translatedFormat('l, d M Y'),
                'age' => $ageParts->y . ' Tahun ' . $ageParts->m . ' Bulan',
                'weight' => $p->berat_badan,
                'height' => $p->tinggi_badan,
                'status' => strtolower($p->status_gizi)
            ];
        })->toArray();

        // Format points for chart: [umur_bulan, berat_badan]
        $points = $pengukurans->map(function ($p) use ($balita) {
            $months = \Carbon\Carbon::parse($balita->tanggal_lahir)->diffInMonths(\Carbon\Carbon::parse($p->tanggal_ukur));
            return [$months, (float)$p->berat_badan];
        })->reverse()->values()->toArray();

        return [
            'pageState' => 'normal',
            'childName' => $balita ? explode(' ', $balita->nama)[0] : '-',
            'avatar' => null,
            'initials' => $balita ? strtoupper(substr($balita->nama, 0, 1)) : '',
            'story' => [
                'state' => 'normal',
                'icon' => '🌟',
                'title' => 'Luar Biasa!',
                'message' => 'Grafik pertumbuhan anak sangat stabil mengikuti kurva hijau.'
            ],
            'comparison' => [
                'icon' => '🏆',
                'message' => $balita ? $balita->nama . ' lebih tinggi dari 80% anak seusianya!' : '-'
            ],
            'chartData' => json_encode(['points' => $points]),
            'timeline' => $timeline
        ];
    }

    public function getNutritionData(): array
    {
        $ibu = $this->getIbu();
        $balita = $ibu->balitas()->first();
        
        return [
            'pageState' => 'normal',
            'user' => [
                'initials' => $balita ? strtoupper(substr($balita->nama, 0, 1)) : '',
                'avatar' => null,
            ],
            'trustBannerMessage' => 'Berdasarkan hasil ukur terakhir, sistem memilihkan menu tinggi protein untuk menjaga tren positif.',
            'heroMeal' => [
                'image' => '',
                'title' => 'Sup Ayam Makaroni Sayur',
                'calories' => '350 Kkal',
                'duration' => '30 Menit'
            ],
            'alternatives' => [
                [
                    'image' => '',
                    'title' => 'Nugget Ayam Wortel',
                    'calories' => '320 Kkal'
                ],
                [
                    'image' => '',
                    'title' => 'Omelet Bayam Keju',
                    'calories' => '280 Kkal'
                ]
            ]
        ];
    }

    public function getPosyanduData(): array
    {
        $ibu = $this->getIbu();
        $balita = $ibu->balitas()->first();
        
        // Find next Jadwal
        $nextJadwal = \App\Models\Jadwal::where('tanggal', '>=', now())
            ->orderBy('tanggal', 'asc')
            ->first();

        // Get Kader from that Posyandu
        $kader = $nextJadwal ? \App\Models\Kader::where('posyandu_id', $nextJadwal->posyandu_id)->first() : null;

        return [
            'pageState' => 'normal',
            'user' => [
                'initials' => $balita ? strtoupper(substr($balita->nama, 0, 1)) : '',
                'avatar' => null,
            ],
            'announcement' => null,
            'schedule' => $nextJadwal ? [
                'posyanduName' => $nextJadwal->posyandu->nama,
                'date' => \Carbon\Carbon::parse($nextJadwal->tanggal)->translatedFormat('l, d M Y'),
                'countdown' => \Carbon\Carbon::parse($nextJadwal->tanggal)->diffForHumans(['parts' => 2]),
                'address' => $nextJadwal->lokasi ?? $nextJadwal->posyandu->alamat
            ] : null,
            'kader' => $kader ? [
                'name' => $kader->user->name,
                'role' => 'Kader Utama',
                'whatsapp_url' => 'https://wa.me/' . preg_replace('/[^0-9]/', '', $kader->no_hp_wa),
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
    }
}
