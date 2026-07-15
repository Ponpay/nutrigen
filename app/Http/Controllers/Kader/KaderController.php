<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * KaderController
 *
 * Pre-Freeze Sprint.
 * Menampilkan view Blade Kader dengan dummy data.
 * Backend Integration belum dilakukan.
 */
class KaderController extends Controller
{
    protected \App\Services\Kader\KaderService $kaderService;

    public function __construct(\App\Services\Kader\KaderService $kaderService)
    {
        $this->kaderService = $kaderService;
    }

    public function dashboard()
    {
        $data = $this->kaderService->getDashboardData();
        return view('kader.dashboard', $data);
    }

    public function daftarBalita()
    {
        $data = $this->kaderService->getDaftarBalitaData();
        return view('kader.daftar-balita', $data);
    }

    public function createBalita()
    {
        return view('kader.daftar-balita-baru');
    }

    public function profilBalita($id)
    {
        return view('kader.profil-balita');
    }

    public function jadwal()
    {
        $data = $this->kaderService->getJadwalData();
        return view('kader.jadwal', $data);
    }

    public function tambahJadwal()
    {
        return view('kader.tambah-jadwal');
    }

    public function detailJadwal($id)
    {
        return view('kader.detail-jadwal');
    }

    public function laporan()
    {
        return view('kader.laporan');
    }

    public function profilKader()
    {
        return view('kader.profil-kader');
    }
}
