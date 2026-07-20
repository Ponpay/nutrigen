<?php

namespace App\Services;

use App\Models\Kader;
use App\Models\Pengukuran;
use App\Models\Balita;
use App\Models\Validasi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class KaderService
{
    /**
     * Submit a new measurement from a Kader.
     */
    public function submitMeasurement(Kader $kader, array $data): Pengukuran
    {
        return DB::transaction(function () use ($kader, $data) {
            $pengukuran = Pengukuran::create([
                'balita_id' => $data['balita_id'],
                'kader_id' => $kader->id,
                'posyandu_id' => $kader->posyandu_id,
                'tanggal_ukur' => $data['tanggal_ukur'] ?? Carbon::now()->format('Y-m-d'),
                'berat_badan' => $data['berat_badan'],
                'tinggi_badan' => $data['tinggi_badan'],
                'lingkar_kepala' => $data['lingkar_kepala'] ?? null,
                'status_stunting' => $data['status_stunting'] ?? 'Normal', // Normally calculated via z-score
                'status_gizi' => $data['status_gizi'] ?? 'Baik', // Normally calculated via z-score
                'catatan_kader' => $data['catatan_kader'] ?? null
            ]);

            // Queue for validation by Puskesmas
            Validasi::create([
                'pengukuran_id' => $pengukuran->id,
                'petugas_id' => null, // Not yet assigned
                'status_validasi' => 'pending',
                'catatan_petugas' => null,
                'waktu_validasi' => null
            ]);

            return $pengukuran;
        });
    }

    /**
     * Get list of Balita for the Kader's Posyandu.
     */
    public function getBalitaList(Kader $kader): \Illuminate\Database\Eloquent\Collection
    {
        return Balita::whereHas('pengukurans', function($q) use ($kader) {
            $q->where('posyandu_id', $kader->posyandu_id);
        })->orWhere('status_aktif', true)->get();
    }
}
