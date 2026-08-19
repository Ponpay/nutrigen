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

<div class="w-full min-h-screen bg-[#F8FAFC] pb-24 lg:pb-16 text-slate-800 antialiased font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 sm:py-7 flex flex-col gap-5 sm:gap-6">
        
        {{-- ── 1. WELCOME HEADER (Soft NutriGen Tint, Clean & Informative) ── --}}
        <div class="bg-gradient-to-r from-teal-50/90 via-emerald-50/40 to-slate-50 border border-teal-200/80 rounded-2xl sm:rounded-3xl p-5 sm:p-6 shadow-2xs flex flex-col md:flex-row md:items-center justify-between gap-5">
            
            {{-- Left: Sapaan & Konteks Posyandu --}}
            <div class="flex-1 min-w-0">
                <div class="flex flex-wrap items-center gap-2 mb-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-teal-100/80 border border-teal-300/80 text-teal-900 rounded-full text-xs font-bold uppercase tracking-wider shadow-2xs">
                        <span class="w-2 h-2 rounded-full bg-teal-600 animate-pulse"></span>
                        {{ $activityLocation ?? ($posyanduName ?? 'Posyandu') }}
                    </span>
                    <span class="inline-flex items-center gap-1.5 text-xs text-slate-600 font-semibold bg-white/80 px-2.5 py-1 rounded-full border border-slate-200/80 shadow-2xs">
                        <x-icon name="calendar" class="text-teal-700 text-sm" />
                        <span>{{ $todayFormatted }}</span>
                    </span>
                </div>

                <h1 class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-slate-900 tracking-tight leading-tight">
                    Selamat bertugas, {{ $kaderName ?? 'Ibu Kader' }}
                </h1>
                <p class="text-xs sm:text-sm text-slate-600 font-medium mt-1 leading-relaxed max-w-xl">
                    Pusat pemantauan tumbuh kembang balita, deteksi dini status KMS, dan sinkronisasi data antropometri Puskesmas.
                </p>
            </div>

            {{-- Right: Quick Action Hub --}}
            <div class="flex items-center gap-3 shrink-0">
                <a href="{{ route('balita.create') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-white hover:bg-slate-50 active:scale-[0.98] border border-slate-300 text-slate-800 rounded-xl text-xs sm:text-sm font-bold shadow-2xs transition-all">
                    <x-icon name="user-plus" weight="bold" class="text-teal-700 text-base" />
                    <span>Daftar Balita</span>
                </a>
                <a href="{{ route('balita.index') }}" 
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-teal-700 hover:bg-teal-800 active:scale-[0.98] text-white rounded-xl text-xs sm:text-sm font-bold shadow-sm shadow-teal-700/30 hover:shadow transition-all">
                    <x-icon name="scales" weight="bold" class="text-white text-base" />
                    <span>Mulai Penimbangan</span>
                </a>
            </div>
        </div>

        {{-- ── 2. ALERT PERLU REVISI (Jika Ada Catatan Puskesmas) ── --}}
        @if(isset($statRevisi) && $statRevisi > 0)
        <div class="bg-amber-50/90 border border-amber-200/90 rounded-2xl p-4 sm:p-4.5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 shadow-2xs">
            <div class="flex items-start sm:items-center gap-3.5 min-w-0">
                <div class="w-10 h-10 rounded-xl bg-amber-500 text-white flex items-center justify-center shrink-0 shadow-xs ring-4 ring-amber-100 text-xl">
                    <x-icon name="warning-circle" weight="bold" />
                </div>
                <div class="flex flex-col min-w-0">
                    <div class="flex items-center gap-2">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-amber-900 bg-amber-200/90 px-2.5 py-0.5 rounded-full border border-amber-300">
                            Perlu Tindakan
                        </span>
                        <span class="text-xs sm:text-sm font-bold text-amber-950">{{ $statRevisi }} Data Balita Perlu Koreksi</span>
                    </div>
                    <p class="text-xs text-amber-900 font-medium mt-0.5 leading-relaxed">
                        Puskesmas memberikan catatan verifikasi pada data penimbangan. Silakan timbang ulang anak agar status tervalidasi.
                    </p>
                </div>
            </div>
            <a href="{{ route('balita.index', ['filter' => 'ditolak']) }}" 
               class="w-full sm:w-auto shrink-0 h-9 px-4 bg-amber-700 hover:bg-amber-800 active:bg-amber-900 text-white rounded-xl text-xs font-bold shadow-2xs transition-all flex items-center justify-center gap-1.5 cursor-pointer">
                <span>Tinjau Catatan</span>
                <x-icon name="arrow-right" weight="bold" class="text-xs" />
            </a>
        </div>
        @endif

        {{-- ── 3. FOUR HARMONIOUS KPI CARDS ── --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-4">
            
            {{-- 1. Total Terdaftar --}}
            <div class="bg-white border border-slate-200/90 hover:border-slate-300 rounded-2xl p-4.5 sm:p-5 flex flex-col justify-between shadow-2xs hover:shadow-xs transition-all">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Balita</span>
                    <div class="w-9 h-9 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center border border-teal-100/80 shadow-2xs text-lg">
                        <x-icon name="users" weight="bold" />
                    </div>
                </div>
                <div class="mt-3.5">
                    <div class="flex items-baseline gap-1.5">
                        <span class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ $total }}</span>
                        <span class="text-xs font-semibold text-slate-500">anak</span>
                    </div>
                    <span class="text-[11.5px] text-slate-500 font-medium mt-1 block">Populasi binaan aktif</span>
                </div>
            </div>

            {{-- 2. Selesai Ditimbang --}}
            <div class="bg-white border border-emerald-200/90 hover:border-emerald-300 rounded-2xl p-4.5 sm:p-5 flex flex-col justify-between shadow-2xs hover:shadow-xs transition-all">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-emerald-800 uppercase tracking-wider">Sudah Diukur</span>
                    <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center border border-emerald-100/80 shadow-2xs text-lg">
                        <x-icon name="check-circle" weight="bold" />
                    </div>
                </div>
                <div class="mt-3.5">
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ $sudah }}</span>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                            {{ $percent }}% Selesai
                        </span>
                    </div>
                    <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden mt-2.5">
                        <div class="bg-emerald-600 h-full rounded-full transition-all duration-500 shadow-2xs" style="width: {{ $percent }}%"></div>
                    </div>
                </div>
            </div>

            {{-- 3. Belum Hadir --}}
            <div class="bg-white border border-amber-200/90 hover:border-amber-300 rounded-2xl p-4.5 sm:p-5 flex flex-col justify-between shadow-2xs hover:shadow-xs transition-all">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-amber-900 uppercase tracking-wider">Belum Diukur</span>
                    <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center border border-amber-100/80 shadow-2xs text-lg">
                        <x-icon name="clock" weight="bold" />
                    </div>
                </div>
                <div class="mt-3.5">
                    <div class="flex items-baseline gap-1.5">
                        <span class="text-3xl font-extrabold text-amber-900 tracking-tight">{{ $belum }}</span>
                        <span class="text-xs font-bold text-amber-700">anak</span>
                    </div>
                    <a href="{{ route('balita.index', ['filter' => 'belum_diukur']) }}" class="text-[11.5px] font-bold text-amber-800 hover:text-amber-950 mt-1 inline-flex items-center gap-1">
                        <span>Buka antrean hadir</span>
                        <x-icon name="caret-right" weight="bold" class="text-xs text-amber-700" />
                    </a>
                </div>
            </div>

            {{-- 4. Prioritas Pengawasan Gizi --}}
            <div class="bg-white border border-rose-200/90 hover:border-rose-300 rounded-2xl p-4.5 sm:p-5 flex flex-col justify-between shadow-2xs hover:shadow-xs transition-all">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-rose-800 uppercase tracking-wider">Perlu Pantauan</span>
                    <div class="w-9 h-9 rounded-xl bg-rose-50 text-rose-700 flex items-center justify-center border border-rose-100/80 shadow-2xs text-lg">
                        <x-icon name="heartbeat" weight="bold" />
                    </div>
                </div>
                <div class="mt-3.5">
                    <div class="flex items-baseline gap-1.5">
                        <span class="text-3xl font-extrabold text-rose-800 tracking-tight">{{ $statPerlu ?? count($priorityChildren ?? []) }}</span>
                        <span class="text-xs font-bold text-rose-700">anak</span>
                    </div>
                    <a href="{{ route('balita.index', ['filter' => 'absen_bulan_lalu']) }}" class="text-[11.5px] font-bold text-rose-800 hover:text-rose-950 mt-1 inline-flex items-center gap-1">
                        <span>Lihat daftar pantauan</span>
                        <x-icon name="caret-right" weight="bold" class="text-xs text-rose-700" />
                    </a>
                </div>
            </div>

        </div>

        {{-- ── 4. TWO-COLUMN OPERATIONAL WORKSPACE (Elevated with Clear Row Separation) ── --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 sm:gap-6">
            
            {{-- Left Column (7-col): Prioritas Pemantauan Gizi --}}
            <div class="lg:col-span-7 bg-white border border-slate-200/90 rounded-2xl sm:rounded-3xl shadow-2xs overflow-hidden flex flex-col">
                
                {{-- Header --}}
                <div class="p-5 pb-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/40">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-700 flex items-center justify-center border border-rose-100 shadow-2xs text-lg">
                            <x-icon name="heartbeat" weight="bold" />
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h2 class="text-base font-extrabold text-slate-900 tracking-tight">
                                    Prioritas Pemantauan Gizi
                                </h2>
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-100 text-rose-800 border border-rose-200">
                                    {{ count($priorityChildren ?? []) }} Balita
                                </span>
                            </div>
                            <p class="text-xs text-slate-500 font-medium mt-0.5">Balita dengan catatan gizi khusus yang memerlukan pendampingan</p>
                        </div>
                    </div>
                    <a href="{{ route('balita.index') }}" class="text-xs font-bold text-teal-800 hover:text-teal-950 transition-colors hidden sm:inline-flex items-center gap-1">
                        <span>Semua balita</span>
                        <x-icon name="arrow-right" weight="bold" class="text-[10px]" />
                    </a>
                </div>

                {{-- Child List (Distinct Structured Card Tiles with Clear Separation) --}}
                <div class="flex-1 p-3.5 sm:p-4 flex flex-col gap-2.5">
                    @forelse($priorityChildren ?? [] as $child)
                        @php
                            $isDanger = ($child->statusType ?? 'warning') === 'danger';
                            $isBoy = ($child->gender ?? 'L') === 'L';
                            $initials = strtoupper(substr($child->name ?? 'AN', 0, 2));
                        @endphp
                        <a href="{{ route('balita.show', $child->id) }}" 
                           class="group bg-slate-50/70 hover:bg-teal-50/40 border border-slate-200/90 hover:border-teal-300 rounded-2xl p-3.5 sm:p-4 flex items-center justify-between gap-3.5 transition-all shadow-2xs hover:shadow-xs cursor-pointer">
                            
                            {{-- Info Balita --}}
                            <div class="flex items-center gap-3.5 min-w-0">
                                
                                {{-- Gender-Aware Avatar with Status Dot --}}
                                <div class="relative shrink-0">
                                    <div class="w-11 h-11 rounded-xl font-black text-xs flex items-center justify-center shadow-2xs {{ $isBoy ? 'bg-sky-100 text-sky-900 border border-sky-200' : 'bg-pink-100 text-pink-900 border border-pink-200' }}">
                                        {{ $initials }}
                                    </div>
                                    <span class="absolute -bottom-0.5 -right-0.5 w-3.5 h-3.5 rounded-full border-2 border-white {{ $isDanger ? 'bg-rose-600' : 'bg-amber-500' }}"></span>
                                </div>

                                <div class="flex flex-col min-w-0">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-bold text-slate-900 group-hover:text-teal-800 transition-colors truncate">
                                            {{ Str::title($child->name) }}
                                        </span>
                                        <span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-white text-slate-500 border border-slate-200 uppercase hidden sm:inline-block shadow-2xs">
                                            {{ $isBoy ? 'Laki-laki' : 'Perempuan' }}
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-1.5 text-xs text-slate-600 font-medium truncate mt-1">
                                        <span class="text-slate-700 font-semibold truncate">Ibu {{ $child->mother ?? '-' }}</span>
                                        <span class="text-slate-300">&bull;</span>
                                        <span class="text-slate-500 shrink-0">{{ $child->age }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Status Badge & Action Button --}}
                            <div class="flex items-center gap-2.5 shrink-0">
                                @if($isDanger)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800 border border-rose-300 shadow-2xs">
                                        <span class="w-2 h-2 rounded-full bg-rose-600 animate-pulse"></span>
                                        <span>{{ $child->shortStatus ?? 'Konfirmasi TB' }}</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-900 border border-amber-300 shadow-2xs">
                                        <span class="w-2 h-2 rounded-full bg-amber-600"></span>
                                        <span>{{ $child->shortStatus ?? 'Pantauan Gizi' }}</span>
                                    </span>
                                @endif

                                <div class="w-8 h-8 rounded-xl bg-white border border-slate-200 group-hover:border-teal-300 group-hover:bg-teal-600 group-hover:text-white flex items-center justify-center text-slate-400 transition-all shadow-2xs">
                                    <x-icon name="caret-right" weight="bold" class="text-xs" />
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="p-8 text-center text-slate-500">
                            <div class="w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center mx-auto mb-2.5 border border-emerald-100 shadow-2xs text-2xl">
                                <x-icon name="check-circle" weight="bold" />
                            </div>
                            <p class="text-sm font-bold text-slate-900">Seluruh balita terpantau baik</p>
                            <p class="text-xs text-slate-500 mt-0.5">Tidak ada balita yang memerlukan tindakan darurat saat ini.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Mobile Footer Link --}}
                <div class="p-3 border-t border-slate-100 bg-slate-50/50 text-center sm:hidden">
                    <a href="{{ route('balita.index') }}" class="text-xs font-bold text-teal-800 hover:text-teal-950 inline-flex items-center gap-1">
                        <span>Lihat semua data balita</span>
                        <x-icon name="arrow-right" weight="bold" class="text-xs" />
                    </a>
                </div>
            </div>

            {{-- Right Column (5-col): Agenda Posyandu & Quick Export --}}
            <div class="lg:col-span-5 flex flex-col gap-4 sm:gap-5">
                
                {{-- Agenda Posyandu Terdekat --}}
                <div class="bg-white border border-slate-200/90 rounded-2xl sm:rounded-3xl p-5 sm:p-6 shadow-2xs flex flex-col justify-between">
                    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                        <div class="flex items-center gap-2.5">
                            <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-800 flex items-center justify-center border border-teal-100 shadow-2xs text-lg">
                                <x-icon name="calendar-blank" weight="bold" />
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
                        <div class="mt-4">
                            <a href="{{ route('jadwal.show', $jadwalTerdekat['id']) }}" 
                               class="group p-4 bg-slate-50/80 hover:bg-teal-50/40 border-l-4 border-l-teal-600 border-y border-r border-slate-200/90 hover:border-r-teal-300 rounded-2xl transition-all flex items-start gap-3.5 cursor-pointer shadow-2xs">
                                
                                {{-- Date Stamp Ticket --}}
                                <div class="w-12 rounded-xl overflow-hidden border border-slate-200 bg-white text-center shrink-0 shadow-2xs">
                                    <div class="bg-teal-800 text-white text-[9px] font-black uppercase py-0.5 tracking-wider">
                                        {{ $jadwalTerdekat['tgl_bulan'] ?? 'POS' }}
                                    </div>
                                    <div class="py-1 text-base font-black text-slate-900 leading-none">
                                        {{ $jadwalTerdekat['tgl_nomor'] ?? '00' }}
                                    </div>
                                </div>

                                {{-- Event Details --}}
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-teal-800 transition-colors leading-snug">
                                        {{ $jadwalTerdekat['judul'] }}
                                    </h3>
                                    <div class="mt-1.5 flex flex-col gap-1 text-[11.5px] text-slate-600 font-medium">
                                        <div class="flex items-center gap-1.5 truncate">
                                            <x-icon name="clock" class="text-slate-400 text-xs shrink-0" />
                                            <span class="truncate">{{ $jadwalTerdekat['waktu'] }}</span>
                                        </div>
                                        <div class="flex items-center gap-1.5 truncate">
                                            <x-icon name="map-pin" class="text-slate-400 text-xs shrink-0" />
                                            <span class="truncate">{{ $jadwalTerdekat['lokasi'] }}</span>
                                        </div>
                                    </div>
                                    <div class="mt-2.5">
                                        <span class="inline-flex items-center gap-1 text-[10.5px] font-bold uppercase tracking-wider text-teal-900 bg-teal-100/90 border border-teal-200 px-2.5 py-0.5 rounded-md">
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
                            <a href="{{ route('jadwal.create') }}" class="text-[11px] font-bold text-teal-800 hover:underline mt-1 inline-block">+ Buat jadwal posyandu</a>
                        </div>
                    @endif
                </div>

                {{-- Quick Export Card --}}
                <div class="bg-gradient-to-br from-teal-50/70 via-emerald-50/30 to-white border border-teal-200/90 rounded-2xl sm:rounded-3xl p-5 shadow-2xs flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-xl bg-teal-700 text-white flex items-center justify-center shrink-0 shadow-2xs text-xl">
                            <x-icon name="file-arrow-down" weight="bold" />
                        </div>
                        <div class="flex flex-col min-w-0">
                            <h3 class="text-xs sm:text-sm font-bold text-slate-900">Rekap Laporan Bulanan</h3>
                            <p class="text-[11.5px] text-slate-600 font-medium">Ekspor data antropometri untuk laporan Puskesmas.</p>
                        </div>
                    </div>
                    <a href="{{ route('laporan.index') }}" 
                       class="px-4 py-2.5 bg-teal-800 hover:bg-teal-900 text-white text-xs font-bold rounded-xl transition-all shadow-xs shrink-0 flex items-center gap-1.5 cursor-pointer">
                        <span>Buka Laporan</span>
                        <x-icon name="arrow-right" weight="bold" class="text-[11px]" />
                    </a>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection
