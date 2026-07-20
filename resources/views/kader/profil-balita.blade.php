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
    $colorMap = [
        'success' => 'emerald',
        'warning' => 'amber',
        'danger'  => 'rose',
    ];
    $colorClass = $colorMap[$status_type] ?? 'slate';

    $statusBadgeClasses = [
        'success' => 'bg-emerald-50 text-emerald-700 border-emerald-200/60 shadow-[0_2px_8px_-4px_rgba(16,185,129,0.4)]',
        'warning' => 'bg-amber-50 text-amber-700 border-amber-200/60 shadow-[0_2px_8px_-4px_rgba(245,158,11,0.4)]',
        'danger'  => 'bg-rose-50 text-rose-700 border-rose-200/60 shadow-[0_2px_8px_-4px_rgba(225,29,72,0.4)]',
    ];
    $statusDotClasses = [
        'success' => 'bg-emerald-500',
        'warning' => 'bg-amber-500',
        'danger'  => 'bg-rose-500',
    ];
    $badgeClasses = $statusBadgeClasses[$status_type] ?? 'bg-slate-50 text-slate-700 border-slate-200/60 shadow-sm';
    $dotClass     = $statusDotClasses[$status_type]   ?? 'bg-slate-500';
@endphp

<!-- MAIN CANVAS -->
<div class="bg-[#F8FAFC] min-h-screen relative w-full pb-[calc(5rem+env(safe-area-inset-bottom))] lg:pb-16 font-sans">
    
    <!-- ========================================== -->
    <!-- HERO WORKSPACE (Apple Health / Notion Vibe)-->
    <!-- ========================================== -->
    <div class="bg-white border-b border-slate-200/60 relative z-40">
        <!-- Subtle Ambient Gradient based on Status -->
        @if($status_type === 'danger')
            <div class="absolute inset-0 bg-gradient-to-b from-rose-50/40 to-transparent pointer-events-none"></div>
        @elseif($status_type === 'warning')
            <div class="absolute inset-0 bg-gradient-to-b from-amber-50/40 to-transparent pointer-events-none"></div>
        @else
            <div class="absolute inset-0 bg-gradient-to-b from-emerald-50/40 to-transparent pointer-events-none"></div>
        @endif

        <div class="max-w-7xl mx-auto w-full px-5 py-6 lg:py-8 relative">
            
            <!-- Top Nav Row (Back & Actions) -->
            <div class="flex items-center justify-between mb-8">
                <a href="{{ route('balita.index') }}" class="group flex items-center gap-2.5 text-slate-400 hover:text-slate-800 transition-colors font-medium text-[14px]">
                    <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center group-hover:bg-slate-200 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </div>
                    Daftar Balita
                </a>
                
                <div class="flex items-center gap-2">
                    <a href="{{ route('balita.edit', $balitaId) }}" class="flex items-center justify-center bg-slate-100 text-slate-600 hover:text-slate-900 px-4 h-[36px] rounded-full hover:bg-slate-200 transition-colors font-bold text-[13px] shadow-sm">
                        Edit Data
                    </a>
                    <form id="delete-balita-{{ $balitaId }}" action="{{ route('balita.destroy', $balitaId) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="window.NutriAlert.confirm('Hapus Data Balita?', 'Hapus permanen data balita beserta seluruh riwayat pengukurannya?', 'Ya, Hapus', 'Batal').then((result) => { if(result.isConfirmed) document.getElementById('delete-balita-{{ $balitaId }}').submit(); })" class="flex items-center justify-center bg-rose-50 border border-rose-100 text-rose-600 hover:text-rose-700 hover:bg-rose-100 px-4 h-[36px] rounded-full transition-colors font-bold text-[13px] shadow-sm">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Identity Row -->
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-5 lg:gap-8">
                
                <!-- Avatar & Core Info -->
                <div class="flex flex-row items-center sm:items-start lg:items-center gap-4 sm:gap-5 w-full lg:w-auto">
                    
                    <!-- Avatar -->
                    <div class="relative shrink-0">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-gradient-to-br from-slate-50 to-slate-100 shadow-[0_4px_20px_-8px_rgba(0,0,0,0.08)] ring-1 ring-slate-200/80 flex items-center justify-center text-slate-300 relative z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 sm:w-10 sm:h-10 opacity-50">
                                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Text Identity -->
                    <div class="flex flex-col w-full min-w-0">
                        <div class="flex flex-wrap items-center gap-2 mb-1.5 sm:mb-2">
                            <h1 class="text-xl sm:text-2xl lg:text-3xl font-black text-slate-900 tracking-tight truncate">{{ $childName }}</h1>
                            <!-- Modern Status Badge -->
                            <div class="flex items-center gap-1.5 {{ $badgeClasses }} px-2.5 py-1 sm:px-3 sm:py-1.5 rounded-full border bg-white/90 shadow-sm">
                                <div class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full {{ $dotClass }} animate-pulse"></div>
                                <span class="text-[9px] sm:text-[10px] font-extrabold uppercase tracking-widest">{{ $status }}</span>
                            </div>

                            <!-- Validasi Status Badge -->
                            @if(isset($latestMeasure) && $latestMeasure['status_validasi'])
                                @php
                                    $valColors = match($latestMeasure['status_validasi']) {
                                        'pending' => 'bg-amber-50 text-amber-700 border-amber-200/60',
                                        'approved' => 'bg-emerald-50 text-emerald-700 border-emerald-200/60',
                                        'rejected' => 'bg-rose-50 text-rose-700 border-rose-200/60',
                                        default => 'bg-slate-50 text-slate-700 border-slate-200/60'
                                    };
                                    $valIcon = match($latestMeasure['status_validasi']) {
                                        'pending' => '⏳',
                                        'approved' => '✔',
                                        'rejected' => '✖',
                                        default => ''
                                    };
                                @endphp
                                <div class="flex items-center gap-1.5 {{ $valColors }} px-2.5 py-1 sm:px-3 sm:py-1.5 rounded-full border bg-white/90 shadow-sm">
                                    <span class="text-[10px] sm:text-[11px] leading-none">{{ $valIcon }}</span>
                                    <span class="text-[9px] sm:text-[10px] font-extrabold uppercase tracking-widest">{{ $latestMeasure['status_validasi'] }}</span>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Metadata Tags -->
                        <div class="flex flex-wrap items-center gap-1.5 sm:gap-2">
                            <div class="flex items-center gap-1.5 bg-slate-100/80 border border-slate-200/60 px-2 py-1 sm:px-2.5 sm:py-1 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 text-slate-400">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-[11px] sm:text-[12px] font-bold text-slate-700">{{ $age }}</span>
                            </div>
                            
                            <div class="flex items-center gap-1.5 bg-slate-100/80 border border-slate-200/60 px-2 py-1 sm:px-2.5 sm:py-1 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 text-slate-400">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                </svg>
                                <span class="text-[11px] sm:text-[12px] font-medium text-slate-500">Ibu: <span class="font-bold text-slate-700">{{ $motherName }}</span></span>
                            </div>
                            
                            <div class="flex items-center gap-1.5 bg-slate-100/80 border border-slate-200/60 px-2 py-1 sm:px-2.5 sm:py-1 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 text-slate-400">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5" />
                                </svg>
                                <span class="text-[11px] sm:text-[12px] font-medium text-slate-500">NIK: <span class="font-bold text-slate-700 font-mono">{{ $nik }}</span></span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Mobile Ukur Button -->
                <div class="block sm:hidden w-full mt-2">
                    <button onclick="openMeasurementModal()" class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white px-6 h-[44px] rounded-xl font-bold text-[14px] shadow-[0_4px_12px_-2px_rgba(16,185,129,0.4)] active:scale-[0.98] transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Ukur Sekarang
                    </button>
                </div>
                
                <!-- Desktop Actions -->
                <div class="hidden sm:flex lg:hidden w-full mt-4">
                    <!-- tablet action if needed, currently button is shown below in another block for tablet/desktop -->
                </div>
                
                <!-- Primary CTA (Desktop & Tablet) -->
                <div class="hidden sm:flex shrink-0">
                    <button onclick="openMeasurementModal()" class="group relative flex items-center justify-center gap-2 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white px-6 h-[44px] rounded-full font-bold text-[14px] shadow-[0_8px_20px_-6px_rgba(16,185,129,0.4)] hover:shadow-[0_12px_24px_-8px_rgba(16,185,129,0.6)] hover:-translate-y-0.5 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 group-hover:scale-110 transition-transform duration-300">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Ukur Sekarang
                        <div class="absolute inset-0 rounded-full bg-white opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- CENTRAL WORKSPACE                          -->
    <!-- ========================================== -->
    <div class="max-w-7xl mx-auto w-full px-5 mt-8 lg:mt-10">
        
        <!-- Segmented Tab Navigation -->
        <div class="inline-flex bg-slate-200/50 p-1 rounded-[14px] mb-8 overflow-x-auto max-w-full hide-scrollbar" id="profile-tabs">
            <button onclick="switchTab('ringkasan')" id="tab-ringkasan" class="tab-btn whitespace-nowrap px-6 py-2.5 rounded-[10px] text-[14px] font-bold text-slate-900 bg-white shadow-sm border border-slate-200/50 transition-all focus:outline-none">
                Ringkasan
            </button>
            <button onclick="switchTab('riwayat')" id="tab-riwayat" class="tab-btn whitespace-nowrap px-6 py-2.5 rounded-[10px] text-[14px] font-semibold text-slate-500 hover:text-slate-800 border border-transparent transition-all focus:outline-none">
                Riwayat Pengukuran
            </button>
            <button onclick="switchTab('grafik')" id="tab-grafik" class="tab-btn whitespace-nowrap px-6 py-2.5 rounded-[10px] text-[14px] font-semibold text-slate-500 hover:text-slate-800 border border-transparent transition-all focus:outline-none">
                Grafik Pertumbuhan
            </button>
        </div>

        <!-- Tab Contents -->
        <div class="w-full relative pb-20 lg:pb-0">
            
            <!-- TAB: RINGKASAN -->
            <div id="content-ringkasan" class="tab-content flex flex-col gap-8 lg:gap-10">
                <!-- SKRINING CARD (Medical Alert Style) -->
                <div class="flex items-start gap-4 p-5 lg:p-6 {{ $status_type == 'danger' ? 'bg-rose-50' : ($status_type == 'warning' ? 'bg-amber-50' : 'bg-emerald-50') }} rounded-[24px] border border-white shadow-[0_2px_12px_-4px_rgba(0,0,0,0.05)] relative overflow-hidden group">
                    
                    <!-- Left Accent Border -->
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 {{ $status_type == 'danger' ? 'bg-rose-500' : ($status_type == 'warning' ? 'bg-amber-500' : 'bg-emerald-500') }}"></div>
                    
                    <div class="{{ $status_type == 'danger' ? 'text-rose-600' : ($status_type == 'warning' ? 'text-amber-600' : 'text-emerald-600') }} shrink-0 bg-white p-3 rounded-2xl shadow-sm group-hover:scale-105 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="flex flex-col ml-1">
                        <span class="text-[16px] font-extrabold text-slate-900 tracking-tight mb-1.5">Hasil Skrining: <span class="{{ $status_type == 'danger' ? 'text-rose-600' : ($status_type == 'warning' ? 'text-amber-600' : 'text-emerald-600') }}">{{ $latestMeasure['status'] ?? 'Belum Diukur' }}</span></span>
                        <span class="text-[14px] text-slate-600 font-medium leading-relaxed max-w-3xl">
                            {{ $latestMeasure['education'] ?? 'Lakukan pengukuran rutin setiap bulan untuk memantau tumbuh kembang anak.' }}
                        </span>
                    </div>
                </div>

                <!-- MEASUREMENT SUMMARY KPI -->
                <div class="flex flex-col gap-4">
                    <div class="flex items-center justify-between px-1">
                        <h2 class="text-[18px] font-black text-slate-900 tracking-tight">Pengukuran Terakhir</h2>
                        <span class="text-[12px] font-bold text-emerald-700 bg-emerald-100/80 px-3 py-1.5 rounded-lg flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                            {{ $latestMeasure['date'] ?? 'Belum ada data' }}
                        </span>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 lg:gap-5">
                        
                        <!-- Berat Badan Card -->
                        <div class="bg-gradient-to-br from-emerald-500/5 to-emerald-500/10 border border-emerald-200/50 rounded-[20px] p-5 lg:p-6 flex flex-col relative overflow-hidden group">
                            <div class="absolute -right-4 -top-4 w-32 h-32 bg-emerald-500/10 rounded-full blur-2xl group-hover:bg-emerald-500/15 transition-colors duration-500"></div>
                            <div class="flex items-center justify-between mb-6 relative z-10">
                                <span class="text-[14px] font-bold text-emerald-800">Berat Badan</span>
                                <div class="w-8 h-8 rounded-xl bg-white shadow-sm flex items-center justify-center text-emerald-500 border border-emerald-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                      <path d="M12 7.5a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5z" />
                                      <path fill-rule="evenodd" d="M1.5 4.875C1.5 3.839 2.34 3 3.375 3h17.25c1.035 0 1.875.84 1.875 1.875v9.75c0 1.036-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 011.5 14.625v-9.75zM8.25 9.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM18.75 9a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75V9.75a.75.75 0 00-.75-.75h-.008zM4.5 9.75A.75.75 0 015.25 9h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H5.25a.75.75 0 01-.75-.75V9.75z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex items-baseline gap-1.5 mt-auto relative z-10">
                                <span class="text-[36px] lg:text-[44px] font-black text-slate-900 tracking-tighter leading-none">{{ $latestMeasure['weight'] ?? '-' }}</span>
                                <span class="text-[14px] font-extrabold text-slate-400">kg</span>
                            </div>
                        </div>
                        
                        <!-- Tinggi Badan Card -->
                        <div class="bg-gradient-to-br from-indigo-500/5 to-indigo-500/10 border border-indigo-200/50 rounded-[20px] p-5 lg:p-6 flex flex-col relative overflow-hidden group">
                            <div class="absolute -right-4 -top-4 w-32 h-32 bg-indigo-500/10 rounded-full blur-2xl group-hover:bg-indigo-500/15 transition-colors duration-500"></div>
                            <div class="flex items-center justify-between mb-6 relative z-10">
                                <span class="text-[14px] font-bold text-indigo-800">Tinggi Badan</span>
                                <div class="w-8 h-8 rounded-xl bg-white shadow-sm flex items-center justify-center text-indigo-500 border border-indigo-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                      <path fill-rule="evenodd" d="M11.47 2.47a.75.75 0 011.06 0l4.5 4.5a.75.75 0 01-1.06 1.06l-3.22-3.22V16.5a.75.75 0 01-1.5 0V4.81L8.03 8.03a.75.75 0 01-1.06-1.06l4.5-4.5z" clip-rule="evenodd" />
                                      <path fill-rule="evenodd" d="M3 20.25a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex items-baseline gap-1.5 mt-auto relative z-10">
                                <span class="text-[36px] lg:text-[44px] font-black text-slate-900 tracking-tighter leading-none">{{ $latestMeasure['height'] ?? '-' }}</span>
                                <span class="text-[14px] font-extrabold text-slate-400">cm</span>
                            </div>
                        </div>
                        
                        <!-- Lingkar Kepala Card -->
                        <div class="bg-gradient-to-br from-violet-500/5 to-violet-500/10 border border-violet-200/50 rounded-[20px] p-5 lg:p-6 flex flex-col relative overflow-hidden group">
                            <div class="absolute -right-4 -top-4 w-32 h-32 bg-violet-500/10 rounded-full blur-2xl group-hover:bg-violet-500/15 transition-colors duration-500"></div>
                            <div class="flex items-center justify-between mb-6 relative z-10">
                                <span class="text-[14px] font-bold text-violet-800">Lingkar Kepala</span>
                                <div class="w-8 h-8 rounded-xl bg-white shadow-sm flex items-center justify-center text-violet-500 border border-violet-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                      <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm0 15a5.25 5.25 0 100-10.5 5.25 5.25 0 000 10.5z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex items-baseline gap-1.5 mt-auto relative z-10">
                                <span class="text-[36px] lg:text-[44px] font-black text-slate-900 tracking-tighter leading-none">{{ $latestMeasure['head_circ'] ?? '-' }}</span>
                                <span class="text-[14px] font-extrabold text-slate-400">cm</span>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <!-- PERSONAL INFORMATION TILES -->
                <div class="flex flex-col gap-4 mt-2">
                    <div class="flex items-center justify-between px-1">
                        <h2 class="text-[18px] font-black text-slate-900 tracking-tight">Informasi Personal</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Gender -->
                        <div class="bg-white rounded-[20px] p-5 shadow-[0_4px_12px_-6px_rgba(0,0,0,0.05)] border border-slate-200/60 flex items-start gap-4 hover:border-slate-300 transition-colors">
                            <div class="w-10 h-10 rounded-[12px] bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-400 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                            </div>
                            <div class="flex flex-col gap-0.5">
                                <span class="text-[12px] font-bold text-slate-400 uppercase tracking-wide">Jenis Kelamin</span>
                                <span class="text-slate-900 font-extrabold text-[15px]">{{ $gender }}</span>
                            </div>
                        </div>
                        
                        <!-- Posyandu -->
                        <div class="bg-white rounded-[20px] p-5 shadow-[0_4px_12px_-6px_rgba(0,0,0,0.05)] border border-slate-200/60 flex items-start gap-4 hover:border-slate-300 transition-colors">
                            <div class="w-10 h-10 rounded-[12px] bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-400 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" /></svg>
                            </div>
                            <div class="flex flex-col gap-0.5">
                                <span class="text-[12px] font-bold text-slate-400 uppercase tracking-wide">Posyandu</span>
                                <span class="text-slate-900 font-extrabold text-[15px]">{{ $posyanduName }}</span>
                            </div>
                        </div>
                        
                        <!-- HP -->
                        <div class="bg-white rounded-[20px] p-5 shadow-[0_4px_12px_-6px_rgba(0,0,0,0.05)] border border-slate-200/60 flex items-start gap-4 hover:border-slate-300 transition-colors">
                            <div class="w-10 h-10 rounded-[12px] bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-400 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" /></svg>
                            </div>
                            <div class="flex flex-col gap-0.5">
                                <span class="text-[12px] font-bold text-slate-400 uppercase tracking-wide">Nomor HP Ibu</span>
                                <span class="text-slate-900 font-extrabold text-[15px]">{{ $motherPhone }}</span>
                            </div>
                        </div>
                        
                        <!-- Alamat -->
                        <div class="bg-white rounded-[20px] p-5 shadow-[0_4px_12px_-6px_rgba(0,0,0,0.05)] border border-slate-200/60 flex items-start gap-4 hover:border-slate-300 transition-colors sm:col-span-2 lg:col-span-1">
                            <div class="w-10 h-10 rounded-[12px] bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-400 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                            </div>
                            <div class="flex flex-col gap-0.5">
                                <span class="text-[12px] font-bold text-slate-400 uppercase tracking-wide">Alamat Lengkap</span>
                                <span class="text-slate-900 font-bold text-[14px] leading-snug">
                                    {{ $address }}
                                    @if($addressSub)
                                        <span class="text-slate-500 font-medium text-[12px] block mt-0.5">{{ $addressSub }}</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB: RIWAYAT -->
            <div id="content-riwayat" class="tab-content hidden flex flex-col max-w-4xl p-6 lg:p-8 bg-white border border-slate-200/60 rounded-[24px] shadow-sm">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-[18px] font-black text-slate-900 tracking-tight">Riwayat Pengukuran</h2>
                </div>
                <div class="flex flex-col">
                    @forelse($measurements as $measure)
                        <x-timeline-item :measurement="$measure" :is-last="$loop->last" />
                    @empty
                        <div class="py-12 flex flex-col items-center justify-center text-center">
                            <div class="w-16 h-16 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mb-5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <span class="text-[16px] font-bold text-slate-900">Belum Ada Riwayat</span>
                            <p class="text-[14px] text-slate-500 mt-1">Anak belum pernah diukur. Silakan lakukan pengukuran pertama.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- TAB: GRAFIK -->
            <div id="content-grafik" class="tab-content hidden flex flex-col max-w-5xl p-6 lg:p-8 bg-white border border-slate-200/60 rounded-[24px] shadow-sm">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-8 gap-4">
                    <h2 class="text-[18px] font-black text-slate-900 tracking-tight">Grafik Pertumbuhan</h2>
                    @if(count($measurements) > 0)
                    <div class="max-w-xs w-full lg:w-auto">
                        <select class="w-full bg-slate-50 border border-slate-200/80 text-slate-700 text-[14px] font-bold rounded-xl px-4 h-[44px] focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400 transition-colors shadow-sm">
                            <option>Berat Badan per Umur (BB/U)</option>
                            <option>Tinggi Badan per Umur (TB/U)</option>
                        </select>
                    </div>
                    @endif
                </div>

                @if(count($measurements) > 0)
                <div class="relative h-[400px] w-full rounded-[16px] overflow-hidden border border-slate-100 bg-slate-50/50 p-4 lg:p-6">
                    <canvas id="growthChart" class="w-full h-full"></canvas>
                </div>
                @else
                <div class="py-12 flex flex-col items-center text-center">
                    <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center mb-5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-slate-300">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                        </svg>
                    </div>
                    <span class="text-[16px] font-bold text-slate-900">Belum Ada Grafik</span>
                    <p class="text-[14px] text-slate-500 mt-1 max-w-[250px] mx-auto">Lakukan pengukuran terlebih dahulu untuk melihat grafik pertumbuhan.</p>
                </div>
                @endif
            </div>

        </div>
    </div>
    
    <!-- Mobile Floating CTA (Fixed Bottom) - Removed as it overlaps with footer -->
</div>

@push('modals')

<script>
    function switchTab(tabId) {
        document.querySelectorAll('.tab-content').forEach(el => {
            el.classList.add('hidden');
        });
        
        const activeClasses = ['text-slate-900', 'bg-white', 'shadow-sm', 'border-slate-200/50'];
        const inactiveClasses = ['text-slate-500', 'border-transparent', 'hover:text-slate-800'];
        
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rawData = @json($measurements);
        const chartData = [...rawData].reverse(); // Oldest first for chart
        
        const labels = chartData.map(d => d.date);
        const bbData = chartData.map(d => d.weight);
        
        const ctx = document.getElementById('growthChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Berat Badan (kg)',
                        data: bbData,
                        borderColor: '#10b981', // emerald-500
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        borderWidth: 3,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#10b981',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(15, 23, 42, 0.9)',
                            titleFont: { size: 13, family: "'Inter', sans-serif" },
                            bodyFont: { size: 14, family: "'Inter', sans-serif", weight: 'bold' },
                            padding: 12,
                            cornerRadius: 8,
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y + ' kg';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(226, 232, 240, 0.6)',
                                borderDash: [4, 4],
                                drawBorder: false
                            },
                            ticks: {
                                font: { family: "'Inter', sans-serif", size: 12 },
                                color: '#64748b'
                            }
                        },
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                font: { family: "'Inter', sans-serif", size: 12 },
                                color: '#64748b'
                            }
                        }
                    }
                }
            });
        }
    });
</script>

<x-measurement-modal 
    :balita-id="$balitaId"
    :child-name="$childName" 
    :age="$age" 
    :last-weight="$latestMeasure['weight'] ?? null" 
    :last-height="$latestMeasure['height'] ?? null" 
    :last-date="$latestMeasure['date'] ?? null" 
/>
@endpush

@endsection
