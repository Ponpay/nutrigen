@extends('layouts.puskesmas')
@section('page-title', 'Dashboard')
@section('content')

@php
    $hour = date('H');
    $greeting = 'Selamat Pagi';
    if ($hour >= 12 && $hour < 15) $greeting = 'Selamat Siang';
    elseif ($hour >= 15 && $hour < 18) $greeting = 'Selamat Sore';
    elseif ($hour >= 18) $greeting = 'Selamat Malam';

    // SVG Donut Chart Normalization
    $p_normal = $distribution['normal']['percentage'];
    $p_perhatian = $distribution['perlu_perhatian']['percentage'];
    $p_berisiko = $distribution['berisiko']['percentage'];

    $total_p = $p_normal + $p_perhatian + $p_berisiko;
    if ($total_p > 0 && $total_p != 100) {
        $diff = 100 - $total_p;
        $max_p = max($p_normal, $p_perhatian, $p_berisiko);
        if ($max_p == $p_normal) $p_normal += $diff;
        elseif ($max_p == $p_perhatian) $p_perhatian += $diff;
        else $p_berisiko += $diff;
    }
@endphp

<div class="w-full max-w-7xl mx-auto pb-10">
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6 lg:gap-8">
        
        <!-- ==================== LEFT COLUMN (Col 8) ==================== -->
        <div class="xl:col-span-8 flex flex-col gap-6">
            
            <!-- 1. HEADER SECTION -->
            <div class="flex flex-col gap-1.5 pt-2">
                <h1 class="text-[26px] font-black text-slate-900 tracking-tight flex items-center gap-2">
                    {{ $greeting }}, {{ explode(' ', $stats['user_name'])[0] }} <span class="text-2xl">👋</span>
                </h1>
                <p class="text-[13px] font-medium text-slate-500">Pantau metrik dan kelola operasional posyandu secara real-time.</p>
            </div>

            <!-- 2. ALERT BANNER -->
            @if($stats['pending'] > 0)
            <div class="bg-rose-50/70 rounded-2xl border border-rose-100 p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-rose-500 text-white flex items-center justify-center shrink-0 shadow-sm shadow-rose-200">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-[15px] font-bold tracking-tight text-slate-900">Perhatian Diperlukan</h3>
                        <p class="text-[13px] font-medium text-slate-600 mt-0.5">Ada <span class="font-bold text-rose-600">{{ $stats['pending'] }} antrian pengukuran</span> yang menunggu validasi.</p>
                    </div>
                </div>
                <a href="{{ route('puskesmas.validasi') }}" class="shrink-0 px-4 py-2 bg-white text-rose-600 hover:bg-rose-50 border border-rose-200 font-bold text-[13px] rounded-lg transition-colors shadow-sm flex items-center gap-2">
                    Validasi Sekarang
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" /></svg>
                </a>
            </div>
            @else
            <div class="bg-emerald-50/70 rounded-2xl border border-emerald-100 p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-emerald-500 text-white flex items-center justify-center shrink-0 shadow-sm shadow-emerald-200">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-[15px] font-bold tracking-tight text-slate-900">Semua Data Tervalidasi</h3>
                        <p class="text-[13px] font-medium text-slate-600 mt-0.5">Tidak ada antrian pengukuran tertunda.</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- 3. KPI CARDS (4 Grid) -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                
                <!-- Total Balita -->
                <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] flex flex-col justify-between h-36">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-500 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" /></svg>
                        </div>
                        <div class="flex flex-col min-w-0">
                            <span class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wide leading-tight truncate">Total</span>
                            <span class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wide leading-tight truncate">Balita</span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <span class="text-[34px] font-black text-slate-800 leading-none tracking-tight">{{ number_format($stats['total_balita'], 0, ',', '.') }}</span>
                    </div>
                    <div class="mt-auto pt-2 flex items-center">
                        <span class="text-[10px] font-bold text-emerald-500 bg-emerald-50 px-1.5 py-0.5 rounded flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75L12 3m0 0l3.75 3.75M12 3v18" /></svg> Aktif</span>
                    </div>
                </div>

                <!-- Balita Diukur -->
                <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] flex flex-col justify-between h-36">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-500 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M7.5 5.25a3 3 0 013-3h3a3 3 0 013 3v.205c.933.085 1.857.197 2.774.334 1.454.218 2.476 1.483 2.476 2.917v3.033c0 1.211-.734 2.352-1.936 2.752A24.726 24.726 0 0112 15.75c-2.73 0-5.357-.442-7.814-1.259-1.202-.4-1.936-1.541-1.936-2.752V8.706c0-1.434 1.022-2.7 2.476-2.917A48.814 48.814 0 017.5 5.455V5.25zm7.5 0v.09a49.01 49.01 0 00-6 0v-.09a1.5 1.5 0 011.5-1.5h3a1.5 1.5 0 011.5 1.5zm-3 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" /></svg>
                        </div>
                        <div class="flex flex-col min-w-0">
                            <span class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wide leading-tight truncate">Balita</span>
                            <span class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wide leading-tight truncate">Diukur</span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <span class="text-[34px] font-black text-slate-800 leading-none tracking-tight">{{ number_format($stats['diukur'], 0, ',', '.') }}</span>
                    </div>
                    <div class="mt-auto pt-2 flex items-center">
                        <span class="text-[10px] font-bold text-slate-400">Bulan ini</span>
                    </div>
                </div>

                <!-- Menunggu Validasi -->
                <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] flex flex-col justify-between h-36">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-orange-50 text-orange-500 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd" /></svg>
                        </div>
                        <div class="flex flex-col min-w-0">
                            <span class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wide leading-tight truncate">Antrean</span>
                            <span class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wide leading-tight truncate">Validasi</span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <span class="text-[34px] font-black text-slate-800 leading-none tracking-tight">{{ number_format($stats['pending'], 0, ',', '.') }}</span>
                    </div>
                    <div class="mt-auto pt-2 flex items-center">
                        <span class="text-[10px] font-bold text-slate-400">Butuh aksi</span>
                    </div>
                </div>

                <!-- Data Terverifikasi -->
                <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] flex flex-col justify-between h-36">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-500 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" /></svg>
                        </div>
                        <div class="flex flex-col min-w-0">
                            <span class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wide leading-tight truncate">Data</span>
                            <span class="text-[11px] font-extrabold text-slate-400 uppercase tracking-wide leading-tight truncate">Terverifikasi</span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <span class="text-[34px] font-black text-slate-800 leading-none tracking-tight">{{ number_format($stats['valid'], 0, ',', '.') }}</span>
                    </div>
                    <div class="mt-auto pt-2 flex items-center">
                        <span class="text-[10px] font-bold text-slate-400">Bulan ini</span>
                    </div>
                </div>

            </div>

            <!-- 4. BOTTOM SPLIT (Aktivitas & Distribusi) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Aktivitas Posyandu -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] flex flex-col">
                    <div class="px-5 py-4 flex items-center justify-between border-b border-slate-50">
                        <div>
                            <h3 class="text-[14px] font-bold tracking-tight text-slate-900">Aktivitas Posyandu Terbaru</h3>
                            <p class="text-[11px] font-medium text-slate-500 mt-0.5">Pengukuran balita terbaru</p>
                        </div>
                        <a href="{{ route('puskesmas.balita') }}" class="text-[11px] font-bold text-emerald-600 hover:text-emerald-700">Lihat Semua</a>
                    </div>
                    <div class="flex flex-col p-2">
                        @forelse($recentActivities as $activity)
                        @php
                            $isValid = true; 
                            $initials = substr($activity->balita->nama ?? 'B', 0, 2);
                        @endphp
                        <div class="flex items-center justify-between px-4 py-3 hover:bg-slate-50 rounded-lg transition-colors group border-b border-slate-50 last:border-0">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center shrink-0 text-[10px] font-black uppercase shadow-sm">
                                    {{ $initials }}
                                </div>
                                <div class="flex flex-col">
                                    <p class="text-[13px] font-bold text-slate-800">{{ $activity->balita->nama ?? 'Tidak Diketahui' }}</p>
                                    <p class="text-[11px] font-medium text-slate-400 mt-0.5">{{ $activity->balita->posyandu->nama ?? 'Tidak Diketahui' }}</p>
                                </div>
                            </div>
                            <div class="flex flex-col items-end gap-1">
                                <span class="flex items-center gap-1 text-[9px] font-extrabold tracking-wider {{ $isValid ? 'text-emerald-500' : 'text-amber-500' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $isValid ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                                    {{ $isValid ? 'VALID' : 'PERHATIAN' }}
                                </span>
                                <span class="text-[10px] font-medium text-slate-400">{{ $activity->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        @empty
                        <div class="p-8 text-center text-slate-500 text-[12px] font-bold">
                            Belum ada aktivitas.
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Distribusi Status Gizi -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] p-6 flex flex-col">
                    <div class="mb-6">
                        <h3 class="text-[14px] font-bold tracking-tight text-slate-900">Distribusi Status Gizi</h3>
                        <p class="text-[11px] font-medium text-slate-500 mt-0.5">Data valid bulan {{ $stats['current_month'] }}</p>
                    </div>

                    <div class="flex items-center gap-6 mb-6">
                        <!-- Donut -->
                        <div class="relative w-28 h-28 shrink-0 flex items-center justify-center">
                            <svg viewBox="0 0 36 36" class="w-full h-full transform -rotate-90 drop-shadow-sm">
                                <!-- Normal -->
                                <path class="text-emerald-500" stroke-dasharray="{{ $p_normal }}, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="4"></path>
                                <!-- Perhatian -->
                                <path class="text-amber-500" stroke-dasharray="{{ $p_perhatian }}, 100" stroke-dashoffset="-{{ $p_normal }}" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="4"></path>
                                <!-- Berisiko -->
                                <path class="text-rose-500" stroke-dasharray="{{ $p_berisiko }}, 100" stroke-dashoffset="-{{ $p_normal + $p_perhatian }}" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="4"></path>
                            </svg>
                            <div class="absolute flex flex-col items-center justify-center">
                                <span class="text-3xl font-black text-slate-900 leading-none">{{ $distribution['total_diukur'] }}</span>
                                <span class="text-[10px] font-bold text-slate-400 uppercase mt-1">Total</span>
                            </div>
                        </div>

                        <!-- Legend -->
                        <div class="flex flex-col gap-3 w-full">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-2.5 h-2.5 rounded-full bg-emerald-500"></div>
                                    <span class="text-[12px] font-bold text-slate-700">Normal</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-[13px] font-black text-slate-900">{{ $distribution['normal']['count'] }}</span>
                                    <span class="text-[10px] font-bold text-emerald-600">{{ $distribution['normal']['percentage'] }}%</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-2.5 h-2.5 rounded-full bg-amber-500"></div>
                                    <span class="text-[12px] font-bold text-slate-700">Perhatian</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-[13px] font-black text-slate-900">{{ $distribution['perlu_perhatian']['count'] }}</span>
                                    <span class="text-[10px] font-bold text-amber-500">{{ $distribution['perlu_perhatian']['percentage'] }}%</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-2.5 h-2.5 rounded-full bg-rose-500"></div>
                                    <span class="text-[12px] font-bold text-slate-700">Berisiko</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-[13px] font-black text-slate-900">{{ $distribution['berisiko']['count'] }}</span>
                                    <span class="text-[10px] font-bold text-rose-500">{{ $distribution['berisiko']['percentage'] }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cakupan Pengukuran -->
                    <div class="mt-auto pt-4 border-t border-slate-50 flex flex-col gap-2">
                        <div class="flex items-center justify-between">
                            <span class="text-[11px] font-bold text-slate-600">Cakupan Pengukuran</span>
                        </div>
                        <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-emerald-500 rounded-full" style="width: calc({{ $stats['diukur'] }} / {{ max(1, $stats['total_balita']) }} * 100%);"></div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-medium text-slate-400">{{ $stats['diukur'] }} dari {{ $stats['total_balita'] }} balita terukur bulan ini</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- ==================== RIGHT COLUMN (Col 4) ==================== -->
        <div class="xl:col-span-4 flex flex-col gap-6">
            
            <!-- TOP RIGHT BADGES -->
            <div class="grid grid-cols-2 gap-4 pt-2">
                <!-- Periode -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] p-3.5 flex flex-col justify-center items-center">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Periode</p>
                    <p class="text-[13px] font-black text-slate-800 flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-sky-500"><path d="M12.75 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM7.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM8.25 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM9.75 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM10.5 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM12.75 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM14.25 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 13.5a.75.75 0 100-1.5.75.75 0 000 1.5z" /><path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z" clip-rule="evenodd" /></svg>
                        {{ $stats['current_month'] }}
                    </p>
                </div>

                <!-- Status Data -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] p-3.5 flex flex-col justify-center items-center">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Status Data</p>
                    <p class="text-[13px] font-black text-emerald-600 flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Real-time
                    </p>
                </div>
            </div>

            <!-- TINDAKAN CEPAT -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] p-6">
                <h3 class="text-[14px] font-bold tracking-tight text-slate-900 mb-5">Tindakan Cepat</h3>
                
                <div class="flex flex-col gap-3">
                    <!-- Validasi -->
                    <a href="{{ route('puskesmas.validasi') }}" class="group flex items-center justify-between p-4 rounded-xl border border-rose-100/50 hover:border-rose-200 hover:shadow-sm transition-all bg-rose-50/40 hover:bg-rose-50/80">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-white border border-rose-100 group-hover:border-rose-200 text-rose-500 flex items-center justify-center shadow-sm transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <div>
                                <p class="text-[13px] font-bold text-slate-900 group-hover:text-rose-700 transition-colors">Antrian Validasi</p>
                                <p class="text-[11px] font-medium text-slate-500 mt-0.5">Periksa pengukuran kader</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            @if($stats['pending'] > 0)
                                <span class="text-[10px] font-bold text-rose-600 bg-white border border-rose-100 px-2.5 py-0.5 rounded-md shadow-sm">{{ $stats['pending'] }}</span>
                            @endif
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-slate-300 group-hover:text-rose-400 transition-colors"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
                        </div>
                    </a>

                    <!-- Posyandu -->
                    <a href="{{ route('puskesmas.posyandu') }}" class="group flex items-center justify-between p-4 rounded-xl border border-emerald-100/50 hover:border-emerald-200 hover:shadow-sm transition-all bg-emerald-50/40 hover:bg-emerald-50/80">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-white border border-emerald-100 group-hover:border-emerald-200 text-emerald-600 flex items-center justify-center shadow-sm transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                            </div>
                            <div>
                                <p class="text-[13px] font-bold text-slate-900 group-hover:text-emerald-700 transition-colors">Manajemen Posyandu</p>
                                <p class="text-[11px] font-medium text-slate-500 mt-0.5">Kelola data posyandu</p>
                            </div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-slate-300 group-hover:text-emerald-500 transition-colors"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
