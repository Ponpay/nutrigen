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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-5 sm:pt-7 flex flex-col gap-5 sm:gap-6">
        
        {{-- ── 1. EXECUTIVE HERO BANNER (Modern, Rich Gradient, Professional & Non-Flat) ── --}}
        <div class="relative bg-gradient-to-br from-teal-800 via-teal-700 to-emerald-800 rounded-3xl p-5 sm:p-7 lg:p-8 text-white shadow-[0_10px_35px_-8px_rgba(13,148,136,0.28)] border border-teal-600/30 overflow-hidden">
            
            {{-- Soft Ambient Texture --}}
            <div class="absolute -right-12 -top-12 w-64 h-64 bg-emerald-400/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute left-1/4 -bottom-16 w-56 h-56 bg-teal-400/15 rounded-full blur-2xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 sm:gap-6">
                
                {{-- Left: Identity & Greeting --}}
                <div class="flex-1 max-w-2xl">
                    <div class="flex flex-wrap items-center gap-2 mb-2.5">
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
                    <p class="text-xs sm:text-sm text-teal-100/90 font-normal mt-1.5 leading-relaxed max-w-xl">
                        Pantau pertumbuhan balita secara presisi, deteksi stunting sejak dini, dan sinkronkan data penimbangan ke Puskesmas secara real-time.
                    </p>
                </div>

                {{-- Right: Mini Operational Snapshot Pill --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-2 gap-2.5 shrink-0">
                    <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-2xl p-3 sm:p-3.5 flex flex-col min-w-[125px]">
                        <span class="text-[10px] uppercase font-bold tracking-wider text-teal-200/80">Total Balita</span>
                        <span class="text-xl sm:text-2xl font-black text-white mt-0.5">{{ $total }}</span>
                    </div>
                    <div class="bg-emerald-500/20 backdrop-blur-md border border-emerald-400/30 rounded-2xl p-3 sm:p-3.5 flex flex-col min-w-[125px]">
                        <span class="text-[10px] uppercase font-bold tracking-wider text-emerald-200">Selesai Ukur</span>
                        <span class="text-xl sm:text-2xl font-black text-emerald-300 mt-0.5">{{ $sudah }}</span>
                    </div>
                    <div class="bg-amber-500/20 backdrop-blur-md border border-amber-400/30 rounded-2xl p-3 sm:p-3.5 flex flex-col min-w-[125px]">
                        <span class="text-[10px] uppercase font-bold tracking-wider text-amber-200">Belum Hadir</span>
                        <span class="text-xl sm:text-2xl font-black text-amber-300 mt-0.5">{{ $belum }}</span>
                    </div>
                    <div class="bg-rose-500/20 backdrop-blur-md border border-rose-400/30 rounded-2xl p-3 sm:p-3.5 flex flex-col min-w-[125px]">
                        <span class="text-[10px] uppercase font-bold tracking-wider text-rose-200">Perlu Revisi</span>
                        <span class="text-xl sm:text-2xl font-black text-rose-300 mt-0.5">{{ $statRevisi ?? 0 }}</span>
                    </div>
                </div>

            </div>
        </div>

        {{-- ── 2. ALERT PERLU REVISI (Jika Ada Catatan Puskesmas) ── --}}
        @if(isset($statRevisi) && $statRevisi > 0)
        <div class="bg-gradient-to-r from-rose-50 via-rose-50/90 to-white border border-rose-200/90 rounded-2xl p-4 sm:p-4.5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 shadow-2xs">
            <div class="flex items-start sm:items-center gap-3 relative z-10">
                <div class="w-10 h-10 rounded-xl bg-rose-500 text-white flex items-center justify-center shrink-0 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-5 h-5 animate-pulse">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                </div>
                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <span class="text-[10.5px] font-extrabold uppercase tracking-wider text-rose-800 bg-rose-100 px-2 py-0.5 rounded-md border border-rose-200">
                            Perlu Tindakan Kader
                        </span>
                        <span class="text-xs font-bold text-rose-900">{{ $statRevisi }} Balita Memerlukan Koreksi</span>
                    </div>
                    <p class="text-xs text-rose-700 font-medium mt-0.5 leading-relaxed">
                        Puskesmas memberikan catatan revisi pada data penimbangan. Mohon segera timbang ulang balita.
                    </p>
                </div>
            </div>
            <a href="{{ route('balita.index', ['filter' => 'ditolak']) }}" 
               class="w-full sm:w-auto shrink-0 h-10 px-4 bg-rose-600 hover:bg-rose-700 active:bg-rose-800 text-white rounded-xl text-xs font-bold shadow-2xs hover:shadow transition-all flex items-center justify-center gap-1.5 cursor-pointer">
                <span>Tinjau Catatan Revisi</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
        @endif

        {{-- ── 3. INTERACTIVE ACTION TILES (Tactile & High Impact) ── --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            
            {{-- Action 1: Ukur & Timbang Balita (Primary Action) --}}
            <a href="{{ route('balita.index') }}" 
               class="group relative bg-gradient-to-br from-teal-600 via-teal-700 to-emerald-700 rounded-3xl p-5 sm:p-6 text-white shadow-[0_8px_25px_-5px_rgba(13,148,136,0.3)] hover:shadow-[0_12px_35px_-5px_rgba(13,148,136,0.4)] hover:-translate-y-0.5 transition-all duration-200 flex flex-col justify-between overflow-hidden cursor-pointer border border-teal-500/40 min-h-[140px]">
                
                <div class="flex items-start justify-between gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur-md border border-white/30 flex items-center justify-center text-white shadow-inner group-hover:scale-105 transition-transform shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0l2.469 10.106c.122.499.106 1.028.589 1.202a5.989 5.989 0 002.031.352 5.989 5.989 0 002.031-.352c.483-.174.711-.703.59-1.202L5.25 4.971z" />
                        </svg>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-white/20 backdrop-blur-md rounded-full border border-white/25 text-white text-[11px] font-extrabold uppercase tracking-wider">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-300 animate-pulse"></span>
                        Aksi Utama
                    </span>
                </div>

                <div class="mt-4">
                    <h3 class="text-lg sm:text-xl font-bold text-white tracking-tight">
                        Ukur & Timbang Balita
                    </h3>
                    <p class="text-xs text-teal-100/90 font-normal mt-1 leading-normal">
                        Catat BB, TB, lingkar kepala & hitung otomatis status KMS
                    </p>

                    <div class="mt-4 inline-flex items-center gap-1.5 text-xs font-bold text-teal-100 group-hover:text-white transition-colors">
                        <span>Buka Antrean Balita</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </div>
                </div>
            </a>

            {{-- Action 2: Registrasi Balita Baru --}}
            <a href="{{ route('balita.create') }}" 
               class="group relative bg-white rounded-3xl p-5 sm:p-6 text-slate-800 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_8px_30px_-5px_rgba(13,148,136,0.12)] hover:-translate-y-0.5 transition-all duration-200 flex flex-col justify-between overflow-hidden cursor-pointer border border-slate-200/90 hover:border-teal-400 min-h-[140px]">
                
                <div class="flex items-start justify-between gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-slate-50 text-slate-700 border border-slate-200/80 flex items-center justify-center group-hover:scale-105 group-hover:bg-teal-50 group-hover:text-teal-700 transition-all shrink-0 shadow-2xs">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                        </svg>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-100 rounded-full border border-slate-200 text-slate-700 text-[11px] font-bold uppercase tracking-wider">
                        Registrasi
                    </span>
                </div>

                <div class="mt-4">
                    <h3 class="text-lg sm:text-xl font-bold text-slate-900 tracking-tight group-hover:text-teal-700 transition-colors">
                        Daftarkan Balita Baru
                    </h3>
                    <p class="text-xs text-slate-500 font-normal mt-1 leading-normal">
                        Tambah data anak baru lahir/pindahan & identitas orang tua
                    </p>

                    <div class="mt-4 inline-flex items-center gap-1.5 text-xs font-bold text-slate-600 group-hover:text-teal-700 transition-colors">
                        <span>+ Input Data Baru</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </div>
                </div>
            </a>

        </div>

        {{-- ── 4. ANALYTICAL BENTO: REKAP PENIMBANGAN & PENGAWASAN GIZI ── --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
            
            {{-- Left Bento (8-col): Cakupan Pengukuran & Progres Periode --}}
            <div class="lg:col-span-8 bg-white border border-slate-200/90 rounded-3xl p-5 sm:p-6 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.04)] flex flex-col justify-between">
                <div>
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-3.5 border-b border-slate-100">
                        <div>
                            <span class="text-[11px] font-bold uppercase tracking-wider text-teal-800 bg-teal-50 border border-teal-200 px-2 py-0.5 rounded">
                                Rekap Penimbangan Sesi Ini
                            </span>
                            <h2 class="text-base sm:text-lg font-bold text-slate-900 tracking-tight mt-1.5">
                                {{ $sudah }} dari {{ $total }} Balita Selesai Diukur
                            </h2>
                        </div>
                        <div class="flex items-center gap-1.5 self-start sm:self-auto bg-teal-50/80 px-3 py-1.5 rounded-xl border border-teal-200/80">
                            <span class="text-xs font-semibold text-slate-600">Capaian:</span>
                            <span class="text-xs font-black text-teal-800">{{ $percent }}%</span>
                        </div>
                    </div>

                    {{-- Dynamic Visual Progress Bar --}}
                    <div class="mt-5">
                        <div class="flex items-center justify-between text-xs font-semibold text-slate-500 mb-1.5">
                            <span>Partisipasi Posyandu</span>
                            <span class="text-teal-700 font-bold">{{ $sudah }} / {{ $total }} Balita ({{ $percent }}%)</span>
                        </div>
                        <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden p-0.5 border border-slate-200/80">
                            <div class="h-full bg-gradient-to-r from-teal-500 to-emerald-500 rounded-full transition-all duration-500" style="width: {{ $percent }}%"></div>
                        </div>
                    </div>
                </div>

                {{-- Metric Tiles Row --}}
                <div class="grid grid-cols-3 gap-2.5 sm:gap-3 mt-6 pt-4 border-t border-slate-100">
                    <div class="bg-slate-50 border border-slate-200/80 rounded-2xl p-3 sm:p-3.5 flex flex-col">
                        <span class="text-xs font-bold text-slate-500">Total Terdaftar</span>
                        <span class="text-xl sm:text-2xl font-black text-slate-900 mt-0.5">{{ $total }}</span>
                    </div>
                    <div class="bg-emerald-50/70 border border-emerald-200/80 rounded-2xl p-3 sm:p-3.5 flex flex-col">
                        <span class="text-xs font-bold text-emerald-800 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Selesai
                        </span>
                        <span class="text-xl sm:text-2xl font-black text-emerald-700 mt-0.5">{{ $sudah }}</span>
                    </div>
                    <div class="bg-amber-50/70 border border-amber-200/80 rounded-2xl p-3 sm:p-3.5 flex flex-col">
                        <span class="text-xs font-bold text-amber-800 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Belum
                        </span>
                        <span class="text-xl sm:text-2xl font-black text-amber-700 mt-0.5">{{ $belum }}</span>
                    </div>
                </div>
            </div>

            {{-- Right Bento (4-col): Status Pemantauan Gizi --}}
            <div class="lg:col-span-4 bg-gradient-to-br from-amber-50/80 via-amber-50/30 to-white border border-amber-200 rounded-3xl p-5 sm:p-6 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.04)] flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between gap-2">
                        <span class="text-[10.5px] font-bold uppercase tracking-wider text-amber-900 bg-amber-200/70 px-2.5 py-0.5 rounded-md border border-amber-300">
                            Pengawasan Gizi
                        </span>
                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-ping"></span>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 tracking-tight mt-2">
                        Prioritas Pemantauan
                    </h3>
                    <p class="text-xs text-slate-600 font-medium mt-1 leading-relaxed">
                        Balita yang memerlukan perhatian khusus, garis kuning, atau konfirmasi TB.
                    </p>
                </div>

                <div class="mt-6 pt-4 border-t border-amber-200/80 flex items-end justify-between">
                    <div>
                        <span class="text-3xl font-black text-amber-950 tracking-tight">
                            {{ $statPerlu ?? count($priorityChildren ?? []) }}
                        </span>
                        <span class="text-xs font-bold text-slate-500 ml-1">Balita</span>
                    </div>
                    <a href="{{ route('balita.index', ['filter' => 'absen_bulan_lalu']) }}" 
                       class="inline-flex items-center gap-1 h-8 px-3 bg-amber-500 hover:bg-amber-600 active:bg-amber-700 text-white rounded-xl text-xs font-bold shadow-2xs transition-all">
                        <span>Lihat Antrean</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>

        {{-- ── 5. DUAL WORKSPACE: PRIORITAS PERHATIAN & AGENDA JADWAL ── --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
            
            {{-- Left Side (7-col): Daftar Prioritas Perhatian Balita --}}
            <div class="lg:col-span-7 bg-white border border-slate-200/90 rounded-3xl p-5 sm:p-6 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.04)] flex flex-col gap-3.5">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div class="flex items-center gap-2">
                        <h2 class="text-base font-bold text-slate-900 tracking-tight">
                            Prioritas Perhatian Balita
                        </h2>
                        <span class="text-[10px] font-bold uppercase text-slate-600 bg-slate-100 border border-slate-200 px-2 py-0.5 rounded-full">
                            {{ count($priorityChildren ?? []) }} Anak
                        </span>
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
                           class="group py-3 first:pt-0.5 last:pb-0.5 flex items-center justify-between gap-3 hover:bg-slate-50/90 -mx-2 px-2.5 rounded-xl transition-all cursor-pointer">
                            
                            {{-- Avatar & Child Details --}}
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-9 h-9 rounded-full flex items-center justify-center shrink-0 font-extrabold text-xs shadow-2xs {{ $isDanger ? 'bg-gradient-to-br from-rose-500 to-pink-600 text-white' : 'bg-gradient-to-br from-amber-400 to-orange-500 text-white' }}">
                                    {{ $initials }}
                                </div>
                                <div class="flex flex-col min-w-0">
                                    <h4 class="text-xs sm:text-[13.5px] font-bold text-slate-900 group-hover:text-teal-700 transition-colors truncate">
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
                                    <span class="inline-flex items-center gap-1 text-[10.5px] font-bold text-rose-800 bg-rose-50 border border-rose-200 px-2.5 py-0.5 rounded-full shadow-2xs">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span>{{ $child->shortStatus ?? 'Konfirmasi TB' }}</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-[10.5px] font-bold text-amber-800 bg-amber-50 border border-amber-200 px-2.5 py-0.5 rounded-full shadow-2xs">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 shrink-0"></span>
                                        <span>{{ $child->shortStatus ?? 'Pantauan Gizi' }}</span>
                                    </span>
                                @endif
                                
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5 text-slate-300 group-hover:text-teal-600 group-hover:translate-x-0.5 transition-all shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </div>
                        </a>
                    @empty
                        <div class="py-8 text-center flex flex-col items-center justify-center text-slate-400">
                            <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-2 border border-emerald-100 shadow-2xs">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
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
            <div class="lg:col-span-5 bg-white border border-slate-200/90 rounded-3xl p-5 sm:p-6 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.04)] flex flex-col justify-between gap-4">
                <div>
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <h2 class="text-base font-bold text-slate-900 tracking-tight">
                            Agenda Posyandu
                        </h2>
                        <a href="{{ route('jadwal.index') }}" class="text-xs font-bold text-teal-700 hover:text-teal-800 transition-colors">
                            Semua &rarr;
                        </a>
                    </div>

                    @if(isset($jadwalTerdekat) && $jadwalTerdekat)
                        <div class="flex flex-col gap-3 mt-3.5">
                            
                            {{-- Schedule Banner Card --}}
                            <a href="{{ route('jadwal.show', $jadwalTerdekat['id']) }}" 
                               class="group p-3.5 bg-gradient-to-br from-slate-50 to-teal-50/20 border border-slate-200/80 hover:border-teal-300 rounded-2xl transition-all flex items-start gap-3.5 cursor-pointer shadow-2xs">
                                
                                {{-- Calendar Date Block --}}
                                <div class="w-12 rounded-xl overflow-hidden border border-slate-200 shadow-2xs bg-white shrink-0 text-center">
                                    <div class="py-0.5 text-[8.5px] font-black uppercase tracking-wider {{ ($jadwalTerdekat['status_type'] ?? '') === 'today' ? 'bg-amber-500 text-white' : 'bg-teal-700 text-white' }}">
                                        {{ $jadwalTerdekat['tgl_bulan'] ?? 'POS' }}
                                    </div>
                                    <div class="py-1 px-1 flex flex-col items-center">
                                        <span class="text-base font-black text-slate-900 leading-none">{{ $jadwalTerdekat['tgl_nomor'] ?? '00' }}</span>
                                        <span class="text-[7.5px] font-extrabold text-slate-400 uppercase mt-0.5">{{ substr($jadwalTerdekat['hari'] ?? 'POS', 0, 3) }}</span>
                                    </div>
                                </div>

                                {{-- Details --}}
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-xs sm:text-[13.5px] font-bold text-slate-900 group-hover:text-teal-700 transition-colors truncate">
                                        {{ $jadwalTerdekat['judul'] }}
                                    </h4>
                                    <div class="flex items-center gap-1 text-[11px] text-slate-500 font-medium mt-0.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3 text-teal-600 shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>{{ $jadwalTerdekat['waktu'] }}</span>
                                    </div>
                                    <span class="inline-block mt-2 text-[9.5px] font-black uppercase tracking-wider text-teal-800 bg-teal-100/90 px-2 py-0.5 rounded border border-teal-200">
                                        {{ $jadwalTerdekat['countdown'] }}
                                    </span>
                                </div>
                            </a>

                            {{-- Location Info Pill --}}
                            <div class="p-3 bg-slate-50 border border-slate-200/80 rounded-xl flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-lg bg-teal-50 text-teal-700 border border-teal-100 flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                </div>
                                <div class="flex flex-col min-w-0">
                                    <span class="text-[9.5px] font-bold uppercase tracking-wider text-slate-400">Lokasi Penimbangan</span>
                                    <span class="text-xs font-semibold text-slate-700 truncate">{{ $jadwalTerdekat['lokasi'] }}</span>
                                </div>
                            </div>

                        </div>
                    @else
                        <div class="py-6 text-center flex flex-col items-center justify-center text-slate-400 mt-1">
                            <div class="w-10 h-10 rounded-2xl bg-teal-50 text-teal-600 border border-teal-100 flex items-center justify-center mb-2 shadow-2xs">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-slate-700">Belum Ada Agenda Jadwal</span>
                            <span class="text-[11px] text-slate-400 mt-0.5 mb-2.5">Buat jadwal kegiatan agar terbit di portal orang tua.</span>
                            <a href="{{ route('jadwal.create') }}" 
                               class="inline-flex items-center gap-1 text-xs font-bold bg-teal-600 hover:bg-teal-700 active:bg-teal-800 text-white px-3.5 py-1.5 rounded-xl shadow-2xs transition-all">
                                + Buat Jadwal
                            </a>
                        </div>
                    @endif
                </div>

                {{-- Quick Link to Center Reports --}}
                <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
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
