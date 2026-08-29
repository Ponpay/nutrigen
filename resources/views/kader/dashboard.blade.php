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
    $roleMatch = [];
    preg_match('/\((.*?)\)/', $kaderName ?? '', $roleMatch);
    $roleText = $roleMatch[1] ?? null;
@endphp

<div class="w-full min-h-screen bg-slate-50 pb-32 sm:pb-28 lg:pb-16 text-slate-800 antialiased font-sans selection:bg-teal-100 selection:text-teal-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 flex flex-col gap-6 sm:gap-8">
        
        {{-- 1. WELCOME COMMAND HEADER --}}
        <div class="bg-white rounded-xl p-5 sm:p-6 border border-slate-200 flex flex-col md:flex-row md:items-center justify-between gap-5">
            <div>
                <div class="flex items-center gap-2 mb-2 text-sm text-slate-500 font-medium">
                    <span class="flex items-center gap-1.5 text-teal-700">
                        <div class="w-1.5 h-1.5 rounded-full bg-teal-600"></div>
                        {{ $activityLocation ?? ($posyanduName ?? 'Posyandu') }}
                    </span>
                    <span class="text-slate-300">•</span>
                    <span class="flex items-center gap-1.5">
                        <x-icon name="calendar-blank" class="text-slate-400" />
                        {{ $todayFormatted }}
                    </span>
                </div>
                
                <div class="flex flex-wrap items-center gap-3 mb-3">
                    <h1 class="text-2xl sm:text-3xl font-semibold text-slate-900 tracking-tight">
                        Selamat bertugas, <span class="text-teal-600">{{ $cleanName }}</span>
                    </h1>
                    @if($roleText)
                        <span class="px-2.5 py-1 rounded-md text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200">{{ $roleText }}</span>
                    @endif
                </div>
                
                <div class="flex items-center gap-3 flex-wrap text-sm font-medium">
                    <div class="flex items-center gap-1.5 text-slate-600">
                        <x-icon name="check-circle" weight="fill" class="text-emerald-600" />
                        Selesai: <span class="tabular-nums">{{ $sudah }}/{{ $total }}</span> ({{ $percent }}%)
                    </div>
                    @if($belum > 0)
                    <div class="flex items-center gap-1.5 text-slate-600">
                        <x-icon name="clock" weight="fill" class="text-amber-500" />
                        Antrean: <span class="tabular-nums">{{ $belum }}</span> balita
                    </div>
                    @endif
                </div>
            </div>

            <div class="flex items-center gap-3 shrink-0 mt-2 md:mt-0">
                <a href="{{ route('balita.create') }}" 
                   class="flex items-center justify-center gap-2 px-4 min-h-[48px] bg-white hover:bg-slate-50 border border-slate-300 text-slate-700 rounded-lg text-sm font-semibold transition-colors focus:ring-2 focus:ring-teal-500 focus:outline-none">
                    <x-icon name="user-plus" weight="bold" class="text-slate-500" />
                    <span>Balita Baru</span>
                </a>
                <a href="{{ route('balita.index') }}" 
                   class="flex items-center justify-center gap-2 px-4 min-h-[48px] bg-teal-600 hover:bg-teal-700 text-white rounded-lg text-sm font-semibold transition-colors focus:ring-2 focus:ring-teal-500 focus:outline-none shadow-sm">
                    <x-icon name="scales" weight="bold" />
                    <span>Mulai Timbang</span>
                </a>
            </div>
        </div>

        {{-- 2. ALERT PERLU REVISI --}}
        @if(isset($statRevisi) && $statRevisi > 0)
        <div class="bg-amber-50 rounded-xl p-4 border border-amber-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-start sm:items-center gap-3">
                <div class="mt-0.5 sm:mt-0 shrink-0 text-amber-600">
                    <x-icon name="warning-circle" weight="fill" class="text-xl" />
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-amber-900 mb-0.5">Perlu Tindakan: <span class="tabular-nums">{{ $statRevisi }}</span> Data Balita Perlu Koreksi</h3>
                    <p class="text-sm text-amber-800">Puskesmas memberikan catatan verifikasi. Silakan tinjau dan perbaiki data penimbangan.</p>
                </div>
            </div>
            <a href="{{ route('balita.index', ['filter' => 'ditolak']) }}" 
               class="inline-flex items-center justify-center gap-1.5 px-4 min-h-[48px] bg-amber-100 hover:bg-amber-200 text-amber-900 text-sm font-semibold rounded-lg transition-colors shrink-0 focus:ring-2 focus:ring-amber-500 focus:outline-none">
                <span>Tinjau Catatan</span>
                <x-icon name="arrow-right" weight="bold" />
            </a>
        </div>
        @endif

        {{-- 3. KPI METRICS --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
            {{-- Total Terdaftar --}}
            <div class="bg-white rounded-xl p-3.5 sm:p-5 border border-slate-200 flex flex-col">
                <div class="flex justify-between items-start mb-2 sm:mb-4">
                    <div class="text-[11px] sm:text-xs font-semibold uppercase text-slate-500 tracking-wider leading-tight">Total Balita</div>
                    <div class="text-slate-400 hidden sm:block"><x-icon name="users" weight="fill" class="text-lg" /></div>
                </div>
                <div class="flex items-baseline gap-1.5 mt-auto">
                    <span class="text-2xl sm:text-3xl font-semibold text-slate-900 tabular-nums leading-none">{{ $total }}</span>
                    <span class="text-xs sm:text-sm text-slate-500">anak</span>
                </div>
            </div>

            {{-- Selesai Ditimbang --}}
            <div class="bg-white rounded-xl p-3.5 sm:p-5 border border-slate-200 flex flex-col">
                <div class="flex justify-between items-start mb-2 sm:mb-4">
                    <div class="text-[11px] sm:text-xs font-semibold uppercase text-slate-500 tracking-wider leading-tight">Sudah Diukur</div>
                    <div class="text-emerald-500 hidden sm:block"><x-icon name="check-circle" weight="fill" class="text-lg" /></div>
                </div>
                <div class="mt-auto">
                    <div class="flex items-center justify-between mb-1.5 sm:mb-2">
                        <div class="flex items-baseline gap-1.5">
                            <span class="text-2xl sm:text-3xl font-semibold text-slate-900 tabular-nums leading-none">{{ $sudah }}</span>
                            <span class="text-xs sm:text-sm text-slate-400 font-medium tabular-nums">/{{ $total }}</span>
                        </div>
                        <span class="text-xs sm:text-sm font-medium text-emerald-600 tabular-nums">{{ $percent }}%</span>
                    </div>
                    <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-emerald-500 rounded-full" style="width: {{ $percent }}%"></div>
                    </div>
                </div>
            </div>

            {{-- Belum Hadir --}}
            <div class="bg-white rounded-xl p-3.5 sm:p-5 border border-slate-200 flex flex-col">
                <div class="flex justify-between items-start mb-2 sm:mb-4">
                    <div class="text-[11px] sm:text-xs font-semibold uppercase text-amber-600 tracking-wider leading-tight">Belum Diukur</div>
                    <div class="text-amber-500 hidden sm:block"><x-icon name="clock" weight="fill" class="text-lg" /></div>
                </div>
                <div class="mt-auto">
                    <div class="flex items-baseline gap-1.5 mb-1.5 sm:mb-2">
                        <span class="text-2xl sm:text-3xl font-semibold text-amber-600 tabular-nums leading-none">{{ $belum }}</span>
                        <span class="text-xs sm:text-sm text-slate-500">anak</span>
                    </div>
                    <a href="{{ route('balita.index', ['filter' => 'belum_diukur']) }}" class="text-xs sm:text-sm font-medium text-teal-600 hover:text-teal-700 flex items-center gap-1 focus:outline-none focus:underline">
                        Lihat antrean <x-icon name="arrow-right" weight="bold" />
                    </a>
                </div>
            </div>

            {{-- Perlu Pantauan --}}
            <div class="bg-white rounded-xl p-3.5 sm:p-5 border border-slate-200 flex flex-col">
                <div class="flex justify-between items-start mb-2 sm:mb-4">
                    <div class="text-[11px] sm:text-xs font-semibold uppercase text-rose-600 tracking-wider leading-tight">Perlu Pantauan</div>
                    <div class="text-rose-500 hidden sm:block"><x-icon name="heart" weight="fill" class="text-lg" /></div>
                </div>
                <div class="mt-auto">
                    <div class="flex items-baseline gap-1.5 mb-1.5 sm:mb-2">
                        <span class="text-2xl sm:text-3xl font-semibold text-rose-600 tabular-nums leading-none">{{ $statPerlu ?? count($priorityChildren ?? []) }}</span>
                        <span class="text-xs sm:text-sm text-slate-500">anak</span>
                    </div>
                    <a href="{{ route('balita.index', ['filter' => 'absen_bulan_lalu']) }}" class="text-xs sm:text-sm font-medium text-teal-600 hover:text-teal-700 flex items-center gap-1 focus:outline-none focus:underline">
                        Daftar pantau <x-icon name="arrow-right" weight="bold" />
                    </a>
                </div>
            </div>
        </div>

        {{-- 4. TWO-COLUMN OPERATIONAL WORKSPACE --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8">
            
            {{-- Left Column (7-col): Prioritas Pemantauan Gizi --}}
            <div class="lg:col-span-7 flex flex-col gap-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Prioritas Pemantauan Gizi</h2>
                        <p class="text-sm text-slate-500 mt-0.5">Balita dengan catatan gizi khusus yang memerlukan pendampingan</p>
                    </div>
                    <a href="{{ route('balita.index') }}" class="hidden sm:inline-flex text-sm font-medium text-teal-600 hover:text-teal-700 items-center gap-1 focus:outline-none focus:underline">
                        Semua balita <x-icon name="arrow-right" weight="bold" />
                    </a>
                </div>

                <div class="bg-white border border-slate-200 rounded-xl overflow-hidden flex flex-col">
                    <ul class="divide-y divide-slate-100">
                        @forelse($priorityChildren ?? [] as $child)
                            @php
                                $isDanger = ($child->statusType ?? 'warning') === 'danger';
                                $isBoy = ($child->gender ?? 'L') === 'L';
                                $initials = strtoupper(substr($child->name ?? 'AN', 0, 2));
                            @endphp
                            <li>
                                <a href="{{ route('balita.show', $child->id) }}" class="flex items-center justify-between gap-4 p-4 hover:bg-slate-50 transition-colors focus:bg-slate-50 focus:outline-none">
                                    <div class="flex items-center gap-3 min-w-0">
                                        <div class="relative shrink-0">
                                            <div class="w-10 h-10 rounded-full text-sm font-semibold flex items-center justify-center {{ $isBoy ? 'bg-sky-50 text-sky-700' : 'bg-pink-50 text-pink-700' }}">
                                                {{ $initials }}
                                            </div>
                                            <div class="absolute bottom-0 right-0 w-3 h-3 rounded-full border-2 border-white {{ $isDanger ? 'bg-rose-500' : 'bg-amber-400' }}"></div>
                                        </div>
                                        <div class="min-w-0 flex flex-col justify-center">
                                            <div class="flex items-center gap-2 mb-0.5">
                                                <h3 class="text-sm font-semibold text-slate-900 truncate">
                                                    {{ Str::title($child->name) }}
                                                </h3>
                                                <span class="px-1.5 py-0.5 bg-slate-100 text-slate-600 text-xs font-medium rounded shrink-0">
                                                    {{ $isBoy ? 'L' : 'P' }}
                                                </span>
                                            </div>
                                            <div class="text-sm text-slate-500 flex items-center gap-1.5 truncate">
                                                <span class="truncate">Ibu {{ $child->mother ?? '-' }}</span>
                                                <span class="text-slate-300">•</span>
                                                <span class="shrink-0 tabular-nums">{{ $child->age }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center gap-3 shrink-0">
                                        <div class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md bg-amber-50 text-amber-700 text-xs font-medium border border-amber-200">
                                            <div class="w-1.5 h-1.5 bg-amber-500 rounded-full"></div>
                                            {{ $child->shortStatus ?? 'Gizi' }}
                                        </div>
                                        <x-icon name="caret-right" weight="bold" class="text-slate-400 hidden sm:block" />
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li class="p-8 text-center">
                                <div class="w-10 h-10 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center mx-auto mb-3 text-xl">
                                    <x-icon name="check-circle" weight="fill" />
                                </div>
                                <p class="text-sm font-semibold text-slate-900">Seluruh balita terpantau baik</p>
                                <p class="text-sm text-slate-500 mt-1">Tidak ada balita yang memerlukan tindakan gizi khusus saat ini.</p>
                            </li>
                        @endforelse
                    </ul>
                    
                    {{-- Mobile "Semua Balita" Footer (attached to container) --}}
                    <div class="border-t border-slate-100 bg-slate-50/50 sm:hidden mt-auto">
                        <a href="{{ route('balita.index') }}" class="flex items-center justify-center gap-1.5 w-full min-h-[48px] text-sm font-semibold text-teal-600 focus:outline-none focus:bg-slate-100 active:bg-slate-100 transition-colors">
                            Semua balita <x-icon name="arrow-right" weight="bold" />
                        </a>
                    </div>
                </div>
            </div>

            {{-- Right Column (5-col): Agenda Posyandu & Quick Export --}}
            <div class="lg:col-span-5 flex flex-col gap-6">
                
                {{-- Agenda Posyandu Terdekat --}}
                <div class="flex flex-col gap-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-semibold text-slate-900">Agenda Posyandu</h2>
                            <p class="text-sm text-slate-500 mt-0.5">Jadwal sesi penimbangan terdekat</p>
                        </div>
                        <a href="{{ route('jadwal.index') }}" class="text-sm font-medium text-teal-600 hover:text-teal-700 flex items-center gap-1 focus:outline-none focus:underline">
                            Semua <x-icon name="arrow-right" weight="bold" />
                        </a>
                    </div>

                    <div class="bg-white border border-slate-200 rounded-xl p-5">
                        @if(isset($jadwalTerdekat) && $jadwalTerdekat)
                            <a href="{{ route('jadwal.show', $jadwalTerdekat['id']) }}" class="flex items-start gap-4 group focus:outline-none">
                                <div class="w-12 h-12 bg-slate-50 rounded-lg text-slate-700 flex flex-col items-center justify-center shrink-0 border border-slate-200 group-hover:border-teal-500 group-hover:bg-teal-50 group-hover:text-teal-700 transition-colors">
                                    <span class="text-[10px] font-semibold uppercase tracking-wider">{{ $jadwalTerdekat['tgl_bulan'] ?? 'AGT' }}</span>
                                    <span class="text-lg font-bold leading-none tabular-nums mt-0.5">{{ $jadwalTerdekat['tgl_nomor'] ?? '23' }}</span>
                                </div>
                                
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm font-semibold text-slate-900 leading-snug mb-1 group-hover:text-teal-700 transition-colors">
                                        {{ $jadwalTerdekat['judul'] }}
                                    </h3>
                                    <div class="text-sm text-slate-500 flex flex-col gap-1 mb-2.5">
                                        <div class="flex items-center gap-1.5 truncate">
                                            <x-icon name="clock" class="shrink-0 text-slate-400" /> 
                                            <span class="truncate">{{ $jadwalTerdekat['waktu'] }}</span>
                                        </div>
                                        <div class="flex items-center gap-1.5 truncate">
                                            <x-icon name="map-pin" class="shrink-0 text-slate-400" /> 
                                            <span class="truncate">{{ $jadwalTerdekat['lokasi'] }}</span>
                                        </div>
                                    </div>
                                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-sky-50 text-sky-700 text-xs font-semibold uppercase tracking-wider rounded border border-sky-100">
                                        <x-icon name="hourglass" weight="bold" /> {{ $jadwalTerdekat['countdown'] }}
                                    </span>
                                </div>
                            </a>
                        @else
                            <div class="py-6 text-center text-slate-500">
                                <p class="text-sm font-medium text-slate-900">Belum ada agenda jadwal</p>
                                <a href="{{ route('jadwal.create') }}" class="text-sm font-medium text-teal-600 hover:underline mt-1 inline-block focus:outline-none">+ Buat jadwal posyandu</a>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Quick Export Card --}}
                <div class="bg-white border border-slate-200 rounded-xl p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center shrink-0">
                            <x-icon name="download-simple" weight="bold" class="text-lg" />
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-slate-900 mb-0.5">Rekap Laporan Bulanan</h3>
                            <p class="text-sm text-slate-500">Ekspor data untuk Puskesmas.</p>
                        </div>
                    </div>
                    <a href="{{ route('laporan.index') }}" 
                       class="w-full sm:w-auto px-4 min-h-[48px] bg-white hover:bg-slate-50 text-slate-700 border border-slate-300 text-sm font-semibold rounded-lg transition-colors flex items-center justify-center gap-2 shrink-0 focus:ring-2 focus:ring-teal-500 focus:outline-none">
                        <span>Buka</span> <x-icon name="arrow-right" weight="bold" />
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
