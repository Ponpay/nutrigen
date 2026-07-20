<?php

namespace App\Services;

use App\Models\Balita;

class GrowthService
{
    /**
     * Get the weight and height delta between the last two measurements.
     */
    public function getDelta(Balita $balita): array
    {
        $measurements = $balita->pengukurans()->orderBy('tanggal_ukur', 'desc')->take(2)->get();
        
        if ($measurements->count() < 2) {
            return [
                'weight' => 'Data awal',
                'height' => 'Data awal',
                'status' => 'normal',
                'weight_diff' => 0,
                'height_diff' => 0
            ];
        }

        $latest = $measurements[0];
        $previous = $measurements[1];

        $weightDiff = $latest->berat_badan - $previous->berat_badan;
        $heightDiff = $latest->tinggi_badan - $previous->tinggi_badan;

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
            'status' => $status,
            'weight_diff' => $weightDiff,
            'height_diff' => $heightDiff
        ];
    }

    /**
     * Get historical measurements for the growth chart.
     */
    public function getChartData(Balita $balita): array
    {
        $measurements = $balita->pengukurans()->orderBy('tanggal_ukur', 'asc')->get();
        
        $points = [];
        foreach ($measurements as $index => $m) {
            $points[] = [$index + 1, (float)$m->berat_badan];
        }

        return ['points' => $points];
    }

    /**
     * Get the timeline of measurements for the growth page.
     */
    public function getTimeline(Balita $balita): array
    {
        $measurements = $balita->pengukurans()->orderBy('tanggal_ukur', 'desc')->get();
        
        $timeline = [];
        foreach ($measurements as $m) {
            $date = \Carbon\Carbon::parse($m->tanggal_ukur);
            $birthDate = \Carbon\Carbon::parse($balita->tanggal_lahir);
            
            $months = $birthDate->diffInMonths($date);
            $years = floor($months / 12);
            $remainingMonths = $months % 12;
            
            $ageString = $years > 0 ? "{$years} Tahun {$remainingMonths} Bulan" : "{$months} Bulan";
            
            $timeline[] = [
                'date' => $date->translatedFormat('l, d M Y'),
                'age' => $ageString,
                'weight' => $m->berat_badan,
                'height' => $m->tinggi_badan,
                'status' => strtolower($m->status_stunting) === 'normal' ? 'normal' : 'merah'
            ];
        }

        return $timeline;
    }
}
