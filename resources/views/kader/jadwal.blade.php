@extends('layouts.app')

@section('page-title', 'Jadwal Posyandu')

@section('content')

{{-- Script for Framer Motion --}}
<script type="module">
    document.addEventListener('DOMContentLoaded', () => {
        if(window.Motion) {
            const { animate, stagger, hover } = window.Motion;
            
            animate('.motion-card', 
                { opacity: [0, 1], y: [12, 0] }, 
                { delay: stagger(0.04), duration: 0.3, easing: "ease-out" }
            );

            document.querySelectorAll('.motion-hover').forEach(el => {
                hover(el, () => {
                    animate(el, { scale: 1.015, y: -1.5 }, { duration: 0.15 });
                    return () => animate(el, { scale: 1, y: 0 }, { duration: 0.15 });
                });
            });
        }
    });
</script>

<div class="flex flex-col min-h-screen bg-slate-50/50 pb-28 lg:pb-16 w-full selection:bg-teal-100 selection:text-teal-900">

    {{-- ── HERO CARD (Aligned with Daftar Balita Pro-Max Standards) ── --}}
    <div class="px-4 pt-4 pb-1 sm:px-6 sm:pt-5 lg:px-0 lg:pt-6 lg:pb-0 max-w-7xl lg:mx-auto w-full">
        <div class="bg-gradient-to-br from-teal-700 via-teal-600 to-teal-800 rounded-2xl lg:rounded-[28px] shadow-[0_6px_24px_rgb(13,148,136,0.14)] relative overflow-hidden motion-card opacity-0">

            {{-- Decorative ambient glows --}}
            <div class="absolute -right-16 -top-16 w-56 h-56 bg-teal-400/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute left-0 bottom-0 w-36 h-36 bg-teal-900/40 rounded-full blur-2xl pointer-events-none"></div>
            <div class="absolute inset-0 opacity-[0.04] pointer-events-none" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 16px 16px;"></div>

            <div class="relative z-10 p-5 sm:p-6 lg:px-8 lg:py-7">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 sm:gap-6">
                    
                    {{-- Left block info --}}
                    <div class="flex flex-col min-w-0">
                        <div class="flex items-center gap-2 mb-1.5">
                            <span class="text-[10.5px] font-bold text-teal-200 uppercase tracking-[0.14em] flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-3.5 h-3.5 flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                                Operasional
                            </span>
                            <span class="text-teal-200/80 text-xs font-medium truncate">• {{ $posyanduName ?? 'Posyandu Kader' }}</span>
                        </div>
                        <h1 class="text-lg sm:text-xl lg:text-2xl font-bold text-white tracking-tight leading-tight">Jadwal Posyandu</h1>
                        <p class="text-xs sm:text-[13px] text-teal-100/90 font-medium mt-1">Agenda terbit otomatis ke beranda Portal Ibu.</p>
                    </div>

                    {{-- Right block actions --}}
                    <div class="flex items-center justify-between sm:justify-end gap-3 pt-3 sm:pt-0 border-t border-white/15 sm:border-t-0">
                        {{-- Stat pill --}}
                        <div class="flex items-center gap-2 bg-white/15 px-3 py-2 rounded-xl border border-white/15 shadow-2xs flex-shrink-0">
                            <div class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></div>
                            <span class="text-xs text-white font-bold">{{ $jadwalMendatang ?? 0 }} Sesi Mendatang</span>
                        </div>

                        {{-- Action Button (Open Form Modal) --}}
                        <button type="button" 
                                onclick="openCreateJadwalModal()"
                                class="motion-hover flex-shrink-0 flex items-center justify-center gap-1.5 h-10 bg-teal-500 hover:bg-teal-400 active:bg-teal-600 text-white border border-teal-400/50 px-4 rounded-xl font-bold text-xs sm:text-[13px] shadow-[0_2px_8px_rgba(20,184,166,0.3)] transition-all cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <span>Tambah</span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- ── SUCCESS ALERT (Compact) ── --}}
    @if(session('success'))
    <div class="max-w-7xl mx-auto w-full px-3 sm:px-4 lg:px-0 mt-2.5">
        <div class="bg-emerald-50 border border-emerald-200/80 rounded-xl p-2.5 sm:p-3 flex items-center gap-2 text-emerald-800 text-[11.5px] sm:text-[12px] font-bold shadow-xs">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-emerald-600 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <span class="leading-tight">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    {{-- ── COMPACT INFORMATIVE SCHEDULE CARDS ── --}}
    <div class="max-w-7xl mx-auto w-full px-3 sm:px-4 lg:px-0 mt-3 sm:mt-4">
        
        @if(!empty($jadwals) && count($jadwals) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
                @foreach($jadwals as $j)
                    @php
                        $isToday = $j['status_type'] === 'today';
                        $isUpcoming = $j['status_type'] === 'upcoming';
                        
                        $accentBar = match($j['status_type']) {
                            'today' => 'bg-amber-400',
                            'upcoming' => 'bg-emerald-500',
                            default => 'bg-slate-300'
                        };

                        $badgeClasses = match($j['status_type']) {
                            'today' => 'bg-amber-50 text-amber-700 border-amber-200/80',
                            'upcoming' => 'bg-emerald-50 text-emerald-700 border-emerald-200/80',
                            default => 'bg-slate-50 text-slate-600 border-slate-200'
                        };

                        $dateHeaderBg = match($j['status_type']) {
                            'today' => 'bg-amber-500 text-white',
                            'upcoming' => 'bg-teal-600 text-white',
                            default => 'bg-slate-400 text-white'
                        };
                    @endphp

                    {{-- Card Shell (Proportional height, not oversized) --}}
                    <div class="group relative flex flex-col justify-between bg-white border border-slate-200/70 hover:border-teal-300/80 rounded-2xl overflow-hidden shadow-[0_1px_4px_rgba(0,0,0,0.03),0_4px_16px_rgba(0,0,0,0.02)] hover:shadow-[0_4px_20px_rgba(13,148,136,0.08)] hover:-translate-y-0.5 transition-all duration-200 ease-out motion-card opacity-0">
                        
                        {{-- Left Accent Strip (4px standard) --}}
                        <div class="absolute left-0 top-0 bottom-0 w-1 {{ $accentBar }}"></div>

                        {{-- Card Header & Body --}}
                        <div class="p-3.5 sm:p-4 pl-4 sm:pl-5">
                            
                            {{-- Top Row: Date Tile + Title & Meta --}}
                            <div class="flex items-start gap-3">
                                
                                {{-- Mini Date Badge Tile --}}
                                <div class="flex flex-col items-center justify-center w-11 rounded-xl overflow-hidden border border-slate-200/80 shadow-xs bg-white flex-shrink-0 group-hover:border-teal-200 transition-colors">
                                    <div class="w-full py-0.5 text-center text-[8.5px] font-black uppercase tracking-wider {{ $dateHeaderBg }}">
                                        {{ $j['tgl_bulan_singkat'] }}
                                    </div>
                                    <div class="py-1 px-1 flex flex-col items-center">
                                        <span class="text-[15px] font-black text-slate-800 leading-none">{{ $j['tgl_nomor'] }}</span>
                                        <span class="text-[7.5px] font-bold text-slate-400 uppercase tracking-wider mt-0.5">{{ substr($j['hari'], 0, 3) }}</span>
                                    </div>
                                </div>

                                {{-- Title + Time & Location Info --}}
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-slate-800 text-[13.5px] sm:text-[14px] leading-snug group-hover:text-teal-700 transition-colors truncate">
                                        {{ $j['judul'] }}
                                    </h3>

                                    <div class="flex flex-wrap items-center gap-x-2.5 gap-y-1 mt-1 text-[11.5px] text-slate-500 font-medium">
                                        {{-- Waktu --}}
                                        <span class="inline-flex items-center gap-1 text-slate-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3 text-teal-600 shrink-0"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            {{ $j['waktu'] }}
                                        </span>

                                        <span class="text-slate-300">•</span>

                                        {{-- Lokasi --}}
                                        <span class="inline-flex items-center gap-1 text-slate-600 truncate max-w-[150px] sm:max-w-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3 text-teal-600 shrink-0"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                                            <span class="truncate">{{ $j['lokasi'] }}</span>
                                        </span>
                                    </div>
                                </div>

                            </div>

                            {{-- Catatan (if present) --}}
                            @if(!empty($j['catatan']))
                            <div class="mt-2.5 px-2.5 py-1 rounded-lg bg-amber-50/70 border border-amber-100/90 text-amber-900 flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3 text-amber-600 shrink-0">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
                                </svg>
                                <p class="text-[11px] font-medium leading-snug truncate">
                                    {{ $j['catatan'] }}
                                </p>
                            </div>
                            @endif

                        </div>

                        {{-- Divider --}}
                        <div class="w-full h-px bg-slate-100"></div>

                        {{-- Bottom Row: Badges & Actions --}}
                        <div class="p-2.5 sm:p-3 pl-4 sm:pl-5 flex items-center justify-between gap-2 bg-white">
                            
                            {{-- Badges Left --}}
                            <div class="flex items-center gap-1.5 min-w-0">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wide border {{ $badgeClasses }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $isToday ? 'bg-amber-500 animate-ping' : ($isUpcoming ? 'bg-emerald-500' : 'bg-slate-400') }}"></span>
                                    {{ $j['status'] }}
                                </span>

                                @if(!empty($j['countdown']) && $j['countdown'] !== 'Selesai')
                                <span class="inline-flex items-center text-[10px] font-bold text-teal-700 bg-teal-50 border border-teal-200/60 px-1.5 py-0.5 rounded-md">
                                    {{ $j['countdown'] }}
                                </span>
                                @endif
                            </div>

                            {{-- Actions Right --}}
                            <div class="flex items-center gap-1 shrink-0">
                                {{-- Pop-up Detail Modal Button --}}
                                <button type="button" 
                                        onclick="openDetailJadwalModal({{ json_encode($j) }})"
                                        class="h-[30px] px-2.5 flex items-center justify-center text-[11.5px] font-bold text-slate-600 bg-white border border-slate-200 hover:border-slate-300 hover:bg-slate-50 hover:text-slate-800 rounded-lg shadow-xs transition-all duration-150 cursor-pointer">
                                    Detail
                                </button>

                                {{-- Pop-up Edit Modal Button --}}
                                <button type="button" 
                                        onclick="openEditJadwalModal({{ json_encode($j) }})"
                                        class="h-[30px] px-2.5 flex items-center justify-center text-[11.5px] font-bold text-teal-700 bg-teal-50 hover:bg-teal-100 border border-teal-200/60 rounded-lg transition-all duration-150 cursor-pointer">
                                    Edit
                                </button>

                                <form action="{{ route('jadwal.destroy', $j['id']) }}" method="POST"
                                      onsubmit="if(window.NutriAlert && typeof window.NutriAlert.confirm === 'function'){ event.preventDefault(); const form = this; window.NutriAlert.confirm('Hapus Jadwal?', 'Jadwal ini tidak akan tampil lagi di Portal Ibu.', 'Hapus', 'Batal').then((r) => { if(r.isConfirmed) form.submit(); }); return false; } return confirm('Hapus Jadwal Posyandu ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="h-[30px] w-[30px] flex items-center justify-center text-[11.5px] font-bold text-rose-600 bg-rose-50 hover:bg-rose-100 border border-rose-200/60 rounded-lg transition-all duration-150 cursor-pointer" aria-label="Hapus jadwal">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            </div>

                        </div>

                    </div>
                @endforeach
            </div>
        @else
            {{-- Empty State (Compact & Elegant) --}}
            <div class="bg-white rounded-2xl p-6 sm:p-8 text-center border border-slate-200/80 shadow-xs flex flex-col items-center justify-center max-w-sm mx-auto motion-card opacity-0 my-3">
                <div class="w-12 h-12 rounded-2xl bg-teal-50 border border-teal-100 flex items-center justify-center text-teal-600 mb-3 shadow-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                </div>
                <h3 class="text-[15px] font-bold text-slate-800 tracking-tight mb-1">Belum Ada Jadwal Posyandu</h3>
                <p class="text-[11.5px] text-slate-500 font-medium leading-relaxed mb-4 max-w-[260px]">Buat jadwal pertama agar para Ibu menerima pengingat penimbangan di aplikasi.</p>
                <button type="button" 
                        onclick="openCreateJadwalModal()"
                        class="inline-flex items-center gap-1.5 h-[36px] px-3.5 bg-teal-600 hover:bg-teal-500 text-white rounded-xl font-bold text-[12px] shadow-sm shadow-teal-500/20 transition-all cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Buat Jadwal Pertama
            </div>
        @endif

    </div>

</div>

{{-- ── 1. MODAL FORM: EDIT & TAMBAH JADWAL (Clean, Spacious & Responsive) ── --}}
<div id="modal-jadwal-wrapper" 
     class="fixed inset-0 z-[100] flex items-end sm:items-center justify-center p-0 sm:p-4 md:p-6 bg-slate-900/60 backdrop-blur-xs transition-all duration-200 opacity-0 pointer-events-none"
     onclick="handleBackdropClick(event)">
    
    <div id="modal-jadwal-box" 
         class="bg-white rounded-t-[28px] sm:rounded-3xl shadow-2xl border border-slate-200/90 w-full max-w-xl max-h-[88dvh] sm:max-h-[90vh] flex flex-col transform transition-all scale-95 duration-200 overflow-hidden pointer-events-auto"
         onclick="event.stopPropagation()">
        
        {{-- Mobile Drag Handle --}}
        <div class="w-full pt-3 pb-1 flex justify-center sm:hidden bg-slate-50/80 shrink-0">
            <div class="w-10 h-1 bg-slate-300 rounded-full"></div>
        </div>

        {{-- Sticky Header --}}
        <div class="px-5 sm:px-8 py-3.5 sm:py-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/80 shrink-0">
            <div>
                <h2 id="modal-title" class="text-lg sm:text-xl font-black text-slate-900 tracking-tight leading-tight">
                    Edit Jadwal Posyandu
                </h2>
                <p class="text-xs text-slate-500 font-medium mt-0.5 hidden sm:block">
                    Kelola agenda kegiatan pemeriksaan posyandu.
                </p>
            </div>

            <button type="button" 
                    onclick="closeJadwalModal()"
                    class="w-9 h-9 rounded-full bg-slate-200/70 hover:bg-slate-200 text-slate-600 hover:text-slate-900 flex items-center justify-center transition-colors cursor-pointer shrink-0"
                    aria-label="Tutup popup">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Scrollable Form Body with Generous Spacing --}}
        <form id="form-jadwal-modal" action="" method="POST" class="p-5 sm:p-8 flex-1 min-h-0 overflow-y-auto overscroll-contain space-y-4 sm:space-y-5 text-xs">
            @csrf
            <input type="hidden" id="form-method" name="_method" value="POST">

            {{-- Posyandu Info Strip --}}
            <div class="flex items-center gap-3 p-3 bg-teal-50/50 rounded-2xl border border-teal-100">
                <div class="w-9 h-9 rounded-xl bg-teal-600 text-white flex items-center justify-center shrink-0 shadow-2xs font-bold text-sm">
                    P
                </div>
                <div class="flex-1 min-w-0">
                    <span class="text-[10px] text-teal-800 font-bold uppercase tracking-wider block">Posyandu Penyelenggara</span>
                    <span class="text-xs sm:text-[13px] font-extrabold text-slate-900 truncate block mt-0.5">{{ $posyanduName ?? 'Posyandu Kader' }}</span>
                </div>
            </div>

            {{-- Judul Kegiatan --}}
            <div class="flex flex-col gap-1.5">
                <label for="modal-input-judul" class="text-xs font-bold text-slate-700 uppercase tracking-wider">
                    Nama / Judul Kegiatan <span class="text-rose-500">*</span>
                </label>
                <input type="text" id="modal-input-judul" name="judul" required
                       placeholder="Contoh: Layanan Penimbangan Rutin Balita & Imunisasi"
                       class="w-full h-12 bg-slate-50/80 border border-slate-200 hover:border-slate-300 focus:bg-white focus:border-teal-600 focus:ring-4 focus:ring-teal-500/15 rounded-2xl px-4 text-xs sm:text-sm font-bold text-slate-800 transition-all outline-none">
            </div>

            {{-- Lokasi / Tempat --}}
            <div class="flex flex-col gap-1.5">
                <label for="modal-input-lokasi" class="text-xs font-bold text-slate-700 uppercase tracking-wider">
                    Tempat / Lokasi Pelaksanaan <span class="text-rose-500">*</span>
                </label>
                <input type="text" id="modal-input-lokasi" name="lokasi" required
                       placeholder="Contoh: Balai Posyandu RW 01, Jl. Melati"
                       class="w-full h-12 bg-slate-50/80 border border-slate-200 hover:border-slate-300 focus:bg-white focus:border-teal-600 focus:ring-4 focus:ring-teal-500/15 rounded-2xl px-4 text-xs sm:text-sm font-bold text-slate-800 transition-all outline-none">
            </div>

            {{-- Tanggal & Waktu Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {{-- Tanggal --}}
                <div class="flex flex-col gap-1.5">
                    <label for="modal-input-tanggal" class="text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Tanggal Kegiatan <span class="text-rose-500">*</span>
                    </label>
                    <input type="date" id="modal-input-tanggal" name="tanggal" required
                           class="w-full h-12 bg-slate-50/80 border border-slate-200 hover:border-slate-300 focus:bg-white focus:border-teal-600 focus:ring-4 focus:ring-teal-500/15 rounded-2xl px-4 text-xs sm:text-sm font-bold text-slate-800 transition-all outline-none cursor-pointer">
                </div>

                {{-- Jam Mulai & Selesai --}}
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Rentang Waktu <span class="text-rose-500">*</span>
                    </label>
                    <div class="grid grid-cols-2 gap-2.5">
                        <input type="time" id="modal-input-mulai" name="waktu_mulai" required
                               class="w-full h-12 bg-slate-50/80 border border-slate-200 hover:border-slate-300 focus:bg-white focus:border-teal-600 focus:ring-4 focus:ring-teal-500/15 rounded-2xl px-3 text-xs sm:text-sm font-bold text-slate-800 transition-all outline-none cursor-pointer"
                               title="Jam Mulai">
                        <input type="time" id="modal-input-selesai" name="waktu_selesai" required
                               class="w-full h-12 bg-slate-50/80 border border-slate-200 hover:border-slate-300 focus:bg-white focus:border-teal-600 focus:ring-4 focus:ring-teal-500/15 rounded-2xl px-3 text-xs sm:text-sm font-bold text-slate-800 transition-all outline-none cursor-pointer"
                               title="Jam Selesai">
                    </div>
                </div>
            </div>

            {{-- Catatan Tambahan --}}
            <div class="flex flex-col gap-1.5">
                <label for="modal-input-catatan" class="flex items-center justify-between text-xs font-bold text-slate-700 uppercase tracking-wider">
                    <span>Catatan untuk Ibu Balita</span>
                    <span class="text-[10px] font-semibold text-slate-400 normal-case tracking-normal">Opsional</span>
                </label>
                <textarea id="modal-input-catatan" name="catatan" rows="2"
                          placeholder="Contoh: Harap membawa Buku KIA dan kartu identitas anak."
                          class="w-full bg-slate-50/80 border border-slate-200 hover:border-slate-300 focus:bg-white focus:border-teal-600 focus:ring-4 focus:ring-teal-500/15 rounded-2xl px-4 py-3 text-xs sm:text-sm text-slate-800 placeholder:text-slate-400 transition-all outline-none resize-none"></textarea>
            </div>
        </form>

        {{-- Sticky Footer --}}
        <div class="px-5 sm:px-8 py-3.5 sm:py-4 border-t border-slate-100 flex items-center justify-end gap-3 bg-white/95 backdrop-blur-md shrink-0">
            <button type="button" 
                    onclick="closeJadwalModal()"
                    class="h-11 sm:h-12 px-5 sm:px-6 rounded-2xl border border-slate-200 text-slate-700 hover:bg-slate-100 font-bold text-xs sm:text-sm transition-colors cursor-pointer">
                Batal
            </button>
            <button type="button" 
                    onclick="document.getElementById('form-jadwal-modal').submit()"
                    class="flex-1 sm:flex-initial h-11 sm:h-12 px-6 sm:px-8 rounded-2xl bg-gradient-to-r from-teal-600 via-teal-700 to-emerald-700 hover:from-teal-500 hover:to-emerald-600 active:scale-[0.99] text-white font-black text-xs sm:text-sm shadow-sm hover:shadow transition-all flex items-center justify-center gap-2 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
                <span id="modal-btn-submit-text">Simpan Perubahan</span>
            </button>
        </div>

    </div>
</div>

{{-- ── 2. MODAL DETAIL JADWAL (Spacious & Clean Popup) ── --}}
<div id="modal-detail-wrapper" 
     class="fixed inset-0 z-[100] flex items-end sm:items-center justify-center p-0 sm:p-4 md:p-6 bg-slate-900/60 backdrop-blur-xs transition-all duration-200 opacity-0 pointer-events-none"
     onclick="handleDetailBackdropClick(event)">
    
    <div id="modal-detail-box" 
         class="bg-white rounded-t-[28px] sm:rounded-3xl shadow-2xl border border-slate-200/90 w-full max-w-lg max-h-[88dvh] sm:max-h-[90vh] flex flex-col transform transition-all scale-95 duration-200 overflow-hidden pointer-events-auto"
         onclick="event.stopPropagation()">
        
        {{-- Mobile Drag Handle --}}
        <div class="w-full pt-3 pb-1 flex justify-center sm:hidden bg-slate-50/80 shrink-0">
            <div class="w-10 h-1 bg-slate-300 rounded-full"></div>
        </div>

        {{-- Sticky Detail Header --}}
        <div class="px-5 sm:px-8 py-3.5 sm:py-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/80 shrink-0">
            <div class="flex items-center gap-2">
                <span id="detail-badge-status" class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-[10.5px] font-extrabold uppercase tracking-wider border">
                    Akan Datang
                </span>
                <span id="detail-countdown" class="text-[11px] font-bold text-teal-800 bg-teal-50 border border-teal-200/70 px-2.5 py-0.5 rounded-md hidden">
                    Besok
                </span>
            </div>

            <button type="button" 
                    onclick="closeDetailModal()"
                    class="w-9 h-9 rounded-full bg-slate-200/70 hover:bg-slate-200 text-slate-600 hover:text-slate-900 flex items-center justify-center transition-colors cursor-pointer shrink-0"
                    aria-label="Tutup detail">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Detail Content Body with flex-1 min-h-0 for proper scrolling --}}
        <div class="p-5 sm:p-8 flex-1 min-h-0 overflow-y-auto overscroll-contain space-y-4 sm:space-y-5 text-xs">
            {{-- Title --}}
            <div>
                <span class="text-[10.5px] font-bold text-teal-700 uppercase tracking-widest block mb-1">Agenda Posyandu</span>
                <h3 id="detail-judul" class="text-lg sm:text-xl font-black text-slate-900 leading-snug">
                    Layanan Penimbangan & Imunisasi Balita
                </h3>
            </div>

            {{-- 2-Column Info Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                {{-- Tanggal --}}
                <div class="p-3.5 bg-slate-50/80 rounded-2xl border border-slate-200/80 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center shrink-0 border border-teal-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block">Tanggal</span>
                        <span id="detail-tanggal" class="text-xs sm:text-[13px] font-bold text-slate-800 truncate block mt-0.5">-</span>
                    </div>
                </div>

                {{-- Waktu --}}
                <div class="p-3.5 bg-slate-50/80 rounded-2xl border border-slate-200/80 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center shrink-0 border border-teal-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block">Waktu Sesi</span>
                        <span id="detail-waktu" class="text-xs sm:text-[13px] font-bold text-slate-800 truncate block mt-0.5">-</span>
                    </div>
                </div>

                {{-- Lokasi --}}
                <div class="p-3.5 bg-slate-50/80 rounded-2xl border border-slate-200/80 flex items-start gap-3 sm:col-span-2">
                    <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center shrink-0 border border-teal-100 mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block">Tempat / Lokasi</span>
                        <span id="detail-lokasi" class="text-xs sm:text-[13px] font-bold text-slate-800 leading-snug block mt-0.5">-</span>
                    </div>
                </div>
            </div>

            {{-- Catatan (If Available) --}}
            <div id="detail-catatan-container" class="p-4 bg-amber-50/80 rounded-2xl border border-amber-200/80 text-amber-900 hidden">
                <span class="text-[10px] font-bold text-amber-800 uppercase tracking-wider flex items-center gap-1.5 mb-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5 text-amber-600">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
                    </svg>
                    Catatan untuk Ibu Balita
                </span>
                <p id="detail-catatan" class="text-xs sm:text-[12.5px] font-medium leading-relaxed"></p>
            </div>
        </div>

        {{-- Sticky Detail Footer --}}
        <div class="px-5 sm:px-8 py-3.5 sm:py-4 border-t border-slate-100 flex items-center justify-end gap-3 bg-white/95 backdrop-blur-md shrink-0">
            <button type="button" 
                    onclick="closeDetailModal()"
                    class="h-11 sm:h-12 px-5 sm:px-6 rounded-2xl border border-slate-200 text-slate-700 hover:bg-slate-100 font-bold text-xs sm:text-sm transition-colors cursor-pointer">
                Tutup
            </button>
            <button type="button" 
                    id="detail-btn-edit"
                    onclick=""
                    class="flex-1 sm:flex-initial h-11 sm:h-12 px-6 sm:px-8 rounded-2xl bg-gradient-to-r from-teal-600 via-teal-700 to-emerald-700 hover:from-teal-500 hover:to-emerald-600 active:scale-[0.99] text-white font-black text-xs sm:text-sm shadow-sm hover:shadow transition-all flex items-center justify-center gap-2 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125" />
                </svg>
                <span>Edit Jadwal Ini</span>
            </button>
        </div>

    </div>
</div>

{{-- JavaScript Modal Controllers --}}
<script>
    // 1. Form Modal Elements (Edit & Create)
    const modalWrapper = document.getElementById('modal-jadwal-wrapper');
    const modalBox = document.getElementById('modal-jadwal-box');
    const formModal = document.getElementById('form-jadwal-modal');
    const formMethod = document.getElementById('form-method');
    const modalTitle = document.getElementById('modal-title');
    const submitBtnText = document.getElementById('modal-btn-submit-text');

    const inputJudul = document.getElementById('modal-input-judul');
    const inputLokasi = document.getElementById('modal-input-lokasi');
    const inputTanggal = document.getElementById('modal-input-tanggal');
    const inputMulai = document.getElementById('modal-input-mulai');
    const inputSelesai = document.getElementById('modal-input-selesai');
    const inputCatatan = document.getElementById('modal-input-catatan');

    // 2. Detail Modal Elements
    const detailWrapper = document.getElementById('modal-detail-wrapper');
    const detailBox = document.getElementById('modal-detail-box');
    const detailJudul = document.getElementById('detail-judul');
    const detailTanggal = document.getElementById('detail-tanggal');
    const detailWaktu = document.getElementById('detail-waktu');
    const detailLokasi = document.getElementById('detail-lokasi');
    const detailStatusBadge = document.getElementById('detail-badge-status');
    const detailCountdown = document.getElementById('detail-countdown');
    const detailCatatanContainer = document.getElementById('detail-catatan-container');
    const detailCatatan = document.getElementById('detail-catatan');
    const detailBtnEdit = document.getElementById('detail-btn-edit');

    // Open Edit Modal
    function openEditJadwalModal(jadwal) {
        if (!jadwal) return;
        closeDetailModal();

        formModal.action = "/kader/jadwal/" + jadwal.id;
        formMethod.value = "PUT";
        modalTitle.innerText = "Edit Jadwal Posyandu";
        submitBtnText.innerText = "Simpan Perubahan";

        inputJudul.value = jadwal.judul || '';
        inputLokasi.value = jadwal.lokasi || '';
        inputTanggal.value = jadwal.raw_tanggal || '';
        inputMulai.value = jadwal.waktu_mulai || '08:30';
        inputSelesai.value = jadwal.waktu_selesai || '11:30';
        inputCatatan.value = jadwal.catatan || '';

        showFormModal();
    }

    // Open Create Modal
    function openCreateJadwalModal() {
        closeDetailModal();

        formModal.action = "{{ route('jadwal.store') }}";
        formMethod.value = "POST";
        modalTitle.innerText = "Tambah Jadwal Baru";
        submitBtnText.innerText = "Simpan & Terbitkan";

        inputJudul.value = 'Layanan Penimbangan & Imunisasi Balita';
        inputLokasi.value = '';
        inputTanggal.value = new Date().toISOString().split('T')[0];
        inputMulai.value = '08:30';
        inputSelesai.value = '11:30';
        inputCatatan.value = '';

        showFormModal();
    }

    function showFormModal() {
        modalWrapper.classList.remove('opacity-0', 'pointer-events-none');
        modalWrapper.classList.add('opacity-100', 'pointer-events-auto');
        modalBox.classList.remove('scale-95');
        modalBox.classList.add('scale-100');
        document.body.style.overflow = 'hidden';
    }

    function closeJadwalModal() {
        modalWrapper.classList.remove('opacity-100', 'pointer-events-auto');
        modalWrapper.classList.add('opacity-0', 'pointer-events-none');
        modalBox.classList.remove('scale-100');
        modalBox.classList.add('scale-95');
        document.body.style.overflow = '';
    }

    function handleBackdropClick(e) {
        if (e.target === modalWrapper) {
            closeJadwalModal();
        }
    }

    // Open Detail Modal
    function openDetailJadwalModal(jadwal) {
        if (!jadwal) return;

        detailJudul.innerText = jadwal.judul || 'Layanan Posyandu';
        detailTanggal.innerText = (jadwal.hari ? jadwal.hari + ', ' : '') + (jadwal.tanggal || '-');
        detailWaktu.innerText = jadwal.waktu || '-';
        detailLokasi.innerText = jadwal.lokasi || '-';

        // Badge Status
        detailStatusBadge.innerText = jadwal.status || 'Akan Datang';
        if (jadwal.status_type === 'today') {
            detailStatusBadge.className = 'inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-amber-50 text-amber-700 border border-amber-200/80';
        } else if (jadwal.status_type === 'upcoming') {
            detailStatusBadge.className = 'inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200/80';
        } else {
            detailStatusBadge.className = 'inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-slate-50 text-slate-600 border border-slate-200';
        }

        // Countdown (Only show if upcoming and not identical to status)
        if (jadwal.countdown && jadwal.countdown !== 'Selesai' && jadwal.status_type === 'upcoming' && jadwal.countdown.toLowerCase() !== (jadwal.status || '').toLowerCase()) {
            detailCountdown.innerText = jadwal.countdown;
            detailCountdown.classList.remove('hidden');
        } else {
            detailCountdown.classList.add('hidden');
        }

        // Catatan
        if (jadwal.catatan && jadwal.catatan.trim() !== '') {
            detailCatatan.innerText = jadwal.catatan;
            detailCatatanContainer.classList.remove('hidden');
        } else {
            detailCatatanContainer.classList.add('hidden');
        }

        // Wire edit button to open edit modal for this item
        detailBtnEdit.onclick = function() {
            openEditJadwalModal(jadwal);
        };

        showDetailModal();
    }

    function showDetailModal() {
        detailWrapper.classList.remove('opacity-0', 'pointer-events-none');
        detailWrapper.classList.add('opacity-100', 'pointer-events-auto');
        detailBox.classList.remove('scale-95');
        detailBox.classList.add('scale-100');
        document.body.style.overflow = 'hidden';
    }

    function closeDetailModal() {
        detailWrapper.classList.remove('opacity-100', 'pointer-events-auto');
        detailWrapper.classList.add('opacity-0', 'pointer-events-none');
        detailBox.classList.remove('scale-100');
        detailBox.classList.add('scale-95');
        document.body.style.overflow = '';
    }

    function handleDetailBackdropClick(e) {
        if (e.target === detailWrapper) {
            closeDetailModal();
        }
    }

    // Global Keydown Handler
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            if (!modalWrapper.classList.contains('pointer-events-none')) closeJadwalModal();
            if (!detailWrapper.classList.contains('pointer-events-none')) closeDetailModal();
        }
    });
</script>

@endsection
