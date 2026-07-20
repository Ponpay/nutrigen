<?php

namespace App\Services;

use App\Models\PetugasPuskesmas;
use App\Models\Pengukuran;
use App\Models\Validasi;
use App\Models\Balita;
use App\Models\Posyandu;
use Carbon\Carbon;

class PuskesmasService
{
    /**
     * Get aggregate stats for the Puskesmas dashboard.
     */
    public function getDashboardStats(PetugasPuskesmas $petugas): array
    {
        $puskesmasId = $petugas->puskesmas_id;
        
        $pendingTotal = Validasi::where('status_validasi', 'pending')
            ->whereHas('pengukuran.posyandu', function($q) use ($puskesmasId) {
                $q->where('puskesmas_id', $puskesmasId);
            })->count();

        // In a real scenario, anomali is calculated based on z-score dropping significantly
        $pendingAnomali = Validasi::where('status_validasi', 'pending')
            ->whereHas('pengukuran', function($q) {
                $q->where('status_gizi', 'Kurang')->orWhere('status_stunting', 'Stunting');
            })
            ->whereHas('pengukuran.posyandu', function($q) use ($puskesmasId) {
                $q->where('puskesmas_id', $puskesmasId);
            })->count();

        $totalBalita = Balita::whereHas('pengukurans.posyandu', function($q) use ($puskesmasId) {
            $q->where('puskesmas_id', $puskesmasId);
        })->distinct('id')->count();

        $diukur = Pengukuran::whereHas('posyandu', function($q) use ($puskesmasId) {
            $q->where('puskesmas_id', $puskesmasId);
        })->whereMonth('tanggal_ukur', Carbon::now()->month)->count();

        $valid = Validasi::where('status_validasi', 'valid')
            ->whereHas('pengukuran.posyandu', function($q) use ($puskesmasId) {
                $q->where('puskesmas_id', $puskesmasId);
            })->whereMonth('waktu_validasi', Carbon::now()->month)->count();

        return [
            'user_name'        => $petugas->user->name . ' (' . $petugas->jabatan . ')',
            'pending_total'    => $pendingTotal,
            'pending_anomali'  => $pendingAnomali,
            'pending_berisiko' => 0, // Placeholder
            'total_balita'     => $totalBalita,
            'diukur'           => $diukur,
            'valid'            => $valid,
            'pending'          => $pendingTotal,
            'current_month'    => Carbon::now()->translatedFormat('F Y'),
        ];
    }

    /**
     * Get status distribution for the current month.
     */
    public function getDashboardDistribution(PetugasPuskesmas $petugas): array
    {
        $puskesmasId = $petugas->puskesmas_id;
        
        $normal = Pengukuran::where('status_stunting', 'Normal')
            ->whereHas('posyandu', function($q) use ($puskesmasId) {
                $q->where('puskesmas_id', $puskesmasId);
            })->whereMonth('tanggal_ukur', Carbon::now()->month)->count();

        $berisiko = Pengukuran::where('status_stunting', 'Stunting')
            ->whereHas('posyandu', function($q) use ($puskesmasId) {
                $q->where('puskesmas_id', $puskesmasId);
            })->whereMonth('tanggal_ukur', Carbon::now()->month)->count();

        $perhatian = Pengukuran::where('status_gizi', 'Kurang')
            ->whereHas('posyandu', function($q) use ($puskesmasId) {
                $q->where('puskesmas_id', $puskesmasId);
            })->whereMonth('tanggal_ukur', Carbon::now()->month)->count();

        $total = $normal + $berisiko + $perhatian;
        
        return [
            'normal'           => ['count' => $normal, 'percentage' => $total > 0 ? round(($normal / $total) * 100) : 0],
            'perlu_perhatian'  => ['count' => $perhatian, 'percentage' => $total > 0 ? round(($perhatian / $total) * 100) : 0],
            'berisiko'         => ['count' => $berisiko, 'percentage' => $total > 0 ? round(($berisiko / $total) * 100) : 0],
            'total_diukur'     => $total,
        ];
    }
}
