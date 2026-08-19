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

<div class="w-full min-h-screen bg-[#F8FAFC] pb-28 lg:pb-12 text-slate-800">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 pt-4 sm:pt-6 flex flex-col gap-4 sm:gap-5">
        
        {{-- ── 1. HEADER RINGKAS (Mobile-First, Human-Crafted) ── --}}
        <div class="flex items-center justify-between gap-3 pt-1 pb-1">
            <div class="flex flex-col min-w-0">
                <div class="flex items-center gap-2 text-xs font-semibold text-slate-500 mb-0.5">
                    <span class="text-teal-700 font-bold flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                        {{ $activityLocation ?? ($posyanduName ?? 'Posyandu') }}
                    </span>
                    <span>&bull;</span>
                    <span class="truncate">{{ $todayFormatted }}</span>
                </div>
                <h1 class="text-lg sm:text-xl font-bold text-slate-900 tracking-tight truncate">
                    Halo, {{ $kaderName ?? 'Ibu Kader' }} 👋
                </h1>
            </div>
            
            <a href="{{ route('kader.profil') }}" class="w-10 h-10 rounded-full bg-teal-50 border border-teal-200/80 text-teal-700 font-bold text-xs flex items-center justify-center shrink-0 shadow-2xs hover:bg-teal-100 transition-colors">
                {{ strtoupper(substr($kaderName ?? 'KD', 0, 2)) }}
            </a>
        </div>

        {{-- ── 2. ALERT PERLU REVISI (Jika Ada Catatan Puskesmas) ── --}}
        @if(isset($statRevisi) && $statRevisi > 0)
        <a href="{{ route('balita.index', ['filter' => 'ditolak']) }}" 
           class="bg-rose-50 border border-rose-200 rounded-2xl p-3.5 flex items-center justify-between gap-3 shadow-2xs hover:bg-rose-100/70 transition-all cursor-pointer">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-9 h-9 rounded-xl bg-rose-500 text-white flex items-center justify-center shrink-0 shadow-2xs">
                    <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                </div>
                <div class="flex flex-col min-w-0">
                    <div class="flex items-center gap-1.5">
                        <span class="text-[11px] font-bold text-rose-800">Catatan Puskesmas</span>
                        <span class="text-[10px] font-extrabold uppercase bg-rose-200/80 text-rose-900 px-1.5 py-0.2 rounded">{{ $statRevisi }} Revisi</span>
                    </div>
                    <p class="text-xs text-rose-700 font-medium truncate mt-0.5">
                        Ada data balita yang perlu ditimbang ulang
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-1 text-xs font-bold text-rose-700 shrink-0">
                <span class="hidden sm:inline">Periksa</span>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </div>
        </a>
        @endif

        {{-- ── 3. DUA TOMBOL AKSI UTAMA (Thumb-Friendly for Mobile) ── --}}
        <div class="grid grid-cols-2 gap-3">
            
            {{-- Tombol 1: Ukur Balita (Aksi Primer) --}}
            <a href="{{ route('balita.index') }}" 
               class="group bg-teal-600 hover:bg-teal-700 active:scale-[0.98] text-white rounded-2xl p-4 flex flex-col justify-between shadow-sm hover:shadow transition-all min-h-[105px] cursor-pointer">
                <div class="flex items-center justify-between">
                    <div class="w-9 h-9 rounded-xl bg-white/20 flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0l2.469 10.106c.122.499.106 1.028.589 1.202a5.989 5.989 0 002.031.352 5.989 5.989 0 002.031-.352c.483-.174.711-.703.59-1.202L5.25 4.971z" />
                        </svg>
                    </div>
                    <svg class="w-4 h-4 text-teal-200 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-sm text-white leading-tight">Ukur Balita</h3>
                    <p class="text-[11px] text-teal-100/90 font-medium mt-0.5">Catat BB, TB & KMS</p>
                </div>
            </a>

            {{-- Tombol 2: Tambah Balita (Aksi Sekunder) --}}
            <a href="{{ route('balita.create') }}" 
               class="group bg-white hover:bg-slate-50 border border-slate-200/90 active:scale-[0.98] text-slate-800 rounded-2xl p-4 flex flex-col justify-between shadow-2xs hover:border-slate-300 transition-all min-h-[105px] cursor-pointer">
                <div class="flex items-center justify-between">
                    <div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                        </svg>
                    </div>
                    <svg class="w-4 h-4 text-slate-300 group-hover:text-slate-600 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-sm text-slate-900 leading-tight">Balita Baru</h3>
                    <p class="text-[11px] text-slate-500 font-medium mt-0.5">Daftar identitas anak</p>
                </div>
            </a>

        </div>

        {{-- ── 4. RINGKASAN CAPAIAN PENIMBANGAN BULAN INI ── --}}
        <div class="bg-white border border-slate-200/90 rounded-2xl p-4 sm:p-5 shadow-2xs flex flex-col gap-3">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Cakupan Penimbangan</span>
                    <h2 class="text-base font-bold text-slate-900 mt-0.5">
                        {{ $sudah }} dari {{ $total }} Balita Terukur
                    </h2>
                </div>
                <div class="text-right">
                    <span class="text-base font-extrabold text-teal-700">{{ $percent }}%</span>
                </div>
            </div>

            {{-- Progress Bar Bersih --}}
            <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-teal-600 rounded-full transition-all duration-500" style="width: {{ $percent }}%"></div>
            </div>

            {{-- Sub Metric Row --}}
            <div class="grid grid-cols-3 gap-2 pt-2 border-t border-slate-100 text-center">
                <div class="flex flex-col py-1">
                    <span class="text-[10.5px] font-medium text-slate-400">Total Terdaftar</span>
                    <span class="text-sm font-bold text-slate-800 mt-0.5">{{ $total }}</span>
                </div>
                <a href="{{ route('balita.index', ['filter' => 'belum_diukur']) }}" class="flex flex-col py-1 hover:bg-slate-50 rounded-lg transition-colors">
                    <span class="text-[10.5px] font-semibold text-amber-700">Belum Diukur</span>
                    <span class="text-sm font-bold text-amber-700 mt-0.5">{{ $belum }}</span>
                </a>
                <a href="{{ route('balita.index', ['filter' => 'absen_bulan_lalu']) }}" class="flex flex-col py-1 hover:bg-slate-50 rounded-lg transition-colors">
                    <span class="text-[10.5px] font-semibold text-rose-700">Perlu Pantauan</span>
                    <span class="text-sm font-bold text-rose-700 mt-0.5">{{ $statPerlu ?? count($priorityChildren ?? []) }}</span>
                </a>
            </div>
        </div>

        {{-- ── 5. PRIORITAS PERHATIAN HARI INI ── --}}
        <div class="flex flex-col gap-2.5">
            <div class="flex items-center justify-between px-1">
                <h2 class="text-sm font-bold text-slate-900 flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-rose-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                    </svg>
                    Prioritas Pemantauan
                </h2>
                <a href="{{ route('balita.index') }}" class="text-xs font-bold text-teal-700 hover:text-teal-800 transition-colors">
                    Lihat Semua &rarr;
                </a>
            </div>

            <div class="flex flex-col gap-2">
                @forelse($priorityChildren ?? [] as $child)
                    @php
                        $isDanger = ($child->statusType ?? 'warning') === 'danger';
                        $initials = strtoupper(substr($child->name ?? 'AN', 0, 2));
                    @endphp
                    <a href="{{ route('balita.show', $child->id) }}" 
                       class="group bg-white border border-slate-200/90 hover:border-slate-300 rounded-xl p-3 flex items-center justify-between gap-3 shadow-2xs transition-all cursor-pointer">
                        
                        {{-- Avatar + Info Anak --}}
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-9 h-9 rounded-full flex items-center justify-center shrink-0 font-bold text-xs {{ $isDanger ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-800' }}">
                                {{ $initials }}
                            </div>
                            <div class="flex flex-col min-w-0">
                                <h3 class="text-xs font-bold text-slate-900 group-hover:text-teal-700 transition-colors truncate">
                                    {{ Str::title($child->name) }}
                                </h3>
                                <div class="flex items-center gap-1.5 text-[11px] text-slate-500 font-medium">
                                    <span class="truncate max-w-[110px]">Ibu {{ $child->mother ?? '-' }}</span>
                                    <span>&bull;</span>
                                    <span class="shrink-0">{{ $child->age }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Status Pill + Chevron --}}
                        <div class="flex items-center gap-2 shrink-0">
                            @if($isDanger)
                                <span class="inline-flex items-center gap-1 text-[10.5px] font-bold text-rose-700 bg-rose-50 border border-rose-200 px-2 py-0.5 rounded-md">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                    <span>{{ $child->shortStatus ?? 'Konfirmasi TB' }}</span>
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 text-[10.5px] font-bold text-amber-700 bg-amber-50 border border-amber-200 px-2 py-0.5 rounded-md">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    <span>{{ $child->shortStatus ?? 'Pantauan Gizi' }}</span>
                                </span>
                            @endif

                            <svg class="w-3.5 h-3.5 text-slate-300 group-hover:text-teal-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </div>
                    </a>
                @empty
                    <div class="bg-white border border-slate-200/90 rounded-xl p-5 text-center text-slate-400">
                        <p class="text-xs font-semibold text-slate-600">Seluruh Data Balita Aman</p>
                        <p class="text-[11px] text-slate-400 mt-0.5">Tidak ada balita yang perlu tindakan darurat.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- ── 6. JADWAL POSYANDU TERDEKAT (Compact Card) ── --}}
        <div class="flex flex-col gap-2.5">
            <div class="flex items-center justify-between px-1">
                <h2 class="text-sm font-bold text-slate-900 flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Jadwal Posyandu
                </h2>
                <a href="{{ route('jadwal.index') }}" class="text-xs font-bold text-teal-700 hover:text-teal-800 transition-colors">
                    Semua Jadwal &rarr;
                </a>
            </div>

            @if(isset($jadwalTerdekat) && $jadwalTerdekat)
                <a href="{{ route('jadwal.show', $jadwalTerdekat['id']) }}" 
                   class="group bg-white border border-slate-200/90 hover:border-slate-300 rounded-2xl p-3.5 flex items-center justify-between gap-3 shadow-2xs transition-all cursor-pointer">
                    
                    {{-- Calendar Block + Info --}}
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-11 rounded-xl overflow-hidden border border-slate-200 text-center bg-slate-50 shrink-0">
                            <div class="py-0.5 text-[8px] font-black uppercase text-white bg-teal-700">
                                {{ $jadwalTerdekat['tgl_bulan'] ?? 'POS' }}
                            </div>
                            <div class="py-1 flex flex-col items-center leading-none">
                                <span class="text-sm font-black text-slate-900">{{ $jadwalTerdekat['tgl_nomor'] ?? '00' }}</span>
                            </div>
                        </div>

                        <div class="flex flex-col min-w-0">
                            <h3 class="text-xs font-bold text-slate-900 group-hover:text-teal-700 transition-colors truncate">
                                {{ $jadwalTerdekat['judul'] }}
                            </h3>
                            <p class="text-[11px] text-slate-500 font-medium truncate mt-0.5">
                                {{ $jadwalTerdekat['waktu'] }} &bull; {{ $jadwalTerdekat['lokasi'] }}
                            </p>
                        </div>
                    </div>

                    {{-- Countdown Badge --}}
                    <div class="flex items-center gap-1.5 shrink-0">
                        <span class="text-[10.5px] font-bold text-teal-800 bg-teal-50 border border-teal-200/80 px-2 py-0.5 rounded-md">
                            {{ $jadwalTerdekat['countdown'] }}
                        </span>
                        <svg class="w-3.5 h-3.5 text-slate-300 group-hover:text-teal-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </div>
                </a>
            @else
                <div class="bg-white border border-slate-200/90 rounded-xl p-4 text-center text-slate-400">
                    <p class="text-xs font-semibold text-slate-600">Belum Ada Jadwal</p>
                    <a href="{{ route('jadwal.create') }}" class="text-[11px] font-bold text-teal-700 hover:underline mt-1 inline-block">+ Tambah Jadwal</a>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
