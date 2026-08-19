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
                    $revisiList = Pengukuran::with('balita')
                        ->whereHas('balita', function ($q) use ($posyanduId) {
                            $q->where('posyandu_id', $posyanduId);
                        })
                        ->where('status_validasi', 'rejected')
                        ->latest('updated_at')
                        ->take(8)
                        ->get()
                        ->map(function ($p) {
                            $tgl = $p->tanggal_ukur ? Carbon::parse($p->tanggal_ukur)->translatedFormat('d M Y') : '-';
                            return [
                                'id' => $p->id,
                                'balita_id' => $p->balita_id,
                                'balita_nama' => $p->balita->nama ?? 'Balita',
                                'balita_nik' => $p->balita->nik ?? '-',
                                'tanggal' => $tgl,
                                'bb' => $p->berat_badan ? number_format($p->berat_badan, 1, ',', '.') : '-',
                                'tb' => $p->tinggi_badan ? number_format($p->tinggi_badan, 1, ',', '.') : '-',
                                'catatan' => $p->catatan_validator ?: 'Data pengukuran perlu diperbaiki atau ditimbang ulang oleh kader sesuai arahan Puskesmas.',
                                'updated_diff' => $p->updated_at ? $p->updated_at->diffForHumans() : '',
                            ];
                        });
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