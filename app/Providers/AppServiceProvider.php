<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengukuran;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }

        // Share notification data for Kader to Navbar & Layout
        View::composer(['components.navbar', 'layouts.app', 'layouts.puskesmas'], function ($view) {
            $user = Auth::user();
            $revisiList = collect();
            $revisiCount = 0;

            if ($user && $user->role === 'kader') {
                $posyanduId = $user->kader?->posyandu_id;
                if ($posyanduId) {
                    // Query balitas whose LATEST measurement is currently 'rejected'
                    // When kader remeasures/updates the child, the latest status becomes 'pending', so it automatically disappears from notifications.
                    $balitas = \App\Models\Balita::where('posyandu_id', $posyanduId)
                        ->with(['latestPengukuran'])
                        ->get()
                        ->filter(function ($b) {
                            return $b->latestPengukuran && $b->latestPengukuran->status_validasi === 'rejected';
                        });

                    $revisiList = $balitas->map(function ($b) {
                        $p = $b->latestPengukuran;
                        $tgl = $p->tanggal_ukur ? Carbon::parse($p->tanggal_ukur)->translatedFormat('d M Y') : '-';
                        return [
                            'id' => $p->id,
                            'balita_id' => $b->id,
                            'balita_nama' => $b->nama ?? 'Balita',
                            'balita_nik' => $b->nik ?? '-',
                            'tanggal' => $tgl,
                            'bb' => $p->berat_badan ? number_format($p->berat_badan, 1, ',', '.') : '-',
                            'tb' => $p->tinggi_badan ? number_format($p->tinggi_badan, 1, ',', '.') : '-',
                            'catatan' => $p->catatan_validator ?: 'Data pengukuran perlu diperbaiki atau ditimbang ulang oleh kader sesuai arahan Puskesmas.',
                            'updated_diff' => $p->updated_at ? $p->updated_at->diffForHumans() : '',
                        ];
                    })->values();

                    $revisiCount = $revisiList->count();
                }
            }

            $view->with([
                'revisiNotifs' => $revisiList,
                'revisiNotifsCount' => $revisiCount,
            ]);
        });
    }
}