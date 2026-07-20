@extends('layouts.app')

@section('page-title', 'Jadwal Posyandu')

@section('content')
{{-- 
    CANVAS BACKGROUND 
    Provides strong contrast against the white workspace shell. 
--}}
<div class="-mt-4 lg:mt-0 min-h-screen bg-slate-50/50 pb-24 lg:pb-16 selection:bg-emerald-100 selection:text-emerald-900">
    
    {{-- ── MOBILE: COMPACT STICKY HEADER (Opaque & High Z-Index to prevent overlap) ── --}}
    <div class="md:hidden bg-white sticky -top-4 z-[45] isolate border-b border-slate-200 shadow-sm px-4 py-3 flex items-center justify-between">
        <a href="{{ route('kader.dashboard') }}" 
           class="p-2 -ml-2 bg-slate-50 text-slate-500 hover:text-slate-800 rounded-full transition-colors focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
        </a>
        <div class="flex flex-col items-center">
            <h2 class="text-[15px] font-bold text-slate-800">Jadwal Posyandu</h2>
        </div>
        <div class="w-9"></div> {{-- Spacer for absolute centering --}}
    </div>

    {{-- ── DESKTOP/TABLET: COMPACT HEADER ── --}}
    <div class="hidden md:flex px-4 sm:px-6 lg:px-8 py-5 lg:py-6 max-w-7xl mx-auto w-full items-end justify-between">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">Jadwal Posyandu</h1>
            <p class="text-[13px] sm:text-sm font-medium text-slate-500 mt-1">Kelola dan rencanakan kegiatan operasional Posyandu.</p>
        </div>
        <div class="hidden lg:flex items-center gap-3 mb-1">
            <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-md bg-amber-50/50 border border-amber-200/50">
                <span class="relative flex h-2 w-2">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                </span>
                <span class="text-[10px] font-bold text-amber-700 uppercase tracking-widest">Tahap Perancangan</span>
            </div>
        </div>
    </div>

    {{-- ── MAIN WORKSPACE SHELL ── --}}
    <div class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full mt-4 md:mt-0">
        
        {{-- The White Shell --}}
        <div class="bg-white rounded-[24px] sm:rounded-[32px] shadow-sm ring-1 ring-inset ring-slate-200/60 p-3 sm:p-4">
            
            {{-- The "Pill" Container (Tinted Workspace) --}}
            <div class="bg-gradient-to-br from-slate-50/80 to-slate-50/30 rounded-[20px] sm:rounded-[28px] p-5 sm:p-8 lg:p-12 flex flex-col lg:flex-row gap-10 lg:gap-16 items-center ring-1 ring-inset ring-slate-100/50">
                
                {{-- ── LEFT COLUMN: VISION & ILLUSTRATION ── --}}
                <div class="w-full lg:w-1/2 flex flex-col items-center lg:items-start text-center lg:text-left">
                    
                    {{-- Illustration Composition (Integrated & Soft) --}}
                    <div class="relative w-32 h-32 sm:w-36 sm:h-36 mb-6 shrink-0 group">
                        
                        {{-- Subtle background aura instead of harsh glows --}}
                        <div class="absolute inset-2 bg-gradient-to-tr from-emerald-100 to-sky-50 rounded-full blur-xl opacity-70"></div>
                        
                        {{-- Main Center Icon (Calendar) --}}
                        <div class="absolute inset-0 bg-white rounded-3xl shadow-sm ring-1 ring-slate-200/50 flex items-center justify-center transition-transform hover:scale-105 duration-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="w-14 h-14 text-emerald-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                            </svg>
                        </div>
                            
                        {{-- Notification Bell Accent (Integrated into corner) --}}
                        <div class="absolute -top-1.5 -right-1.5 w-10 h-10 bg-gradient-to-br from-amber-50 to-white text-amber-500 rounded-xl flex items-center justify-center shadow-sm ring-1 ring-amber-100/80 transition-transform group-hover:-rotate-12 duration-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                            </svg>
                        </div>

                        {{-- Healthcare Check Accent (Integrated into corner) --}}
                        <div class="absolute -bottom-1.5 -left-1.5 w-10 h-10 bg-gradient-to-br from-sky-50 to-white text-sky-500 rounded-xl flex items-center justify-center shadow-sm ring-1 ring-sky-100/80 transition-transform group-hover:rotate-12 duration-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        </div>
                    </div>

                    {{-- Roadmap Badge --}}
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-emerald-100/50 text-emerald-700 text-[10px] font-bold uppercase tracking-widest rounded-full mb-5 ring-1 ring-inset ring-emerald-200/50">
                        <span class="relative flex h-2 w-2">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        Planned For Next Release
                    </div>
                    
                    {{-- Typography & Vision --}}
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-800 tracking-tight mb-3 leading-tight">Asisten Penjadwalan Pintar</h2>
                    <p class="text-[14px] sm:text-[15px] lg:text-[15px] text-slate-500 leading-relaxed font-medium mb-8 max-w-md mx-auto lg:mx-0">
                        Kami sedang merancang asisten cerdas untuk menyusun jadwal imunisasi dan penimbangan secara otomatis, agar tugas Posyandu menjadi jauh lebih ringan.
                    </p>

                    {{-- Action CTA --}}
                    <a href="{{ route('balita.index') }}" class="group inline-flex items-center justify-center h-11 sm:h-12 px-6 sm:px-7 bg-emerald-600 hover:bg-emerald-500 active:bg-emerald-700 text-white rounded-xl font-bold text-[14px] shadow-sm shadow-emerald-500/20 hover:shadow-md hover:-translate-y-[1px] transition-all duration-300 gap-2 focus:outline-none focus:ring-4 focus:ring-emerald-500/30 w-full sm:w-max whitespace-nowrap">
                        Kelola Data Balita
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5 sm:w-4 sm:h-4 transition-transform duration-300 group-hover:translate-x-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>

                {{-- ── RIGHT COLUMN: FEATURE PREVIEW ── --}}
                <div class="w-full lg:w-1/2 flex flex-col gap-4 mt-4 lg:mt-0">
                    <h3 class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-1 text-center lg:text-left">Sneak Peek Fitur Utama</h3>
                    
                    {{-- Features Container --}}
                    <div class="flex flex-col gap-3 sm:gap-4 mt-2 lg:mt-3">
                        
                        {{-- Feature 1 (Emerald) --}}
                        <div class="bg-gradient-to-r from-emerald-50/40 to-transparent rounded-2xl p-4 sm:p-5 ring-1 ring-inset ring-emerald-100/50 flex items-start gap-4 sm:gap-5 transition-transform hover:-translate-y-0.5 duration-300 hover:shadow-sm">
                            <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-white text-emerald-600 flex flex-shrink-0 items-center justify-center shadow-sm ring-1 ring-inset ring-emerald-200/50">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-[14px] sm:text-[15px] font-bold text-slate-800 leading-snug">Sistem Penjadwalan Otomatis</h4>
                                <p class="text-[13px] text-slate-500 mt-1 leading-relaxed">Menyusun jadwal kegiatan bulanan berdasarkan siklus KMS tanpa perlu catat manual.</p>
                            </div>
                        </div>

                        {{-- Feature 2 (Sky) --}}
                        <div class="bg-gradient-to-r from-sky-50/40 to-transparent rounded-2xl p-4 sm:p-5 ring-1 ring-inset ring-sky-100/50 flex items-start gap-4 sm:gap-5 transition-transform hover:-translate-y-0.5 duration-300 hover:shadow-sm">
                            <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-white text-sky-600 flex flex-shrink-0 items-center justify-center shadow-sm ring-1 ring-inset ring-sky-200/50">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-[14px] sm:text-[15px] font-bold text-slate-800 leading-snug">Notifikasi Pintar WhatsApp</h4>
                                <p class="text-[13px] text-slate-500 mt-1 leading-relaxed">Kirim pengingat jadwal posyandu langsung ke gawai orang tua balita secara terpusat.</p>
                            </div>
                        </div>

                        {{-- Feature 3 (Amber) --}}
                        <div class="bg-gradient-to-r from-amber-50/40 to-transparent rounded-2xl p-4 sm:p-5 ring-1 ring-inset ring-amber-100/50 flex items-start gap-4 sm:gap-5 transition-transform hover:-translate-y-0.5 duration-300 hover:shadow-sm">
                            <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-white text-amber-600 flex flex-shrink-0 items-center justify-center shadow-sm ring-1 ring-inset ring-amber-200/50">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-[14px] sm:text-[15px] font-bold text-slate-800 leading-snug">Rekapitulasi Partisipasi</h4>
                                <p class="text-[13px] text-slate-500 mt-1 leading-relaxed">Pantau tren partisipasi bulanan dan tingkat kehadiran dalam satu dasbor visual terpadu.</p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
