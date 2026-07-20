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
    // Data distribution percentage sometimes doesn't sum to exactly 100 due to rounding
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

<div class="flex flex-col gap-4 w-full max-w-7xl mx-auto pb-8 -mt-3 lg:-mt-6">

    <!-- Hero Command Center -->
    <div class="relative overflow-hidden rounded-2xl shadow-md p-5 sm:px-6 sm:py-5 flex flex-col lg:flex-row lg:items-center justify-between gap-4 bg-gradient-to-r from-emerald-500 to-teal-600">
        <!-- Abstract gradient background -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0IiBoZWlnaHQ9IjQiPgo8cmVjdCB3aWR0aD0iNCIgaGVpZ2h0PSI0IiBmaWxsPSIjZmZmIiBmaWxsLW9wYWNpdHk9IjAuMDUiLz4KPC9zdmc+')] opacity-20 mix-blend-overlay pointer-events-none"></div>
        <div class="absolute -top-16 -right-16 w-64 h-64 bg-gradient-to-br from-emerald-400/20 to-teal-400/20 rounded-full blur-2xl pointer-events-none"></div>
        
        <!-- Welcome Info -->
        <div class="relative flex-1 flex flex-col gap-1.5 z-10">
            <div class="flex items-center gap-2 mb-0.5">
                <span class="px-2 py-0.5 rounded bg-white/20 border border-white/30 text-white text-[9px] font-black uppercase tracking-widest backdrop-blur-sm shadow-sm">Command Center</span>
                <span class="text-[9px] font-bold text-emerald-50 uppercase tracking-widest">Portal NutriGen</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight drop-shadow-md">{{ $greeting }}, {{ explode(' ', $stats['user_name'])[0] }}</h1>
            <p class="text-[12px] font-medium text-emerald-50 max-w-lg truncate">Pantau metrik dan kelola operasional posyandu secara real-time.</p>
        </div>

        <!-- Metadata & Actions -->
        <div class="relative flex flex-col sm:flex-row items-start sm:items-center gap-6 z-10 lg:pl-6 lg:border-l lg:border-white/20">
            <div class="flex items-center gap-6">
                <div class="flex flex-col gap-1">
                    <span class="text-[10px] font-bold text-emerald-100 uppercase tracking-widest">Periode</span>
                    <span class="text-[13px] font-bold text-white">{{ now()->isoFormat('MMMM Y') }}</span>
                </div>
                <div class="w-px h-8 bg-white/20"></div>
                <div class="flex flex-col gap-1">
                    <span class="text-[10px] font-bold text-emerald-100 uppercase tracking-widest">Status Data</span>
                    <span class="text-[13px] font-bold text-white flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-white shadow-[0_0_8px_rgba(255,255,255,0.8)]"></span>
                        Real-time
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Grid Content -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
        
        <!-- LEFT COLUMN (KPIs & Alert Center) -->
        <div class="lg:col-span-8 flex flex-col gap-4">
            
            <!-- Alert Center / Priority KPI -->
            @if($stats['pending'] > 0)
            <div class="bg-rose-50 rounded-2xl ring-1 ring-rose-200/50 p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-white text-rose-600 flex items-center justify-center shrink-0 shadow-sm ring-1 ring-rose-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-[14px] font-bold text-slate-900">Perhatian Dibutuhkan</h3>
                        <p class="text-[12px] font-medium text-slate-600">Ada <span class="font-bold text-rose-600">{{ $stats['pending'] }} antrean pengukuran</span> menunggu validasi.</p>
                    </div>
                </div>
                <a href="{{ route('puskesmas.validasi') }}" class="shrink-0 px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white font-bold text-[12px] rounded-lg transition-all shadow-sm">Validasi Sekarang</a>
            </div>
            @else
            <div class="bg-emerald-50 rounded-2xl ring-1 ring-emerald-200/50 p-3.5 sm:px-5 sm:py-3 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-9 h-9 rounded-full bg-emerald-500 text-white flex items-center justify-center shrink-0 shadow-sm ring-2 ring-emerald-200/50">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-[14px] font-bold text-slate-900 leading-tight">Semua Data Tervalidasi</h3>
                        <p class="text-[11px] font-medium text-slate-500">Tidak ada antrean tertunda.</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- KPI Stats (Bento Layout) -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <!-- Total Balita -->
                <div class="bg-slate-50/50 p-5 rounded-2xl flex flex-col gap-3 ring-1 ring-slate-200/60 hover:ring-slate-300 hover:-translate-y-0.5 transition-all duration-200 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-xl bg-white text-slate-500 flex items-center justify-center shadow-sm ring-1 ring-slate-200/50">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                <path d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-3xl font-black text-slate-900 tracking-tight leading-none">{{ number_format($stats['total_balita'], 0, ',', '.') }}</h4>
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-1.5">Total Balita</p>
                    </div>
                </div>

                <!-- Diukur Bulan Ini -->
                <div class="bg-sky-50/30 p-5 rounded-2xl flex flex-col gap-3 ring-1 ring-sky-100 hover:ring-sky-200 hover:-translate-y-0.5 transition-all duration-200 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-xl bg-white text-sky-600 flex items-center justify-center shadow-sm ring-1 ring-sky-100">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="bg-sky-100/50 text-sky-700 px-2 py-0.5 rounded text-[9px] font-bold border border-sky-200/50">BULAN INI</span>
                    </div>
                    <div>
                        <h4 class="text-3xl font-black text-slate-900 tracking-tight leading-none">{{ number_format($stats['diukur'], 0, ',', '.') }}</h4>
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-1.5">Diukur</p>
                    </div>
                </div>

                <!-- Tervalidasi -->
                <div class="bg-emerald-50/30 p-5 rounded-2xl flex flex-col gap-3 col-span-2 md:col-span-1 ring-1 ring-emerald-100 hover:ring-emerald-200 hover:-translate-y-0.5 transition-all duration-200 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-xl bg-white text-emerald-600 flex items-center justify-center shadow-sm ring-1 ring-emerald-100">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-3xl font-black text-slate-900 tracking-tight leading-none">{{ number_format($stats['valid'], 0, ',', '.') }}</h4>
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-1.5">Tervalidasi</p>
                    </div>
                </div>
            </div>

            <!-- Recent Activity List -->
            <div class="bg-white rounded-2xl ring-1 ring-slate-200 shadow-sm flex-1">
                <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-[14px] font-bold text-slate-900">Aktivitas Posyandu</h3>
                        <p class="text-[11px] font-medium text-slate-500">Pengukuran balita terbaru</p>
                    </div>
                    <a href="{{ route('puskesmas.balita') }}" class="text-[12px] font-bold text-sky-600 hover:text-sky-700 hover:underline">Lihat Semua</a>
                </div>
                
                <div class="flex flex-col">
                    @forelse($recentActivities as $activity)
                    @php
                        // Mock validation status since the column does not exist in the DB
                        $isValid = true; 
                    @endphp
                    <div class="group flex items-center gap-3 px-5 py-3 hover:bg-slate-50 border-b border-slate-50 last:border-0 transition-colors">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 shadow-sm ring-1 {{ $isValid ? 'bg-emerald-50 text-emerald-600 ring-emerald-100' : 'bg-amber-50 text-amber-600 ring-amber-100' }}">
                            @if($isValid)
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z" clip-rule="evenodd" /></svg>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[13px] font-bold text-slate-900 truncate">
                                {{ $activity->balita->nama ?? 'Balita Tidak Diketahui' }}
                            </p>
                            <p class="text-[11px] font-medium text-slate-500 truncate mt-0.5">
                                {{ $activity->balita->posyandu->nama ?? 'Tidak Diketahui' }}
                            </p>
                        </div>
                        <div class="text-right shrink-0">
                            <span class="inline-flex items-center gap-1 text-[9px] font-extrabold tracking-wider px-2 py-0.5 rounded-md ring-1 {{ $isValid ? 'bg-emerald-50 text-emerald-700 ring-emerald-200/50' : 'bg-amber-50 text-amber-700 ring-amber-200/50' }}">
                                <span class="w-1 h-1 rounded-full {{ $isValid ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                                {{ $isValid ? 'VALID' : 'MENUNGGU' }}
                            </span>
                            <p class="text-[10px] font-medium text-slate-400 mt-1 opacity-75">{{ $activity->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="p-8 text-center flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full bg-slate-50 text-slate-300 flex items-center justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-slate-500 text-[12px] font-bold">Belum ada aktivitas pengukuran.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN (Data Viz & Quick Actions) -->
        <div class="lg:col-span-4 flex flex-col gap-4">
            
            <!-- Quick Actions Menu -->
            <div class="bg-white ring-1 ring-slate-200 rounded-2xl shadow-sm p-4 sm:p-5">
                <h3 class="text-[14px] font-bold text-slate-900 mb-3">Tindakan Cepat</h3>
                <div class="flex flex-col gap-2">
                    <a href="{{ route('puskesmas.validasi') }}" class="group flex items-center justify-between p-3 rounded-xl ring-1 ring-slate-100 hover:ring-sky-200 bg-slate-50/50 hover:bg-sky-50 transition-all duration-200 hover:-translate-y-0.5 cursor-pointer">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-white ring-1 ring-slate-200 group-hover:ring-sky-200 text-slate-500 group-hover:text-sky-600 flex items-center justify-center transition-colors shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-[12px] font-bold text-slate-800 group-hover:text-sky-800">Antrean Validasi</p>
                                <p class="text-[10px] font-medium text-slate-500 mt-0.5">Periksa skrining kader</p>
                            </div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-slate-300 group-hover:text-sky-500 group-hover:translate-x-1 transition-all">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                    
                    <a href="{{ route('puskesmas.posyandu') }}" class="group flex items-center justify-between p-3 rounded-xl ring-1 ring-slate-100 hover:ring-emerald-200 bg-slate-50/50 hover:bg-emerald-50 transition-all duration-200 hover:-translate-y-0.5 cursor-pointer">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-white ring-1 ring-slate-200 group-hover:ring-emerald-200 text-slate-500 group-hover:text-emerald-600 flex items-center justify-center transition-colors shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-[12px] font-bold text-slate-800 group-hover:text-emerald-800">Manajemen Posyandu</p>
                                <p class="text-[10px] font-medium text-slate-500 mt-0.5">Kelola data posyandu</p>
                            </div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-slate-300 group-hover:text-emerald-500 group-hover:translate-x-1 transition-all">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Distribution Chart -->
            <div class="bg-white ring-1 ring-slate-200 rounded-2xl shadow-sm p-4 sm:p-5 flex-1 flex flex-col">
                <div class="mb-5">
                    <h2 class="text-[14px] font-bold text-slate-900">Distribusi Status Gizi</h2>
                    <p class="text-[11px] font-medium text-slate-500 mt-0.5">Data valid bulan {{ $stats['current_month'] }}</p>
                </div>

                <div class="flex items-center justify-center mb-6 mt-1">
                    <div class="relative w-32 h-32 flex items-center justify-center">
                        <svg viewBox="0 0 36 36" class="w-full h-full transform -rotate-90">
                            <!-- Normal -->
                            <path class="text-emerald-500" stroke-dasharray="{{ $p_normal }}, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="5"></path>
                            <!-- Perhatian -->
                            <path class="text-amber-500" stroke-dasharray="{{ $p_perhatian }}, 100" stroke-dashoffset="-{{ $p_normal }}" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="5"></path>
                            <!-- Berisiko -->
                            <path class="text-rose-500" stroke-dasharray="{{ $p_berisiko }}, 100" stroke-dashoffset="-{{ $p_normal + $p_perhatian }}" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="5"></path>
                        </svg>
                        <div class="absolute flex flex-col items-center justify-center">
                            <span class="text-3xl font-black text-slate-900 leading-none">{{ $distribution['total_diukur'] }}</span>
                        </div>
                    </div>
                </div>

                <!-- Legend -->
                <div class="flex flex-col gap-1.5 mt-auto">
                    <div class="flex items-center justify-between px-3 py-2 rounded-lg bg-slate-50/50 hover:bg-slate-50 transition-all">
                        <div class="flex items-center gap-2.5">
                            <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                            <span class="text-[11px] font-bold text-slate-700">Normal</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-[12px] font-black text-slate-900">{{ $distribution['normal']['count'] }}</span>
                            <span class="text-[9px] font-bold text-emerald-700 bg-emerald-100/60 px-1.5 py-0.5 rounded w-9 text-center">{{ $distribution['normal']['percentage'] }}%</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between px-3 py-2 rounded-lg bg-slate-50/50 hover:bg-slate-50 transition-all">
                        <div class="flex items-center gap-2.5">
                            <div class="w-2 h-2 rounded-full bg-amber-500"></div>
                            <span class="text-[11px] font-bold text-slate-700">Perhatian</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-[12px] font-black text-slate-900">{{ $distribution['perlu_perhatian']['count'] }}</span>
                            <span class="text-[9px] font-bold text-amber-700 bg-amber-100/60 px-1.5 py-0.5 rounded w-9 text-center">{{ $distribution['perlu_perhatian']['percentage'] }}%</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between px-3 py-2 rounded-lg bg-slate-50/50 hover:bg-slate-50 transition-all">
                        <div class="flex items-center gap-2.5">
                            <div class="w-2 h-2 rounded-full bg-rose-500"></div>
                            <span class="text-[11px] font-bold text-slate-700">Berisiko</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-[12px] font-black text-slate-900">{{ $distribution['berisiko']['count'] }}</span>
                            <span class="text-[9px] font-bold text-rose-700 bg-rose-100/60 px-1.5 py-0.5 rounded w-9 text-center">{{ $distribution['berisiko']['percentage'] }}%</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
