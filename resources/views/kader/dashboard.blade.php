@extends('layouts.app')
@section('page-title', 'Beranda')
@section('content')

@php
    $total = (int) ($statTotal ?? 0);
    $sudah = (int) ($statSudah ?? 0);
    $belum = (int) ($statBelum ?? max(0, $total - $sudah));
    $percent = $total > 0 ? min(100, round(($sudah / $total) * 100)) : 0;
    $todayFormatted = \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y');
@endphp

<div class="w-full min-h-screen bg-[#F4F6F9] pb-28 lg:pb-16 text-slate-800 antialiased">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-5 sm:pt-7 flex flex-col gap-6 sm:gap-7">
        
        {{-- ── 1. EXECUTIVE HERO BANNER (Clean, Dynamic, Modern & Professional) ── --}}
        <div class="relative bg-gradient-to-br from-teal-800 via-teal-700 to-emerald-900 rounded-3xl p-6 sm:p-8 lg:p-9 text-white shadow-[0_12px_40px_-10px_rgba(13,148,136,0.3)] overflow-hidden border border-teal-600/30">
            
            {{-- Decorative Ambient Elements --}}
            <div class="absolute -right-16 -top-16 w-72 h-72 bg-emerald-400/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute left-1/3 -bottom-20 w-60 h-60 bg-teal-400/15 rounded-full blur-2xl pointer-events-none"></div>
            <div class="absolute inset-0 opacity-[0.04] pointer-events-none" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 20px 20px;"></div>

            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                
                {{-- Left: Identity & Greeting --}}
                <div class="flex-1 max-w-2xl">
                    <div class="flex flex-wrap items-center gap-2.5 mb-3">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-white/15 backdrop-blur-md rounded-full border border-white/20 text-teal-100 text-xs font-bold uppercase tracking-wider shadow-2xs">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            {{ $activityLocation ?? ($posyanduName ?? 'Posyandu') }}
                        </span>
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-white/10 backdrop-blur-md rounded-full border border-white/15 text-teal-100/90 text-xs font-medium">
                            <svg class="w-3.5 h-3.5 text-teal-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $todayFormatted }}
                        </span>
                    </div>

                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white tracking-tight leading-tight">
                        Selamat Bertugas, {{ $kaderName ?? 'Ibu Kader' }} 👋
                    </h1>
                    <p class="text-xs sm:text-sm text-teal-100/90 font-normal mt-2 leading-relaxed max-w-xl">
                        Pantau pertumbuhan balita secara presisi, deteksi stunting sejak dini, dan sinkronkan data penimbangan ke Puskesmas secara real-time.
                    </p>
                </div>

                {{-- Right: Mini Operational Snapshot Pill --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-2 gap-2.5 shrink-0">
                    <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-2xl p-3.5 flex flex-col min-w-[130px]">
                        <span class="text-[10.5px] uppercase font-bold tracking-wider text-teal-200/80">Total Balita</span>
                        <span class="text-2xl font-black text-white mt-0.5">{{ $total }}</span>
                    </div>
                    <div class="bg-emerald-500/20 backdrop-blur-md border border-emerald-400/30 rounded-2xl p-3.5 flex flex-col min-w-[130px]">
                        <span class="text-[10.5px] uppercase font-bold tracking-wider text-emerald-200">Selesai Ukur</span>
                        <span class="text-2xl font-black text-emerald-300 mt-0.5">{{ $sudah }}</span>
                    </div>
                    <div class="bg-amber-500/20 backdrop-blur-md border border-amber-400/30 rounded-2xl p-3.5 flex flex-col min-w-[130px]">
                        <span class="text-[10.5px] uppercase font-bold tracking-wider text-amber-200">Belum Hadir</span>
                        <span class="text-2xl font-black text-amber-300 mt-0.5">{{ $belum }}</span>
                    </div>
                    <div class="bg-rose-500/20 backdrop-blur-md border border-rose-400/30 rounded-2xl p-3.5 flex flex-col min-w-[130px]">
                        <span class="text-[10.5px] uppercase font-bold tracking-wider text-rose-200">Perlu Revisi</span>
                        <span class="text-2xl font-black text-rose-300 mt-0.5">{{ $statRevisi ?? 0 }}</span>
                    </div>
                </div>

            </div>
        </div>

        {{-- ── 2. ALERT PERLU REVISI (Jika Ada Catatan dari Puskesmas) ── --}}
        @if(isset($statRevisi) && $statRevisi > 0)
        <div class="bg-gradient-to-r from-rose-50 via-rose-50/80 to-white border-2 border-rose-200 rounded-3xl p-4 sm:p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 shadow-[0_8px_25px_-5px_rgba(244,63,94,0.12)] relative overflow-hidden">
            <div class="flex items-start sm:items-center gap-3.5 relative z-10">
                <div class="w-12 h-12 rounded-2xl bg-rose-500 text-white flex items-center justify-center shrink-0 shadow-md shadow-rose-500/30 ring-4 ring-rose-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-6 h-6 animate-pulse">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                </div>
                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <span class="text-[10.5px] font-black uppercase tracking-wider text-rose-800 bg-rose-200/80 px-2.5 py-0.5 rounded-full border border-rose-300">
                            Perlu Tindakan Kader
                        </span>
                        <span class="text-xs font-bold text-rose-900">{{ $statRevisi }} Balita Memerlukan Koreksi</span>
                    </div>
                    <p class="text-xs text-rose-700 font-medium mt-1 leading-relaxed max-w-xl">
                        Ahli gizi Puskesmas memberikan catatan revisi pada data penimbangan. Silakan timbang ulang balita agar laporan tervalidasi.
                    </p>
                </div>
            </div>
            <a href="{{ route('balita.index', ['filter' => 'ditolak']) }}" 
               class="w-full sm:w-auto shrink-0 h-11 px-5 bg-rose-600 hover:bg-rose-700 active:bg-rose-800 text-white rounded-2xl text-xs font-bold shadow-md shadow-rose-600/30 hover:shadow-lg transition-all flex items-center justify-center gap-2 cursor-pointer">
                <span>Buka Catatan Revisi</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
        @endif

        {{-- ── 3. INTERACTIVE ACTION BENTO TILES (Tactile & High-Intent) ── --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5">
            
            {{-- Action 1: Pencatatan Antropometri Balita (Primary Action) --}}
            <a href="{{ route('balita.index') }}" 
               class="group relative bg-gradient-to-br from-teal-600 via-teal-700 to-emerald-700 rounded-3xl p-6 sm:p-7 text-white shadow-[0_10px_30px_-5px_rgba(13,148,136,0.3)] hover:shadow-[0_15px_40px_-5px_rgba(13,148,136,0.45)] hover:-translate-y-1 transition-all duration-200 flex flex-col justify-between overflow-hidden cursor-pointer border border-teal-500/40">
                
                {{-- Ambient Light Blob --}}
                <div class="absolute -right-10 -bottom-10 w-44 h-44 bg-white/10 rounded-full blur-2xl pointer-events-none group-hover:scale-125 transition-transform duration-500"></div>

                <div class="relative z-10 flex items-start justify-between gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-md border border-white/30 flex items-center justify-center text-white shadow-inner group-hover:scale-110 group-hover:rotate-2 transition-transform duration-300 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0l2.469 10.106c.122.499.106 1.028.589 1.202a5.989 5.989 0 002.031.352 5.989 5.989 0 002.031-.352c.483-.174.711-.703.59-1.202L5.25 4.971z" />
                        </svg>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-white/20 backdrop-blur-md rounded-full border border-white/25 text-white text-[11px] font-extrabold uppercase tracking-wider shadow-2xs">
                        <span class="w-2 h-2 rounded-full bg-emerald-300 animate-pulse"></span>
                        Aksi Utama
                    </span>
                </div>

                <div class="relative z-10 mt-6">
                    <h3 class="text-xl sm:text-2xl font-black text-white tracking-tight">
                        Ukur & Timbang Balita
                    </h3>
                    <p class="text-xs sm:text-sm text-teal-100/90 font-normal mt-1.5 leading-relaxed max-w-md">
                        Input hasil penimbangan berat badan, tinggi badan, lingkar kepala, dan hitung otomatis Z-Score KMS.
                    </p>

                    <div class="mt-5 inline-flex items-center gap-2 px-4 py-2 bg-white text-teal-900 rounded-xl font-bold text-xs shadow-md group-hover:bg-teal-50 transition-colors">
                        <span>Mulai Sesi Pengukuran</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </div>
                </div>
            </a>

            {{-- Action 2: Registrasi Balita Baru --}}
            <a href="{{ route('balita.create') }}" 
               class="group relative bg-white rounded-3xl p-6 sm:p-7 text-slate-800 shadow-[0_10px_30px_-5px_rgba(0,0,0,0.06)] hover:shadow-[0_15px_40px_-5px_rgba(13,148,136,0.15)] hover:-translate-y-1 transition-all duration-200 flex flex-col justify-between overflow-hidden cursor-pointer border border-slate-200/90 hover:border-teal-400">
                
                {{-- Ambient Light Blob --}}
                <div class="absolute -right-10 -bottom-10 w-44 h-44 bg-teal-50 rounded-full blur-2xl pointer-events-none group-hover:scale-125 transition-transform duration-500"></div>

                <div class="relative z-10 flex items-start justify-between gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-teal-50 text-teal-700 border border-teal-200/80 flex items-center justify-center shadow-xs group-hover:scale-110 group-hover:-rotate-2 transition-transform duration-300 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                        </svg>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-100 rounded-full border border-slate-200 text-slate-700 text-[11px] font-extrabold uppercase tracking-wider">
                        Pendaftaran
                    </span>
                </div>

                <div class="relative z-10 mt-6">
                    <h3 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight group-hover:text-teal-700 transition-colors">
                        Daftarkan Balita Baru
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-500 font-normal mt-1.5 leading-relaxed max-w-md">
                        Registrasi balita yang baru lahir atau baru pindah domisili, lengkap dengan NIK dan data orang tua.
                    </p>

                    <div class="mt-5 inline-flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-teal-600 hover:text-white text-slate-800 rounded-xl font-bold text-xs transition-all shadow-2xs group-hover:bg-teal-600 group-hover:text-white">
                        <span>+ Tambah Identitas Anak</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </div>
                </div>
            </a>

        </div>

        {{-- ── 4. ANALYTICAL BENTO: CAKUPAN PENIMBANGAN & PENGAWASAN GIZI ── --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 sm:gap-6">
            
            {{-- Left Bento (8-col): Cakupan Pengukuran & Progres Periode --}}
            <div class="lg:col-span-8 bg-white border border-slate-200/90 rounded-3xl p-6 sm:p-7 shadow-[0_8px_30px_rgb(0,0,0,0.04)] flex flex-col justify-between">
                <div>
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-slate-100">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="text-[11px] font-extrabold uppercase tracking-wider text-teal-800 bg-teal-50 border border-teal-200/80 px-2.5 py-0.5 rounded-md">
                                    Rekapitulasi Penimbangan
                                </span>
                            </div>
                            <h2 class="text-lg sm:text-xl font-extrabold text-slate-900 tracking-tight mt-1">
                                {{ $sudah }} dari {{ $total }} Balita Telah Selesai Ditimbang
                            </h2>
                        </div>
                        <div class="flex items-center gap-2 self-start sm:self-auto bg-gradient-to-r from-teal-50 to-emerald-50 px-4 py-2 rounded-2xl border border-teal-200/80 shadow-2xs">
                            <span class="text-xs font-bold text-slate-600">Capaian:</span>
                            <span class="text-sm font-black text-teal-800">{{ $percent }}%</span>
                        </div>
                    </div>

                    {{-- Dynamic Visual Progress Bar --}}
                    <div class="mt-6">
                        <div class="flex items-center justify-between text-xs font-semibold text-slate-500 mb-2">
                            <span>Progres Partisipasi Posyandu</span>
                            <span class="text-teal-700 font-bold">{{ $sudah }} / {{ $total }} Anak ({{ $percent }}%)</span>
                        </div>
                        <div class="w-full h-3.5 bg-slate-100 rounded-full overflow-hidden p-0.5 border border-slate-200">
                            <div class="h-full bg-gradient-to-r from-teal-500 via-emerald-500 to-teal-600 rounded-full transition-all duration-700 shadow-sm" style="width: {{ $percent }}%"></div>
                        </div>
                    </div>
                </div>

                {{-- Metric Tiles Row --}}
                <div class="grid grid-cols-3 gap-3 sm:gap-4 mt-7 pt-5 border-t border-slate-100">
                    <div class="bg-slate-50 border border-slate-200/80 rounded-2xl p-3.5 sm:p-4 flex flex-col">
                        <span class="text-xs font-bold text-slate-500">Total Register</span>
                        <span class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">{{ $total }}</span>
                    </div>
                    <div class="bg-emerald-50/70 border border-emerald-200/80 rounded-2xl p-3.5 sm:p-4 flex flex-col">
                        <span class="text-xs font-bold text-emerald-800 flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Selesai
                        </span>
                        <span class="text-2xl sm:text-3xl font-black text-emerald-700 mt-1">{{ $sudah }}</span>
                    </div>
                    <div class="bg-amber-50/70 border border-amber-200/80 rounded-2xl p-3.5 sm:p-4 flex flex-col">
                        <span class="text-xs font-bold text-amber-800 flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span> Belum
                        </span>
                        <span class="text-2xl sm:text-3xl font-black text-amber-700 mt-1">{{ $belum }}</span>
                    </div>
                </div>
            </div>

            {{-- Right Bento (4-col): Status Pemantauan Gizi --}}
            <div class="lg:col-span-4 bg-gradient-to-br from-amber-50 via-amber-50/40 to-white border border-amber-200 rounded-3xl p-6 sm:p-7 shadow-[0_8px_30px_rgb(0,0,0,0.04)] flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between gap-2">
                        <span class="text-[10.5px] font-black uppercase tracking-wider text-amber-900 bg-amber-200/70 px-2.5 py-0.5 rounded-full border border-amber-300">
                            Pengawasan Gizi
                        </span>
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500 animate-ping"></span>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 tracking-tight mt-2.5">
                        Prioritas Pemantauan
                    </h3>
                    <p class="text-xs text-slate-600 font-medium mt-1.5 leading-relaxed">
                        Balita yang membutuhkan pemantauan gizi intensif, garis kuning, atau konfirmasi tinggi badan.
                    </p>
                </div>

                <div class="mt-7 pt-5 border-t border-amber-200/80 flex items-end justify-between">
                    <div>
                        <span class="text-4xl font-black text-amber-950 tracking-tight">
                            {{ $statPerlu ?? count($priorityChildren ?? []) }}
                        </span>
                        <span class="text-xs font-bold text-slate-500 ml-1.5">Balita</span>
                    </div>
                    <a href="{{ route('balita.index', ['filter' => 'absen_bulan_lalu']) }}" 
                       class="inline-flex items-center gap-1.5 h-9 px-3.5 bg-amber-500 hover:bg-amber-600 active:bg-amber-700 text-white rounded-xl text-xs font-bold shadow-xs hover:shadow transition-all">
                        <span>Lihat Antrean</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>

        {{-- ── 5. DUAL WORKSPACE: PRIORITAS PERHATIAN & AGENDA JADWAL ── --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 sm:gap-6">
            
            {{-- Left Side (7-col): Daftar Prioritas Perhatian Balita --}}
            <div class="lg:col-span-7 bg-white border border-slate-200/90 rounded-3xl p-6 sm:p-7 shadow-[0_8px_30px_rgb(0,0,0,0.04)] flex flex-col gap-4">
                <div class="flex items-center justify-between pb-3.5 border-b border-slate-100">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center border border-rose-100">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-base font-extrabold text-slate-900 tracking-tight">
                                Prioritas Perhatian Balita
                            </h2>
                            <p class="text-[11px] text-slate-400 font-medium">Balita dengan status gizi perlu pemantauan</p>
                        </div>
                    </div>
                    <a href="{{ route('balita.index') }}" class="text-xs font-bold text-teal-700 hover:text-teal-800 transition-colors">
                        Lihat Semua &rarr;
                    </a>
                </div>

                <div class="flex flex-col divide-y divide-slate-100">
                    @forelse($priorityChildren ?? [] as $child)
                        @php
                            $isDanger = ($child->statusType ?? 'warning') === 'danger';
                            $initials = strtoupper(substr($child->name ?? 'AN', 0, 2));
                        @endphp
                        <a href="{{ route('balita.show', $child->id) }}" 
                           class="group py-3.5 first:pt-1 last:pb-1 flex items-center justify-between gap-3 hover:bg-slate-50/90 -mx-2 px-3 rounded-2xl transition-all cursor-pointer">
                            
                            {{-- Avatar & Child Details --}}
                            <div class="flex items-center gap-3.5 min-w-0">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 font-extrabold text-xs shadow-2xs {{ $isDanger ? 'bg-gradient-to-br from-rose-500 to-pink-600 text-white' : 'bg-gradient-to-br from-amber-400 to-orange-500 text-white' }}">
                                    {{ $initials }}
                                </div>
                                <div class="flex flex-col min-w-0">
                                    <h4 class="text-xs sm:text-[14px] font-bold text-slate-900 group-hover:text-teal-700 transition-colors truncate">
                                        {{ Str::title($child->name) }}
                                    </h4>
                                    <div class="flex items-center gap-1.5 text-[11px] text-slate-500 font-medium mt-0.5">
                                        <span class="truncate max-w-[90px] sm:max-w-[140px]">Ibu {{ $child->mother ?? '-' }}</span>
                                        <span class="text-slate-300">&bull;</span>
                                        <span class="shrink-0">{{ $child->age }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Status Badge & Action Indicator --}}
                            <div class="flex items-center gap-2 shrink-0">
                                @if($isDanger)
                                    <span class="inline-flex items-center gap-1.5 text-[10.5px] font-bold text-rose-800 bg-rose-50 border border-rose-200 px-3 py-1 rounded-full shadow-2xs">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>{{ $child->shortStatus ?? 'Konfirmasi TB' }}</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 text-[10.5px] font-bold text-amber-800 bg-amber-50 border border-amber-200 px-3 py-1 rounded-full shadow-2xs">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 shrink-0"></span>
                                        <span>{{ $child->shortStatus ?? 'Pantauan Gizi' }}</span>
                                    </span>
                                @endif
                                
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-slate-300 group-hover:text-teal-600 group-hover:translate-x-1 transition-all shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </div>
                        </a>
                    @empty
                        <div class="py-10 text-center flex flex-col items-center justify-center text-slate-400">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-2.5 border border-emerald-100 shadow-2xs">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-slate-700">Seluruh Status Balita Terpantau Aman</span>
                            <span class="text-[11px] text-slate-400 mt-0.5">Tidak ada balita yang memerlukan tindakan darurat.</span>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Right Side (5-col): Agenda Sesi Posyandu Terdekat --}}
            <div class="lg:col-span-5 bg-white border border-slate-200/90 rounded-3xl p-6 sm:p-7 shadow-[0_8px_30px_rgb(0,0,0,0.04)] flex flex-col justify-between gap-5">
                <div>
                    <div class="flex items-center justify-between pb-3.5 border-b border-slate-100">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center border border-teal-100">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-base font-extrabold text-slate-900 tracking-tight">
                                    Agenda Posyandu
                                </h2>
                                <p class="text-[11px] text-slate-400 font-medium">Jadwal kegiatan penimbangan terdekat</p>
                            </div>
                        </div>
                        <a href="{{ route('jadwal.index') }}" class="text-xs font-bold text-teal-700 hover:text-teal-800 transition-colors">
                            Semua &rarr;
                        </a>
                    </div>

                    @if(isset($jadwalTerdekat) && $jadwalTerdekat)
                        <div class="flex flex-col gap-3.5 mt-4">
                            
                            {{-- Schedule Banner Card --}}
                            <a href="{{ route('jadwal.show', $jadwalTerdekat['id']) }}" 
                               class="group p-4 sm:p-4.5 bg-gradient-to-br from-slate-50 via-teal-50/30 to-emerald-50/20 border border-slate-200/90 hover:border-teal-400 rounded-2xl transition-all flex items-start gap-4 cursor-pointer shadow-2xs hover:shadow-xs">
                                
                                {{-- Calendar Date Block --}}
                                <div class="w-13 rounded-2xl overflow-hidden border border-slate-200 shadow-2xs bg-white shrink-0 text-center">
                                    <div class="py-1 text-[9px] font-black uppercase tracking-wider {{ ($jadwalTerdekat['status_type'] ?? '') === 'today' ? 'bg-amber-500 text-white' : 'bg-teal-700 text-white' }}">
                                        {{ $jadwalTerdekat['tgl_bulan'] ?? 'POS' }}
                                    </div>
                                    <div class="py-1.5 px-1 flex flex-col items-center">
                                        <span class="text-lg font-black text-slate-900 leading-none">{{ $jadwalTerdekat['tgl_nomor'] ?? '00' }}</span>
                                        <span class="text-[8px] font-extrabold text-slate-400 uppercase mt-0.5">{{ substr($jadwalTerdekat['hari'] ?? 'POS', 0, 3) }}</span>
                                    </div>
                                </div>

                                {{-- Details --}}
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-xs sm:text-[14px] font-extrabold text-slate-900 group-hover:text-teal-700 transition-colors truncate">
                                        {{ $jadwalTerdekat['judul'] }}
                                    </h4>
                                    <div class="flex items-center gap-1 text-[11.5px] text-slate-600 font-medium mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 text-teal-600 shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>{{ $jadwalTerdekat['waktu'] }}</span>
                                    </div>
                                    <span class="inline-block mt-2.5 text-[10px] font-black uppercase tracking-wider text-teal-900 bg-teal-100 px-2.5 py-0.5 rounded-full border border-teal-200">
                                        {{ $jadwalTerdekat['countdown'] }}
                                    </span>
                                </div>
                            </a>

                            {{-- Location Info Pill --}}
                            <div class="p-3.5 bg-slate-50 border border-slate-200/80 rounded-2xl flex items-center gap-3">
                                <div class="w-8 h-8 rounded-xl bg-teal-50 text-teal-700 border border-teal-100 flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                </div>
                                <div class="flex flex-col min-w-0">
                                    <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">Lokasi Penimbangan</span>
                                    <span class="text-xs font-semibold text-slate-700 truncate mt-0.5">{{ $jadwalTerdekat['lokasi'] }}</span>
                                </div>
                            </div>

                        </div>
                    @else
                        <div class="py-8 text-center flex flex-col items-center justify-center text-slate-400 mt-2">
                            <div class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-600 border border-teal-100 flex items-center justify-center mb-2.5 shadow-2xs">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-slate-700">Belum Ada Agenda Jadwal</span>
                            <span class="text-[11px] text-slate-400 mt-0.5 mb-3">Buat jadwal kegiatan agar terbit di portal orang tua.</span>
                            <a href="{{ route('jadwal.create') }}" 
                               class="inline-flex items-center gap-1.5 text-xs font-bold bg-teal-600 hover:bg-teal-700 active:bg-teal-800 text-white px-4 py-2 rounded-xl shadow-xs transition-all">
                                + Buat Jadwal
                            </a>
                        </div>
                    @endif
                </div>

                {{-- Quick Link to Center Reports --}}
                <div class="pt-3.5 border-t border-slate-100 flex items-center justify-between text-xs">
                    <span class="text-slate-500 font-medium">Laporan Bulanan Siap Ekspor</span>
                    <a href="{{ route('laporan.index') }}" class="font-bold text-teal-700 hover:text-teal-800 transition-colors">
                        Pusat Laporan &rarr;
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
