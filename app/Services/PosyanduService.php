<?php

namespace App\Services;

use App\Models\Balita;
use App\Models\Jadwal;
use App\Models\Posyandu;
use Carbon\Carbon;

class PosyanduService
{
    /**
     * Get the upcoming Posyandu schedule for a Balita.
     */
    public function getUpcomingSchedule(Balita $balita): ?array
    {
        $posyandu = $balita->pengukurans()->latest()->first()?->posyandu;
        
        if (!$posyandu) {
            return null;
        }

        $jadwal = $posyandu->jadwals()->where('tanggal', '>=', Carbon::now()->format('Y-m-d'))->orderBy('tanggal', 'asc')->first();
        
        if (!$jadwal) {
            return null;
        }

        $days = Carbon::now()->diffInDays(Carbon::parse($jadwal->tanggal), false);

        return [
            'posyanduName' => $posyandu->nama,
            'date' => Carbon::parse($jadwal->tanggal)->translatedFormat('l, d M Y'),
            'countdown' => $days > 0 ? $days . ' Hari Lagi' : 'Hari Ini',
            'address' => $jadwal->lokasi,
            'keterangan' => $jadwal->keterangan
        ];
    }

    /**
     * Get Kader details for the Posyandu.
     */
    public function getKaderDetails(Balita $balita): ?array
    {
        $posyandu = $balita->pengukurans()->latest()->first()?->posyandu;
        
        if (!$posyandu) {
            return null;
        }

        $kader = $posyandu->kaders()->where('status_aktif', true)->first();
        
        if (!$kader || !$kader->user) {
            return null;
        }

        return [
            'name' => $kader->user->name,
            'role' => 'Kader Utama',
            'whatsapp_url' => 'https://wa.me/' . preg_replace('/[^0-9]/', '', $kader->no_hp_wa),
            'avatar' => null
        ];
    }

    /**
     * Get the preparation checklist for the mother.
     */
    public function getChecklist(Balita $balita): array
    {
        return [
            [
                'task' => 'Bawa Buku KIA (KMS)',
                'checked' => true
            ],
            [
                'task' => 'Pastikan anak dalam kondisi sehat',
                'checked' => false
            ],
            [
                'task' => 'Datang tepat waktu',
                'checked' => false
            ]
        ];
    }
}
