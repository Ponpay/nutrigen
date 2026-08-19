@extends('layouts.app')

@section('page-title', 'Daftar Balita')

@section('content')

{{-- Script for Framer Motion --}}
<script type="module">
    document.addEventListener('DOMContentLoaded', () => {
        if(window.Motion) {
            const { animate, stagger, hover } = window.Motion;
            
            animate('.motion-card', 
                { opacity: [0, 1], y: [20, 0] }, 
                { delay: stagger(0.05), duration: 0.4, easing: "ease-out" }
            );

            document.querySelectorAll('.motion-hover').forEach(el => {
                hover(el, () => {
                    animate(el, { scale: 1.02, y: -2 }, { duration: 0.2 });
                    return () => animate(el, { scale: 1, y: 0 }, { duration: 0.2 });
                });
            });
        }
    });
</script>

@php
    $isFiltered = request()->filled('filter') || request()->filled('q') || request()->filled('status_gizi');
    $balitasCollection = collect($balitas ?? []);
    $priorityBalitas = $isFiltered ? collect([]) : $balitasCollection->filter(fn($b) => in_array($b['status_type'] ?? '', ['danger', 'warning']));
    $displayBalitas  = $isFiltered ? $balitasCollection : $balitasCollection->filter(fn($b) => !in_array($b['status_type'] ?? '', ['danger', 'warning']));
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
<div class="flex flex-col min-h-screen bg-slate-50/50 pb-32 lg:pb-12 w-full">

    {{-- ── HERO CARD (Layer 2: Elevated, Branded) ─────────────────────────── --}}
    <div class="px-4 pt-5 pb-1 lg:px-0 lg:pt-6 lg:pb-0 max-w-7xl lg:mx-auto w-full">
        <div class="bg-gradient-to-br from-teal-700 via-teal-600 to-teal-800 rounded-[32px] shadow-[0_8px_30px_rgb(13,148,136,0.12)] relative overflow-hidden motion-card opacity-0">

            {{-- Decorative glows --}}
            <div class="absolute -right-16 -top-16 w-72 h-72 bg-teal-400/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute left-0 bottom-0 w-40 h-40 bg-teal-900/40 rounded-full blur-2xl pointer-events-none"></div>
            <div class="absolute inset-0 opacity-[0.05] pointer-events-none" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 24px 24px;"></div>

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
                        <div class="flex items-center gap-2.5 bg-white/10 px-3.5 py-2 rounded-xl flex-shrink-0 border border-white/10 shadow-sm">
                            <div class="w-1.5 h-1.5 rounded-full bg-teal-300 flex-shrink-0"></div>
                            <div>
                                <p class="text-[10px] text-teal-100/80 font-medium leading-none mb-0.5">Progres</p>
                                <p class="text-[13px] text-white leading-none">
                                    <span class="font-semibold">{{ $statSelesai ?? 0 }}/{{ $totalAnak }}</span>
                                    <span class="text-teal-200/90 font-medium ml-1.5">{{ $percentage }}%</span>
                                </p>
                                {{-- Visual progress bar --}}
                                <div class="mt-2 w-full min-w-[100px] h-1.5 bg-slate-900/20 rounded-full overflow-hidden">
                                    <div class="h-full bg-white rounded-full transition-all duration-500 relative" style="width: {{ $percentage }}%">
                                        <div class="absolute inset-0 bg-white/40 blur-[2px]"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right block: Search + New --}}
                    <div class="flex items-center gap-2 w-full lg:w-auto">
                        <form action="{{ route('balita.index') }}" method="GET" class="relative flex-1 lg:w-72 group">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400 group-focus-within:text-teal-600 transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                            </div>
                            <input type="text" name="q" value="{{ request('q') }}"
                                   placeholder="Cari nama atau NIK..."
                                   class="w-full pl-10 pr-4 h-[40px] bg-white rounded-xl text-[13px] font-medium text-slate-900 placeholder:text-slate-400 border border-transparent shadow-[0_2px_8px_rgba(0,0,0,0.04)] focus:outline-none focus:border-teal-300 focus:ring-4 focus:ring-teal-500/10 transition-all">
                        </form>

                        <a href="{{ route('balita.create') }}"
                           class="motion-hover flex-shrink-0 flex items-center justify-center gap-1.5 h-[40px] bg-teal-500 hover:bg-teal-400 text-white border border-teal-400/50 px-4 rounded-xl font-bold text-[13px] shadow-[0_2px_8px_rgba(20,184,166,0.25)] transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <span class="hidden lg:inline">Baru</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- ── MAIN CONTENT AREA ───────────────────────────────────────────────── --}}
    <div class="flex-1 max-w-7xl lg:mx-auto w-full px-4 lg:px-0 mt-6 lg:mt-8">

        @if(request('q') && $priorityBalitas->isEmpty() && $displayBalitas->isEmpty())
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
        @if($priorityBalitas->isNotEmpty())
        <section class="mb-8 lg:mb-10 motion-card opacity-0">

            {{-- Section surface --}}
            <div class="bg-white border border-slate-200/80 rounded-3xl p-5 lg:p-6 shadow-xs">

                {{-- Section Header --}}
                <div class="flex items-center justify-between mb-5">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center shrink-0 border border-amber-200/60 shadow-2xs">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-slate-900 leading-snug">Prioritas Hari Ini</h2>
                            <p class="text-xs text-slate-500 font-normal mt-0.5">{{ $priorityBalitas->count() }} anak perlu dipantau hari ini</p>
                        </div>
                    </div>
                    <span class="bg-rose-50 text-rose-600 border border-rose-100 px-3 py-1 rounded-full text-[11px] font-bold tracking-wider uppercase shadow-2xs">
                        {{ $priorityBalitas->count() }} ANAK
                    </span>
                </div>

                {{-- Horizontal scroll cards --}}
                <div class="relative">
                    <div class="absolute right-0 top-0 bottom-0 w-10 bg-gradient-to-l from-white to-transparent pointer-events-none z-10 lg:hidden rounded-r-[24px]"></div>
                    <div class="flex overflow-x-auto gap-3.5 pb-2 snap-x hide-scrollbar -mx-1 px-1 items-stretch">
                        @foreach($priorityBalitas as $balita)
                            <div class="w-[290px] sm:w-[310px] shrink-0 snap-start flex">
                                <x-child-card :balita="$balita" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        @endif

        {{-- ── SECTION 2: ANTRIAN PENGUKURAN ───────────────────────────────── --}}
        <section class="motion-card opacity-0">

            <div class="bg-white border border-slate-200/80 rounded-3xl p-5 lg:p-6 shadow-xs">
                {{-- Section Header --}}
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 border border-emerald-200/60 shadow-2xs">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-slate-900 leading-snug">Antrian Pengukuran</h2>
                        <p class="text-xs text-slate-500 font-normal mt-0.5">Kelola antrian anak berdasarkan status</p>
                    </div>
                </div>

                {{-- Filter Chips with Count Badges --}}
                <div class="relative mb-6">
                    <div class="absolute right-0 top-0 bottom-0 w-8 bg-gradient-to-l from-white to-transparent pointer-events-none z-10 lg:hidden"></div>
                    <div class="flex items-center gap-2.5 overflow-x-auto hide-scrollbar -mx-0.5 px-0.5 pb-1">
                        @php
                            $filters = [
                                'belum_diukur'    => ['label' => 'Belum Diukur',     'count' => $filterCounts['belum_diukur'] ?? 0],
                                'absen_bulan_lalu'=> ['label' => 'Absen Bulan Lalu', 'count' => $filterCounts['absen_bulan_lalu'] ?? 0],
                                'bayi_6_bln'      => ['label' => 'Bayi < 6 Bln',      'count' => $filterCounts['bayi_6_bln'] ?? 0],
                                'selesai'         => ['label' => 'Sudah Selesai',    'count' => $filterCounts['selesai'] ?? 0],
                                'ditolak'         => ['label' => 'Perlu Revisi',     'count' => $filterCounts['ditolak'] ?? 0],
                            ];
                        @endphp
                        @foreach($filters as $key => $f)
                            @php
                                $isActive = request('filter') === $key || (!request('filter') && $key === 'belum_diukur');
                                $href = $isActive ? route('balita.index') : route('balita.index', ['filter' => $key]);
                            @endphp
                            <a href="{{ $href }}"
                               class="shrink-0 flex items-center gap-2 px-3.5 h-[38px] rounded-xl text-xs font-bold transition-all duration-150 {{ $isActive ? 'bg-white border-2 border-emerald-500 text-emerald-800 shadow-xs' : 'bg-white text-slate-600 border border-slate-200 hover:border-slate-300 hover:bg-slate-50' }}">
                                <span>{{ $f['label'] }}</span>
                                <span class="px-2 py-0.5 rounded-full text-[11px] font-bold {{ $isActive ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                    {{ $f['count'] }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 lg:gap-5 items-stretch">
                    @forelse($displayBalitas as $balita)
                        <div class="motion-card opacity-0 h-full flex">
                            <x-child-card :balita="$balita" />
                        </div>
                    @empty
                        @php
                            $activeFilter = request('filter');
                            $emptyTitle = match($activeFilter) {
                                'ditolak', 'revisi' => 'Tidak Ada Balita Perlu Revisi',
                                'belum_diukur' => 'Semua Balita Sudah Diukur!',
                                'absen_bulan_lalu' => 'Tidak Ada Balita Absen',
                                'bayi_6_bln' => 'Tidak Ada Bayi < 6 Bulan',
                                'selesai' => 'Belum Ada Pengukuran Selesai',
                                default => 'Tidak Ada Data Balita'
                            };
                            $emptySub = match($activeFilter) {
                                'ditolak', 'revisi' => 'Semua data pengukuran telah valid atau belum ada catatan perbaikan dari Puskesmas.',
                                'belum_diukur' => 'Seluruh balita terdaftar telah selesai diukur pada periode ini.',
                                'absen_bulan_lalu' => 'Seluruh balita hadir pada penimbangan bulan lalu.',
                                'bayi_6_bln' => 'Seluruh balita yang terdaftar saat ini berusia di atas 6 bulan.',
                                'selesai' => 'Lakukan pengukuran balita untuk mencatat data penimbangan bulan ini.',
                                default => 'Tidak ada balita yang sesuai dengan filter atau pencarian saat ini.'
                            };
                        @endphp
                        <div class="col-span-full flex flex-col items-center justify-center text-center py-14 px-6 gap-2.5 bg-white border border-slate-200/60 rounded-3xl shadow-xs">
                            <div class="w-12 h-12 rounded-2xl bg-teal-50 border border-teal-100/60 flex items-center justify-center mb-1 text-teal-600">
                                @if(in_array($activeFilter, ['ditolak', 'revisi']))
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-6 h-6 text-emerald-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-6 h-6 text-teal-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @endif
                            </div>
                            <p class="text-sm font-bold text-slate-800">{{ $emptyTitle }}</p>
                            <p class="text-xs font-medium text-slate-400 max-w-sm leading-relaxed">{{ $emptySub }}</p>
                            @if($activeFilter)
                                <a href="{{ route('balita.index') }}" class="mt-2 text-xs font-bold text-teal-600 hover:text-teal-700 bg-teal-50 hover:bg-teal-100 px-4 py-2 rounded-xl transition-colors">
                                    Tampilkan Semua Balita
                                </a>
                            @endif
                        </div>
                    @endforelse
                </div>
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
