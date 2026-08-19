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

<div class="w-full min-h-screen bg-[#F8FAFC] pb-24 lg:pb-16 text-slate-800 antialiased">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 sm:py-7 flex flex-col gap-5 sm:gap-6">
        
        {{-- ── 1. LIVELY & POLISHED APP HEADER ── --}}
        <div class="bg-white border-t-4 border-t-teal-600 border-x border-b border-slate-200/90 rounded-2xl sm:rounded-3xl p-5 sm:p-6 shadow-xs flex flex-col md:flex-row md:items-center justify-between gap-5">
            
            {{-- Left: Sapaan & Konteks Posyandu --}}
            <div class="flex-1 min-w-0">
                <div class="flex flex-wrap items-center gap-2 mb-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-teal-50 border border-teal-200 text-teal-800 rounded-full text-xs font-bold uppercase tracking-wider shadow-2xs">
                        <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                        {{ $activityLocation ?? ($posyanduName ?? 'Posyandu') }}
                    </span>
                    <span class="inline-flex items-center gap-1 text-xs text-slate-500 font-medium">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $todayFormatted }}
                    </span>
                </div>

                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight leading-tight">
                    Selamat bertugas, {{ $kaderName ?? 'Ibu Kader' }} 👋
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1 leading-relaxed max-w-xl">
                    Pusat pemantauan tumbuh kembang balita, deteksi dini status KMS, dan sinkronisasi data Puskesmas.
                </p>
            </div>

            {{-- Right: Primary Quick Action Hub --}}
            <div class="flex items-center gap-3 shrink-0">
                <a href="{{ route('balita.create') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-teal-50/80 hover:bg-teal-100 active:scale-[0.98] border border-teal-200/90 text-teal-800 rounded-xl text-xs sm:text-sm font-bold shadow-2xs transition-all">
                    <svg class="w-4 h-4 text-teal-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                    </svg>
                    <span>Daftar Balita</span>
                </a>
                <a href="{{ route('balita.index') }}" 
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-teal-600 hover:bg-teal-700 active:scale-[0.98] text-white rounded-xl text-xs sm:text-sm font-bold shadow-sm shadow-teal-600/30 hover:shadow transition-all">
                    <svg class="w-4 h-4 text-teal-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0l2.469 10.106c.122.499.106 1.028.589 1.202a5.989 5.989 0 002.031.352 5.989 5.989 0 002.031-.352c.483-.174.711-.703.59-1.202L5.25 4.971z" />
                    </svg>
                    <span>Mulai Penimbangan</span>
                </a>
            </div>
        </div>

        {{-- ── 2. ALERT PERLU REVISI (Soft Amber-Orange Alert) ── --}}
        @if(isset($statRevisi) && $statRevisi > 0)
        <div class="bg-gradient-to-r from-amber-50 via-orange-50/40 to-white border border-amber-200/90 rounded-2xl p-4 sm:p-4.5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 shadow-2xs">
            <div class="flex items-start sm:items-center gap-3.5 min-w-0">
                <div class="w-10 h-10 rounded-xl bg-amber-500 text-white flex items-center justify-center shrink-0 shadow-xs ring-4 ring-amber-100">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
                <div class="flex flex-col min-w-0">
                    <div class="flex items-center gap-2">
                        <span class="text-[11px] font-extrabold uppercase tracking-wider text-amber-900 bg-amber-200/80 px-2.5 py-0.5 rounded-full border border-amber-300">
                            Perlu Tindakan
                        </span>
                        <span class="text-xs sm:text-sm font-bold text-amber-950">{{ $statRevisi }} Data Balita Perlu Koreksi</span>
                    </div>
                    <p class="text-xs text-amber-800/90 font-medium mt-0.5 leading-relaxed">
                        Puskesmas memberikan catatan verifikasi pada data penimbangan. Silakan timbang ulang anak agar status tervalidasi.
                    </p>
                </div>
            </div>
            <a href="{{ route('balita.index', ['filter' => 'ditolak']) }}" 
               class="w-full sm:w-auto shrink-0 h-9 px-4 bg-amber-600 hover:bg-amber-700 active:bg-amber-800 text-white rounded-xl text-xs font-bold shadow-2xs transition-all flex items-center justify-center gap-1.5 cursor-pointer">
                <span>Tinjau Catatan</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
        @endif

        {{-- ── 3. LIVELY KEY METRICS KPI GRID ── --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-4">
            
            {{-- 1. Total Terdaftar --}}
            <div class="bg-white border border-slate-200/90 hover:border-slate-300 rounded-2xl p-4 sm:p-5 flex flex-col justify-between shadow-2xs transition-all">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Balita</span>
                    <div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center shadow-2xs">
                        <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="flex items-baseline gap-1">
                        <span class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">{{ $total }}</span>
                        <span class="text-xs text-slate-400 font-semibold">anak</span>
                    </div>
                    <span class="text-[11px] text-slate-500 font-medium mt-1 block">Populasi binaan Posyandu</span>
                </div>
            </div>

            {{-- 2. Selesai Ditimbang --}}
            <div class="bg-white border border-emerald-200/80 hover:border-emerald-300 rounded-2xl p-4 sm:p-5 flex flex-col justify-between shadow-2xs transition-all">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Sudah Diukur</span>
                    <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center shadow-2xs">
                        <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="flex items-baseline gap-2">
                        <span class="text-2xl sm:text-3xl font-black text-emerald-700 tracking-tight">{{ $sudah }}</span>
                        <span class="text-xs font-extrabold text-emerald-800 bg-emerald-100 px-2 py-0.5 rounded-full border border-emerald-200">
                            {{ $percent }}% Selesai
                        </span>
                    </div>
                    <div class="w-full bg-emerald-100/70 h-2 rounded-full overflow-hidden mt-2.5">
                        <div class="bg-emerald-600 h-full rounded-full transition-all duration-500 shadow-2xs" style="width: {{ $percent }}%"></div>
                    </div>
                </div>
            </div>

            {{-- 3. Belum Hadir --}}
            <div class="bg-white border border-amber-200/80 hover:border-amber-300 rounded-2xl p-4 sm:p-5 flex flex-col justify-between shadow-2xs transition-all">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-amber-700">Belum Diukur</span>
                    <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center shadow-2xs">
                        <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="flex items-baseline gap-1">
                        <span class="text-2xl sm:text-3xl font-black text-amber-800 tracking-tight">{{ $belum }}</span>
                        <span class="text-xs text-amber-700 font-semibold">balita</span>
                    </div>
                    <a href="{{ route('balita.index', ['filter' => 'belum_diukur']) }}" class="text-[11.5px] font-bold text-amber-800 hover:text-amber-900 mt-1.5 inline-flex items-center gap-1">
                        <span>Buka antrean hadir</span>
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- 4. Prioritas Pengawasan Gizi --}}
            <div class="bg-white border border-rose-200/80 hover:border-rose-300 rounded-2xl p-4 sm:p-5 flex flex-col justify-between shadow-2xs transition-all">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-rose-700">Perlu Pantauan</span>
                    <div class="w-9 h-9 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center shadow-2xs">
                        <svg class="w-4.5 h-4.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="flex items-baseline gap-1">
                        <span class="text-2xl sm:text-3xl font-black text-rose-700 tracking-tight">{{ $statPerlu ?? count($priorityChildren ?? []) }}</span>
                        <span class="text-xs text-rose-600 font-semibold">balita</span>
                    </div>
                    <a href="{{ route('balita.index', ['filter' => 'absen_bulan_lalu']) }}" class="text-[11.5px] font-bold text-rose-700 hover:text-rose-800 mt-1.5 inline-flex items-center gap-1">
                        <span>Lihat daftar pantauan</span>
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>

        {{-- ── 4. TWO-COLUMN OPERATIONAL WORKSPACE ── --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 sm:gap-6">
            
            {{-- Left Column (7-col): Prioritas Pemantauan Gizi --}}
            <div class="lg:col-span-7 bg-white border border-slate-200/90 rounded-2xl sm:rounded-3xl shadow-2xs overflow-hidden flex flex-col">
                
                {{-- Header --}}
                <div class="p-4 sm:p-5 pb-3.5 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center border border-rose-100">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-sm sm:text-base font-extrabold text-slate-900 tracking-tight">
                                Prioritas Pemantauan Gizi
                            </h2>
                            <p class="text-xs text-slate-400 font-medium">Balita yang memerlukan perhatian gizi berkala</p>
                        </div>
                    </div>
                    <a href="{{ route('balita.index') }}" class="text-xs font-bold text-teal-700 hover:text-teal-800 transition-colors">
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
                           class="group px-4 sm:px-5 py-3.5 flex items-center justify-between gap-3 hover:bg-slate-50/90 transition-all cursor-pointer">
                            
                            {{-- Info Balita --}}
                            <div class="flex items-center gap-3.5 min-w-0">
                                <div class="w-10 h-10 rounded-full font-extrabold text-xs flex items-center justify-center shrink-0 shadow-2xs {{ $isDanger ? 'bg-rose-100 text-rose-700 ring-2 ring-rose-200/70' : 'bg-amber-100 text-amber-800 ring-2 ring-amber-200/70' }}">
                                    {{ $initials }}
                                </div>
                                <div class="flex flex-col min-w-0">
                                    <span class="text-xs sm:text-[13.5px] font-bold text-slate-900 group-hover:text-teal-700 transition-colors truncate">
                                        {{ Str::title($child->name) }}
                                    </span>
                                    <span class="text-[11px] text-slate-500 font-medium truncate mt-0.5">
                                        Ibu {{ $child->mother ?? '-' }} &bull; {{ $child->age }}
                                    </span>
                                </div>
                            </div>

                            {{-- Status Badge & Arrow --}}
                            <div class="flex items-center gap-2.5 shrink-0">
                                @if($isDanger)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-50 text-rose-700 border border-rose-200 shadow-2xs">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                        <span>{{ $child->shortStatus ?? 'Konfirmasi TB' }}</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-50 text-amber-800 border border-amber-200 shadow-2xs">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        <span>{{ $child->shortStatus ?? 'Pantauan Gizi' }}</span>
                                    </span>
                                @endif

                                <svg class="w-4 h-4 text-slate-300 group-hover:text-teal-600 group-hover:translate-x-0.5 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </div>
                        </a>
                    @empty
                        <div class="p-8 text-center text-slate-400">
                            <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mx-auto mb-2 border border-emerald-100 shadow-2xs">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="text-xs font-bold text-slate-700">Seluruh balita terpantau baik</p>
                            <p class="text-[11px] text-slate-400 mt-0.5">Tidak ada balita yang memerlukan tindakan darurat.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Right Column (5-col): Agenda Posyandu & Quick Export --}}
            <div class="lg:col-span-5 flex flex-col gap-4 sm:gap-5">
                
                {{-- Agenda Terdekat --}}
                <div class="bg-white border border-slate-200/90 rounded-2xl sm:rounded-3xl p-5 shadow-2xs flex flex-col justify-between">
                    <div class="flex items-center justify-between pb-3.5 border-b border-slate-100">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center border border-teal-100">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-sm sm:text-base font-extrabold text-slate-900 tracking-tight">
                                    Agenda Posyandu
                                </h2>
                                <p class="text-[11px] text-slate-400 font-medium">Jadwal sesi penimbangan terdekat</p>
                            </div>
                        </div>
                        <a href="{{ route('jadwal.index') }}" class="text-xs font-bold text-teal-700 hover:text-teal-800 transition-colors">
                            Semua &rarr;
                        </a>
                    </div>

                    @if(isset($jadwalTerdekat) && $jadwalTerdekat)
                        <div class="mt-4 flex flex-col gap-3">
                            <a href="{{ route('jadwal.show', $jadwalTerdekat['id']) }}" 
                               class="group p-3.5 bg-slate-50/80 hover:bg-teal-50/40 border border-slate-200/90 hover:border-teal-300 rounded-2xl transition-all flex items-start gap-3.5 cursor-pointer shadow-2xs">
                                
                                {{-- Date Stamp Ticket --}}
                                <div class="w-11 rounded-xl overflow-hidden border border-slate-200 bg-white text-center shrink-0 shadow-2xs">
                                    <div class="bg-teal-700 text-white text-[8.5px] font-black uppercase py-0.5">
                                        {{ $jadwalTerdekat['tgl_bulan'] ?? 'POS' }}
                                    </div>
                                    <div class="py-1 text-sm font-black text-slate-900 leading-none">
                                        {{ $jadwalTerdekat['tgl_nomor'] ?? '00' }}
                                    </div>
                                </div>

                                {{-- Event Details --}}
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-xs sm:text-[13.5px] font-bold text-slate-900 group-hover:text-teal-700 transition-colors truncate">
                                        {{ $jadwalTerdekat['judul'] }}
                                    </h3>
                                    <p class="text-[11px] text-slate-500 font-medium mt-0.5 truncate">
                                        {{ $jadwalTerdekat['waktu'] }} &bull; {{ $jadwalTerdekat['lokasi'] }}
                                    </p>
                                    <span class="inline-block mt-2 text-[10px] font-bold uppercase tracking-wider text-teal-800 bg-teal-100/90 border border-teal-200 px-2 py-0.5 rounded-md">
                                        {{ $jadwalTerdekat['countdown'] }}
                                    </span>
                                </div>
                            </a>
                        </div>
                    @else
                        <div class="py-6 text-center text-slate-400">
                            <p class="text-xs font-bold text-slate-700">Belum ada agenda jadwal</p>
                            <a href="{{ route('jadwal.create') }}" class="text-[11px] font-bold text-teal-700 hover:underline mt-1 inline-block">+ Buat jadwal posyandu</a>
                        </div>
                    @endif
                </div>

                {{-- Quick Export Card --}}
                <div class="bg-white border border-slate-200/90 rounded-2xl sm:rounded-3xl p-4 sm:p-5 shadow-2xs flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center shrink-0 border border-teal-100">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <div class="flex flex-col min-w-0">
                            <h3 class="text-xs sm:text-sm font-bold text-slate-900">Rekap Laporan Bulanan</h3>
                            <p class="text-[11px] text-slate-500 font-medium">Ekspor data antropometri untuk laporan Puskesmas.</p>
                        </div>
                    </div>
                    <a href="{{ route('laporan.index') }}" 
                       class="px-3.5 py-2 bg-slate-100 hover:bg-teal-600 hover:text-white text-slate-700 text-xs font-bold rounded-xl transition-all shrink-0">
                        Buka Laporan
                    </a>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection
