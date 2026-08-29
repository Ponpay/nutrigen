@extends('layouts.puskesmas')
@section('page-title', 'Antrean Validasi')
@section('page-mode', 'default')
@section('content')

@php
    $filters = [
        'tab'         => request('tab', 'pending'),
        'posyandu_id' => request('posyandu_id', ''),
    ];

    $c_pending  = $stats['pending']  ?? 0;
    $c_normal   = $stats['normal']   ?? 0;
    $c_anomali  = $stats['anomali']  ?? 0;
    $c_berisiko = $stats['berisiko'] ?? 0;
@endphp

<div class="min-h-screen bg-slate-50/50 w-full pb-16">

    @if(session('approvedUrl'))
    <div class="px-4 pt-4 lg:px-6 max-w-7xl mx-auto">
        <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-4 flex flex-col sm:flex-row sm:items-center gap-3 shadow-sm">
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-emerald-800">Link Akses Ibu Berhasil Dibuat</p>
                <p class="text-[12px] text-emerald-700 break-all mt-0.5">{{ session('approvedUrl') }}</p>
            </div>
            <button type="button" onclick="navigator.clipboard.writeText('{{ session('approvedUrl') }}')"
                    class="shrink-0 px-4 py-2 rounded-lg bg-[#06667A] text-white text-[12px] font-semibold hover:bg-[#05566a] transition">
                Salin Link
            </button>
        </div>
    </div>
    @endif

    {{-- ══════════════════════════════════════════
         HERO HEADER
    ══════════════════════════════════════════ --}}
    <div class="px-4 pt-5 pb-0 lg:px-6 lg:pt-6 max-w-7xl mx-auto">
        <div class="relative overflow-hidden bg-[#06667A] rounded-2xl shadow-md">
            
            <div class="relative z-10 px-6 py-8 lg:px-10 lg:py-10">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">

                    {{-- Left: Title --}}
                    <div class="max-w-xl">
                        <p class="text-[11px] font-semibold text-white/70 uppercase tracking-widest mb-2">Tugas Ahli Gizi</p>
                        <h1 class="text-3xl lg:text-4xl font-bold text-white leading-tight tracking-tight mb-3">Antrean Validasi</h1>
                        <p class="text-white/80 text-[14px] leading-relaxed">Tinjau dan setujui data pengukuran dari kader Posyandu untuk memastikan akurasi status gizi balita.</p>
                    </div>

                    {{-- Right: KPI pills --}}
                    <div class="flex flex-wrap sm:flex-nowrap items-center gap-4 w-full lg:w-auto">
                        @php
                            $kpis = [
                                ['val' => $c_pending,  'label' => 'TOTAL',    'color' => 'text-white'],
                                ['val' => $c_berisiko, 'label' => 'STUNTING', 'color' => 'text-rose-500'],
                                ['val' => $c_anomali,  'label' => 'RISIKO',   'color' => 'text-amber-500'],
                                ['val' => $c_normal,   'label' => 'NORMAL',   'color' => 'text-emerald-400'],
                            ];
                        @endphp
                        @foreach($kpis as $kpi)
                            <div class="flex flex-col items-center justify-center w-[85px] h-[95px] rounded-xl border border-white/20 bg-transparent">
                                <span class="text-3xl font-bold {{ $kpi['color'] }} leading-none mb-1.5">{{ $kpi['val'] }}</span>
                                <span class="text-[9px] font-medium text-white/70 uppercase tracking-widest">{{ $kpi['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════
         FILTER & TAB BAR
    ══════════════════════════════════════════ --}}
    <div class="px-4 lg:px-6 max-w-7xl mx-auto mt-6 relative z-30">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 bg-white px-4 py-3 rounded-[20px] shadow-sm border border-slate-200/50">
            
            {{-- Tabs (Segmented Control Style) --}}
            <div class="flex overflow-x-auto hide-scrollbar gap-1 w-full lg:w-auto p-1.5 bg-slate-50/80 rounded-full border border-slate-100">
                @php
                    $tabs = [
                        ['id' => 'pending',  'label' => 'Semua', 'count' => $c_pending],
                        ['id' => 'berisiko', 'label' => 'Indikasi Stunting', 'count' => $c_berisiko],
                        ['id' => 'anomali',  'label' => 'Risiko', 'count' => $c_anomali],
                        ['id' => 'normal',   'label' => 'Normal', 'count' => $c_normal],
                    ];
                @endphp
                @foreach ($tabs as $t)
                    <a href="?tab={{ $t['id'] }}&posyandu_id={{ urlencode($filters['posyandu_id']) }}"
                        class="px-4 py-2 rounded-full text-[13px] font-bold flex items-center gap-2 whitespace-nowrap transition-all duration-300 relative
                        {{ $filters['tab'] === $t['id']
                            ? 'bg-[#06667A] text-white shadow-md shadow-[#06667A]/20 scale-100'
                            : 'text-slate-500 hover:text-slate-800 hover:bg-white scale-95 hover:scale-100' }}">
                        {{ $t['label'] }}
                        <span class="text-[10px] px-2 py-0.5 rounded-full transition-colors {{ $filters['tab'] === $t['id'] ? 'bg-white/20 text-white' : 'bg-slate-200/70 text-slate-500' }}">
                            {{ $t['count'] }}
                        </span>
                    </a>
                @endforeach
            </div>

            {{-- Filter Posyandu (Alpine Custom Dropdown) --}}
            <div class="w-full lg:w-72">
                <form action="{{ route('puskesmas.validasi') }}" method="GET" id="posyanduFilterForm">
                    <input type="hidden" name="tab" value="{{ $filters['tab'] }}">
                    <input type="hidden" name="posyandu_id" id="hiddenPosyanduId" value="{{ $filters['posyandu_id'] }}">
                    
                    <div x-data="{ 
                            open: false,
                            selectPosyandu(nama) {
                                document.getElementById('hiddenPosyanduId').value = nama;
                                document.getElementById('posyanduFilterForm').submit();
                            }
                        }" 
                        class="relative w-full" 
                        @click.outside="open = false">
                        
                        <button type="button" @click="open = !open" 
                            class="flex items-center justify-between w-full pl-4 pr-3 py-2.5 bg-white border border-slate-200 hover:border-[#06667A]/50 rounded-xl text-[13px] font-bold text-slate-700 transition-all duration-200 outline-none shadow-sm"
                            :class="{'ring-2 ring-[#06667A]/20 border-[#06667A]': open}">
                            <span class="truncate">
                                {{ $filters['posyandu_id'] ? $filters['posyandu_id'] : 'Semua Posyandu' }}
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" 
                                class="w-4 h-4 text-slate-400 shrink-0 transition-transform duration-300"
                                :class="{'rotate-180 text-[#06667A]': open}">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>

                        <div x-show="open" 
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            style="display: none;"
                            class="absolute right-0 top-full mt-2 w-full lg:w-80 bg-white border border-slate-100 rounded-2xl shadow-xl shadow-slate-200/50 overflow-hidden z-50 py-2 max-h-[60vh] overflow-y-auto">
                            
                            <button type="button" @click="selectPosyandu('')" 
                                class="w-full text-left px-4 py-2.5 text-[13px] hover:bg-slate-50 transition-colors {{ empty($filters['posyandu_id']) ? 'font-bold text-[#06667A] bg-slate-50/50' : 'font-medium text-slate-600' }}">
                                Semua Posyandu
                            </button>
                            
                            @foreach ($posyandus as $p)
                                <button type="button" @click="selectPosyandu('{{ $p['nama'] }}')" 
                                    class="w-full text-left px-4 py-2.5 text-[13px] hover:bg-slate-50 transition-colors {{ $filters['posyandu_id'] === $p['nama'] ? 'font-bold text-[#06667A] bg-slate-50/50' : 'font-medium text-slate-600' }}">
                                    {{ $p['nama'] }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════
         GRID KARTU ANTREAN
    ══════════════════════════════════════════ --}}
    <div class="px-4 lg:px-6 max-w-7xl mx-auto mt-6">
        @if(count($children) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($children as $child)
                    @php
                        // Determine colors based on status
                        $statusColor = 'emerald';
                        if ($child['statusType'] === 'warning') $statusColor = 'amber';
                        if ($child['statusType'] === 'danger') $statusColor = 'rose';
                    @endphp
                    
                    <div class="bg-white rounded-[24px] border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col relative overflow-hidden h-full">
                        
                        {{-- Top color strip --}}
                        <div class="h-1.5 w-full bg-{{ $statusColor }}-500"></div>

                        <div class="p-6 flex-1 flex flex-col">
                            
                            {{-- Top Row: Badge & Date --}}
                            <div class="flex justify-between items-start mb-6">
                                <div class="px-2.5 py-1 rounded-full bg-{{ $statusColor }}-50 border border-{{ $statusColor }}-100 flex items-center gap-1.5">
                                    <div class="w-1.5 h-1.5 rounded-full bg-{{ $statusColor }}-500"></div>
                                    <span class="text-[9px] font-bold text-{{ $statusColor }}-600 uppercase tracking-widest">{{ $child['statusLabel'] }}</span>
                                </div>
                                <div class="text-right leading-tight">
                                    <span class="block text-[10px] font-bold text-slate-800">{{ $child['date'] }}</span>
                                    <span class="block text-[10px] text-slate-400">{{ $child['time'] }}</span>
                                </div>
                            </div>

                            {{-- Avatar & Name --}}
                            <div class="flex gap-4 mb-6 items-center">
                                <div class="relative shrink-0">
                                    <div class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center text-slate-600 font-bold text-[18px]">
                                        {{ substr($child['name'], 0, 1) }}
                                    </div>
                                    <div class="absolute bottom-0 right-0 w-3 h-3 rounded-full bg-{{ $statusColor }}-500 border-2 border-white"></div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-[15px] font-bold text-slate-900 truncate" title="{{ $child['name'] }}">{{ $child['name'] }}</h3>
                                    <p class="text-[11px] text-slate-500 mt-1 truncate">
                                        {{ $child['age'] }} &bull; {{ $child['gender'] === 'Laki-laki' ? 'L' : 'P' }} &bull; {{ $child['posyandu'] }}
                                    </p>
                                </div>
                            </div>

                            {{-- Measurement Data Box --}}
                            <div class="rounded-[20px] p-4 border border-slate-100 mb-6 flex-1 flex items-center">
                                <div class="w-1/2 border-r border-slate-100 pr-4">
                                    <span class="text-[9px] font-semibold text-slate-400 uppercase tracking-widest block mb-1">Berat</span>
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-[20px] font-bold text-slate-900">{{ $child['bb'] }}</span>
                                        <span class="text-[12px] font-semibold text-slate-500">kg</span>
                                    </div>
                                </div>
                                <div class="w-1/2 pl-4">
                                    <span class="text-[9px] font-semibold text-slate-400 uppercase tracking-widest block mb-1">Tinggi</span>
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-[20px] font-bold text-slate-900">{{ $child['tb'] }}</span>
                                        <span class="text-[12px] font-semibold text-slate-500">cm</span>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- Footer Info --}}
                            <div class="flex items-center gap-3 mb-5">
                                <div class="w-8 h-8 rounded-full bg-[#06667A] text-white flex items-center justify-center text-[12px] font-bold shrink-0">
                                    {{ substr($child['kader'], 0, 1) }}
                                </div>
                                <div class="flex-1 min-w-0 leading-tight">
                                    <span class="block text-[9px] font-semibold text-slate-400 uppercase tracking-widest mb-0.5">Diukur Oleh</span>
                                    <span class="block text-[13px] font-bold text-slate-900 truncate">{{ $child['kader'] }}</span>
                                </div>
                            </div>
                            
                            {{-- Action Button --}}
                            <a href="{{ route('puskesmas.validasi.review', $child['id']) }}" class="w-full flex items-center justify-center gap-2 py-3 rounded-[12px] bg-[#06667A] text-white font-bold text-[13px] hover:bg-[#055364] transition-colors">
                                Tinjau & Validasi
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                            </a>
                            
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Empty State --}}
            <div class="flex flex-col items-center justify-center bg-white rounded-[24px] border border-slate-200 border-dashed py-20 px-6 text-center shadow-sm">
                <div class="w-20 h-20 rounded-3xl bg-emerald-50 text-emerald-500 flex items-center justify-center mb-5 shadow-sm border border-emerald-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-9 h-9"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <h3 class="text-xl font-black text-slate-800 mb-2">Antrean Bersih!</h3>
                <p class="text-[14px] text-slate-500 max-w-sm leading-relaxed">
                    {{ $filters['tab'] === 'pending' ? 'Anda telah menyelesaikan seluruh antrean validasi hari ini.' : 'Tidak ada data balita dengan status gizi ini di antrean.' }}
                </p>
                <a href="{{ route('puskesmas.laporan') }}" class="mt-6 inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-[#06667A] text-white text-[13px] font-bold shadow-md hover:bg-[#055364] transition-colors">
                    Lihat Laporan Bulan Ini
                </a>
            </div>
        @endif
    </div>

</div>

@endsection
