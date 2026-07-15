<?php

namespace App\Http\Controllers\Puskesmas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * PuskesmasController
 *
 * Phase 9 — Backend Bootstrap.
 * Semua method me-return dummy DTO langsung. Tidak ada database query.
 * Seluruh dummy data ini akan digantikan oleh PuskesmasService setelah
 * database dan Eloquent Models siap (Backend Developer: Bintang).
 *
 * Backend Contract: docs/06_FRONTEND_BACKEND_CONTRACT.md (Bagian II)
 */
class PuskesmasController extends Controller
{
    protected \App\Services\Puskesmas\PuskesmasService $puskesmasService;

    public function __construct(\App\Services\Puskesmas\PuskesmasService $puskesmasService)
    {
        $this->puskesmasService = $puskesmasService;
    }

    public function dashboard()
    {
        $data = $this->puskesmasService->getDashboardData();
        return view('puskesmas.dashboard', $data);
    }

    public function validasi(Request $request)
    {
        $filters = [
            'tab'         => $request->input('tab', 'pending'),
            'posyandu_id' => $request->input('posyandu_id', ''),
        ];
        
        $data = $this->puskesmasService->getValidasiData($filters);
        return view('puskesmas.validasi', $data);
    }

    public function balita(Request $request)
    {
        $filters = [
            'q'           => $request->input('q', ''),
            'posyandu_id' => $request->input('posyandu_id', ''),
            'status_gizi' => $request->input('status_gizi', ''),
        ];

        $data = $this->puskesmasService->getBalitaData($filters);
        return view('puskesmas.balita', $data);
    }

    public function posyandu(Request $request)
    {
        $filters = [
            'q' => $request->input('q', ''),
        ];

        $data = $this->puskesmasService->getPosyanduData($filters, $request->input('id'));
        return view('puskesmas.posyandu', $data);
    }

    public function laporan(Request $request)
    {
        $filters = [
            'bulan'       => $request->input('bulan', date('m')),
            'tahun'       => $request->input('tahun', date('Y')),
            'posyandu_id' => $request->input('posyandu_id', 'semua'),
        ];

        $data = $this->puskesmasService->getLaporanData($filters);
        return view('puskesmas.laporan', $data);
    }

    public function pengaturan()
    {
        $data = $this->puskesmasService->getPengaturanData();
        return view('puskesmas.pengaturan', $data);
    }
}
