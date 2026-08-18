@extends('layouts.app')

@section('page-title', 'Profil Balita')

@section('content')

@php
    $colorMap = [
        'success' => 'emerald',
        'warning' => 'amber',
        'danger'  => 'rose',
    ];
    $colorClass = $colorMap[$status_type] ?? 'slate';

    $statusBadgeClasses = [
        'success' => 'bg-emerald-50 text-emerald-800 border border-emerald-200/80',
        'warning' => 'bg-amber-50 text-amber-800 border border-amber-200/80',
        'danger'  => 'bg-rose-50 text-rose-800 border border-rose-200/80',
    ];
    $badgeClasses = $statusBadgeClasses[$status_type] ?? 'bg-slate-50 text-slate-700 border border-slate-200/80';
    $badgeIcon = match($status_type) {
        'danger' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 text-rose-600"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2.25m0 2.625h.008v.008H12v-.008zM12 3a9 9 0 100 18 9 9 0 000-18z" /></svg>',
        'warning' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 text-amber-600"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2.25m0 2.625h.008v.008H12v-.008zM12 3a9 9 0 100 18 9 9 0 000-18z" /></svg>',
        default => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 text-emerald-600"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>'
    };
@endphp

<!-- MAIN CANVAS -->
<div class="bg-slate-50/50 min-h-screen relative w-full pb-[calc(5rem+env(safe-area-inset-bottom))] lg:pb-16 font-sans">
    
    {{-- Script for Framer Motion --}}
    <script type="module">
        document.addEventListener('DOMContentLoaded', () => {
            if(window.Motion) {
                const { animate, stagger, hover } = window.Motion;
                animate('.motion-card', 
                    { opacity: [0, 1], y: [20, 0] }, 
                    { delay: stagger(0.05), duration: 0.4, easing: "ease-out" }
                );
            }
        });
    </script>
    
    <!-- Top Header Actions -->
    <div class="max-w-7xl mx-auto px-4 lg:px-8 pt-6 pb-4 flex items-center justify-between">
        <a href="{{ route('balita.index') }}" class="inline-flex items-center gap-2.5 px-3.5 py-2 rounded-xl border border-slate-200/80 bg-white hover:bg-slate-50 text-slate-600 hover:text-slate-900 transition-all font-semibold text-[13.5px] shadow-xs">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-slate-500">
              <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Daftar Balita
        </a>
        <div class="flex items-center gap-2 sm:gap-3">
            <a href="{{ route('balita.edit', $balitaId) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 sm:px-4 sm:py-2 rounded-xl border border-slate-200/80 bg-white hover:bg-slate-50 text-slate-700 font-bold text-[13px] shadow-xs transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 text-slate-500"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" /></svg> 
                <span>Edit</span>
            </a>
            <form id="delete-balita-{{ $balitaId }}" action="{{ route('balita.destroy', $balitaId) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" onclick="if(window.NutriAlert && typeof window.NutriAlert.confirm === 'function'){ window.NutriAlert.confirm('Hapus Balita?', 'Data yang dihapus tidak dapat dikembalikan!', 'Hapus', 'Batal').then((r) => { if(r.isConfirmed) document.getElementById('delete-balita-{{ $balitaId }}').submit(); }); } else { if(confirm('Hapus balita ini?')) document.getElementById('delete-balita-{{ $balitaId }}').submit(); }" class="inline-flex items-center gap-1.5 px-3.5 py-2 sm:px-4 sm:py-2 rounded-xl border border-rose-200/80 bg-rose-50/50 hover:bg-rose-50 text-rose-600 font-bold text-[13px] shadow-xs transition-all cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg> 
                    <span>Hapus</span>
                </button>
            </form>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 lg:px-8 space-y-6">
        
        <!-- MASTER CHILD PROFILE & HEALTH INSIGHT CARD -->
        <div class="bg-white rounded-3xl p-5 sm:p-7 shadow-[0_12px_35px_-8px_rgba(13,148,136,0.07),0_2px_10px_rgba(0,0,0,0.02)] border border-slate-100 relative overflow-hidden motion-card opacity-0">
            
            <!-- Soft Ambient Glow Aura -->
            <div class="absolute -top-24 -right-24 w-80 h-80 rounded-full bg-gradient-to-bl from-teal-100/60 via-emerald-50/30 to-transparent blur-2xl pointer-events-none"></div>

            <!-- Top Identity & Actions Row -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative z-10">
                
                <!-- Avatar & Identity Details -->
                <div class="flex items-center gap-4 sm:gap-5 min-w-0 flex-1">
                    
                    <!-- Avatar with Glowing Soft Gradient Ring -->
                    <div class="relative shrink-0">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-gradient-to-tr from-teal-500 via-emerald-400 to-teal-400 p-[2.5px] shadow-[0_6px_18px_-3px_rgba(13,148,136,0.3)]">
                            <div class="w-full h-full rounded-[13.5px] bg-gradient-to-br from-white via-teal-50/60 to-emerald-50/80 flex items-center justify-center">
                                <span class="text-2xl sm:text-3xl font-black bg-gradient-to-br from-teal-700 to-emerald-600 bg-clip-text text-transparent select-none">
                                    {{ strtoupper(substr($childName, 0, 1)) }}
                                </span>
                            </div>
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-white rounded-full flex items-center justify-center shadow-xs border border-slate-200 text-teal-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Name, Gender & Age -->
                    <div class="flex flex-col min-w-0 flex-1">
                        <div class="flex items-center gap-2.5 flex-wrap">
                            <h1 class="text-[20px] sm:text-[24px] font-bold text-slate-800 tracking-tight leading-tight truncate">{{ $childName }}</h1>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold {{ $gender === 'L' ? 'bg-sky-50 text-sky-700 border border-sky-200/80' : 'bg-pink-50 text-pink-700 border border-pink-200/80' }}">
                                {{ $gender === 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </span>
                        </div>

                        <div class="flex items-center gap-2 mt-1.5">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-100/90 text-slate-700 rounded-full text-[11.5px] font-semibold border border-slate-200/60">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 text-slate-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ $age }}</span>
                            </span>
                        </div>
                    </div>

                </div>

                <!-- Desktop CTA Button -->
                <div class="hidden sm:flex items-center shrink-0">
                    <button onclick="openMeasurementModal()" class="px-5 py-2.5 bg-gradient-to-r from-teal-600 via-teal-500 to-emerald-600 hover:from-teal-700 hover:to-emerald-700 text-white font-bold text-[13.5px] rounded-xl shadow-[0_4px_16px_-2px_rgba(13,148,136,0.4)] hover:shadow-[0_6px_20px_-2px_rgba(13,148,136,0.5)] active:scale-[0.98] transition-all flex items-center gap-2 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg> 
                        <span>Ukur Sekarang</span>
                    </button>
                </div>

            </div>

            <!-- Integrated Growth Status & Screening Banner -->
            @php
                $statusBannerBg = $status_type == 'danger' 
                    ? 'bg-rose-50/80 border-rose-200/80 text-rose-900' 
                    : ($status_type == 'warning' 
                        ? 'bg-amber-50/80 border-amber-200/80 text-amber-900' 
                        : 'bg-emerald-50/80 border-emerald-200/80 text-emerald-900');
                $statusDot = $status_type == 'danger' ? 'bg-rose-500' : ($status_type == 'warning' ? 'bg-amber-500' : 'bg-emerald-500');
                $valBadgeStyle = match($latestMeasure['status_validasi'] ?? '') {
                    'pending' => 'bg-amber-100/80 text-amber-800 border-amber-200',
                    'approved' => 'bg-emerald-100/80 text-emerald-800 border-emerald-200',
                    'rejected' => 'bg-rose-100/80 text-rose-800 border-rose-200',
                    default => 'bg-slate-100 text-slate-700 border-slate-200'
                };
            @endphp
            <div class="mt-4 p-3.5 sm:p-4 rounded-2xl {{ $statusBannerBg }} border flex flex-col sm:flex-row sm:items-center justify-between gap-3 relative z-10">
                <div class="flex items-start sm:items-center gap-3 min-w-0">
                    <span class="w-3 h-3 rounded-full {{ $statusDot }} shrink-0 mt-1 sm:mt-0 shadow-xs animate-pulse"></span>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-2.5">
                        <span class="font-bold text-[13.5px]">Status Gizi: {{ $status }}</span>
                        <span class="hidden sm:inline text-slate-400">•</span>
                        <span class="text-xs text-slate-600 font-medium leading-relaxed">{{ $latestMeasure['education'] ?? 'Lakukan pengukuran rutin setiap bulan untuk memantau tumbuh kembang anak.' }}</span>
                    </div>
                </div>

                @if(!empty($latestMeasure['status_validasi']))
                    <div class="shrink-0 flex items-center">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold border {{ $valBadgeStyle }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span>{{ $latestMeasure['status_validasi'] === 'approved' ? 'Terverifikasi Puskesmas' : ($latestMeasure['status_validasi'] === 'rejected' ? 'Ditolak Puskesmas' : 'Menunggu Validasi') }}</span>
                        </span>
                    </div>
                @endif
            </div>

            <!-- Key Bio Information Strip -->
            <div class="mt-4.5 pt-3.5 border-t border-slate-100/90 grid grid-cols-1 sm:grid-cols-3 gap-2.5 sm:gap-4 text-[13px] relative z-10">
                
                <!-- Ibu -->
                <div class="flex items-center gap-2.5 min-w-0">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 border border-teal-100/80 text-teal-600 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                    </div>
                    <span class="text-slate-400 font-medium text-xs shrink-0">Ibu:</span>
                    <strong class="font-bold text-slate-800 text-xs sm:text-[13px] truncate">{{ $motherName }}</strong>
                </div>

                <!-- NIK -->
                <div class="flex items-center gap-2.5 min-w-0">
                    <div class="w-7 h-7 rounded-lg bg-sky-50 border border-sky-100/80 text-sky-600 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" /></svg>
                    </div>
                    <span class="text-slate-400 font-medium text-xs shrink-0">NIK:</span>
                    <strong class="font-bold text-slate-800 font-mono text-xs sm:text-[13px] tracking-wider truncate">{{ $nik }}</strong>
                    <button onclick="navigator.clipboard.writeText('{{ $nik }}'); window.NutriAlert.toast('Berhasil!', 'NIK disalin', 'success');" class="p-1 text-slate-400 hover:text-slate-700 hover:bg-slate-100 rounded-md transition-colors cursor-pointer shrink-0" title="Salin NIK">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" /></svg>
                    </button>
                </div>

                <!-- Posyandu -->
                <div class="flex items-center gap-2.5 min-w-0">
                    <div class="w-7 h-7 rounded-lg bg-indigo-50 border border-indigo-100/80 text-indigo-600 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                    </div>
                    <span class="text-slate-400 font-medium text-xs shrink-0">Posyandu:</span>
                    <strong class="font-bold text-slate-800 text-xs sm:text-[13px] truncate">{{ $posyanduName }}</strong>
                </div>

            </div>

            <!-- Mobile Action Button (Full Width at Bottom) -->
            <div class="mt-4 sm:hidden">
                <button onclick="openMeasurementModal()" class="w-full py-3 bg-gradient-to-r from-teal-600 via-teal-500 to-emerald-600 hover:from-teal-700 hover:to-emerald-700 text-white font-bold text-[14px] rounded-xl shadow-[0_4px_16px_-2px_rgba(13,148,136,0.4)] active:scale-[0.98] transition-all flex items-center justify-center gap-2 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg> 
                    <span>Ukur Sekarang</span>
                </button>
            </div>

        </div>

    </div>

    <!-- Segmented Tab Navigation -->
    <div class="max-w-7xl mx-auto px-4 lg:px-8 mt-6 mb-6 lg:mb-8 motion-card opacity-0" id="profile-tabs">
        <div class="bg-slate-200/60 p-1.5 rounded-2xl flex gap-1.5 overflow-x-auto hide-scrollbar">
            <button onclick="switchTab('ringkasan')" id="tab-ringkasan" class="px-4.5 py-2.5 rounded-xl bg-white text-teal-800 font-bold text-[13px] sm:text-[14px] transition-all whitespace-nowrap cursor-pointer shadow-xs">
                Ringkasan
            </button>
            <button onclick="switchTab('detail')" id="tab-detail" class="px-4.5 py-2.5 rounded-xl text-slate-600 hover:text-slate-900 font-semibold text-[13px] sm:text-[14px] transition-all whitespace-nowrap cursor-pointer">
                Detail Informasi
            </button>
            <button onclick="switchTab('riwayat')" id="tab-riwayat" class="px-4.5 py-2.5 rounded-xl text-slate-600 hover:text-slate-900 font-semibold text-[13px] sm:text-[14px] transition-all whitespace-nowrap cursor-pointer">
                Riwayat Pengukuran
            </button>
            <button onclick="switchTab('grafik')" id="tab-grafik" class="px-4.5 py-2.5 rounded-xl text-slate-600 hover:text-slate-900 font-semibold text-[13px] sm:text-[14px] transition-all whitespace-nowrap cursor-pointer">
                Grafik Pertumbuhan
            </button>
        </div>
    </div>

    <!-- Content Area -->
    <div class="max-w-7xl mx-auto px-4 lg:px-8 pb-10 motion-card opacity-0">
        
        <!-- TAB 1: RINGKASAN (Clean, Focused Growth Metrics) -->
        <div id="content-ringkasan" class="tab-content flex flex-col gap-6">
            
            <div class="bg-white rounded-[28px] p-6 lg:p-8 border border-slate-200/80 shadow-[0_8px_30px_rgb(0,0,0,0.04)] flex flex-col">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
                    <div>
                        <h2 class="text-xl font-bold text-slate-800 tracking-tight">Pengukuran Terakhir</h2>
                        <p class="text-[13px] text-slate-500 mt-0.5 font-medium">Hasil penimbangan dan pengukuran antropometri terkini</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="flex items-center gap-1.5 text-emerald-700 bg-emerald-50 px-3 py-1.5 rounded-xl border border-emerald-200/60 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" /></svg>
                            <span class="text-xs font-bold">{{ $latestMeasure['date'] ?? 'Belum ada data' }}</span>
                        </div>
                    </div>
                </div>

                <!-- 3 Metrik Utama -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
                    
                    <!-- Berat Badan -->
                    <div class="bg-gradient-to-br from-emerald-50/70 to-emerald-100/40 border border-emerald-200/70 rounded-2xl p-6 flex flex-col justify-between shadow-sm relative overflow-hidden group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path d="M12 7.5a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5z" /><path fill-rule="evenodd" d="M1.5 4.875C1.5 3.839 2.34 3 3.375 3h17.25c1.035 0 1.875.84 1.875 1.875v9.75c0 1.036-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 011.5 14.625v-9.75zM8.25 9.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM18.75 9a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75V9.75a.75.75 0 00-.75-.75h-.008zM4.5 9.75A.75.75 0 015.25 9h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H5.25a.75.75 0 01-.75-.75V9.75z" clip-rule="evenodd" /></svg>
                                </div>
                                <span class="text-sm font-bold text-slate-700">Berat Badan</span>
                            </div>
                            @if(!empty($latestMeasure['weight_trend']) && $latestMeasure['weight_trend'] > 0)
                                <span class="inline-flex items-center gap-1 text-xs font-bold text-emerald-700 bg-emerald-100/80 px-2.5 py-1 rounded-full border border-emerald-200">
                                    +{{ $latestMeasure['weight_trend'] }} kg
                                </span>
                            @elseif(!empty($latestMeasure['weight_trend']) && $latestMeasure['weight_trend'] < 0)
                                <span class="inline-flex items-center gap-1 text-xs font-bold text-rose-700 bg-rose-100/80 px-2.5 py-1 rounded-full border border-rose-200">
                                    {{ $latestMeasure['weight_trend'] }} kg
                                </span>
                            @endif
                        </div>
                        <div class="flex items-baseline gap-2 mb-3">
                            <span class="text-3xl sm:text-4xl font-black text-slate-800 tracking-tight">{{ $latestMeasure['weight'] ?? '-' }}</span>
                            <span class="text-base font-bold text-slate-500">kg</span>
                        </div>
                        <div class="flex items-center justify-between pt-2 border-t border-emerald-200/50 text-xs">
                            <span class="text-slate-500 font-medium">Z-Score BB/U</span>
                            <span class="font-bold text-slate-700">{{ isset($latestMeasure['z_score_bbu']) && $latestMeasure['z_score_bbu'] !== null ? $latestMeasure['z_score_bbu'] . ' SD' : '-' }}</span>
                        </div>
                    </div>
                    
                    <!-- Tinggi / Panjang Badan -->
                    <div class="bg-gradient-to-br from-amber-50/70 to-amber-100/40 border border-amber-200/70 rounded-2xl p-6 flex flex-col justify-between shadow-sm relative overflow-hidden group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path fill-rule="evenodd" d="M11.47 2.47a.75.75 0 011.06 0l4.5 4.5a.75.75 0 01-1.06 1.06l-3.22-3.22V16.5a.75.75 0 01-1.5 0V4.81L8.03 8.03a.75.75 0 01-1.06-1.06l4.5-4.5z" clip-rule="evenodd" /><path fill-rule="evenodd" d="M3 20.25a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75z" clip-rule="evenodd" /></svg>
                                </div>
                                <span class="text-sm font-bold text-slate-700">Tinggi / Panjang</span>
                            </div>
                            @if(!empty($latestMeasure['height_trend']) && $latestMeasure['height_trend'] > 0)
                                <span class="inline-flex items-center gap-1 text-xs font-bold text-emerald-700 bg-emerald-100/80 px-2.5 py-1 rounded-full border border-emerald-200">
                                    +{{ $latestMeasure['height_trend'] }} cm
                                </span>
                            @endif
                        </div>
                        <div class="flex items-baseline gap-2 mb-3">
                            <span class="text-3xl sm:text-4xl font-black text-slate-800 tracking-tight">{{ $latestMeasure['height'] ?? '-' }}</span>
                            <span class="text-base font-bold text-slate-500">cm</span>
                        </div>
                        <div class="flex items-center justify-between pt-2 border-t border-amber-200/50 text-xs">
                            <span class="text-slate-500 font-medium">Z-Score TB/U</span>
                            <span class="font-bold text-slate-700">{{ isset($latestMeasure['z_score_tbu']) && $latestMeasure['z_score_tbu'] !== null ? $latestMeasure['z_score_tbu'] . ' SD' : '-' }}</span>
                        </div>
                    </div>
                    
                    <!-- Lingkar Kepala -->
                    <div class="bg-gradient-to-br from-teal-50/70 to-teal-100/40 border border-teal-200/70 rounded-2xl p-6 flex flex-col justify-between shadow-sm relative overflow-hidden group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 rounded-xl bg-teal-100 text-teal-600 flex items-center justify-center shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm0 15a5.25 5.25 0 100-10.5 5.25 5.25 0 000 10.5z" clip-rule="evenodd" /></svg>
                                </div>
                                <span class="text-sm font-bold text-slate-700">Lingkar Kepala</span>
                            </div>
                            @if(!empty($latestMeasure['asi_eksklusif']))
                                <span class="inline-flex items-center gap-1 text-[11px] font-bold text-teal-700 bg-teal-100/80 px-2.5 py-1 rounded-full border border-teal-200">
                                    ASI Eksklusif
                                </span>
                            @endif
                        </div>
                        <div class="flex items-baseline gap-2 mb-3">
                            <span class="text-3xl sm:text-4xl font-black text-slate-800 tracking-tight">{{ $latestMeasure['head_circ'] ?? '-' }}</span>
                            <span class="text-base font-bold text-slate-500">cm</span>
                        </div>
                        <div class="flex items-center justify-between pt-2 border-t border-teal-200/50 text-xs">
                            <span class="text-slate-500 font-medium">Status Pengukuran</span>
                            <span class="font-bold text-teal-700">{{ !empty($latestMeasure['head_circ']) ? 'Tercatat Sesuai KIA' : 'Belum Ada Data' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Action Strip -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-teal-100 text-teal-700 flex items-center justify-center font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" /></svg>
                        </div>
                        <div>
                            <span class="text-sm font-bold text-slate-800">Riwayat & Analisis Pertumbuhan</span>
                            <p class="text-xs text-slate-500">Lihat grafik kenaikan berat/tinggi badan dan data historis balita ini.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2.5 w-full sm:w-auto">
                        <button onclick="switchTab('riwayat')" class="flex-1 sm:flex-none px-4 py-2.5 bg-white border border-slate-200 hover:border-slate-300 text-slate-700 text-xs font-bold rounded-xl shadow-sm transition-all">
                            Buka Riwayat
                        </button>
                        <button onclick="openMeasurementModal()" class="flex-1 sm:flex-none px-5 py-2.5 bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold rounded-xl shadow-sm shadow-teal-500/20 transition-all flex items-center justify-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                            Ukur Ulang
                        </button>
                    </div>
                </div>

            </div>
        </div>

        <!-- TAB 2: DETAIL INFORMASI (Comprehensive 2-Column KMS Master View) -->
        <div id="content-detail" class="tab-content hidden flex flex-col gap-6">
            <div class="bg-white rounded-[28px] p-6 lg:p-8 border border-slate-200/80 shadow-[0_8px_30px_rgb(0,0,0,0.04)] flex flex-col">
                
                <!-- Section Header -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 mb-6 border-b border-slate-100">
                    <div>
                        <h2 class="text-xl font-bold text-slate-800 tracking-tight">Detail Identitas & Standar KIA/KMS</h2>
                        <p class="text-[13px] text-slate-500 mt-0.5 font-medium">Informasi lengkap kependudukan, data kelahiran, orang tua/wali, dan domisili</p>
                    </div>
                    <a href="{{ route('balita.edit', $balitaId) }}" 
                       class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-slate-100 hover:bg-teal-50 text-slate-700 hover:text-teal-700 border border-slate-200 hover:border-teal-200 rounded-xl text-xs font-bold transition-all shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" /></svg>
                        Edit Data Balita
                    </a>
                </div>

                <!-- 2-Column Responsive Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                    
                    <!-- COLUMN 1: IDENTITAS BALITA & KELAHIRAN -->
                    <div class="flex flex-col gap-6">
                        
                        <!-- Card: Identitas Balita -->
                        <div class="bg-slate-50/70 border border-slate-200/70 rounded-2xl p-5 sm:p-6 flex flex-col">
                            <div class="flex items-center gap-2.5 pb-4 mb-3 border-b border-slate-200/60">
                                <div class="w-8 h-8 rounded-lg bg-teal-100 text-teal-700 flex items-center justify-center font-bold text-xs">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" /></svg>
                                </div>
                                <h3 class="text-sm font-bold text-slate-800">Identitas Diri Balita</h3>
                            </div>

                            <div class="space-y-3.5 text-xs">
                                <div class="flex items-center justify-between py-1.5 border-b border-slate-100">
                                    <span class="text-slate-500 font-medium">Nama Lengkap</span>
                                    <span class="font-bold text-slate-800 text-right">{{ $childName }}</span>
                                </div>
                                <div class="flex items-center justify-between py-1.5 border-b border-slate-100">
                                    <span class="text-slate-500 font-medium">NIK Balita</span>
                                    <span class="font-bold text-slate-800 text-right">{{ $nik }}</span>
                                </div>
                                <div class="flex items-center justify-between py-1.5 border-b border-slate-100">
                                    <span class="text-slate-500 font-medium">No. BPJS / JKN</span>
                                    <span class="font-bold text-slate-800 text-right">{{ $noBpjs ?: '-' }}</span>
                                </div>
                                <div class="flex items-center justify-between py-1.5 border-b border-slate-100">
                                    <span class="text-slate-500 font-medium">Jenis Kelamin</span>
                                    <span class="font-bold text-slate-800 text-right">{{ $gender }}</span>
                                </div>
                                <div class="flex items-center justify-between py-1.5">
                                    <span class="text-slate-500 font-medium">Tanggal Lahir & Usia</span>
                                    <div class="text-right">
                                        <p class="font-bold text-slate-800">{{ $birthDate ?? '-' }}</p>
                                        <span class="inline-block mt-0.5 px-2 py-0.5 bg-teal-50 text-teal-700 rounded text-[10px] font-bold">{{ $age }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card: Antropometri Saat Lahir (Buku KIA) -->
                        <div class="bg-slate-50/70 border border-slate-200/70 rounded-2xl p-5 sm:p-6 flex flex-col">
                            <div class="flex items-center gap-2.5 pb-4 mb-3 border-b border-slate-200/60">
                                <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-xs">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path d="M12 7.5a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5z" /><path fill-rule="evenodd" d="M1.5 4.875C1.5 3.839 2.34 3 3.375 3h17.25c1.035 0 1.875.84 1.875 1.875v9.75c0 1.036-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 011.5 14.625v-9.75zM8.25 9.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM18.75 9a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75V9.75a.75.75 0 00-.75-.75h-.008zM4.5 9.75A.75.75 0 015.25 9h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H5.25a.75.75 0 01-.75-.75V9.75z" clip-rule="evenodd" /></svg>
                                </div>
                                <h3 class="text-sm font-bold text-slate-800">Antropometri Saat Lahir (KIA)</h3>
                            </div>

                            <div class="grid grid-cols-3 gap-3 text-center">
                                <div class="bg-white p-3 rounded-xl border border-slate-100 shadow-sm">
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Berat Lahir</span>
                                    <span class="text-base font-extrabold text-slate-800">{{ $birthWeight ? $birthWeight . ' kg' : '-' }}</span>
                                </div>
                                <div class="bg-white p-3 rounded-xl border border-slate-100 shadow-sm">
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Panjang Lahir</span>
                                    <span class="text-base font-extrabold text-slate-800">{{ $birthLength ? $birthLength . ' cm' : '-' }}</span>
                                </div>
                                <div class="bg-white p-3 rounded-xl border border-slate-100 shadow-sm">
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Lingkar Kepala</span>
                                    <span class="text-base font-extrabold text-slate-800">{{ $birthHeadCirc ? $birthHeadCirc . ' cm' : '-' }}</span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- COLUMN 2: ORANG TUA / KELUARGA & DOMISILI -->
                    <div class="flex flex-col gap-6">
                        
                        <!-- Card: Orang Tua / Keluarga -->
                        <div class="bg-slate-50/70 border border-slate-200/70 rounded-2xl p-5 sm:p-6 flex flex-col">
                            <div class="flex items-center gap-2.5 pb-4 mb-3 border-b border-slate-200/60">
                                <div class="w-8 h-8 rounded-lg bg-rose-100 text-rose-700 flex items-center justify-center font-bold text-xs">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM6.31 15.117A6.745 6.745 0 0112 12a6.745 6.745 0 015.69 3.117C19.006 16.36 20 18.06 20 20a.75.75 0 01-.75.75H4.75a.75.75 0 01-.75-.75c0-1.94.994-3.64 2.31-4.883z" clip-rule="evenodd" /></svg>
                                </div>
                                <h3 class="text-sm font-bold text-slate-800">Orang Tua / Keluarga</h3>
                            </div>

                            <div class="space-y-3.5 text-xs">
                                <div class="flex items-center justify-between py-1.5 border-b border-slate-100">
                                    <span class="text-slate-500 font-medium">No. Kartu Keluarga (KK)</span>
                                    <span class="font-bold text-slate-800 text-right">{{ $noKk ?: '-' }}</span>
                                </div>
                                <div class="flex items-center justify-between py-1.5 border-b border-slate-100">
                                    <span class="text-slate-500 font-medium">Nama Ibu Kandung</span>
                                    <span class="font-bold text-slate-800 text-right">{{ $motherName }}</span>
                                </div>
                                <div class="flex items-center justify-between py-1.5 border-b border-slate-100">
                                    <span class="text-slate-500 font-medium">NIK Ibu</span>
                                    <span class="font-bold text-slate-800 text-right">{{ $motherNik ?: '-' }}</span>
                                </div>
                                <div class="flex items-center justify-between py-1.5 border-b border-slate-100">
                                    <span class="text-slate-500 font-medium">Pekerjaan Ibu</span>
                                    <span class="font-bold text-slate-800 text-right">{{ $motherJob ?: '-' }}</span>
                                </div>
                                <div class="flex items-center justify-between py-1.5 border-b border-slate-100">
                                    <span class="text-slate-500 font-medium">No. WhatsApp Ibu</span>
                                    <span class="font-bold text-teal-700 text-right">{{ $motherPhone }}</span>
                                </div>
                                <div class="flex items-center justify-between py-1.5 border-b border-slate-100">
                                    <span class="text-slate-500 font-medium">Nama Ayah</span>
                                    <span class="font-bold text-slate-800 text-right">{{ $fatherName ?: '-' }}</span>
                                </div>
                                <div class="flex items-center justify-between py-1.5 border-b border-slate-100">
                                    <span class="text-slate-500 font-medium">NIK Ayah</span>
                                    <span class="font-bold text-slate-800 text-right">{{ $fatherNik ?: '-' }}</span>
                                </div>
                                <div class="flex items-center justify-between py-1.5">
                                    <span class="text-slate-500 font-medium">Pekerjaan Ayah</span>
                                    <span class="font-bold text-slate-800 text-right">{{ $fatherJob ?: '-' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Card: Lokasi & Posyandu -->
                        <div class="bg-slate-50/70 border border-slate-200/70 rounded-2xl p-5 sm:p-6 flex flex-col">
                            <div class="flex items-center gap-2.5 pb-4 mb-3 border-b border-slate-200/60">
                                <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-xs">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" /></svg>
                                </div>
                                <h3 class="text-sm font-bold text-slate-800">Posyandu & Domisili</h3>
                            </div>

                            <div class="space-y-3 text-xs">
                                <div class="flex items-center justify-between py-1 border-b border-slate-100">
                                    <span class="text-slate-500 font-medium">Posyandu Binaan</span>
                                    <span class="font-bold text-slate-800 text-right">{{ $posyanduName }}</span>
                                </div>
                                <div class="flex items-center justify-between py-1 border-b border-slate-100">
                                    <span class="text-slate-500 font-medium">Desa / Kelurahan</span>
                                    <span class="font-bold text-slate-800 text-right">{{ $address }}</span>
                                </div>
                                <div class="flex items-center justify-between py-1">
                                    <span class="text-slate-500 font-medium">Kecamatan</span>
                                    <span class="font-bold text-slate-800 text-right">{{ $addressSub ?: '-' }}</span>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>

        <!-- TAB: RIWAYAT -->
        <div id="content-riwayat" class="tab-content hidden flex flex-col p-4 sm:p-6 lg:p-7 bg-white border border-slate-200/80 rounded-[24px] shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
                <div>
                    <h2 class="text-[16px] font-black text-slate-900 tracking-tight">Riwayat Pengukuran</h2>
                    <p class="text-[13px] text-slate-500 mt-0.5">Catatan historis tumbuh kembang dan riwayat validasi puskesmas</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="px-3 py-1 bg-teal-50 text-teal-700 border border-teal-200/60 rounded-full text-[12px] font-bold">
                        {{ count($measurements) }} Pengukuran
                    </span>
                </div>
            </div>

            @if(count($measurements) > 0)
                @php
                    $totalCount = count($measurements);
                    $firstMeasure = $measurements[$totalCount - 1];
                    $latestMeasureItem = $measurements[0];
                    
                    $totalWeightGain = ($firstMeasure && $latestMeasureItem && $firstMeasure['weight'] && $latestMeasureItem['weight']) 
                        ? round($latestMeasureItem['weight'] - $firstMeasure['weight'], 2) 
                        : null;
                        
                    $totalHeightGain = ($firstMeasure && $latestMeasureItem && $firstMeasure['height'] && $latestMeasureItem['height']) 
                        ? round($latestMeasureItem['height'] - $firstMeasure['height'], 1) 
                        : null;
                @endphp

                <!-- Summary Highlight Strip -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 p-4 bg-slate-50/80 border border-slate-200/70 rounded-2xl mb-6">
                    <!-- Total Weight Progression -->
                    <div class="flex items-center gap-3 bg-white p-3.5 rounded-xl border border-slate-100 shadow-sm">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0l-3.75-3.75M12 20.25l3.75-3.75M3 12h18" /></svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Kenaikan BB</span>
                            <span class="text-[15px] font-bold {{ $totalWeightGain >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                                {{ $totalWeightGain !== null ? ($totalWeightGain > 0 ? '+' . $totalWeightGain : $totalWeightGain) . ' kg' : '-' }}
                            </span>
                        </div>
                    </div>

                    <!-- Total Height Progression -->
                    <div class="flex items-center gap-3 bg-white p-3.5 rounded-xl border border-slate-100 shadow-sm">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 17.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Kenaikan TB</span>
                            <span class="text-[15px] font-bold text-slate-800">
                                {{ $totalHeightGain !== null ? ($totalHeightGain > 0 ? '+' . $totalHeightGain : $totalHeightGain) . ' cm' : '-' }}
                            </span>
                        </div>
                    </div>

                    <!-- Observation Period -->
                    <div class="flex items-center gap-3 bg-white p-3.5 rounded-xl border border-slate-100 shadow-sm">
                        <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" /></svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Periode Pantau</span>
                            <span class="text-[13px] font-bold text-slate-800">
                                {{ $firstMeasure['date'] ?? '-' }} — {{ $latestMeasureItem['date'] ?? '-' }}
                            </span>
                        </div>
                    </div>
                </div>
            @endif

            <div class="flex flex-col mt-2">
                @forelse($measurements as $measure)
                    <x-timeline-item :measurement="$measure" :is-last="$loop->last" :is-latest="$loop->first" />
                @empty
                    <div class="py-12 flex flex-col items-center justify-center text-center">
                        <div class="w-16 h-16 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mb-5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <span class="text-[14px] font-bold text-slate-900">Belum Ada Riwayat</span>
                        <p class="text-[13px] text-slate-500 mt-1 mb-4">Anak belum pernah diukur.</p>
                        <button onclick="openMeasurementModal()" class="inline-flex items-center gap-2 px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white text-[13px] font-bold rounded-xl shadow-sm transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                            Ukur Sekarang
                        </button>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- TAB: GRAFIK -->
        <div id="content-grafik" class="tab-content hidden flex flex-col p-6 bg-white border border-slate-200 rounded-2xl shadow-sm">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-6 gap-4">
                <h2 class="text-[16px] font-black text-slate-900 tracking-tight">Grafik Pertumbuhan</h2>
                @if(count($measurements) > 0)
                <div class="max-w-xs w-full lg:w-auto">
                    <div class="relative">
                        <select id="growthChartType" class="w-full bg-slate-50 border border-slate-200 text-slate-700 text-[13px] font-bold rounded-xl pl-4 pr-10 h-[42px] focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-400 transition-colors shadow-sm cursor-pointer appearance-none">
                            <option value="bb">Berat Badan per Umur (BB/U) — kg</option>
                            <option value="tb">Tinggi Badan per Umur (TB/U) — cm</option>
                            <option value="lk">Lingkar Kepala per Umur (LK/U) — cm</option>
                        </select>
                        <div class="absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            @if(count($measurements) > 0)
            <div class="relative h-[360px] w-full rounded-[20px] overflow-hidden border border-slate-100 bg-slate-50/50 p-4 lg:p-6">
                <canvas id="growthChart" class="w-full h-full"></canvas>
            </div>
            @else
            <div class="py-12 flex flex-col items-center text-center">
                <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center mb-5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-slate-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                    </svg>
                </div>
                <span class="text-[14px] font-bold text-slate-900">Belum Ada Grafik</span>
                <p class="text-[13px] text-slate-500 mt-1 max-w-[250px] mx-auto">Lakukan pengukuran terlebih dahulu untuk melihat grafik pertumbuhan.</p>
            </div>
            @endif
        </div>
        
    </div>
</div>

@push('modals')

<script>
    function switchTab(tabId) {
        document.querySelectorAll('.tab-content').forEach(el => {
            el.classList.add('hidden');
        });
        
        const activeClasses = ['bg-white', 'text-teal-800', 'font-bold', 'shadow-xs'];
        const inactiveClasses = ['text-slate-600', 'hover:text-slate-900', 'font-semibold'];
        
        ['ringkasan', 'detail', 'riwayat', 'grafik'].forEach(id => {
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

    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('action') === 'ukur') {
            if (typeof openMeasurementModal === 'function') {
                setTimeout(openMeasurementModal, 150);
            }
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rawData = @json($measurements ?? []);
        if (!Array.isArray(rawData) || rawData.length === 0) return;

        const chartData = [...rawData].reverse();
        const labels = chartData.map(d => d.date);

        const chartConfigs = {
            bb: {
                label: 'Berat Badan (kg)',
                data: chartData.map(d => d.weight),
                unit: 'kg',
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.12)',
                pointColor: '#10b981'
            },
            tb: {
                label: 'Tinggi / Panjang Badan (cm)',
                data: chartData.map(d => d.height),
                unit: 'cm',
                borderColor: '#0d9488',
                backgroundColor: 'rgba(13, 148, 136, 0.12)',
                pointColor: '#0d9488'
            },
            lk: {
                label: 'Lingkar Kepala (cm)',
                data: chartData.map(d => d.head_circ),
                unit: 'cm',
                borderColor: '#6366f1',
                backgroundColor: 'rgba(99, 102, 241, 0.12)',
                pointColor: '#6366f1'
            }
        };

        let currentType = 'bb';
        const ctx = document.getElementById('growthChart');
        if (!ctx) return;

        const growthChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: chartConfigs[currentType].label,
                    data: chartConfigs[currentType].data,
                    borderColor: chartConfigs[currentType].borderColor,
                    backgroundColor: chartConfigs[currentType].backgroundColor,
                    borderWidth: 3,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: chartConfigs[currentType].pointColor,
                    pointBorderWidth: 2.5,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    fill: true,
                    tension: 0.35,
                    spanGaps: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        align: 'end',
                        labels: {
                            boxWidth: 12,
                            boxHeight: 12,
                            usePointStyle: true,
                            font: { family: "'Inter', sans-serif", size: 12, weight: '600' },
                            color: '#475569'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.92)',
                        titleFont: { size: 13, family: "'Inter', sans-serif", weight: 'bold' },
                        bodyFont: { size: 14, family: "'Inter', sans-serif", weight: 'bold' },
                        padding: 12,
                        cornerRadius: 10,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                const val = context.parsed.y;
                                if (val === null || val === undefined) return 'Data belum diukur';
                                return `${chartConfigs[currentType].label}: ${val} ${chartConfigs[currentType].unit}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        grid: { color: 'rgba(226, 232, 240, 0.7)', borderDash: [4, 4], drawBorder: false },
                        ticks: {
                            font: { family: "'Inter', sans-serif", size: 12, weight: '500' },
                            color: '#64748b',
                            callback: function(value) {
                                return value + ' ' + chartConfigs[currentType].unit;
                            }
                        }
                    },
                    x: {
                        grid: { display: false, drawBorder: false },
                        ticks: { font: { family: "'Inter', sans-serif", size: 12, weight: '500' }, color: '#64748b' }
                    }
                }
            }
        });

        const typeSelect = document.getElementById('growthChartType');
        if (typeSelect) {
            typeSelect.addEventListener('change', function(e) {
                const selectedKey = e.target.value;
                if (!chartConfigs[selectedKey]) return;

                currentType = selectedKey;
                const targetConfig = chartConfigs[selectedKey];

                growthChart.data.datasets[0].label = targetConfig.label;
                growthChart.data.datasets[0].data = targetConfig.data;
                growthChart.data.datasets[0].borderColor = targetConfig.borderColor;
                growthChart.data.datasets[0].backgroundColor = targetConfig.backgroundColor;
                growthChart.data.datasets[0].pointBorderColor = targetConfig.pointColor;

                growthChart.update();
            });
        }

        @if(request('action') === 'ukur')
            setTimeout(() => {
                if (typeof openMeasurementModal === 'function') {
                    openMeasurementModal();
                }
            }, 300);
        @endif
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
