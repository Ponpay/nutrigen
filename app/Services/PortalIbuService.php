<?php

namespace App\Services;

use App\Models\Ibu;
use App\Models\Balita;
use Carbon\Carbon;

class PortalIbuService
{
    /**
     * Get the active Balita for the given Ibu.
     * In MVP, assuming 1 Ibu = 1 active Balita.
     */
    public function getActiveBalita(Ibu $ibu): ?Balita
    {
        return $ibu->balitas()->where('status_aktif', true)->first();
    }

    /**
     * Generate dashboard delta stats (Weight & Height).
     */
    public function getGrowthDelta(Balita $balita): array
    {
        // Get the last two measurements
        $measurements = $balita->pengukurans()->orderBy('tanggal_ukur', 'desc')->take(2)->get();
        
        if ($measurements->count() < 2) {
            return [
                'weight' => 'Data awal',
                'height' => 'Data awal',
                'status' => 'normal'
            ];
        }

        $latest = $measurements[0];
        $previous = $measurements[1];

        $weightDiff = $latest->berat_badan - $previous->berat_badan;
        $heightDiff = $latest->tinggi_badan - $previous->tinggi_badan;

        // Determine visual state ('hijau' vs 'merah') based on weight drop
        $status = $weightDiff < 0 ? 'merah' : 'normal';

        $weightText = $weightDiff < 0 
            ? 'Turun ' . abs(round($weightDiff * 1000)) . 'g' 
            : 'Naik ' . round($weightDiff * 1000) . 'g';
            
        $heightText = $heightDiff < 0 
            ? 'Turun ' . abs($heightDiff) . 'cm' 
            : 'Naik ' . $heightDiff . 'cm';

        return [
            'weight' => $weightText,
            'height' => $heightText,
            'status' => $status
        ];
    }

    /**
     * Get the upcoming Posyandu schedule.
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
            'countdown' => 'H-' . $days,
            'schedule' => Carbon::parse($jadwal->tanggal)->translatedFormat('l, d M Y'),
            'address' => $jadwal->lokasi,
            'cta' => 'Chat Kader (' . ($posyandu->kaders()->first()->user->name ?? 'Kader') . ')'
        ];
    }
}
