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

<div class="w-full min-h-screen bg-[#F4F7FB] pb-24 lg:pb-16 text-slate-800 antialiased font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col gap-6">
        
        {{-- ── 1. WELCOME COMMAND HEADER ── --}}
        <div class="bg-white rounded-3xl p-6 shadow-sm hover:shadow-md border border-slate-100 transition-shadow duration-300 flex flex-col md:flex-row md:items-center justify-between gap-6">
            
            {{-- Left: Sapaan & Live Status --}}
            <div>
                <div class="flex items-center gap-2 mb-3 text-[13.5px] sm:text-[15px] text-slate-500 font-medium">
                    <span class="flex items-center gap-1.5 text-teal-700 font-bold">
                        <div class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-teal-600 shadow-[0_0_8px_rgba(6,182,212,0.6)]"></div>
                        {{ $activityLocation ?? ($posyanduName ?? 'Posyandu') }}
                    </span>
                    <span class="text-slate-300">•</span>
                    <span class="flex items-center gap-1.5">
                        <x-icon name="calendar-blank" class="text-slate-400" />
                        {{ $todayFormatted }}
                    </span>
                </div>
                
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight leading-none">
                        Selamat bertugas, <span class="text-teal-600">{{ $cleanName }}</span>
                    </h1>
                    @if($roleText)
                        <span class="px-2.5 py-1 rounded-md text-[12.5px] sm:text-[13.5px] font-bold bg-slate-100 text-slate-600 border border-slate-200/60">{{ $roleText }}</span>
                    @endif
                </div>
                
                <div class="flex items-center gap-3 flex-wrap">
                    <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-teal-50/50 text-teal-700 text-[12.5px] sm:text-[13.5px] font-bold border border-teal-100">
                        <x-icon name="check-circle" weight="bold" />
                        Selesai: {{ $sudah }}/{{ $total }} ({{ $percent }}%)
                    </div>
                    @if($belum > 0)
                    <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-orange-50/50 text-[#D96B2B] text-[12.5px] sm:text-[13.5px] font-bold border border-orange-100">
                        <x-icon name="clock" weight="bold" />
                        Antrean: {{ $belum }} balita
                    </div>
                    @endif
                </div>
            </div>

            {{-- Right: Actions --}}
            <div class="flex items-center gap-3 shrink-0 mt-2 md:mt-0">
                <a href="{{ route('balita.create') }}" 
                   class="flex items-center justify-center gap-2 px-4 sm:px-5 py-2.5 bg-[#F8FAFC] hover:bg-slate-100 border border-slate-200 text-slate-700 rounded-xl text-[13.5px] sm:text-[15px] font-bold shadow-sm hover:shadow transition-all duration-200 active:scale-95">
                    <x-icon name="user-plus" weight="bold" class="text-slate-500 text-base" />
                    <span>Balita Baru</span>
                </a>
                <a href="{{ route('balita.index') }}" 
                   class="flex items-center justify-center gap-2 px-4 sm:px-5 py-2.5 bg-teal-500 hover:bg-teal-600 text-white rounded-xl text-[13.5px] sm:text-[15px] font-bold shadow-md shadow-teal-500/20 hover:shadow-lg hover:shadow-teal-500/30 transition-all duration-200 active:scale-95">
                    <x-icon name="scales" weight="bold" class="text-white text-base" />
                    <span>Mulai Timbang</span>
                </a>
            </div>
        </div>

        {{-- ── 2. ALERT PERLU REVISI ── --}}
        @if(isset($statRevisi) && $statRevisi > 0)
        <div class="bg-white rounded-3xl p-5 shadow-sm hover:shadow-md border border-slate-100 transition-all duration-300 flex flex-col md:flex-row md:items-center justify-between gap-4 group">
            <div class="flex items-center gap-4 min-w-0">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-orange-50 text-orange-500 border border-orange-100 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-110 transition-transform duration-300">
                    <x-icon name="warning-circle" weight="bold" class="text-lg sm:text-xl" />
                </div>
                <div class="min-w-0">
                    <div class="flex flex-wrap items-center gap-2 mb-1">
                        <span class="px-2 py-0.5 rounded text-[12.5px] sm:text-[12.5px] font-black uppercase bg-[#FCDDBB] text-[#B54A0D] tracking-wider border border-[#F6C89A]">
                            PERLU TINDAKAN
                        </span>
                        <h3 class="text-[15px] font-bold text-slate-800 truncate">{{ $statRevisi }} Data Balita Perlu Koreksi Penimbangan</h3>
                    </div>
                    <p class="text-[12.5px] sm:text-[13.5px] text-slate-500 truncate">Puskesmas memberikan catatan verifikasi. Silakan timbang ulang balita agar status tervalidasi.</p>
                </div>
            </div>
            <a href="{{ route('balita.index', ['filter' => 'ditolak']) }}" 
               class="w-full md:w-auto px-5 py-2.5 bg-[#E85D21] hover:bg-[#D44F18] text-white text-[13.5px] sm:text-[15px] font-bold rounded-xl transition-all duration-200 active:scale-95 shadow-md shadow-orange-500/20 hover:shadow-lg hover:shadow-orange-500/30 flex items-center justify-center gap-2 shrink-0 group">
                <span>Tinjau Catatan</span> <x-icon name="arrow-right" weight="bold" class="group-hover:translate-x-1 transition-transform" />
            </a>
        </div>
        @endif

        {{-- ── 3. FOUR KPI CARDS ── --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            
            {{-- 1. Total Terdaftar --}}
            <div class="bg-white rounded-3xl p-5 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 border border-slate-100 flex flex-col justify-between relative group cursor-default">
                <div class="flex justify-between items-start mb-6 sm:mb-8">
                    <div>
                        <div class="text-[10px] sm:text-[11px] font-black uppercase text-slate-700 tracking-widest mb-1">TOTAL BALITA</div>
                        <div class="text-[11px] sm:text-[12.5px] text-slate-400 font-medium">Populasi Aktif</div>
                    </div>
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-[14px] bg-teal-50/50 flex items-center justify-center text-teal-500 group-hover:bg-teal-50 transition-colors duration-300">
                        <x-icon name="users" weight="fill" class="text-lg sm:text-xl group-hover:scale-110 transition-transform duration-300" />
                    </div>
                </div>
                <div>
                    <div class="flex items-baseline gap-1">
                        <span class="text-4xl sm:text-5xl font-extrabold text-slate-800 tracking-tighter">{{ $total }}</span>
                        <span class="text-[13.5px] sm:text-[15px] font-medium text-slate-500">anak</span>
                    </div>
                    <div class="text-[12.5px] sm:text-[13.5px] font-bold text-teal-600 flex items-center gap-1 mt-2">
                        <x-icon name="trend-up" weight="bold" /> +2 bulan ini
                    </div>
                </div>
            </div>

            {{-- 2. Selesai Ditimbang --}}
            <div class="bg-white rounded-3xl p-5 shadow-[0_4px_20px_-4px_rgba(20,184,166,0.1)] hover:shadow-[0_8px_30px_-4px_rgba(20,184,166,0.2)] hover:-translate-y-1 border border-teal-100 flex flex-col justify-between relative group cursor-default transition-all duration-300">
                <div class="flex justify-between items-start mb-6 sm:mb-8">
                    <div>
                        <div class="text-[10px] sm:text-[11px] font-black uppercase text-teal-600 tracking-widest mb-1">SUDAH DIUKUR</div>
                        <div class="text-[11px] sm:text-[12.5px] text-teal-500 font-medium">Sesi {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('F') }}</div>
                    </div>
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-[14px] bg-teal-500 flex items-center justify-center text-white shadow-md shadow-teal-500/30 group-hover:scale-110 transition-transform duration-300">
                        <x-icon name="check-circle" weight="bold" class="text-lg sm:text-xl" />
                    </div>
                </div>
                <div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-baseline gap-1">
                            <span class="text-4xl sm:text-5xl font-extrabold text-slate-800 tracking-tighter">{{ $sudah }}</span>
                            <span class="text-base sm:text-lg font-bold text-slate-400">/{{ $total }}</span>
                        </div>
                        <span class="px-2.5 py-1 bg-teal-600 text-white text-[12.5px] font-bold rounded-full shadow-sm shadow-teal-600/20">{{ $percent }}%</span>
                    </div>
                    <div class="w-full h-2 sm:h-2.5 bg-slate-100 rounded-full mt-3 overflow-hidden">
                        <div class="h-full bg-teal-600 rounded-full" style="width: {{ $percent }}%"></div>
                    </div>
                </div>
            </div>

            {{-- 3. Belum Hadir --}}
            <div class="bg-white rounded-3xl p-5 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 border border-slate-100 flex flex-col justify-between relative group cursor-default">
                <div class="flex justify-between items-start mb-6 sm:mb-8">
                    <div>
                        <div class="text-[10px] sm:text-[11px] font-black uppercase text-[#D96B2B] tracking-widest mb-1">BELUM DIUKUR</div>
                        <div class="text-[11px] sm:text-[12.5px] text-orange-400 font-medium">Menunggu Antrean</div>
                    </div>
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-[14px] bg-orange-50/80 flex items-center justify-center text-orange-500 group-hover:bg-orange-100 transition-colors duration-300">
                        <x-icon name="calendar-blank" weight="fill" class="text-lg sm:text-xl group-hover:scale-110 transition-transform duration-300" />
                    </div>
                </div>
                <div>
                    <div class="flex items-baseline gap-1">
                        <span class="text-4xl sm:text-5xl font-extrabold text-[#D96B2B] tracking-tighter">{{ $belum }}</span>
                        <span class="text-[13.5px] sm:text-[15px] font-medium text-slate-500">anak</span>
                    </div>
                    <a href="{{ route('balita.index', ['filter' => 'belum_diukur']) }}" class="text-[11px] sm:text-[13.5px] font-bold text-teal-600 hover:text-teal-700 flex items-center gap-1 mt-2.5 transition-colors">
                        Buka antrean hadir <x-icon name="arrow-right" weight="bold" class="group-hover:translate-x-1 transition-transform" />
                    </a>
                </div>
            </div>

            {{-- 4. Prioritas Pengawasan Gizi --}}
            <div class="bg-white rounded-3xl p-5 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 border border-slate-100 flex flex-col justify-between relative group cursor-default">
                <div class="flex justify-between items-start mb-6 sm:mb-8">
                    <div>
                        <div class="text-[10px] sm:text-[11px] font-black uppercase text-[#B91C1C] tracking-widest mb-1">PERLU PANTAUAN</div>
                        <div class="text-[11px] sm:text-[12.5px] text-red-400 font-medium">Risiko Gizi</div>
                    </div>
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-[14px] bg-[#B91C1C] flex items-center justify-center text-white shadow-md shadow-red-900/20 group-hover:scale-110 transition-transform duration-300">
                        <x-icon name="heart" weight="fill" class="text-lg sm:text-xl" />
                    </div>
                </div>
                <div>
                    <div class="flex items-baseline gap-1">
                        <span class="text-4xl sm:text-5xl font-extrabold text-[#B91C1C] tracking-tighter">{{ $statPerlu ?? count($priorityChildren ?? []) }}</span>
                        <span class="text-[13.5px] sm:text-[15px] font-medium text-red-400">anak</span>
                    </div>
                    <a href="{{ route('balita.index', ['filter' => 'absen_bulan_lalu']) }}" class="text-[11px] sm:text-[13.5px] font-bold text-[#B91C1C] hover:text-red-800 flex items-center gap-1 mt-2.5 transition-colors">
                        Lihat daftar pantau <x-icon name="arrow-right" weight="bold" class="group-hover:translate-x-1 transition-transform" />
                    </a>
                </div>
            </div>

        </div>

        {{-- ── 4. TWO-COLUMN OPERATIONAL WORKSPACE ── --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 sm:gap-6">
            
            {{-- Left Column (7-col): Prioritas Pemantauan Gizi --}}
            <div class="lg:col-span-7 bg-white border border-slate-100 rounded-[28px] shadow-sm p-5 sm:p-7 flex flex-col">
                
                {{-- Header --}}
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3.5">
                        <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-red-50 text-[#B91C1C] flex items-center justify-center text-lg sm:text-xl shrink-0">
                            <x-icon name="heart" weight="bold" />
                        </div>
                        <div>
                            <div class="flex items-center gap-2 mb-0.5">
                                <h2 class="text-base sm:text-lg font-bold text-slate-800">Prioritas Pemantauan Gizi</h2>
                                <span class="px-2 py-0.5 rounded-full text-[12.5px] sm:text-[12.5px] font-bold bg-[#FDE8E8] text-[#9B1C1C] border border-[#FBD5D5]">
                                    {{ count($priorityChildren ?? []) }} Balita
                                </span>
                            </div>
                            <p class="text-[12.5px] sm:text-[13.5px] text-slate-500">Balita dengan catatan gizi khusus yang memerlukan pendampingan</p>
                        </div>
                    </div>
                    <a href="{{ route('balita.index') }}" class="text-[13.5px] sm:text-[15px] font-bold text-teal-600 hover:text-teal-700 flex items-center gap-1 shrink-0 hidden sm:flex">
                        Semua balita <x-icon name="arrow-right" weight="bold" />
                    </a>
                </div>

                {{-- Child List (Nested Cards) --}}
                <div class="flex-1 flex flex-col gap-3">
                    @forelse($priorityChildren ?? [] as $child)
                        @php
                            $isDanger = ($child->statusType ?? 'warning') === 'danger';
                            $isBoy = ($child->gender ?? 'L') === 'L';
                            $initials = strtoupper(substr($child->name ?? 'AN', 0, 2));
                        @endphp
                        <a href="{{ route('balita.show', $child->id) }}" 
                           class="group bg-white border border-slate-100 hover:border-slate-300 rounded-2xl p-3.5 sm:p-4 flex items-center justify-between gap-4 transition-all duration-300 shadow-2xs hover:shadow-md hover:-translate-y-0.5">
                            
                            {{-- Info Balita --}}
                            <div class="flex items-center gap-3.5 min-w-0">
                                {{-- Avatar --}}
                                <div class="relative shrink-0">
                                    <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-full font-bold text-[15px] sm:text-base flex items-center justify-center {{ $isBoy ? 'bg-[#EBF5FF] text-[#1E40AF]' : 'bg-[#FDF2F8] text-[#9D174D]' }}">
                                        {{ $initials }}
                                    </div>
                                    <div class="absolute bottom-0 right-0 w-3.5 h-3.5 rounded-full border-2 border-white {{ $isDanger ? 'bg-red-500' : 'bg-orange-400' }}"></div>
                                </div>

                                <div class="flex flex-col min-w-0">
                                    <div class="flex items-center gap-2 mb-0.5">
                                        <h3 class="text-[15px] sm:text-base font-bold text-slate-800 group-hover:text-teal-700 transition-colors truncate">
                                            {{ Str::title($child->name) }}
                                        </h3>
                                        <span class="px-1.5 py-0.5 bg-slate-100 text-slate-500 text-[12.5px] sm:text-[12.5px] font-bold rounded shadow-2xs shrink-0">
                                            {{ $isBoy ? 'L' : 'P' }}
                                        </span>
                                    </div>
                                    <div class="text-[12.5px] sm:text-[13.5px] text-slate-500 flex items-center gap-1.5 truncate">
                                        <span class="truncate">Ibu {{ $child->mother ?? '-' }}</span>
                                        <span class="text-slate-300">•</span>
                                        <span class="shrink-0">{{ $child->age }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Status Badge & Action --}}
                            <div class="flex items-center gap-3 shrink-0">
                                <div class="flex items-center gap-1.5 px-2.5 py-1 rounded-full border border-orange-100 text-[#D96B2B] text-[12.5px] sm:text-[12.5px] font-bold">
                                    <div class="w-1.5 h-1.5 bg-[#D96B2B] rounded-full"></div>
                                    {{ $child->shortStatus ?? 'Gizi' }}
                                </div>
                                <x-icon name="caret-right" weight="bold" class="text-slate-400 text-[15px] group-hover:text-teal-600 transition-colors hidden sm:block" />
                            </div>
                        </a>
                    @empty
                        <div class="p-8 text-center text-slate-500 border border-slate-100 rounded-2xl">
                            <div class="w-12 h-12 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center mx-auto mb-3 text-2xl">
                                <x-icon name="check-circle" weight="bold" />
                            </div>
                            <p class="text-[15px] font-bold text-slate-800">Seluruh balita terpantau baik</p>
                            <p class="text-[13.5px] text-slate-500 mt-1">Tidak ada balita yang memerlukan tindakan darurat saat ini.</p>
                        </div>
                    @endforelse
                </div>
                
                {{-- Mobile Footer Link --}}
                <div class="mt-4 text-center sm:hidden">
                    <a href="{{ route('balita.index') }}" class="text-[13.5px] font-bold text-teal-600 flex items-center justify-center gap-1">
                        Semua balita <x-icon name="arrow-right" weight="bold" />
                    </a>
                </div>
            </div>

            {{-- Right Column (5-col): Agenda Posyandu & Quick Export --}}
            <div class="lg:col-span-5 flex flex-col gap-6">
                
                {{-- Agenda Posyandu Terdekat (Timeline) --}}
                <div class="bg-white border border-slate-100 rounded-[28px] shadow-sm p-5 sm:p-7 flex flex-col">
                    
                    {{-- Header --}}
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3.5">
                            <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-[#EFF6FF] text-[#3B82F6] flex items-center justify-center text-lg sm:text-xl shrink-0">
                                <x-icon name="calendar-blank" weight="bold" />
                            </div>
                            <div>
                                <h2 class="text-base sm:text-lg font-bold text-slate-800">Agenda Posyandu</h2>
                                <p class="text-[12.5px] sm:text-[13.5px] text-slate-500">Jadwal sesi penimbangan terdekat</p>
                            </div>
                        </div>
                        <a href="{{ route('jadwal.index') }}" class="text-[13.5px] sm:text-[15px] font-bold text-teal-600 hover:text-teal-700 flex items-center gap-1 shrink-0">
                            Semua <x-icon name="arrow-right" weight="bold" />
                        </a>
                    </div>

                    {{-- Timeline Content --}}
                    @if(isset($jadwalTerdekat) && $jadwalTerdekat)
                        <div class="relative pl-3 mt-2 border-l-2 border-teal-500 ml-4 py-2">
                            {{-- Timeline Dot --}}
                            <div class="absolute w-3 h-3 bg-teal-500 rounded-full -left-[7px] top-8 border-2 border-white shadow-sm"></div>
                            
                            {{-- Event Card --}}
                            <a href="{{ route('jadwal.show', $jadwalTerdekat['id']) }}" class="block bg-white border border-slate-100 hover:border-teal-200 rounded-2xl p-4 ml-4 shadow-2xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 group">
                                <div class="flex flex-col sm:flex-row gap-4">
                                    {{-- Date Block --}}
                                    <div class="w-14 h-14 bg-teal-600 rounded-[14px] text-white flex flex-col items-center justify-center shrink-0 shadow-md shadow-teal-600/20 group-hover:scale-105 transition-transform">
                                        <span class="text-[12.5px] font-bold uppercase tracking-wider">{{ $jadwalTerdekat['tgl_bulan'] ?? 'AGT' }}</span>
                                        <span class="text-[22px] font-black leading-none">{{ $jadwalTerdekat['tgl_nomor'] ?? '23' }}</span>
                                    </div>
                                    
                                    {{-- Event Details --}}
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-[15px] font-bold text-slate-800 leading-snug mb-2 group-hover:text-teal-700 transition-colors">
                                            {{ $jadwalTerdekat['judul'] }}
                                        </h3>
                                        <div class="text-[12.5px] sm:text-[13.5px] text-slate-500 flex flex-col gap-1.5 mb-3">
                                            <div class="flex items-center gap-1.5 truncate">
                                                <x-icon name="clock" class="shrink-0" /> 
                                                <span class="truncate">{{ $jadwalTerdekat['waktu'] }}</span>
                                            </div>
                                            <div class="flex items-center gap-1.5 truncate">
                                                <x-icon name="map-pin" class="shrink-0" /> 
                                                <span class="truncate">{{ $jadwalTerdekat['lokasi'] }}</span>
                                            </div>
                                        </div>
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-[#ECFEFF] text-[#0891B2] text-[12.5px] sm:text-[12.5px] font-black uppercase tracking-wider rounded-md border border-[#CFFAFE]">
                                            <x-icon name="hourglass" weight="bold" /> {{ $jadwalTerdekat['countdown'] }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @else
                        <div class="py-8 text-center text-slate-500">
                            <p class="text-[13.5px] font-bold text-slate-700">Belum ada agenda jadwal</p>
                            <a href="{{ route('jadwal.create') }}" class="text-[12.5px] font-bold text-teal-600 hover:underline mt-1 inline-block">+ Buat jadwal posyandu</a>
                        </div>
                    @endif
                </div>

                {{-- Quick Export Card --}}
                <div class="bg-white border border-slate-100 rounded-[28px] shadow-sm hover:shadow-md transition-all duration-300 p-5 sm:p-7 flex flex-col sm:flex-row sm:items-center justify-between gap-4 group">
                    <div class="flex items-center gap-4">
                        <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-[14px] bg-teal-500 text-white flex items-center justify-center shadow-md shadow-teal-500/20 text-lg sm:text-xl shrink-0 group-hover:scale-110 transition-transform duration-300">
                            <x-icon name="download-simple" weight="bold" />
                        </div>
                        <div>
                            <h3 class="text-[13.5px] sm:text-[15px] font-bold text-slate-800 mb-0.5">Rekap Laporan Bulanan</h3>
                            <p class="text-[11px] sm:text-[13.5px] text-slate-500">Ekspor data antropometri untuk Puskesmas.</p>
                        </div>
                    </div>
                    <a href="{{ route('laporan.index') }}" 
                       class="w-full sm:w-auto px-5 py-2.5 bg-teal-500 hover:bg-teal-600 text-white text-[13.5px] sm:text-[15px] font-bold rounded-xl transition-all duration-200 active:scale-95 shadow-md shadow-teal-500/20 hover:shadow-lg hover:shadow-teal-500/30 flex items-center justify-center gap-2 shrink-0 group-hover:translate-x-1">
                        <span>Buka</span> <x-icon name="arrow-right" weight="bold" />
                    </a>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection
