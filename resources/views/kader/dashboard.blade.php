@extends('layouts.app')
@section('page-title', 'Beranda')
@section('content')

{{-- Script for Framer Motion --}}
<script type="module">
    document.addEventListener('DOMContentLoaded', () => {
        if(window.Motion) {
            const { animate, stagger, hover } = window.Motion;
            
            // Stagger animation for cards
            animate('.motion-card', 
                { opacity: [0, 1], y: [20, 0] }, 
                { delay: stagger(0.1), duration: 0.5, easing: "ease-out" }
            );

            // Hover animations for action buttons
            document.querySelectorAll('.motion-hover').forEach(el => {
                hover(el, () => {
                    animate(el, { scale: 1.02, y: -2 }, { duration: 0.2 });
                    return () => animate(el, { scale: 1, y: 0 }, { duration: 0.2 });
                });
            });
        }
    });
</script>

<div class="w-full min-h-screen bg-slate-50/50 pb-20 lg:pb-12">
    <!-- HERO SECTION (Teal Gradient) -->
    <div class="relative bg-gradient-to-br from-teal-700 via-teal-600 to-teal-800 pt-8 pb-16 lg:pt-12 lg:pb-20 px-4 sm:px-6 lg:px-8 overflow-hidden lg:rounded-b-[40px] shadow-sm">
        <div class="absolute -right-10 -top-10 w-64 h-64 bg-teal-400/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute left-0 bottom-0 w-40 h-40 bg-teal-900/40 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute inset-0 opacity-[0.05] pointer-events-none" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 24px 24px;"></div>
        
        <div class="max-w-6xl mx-auto relative z-10 motion-card opacity-0">
            <h1 class="text-2xl lg:text-3xl font-extrabold text-white tracking-tight drop-shadow-sm">
                Selamat pagi, {{ $kaderName ?? 'Ibu Kader' }} 👋
            </h1>
            <p class="text-[13px] lg:text-[15px] text-teal-50 font-medium mt-1">
                {{ $posyanduName ?? 'Posyandu Melati 1' }}
            </p>
        </div>
    </div>

    <!-- MAIN WORKSPACE -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 lg:-mt-12 relative z-20 flex flex-col gap-6 lg:gap-8">
        
        <!-- Quick Actions -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 lg:gap-4 motion-card opacity-0">
            <!-- Primary Action (Teal) -->
            <a href="{{ route('balita.create') }}" class="motion-hover flex items-center gap-4 bg-white p-4 lg:p-5 rounded-[24px] shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(13,148,136,0.12)] border border-slate-100 group transition-all">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-teal-500 to-teal-600 flex items-center justify-center text-white shadow-sm shadow-teal-500/30 group-hover:scale-105 transition-transform shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-[15px] font-bold text-slate-800 tracking-tight group-hover:text-teal-700 transition-colors">Tambah Balita</span>
                    <span class="text-[12px] font-medium text-slate-500">Daftarkan balita baru</span>
                </div>
            </a>
            
            <!-- Secondary Action (Slate/Teal) -->
            <a href="{{ route('balita.index') }}" class="motion-hover flex items-center gap-4 bg-white p-4 lg:p-5 rounded-[24px] shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] border border-slate-100 group transition-all">
                <div class="w-12 h-12 rounded-2xl bg-slate-50 text-slate-500 flex items-center justify-center border border-slate-200 group-hover:bg-teal-50 group-hover:text-teal-600 group-hover:border-teal-200 group-hover:scale-105 transition-all shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0l2.469 10.106c.122.499.106 1.028.589 1.202a5.989 5.989 0 002.031.352 5.989 5.989 0 002.031-.352c.483-.174.711-.703.59-1.202L5.25 4.971z" />
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-[15px] font-bold text-slate-800 tracking-tight group-hover:text-teal-700 transition-colors">Ukur Balita</span>
                    <span class="text-[12px] font-medium text-slate-500">Catat pertumbuhan hari ini</span>
                </div>
            </a>
        </div>

        <!-- Alert Perlu Revisi -->
        @if(isset($statRevisi) && $statRevisi > 0)
        <div class="bg-rose-50 border border-rose-200 rounded-[24px] p-4 lg:p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 shadow-sm relative overflow-hidden group motion-card opacity-0">
            <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-rose-500"></div>
            <div class="flex items-center gap-4 relative z-10">
                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-rose-500 shadow-sm shrink-0 border border-rose-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 animate-bounce mt-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="flex flex-col">
                    <h3 class="text-[14px] lg:text-[15px] font-black text-rose-800 tracking-tight leading-tight">Perhatian: Ada {{ $statRevisi }} Data Ditolak</h3>
                    <p class="text-[12px] font-medium text-rose-600/90 mt-0.5 max-w-sm leading-relaxed">Puskesmas meminta perbaikan pada data pengukuran. Silakan periksa kembali catatan validator.</p>
                </div>
            </div>
            <a href="{{ route('balita.index', ['filter' => 'ditolak']) }}" class="w-full sm:w-auto shrink-0 px-5 py-3.5 sm:py-3 bg-rose-600 hover:bg-rose-700 text-white rounded-xl text-[13px] font-bold shadow-sm hover:shadow-md transition-all flex items-center justify-center gap-2">
                Revisi Sekarang
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
            </a>
        </div>
        @endif

        <!-- Daily Statistics Section -->
        <div class="flex flex-col gap-4 motion-card opacity-0">
            <!-- Header -->
            <div class="flex justify-between items-end">
                <h2 class="text-[15px] font-bold text-slate-800 tracking-tight flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-teal-500"><path fill-rule="evenodd" d="M3 6a3 3 0 013-3h12a3 3 0 013 3v12a3 3 0 01-3 3H6a3 3 0 01-3-3V6zm4.5 7.5a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0v-2.25a.75.75 0 01.75-.75zm3.75-1.5a.75.75 0 00-1.5 0v4.5a.75.75 0 001.5 0V12zm3-3a.75.75 0 01.75.75v6.75a.75.75 0 01-1.5 0V9.75A.75.75 0 0114.25 9z" clip-rule="evenodd" /></svg>
                    Statistik Hari Ini
                </h2>
                <span class="text-[12px] font-bold text-teal-700 bg-teal-50 px-3 py-1 rounded-full border border-teal-100 shadow-sm flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" /></svg>
                    {{ $currentDate ?? \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d M Y') }}
                </span>
            </div>
            
            <!-- Grid Stats -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-4">
                <!-- Total -->
                <a href="{{ route('balita.index') }}" class="motion-hover flex flex-col bg-slate-50/50 rounded-[24px] p-4 lg:p-5 shadow-[0_8px_30px_rgb(0,0,0,0.03)] border border-slate-200/60 hover:border-slate-300 transition-colors relative overflow-hidden group">
                    <div class="absolute right-0 top-0 w-24 h-24 bg-white rounded-bl-full pointer-events-none -z-10 group-hover:scale-110 transition-transform"></div>
                    <div class="w-10 h-10 rounded-2xl bg-white text-slate-600 flex items-center justify-center border border-slate-200/60 mb-3 group-hover:bg-slate-800 group-hover:text-white transition-colors shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" /></svg>
                    </div>
                    <span class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ $statTotal ?? 32 }}</span>
                    <span class="text-[12px] font-semibold text-slate-500 mt-0.5">Total Balita</span>
                </a>
                
                <!-- Sudah Diukur -->
                <a href="{{ route('balita.index', ['filter' => 'selesai']) }}" class="motion-hover flex flex-col bg-emerald-50/40 rounded-[24px] p-4 lg:p-5 shadow-[0_8px_30px_rgb(0,0,0,0.03)] border border-emerald-100/50 hover:border-emerald-200 transition-colors relative overflow-hidden group">
                    <div class="absolute right-0 top-0 w-24 h-24 bg-white rounded-bl-full pointer-events-none -z-10 group-hover:scale-110 transition-transform"></div>
                    <div class="w-10 h-10 rounded-2xl bg-white text-emerald-600 flex items-center justify-center border border-emerald-100 mb-3 group-hover:bg-emerald-600 group-hover:text-white transition-colors shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" /></svg>
                    </div>
                    <span class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ $statSudah ?? 8 }}</span>
                    <span class="text-[12px] font-semibold text-slate-500 mt-0.5">Sudah Diukur</span>
                </a>
                
                <!-- Belum Diukur -->
                <a href="{{ route('balita.index', ['filter' => 'belum_diukur']) }}" class="motion-hover flex flex-col bg-amber-50/40 rounded-[24px] p-4 lg:p-5 shadow-[0_8px_30px_rgb(0,0,0,0.03)] border border-amber-100/50 hover:border-amber-200 transition-colors relative overflow-hidden group">
                    <div class="absolute right-0 top-0 w-24 h-24 bg-white rounded-bl-full pointer-events-none -z-10 group-hover:scale-110 transition-transform"></div>
                    <div class="w-10 h-10 rounded-2xl bg-white text-amber-600 flex items-center justify-center border border-amber-100 mb-3 group-hover:bg-amber-500 group-hover:text-white transition-colors shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd" /></svg>
                    </div>
                    <span class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ $statBelum ?? 5 }}</span>
                    <span class="text-[12px] font-semibold text-slate-500 mt-0.5">Belum Diukur</span>
                </a>
                
                <!-- Perlu Perhatian -->
                <a href="{{ route('balita.index', ['filter' => 'ditolak']) }}" class="motion-hover flex flex-col bg-rose-50/40 rounded-[24px] p-4 lg:p-5 shadow-[0_8px_30px_rgb(0,0,0,0.03)] border border-rose-100/50 hover:border-rose-200 transition-colors relative overflow-hidden group">
                    <div class="absolute right-0 top-0 w-24 h-24 bg-white rounded-bl-full pointer-events-none -z-10 group-hover:scale-110 transition-transform"></div>
                    <div class="w-10 h-10 rounded-2xl bg-white text-rose-600 flex items-center justify-center border border-rose-100 mb-3 group-hover:bg-rose-600 group-hover:text-white transition-colors shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" /></svg>
                    </div>
                    <span class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ $statPerlu ?? 3 }}</span>
                    <span class="text-[12px] font-semibold text-slate-500 mt-0.5">Perlu Perhatian</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-6 motion-card opacity-0">
            <!-- Priority Attention Section -->
            <div class="flex flex-col gap-4 bg-slate-100/60 p-4 lg:p-6 rounded-[32px] border border-slate-200/50">
                <h2 class="text-[15px] font-bold tracking-tight text-slate-800 flex items-center gap-2 px-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-rose-500"><path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" /></svg>
                    Prioritas Perhatian
                    <span class="bg-rose-100 text-rose-700 text-[10px] uppercase font-bold tracking-widest px-2 py-0.5 rounded-full ml-auto">{{ count($priorityChildren ?? []) }} Anak</span>
                </h2>
                
                <div class="flex flex-col gap-2.5">
                    @forelse($priorityChildren ?? [] as $child)
                        @php
                            $isMale = ($child->gender ?? 'L') === 'L';
                        @endphp
                        <a href="{{ route('balita.show', $child->id) }}" class="flex items-center justify-between p-3 sm:p-3.5 bg-white border border-slate-200/80 shadow-2xs rounded-2xl hover:border-teal-300 hover:shadow-xs transition-all group">
                            <!-- Left: Gender Avatar & Identity -->
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl flex items-center justify-center shrink-0 {{ $isMale ? 'bg-cyan-50 text-cyan-600 border border-cyan-100' : 'bg-rose-50 text-rose-600 border border-rose-100' }}">
                                    @if(!empty($child->avatar))
                                        <img src="{{ $child->avatar }}" alt="{{ $child->name }}" class="w-full h-full object-cover rounded-xl">
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                </div>
                                
                                <div class="flex flex-col min-w-0">
                                    <span class="font-bold text-slate-900 text-xs sm:text-[13.5px] group-hover:text-teal-600 transition-colors truncate">
                                        {{ $child->name }}
                                    </span>
                                    <div class="flex items-center gap-1.5 text-[11px] text-slate-500 font-medium mt-0.5">
                                        <span class="truncate max-w-[85px] sm:max-w-[120px]">Ibu {{ $child->mother ?? '-' }}</span>
                                        <span class="w-1 h-1 rounded-full bg-slate-300 shrink-0"></span>
                                        <span class="shrink-0">{{ $child->age }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Right: Compact Status Pill & Action Chevron -->
                            <div class="flex items-center gap-2 shrink-0 ml-2">
                                @if(($child->statusType ?? 'warning') === 'danger')
                                    <div class="flex items-center gap-1.5 bg-rose-50 text-rose-800 px-2.5 py-1 rounded-full border border-rose-200/80 shadow-2xs">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                        <span class="text-[10.5px] font-bold whitespace-nowrap">{{ $child->shortStatus ?? 'Konfirmasi TB' }}</span>
                                    </div>
                                @else
                                    <div class="flex items-center gap-1.5 bg-amber-50 text-amber-800 px-2.5 py-1 rounded-full border border-amber-200/80 shadow-2xs">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 shrink-0"></span>
                                        <span class="text-[10.5px] font-bold whitespace-nowrap">{{ $child->shortStatus ?? 'Pantauan Gizi' }}</span>
                                    </div>
                                @endif

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5 text-slate-300 group-hover:text-teal-600 group-hover:translate-x-0.5 transition-all shrink-0 hidden sm:block">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </div>
                        </a>
                    @empty
                        <div class="flex flex-col items-center justify-center text-slate-400 py-10 gap-2.5 bg-white/60 rounded-2xl border border-slate-200/60 border-dashed">
                            <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center border border-slate-100 text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <span class="text-xs font-semibold text-slate-500">Kondisi Balita Aman & Terpantau</span>
                        </div>
                    @endforelse
                    
                    <a href="{{ route('balita.index') }}" class="flex items-center justify-center gap-2 w-full bg-teal-50/90 hover:bg-teal-100/90 active:bg-teal-200/80 text-teal-800 font-bold text-xs py-3 rounded-2xl text-center border border-teal-200/80 shadow-2xs transition-all mt-0.5 group">
                        <span>Lihat Semua Daftar Balita</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5 text-teal-600 group-hover:translate-x-0.5 transition-transform">
                            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Jadwal Terdekat Section (Live from Database) -->
            <div class="flex flex-col gap-3.5 bg-slate-100/60 p-4 lg:p-6 rounded-[32px] border border-slate-200/50">
                <div class="flex items-center justify-between px-1">
                    <h2 class="text-[15px] font-bold tracking-tight text-slate-800 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-teal-600"><path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd" /></svg>
                        Jadwal Terdekat
                    </h2>
                    <a href="{{ route('jadwal.index') }}" class="text-[12px] font-bold text-teal-700 hover:text-teal-800 transition-colors">
                        Lihat Semua →
                    </a>
                </div>
                
                @if(isset($jadwalTerdekat) && $jadwalTerdekat)
                    <div class="flex flex-col gap-2.5">
                        {{-- Schedule Main Card --}}
                        <a href="{{ route('jadwal.show', $jadwalTerdekat['id']) }}" class="group flex gap-3.5 items-center bg-white p-3.5 sm:p-4 rounded-2xl border border-slate-200/70 hover:border-teal-300 shadow-xs hover:shadow-[0_4px_16px_rgba(13,148,136,0.08)] transition-all">
                            {{-- Mini Calendar Date Tile --}}
                            <div class="flex flex-col items-center justify-center w-11 rounded-xl overflow-hidden border border-slate-200 shadow-xs bg-white shrink-0 group-hover:scale-105 transition-transform">
                                <div class="w-full py-0.5 text-center text-[8.5px] font-black uppercase tracking-wider {{ ($jadwalTerdekat['status_type'] ?? '') === 'today' ? 'bg-amber-500 text-white' : 'bg-teal-600 text-white' }}">
                                    {{ $jadwalTerdekat['tgl_bulan'] ?? 'POS' }}
                                </div>
                                <div class="py-1 px-1 flex flex-col items-center">
                                    <span class="text-[15px] font-black text-slate-800 leading-none">{{ $jadwalTerdekat['tgl_nomor'] ?? '00' }}</span>
                                    <span class="text-[7.5px] font-bold text-slate-400 uppercase tracking-wider mt-0.5">{{ substr($jadwalTerdekat['hari'] ?? 'POS', 0, 3) }}</span>
                                </div>
                            </div>

                            {{-- Schedule Info --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-1.5 mb-0.5">
                                    <span class="font-bold text-slate-800 text-[13.5px] sm:text-[14px] truncate group-hover:text-teal-700 transition-colors">{{ $jadwalTerdekat['judul'] }}</span>
                                </div>
                                <div class="flex flex-wrap items-center gap-x-2 text-[11.5px] text-slate-500 font-medium">
                                    <span class="flex items-center gap-1 text-slate-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3 text-teal-600 shrink-0"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        {{ $jadwalTerdekat['waktu'] }}
                                    </span>
                                    <span class="text-slate-300">•</span>
                                    <span class="text-teal-700 font-bold bg-teal-50 px-1.5 py-0.5 rounded text-[10px]">{{ $jadwalTerdekat['countdown'] }}</span>
                                </div>
                            </div>
                        </a>
                        
                        {{-- Location Card --}}
                        <div class="flex gap-3.5 items-center bg-white p-3.5 sm:p-4 rounded-2xl border border-slate-200/70 shadow-xs">
                            <div class="w-11 h-11 rounded-xl bg-slate-50 text-teal-600 flex items-center justify-center border border-slate-200 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="font-bold text-slate-800 text-[13px]">Lokasi Pelaksanaan</span>
                                <span class="text-[11.5px] text-slate-500 font-medium truncate mt-0.5">{{ $jadwalTerdekat['lokasi'] }}</span>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-white p-5 rounded-2xl border border-slate-200/70 text-center flex flex-col items-center">
                        <div class="w-10 h-10 rounded-xl bg-teal-50 border border-teal-100 flex items-center justify-center text-teal-600 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" /></svg>
                        </div>
                        <p class="text-[13px] font-bold text-slate-700">Belum ada agenda jadwal</p>
                        <p class="text-[11px] text-slate-400 mt-0.5 mb-3">Buat jadwal kegiatan agar terbit di portal orang tua.</p>
                        <a href="{{ route('jadwal.create') }}" class="inline-flex items-center gap-1 text-[11.5px] font-bold bg-teal-600 hover:bg-teal-500 text-white px-3 py-1.5 rounded-lg transition-all shadow-xs">
                            + Buat Jadwal
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
