<?php

namespace App\Services\Kader;

use App\Models\Kader;
use App\Models\Balita;
use App\Models\Jadwal;
use App\Models\Pengukuran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class KaderService
{
    /**
     * Get the authenticated Kader.
     */
    protected function getKader(): Kader
    {
        // Assuming Auth::user() is a user with role 'kader' and has one Kader profile
        return Auth::user()->kader()->with('posyandu')->firstOrFail();
    }

    public function getDashboardData(): array
    {
        $kader = $this->getKader();
        $posyandu = $kader->posyandu;

        // Stat Total: All Balita in this Posyandu's scope
        // Note: As per architecture, balitas belong to ibu. 
        // We can count Balitas that have been measured here, OR all balitas whose Ibu lives in this Posyandu area.
        // For MVP, we count Balitas who have at least one pengukuran at this posyandu.
        $statTotal = Balita::whereHas('pengukurans', function($q) use ($posyandu) {
            $q->where('posyandu_id', $posyandu->id);
        })->count();

        // Stat Ikut: Balita measured this month
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        
        $statIkut = Pengukuran::where('posyandu_id', $posyandu->id)
            ->whereMonth('tanggal_ukur', $currentMonth)
            ->whereYear('tanggal_ukur', $currentYear)
            ->distinct('balita_id')
            ->count('balita_id');

        // Stat Perlu: Balita with stunting status "Pendek" or "Sangat Pendek", or missing measurement this month
        // We will just query Balita with bad stunting status from their latest measurement
        $priorityBalitas = Balita::whereHas('pengukurans', function($q) use ($posyandu) {
            $q->where('posyandu_id', $posyandu->id)
              ->whereIn('status_stunting', ['Pendek', 'Sangat Pendek']);
        })->with(['pengukurans' => function($q) use ($posyandu) {
            $q->where('posyandu_id', $posyandu->id)->latest('tanggal_ukur');
        }])->take(3)->get();

        $statPerlu = $priorityBalitas->count(); // In real app, this might be a separate broader count

        $priorityChildren = $priorityBalitas->map(function ($balita) {
            $latest = $balita->pengukurans->first();
            $age = Carbon::parse($balita->tanggal_lahir)->diff(Carbon::now());
            return (object) [
                'id' => $balita->id,
                'name' => $balita->nama,
                'avatar' => null,
                'age' => $age->y . ' Tahun ' . $age->m . ' Bulan',
                'status' => $latest->status_stunting,
                'statusType' => $latest->status_stunting == 'Sangat Pendek' ? 'danger' : 'warning',
            ];
        })->toArray();

        // Today's Activity (Next Jadwal)
        $nextJadwal = Jadwal::where('posyandu_id', $posyandu->id)
            ->where('tanggal', '>=', Carbon::now()->format('Y-m-d'))
            ->orderBy('tanggal', 'asc')
            ->first();

        return [
            'kaderName' => explode(' ', Auth::user()->name)[0],
            'statTotal' => $statTotal ?: 0,
            'statIkut' => $statIkut ?: 0,
            'statPerlu' => $statPerlu ?: 0,
            'priorityChildren' => $priorityChildren,
            'activityName' => $nextJadwal ? $nextJadwal->judul : 'Tidak ada jadwal terdekat',
            'activityTime' => $nextJadwal ? Carbon::parse($nextJadwal->waktu_mulai)->format('H.i') . ' - ' . Carbon::parse($nextJadwal->waktu_selesai)->format('H.i') : '-',
            'activityLocation' => $posyandu->nama,
            'activityAddress' => $nextJadwal ? $nextJadwal->lokasi : $posyandu->alamat,
        ];
    }

    public function getDaftarBalitaData(): array
    {
        $kader = $this->getKader();
        
        $balitas = Balita::whereHas('pengukurans', function($q) use ($kader) {
            $q->where('posyandu_id', $kader->posyandu_id);
        })->with(['ibu', 'pengukurans' => function($q) {
            $q->latest('tanggal_ukur');
        }])->get();

        $formattedBalitas = $balitas->map(function($balita) {
            $latest = $balita->pengukurans->first();
            $age = Carbon::parse($balita->tanggal_lahir)->diff(Carbon::now());
            return (object) [
                'id' => $balita->id,
                'name' => $balita->nama,
                'age' => $age->y . ' Thn ' . $age->m . ' Bln',
                'ibu' => $balita->ibu->nama,
                'status' => $latest ? $latest->status_stunting : 'Belum Ada',
                'avatar' => null
            ];
        });

        return [
            'balitas' => $formattedBalitas
        ];
    }

    public function getJadwalData(): array
    {
        $kader = $this->getKader();
        $posyandu = $kader->posyandu;

        $jadwals = Jadwal::where('posyandu_id', $posyandu->id)
            ->withCount('pengukurans')
            ->orderBy('tanggal', 'desc')
            ->get();

        $formattedJadwals = $jadwals->map(function($jadwal) {
            return (object) [
                'id' => $jadwal->id,
                'title' => $jadwal->judul,
                'date' => Carbon::parse($jadwal->tanggal)->translatedFormat('d M Y'),
                'time' => Carbon::parse($jadwal->waktu_mulai)->format('H:i') . ' - ' . Carbon::parse($jadwal->waktu_selesai)->format('H:i'),
                'location' => $jadwal->lokasi,
                'participants' => $jadwal->pengukurans_count
            ];
        });

        return [
            'posyanduName' => $posyandu->nama,
            'jadwals' => $formattedJadwals
        ];
    }
}
