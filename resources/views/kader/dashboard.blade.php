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

<div class="w-full min-h-screen bg-slate-50/70 pb-20 text-slate-800 antialiased">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 flex flex-col gap-6">
        
        {{-- ── 1. CALM APP HEADER & ACTIONS ── --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-2 border-b border-slate-200/80">
            <div>
                <div class="flex items-center gap-2 text-xs text-slate-500 font-normal">
                    <span class="font-medium text-teal-700 flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-teal-600"></span>
                        {{ $activityLocation ?? ($posyanduName ?? 'Posyandu') }}
                    </span>
                    <span>&bull;</span>
                    <span>{{ $todayFormatted }}</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-semibold text-slate-900 tracking-tight mt-1">
                    Selamat bertugas, {{ $kaderName ?? 'Ibu Kader' }}
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 font-normal mt-0.5">
                    Ringkasan penimbangan balita dan pemantauan gizi periode berjalan.
                </p>
            </div>

            {{-- Primary Action Group --}}
            <div class="flex items-center gap-2.5 self-start md:self-auto shrink-0">
                <a href="{{ route('balita.create') }}" 
                   class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-white hover:bg-slate-50 border border-slate-300 text-slate-700 rounded-lg text-xs font-medium shadow-2xs transition-colors">
                    <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Daftar Balita</span>
                </a>
                <a href="{{ route('balita.index') }}" 
                   class="inline-flex items-center gap-1.5 px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white rounded-lg text-xs font-medium shadow-xs transition-colors">
                    <svg class="w-4 h-4 text-teal-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0l2.469 10.106c.122.499.106 1.028.589 1.202a5.989 5.989 0 002.031.352 5.989 5.989 0 002.031-.352c.483-.174.711-.703.59-1.202L5.25 4.971z" />
                    </svg>
                    <span>Mulai Penimbangan</span>
                </a>
            </div>
        </div>

        {{-- ── 2. ALERT PERLU REVISI (Restrained Semantic Alert) ── --}}
        @if(isset($statRevisi) && $statRevisi > 0)
        <div class="bg-amber-50/80 border border-amber-200/90 rounded-xl p-3.5 sm:p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-slate-800">
            <div class="flex items-start sm:items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-800 flex items-center justify-center shrink-0 mt-0.5 sm:mt-0">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
                <div class="text-xs">
                    <span class="font-semibold text-slate-900">{{ $statRevisi }} data balita perlu perbaikan:</span>
                    <span class="text-slate-600 ml-1">Puskesmas memberikan catatan verifikasi pada data penimbangan.</span>
                </div>
            </div>
            <a href="{{ route('balita.index', ['filter' => 'ditolak']) }}" 
               class="text-xs font-semibold text-amber-900 hover:text-amber-700 underline shrink-0 self-end sm:self-auto">
                Tinjau catatan revisi &rarr;
            </a>
        </div>
        @endif

        {{-- ── 3. KEY METRICS KPI GRID (Refined, Clean & Balanced) ── --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-4">
            
            {{-- 1. Total Terdaftar --}}
            <div class="bg-white border border-slate-200/80 rounded-xl p-4 sm:p-5 flex flex-col justify-between shadow-2xs">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-medium text-slate-500">Total Terdaftar</span>
                    <span class="w-2 h-2 rounded-full bg-slate-300"></span>
                </div>
                <div class="mt-3">
                    <span class="text-2xl sm:text-3xl font-semibold text-slate-900 tracking-tight">{{ $total }}</span>
                    <span class="text-xs text-slate-500 font-normal ml-1">balita</span>
                </div>
                <span class="text-[11px] text-slate-400 font-normal mt-1.5">Populasi binaan Posyandu</span>
            </div>

            {{-- 2. Selesai Ditimbang --}}
            <div class="bg-white border border-slate-200/80 rounded-xl p-4 sm:p-5 flex flex-col justify-between shadow-2xs">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-medium text-slate-500">Sudah Diukur</span>
                    <span class="w-2 h-2 rounded-full bg-teal-500"></span>
                </div>
                <div class="mt-3">
                    <span class="text-2xl sm:text-3xl font-semibold text-teal-700 tracking-tight">{{ $sudah }}</span>
                    <span class="text-xs text-teal-700 font-medium ml-1">({{ $percent }}%)</span>
                </div>
                <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden mt-2">
                    <div class="bg-teal-600 h-full rounded-full" style="width: {{ $percent }}%"></div>
                </div>
            </div>

            {{-- 3. Belum Hadir --}}
            <div class="bg-white border border-slate-200/80 rounded-xl p-4 sm:p-5 flex flex-col justify-between shadow-2xs">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-medium text-slate-500">Belum Diukur</span>
                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                </div>
                <div class="mt-3">
                    <span class="text-2xl sm:text-3xl font-semibold text-slate-900 tracking-tight">{{ $belum }}</span>
                    <span class="text-xs text-slate-500 font-normal ml-1">balita</span>
                </div>
                <a href="{{ route('balita.index', ['filter' => 'belum_diukur']) }}" class="text-[11px] font-medium text-teal-700 hover:text-teal-800 mt-1.5 inline-block">
                    Buka antrean hadir &rarr;
                </a>
            </div>

            {{-- 4. Prioritas Pengawasan --}}
            <div class="bg-white border border-slate-200/80 rounded-xl p-4 sm:p-5 flex flex-col justify-between shadow-2xs">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-medium text-slate-500">Perlu Pantauan</span>
                    <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                </div>
                <div class="mt-3">
                    <span class="text-2xl sm:text-3xl font-semibold text-slate-900 tracking-tight">{{ $statPerlu ?? count($priorityChildren ?? []) }}</span>
                    <span class="text-xs text-slate-500 font-normal ml-1">balita</span>
                </div>
                <a href="{{ route('balita.index', ['filter' => 'absen_bulan_lalu']) }}" class="text-[11px] font-medium text-teal-700 hover:text-teal-800 mt-1.5 inline-block">
                    Lihat daftar pantauan &rarr;
                </a>
            </div>

        </div>

        {{-- ── 4. TWO-COLUMN OPERATIONAL WORKSPACE ── --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            
            {{-- Left Column (7-col): Prioritas Pemantauan Gizi --}}
            <div class="lg:col-span-7 bg-white border border-slate-200/80 rounded-xl shadow-2xs overflow-hidden flex flex-col">
                
                {{-- Header --}}
                <div class="p-4 sm:p-5 pb-3 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-semibold text-slate-900 tracking-tight">
                            Prioritas Pemantauan Gizi
                        </h2>
                        <p class="text-xs text-slate-500 font-normal mt-0.5">
                            Balita yang memerlukan perhatian khusus dan konfirmasi berkala.
                        </p>
                    </div>
                    <a href="{{ route('balita.index') }}" class="text-xs font-medium text-teal-700 hover:text-teal-800">
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
                           class="group px-4 sm:px-5 py-3.5 flex items-center justify-between gap-3 hover:bg-slate-50/80 transition-colors cursor-pointer">
                            
                            {{-- Info Balita --}}
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-700 font-semibold text-xs flex items-center justify-center shrink-0">
                                    {{ $initials }}
                                </div>
                                <div class="flex flex-col min-w-0">
                                    <span class="text-xs font-semibold text-slate-900 group-hover:text-teal-700 transition-colors truncate">
                                        {{ Str::title($child->name) }}
                                    </span>
                                    <span class="text-[11px] text-slate-500 font-normal truncate mt-0.5">
                                        Ibu {{ $child->mother ?? '-' }} &bull; {{ $child->age }}
                                    </span>
                                </div>
                            </div>

                            {{-- Status Badge & Arrow --}}
                            <div class="flex items-center gap-2.5 shrink-0">
                                @if($isDanger)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-medium bg-rose-50 text-rose-700 border border-rose-200/60">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                        <span>{{ $child->shortStatus ?? 'Konfirmasi TB' }}</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-medium bg-amber-50 text-amber-800 border border-amber-200/60">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        <span>{{ $child->shortStatus ?? 'Pantauan Gizi' }}</span>
                                    </span>
                                @endif

                                <svg class="w-4 h-4 text-slate-400 group-hover:text-slate-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </div>
                        </a>
                    @empty
                        <div class="p-8 text-center text-slate-400">
                            <svg class="w-6 h-6 text-slate-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-xs font-medium text-slate-600">Seluruh status balita terpantau baik</p>
                            <p class="text-[11px] text-slate-400 mt-0.5">Tidak ada balita yang memerlukan tindakan darurat.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Right Column (5-col): Agenda Posyandu & Quick Links --}}
            <div class="lg:col-span-5 flex flex-col gap-4">
                
                {{-- Agenda Terdekat --}}
                <div class="bg-white border border-slate-200/80 rounded-xl p-4 sm:p-5 shadow-2xs flex flex-col justify-between">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <h2 class="text-sm font-semibold text-slate-900 tracking-tight">
                            Agenda Posyandu
                        </h2>
                        <a href="{{ route('jadwal.index') }}" class="text-xs font-medium text-teal-700 hover:text-teal-800">
                            Semua jadwal &rarr;
                        </a>
                    </div>

                    @if(isset($jadwalTerdekat) && $jadwalTerdekat)
                        <div class="mt-4 flex flex-col gap-3">
                            <a href="{{ route('jadwal.show', $jadwalTerdekat['id']) }}" 
                               class="p-3.5 bg-slate-50 hover:bg-slate-100/80 border border-slate-200/80 rounded-lg transition-colors flex items-start gap-3.5">
                                
                                {{-- Date Stamp --}}
                                <div class="w-10 rounded border border-slate-200 bg-white text-center shrink-0 overflow-hidden shadow-2xs">
                                    <div class="bg-slate-700 text-white text-[8px] font-bold uppercase py-0.5">
                                        {{ $jadwalTerdekat['tgl_bulan'] ?? 'POS' }}
                                    </div>
                                    <div class="py-1 text-sm font-semibold text-slate-900 leading-none">
                                        {{ $jadwalTerdekat['tgl_nomor'] ?? '00' }}
                                    </div>
                                </div>

                                {{-- Event Details --}}
                                <div class="flex-1 min-w-0 text-xs">
                                    <h3 class="font-semibold text-slate-900 truncate">
                                        {{ $jadwalTerdekat['judul'] }}
                                    </h3>
                                    <p class="text-slate-500 font-normal mt-0.5">
                                        {{ $jadwalTerdekat['waktu'] }} &bull; {{ $jadwalTerdekat['lokasi'] }}
                                    </p>
                                    <span class="inline-block mt-2 text-[10px] font-medium text-teal-800 bg-teal-50 border border-teal-200/70 px-2 py-0.5 rounded">
                                        {{ $jadwalTerdekat['countdown'] }}
                                    </span>
                                </div>
                            </a>
                        </div>
                    @else
                        <div class="py-6 text-center text-slate-400">
                            <p class="text-xs font-medium text-slate-600">Belum ada agenda jadwal</p>
                            <a href="{{ route('jadwal.create') }}" class="text-[11px] font-medium text-teal-700 hover:underline mt-1 inline-block">+ Tambah jadwal kegiatan</a>
                        </div>
                    @endif
                </div>

                {{-- Quick Export Card --}}
                <div class="bg-white border border-slate-200/80 rounded-xl p-4 sm:p-5 shadow-2xs flex items-center justify-between">
                    <div>
                        <h3 class="text-xs font-semibold text-slate-900">Rekap Laporan Bulanan</h3>
                        <p class="text-[11px] text-slate-500 font-normal mt-0.5">Ekspor data antropometri untuk laporan dinas/Puskesmas.</p>
                    </div>
                    <a href="{{ route('laporan.index') }}" 
                       class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-medium rounded-lg transition-colors shrink-0">
                        Buka Laporan
                    </a>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection
