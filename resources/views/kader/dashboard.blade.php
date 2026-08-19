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

<div class="w-full min-h-screen bg-[#F8FAFC] pb-28 lg:pb-16 text-slate-800 antialiased">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 sm:pt-6 flex flex-col gap-4 sm:gap-5">
        
        {{-- ── 1. CLEAN & HARMONIOUS HERO CARD (Light, Elegant, Balanced Spacing) ── --}}
        <div class="bg-white border border-slate-200/90 rounded-2xl sm:rounded-3xl p-4 sm:p-6 shadow-2xs">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 sm:gap-6">
                
                {{-- Left: Sapaan & Konteks Posyandu --}}
                <div class="flex-1 min-w-0">
                    <div class="flex flex-wrap items-center gap-2 mb-1.5">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 bg-teal-50 border border-teal-200/80 rounded-full text-[11px] font-bold text-teal-800 uppercase tracking-wider">
                            <span class="w-1.5 h-1.5 rounded-full bg-teal-500 animate-pulse"></span>
                            {{ $activityLocation ?? ($posyanduName ?? 'Posyandu') }}
                        </span>
                        <span class="text-xs text-slate-500 font-medium">
                            &bull; {{ $todayFormatted }}
                        </span>
                    </div>

                    <h1 class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-slate-900 tracking-tight leading-snug">
                        Selamat Bertugas, {{ $kaderName ?? 'Ibu Kader' }} 👋
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-500 font-medium mt-0.5 max-w-xl">
                        Pusat pemantauan tumbuh kembang balita dan sinkronisasi data antropometri Puskesmas.
                    </p>
                </div>

                {{-- Right: 4 Clean Snapshot Stat Tiles (Harmonized, Crisp & High Readability) --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 sm:gap-2.5 shrink-0">
                    
                    {{-- Total Balita --}}
                    <div class="bg-slate-50 border border-slate-200/80 rounded-xl p-2.5 sm:p-3 flex flex-col justify-center min-w-[95px] sm:min-w-[105px]">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Total Balita</span>
                        <span class="text-lg sm:text-xl font-black text-slate-900 mt-0.5 leading-none">{{ $total }}</span>
                    </div>

                    {{-- Selesai Ukur --}}
                    <div class="bg-emerald-50/70 border border-emerald-200/80 rounded-xl p-2.5 sm:p-3 flex flex-col justify-center min-w-[95px] sm:min-w-[105px]">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700">Selesai</span>
                        <span class="text-lg sm:text-xl font-black text-emerald-700 mt-0.5 leading-none">{{ $sudah }}</span>
                    </div>

                    {{-- Belum Hadir --}}
                    <div class="bg-amber-50/70 border border-amber-200/80 rounded-xl p-2.5 sm:p-3 flex flex-col justify-center min-w-[95px] sm:min-w-[105px]">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-amber-700">Belum</span>
                        <span class="text-lg sm:text-xl font-black text-amber-700 mt-0.5 leading-none">{{ $belum }}</span>
                    </div>

                    {{-- Perlu Revisi --}}
                    <div class="bg-rose-50/70 border border-rose-200/80 rounded-xl p-2.5 sm:p-3 flex flex-col justify-center min-w-[95px] sm:min-w-[105px]">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-rose-700">Revisi</span>
                        <span class="text-lg sm:text-xl font-black text-rose-700 mt-0.5 leading-none">{{ $statRevisi ?? 0 }}</span>
                    </div>

                </div>

            </div>
        </div>

        {{-- ── 2. ALERT PERLU REVISI (Soft & Integrated Notice) ── --}}
        @if(isset($statRevisi) && $statRevisi > 0)
        <div class="bg-rose-50/90 border border-rose-200 rounded-2xl p-3.5 sm:p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 shadow-2xs">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-9 h-9 rounded-xl bg-rose-500 text-white flex items-center justify-center shrink-0 shadow-2xs">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4.5 h-4.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                </div>
                <div class="flex flex-col min-w-0">
                    <div class="flex items-center gap-1.5">
                        <span class="text-[10.5px] font-extrabold uppercase tracking-wider text-rose-800 bg-rose-200/80 px-2 py-0.2 rounded">
                            Perlu Revisi Kader
                        </span>
                        <span class="text-xs font-bold text-rose-900">{{ $statRevisi }} Balita Perlu Koreksi</span>
                    </div>
                    <p class="text-xs text-rose-700 font-medium truncate mt-0.5">
                        Puskesmas memberikan catatan verifikasi pada data penimbangan.
                    </p>
                </div>
            </div>
            <a href="{{ route('balita.index', ['filter' => 'ditolak']) }}" 
               class="w-full sm:w-auto shrink-0 h-9 px-3.5 bg-rose-600 hover:bg-rose-700 active:bg-rose-800 text-white rounded-xl text-xs font-bold shadow-2xs transition-all flex items-center justify-center gap-1.5 cursor-pointer">
                <span>Tinjau Catatan</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
        @endif

        {{-- ── 3. OPERATIONAL ACTION TILES (Thumb-Friendly & Balanced) ── --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 sm:gap-4">
            
            {{-- Action 1: Ukur & Timbang Balita (Primary Action) --}}
            <a href="{{ route('balita.index') }}" 
               class="group relative bg-teal-600 hover:bg-teal-700 active:scale-[0.99] text-white rounded-2xl p-4 sm:p-5 shadow-sm hover:shadow transition-all flex items-center justify-between gap-4 cursor-pointer min-h-[96px]">
                
                <div class="flex items-center gap-3.5 min-w-0">
                    <div class="w-11 h-11 rounded-xl bg-white/20 flex items-center justify-center text-white shrink-0 group-hover:scale-105 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0l2.469 10.106c.122.499.106 1.028.589 1.202a5.989 5.989 0 002.031.352 5.989 5.989 0 002.031-.352c.483-.174.711-.703.59-1.202L5.25 4.971z" />
                        </svg>
                    </div>
                    <div class="flex flex-col min-w-0">
                        <div class="flex items-center gap-2">
                            <h3 class="text-base font-bold text-white tracking-tight">
                                Ukur & Timbang Balita
                            </h3>
                            <span class="text-[10px] font-extrabold uppercase tracking-wider bg-white/20 px-2 py-0.5 rounded-full shrink-0">
                                Sesi Aktif
                            </span>
                        </div>
                        <p class="text-xs text-teal-100 font-medium mt-0.5 leading-normal">
                            Input BB, TB, lingkar kepala & hitung status KMS
                        </p>
                    </div>
                </div>

                <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center text-white shrink-0 group-hover:translate-x-1 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
            </a>

            {{-- Action 2: Registrasi Balita Baru --}}
            <a href="{{ route('balita.create') }}" 
               class="group bg-white hover:bg-slate-50 border border-slate-200/90 hover:border-slate-300 rounded-2xl p-4 sm:p-5 shadow-2xs transition-all flex items-center justify-between gap-4 cursor-pointer min-h-[96px]">
                
                <div class="flex items-center gap-3.5 min-w-0">
                    <div class="w-11 h-11 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                        </svg>
                    </div>
                    <div class="flex flex-col min-w-0">
                        <div class="flex items-center gap-2">
                            <h3 class="text-base font-bold text-slate-900 group-hover:text-teal-700 transition-colors tracking-tight">
                                Daftarkan Balita Baru
                            </h3>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500 bg-slate-100 px-2 py-0.5 rounded-full shrink-0">
                                Registrasi
                            </span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium mt-0.5 leading-normal">
                            Tambah data anak baru lahir/pindahan & orang tua
                        </p>
                    </div>
                </div>

                <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 group-hover:text-slate-700 shrink-0 group-hover:translate-x-1 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
            </a>

        </div>

        {{-- ── 4. ANALYTICAL BENTO: REKAP PENIMBANGAN & PENGAWASAN GIZI ── --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
            
            {{-- Left Bento (8-col): Cakupan Pengukuran & Progres Periode --}}
            <div class="lg:col-span-8 bg-white border border-slate-200/90 rounded-2xl p-4 sm:p-5 shadow-2xs flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div>
                            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                Cakupan Penimbangan Bulan Ini
                            </span>
                            <h2 class="text-base font-bold text-slate-900 tracking-tight mt-0.5">
                                {{ $sudah }} dari {{ $total }} Balita Selesai Diukur
                            </h2>
                        </div>
                        <div class="flex items-center gap-1 bg-teal-50 px-3 py-1 rounded-xl border border-teal-200/80">
                            <span class="text-xs font-bold text-teal-800">{{ $percent }}%</span>
                        </div>
                    </div>

                    {{-- Progress Bar Bersih --}}
                    <div class="mt-4">
                        <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-teal-600 rounded-full transition-all duration-500" style="width: {{ $percent }}%"></div>
                        </div>
                    </div>
                </div>

                {{-- Metric Sub-Row --}}
                <div class="grid grid-cols-3 gap-2 mt-4 pt-3 border-t border-slate-100 text-left">
                    <div class="flex flex-col">
                        <span class="text-[11px] font-medium text-slate-500">Total Register</span>
                        <span class="text-lg sm:text-xl font-bold text-slate-900 mt-0.5">{{ $total }}</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[11px] font-medium text-emerald-700 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Sudah Diukur
                        </span>
                        <span class="text-lg sm:text-xl font-bold text-emerald-700 mt-0.5">{{ $sudah }}</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[11px] font-medium text-amber-700 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Belum Diukur
                        </span>
                        <span class="text-lg sm:text-xl font-bold text-amber-700 mt-0.5">{{ $belum }}</span>
                    </div>
                </div>
            </div>

            {{-- Right Bento (4-col): Status Pemantauan Gizi --}}
            <div class="lg:col-span-4 bg-gradient-to-br from-amber-50/70 via-amber-50/30 to-white border border-amber-200/90 rounded-2xl p-4 sm:p-5 shadow-2xs flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between gap-2">
                        <span class="text-[10.5px] font-bold uppercase tracking-wider text-amber-900 bg-amber-100 px-2 py-0.5 rounded border border-amber-200">
                            Pengawasan Gizi
                        </span>
                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-ping"></span>
                    </div>
                    <h3 class="text-sm sm:text-base font-bold text-slate-900 tracking-tight mt-2">
                        Prioritas Pemantauan
                    </h3>
                    <p class="text-xs text-slate-600 font-medium mt-0.5 leading-relaxed">
                        Balita yang memerlukan perhatian gizi khusus dan konfirmasi TB.
                    </p>
                </div>

                <div class="mt-4 pt-3 border-t border-amber-200/70 flex items-end justify-between">
                    <div>
                        <span class="text-2xl sm:text-3xl font-black text-amber-950 tracking-tight">
                            {{ $statPerlu ?? count($priorityChildren ?? []) }}
                        </span>
                        <span class="text-xs font-semibold text-slate-500 ml-1">Anak</span>
                    </div>
                    <a href="{{ route('balita.index', ['filter' => 'absen_bulan_lalu']) }}" 
                       class="inline-flex items-center gap-1 text-xs font-bold text-teal-700 hover:text-teal-800 transition-colors">
                        <span>Lihat Antrean</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>

        {{-- ── 5. DUAL WORKSPACE: PRIORITAS PERHATIAN & AGENDA JADWAL ── --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
            
            {{-- Left Side (7-col): Daftar Prioritas Perhatian Balita --}}
            <div class="lg:col-span-7 bg-white border border-slate-200/90 rounded-2xl p-4 sm:p-5 shadow-2xs flex flex-col gap-3">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div class="flex items-center gap-2">
                        <h2 class="text-sm sm:text-base font-bold text-slate-900 tracking-tight">
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
                           class="group py-3 first:pt-0.5 last:pb-0.5 flex items-center justify-between gap-3 hover:bg-slate-50/90 -mx-2 px-2 rounded-xl transition-all cursor-pointer">
                            
                            {{-- Avatar & Child Details --}}
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-9 h-9 rounded-full flex items-center justify-center shrink-0 font-bold text-xs shadow-2xs {{ $isDanger ? 'bg-rose-100 text-rose-700 border border-rose-200' : 'bg-amber-100 text-amber-800 border border-amber-200' }}">
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
                                    <span class="inline-flex items-center gap-1 text-[10.5px] font-bold text-rose-800 bg-rose-50 border border-rose-200 px-2 py-0.5 rounded-md">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                        <span>{{ $child->shortStatus ?? 'Konfirmasi TB' }}</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-[10.5px] font-bold text-amber-800 bg-amber-50 border border-amber-200 px-2 py-0.5 rounded-md">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        <span>{{ $child->shortStatus ?? 'Pantauan Gizi' }}</span>
                                    </span>
                                @endif
                                
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5 text-slate-300 group-hover:text-teal-600 group-hover:translate-x-0.5 transition-all shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </div>
                        </a>
                    @empty
                        <div class="py-6 text-center flex flex-col items-center justify-center text-slate-400">
                            <div class="w-9 h-9 rounded-xl bg-slate-50 flex items-center justify-center mb-1.5 border border-slate-200/80">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-emerald-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-slate-700">Seluruh Balita Terpantau Aman</span>
                            <span class="text-[11px] text-slate-400 mt-0.5">Tidak ada balita dalam status darurat.</span>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Right Side (5-col): Agenda Sesi Posyandu Terdekat --}}
            <div class="lg:col-span-5 bg-white border border-slate-200/90 rounded-2xl p-4 sm:p-5 shadow-2xs flex flex-col justify-between gap-3.5">
                <div>
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <h2 class="text-sm sm:text-base font-bold text-slate-900 tracking-tight">
                            Agenda Posyandu
                        </h2>
                        <a href="{{ route('jadwal.index') }}" class="text-xs font-bold text-teal-700 hover:text-teal-800 transition-colors">
                            Semua &rarr;
                        </a>
                    </div>

                    @if(isset($jadwalTerdekat) && $jadwalTerdekat)
                        <div class="flex flex-col gap-2.5 mt-3">
                            
                            {{-- Schedule Banner Card --}}
                            <a href="{{ route('jadwal.show', $jadwalTerdekat['id']) }}" 
                               class="group p-3 bg-slate-50/80 hover:bg-teal-50/50 border border-slate-200/80 hover:border-teal-300 rounded-xl transition-all flex items-start gap-3 cursor-pointer shadow-2xs">
                                
                                {{-- Calendar Date Block --}}
                                <div class="w-11 rounded-xl overflow-hidden border border-slate-200 shadow-2xs bg-white shrink-0 text-center">
                                    <div class="py-0.5 text-[8px] font-black uppercase tracking-wider {{ ($jadwalTerdekat['status_type'] ?? '') === 'today' ? 'bg-amber-500 text-white' : 'bg-teal-700 text-white' }}">
                                        {{ $jadwalTerdekat['tgl_bulan'] ?? 'POS' }}
                                    </div>
                                    <div class="py-1 px-0.5 flex flex-col items-center">
                                        <span class="text-sm font-black text-slate-900 leading-none">{{ $jadwalTerdekat['tgl_nomor'] ?? '00' }}</span>
                                        <span class="text-[7px] font-bold text-slate-400 uppercase mt-0.5">{{ substr($jadwalTerdekat['hari'] ?? 'POS', 0, 3) }}</span>
                                    </div>
                                </div>

                                {{-- Details --}}
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-xs sm:text-[13px] font-bold text-slate-900 group-hover:text-teal-700 transition-colors truncate">
                                        {{ $jadwalTerdekat['judul'] }}
                                    </h4>
                                    <div class="flex items-center gap-1 text-[11px] text-slate-500 font-medium mt-0.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3 text-teal-600 shrink-0">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>{{ $jadwalTerdekat['waktu'] }}</span>
                                    </div>
                                    <span class="inline-block mt-1.5 text-[9.5px] font-bold uppercase tracking-wider text-teal-800 bg-teal-100/90 px-2 py-0.5 rounded border border-teal-200">
                                        {{ $jadwalTerdekat['countdown'] }}
                                    </span>
                                </div>
                            </a>

                            {{-- Location Info Pill --}}
                            <div class="p-2.5 bg-slate-50 border border-slate-200/80 rounded-xl flex items-center gap-2.5">
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
                        <div class="py-5 text-center flex flex-col items-center justify-center text-slate-400 mt-1">
                            <div class="w-9 h-9 rounded-xl bg-teal-50 text-teal-600 border border-teal-100 flex items-center justify-center mb-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-slate-700">Belum Ada Agenda Jadwal</span>
                            <span class="text-[11px] text-slate-400 mt-0.5 mb-2">Buat jadwal kegiatan posyandu.</span>
                            <a href="{{ route('jadwal.create') }}" 
                               class="inline-flex items-center gap-1 text-xs font-bold bg-teal-600 hover:bg-teal-700 active:bg-teal-800 text-white px-3 py-1.5 rounded-xl shadow-2xs transition-all">
                                + Buat Jadwal
                            </a>
                        </div>
                    @endif
                </div>

                {{-- Quick Link to Center Reports --}}
                <div class="pt-2.5 border-t border-slate-100 flex items-center justify-between text-xs">
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
