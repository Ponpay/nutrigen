@extends('layouts.app')
@section('page-title', 'Dashboard')
@section('content')

@php
    $total = (int) ($statTotal ?? 0);
    $sudah = (int) ($statSudah ?? 0);
    $belum = (int) ($statBelum ?? max(0, $total - $sudah));
    $percent = $total > 0 ? min(100, round(($sudah / $total) * 100)) : 0;
    $todayFormatted = \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y');
    $todayShort = \Carbon\Carbon::now()->locale('id')->translatedFormat('d M Y');

    // Clean greeting title separation
    $cleanName = preg_replace('/\s*\(.*?\)/', '', $kaderName ?? 'Ibu Kader');
@endphp

<div class="w-full min-h-screen bg-[#F8FAFC] pb-24 lg:pb-16 text-slate-800 antialiased font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 flex flex-col gap-4 sm:gap-5">
        
        {{-- ── 1. CLEAN & SPACIOUS WELCOME HEADER ── --}}
        <div class="bg-white border border-slate-200/90 rounded-2xl sm:rounded-3xl p-4.5 sm:p-6 shadow-2xs flex flex-col md:flex-row md:items-center justify-between gap-4 sm:gap-6">
            
            {{-- Left: Sapaan & Konteks --}}
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-2 text-xs font-semibold text-teal-800 mb-1.5">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-teal-50 text-teal-800 border border-teal-200/80 font-bold text-[11px]">
                        <span class="w-1.5 h-1.5 rounded-full bg-teal-600 animate-pulse"></span>
                        <span class="truncate max-w-[200px] sm:max-w-none">{{ $activityLocation ?? ($posyanduName ?? 'Posyandu') }}</span>
                    </span>
                    <span class="text-slate-300">•</span>
                    <span class="text-slate-500 font-medium hidden sm:inline">{{ $todayFormatted }}</span>
                    <span class="text-slate-500 font-medium sm:hidden">{{ $todayShort }}</span>
                </div>

                <h1 class="text-xl sm:text-2xl lg:text-[26px] font-bold text-slate-900 tracking-tight leading-snug">
                    Selamat bertugas, <span class="text-teal-700">{{ $cleanName }}</span>
                </h1>
                
                <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1">
                    Pusat pemantauan tumbuh kembang balita dan sinkronisasi data KMS Puskesmas.
                </p>
            </div>

            {{-- Right: Actions --}}
            <div class="grid grid-cols-2 gap-2.5 sm:flex sm:items-center sm:gap-3 shrink-0 pt-2 sm:pt-0 border-t border-slate-100 sm:border-0">
                <a href="{{ route('balita.create') }}" 
                   class="flex items-center justify-center gap-1.5 px-3.5 sm:px-4 py-2.5 bg-white hover:bg-slate-50 active:scale-[0.98] border border-slate-200 text-slate-700 text-xs sm:text-sm font-semibold rounded-xl shadow-2xs transition-all">
                    <x-icon name="user-plus" weight="bold" class="text-teal-700 text-sm sm:text-base" />
                    <span>+ Balita Baru</span>
                </a>
                <a href="{{ route('balita.index') }}" 
                   class="flex items-center justify-center gap-2 px-4.5 sm:px-5 py-2.5 bg-teal-700 hover:bg-teal-800 active:scale-[0.98] text-white text-xs sm:text-sm font-semibold rounded-xl shadow-xs transition-all">
                    <x-icon name="scales" weight="bold" class="text-white text-sm sm:text-base" />
                    <span>Mulai Timbang</span>
                </a>
            </div>
        </div>

        {{-- ── 2. ALERT PERLU REVISI (Compact & Sleek Banner) ── --}}
        @if(isset($statRevisi) && $statRevisi > 0)
        <div class="bg-amber-50/90 border border-amber-200/90 rounded-2xl p-3.5 sm:p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 shadow-2xs">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-8 h-8 rounded-xl bg-amber-500 text-white flex items-center justify-center shrink-0 shadow-2xs text-base">
                    <x-icon name="warning-circle" weight="bold" />
                </div>
                <div class="flex flex-col min-w-0">
                    <div class="flex items-center gap-2">
                        <span class="text-[10.5px] font-bold uppercase tracking-wider text-amber-900 bg-amber-200/80 px-2 py-0.5 rounded-full">
                            Perlu Tindakan
                        </span>
                        <span class="text-xs sm:text-sm font-bold text-amber-950 truncate">{{ $statRevisi }} Balita Perlu Koreksi</span>
                    </div>
                    <p class="text-xs text-amber-900/90 font-medium mt-0.5 hidden sm:block">
                        Puskesmas memberikan catatan verifikasi pada data penimbangan balita.
                    </p>
                </div>
            </div>
            <a href="{{ route('balita.index', ['filter' => 'ditolak']) }}" 
               class="w-full sm:w-auto shrink-0 h-8.5 px-3.5 bg-amber-700 hover:bg-amber-800 text-white rounded-xl text-xs font-semibold shadow-2xs transition-all flex items-center justify-center gap-1 cursor-pointer">
                <span>Tinjau Catatan</span>
                <x-icon name="arrow-right" weight="bold" class="text-[10px]" />
            </a>
        </div>
        @endif

        {{-- ── 3. FOUR METRIC KPI CARDS (2x2 Grid on Mobile, 4-Col on Desktop) ── --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
            
            {{-- 1. Total Terdaftar --}}
            <div class="bg-white border border-slate-200/90 hover:border-slate-300 rounded-2xl p-4 sm:p-5 flex flex-col justify-between shadow-2xs hover:shadow-xs transition-all">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500">Total Balita</span>
                    <div class="w-8 h-8 rounded-xl bg-slate-50 text-slate-600 flex items-center justify-center border border-slate-100 text-sm">
                        <x-icon name="users" weight="bold" />
                    </div>
                </div>
                <div class="mt-3">
                    <div class="flex items-baseline gap-1">
                        <span class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight leading-none">{{ $total }}</span>
                        <span class="text-xs font-medium text-slate-400">anak</span>
                    </div>
                    <span class="text-xs text-slate-400 font-normal mt-1.5 block">Populasi aktif</span>
                </div>
            </div>

            {{-- 2. Selesai Ditimbang --}}
            <div class="bg-white border border-slate-200/90 hover:border-slate-300 rounded-2xl p-4 sm:p-5 flex flex-col justify-between shadow-2xs hover:shadow-xs transition-all">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500">Sudah Diukur</span>
                    <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center border border-emerald-100 text-sm">
                        <x-icon name="check-circle" weight="bold" />
                    </div>
                </div>
                <div class="mt-3">
                    <div class="flex items-baseline gap-2">
                        <span class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight leading-none">{{ $sudah }}</span>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200/70">
                            {{ $percent }}%
                        </span>
                    </div>
                    <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden mt-2.5">
                        <div class="bg-emerald-500 h-full rounded-full transition-all duration-500" style="width: {{ $percent }}%"></div>
                    </div>
                </div>
            </div>

            {{-- 3. Belum Hadir --}}
            <div class="bg-white border border-slate-200/90 hover:border-slate-300 rounded-2xl p-4 sm:p-5 flex flex-col justify-between shadow-2xs hover:shadow-xs transition-all">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500">Belum Diukur</span>
                    <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center border border-amber-100 text-sm">
                        <x-icon name="clock" weight="bold" />
                    </div>
                </div>
                <div class="mt-3">
                    <div class="flex items-baseline gap-1">
                        <span class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight leading-none">{{ $belum }}</span>
                        <span class="text-xs font-medium text-slate-400">anak</span>
                    </div>
                    <a href="{{ route('balita.index', ['filter' => 'belum_diukur']) }}" class="text-xs font-semibold text-teal-700 hover:text-teal-800 mt-1.5 inline-flex items-center gap-0.5">
                        <span>Buka antrean</span>
                        <x-icon name="caret-right" weight="bold" class="text-[10px]" />
                    </a>
                </div>
            </div>

            {{-- 4. Perlu Pantauan --}}
            <div class="bg-white border border-slate-200/90 hover:border-slate-300 rounded-2xl p-4 sm:p-5 flex flex-col justify-between shadow-2xs hover:shadow-xs transition-all">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-500">Perlu Pantauan</span>
                    <div class="w-8 h-8 rounded-xl bg-rose-50 text-rose-700 flex items-center justify-center border border-rose-100 text-sm">
                        <x-icon name="heartbeat" weight="bold" />
                    </div>
                </div>
                <div class="mt-3">
                    <div class="flex items-baseline gap-1">
                        <span class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight leading-none">{{ $statPerlu ?? count($priorityChildren ?? []) }}</span>
                        <span class="text-xs font-medium text-slate-400">anak</span>
                    </div>
                    <a href="{{ route('balita.index', ['filter' => 'absen_bulan_lalu']) }}" class="text-xs font-semibold text-rose-700 hover:text-rose-800 mt-1.5 inline-flex items-center gap-0.5">
                        <span>Lihat pantauan</span>
                        <x-icon name="caret-right" weight="bold" class="text-[10px]" />
                    </a>
                </div>
            </div>

        </div>

        {{-- ── 4. TWO-COLUMN OPERATIONAL WORKSPACE ── --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 sm:gap-5">
            
            {{-- Left Column (7-col): Prioritas Pemantauan Gizi --}}
            <div class="lg:col-span-7 bg-white border border-slate-200/90 rounded-2xl shadow-2xs overflow-hidden flex flex-col">
                
                {{-- Header --}}
                <div class="p-4 sm:p-5 pb-3.5 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-700 flex items-center justify-center border border-rose-100 text-base shrink-0">
                            <x-icon name="heartbeat" weight="bold" />
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h2 class="text-sm sm:text-base font-bold text-slate-900 tracking-tight">
                                    Prioritas Pemantauan Gizi
                                </h2>
                                <span class="px-2 py-0.5 rounded-full text-[11px] font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                    {{ count($priorityChildren ?? []) }} Balita
                                </span>
                            </div>
                            <p class="text-xs text-slate-500 font-medium">Balita yang memerlukan perhatian gizi berkala</p>
                        </div>
                    </div>
                    <a href="{{ route('balita.index') }}" class="text-xs font-semibold text-teal-700 hover:text-teal-800 transition-colors hidden sm:inline-flex items-center gap-1 shrink-0">
                        <span>Semua balita</span>
                        <x-icon name="arrow-right" weight="bold" class="text-[10px]" />
                    </a>
                </div>

                {{-- Child List (Distinct Card Tiles) --}}
                <div class="flex-1 p-3 sm:p-4 flex flex-col gap-2">
                    @forelse($priorityChildren ?? [] as $child)
                        @php
                            $isDanger = ($child->statusType ?? 'warning') === 'danger';
                            $isBoy = ($child->gender ?? 'L') === 'L';
                            $initials = strtoupper(substr($child->name ?? 'AN', 0, 2));
                        @endphp
                        <a href="{{ route('balita.show', $child->id) }}" 
                           class="group bg-slate-50/70 hover:bg-teal-50/30 border border-slate-200/80 hover:border-teal-300 rounded-xl p-3 sm:p-3.5 flex items-center justify-between gap-3 transition-all shadow-2xs hover:shadow-xs cursor-pointer">
                            
                            {{-- Info Balita --}}
                            <div class="flex items-center gap-3 min-w-0">
                                
                                {{-- Gender-Aware Avatar with Status Dot --}}
                                <div class="relative shrink-0">
                                    <div class="w-10 h-10 rounded-xl font-bold text-xs flex items-center justify-center shadow-2xs {{ $isBoy ? 'bg-sky-50 text-sky-800 border border-sky-200' : 'bg-pink-50 text-pink-800 border border-pink-200' }}">
                                        {{ $initials }}
                                    </div>
                                    <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 rounded-full border-2 border-white {{ $isDanger ? 'bg-rose-500' : 'bg-amber-500' }}"></span>
                                </div>

                                <div class="flex flex-col min-w-0">
                                    <div class="flex items-center gap-1.5">
                                        <span class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-teal-700 transition-colors truncate">
                                            {{ Str::title($child->name) }}
                                        </span>
                                        <span class="text-[10px] font-semibold px-1.5 py-0.2 rounded bg-white text-slate-500 border border-slate-200 uppercase hidden sm:inline-block">
                                            {{ $isBoy ? 'L' : 'P' }}
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-1 text-xs text-slate-500 font-medium truncate mt-0.5">
                                        <span class="text-slate-600 font-medium truncate">Ibu {{ $child->mother ?? '-' }}</span>
                                        <span class="text-slate-300">&bull;</span>
                                        <span class="text-slate-500 shrink-0">{{ $child->age }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Status Badge & Action Button --}}
                            <div class="flex items-center gap-2 shrink-0">
                                @if($isDanger)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                        <span>{{ $child->shortStatus ?? 'Konfirmasi TB' }}</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        <span>{{ $child->shortStatus ?? 'Pantauan Gizi' }}</span>
                                    </span>
                                @endif

                                <div class="w-7 h-7 rounded-lg bg-white border border-slate-200 group-hover:border-teal-300 group-hover:bg-teal-600 group-hover:text-white flex items-center justify-center text-slate-400 transition-all">
                                    <x-icon name="caret-right" weight="bold" class="text-xs" />
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="p-8 text-center text-slate-500">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center mx-auto mb-2 border border-emerald-100 text-xl">
                                <x-icon name="check-circle" weight="bold" />
                            </div>
                            <p class="text-xs font-bold text-slate-800">Seluruh balita terpantau baik</p>
                            <p class="text-[11px] text-slate-500 mt-0.5">Tidak ada balita yang memerlukan tindakan darurat saat ini.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Mobile Footer Link --}}
                <div class="p-3 border-t border-slate-100 bg-slate-50/50 text-center sm:hidden">
                    <a href="{{ route('balita.index') }}" class="text-xs font-bold text-teal-700 hover:text-teal-800 inline-flex items-center gap-1">
                        <span>Lihat semua data balita</span>
                        <x-icon name="arrow-right" weight="bold" class="text-xs" />
                    </a>
                </div>
            </div>

            {{-- Right Column (5-col): Agenda Posyandu & Quick Export --}}
            <div class="lg:col-span-5 flex flex-col gap-4 sm:gap-5">
                
                {{-- Agenda Posyandu Terdekat --}}
                <div class="bg-white border border-slate-200/90 rounded-2xl p-4 sm:p-5 shadow-2xs flex flex-col justify-between">
                    <div class="flex items-center justify-between pb-3.5 border-b border-slate-100">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg bg-teal-50 text-teal-700 flex items-center justify-center border border-teal-100 text-sm">
                                <x-icon name="calendar-blank" weight="bold" />
                            </div>
                            <div>
                                <h2 class="text-sm sm:text-base font-bold text-slate-900 tracking-tight">
                                    Agenda Posyandu
                                </h2>
                                <p class="text-xs text-slate-500 font-medium">Jadwal sesi penimbangan terdekat</p>
                            </div>
                        </div>
                        <a href="{{ route('jadwal.index') }}" class="text-xs font-semibold text-teal-700 hover:text-teal-800 transition-colors">
                            Semua &rarr;
                        </a>
                    </div>

                    @if(isset($jadwalTerdekat) && $jadwalTerdekat)
                        <div class="mt-3.5">
                            <a href="{{ route('jadwal.show', $jadwalTerdekat['id']) }}" 
                               class="group p-3.5 bg-slate-50/80 hover:bg-teal-50/30 border border-slate-200/80 hover:border-teal-300 rounded-xl transition-all flex items-start gap-3 cursor-pointer shadow-2xs">
                                
                                {{-- Date Stamp Ticket --}}
                                <div class="w-11 rounded-xl overflow-hidden border border-slate-200 bg-white text-center shrink-0 shadow-2xs">
                                    <div class="bg-teal-700 text-white text-[8.5px] font-bold uppercase py-0.5 tracking-wider">
                                        {{ $jadwalTerdekat['tgl_bulan'] ?? 'POS' }}
                                    </div>
                                    <div class="py-1 text-sm font-bold text-slate-900 leading-none">
                                        {{ $jadwalTerdekat['tgl_nomor'] ?? '00' }}
                                    </div>
                                </div>

                                {{-- Event Details --}}
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-teal-700 transition-colors leading-snug">
                                        {{ $jadwalTerdekat['judul'] }}
                                    </h3>
                                    <div class="mt-1.5 flex flex-col gap-0.5 text-xs text-slate-500 font-medium">
                                        <div class="flex items-center gap-1.5 truncate">
                                            <x-icon name="clock" class="text-slate-400 text-xs shrink-0" />
                                            <span class="truncate">{{ $jadwalTerdekat['waktu'] }}</span>
                                        </div>
                                        <div class="flex items-center gap-1.5 truncate">
                                            <x-icon name="map-pin" class="text-slate-400 text-xs shrink-0" />
                                            <span class="truncate">{{ $jadwalTerdekat['lokasi'] }}</span>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <span class="inline-flex items-center gap-1 text-[10.5px] font-bold uppercase tracking-wider text-teal-800 bg-teal-50 border border-teal-200 px-2 py-0.5 rounded-md">
                                            <x-icon name="hourglass" class="text-xs" />
                                            <span>{{ $jadwalTerdekat['countdown'] }}</span>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @else
                        <div class="py-6 text-center text-slate-500">
                            <p class="text-xs font-bold text-slate-700">Belum ada agenda jadwal</p>
                            <a href="{{ route('jadwal.create') }}" class="text-xs font-semibold text-teal-700 hover:underline mt-1 inline-block">+ Buat jadwal posyandu</a>
                        </div>
                    @endif
                </div>

                {{-- Quick Export Card --}}
                <div class="bg-white border border-slate-200/90 rounded-2xl p-4 sm:p-5 shadow-2xs flex items-center justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center shrink-0 border border-teal-100 text-lg">
                            <x-icon name="file-arrow-down" weight="bold" />
                        </div>
                        <div class="flex flex-col min-w-0">
                            <h3 class="text-xs sm:text-sm font-bold text-slate-900">Rekap Laporan Bulanan</h3>
                            <p class="text-xs text-slate-500 font-medium">Ekspor data antropometri Puskesmas.</p>
                        </div>
                    </div>
                    <a href="{{ route('laporan.index') }}" 
                       class="px-3.5 py-2 bg-slate-100 hover:bg-teal-600 hover:text-white text-slate-700 text-xs font-semibold rounded-xl transition-all shrink-0 flex items-center gap-1 cursor-pointer">
                        <span>Buka</span>
                        <x-icon name="arrow-right" weight="bold" class="text-[10px] hidden sm:inline" />
                    </a>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection
