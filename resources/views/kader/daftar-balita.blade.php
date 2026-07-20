@extends('layouts.app')

@section('page-title', 'Daftar Balita')

@section('content')

@php
    // View-layer separation — ideally this filtering lives in the controller/scope
    $priorityBalitas = $balitas->filter(fn($b) => in_array($b['status_type'], ['danger', 'warning']));
    $queueBalitas    = $balitas->filter(fn($b) => !in_array($b['status_type'], ['danger', 'warning']));
@endphp

{{--
    SURFACE HIERARCHY:
    Canvas (#F4F7FA)
      └── Hero Card (emerald gradient, floating, rounded)
      └── Priority Section (amber-tinted panel, emerald accent)
      └── Queue Section (clean canvas, neutral)
            └── Child Card (white + left accent strip)
--}}

{{-- ═══════════════════════════════════════
    CANVAS
══════════════════════════════════════ --}}
<div class="flex flex-col min-h-screen bg-[#F4F7FA] pb-32 lg:pb-12 w-full">

    {{-- ── HERO CARD (Layer 2: Elevated, Branded) ─────────────────────────── --}}
    <div class="px-4 pt-5 pb-1 lg:px-0 lg:pt-6 lg:pb-0 max-w-7xl lg:mx-auto w-full">
        <div class="bg-gradient-to-br from-emerald-700 via-emerald-600 to-teal-600 rounded-2xl shadow-[0_6px_24px_rgba(16,185,129,0.12),0_2px_8px_rgba(0,0,0,0.08)] relative overflow-hidden">

            {{-- Decorative glows --}}
            <div class="absolute -right-16 -top-16 w-72 h-72 bg-teal-400 opacity-10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute left-0 bottom-0 w-40 h-40 bg-emerald-900 opacity-20 rounded-full blur-2xl pointer-events-none"></div>

            <div class="relative z-10 px-5 py-5 lg:px-8 lg:py-7">

                {{-- Row 1: Date + Session Name + Progress (desktop inline, mobile stacked) --}}
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 lg:gap-6">

                    {{-- Left block --}}
                    <div class="flex items-center gap-4 lg:gap-6 min-w-0">
                        {{-- Session info --}}
                        <div class="min-w-0">
                            <p class="text-[10px] font-medium text-emerald-200/70 uppercase tracking-[0.15em] mb-1 flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3 flex-shrink-0">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                                {{ now()->translatedFormat('d M Y') }}
                            </p>
                            <h1 class="text-[18px] lg:text-[21px] font-semibold text-white leading-tight tracking-tight truncate">Sesi: {{ $posyanduName ?? 'Posyandu' }}</h1>
                        </div>

                        {{-- Vertical divider (desktop only) --}}
                        <div class="hidden lg:block w-px h-9 bg-white/15 flex-shrink-0"></div>

                        {{-- Progress pill --}}
                        @php
                            $totalAnak   = ($statSelesai ?? 0) + ($statBelum ?? 0);
                            $percentage  = $totalAnak > 0 ? round(($statSelesai / $totalAnak) * 100) : 0;
                        @endphp
                        <div class="flex items-center gap-2.5 bg-white/10 px-3.5 py-2 rounded-xl flex-shrink-0">
                            <div class="w-1.5 h-1.5 rounded-full bg-emerald-300 flex-shrink-0"></div>
                            <div>
                                <p class="text-[10px] text-emerald-100/70 font-medium leading-none mb-0.5">Progres</p>
                                <p class="text-[13px] text-white leading-none">
                                    <span class="font-semibold">{{ $statSelesai ?? 0 }}/{{ $totalAnak }}</span>
                                    <span class="text-emerald-200/90 font-medium ml-1.5">{{ $percentage }}%</span>
                                </p>
                                {{-- Visual progress bar --}}
                                <div class="mt-1.5 w-24 h-1 bg-white/20 rounded-full overflow-hidden">
                                    <div class="h-full bg-emerald-300 rounded-full transition-all duration-500" style="width: {{ $percentage }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right block: Search + New --}}
                    <div class="flex items-center gap-2 w-full lg:w-auto">
                        <form action="{{ route('balita.index') }}" method="GET" class="relative flex-1 lg:w-72 group">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400 group-focus-within:text-emerald-500 transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                            </div>
                            <input type="text" name="q" value="{{ request('q') }}"
                                   placeholder="Cari nama atau NIK..."
                                   class="w-full pl-10 pr-4 h-[40px] bg-white rounded-xl text-[13px] font-medium text-slate-900 placeholder:text-slate-400 border-none shadow-[0_2px_8px_rgba(0,0,0,0.06)] focus:outline-none focus:ring-2 focus:ring-emerald-400/40 transition-all">
                        </form>

                        <a href="{{ route('balita.create') }}"
                           class="flex-shrink-0 flex items-center justify-center gap-1.5 h-[40px] bg-white/15 hover:bg-white/25 border border-white/20 text-white px-4 rounded-xl font-medium text-[13px] transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <span class="hidden sm:block">Baru</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- ── MAIN CONTENT AREA ───────────────────────────────────────────────── --}}
    <div class="flex-1 max-w-7xl lg:mx-auto w-full px-4 lg:px-0 mt-6 lg:mt-8">

        @if(request('q') && count($priorityBalitas) === 0 && count($queueBalitas) === 0)
        {{-- ── EMPTY STATE ──────────────────────────────────────────────────── --}}
        <div class="flex flex-col items-center justify-center text-center py-16 px-6 gap-3 bg-white border border-slate-200/60 rounded-2xl shadow-[0_1px_4px_rgba(0,0,0,0.04)]">
            <div class="w-12 h-12 rounded-full bg-slate-50 border border-slate-100 flex items-center justify-center mb-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-slate-300">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </div>
            <h3 class="text-[15px] font-semibold text-slate-800">Tidak ditemukan</h3>
            <p class="text-[13px] text-slate-400 max-w-xs">Tidak ada balita dengan nama atau NIK "<span class="text-slate-600 font-medium">{{ request('q') }}</span>".</p>
            <a href="{{ route('balita.index') }}" class="text-[13px] font-medium text-emerald-600 hover:text-emerald-700 transition-colors">Tampilkan semua</a>
        </div>

        @else

        {{-- ── SECTION 1: PRIORITAS ─────────────────────────────────────────── --}}
        @if(count($priorityBalitas) > 0)
        <section class="mb-8 lg:mb-10">

            {{-- Section surface: subtle warm tint to distinguish from queue --}}
            <div class="bg-amber-50/50 border border-amber-100/60 rounded-2xl px-4 pt-4 pb-5 lg:px-6 lg:pt-5 lg:pb-6">

                {{-- Section Header --}}
                <div class="flex items-center gap-2.5 mb-4">
                    {{-- Emerald left accent bar on heading --}}
                    <div class="w-1 h-5 rounded-full bg-rose-400 flex-shrink-0"></div>
                    <h2 class="text-[14px] font-semibold text-slate-800 leading-none">Prioritas Hari Ini</h2>
                    <span class="ml-1 bg-rose-100 text-rose-700 px-2.5 py-0.5 rounded-full text-[11px] font-semibold">{{ count($priorityBalitas) }} anak</span>
                </div>

                {{-- Horizontal scroll cards --}}
                <div class="flex overflow-x-auto gap-3 pb-1 snap-x hide-scrollbar -mx-1 px-1">
                    @foreach($priorityBalitas as $balita)
                        <div class="w-[272px] lg:w-[288px] shrink-0 snap-start">
                            <x-child-card :balita="$balita" />
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- ── SECTION 2: ANTRIAN PENGUKURAN ───────────────────────────────── --}}
        <section>

            {{-- Section Header --}}
            <div class="flex items-center gap-2.5 mb-4 px-0.5">
                <div class="w-1 h-5 rounded-full bg-slate-300 flex-shrink-0"></div>
                <h2 class="text-[14px] font-semibold text-slate-700 leading-none">Antrian Pengukuran</h2>
            </div>

            {{-- Filter Chips --}}
            <div class="flex items-center gap-2 overflow-x-auto pb-4 hide-scrollbar -mx-0.5 px-0.5">
                @php
                    $filters = [
                        'belum_diukur'    => 'Belum Diukur',
                        'absen_bulan_lalu'=> 'Absen Bulan Lalu',
                        'bayi_6_bln'      => 'Bayi < 6 Bln',
                        'selesai'         => 'Sudah Selesai',
                        'ditolak'         => 'Perlu Revisi',
                    ];
                @endphp
                @foreach($filters as $key => $label)
                    @php
                        $isActive = request('filter') === $key;
                        $href = $isActive
                            ? route('balita.index')
                            : route('balita.index', ['filter' => $key]);
                    @endphp
                    <a href="{{ $href }}"
                       class="shrink-0 flex items-center justify-center px-4 h-9 rounded-xl text-[12.5px] font-medium transition-all duration-200 {{ $isActive ? 'bg-slate-800 text-white shadow-sm' : 'bg-white text-slate-500 border border-slate-200/60 hover:border-slate-300 hover:text-slate-700' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            {{-- Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 lg:gap-4">
                @forelse($queueBalitas as $balita)
                    <x-child-card :balita="$balita" />
                @empty
                    <div class="col-span-full flex flex-col items-center justify-center text-center py-16 px-6 gap-3 bg-white border border-slate-200/60 rounded-2xl shadow-[0_1px_4px_rgba(0,0,0,0.04)]">
                        <div class="w-12 h-12 rounded-full bg-emerald-50 border border-emerald-100/60 flex items-center justify-center mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-emerald-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-[15px] font-semibold text-slate-700">Semua Balita Sudah Diukur!</p>
                        <p class="text-[13px] text-slate-400">Tidak ada lagi antrian hari ini.</p>
                    </div>
                @endforelse
            </div>
        </section>

        @endif
    </div>
</div>

<style>
.hide-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}
</style>

@endsection
