@extends('layouts.app')

@section('page-title', 'Profil Balita')

@section('content')

{{--
|--------------------------------------------------------------------------
| kader.profil-balita
|--------------------------------------------------------------------------
| Controller contract — expected variables:
|   $balitaId   (int)    — from route parameter /profil-balita/{id}
|   $childName  (string)
|   $gender     (string) — 'Laki-laki' or 'Perempuan'
|   $age        (string) — e.g. '2 Tahun 2 Bulan'
|   $nik        (string)
|   $motherName (string)
|   $motherPhone(string)
|   $posyanduName(string)
|   $address    (string)
|   $addressSub (string)
|   $status     (string) — display label
|   $status_type(string) — 'success' | 'warning' | 'danger'
|   $measurements (array) — see x-timeline-item for shape
|   $latestMeasure(array) — first element of $measurements
--}}

@php
    // ============================================================
    // DEMO DATA — REMOVE IN PRODUCTION
    // ============================================================
    // Backend: Remove this entire @php block and inject all
    // variables from BalitaController@show.
    // The $balitaId variable is already available from the route.
    $balitaId   = $balitaId ?? null;
    $childName  = $childName  ?? 'Aisyah Putri';
    $gender     = $gender     ?? 'Perempuan';
    $age        = $age        ?? '2 Tahun 2 Bulan';
    $nik        = $nik        ?? '320101XXXXXXXXX';
    $motherName = $motherName ?? 'Siti Aminah';
    $motherPhone= $motherPhone?? '081234567890';
    $posyanduName=$posyanduName?? 'Melati 1';
    $address    = $address    ?? 'Jl. Kenanga No 12';
    $addressSub = $addressSub ?? 'Desa Melati';
    $status     = $status     ?? 'Normal';
    $status_type= $status_type?? 'success';

    // Explicit color map — avoids Tailwind purge issues
    $colorMap = [
        'success' => 'emerald',
        'warning' => 'amber',
        'danger'  => 'rose',
    ];
    $colorClass = $colorMap[$status_type] ?? 'slate';

    // Explicit Tailwind class sets for status badge (no interpolation)
    $statusBadgeClasses = [
        'success' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
        'warning' => 'bg-amber-50 text-amber-700 border-amber-100',
        'danger'  => 'bg-rose-50 text-rose-700 border-rose-100',
    ];
    $statusDotClasses = [
        'success' => 'bg-emerald-500',
        'warning' => 'bg-amber-500',
        'danger'  => 'bg-rose-500',
    ];
    $badgeClasses = $statusBadgeClasses[$status_type] ?? 'bg-slate-50 text-slate-700 border-slate-100';
    $dotClass     = $statusDotClasses[$status_type]   ?? 'bg-slate-500';

    // Demo measurements — replace with $measurements from controller
    $measurements = $measurements ?? [
        ['date' => '10 Mei 2026',  'weight' => '12.5', 'weight_trend' =>  0.5, 'height' => '87.2', 'head_circ' => '48.0', 'status' => 'Normal', 'status_type' => 'success'],
        ['date' => '10 Apr 2026',  'weight' => '12.0', 'weight_trend' =>  0.2, 'height' => '86.5', 'head_circ' => '47.5', 'status' => 'Normal', 'status_type' => 'success'],
        ['date' => '10 Mar 2026',  'weight' => '11.8', 'weight_trend' => -0.1, 'height' => '86.0', 'head_circ' => '47.0', 'status' => 'Kurang', 'status_type' => 'warning'],
    ];

    $latestMeasure = $latestMeasure ?? $measurements[0];
@endphp

<div class="bg-slate-50 min-h-screen relative w-full pb-[calc(5rem+env(safe-area-inset-bottom))] lg:pb-12">
    
    <!-- ========================================== -->
    <!-- DESKTOP GLOBAL PAGE HEADER                 -->
    <!-- ========================================== -->
    <div class="hidden lg:flex bg-white border-b border-slate-100 sticky top-0 z-50 shadow-[0_4px_20px_-8px_rgba(0,0,0,0.03)]">
        <div class="max-w-6xl mx-auto px-6 py-4 w-full flex items-center justify-between">
            <div class="flex items-center gap-3">
            <a href="{{ route('balita.index') }}" class="flex flex-shrink-0 items-center justify-center w-10 h-10 -ml-2 text-slate-400 hover:text-slate-900 hover:bg-slate-50 rounded-full transition-all focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </a>
                <h1 class="text-lg font-extrabold text-slate-900 tracking-tight">Profil Balita</h1>
            </div>
            
            <div class="flex items-center gap-3">
                {{-- Backend: pass $balitaId to route for edit --}}
                <a href="{{ route('balita.edit') }}" class="flex items-center gap-2 text-slate-600 hover:text-teal-700 bg-white hover:bg-teal-50 border border-slate-200 hover:border-teal-200 px-5 py-2.5 rounded-2xl transition-colors font-bold text-[13px] shadow-sm focus:outline-none">
                    Edit Data
                </a>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- MOBILE ULTRA-COMPACT HEADER (Sticky)       -->
    <!-- ========================================== -->
    <div class="lg:hidden bg-white px-4 py-3 border-b border-slate-100 sticky top-0 z-50 shadow-[0_4px_20px_-8px_rgba(0,0,0,0.03)] flex items-center justify-between">
        <div class="flex items-center gap-3 overflow-hidden">
            <!-- Back Button -->
            <a href="{{ route('balita.index') }}" class="flex-shrink-0 text-slate-400 hover:text-slate-900 focus:outline-none p-1 -ml-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </a>
            
            <!-- Compact Identity -->
            <div class="flex items-center gap-2.5 overflow-hidden">
                <div class="w-9 h-9 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 border border-slate-100 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 opacity-70">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="flex flex-col truncate mt-0.5">
                    <h1 class="text-[13px] font-extrabold text-slate-900 leading-none truncate tracking-tight">{{ $childName }}</h1>
                    <span class="text-[10px] font-medium text-slate-500 mt-0.5 truncate">{{ $age }}</span>
                </div>
            </div>
        </div>
        
        <!-- Status Pill -->
        <div class="flex items-center gap-1.5 {{ $badgeClasses }} px-2 py-1.5 rounded-lg border shrink-0 ml-2">
            <div class="w-1.5 h-1.5 rounded-full {{ $dotClass }}"></div>
            <span class="text-[9px] font-black uppercase tracking-widest">{{ $status }}</span>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- 2-COLUMN WORKSPACE CONTAINER               -->
    <!-- ========================================== -->
    <div class="max-w-6xl mx-auto flex flex-col lg:flex-row gap-0 lg:gap-8 lg:px-6 mt-0 lg:mt-8">
        
        <!-- LEFT COLUMN: DESKTOP IDENTITY & CONTEXT -->
        <div class="hidden lg:flex w-full lg:w-1/3 flex-col shrink-0 lg:sticky lg:top-28 self-start z-10">
            <!-- Identity Card -->
            <div class="bg-white p-6 border border-slate-100 rounded-[1.25rem] shadow-[0_4px_20px_-8px_rgba(0,0,0,0.03)] flex flex-col gap-6">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center text-slate-300 border border-slate-100 overflow-hidden shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-9 h-9 opacity-80">
                            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="flex flex-col flex-1 mt-1">
                        <h2 class="text-xl font-extrabold text-slate-900 leading-tight mb-1 tracking-tight">{{ $childName }}</h2>
                        <span class="text-[13px] font-medium text-slate-500">{{ $gender }} • {{ $age }}</span>
                    </div>
                </div>

                <div class="flex items-center justify-between border-t border-slate-100 pt-5">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Status Gizi</span>
                    <div class="flex items-center gap-2 {{ $badgeClasses }} px-3 py-1.5 rounded-xl border">
                        <div class="w-2 h-2 rounded-full {{ $dotClass }} shadow-sm"></div>
                        <span class="text-[10px] font-black uppercase tracking-widest">{{ $status }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Desktop Personal Data -->
            <div class="bg-white border border-slate-100 rounded-[1.25rem] p-6 shadow-[0_4px_20px_-8px_rgba(0,0,0,0.03)] mt-6">
                <h3 class="text-sm font-black text-slate-900 mb-5 tracking-tight">Informasi Personal</h3>
                <div class="flex flex-col gap-5">
                    <div class="flex flex-col gap-1">
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">NIK Anak</span>
                        <span class="text-slate-900 font-bold text-sm">{{ $nik }}</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Nama Ibu Kandung</span>
                        <span class="text-slate-900 font-bold text-sm">{{ $motherName }}</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Nomor Handphone</span>
                        <span class="text-slate-900 font-bold text-sm">{{ $motherPhone }}</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Alamat Domisili</span>
                        <span class="text-slate-900 font-bold text-sm leading-snug">{{ $address }}<br><span class="text-slate-500 text-xs font-medium">{{ $addressSub }}</span></span>
                    </div>
                </div>
            </div>
            
            <!-- Desktop In-Flow CTA -->
            <button onclick="openMeasurementModal()" class="mt-8 flex items-center w-full justify-center gap-2 bg-teal-600 hover:bg-teal-700 text-white py-4 rounded-[1.25rem] font-black text-[13px] shadow-[0_8px_20px_-6px_rgba(13,148,136,0.4)] transition-all focus:outline-none hover:-translate-y-0.5">
                UKUR SEKARANG
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </button>
        </div>
        
        <!-- ========================================== -->
        <!-- RIGHT COLUMN: WORKSPACE TABS               -->
        <!-- ========================================== -->
        <div class="w-full lg:w-2/3 flex flex-col relative z-20">
            <div class="bg-white lg:border lg:border-slate-100 lg:rounded-[1.25rem] lg:shadow-[0_4px_20px_-8px_rgba(0,0,0,0.03)] w-full min-h-[500px] flex flex-col relative overflow-hidden">
                
                <!-- Tabbed Navigation -->
                <div class="border-b border-slate-100 w-full z-10 px-2 lg:px-6 bg-white lg:rounded-t-[1.25rem]">
                    <div class="flex" id="profile-tabs">
                        <button onclick="switchTab('ringkasan')" id="tab-ringkasan" class="flex-1 py-4 text-[13px] font-extrabold text-teal-600 border-b-[3px] border-teal-600 text-center transition-colors focus:outline-none">
                            Ringkasan
                        </button>
                        <button onclick="switchTab('riwayat')" id="tab-riwayat" class="flex-1 py-4 text-[13px] font-bold text-slate-400 border-b-[3px] border-transparent hover:text-slate-800 text-center transition-colors focus:outline-none">
                            Riwayat
                        </button>
                        <button onclick="switchTab('grafik')" id="tab-grafik" class="flex-1 py-4 text-[13px] font-bold text-slate-400 border-b-[3px] border-transparent hover:text-slate-800 text-center transition-colors focus:outline-none">
                            Grafik
                        </button>
                    </div>
                </div>

                <!-- Tab Contents Container -->
                <div class="p-5 lg:p-8 flex-1 relative bg-slate-50/30">
                    
                    <!-- TAB: RINGKASAN -->
                    <div id="content-ringkasan" class="tab-content flex flex-col gap-8">
                        
                        <!-- Hasil Terakhir (Apple Health Style Metric Cards) -->
                        <div>
                            <h2 class="text-[15px] font-black text-slate-900 mb-4 flex items-center justify-between tracking-tight">
                                Pengukuran Terakhir
                                <span class="text-[11px] font-bold text-slate-500 bg-white border border-slate-200 shadow-sm px-3 py-1 rounded-full">{{ $latestMeasure['date'] }}</span>
                            </h2>
                            
                            <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 lg:gap-4 mb-6">
                                <!-- BB Card -->
                                <div class="bg-white border border-slate-100 rounded-2xl p-4 flex flex-col shadow-[0_2px_12px_-4px_rgba(0,0,0,0.03)] hover:shadow-md transition-shadow relative overflow-hidden">
                                    <div class="w-8 h-8 rounded-full bg-sky-50 text-sky-500 flex items-center justify-center mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0 0 12 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.312 3 .5m-16.5 0c-1.01.143-2.01.312-3 .5m19.5 0V12a2.25 2.25 0 0 1-2.25 2.25H15m3-2.25V15M7.125 15H3.75m0 0v-2.25m0 2.25V12a2.25 2.25 0 0 1 2.25-2.25h1.5m3-2.25V15" /></svg>
                                    </div>
                                    <span class="text-2xl font-black text-slate-900 tracking-tight">{{ $latestMeasure['weight'] }}<span class="text-xs font-semibold text-slate-400 ml-0.5">kg</span></span>
                                    <span class="text-[11px] font-bold text-slate-400 mt-1 uppercase tracking-wider">Berat Badan</span>
                                </div>
                                <!-- TB Card -->
                                <div class="bg-white border border-slate-100 rounded-2xl p-4 flex flex-col shadow-[0_2px_12px_-4px_rgba(0,0,0,0.03)] hover:shadow-md transition-shadow relative overflow-hidden">
                                    <div class="w-8 h-8 rounded-full bg-indigo-50 text-indigo-500 flex items-center justify-center mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" /></svg>
                                    </div>
                                    <span class="text-2xl font-black text-slate-900 tracking-tight">{{ $latestMeasure['height'] }}<span class="text-xs font-semibold text-slate-400 ml-0.5">cm</span></span>
                                    <span class="text-[11px] font-bold text-slate-400 mt-1 uppercase tracking-wider">Tinggi Badan</span>
                                </div>
                                <!-- LK Card -->
                                <div class="col-span-2 lg:col-span-1 bg-white border border-slate-100 rounded-2xl p-4 flex flex-col shadow-[0_2px_12px_-4px_rgba(0,0,0,0.03)] hover:shadow-md transition-shadow relative overflow-hidden">
                                    <div class="w-8 h-8 rounded-full bg-violet-50 text-violet-500 flex items-center justify-center mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" /></svg>
                                    </div>
                                    <span class="text-2xl font-black text-slate-900 tracking-tight">{{ $latestMeasure['head_circ'] }}<span class="text-xs font-semibold text-slate-400 ml-0.5">cm</span></span>
                                    <span class="text-[11px] font-bold text-slate-400 mt-1 uppercase tracking-wider">Lingkar Kepala</span>
                                </div>
                            </div>

                            <!-- WHO Textual Diagnosis -->
                            <div class="bg-teal-50 border border-teal-100 rounded-2xl p-5 flex items-start gap-4">
                                <div class="text-teal-600 shrink-0 mt-0.5 bg-white p-2 rounded-full shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm font-black text-teal-900 mb-1 tracking-tight">Pertumbuhan Selaras</span>
                                    <span class="text-[13px] text-teal-800 font-medium leading-relaxed">
                                        Anak tumbuh normal. Berat badan naik 0.5kg dari bulan lalu. Lanjutkan pemberian makanan bergizi.
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Mobile Only: Data Keluarga & Pribadi -->
                        <!-- Upgraded to grid layout instead of HTML table style -->
                        <div class="lg:hidden mt-2">
                            <h2 class="text-[15px] font-black text-slate-900 mb-4 tracking-tight">Informasi Personal</h2>
                            <div class="bg-white border border-slate-100 rounded-2xl p-5 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.03)]">
                                <div class="grid grid-cols-2 gap-y-5 gap-x-4">
                                    <div class="flex flex-col gap-1">
                                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">NIK Anak</span>
                                        <span class="text-slate-900 font-bold text-[13px]">{{ $nik }}</span>
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Nama Ibu Kandung</span>
                                        <span class="text-slate-900 font-bold text-[13px]">{{ $motherName }}</span>
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Nomor Handphone</span>
                                        <span class="text-slate-900 font-bold text-[13px]">{{ $motherPhone }}</span>
                                    </div>
                                    <div class="flex flex-col gap-1 col-span-2">
                                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Alamat Domisili</span>
                                        <span class="text-slate-900 font-bold text-[13px] leading-snug">{{ $address }}<br><span class="text-slate-500 font-medium text-xs">{{ $addressSub }}</span></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Mobile Sticky CTA removed from inline flow -->
                    </div>

                    <!-- TAB: RIWAYAT -->
                    <div id="content-riwayat" class="tab-content hidden flex flex-col">
                        <div class="flex flex-col pb-4">
                            @foreach($measurements as $measure)
                                <x-timeline-item :measurement="$measure" :is-last="$loop->last" />
                            @endforeach
                        </div>
                    </div>

                    <!-- TAB: GRAFIK -->
                    <div id="content-grafik" class="tab-content hidden flex flex-col">
                        <div class="bg-white border border-slate-100 rounded-2xl p-5 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.03)] mb-4">
                            <div class="mb-5">
                                <select class="w-full bg-slate-50 border border-slate-200 text-slate-700 text-[13px] font-bold rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-400 transition-colors shadow-sm">
                                    <option>Berat Badan per Umur (BB/U)</option>
                                    <option>Tinggi Badan per Umur (TB/U)</option>
                                </select>
                            </div>

                            <div class="relative h-[240px] rounded-xl overflow-hidden border border-slate-100 flex flex-col shadow-inner">
                                <div class="flex-1 bg-emerald-50/50 flex items-center justify-center">
                                    <span class="text-[10px] font-bold text-emerald-600/40 uppercase tracking-widest">Normal</span>
                                </div>
                                <div class="h-16 bg-amber-50/50 border-t border-amber-100/50 flex items-center justify-center">
                                    <span class="text-[10px] font-bold text-amber-600/40 uppercase tracking-widest">Kurang</span>
                                </div>
                                <div class="h-12 bg-rose-50/50 border-t border-rose-100/50 flex items-center justify-center">
                                    <span class="text-[10px] font-bold text-rose-600/40 uppercase tracking-widest">Sangat Kurang</span>
                                </div>
                                
                                <svg class="absolute inset-0 w-full h-full" preserveAspectRatio="none">
                                    <polyline points="0,190 100,170 200,120 300,70" fill="none" stroke="#0d9488" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="100" cy="170" r="5" fill="white" stroke="#0d9488" stroke-width="3" />
                                    <circle cx="200" cy="120" r="5" fill="white" stroke="#0d9488" stroke-width="3" />
                                    <circle cx="300" cy="70" r="5" fill="white" stroke="#0d9488" stroke-width="3" />
                                </svg>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        
        <!-- Mobile In-Flow CTA -->
        <div class="lg:hidden w-full mt-6 px-4">
            <div class="flex gap-2.5">
                {{-- Backend: pass $balitaId to route for edit --}}
                <a href="{{ route('balita.edit') }}" class="flex items-center justify-center bg-white text-slate-600 border border-slate-200 w-14 rounded-[1.25rem] shadow-sm focus:outline-none h-[54px] hover:bg-slate-50 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                    </svg>
                </a>
                <button onclick="openMeasurementModal()" class="flex-1 flex items-center justify-center gap-2 bg-teal-600 hover:bg-teal-700 text-white rounded-[1.25rem] font-black text-[13px] shadow-sm transition-all focus:outline-none h-[54px] active:scale-[0.98]">
                    UKUR SEKARANG
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </button>
            </div>
        </div>
        
    </div>
</div>

@push('modals')


<script>
    function switchTab(tabId) {
        document.querySelectorAll('.tab-content').forEach(el => {
            el.classList.add('hidden');
        });
        
        const activeClasses = ['text-teal-600', 'border-teal-600'];
        const inactiveClasses = ['text-slate-400', 'border-transparent', 'hover:text-slate-800'];
        
        ['ringkasan', 'riwayat', 'grafik'].forEach(id => {
            const btn = document.getElementById('tab-' + id);
            if(btn) {
                btn.classList.remove(...activeClasses);
                btn.classList.add(...inactiveClasses);
            }
        });
        
        const selectedContent = document.getElementById('content-' + tabId);
        const selectedBtn = document.getElementById('tab-' + tabId);
        
        if(selectedContent && selectedBtn) {
            selectedContent.classList.remove('hidden');
            selectedBtn.classList.remove(...inactiveClasses);
            selectedBtn.classList.add(...activeClasses);
        }
    }

    // Auto-open modal if triggered from another page
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('action') === 'ukur') {
            if (typeof openMeasurementModal === 'function') {
                // slight delay to ensure UI transitions smoothly
                setTimeout(openMeasurementModal, 150);
            }
            // Clean up the URL to prevent reopening on refresh
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    });
</script>

<x-measurement-modal 
    :child-name="$childName" 
    :age="$age" 
    :last-weight="$latestMeasure['weight'] ?? null" 
    :last-height="$latestMeasure['height'] ?? null" 
    :last-date="$latestMeasure['date'] ?? null" 
/>
@endpush

@endsection
