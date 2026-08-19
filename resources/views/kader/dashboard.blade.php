@extends('layouts.app')
@section('page-title', 'Dashboard')
@section('content')

@php
    $total = (int) ($statTotal ?? 0);
    $sudah = (int) ($statSudah ?? 0);
    $belum = (int) ($statBelum ?? max(0, $total - $sudah));
    $percent = $total > 0 ? min(100, round(($sudah / $total) * 100)) : 0;
    $todayFormatted = \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y');
@endphp

<div class="w-full min-h-screen bg-[#F0FDF4]/30 pb-24 lg:pb-16 text-slate-800 antialiased font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 sm:py-7 flex flex-col gap-5 sm:gap-6">
        
        {{-- ── 1. VIBRANT NUTRIGEN BRAND HERO HEADER ── --}}
        <div class="relative bg-gradient-to-br from-teal-800 via-teal-700 to-emerald-800 text-white rounded-3xl p-6 sm:p-7 lg:p-8 shadow-lg shadow-teal-900/15 border border-teal-600/40 overflow-hidden">
            
            {{-- Ambient Glow --}}
            <div class="absolute -right-12 -top-12 w-64 h-64 bg-emerald-400/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute left-1/3 -bottom-16 w-56 h-56 bg-teal-400/20 rounded-full blur-2xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                
                {{-- Left: Sapaan & Konteks Posyandu --}}
                <div class="flex-1 max-w-2xl">
                    <div class="flex flex-wrap items-center gap-2 mb-2.5">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-white/20 backdrop-blur-md border border-white/25 text-white rounded-full text-xs font-bold uppercase tracking-wider shadow-2xs">
                            <span class="w-2 h-2 rounded-full bg-emerald-300 animate-pulse"></span>
                            {{ $activityLocation ?? ($posyanduName ?? 'Posyandu') }}
                        </span>
                        <span class="inline-flex items-center gap-1 text-xs text-teal-100 font-medium bg-black/10 px-3 py-1 rounded-full backdrop-blur-sm border border-white/10">
                            <svg class="w-3.5 h-3.5 text-teal-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $todayFormatted }}
                        </span>
                    </div>

                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white tracking-tight leading-tight">
                        Selamat bertugas, {{ $kaderName ?? 'Ibu Kader' }}
                    </h1>
                    <p class="text-xs sm:text-sm text-teal-100 font-medium mt-1.5 leading-relaxed max-w-xl">
                        Pusat pemantauan tumbuh kembang balita, deteksi dini status KMS, dan sinkronisasi data antropometri Puskesmas.
                    </p>
                </div>

                {{-- Right: High-Impact Action Buttons --}}
                <div class="flex items-center gap-3 shrink-0">
                    <a href="{{ route('balita.create') }}" 
                       class="inline-flex items-center gap-2 px-4 py-2.5 bg-white/15 hover:bg-white/25 active:scale-[0.98] backdrop-blur-md border border-white/30 text-white rounded-xl text-xs sm:text-sm font-bold shadow-xs transition-all">
                        <svg class="w-4 h-4 text-emerald-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                        </svg>
                        <span>Daftar Balita</span>
                    </a>
                    <a href="{{ route('balita.index') }}" 
                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-emerald-400 to-teal-300 hover:from-emerald-300 hover:to-teal-200 active:scale-[0.98] text-teal-950 rounded-xl text-xs sm:text-sm font-extrabold shadow-md shadow-black/10 hover:shadow-lg transition-all">
                        <svg class="w-4 h-4 text-teal-950" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0l2.469 10.106c.122.499.106 1.028.589 1.202a5.989 5.989 0 002.031.352 5.989 5.989 0 002.031-.352c.483-.174.711-.703.59-1.202L5.25 4.971z" />
                        </svg>
                        <span>Mulai Penimbangan</span>
                    </a>
                </div>

            </div>
        </div>

        {{-- ── 2. ALERT PERLU REVISI (High-Contrast & Vibrant Alert) ── --}}
        @if(isset($statRevisi) && $statRevisi > 0)
        <div class="bg-gradient-to-r from-amber-100/90 via-amber-50 to-orange-50/70 border-2 border-amber-300/80 rounded-2xl p-4 sm:p-4.5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 shadow-xs">
            <div class="flex items-start sm:items-center gap-3.5 min-w-0">
                <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-amber-500 to-orange-500 text-white flex items-center justify-center shrink-0 shadow-sm ring-4 ring-amber-200/80">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
                <div class="flex flex-col min-w-0">
                    <div class="flex items-center gap-2">
                        <span class="text-[11px] font-extrabold uppercase tracking-wider text-amber-950 bg-amber-200 px-2.5 py-0.5 rounded-full border border-amber-400">
                            Perlu Tindakan Kader
                        </span>
                        <span class="text-xs sm:text-sm font-bold text-amber-950">{{ $statRevisi }} Balita Perlu Koreksi Penimbangan</span>
                    </div>
                    <p class="text-xs text-amber-900 font-semibold mt-0.5 leading-relaxed">
                        Puskesmas memberikan catatan verifikasi pada data penimbangan. Silakan timbang ulang balita agar status tervalidasi.
                    </p>
                </div>
            </div>
            <a href="{{ route('balita.index', ['filter' => 'ditolak']) }}" 
               class="w-full sm:w-auto shrink-0 h-10 px-4 bg-amber-800 hover:bg-amber-900 active:scale-[0.98] text-white rounded-xl text-xs font-bold shadow-xs transition-all flex items-center justify-center gap-1.5 cursor-pointer">
                <span>Tinjau Catatan Revisi</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
        @endif

        {{-- ── 3. LIVELY & VIBRANT KPI METRICS GRID (Non-Flat, Rich Accents) ── --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-4">
            
            {{-- 1. Total Terdaftar --}}
            <div class="bg-gradient-to-br from-teal-500/10 via-emerald-500/5 to-white border border-teal-200 hover:border-teal-300 rounded-3xl p-5 flex flex-col justify-between shadow-xs hover:shadow-md transition-all">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-teal-800">Total Balita</span>
                    <div class="w-9 h-9 rounded-xl bg-teal-600 text-white flex items-center justify-center shadow-xs">
                        <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-baseline gap-1.5">
                        <span class="text-3xl sm:text-4xl font-black text-teal-950 tracking-tight">{{ $total }}</span>
                        <span class="text-xs font-bold text-teal-700">anak</span>
                    </div>
                    <span class="text-[11.5px] text-slate-500 font-medium mt-1 block">Populasi binaan aktif</span>
                </div>
            </div>

            {{-- 2. Selesai Ditimbang --}}
            <div class="bg-gradient-to-br from-emerald-500/15 via-teal-500/5 to-white border border-emerald-300 hover:border-emerald-400 rounded-3xl p-5 flex flex-col justify-between shadow-xs hover:shadow-md transition-all">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-800">Sudah Diukur</span>
                    <div class="w-9 h-9 rounded-xl bg-emerald-600 text-white flex items-center justify-center shadow-xs">
                        <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl sm:text-4xl font-black text-emerald-950 tracking-tight">{{ $sudah }}</span>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-black bg-emerald-100 text-emerald-800 border border-emerald-300">
                            {{ $percent }}% Selesai
                        </span>
                    </div>
                    <div class="w-full bg-emerald-100 h-2 rounded-full overflow-hidden mt-3">
                        <div class="bg-gradient-to-r from-emerald-500 to-teal-500 h-full rounded-full transition-all duration-500" style="width: {{ $percent }}%"></div>
                    </div>
                </div>
            </div>

            {{-- 3. Belum Hadir --}}
            <div class="bg-gradient-to-br from-amber-500/15 via-orange-500/5 to-white border border-amber-300 hover:border-amber-400 rounded-3xl p-5 flex flex-col justify-between shadow-xs hover:shadow-md transition-all">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-amber-900">Belum Diukur</span>
                    <div class="w-9 h-9 rounded-xl bg-amber-500 text-white flex items-center justify-center shadow-xs">
                        <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-baseline gap-1.5">
                        <span class="text-3xl sm:text-4xl font-black text-amber-950 tracking-tight">{{ $belum }}</span>
                        <span class="text-xs font-bold text-amber-800">anak</span>
                    </div>
                    <a href="{{ route('balita.index', ['filter' => 'belum_diukur']) }}" class="text-[11.5px] font-bold text-amber-800 hover:text-amber-950 mt-1 inline-flex items-center gap-1">
                        <span>Buka antrean hadir</span>
                        <svg class="w-3 h-3 text-amber-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- 4. Prioritas Pengawasan Gizi --}}
            <div class="bg-gradient-to-br from-rose-500/15 via-pink-500/5 to-white border border-rose-300 hover:border-rose-400 rounded-3xl p-5 flex flex-col justify-between shadow-xs hover:shadow-md transition-all">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-rose-900">Perlu Pantauan</span>
                    <div class="w-9 h-9 rounded-xl bg-rose-500 text-white flex items-center justify-center shadow-xs">
                        <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-baseline gap-1.5">
                        <span class="text-3xl sm:text-4xl font-black text-rose-950 tracking-tight">{{ $statPerlu ?? count($priorityChildren ?? []) }}</span>
                        <span class="text-xs font-bold text-rose-800">anak</span>
                    </div>
                    <a href="{{ route('balita.index', ['filter' => 'absen_bulan_lalu']) }}" class="text-[11.5px] font-bold text-rose-800 hover:text-rose-950 mt-1 inline-flex items-center gap-1">
                        <span>Lihat daftar pantauan</span>
                        <svg class="w-3 h-3 text-rose-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>

        {{-- ── 4. TWO-COLUMN OPERATIONAL WORKSPACE ── --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 sm:gap-6">
            
            {{-- Left Column (7-col): Prioritas Pemantauan Gizi --}}
            <div class="lg:col-span-7 bg-white border border-slate-200/90 rounded-3xl shadow-xs overflow-hidden flex flex-col">
                
                {{-- Header --}}
                <div class="p-5 pb-4 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center border border-rose-200 shadow-2xs">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-base font-extrabold text-slate-900 tracking-tight">
                                Prioritas Pemantauan Gizi
                            </h2>
                            <p class="text-xs text-slate-500 font-medium">Balita yang memerlukan perhatian gizi berkala</p>
                        </div>
                    </div>
                    <a href="{{ route('balita.index') }}" class="text-xs font-bold text-teal-800 hover:text-teal-950 transition-colors">
                        Semua balita &rarr;
                    </a>
                </div>

                {{-- Child List --}}
                <div class="divide-y divide-slate-100 flex-1">
                    @forelse($priorityChildren ?? [] as $child)
                        @php
                            $isDanger = ($child->statusType ?? 'warning') === 'danger';
                            $initials = strtoupper(substr($child->name ?? 'AN', 0, 2));
                        @endphp
                        <a href="{{ route('balita.show', $child->id) }}" 
                           class="group px-5 py-4 flex items-center justify-between gap-3 hover:bg-slate-50/90 transition-all cursor-pointer">
                            
                            {{-- Info Balita --}}
                            <div class="flex items-center gap-3.5 min-w-0">
                                <div class="w-10 h-10 rounded-full font-black text-xs flex items-center justify-center shrink-0 shadow-xs {{ $isDanger ? 'bg-gradient-to-br from-rose-500 to-pink-600 text-white' : 'bg-gradient-to-br from-amber-400 to-orange-500 text-white' }}">
                                    {{ $initials }}
                                </div>
                                <div class="flex flex-col min-w-0">
                                    <span class="text-sm font-bold text-slate-900 group-hover:text-teal-800 transition-colors truncate">
                                        {{ Str::title($child->name) }}
                                    </span>
                                    <span class="text-xs text-slate-600 font-medium truncate mt-0.5">
                                        Ibu {{ $child->mother ?? '-' }} &bull; {{ $child->age }}
                                    </span>
                                </div>
                            </div>

                            {{-- Status Badge & Arrow --}}
                            <div class="flex items-center gap-2.5 shrink-0">
                                @if($isDanger)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800 border border-rose-300 shadow-2xs">
                                        <span class="w-2 h-2 rounded-full bg-rose-600"></span>
                                        <span>{{ $child->shortStatus ?? 'Konfirmasi TB' }}</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-900 border border-amber-300 shadow-2xs">
                                        <span class="w-2 h-2 rounded-full bg-amber-600"></span>
                                        <span>{{ $child->shortStatus ?? 'Pantauan Gizi' }}</span>
                                    </span>
                                @endif

                                <svg class="w-4 h-4 text-slate-400 group-hover:text-teal-700 group-hover:translate-x-0.5 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </div>
                        </a>
                    @empty
                        <div class="p-8 text-center text-slate-500">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center mx-auto mb-2.5 border border-emerald-200 shadow-xs">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="text-sm font-bold text-slate-900">Seluruh balita terpantau baik</p>
                            <p class="text-xs text-slate-500 mt-0.5">Tidak ada balita yang memerlukan tindakan darurat.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Right Column (5-col): Agenda Posyandu & Quick Export --}}
            <div class="lg:col-span-5 flex flex-col gap-5">
                
                {{-- Agenda Terdekat --}}
                <div class="bg-white border border-slate-200/90 rounded-3xl p-5 sm:p-6 shadow-xs flex flex-col justify-between">
                    <div class="flex items-center justify-between pb-3.5 border-b border-slate-100">
                        <div class="flex items-center gap-2.5">
                            <div class="w-9 h-9 rounded-xl bg-teal-100 text-teal-800 flex items-center justify-center border border-teal-200 shadow-2xs">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-base font-extrabold text-slate-900 tracking-tight">
                                    Agenda Posyandu
                                </h2>
                                <p class="text-xs text-slate-500 font-medium">Jadwal sesi penimbangan terdekat</p>
                            </div>
                        </div>
                        <a href="{{ route('jadwal.index') }}" class="text-xs font-bold text-teal-800 hover:text-teal-950 transition-colors">
                            Semua &rarr;
                        </a>
                    </div>

                    @if(isset($jadwalTerdekat) && $jadwalTerdekat)
                        <div class="mt-4 flex flex-col gap-3">
                            <a href="{{ route('jadwal.show', $jadwalTerdekat['id']) }}" 
                               class="group p-4 bg-gradient-to-br from-slate-50 to-teal-50/30 hover:to-teal-100/50 border border-slate-200/90 hover:border-teal-300 rounded-2xl transition-all flex items-start gap-3.5 cursor-pointer shadow-xs">
                                
                                {{-- Date Stamp Ticket --}}
                                <div class="w-12 rounded-xl overflow-hidden border border-slate-200 bg-white text-center shrink-0 shadow-2xs">
                                    <div class="bg-teal-700 text-white text-[8.5px] font-black uppercase py-0.5">
                                        {{ $jadwalTerdekat['tgl_bulan'] ?? 'POS' }}
                                    </div>
                                    <div class="py-1 text-base font-black text-slate-900 leading-none">
                                        {{ $jadwalTerdekat['tgl_nomor'] ?? '00' }}
                                    </div>
                                </div>

                                {{-- Event Details --}}
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm font-bold text-slate-900 group-hover:text-teal-800 transition-colors truncate">
                                        {{ $jadwalTerdekat['judul'] }}
                                    </h3>
                                    <p class="text-xs text-slate-600 font-medium mt-0.5 truncate">
                                        {{ $jadwalTerdekat['waktu'] }} &bull; {{ $jadwalTerdekat['lokasi'] }}
                                    </p>
                                    <span class="inline-block mt-2 text-[10.5px] font-black uppercase tracking-wider text-teal-950 bg-teal-200/80 border border-teal-300 px-2.5 py-0.5 rounded-full">
                                        {{ $jadwalTerdekat['countdown'] }}
                                    </span>
                                </div>
                            </a>
                        </div>
                    @else
                        <div class="py-6 text-center text-slate-500">
                            <p class="text-sm font-bold text-slate-800">Belum ada agenda jadwal</p>
                            <a href="{{ route('jadwal.create') }}" class="text-xs font-bold text-teal-800 hover:underline mt-1.5 inline-block">+ Buat jadwal posyandu</a>
                        </div>
                    @endif
                </div>

                {{-- Quick Export Card --}}
                <div class="bg-gradient-to-r from-teal-50 to-emerald-50/50 border border-teal-200/90 rounded-3xl p-5 shadow-xs flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-xl bg-teal-600 text-white flex items-center justify-center shrink-0 shadow-xs">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <div class="flex flex-col min-w-0">
                            <h3 class="text-sm font-bold text-slate-900">Rekap Laporan Bulanan</h3>
                            <p class="text-xs text-slate-600 font-medium">Ekspor data antropometri untuk laporan Puskesmas.</p>
                        </div>
                    </div>
                    <a href="{{ route('laporan.index') }}" 
                       class="px-4 py-2.5 bg-teal-700 hover:bg-teal-800 text-white text-xs font-bold rounded-xl transition-all shadow-xs shrink-0">
                        Buka Laporan
                    </a>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection
