@extends('layouts.app')

@section('page-title', isset($isEdit) && $isEdit ? 'Edit Data Balita' : 'Daftar Balita Baru')

@section('content')
<div class="min-h-screen bg-slate-50/50 pb-24 lg:pb-16 selection:bg-teal-100 selection:text-teal-900">

    {{-- Script for Framer Motion --}}
    <script type="module">
        document.addEventListener('DOMContentLoaded', () => {
            if(window.Motion) {
                const { animate, stagger } = window.Motion;
                animate('.motion-card', 
                    { opacity: [0, 1], y: [20, 0] }, 
                    { delay: stagger(0.05), duration: 0.4, easing: "ease-out" }
                );
            }
        });
    </script>

    {{-- ── 1. MOBILE: COMPACT STICKY HEADER (Glassmorphism Teal) ── --}}
    <div class="md:hidden bg-gradient-to-r from-teal-700/95 to-teal-600/95 backdrop-blur-xl sticky top-0 z-[45] shadow-sm border-b border-teal-500/30 px-4 py-3 flex items-center justify-between overflow-hidden relative">
        
        {{-- Subtle Dot Texture --}}
        <div class="absolute inset-0 opacity-[0.08] pointer-events-none bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:12px_12px]"></div>

        <a href="{{ !empty($isEdit) ? route('balita.show', $balitaId ?? '') : route('balita.index') }}" 
           class="p-2 -ml-1 bg-white/15 border border-white/20 text-white hover:bg-white/30 rounded-full backdrop-blur-sm shadow-sm transition-colors focus:outline-none relative z-10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
        </a>
        <div class="flex flex-col items-center relative z-10 mt-0.5">
            <h2 class="text-[14px] font-bold tracking-tight text-white leading-tight">{{ $childName ?? 'Pendaftaran Balita' }}</h2>
            <div class="flex items-center gap-1.5 mt-1.5 mb-1">
                <div class="w-1.5 h-1.5 rounded-full bg-white shadow-sm"></div>
                <div class="w-1.5 h-1.5 rounded-full bg-white/30"></div>
                <div class="w-1.5 h-1.5 rounded-full bg-white/30"></div>
            </div>
        </div>
        <div class="w-9 relative z-10"></div> {{-- Spacer for absolute centering --}}
    </div>

    {{-- ── 2. TABLET: COMPACT STATIC CONTEXT (Above Workspace) ── --}}
    <div class="hidden md:flex lg:hidden flex-col items-center text-center px-6 pt-10 pb-4 motion-card opacity-0">
        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-teal-500 to-teal-600 ring-teal-50 shadow-inner flex items-center justify-center text-white mb-4 ring-4">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                @if(isset($isEdit) && $isEdit)
                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                @else
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 9a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25V15a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V9z" clip-rule="evenodd" />
                @endif
            </svg>
        </div>
        <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight mb-1">
            {{ isset($isEdit) && $isEdit ? ($childName ?? 'Profil Balita') : 'Daftar Balita Baru' }}
        </h1>
        <p class="text-sm font-medium text-slate-500">
            {{ isset($isEdit) && $isEdit ? 'Kelola data master dan informasi keluarga.' : 'Tambahkan balita baru ke ekosistem Posyandu.' }}
        </p>
    </div>

    {{-- ── MAIN LAYOUT CONTAINER ── --}}
    <div class="max-w-6xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-6 md:py-8 lg:py-16 flex flex-col lg:flex-row gap-8 lg:gap-12 relative z-10 isolate">
        
        {{-- ── 3. DESKTOP: LEFT STICKY CONTEXT PANEL (Redesigned with Depth) ── --}}
        <div class="hidden lg:block lg:w-1/3 flex-shrink-0">
            <div class="sticky top-12 max-h-[calc(100vh-6rem)] overflow-y-auto pb-8 scrollbar-hide">
                
                {{-- Left Context Card --}}
                <div class="bg-white rounded-[32px] p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 motion-card opacity-0">
                    
                    {{-- Back Action --}}
                    <a href="{{ !empty($isEdit) ? route('balita.show', $balitaId ?? '') : route('balita.index') }}" 
                       class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-teal-600 bg-slate-50 px-4 py-2 rounded-xl transition-colors mb-10 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                        Kembali
                    </a>

                    {{-- Desktop Context Hero (Fixed Blue Colors to Teal) --}}
                    <div class="mb-10">
                        <div class="w-20 h-20 rounded-[1.25rem] bg-gradient-to-br from-teal-500 to-teal-600 ring-teal-50 shadow-inner flex items-center justify-center text-white mb-6 ring-4">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                                @if(isset($isEdit) && $isEdit)
                                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                                @else
                                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 9a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25V15a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V9z" clip-rule="evenodd" />
                                @endif
                            </svg>
                        </div>
                        <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight leading-tight mb-3">
                            {{ isset($isEdit) && $isEdit ? ($childName ?? 'Profil Balita') : 'Daftar Balita Baru' }}
                        </h1>
                        <p class="text-base font-medium text-slate-500 leading-relaxed">
                            {{ isset($isEdit) && $isEdit ? 'Kelola data master dan riwayat balita.' : 'Tambahkan balita baru ke ekosistem Posyandu.' }}
                        </p>
                    </div>

                    {{-- Visual Progress Stepper (Redesigned) --}}
                    <div>
                        <div class="text-[11px] font-extrabold text-slate-400 uppercase tracking-widest mb-6">Alur Pengisian</div>
                        <nav class="relative border-l-2 border-slate-100 ml-3">
                            <!-- Step 1: Active -->
                            <div class="mb-8 relative">
                                <div class="absolute -left-[25px] top-0 w-12 h-12 rounded-full bg-white border-[4px] border-white flex items-center justify-center">
                                    <div class="w-full h-full rounded-full bg-teal-100 text-teal-600 flex items-center justify-center font-bold text-sm shadow-sm ring-1 ring-inset ring-teal-200">1</div>
                                </div>
                                <div class="pl-10">
                                    <h3 class="text-[15px] font-bold text-slate-800">Identitas Anak</h3>
                                    <p class="text-[13px] text-slate-500 font-medium mt-1">Nama, NIK, Tgl Lahir</p>
                                </div>
                            </div>
                            
                            <!-- Step 2: Pending -->
                            <div class="mb-8 relative">
                                <div class="absolute -left-[21px] top-1 w-10 h-10 rounded-full bg-white border-[4px] border-white flex items-center justify-center">
                                    <div class="w-full h-full rounded-full bg-slate-50 text-slate-400 flex items-center justify-center font-bold text-sm ring-1 ring-inset ring-slate-200">2</div>
                                </div>
                                <div class="pl-10 pt-1">
                                    <h3 class="text-[15px] font-semibold text-slate-500">Orang Tua / Wali</h3>
                                </div>
                            </div>

                            <!-- Step 3: Pending -->
                            <div class="mb-8 relative">
                                <div class="absolute -left-[21px] top-1 w-10 h-10 rounded-full bg-white border-[4px] border-white flex items-center justify-center">
                                    <div class="w-full h-full rounded-full bg-slate-50 text-slate-400 flex items-center justify-center font-bold text-sm ring-1 ring-inset ring-slate-200">3</div>
                                </div>
                                <div class="pl-10 pt-1">
                                    <h3 class="text-[15px] font-semibold text-slate-500">Lokasi & Posyandu</h3>
                                </div>
                            </div>
                            
                            <!-- Finish Action -->
                            <div class="relative pt-2">
                                <div class="absolute -left-[17px] top-3 w-8 h-8 rounded-full bg-white flex items-center justify-center">
                                    <div class="w-3 h-3 rounded-full bg-slate-300 ring-4 ring-white"></div>
                                </div>
                                <div class="pl-10">
                                    <h3 class="text-[14px] font-semibold text-slate-400">Penyelesaian</h3>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        {{-- 
            RIGHT COLUMN: INDEPENDENT CARDS
        --}}
        <div class="w-full lg:w-2/3">
            
            <form action="{{ isset($isEdit) && $isEdit ? route('balita.update', $balitaId) : route('balita.store') }}" method="POST"
                  class="flex flex-col gap-6 lg:gap-8">
                @csrf
                @if(isset($isEdit) && $isEdit)
                    @method('PUT')
                @endif
                
                {{-- ════════════════════════════════════════════════════════════
                     1. IDENTITAS BALITA & KELAHIRAN (Standar Buku KIA / KMS)
                ═══════════════════════════════════════════════════════════════ --}}
                <div id="identitas" class="flex flex-col bg-white p-6 lg:p-8 rounded-[24px] shadow-[0_8px_30px_rgb(0,0,0,0.08)] border border-slate-200/60 scroll-mt-32 motion-card opacity-0">
                    
                    <h2 class="text-[15px] font-semibold tracking-tight text-slate-800 flex items-center gap-2 px-1 mb-6">
                        <div class="w-8 h-8 rounded-lg bg-teal-100 text-teal-600 flex items-center justify-center shrink-0 font-bold">1</div>
                        Identitas Balita & Kelahiran
                    </h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 lg:gap-8">
                        
                        {{-- Nama Lengkap (Full Width) --}}
                        <div class="flex flex-col gap-2 group/input sm:col-span-2">
                            <label for="nama_balita" class="text-xs font-medium text-slate-500 tracking-wide uppercase flex items-center ml-1">
                                NAMA LENGKAP BALITA <sup class="text-rose-400 font-bold ml-1 text-[14px] top-[-2px]">*</sup>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-teal-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                                </div>
                                <input type="text" id="nama_balita" name="nama" value="{{ old('nama', $childName ?? '') }}" required placeholder="Contoh: Budi Santoso" autocomplete="off"
                                    class="w-full bg-slate-50/80 border border-slate-200 text-slate-900 rounded-2xl pl-12 pr-4 py-3.5 focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white hover:bg-slate-50 transition-all duration-300 text-[15px] font-medium placeholder-slate-400 outline-none">
                            </div>
                            @error('nama') <p class="text-[12px] text-rose-500 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- NIK Balita (Half Width on SM) --}}
                        <div class="flex flex-col gap-2 group/input">
                            <label for="nik_balita" class="text-xs font-medium text-slate-500 tracking-wide uppercase flex items-center ml-1">
                                NIK BALITA <sup class="text-rose-400 font-bold ml-1 text-[14px] top-[-2px]">*</sup>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-teal-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" /></svg>
                                </div>
                                <input type="text" id="nik_balita" name="nik" value="{{ old('nik', $nik ?? '') }}" required placeholder="16 digit NIK Balita" maxlength="16" inputmode="numeric"
                                    class="w-full bg-slate-50/80 border border-slate-200 text-slate-900 rounded-2xl pl-12 pr-4 py-3.5 focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white hover:bg-slate-50 transition-all duration-300 text-[15px] font-medium placeholder-slate-400 outline-none">
                            </div>
                            @error('nik') <p class="text-[12px] text-rose-500 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- No. BPJS / JKN (Half Width on SM) --}}
                        <div class="flex flex-col gap-2 group/input">
                            <label for="no_bpjs" class="text-xs font-medium text-slate-500 tracking-wide uppercase flex items-center justify-between ml-1">
                                <span>NO. BPJS / JKN</span>
                                <span class="text-[9px] font-bold text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full tracking-wider">OPSIONAL</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-teal-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                                <input type="text" id="no_bpjs" name="no_bpjs" value="{{ old('no_bpjs', $noBpjs ?? '') }}" placeholder="Nomor Kartu BPJS"
                                    class="w-full bg-slate-50/80 border border-slate-200 text-slate-900 rounded-2xl pl-12 pr-4 py-3.5 focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white hover:bg-slate-50 transition-all duration-300 text-[15px] font-medium placeholder-slate-400 outline-none">
                            </div>
                            @error('no_bpjs') <p class="text-[12px] text-rose-500 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Tanggal Lahir (Half Width) --}}
                        <div class="flex flex-col gap-2 group/input">
                            <label for="tanggal_lahir" class="text-xs font-medium text-slate-500 tracking-wide uppercase flex items-center ml-1">
                                TANGGAL LAHIR <sup class="text-rose-400 font-bold ml-1 text-[14px] top-[-2px]">*</sup>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-teal-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" /></svg>
                                </div>
                                <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $birthDate ?? '') }}" required
                                    class="w-full bg-slate-50/80 border border-slate-200 text-slate-900 rounded-2xl pl-12 pr-4 py-3.5 focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white hover:bg-slate-50 transition-all duration-300 text-[15px] font-medium outline-none text-slate-800">
                            </div>
                            @error('tanggal_lahir') <p class="text-[12px] text-rose-500 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Jenis Kelamin (Half Width) --}}
                        <div class="flex flex-col gap-2 group/input">
                            <label for="jenis_kelamin" class="text-xs font-medium text-slate-500 tracking-wide uppercase flex items-center ml-1">
                                JENIS KELAMIN <sup class="text-rose-400 font-bold ml-1 text-[14px] top-[-2px]">*</sup>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-teal-600 z-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                                </div>
                                
                                <select id="jenis_kelamin" name="jenis_kelamin" required
                                        class="w-full bg-slate-50/80 border border-slate-200 text-slate-900 rounded-2xl pl-12 pr-10 py-3.5 focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white hover:bg-slate-50 transition-all duration-300 text-[15px] font-medium appearance-none outline-none cursor-pointer">
                                    <option value="" disabled {{ empty(old('jenis_kelamin', $gender ?? '')) ? 'selected' : '' }}>Pilih kelamin</option>
                                    <option value="L" {{ old('jenis_kelamin', $gender ?? '') === 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin', $gender ?? '') === 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                                </div>
                            </div>
                            @error('jenis_kelamin') <p class="text-[12px] text-rose-500 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Sub-Card: Antropometri Saat Lahir (KMS) --}}
                        <div class="sm:col-span-2 bg-slate-50/70 border border-slate-200/70 rounded-2xl p-4 lg:p-5 mt-2">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-xs font-bold text-slate-700 uppercase tracking-wider">Antropometri Saat Lahir (Buku KIA / KMS)</span>
                            </div>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                {{-- Berat Lahir --}}
                                <div class="flex flex-col gap-1.5">
                                    <label for="berat_lahir" class="text-[11px] font-semibold text-slate-500">Berat Lahir (kg)</label>
                                    <div class="relative flex items-center">
                                        <input type="text" inputmode="decimal" id="berat_lahir" name="berat_lahir" value="{{ old('berat_lahir', $birthWeight ?? '') }}" placeholder="Contoh: 3.20"
                                            class="w-full bg-white border border-slate-200 text-slate-900 rounded-xl px-3.5 py-2.5 pr-10 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 text-sm font-semibold outline-none">
                                        <span class="absolute right-3 text-xs font-semibold text-slate-400 pointer-events-none">kg</span>
                                    </div>
                                    @error('berat_lahir') <p class="text-[11px] text-rose-500 mt-0.5">{{ $message }}</p> @enderror
                                </div>

                                {{-- Panjang Lahir --}}
                                <div class="flex flex-col gap-1.5">
                                    <label for="panjang_lahir" class="text-[11px] font-semibold text-slate-500">Panjang Lahir (cm)</label>
                                    <div class="relative flex items-center">
                                        <input type="text" inputmode="decimal" id="panjang_lahir" name="panjang_lahir" value="{{ old('panjang_lahir', $birthLength ?? '') }}" placeholder="Contoh: 49.5"
                                            class="w-full bg-white border border-slate-200 text-slate-900 rounded-xl px-3.5 py-2.5 pr-10 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 text-sm font-semibold outline-none">
                                        <span class="absolute right-3 text-xs font-semibold text-slate-400 pointer-events-none">cm</span>
                                    </div>
                                    @error('panjang_lahir') <p class="text-[11px] text-rose-500 mt-0.5">{{ $message }}</p> @enderror
                                </div>

                                {{-- Lingkar Kepala Lahir --}}
                                <div class="flex flex-col gap-1.5">
                                    <label for="lingkar_kepala_lahir" class="text-[11px] font-semibold text-slate-500">Lingkar Kepala Lahir (cm)</label>
                                    <div class="relative flex items-center">
                                        <input type="text" inputmode="decimal" id="lingkar_kepala_lahir" name="lingkar_kepala_lahir" value="{{ old('lingkar_kepala_lahir', $birthHeadCirc ?? '') }}" placeholder="Contoh: 33.0"
                                            class="w-full bg-white border border-slate-200 text-slate-900 rounded-xl px-3.5 py-2.5 pr-10 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 text-sm font-semibold outline-none">
                                        <span class="absolute right-3 text-xs font-semibold text-slate-400 pointer-events-none">cm</span>
                                    </div>
                                    @error('lingkar_kepala_lahir') <p class="text-[11px] text-rose-500 mt-0.5">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- ════════════════════════════════════════════════════════════
                     2. DATA ORANG TUA / KELUARGA (Standar Buku KIA / KMS)
                ═══════════════════════════════════════════════════════════════ --}}
                <div id="orangtua" class="flex flex-col bg-white p-6 lg:p-8 rounded-[24px] shadow-[0_8px_30px_rgb(0,0,0,0.08)] border border-slate-200/60 scroll-mt-32 motion-card opacity-0">
                    
                    <h2 class="text-[15px] font-semibold tracking-tight text-slate-800 flex items-center gap-2 px-1 mb-6">
                        <div class="w-8 h-8 rounded-lg bg-teal-100 text-teal-600 flex items-center justify-center shrink-0 font-bold">2</div>
                        Data Orang Tua / Keluarga
                    </h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 lg:gap-8">
                        
                        {{-- No. Kartu Keluarga (Full Width) --}}
                        <div class="flex flex-col gap-2 group/input sm:col-span-2">
                            <label for="no_kk" class="text-xs font-medium text-slate-500 tracking-wide uppercase flex items-center justify-between ml-1">
                                <span>NO. KARTU KELUARGA (KK)</span>
                                <span class="text-[9px] font-bold text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full tracking-wider">OPSIONAL</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-teal-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>
                                </div>
                                <input type="text" id="no_kk" name="no_kk" value="{{ old('no_kk', $noKk ?? '') }}" placeholder="16 digit Nomor Kartu Keluarga" maxlength="16" inputmode="numeric"
                                       class="w-full bg-slate-50/80 border border-slate-200 text-slate-900 rounded-2xl pl-12 pr-4 py-3.5 focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white hover:bg-slate-50 transition-all duration-300 text-[15px] font-medium placeholder-slate-400 outline-none">
                            </div>
                            @error('no_kk') <p class="text-[12px] text-rose-500 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Section: Data Ibu --}}
                        <div class="sm:col-span-2 border-t border-slate-100 pt-4">
                            <span class="text-xs font-bold text-teal-700 uppercase tracking-wider">Identitas Ibu Kandung</span>
                        </div>

                        {{-- Nama Ibu (Full Width on SM) --}}
                        <div class="flex flex-col gap-2 group/input">
                            <label for="nama_ibu" class="text-xs font-medium text-slate-500 tracking-wide uppercase flex items-center ml-1">
                                NAMA IBU <sup class="text-rose-400 font-bold ml-1 text-[14px] top-[-2px]">*</sup>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-teal-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                                </div>
                                <input type="text" id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu', $motherName ?? '') }}" required placeholder="Contoh: Siti Aminah"
                                       class="w-full bg-slate-50/80 border border-slate-200 text-slate-900 rounded-2xl pl-12 pr-4 py-3.5 focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white hover:bg-slate-50 transition-all duration-300 text-[15px] font-medium placeholder-slate-400 outline-none">
                            </div>
                            @error('nama_ibu') <p class="text-[12px] text-rose-500 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- NIK Ibu (Half Width) --}}
                        <div class="flex flex-col gap-2 group/input">
                            <label for="nik_ibu" class="text-xs font-medium text-slate-500 tracking-wide uppercase flex items-center justify-between ml-1">
                                <span>NIK IBU</span>
                                <span class="text-[9px] font-bold text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full tracking-wider">OPSIONAL</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-teal-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" /></svg>
                                </div>
                                <input type="text" id="nik_ibu" name="nik_ibu" value="{{ old('nik_ibu', $motherNik ?? '') }}" placeholder="16 digit NIK Ibu" maxlength="16" inputmode="numeric"
                                       class="w-full bg-slate-50/80 border border-slate-200 text-slate-900 rounded-2xl pl-12 pr-4 py-3.5 focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white hover:bg-slate-50 transition-all duration-300 text-[15px] font-medium placeholder-slate-400 outline-none">
                            </div>
                            @error('nik_ibu') <p class="text-[12px] text-rose-500 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- No HP WhatsApp Ibu (Half Width) --}}
                        <div class="flex flex-col gap-2 group/input">
                            <label for="no_hp_ibu" class="text-xs font-medium text-slate-500 tracking-wide uppercase flex items-center ml-1">
                                NOMOR WHATSAPP IBU <sup class="text-rose-400 font-bold ml-1 text-[14px] top-[-2px]">*</sup>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-teal-600 transition-colors duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                    </svg>
                                </div>
                                <div class="absolute inset-y-0 left-12 flex items-center pointer-events-none border-r border-slate-200 pr-4 my-2">
                                    <span class="text-slate-800 font-medium text-[15px] pl-0.5">+62</span>
                                </div>
                                <input type="tel" id="no_hp_ibu" name="no_hp" value="{{ str_starts_with(old('no_hp', $motherPhone ?? ''), '+62') ? substr(old('no_hp', $motherPhone ?? ''), 3) : (str_starts_with(old('no_hp', $motherPhone ?? ''), '0') ? substr(old('no_hp', $motherPhone ?? ''), 1) : old('no_hp', $motherPhone ?? '')) }}" required placeholder="8123456789" inputmode="tel"
                                       class="w-full bg-slate-50/80 border border-slate-200 text-slate-900 rounded-2xl pl-[104px] pr-4 py-3.5 focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white hover:bg-slate-50 transition-all duration-300 text-[15px] font-medium placeholder-slate-400 outline-none">
                            </div>
                            @error('no_hp') <p class="text-[12px] text-rose-500 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Pekerjaan Ibu (Half Width) --}}
                        <div class="flex flex-col gap-2 group/input">
                            <label for="pekerjaan_ibu" class="text-xs font-medium text-slate-500 tracking-wide uppercase flex items-center justify-between ml-1">
                                <span>PEKERJAAN IBU</span>
                                <span class="text-[9px] font-bold text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full tracking-wider">OPSIONAL</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-teal-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                </div>
                                <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu', $motherJob ?? '') }}" placeholder="Contoh: Ibu Rumah Tangga / Guru"
                                       class="w-full bg-slate-50/80 border border-slate-200 text-slate-900 rounded-2xl pl-12 pr-4 py-3.5 focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white hover:bg-slate-50 transition-all duration-300 text-[15px] font-medium placeholder-slate-400 outline-none">
                            </div>
                            @error('pekerjaan_ibu') <p class="text-[12px] text-rose-500 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Section: Data Ayah --}}
                        <div class="sm:col-span-2 border-t border-slate-100 pt-4">
                            <span class="text-xs font-bold text-teal-700 uppercase tracking-wider">Identitas Ayah Kandung</span>
                        </div>

                        {{-- Nama Ayah (Half Width) --}}
                        <div class="flex flex-col gap-2 group/input">
                            <label for="nama_ayah" class="text-xs font-medium text-slate-500 tracking-wide uppercase flex items-center justify-between ml-1">
                                <span>NAMA AYAH</span>
                                <span class="text-[9px] font-bold text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full tracking-wider">OPSIONAL</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-teal-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                                </div>
                                <input type="text" id="nama_ayah" name="nama_ayah" value="{{ old('nama_ayah', $fatherName ?? '') }}" placeholder="Contoh: Ahmad Fauzi"
                                       class="w-full bg-slate-50/80 border border-slate-200 text-slate-900 rounded-2xl pl-12 pr-4 py-3.5 focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white hover:bg-slate-50 transition-all duration-300 text-[15px] font-medium placeholder-slate-400 outline-none">
                            </div>
                            @error('nama_ayah') <p class="text-[12px] text-rose-500 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- NIK Ayah (Half Width) --}}
                        <div class="flex flex-col gap-2 group/input">
                            <label for="nik_ayah" class="text-xs font-medium text-slate-500 tracking-wide uppercase flex items-center justify-between ml-1">
                                <span>NIK AYAH</span>
                                <span class="text-[9px] font-bold text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full tracking-wider">OPSIONAL</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-teal-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" /></svg>
                                </div>
                                <input type="text" id="nik_ayah" name="nik_ayah" value="{{ old('nik_ayah', $fatherNik ?? '') }}" placeholder="16 digit NIK Ayah" maxlength="16" inputmode="numeric"
                                       class="w-full bg-slate-50/80 border border-slate-200 text-slate-900 rounded-2xl pl-12 pr-4 py-3.5 focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white hover:bg-slate-50 transition-all duration-300 text-[15px] font-medium placeholder-slate-400 outline-none">
                            </div>
                            @error('nik_ayah') <p class="text-[12px] text-rose-500 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Pekerjaan Ayah (Full Width on SM) --}}
                        <div class="flex flex-col gap-2 group/input sm:col-span-2">
                            <label for="pekerjaan_ayah" class="text-xs font-medium text-slate-500 tracking-wide uppercase flex items-center justify-between ml-1">
                                <span>PEKERJAAN AYAH</span>
                                <span class="text-[9px] font-bold text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full tracking-wider">OPSIONAL</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-teal-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                </div>
                                <input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah', $fatherJob ?? '') }}" placeholder="Contoh: Karyawan Swasta / Wiraswasta"
                                       class="w-full bg-slate-50/80 border border-slate-200 text-slate-900 rounded-2xl pl-12 pr-4 py-3.5 focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white hover:bg-slate-50 transition-all duration-300 text-[15px] font-medium placeholder-slate-400 outline-none">
                            </div>
                            @error('pekerjaan_ayah') <p class="text-[12px] text-rose-500 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                    </div>
                </div>

                {{-- ════════════════════════════════════════════════════════════
                     3. LOKASI & POSYANDU
                ═══════════════════════════════════════════════════════════════ --}}
                <div id="lokasi" class="flex flex-col bg-white p-6 lg:p-8 rounded-[24px] shadow-[0_8px_30px_rgb(0,0,0,0.08)] border border-slate-200/60 scroll-mt-32 motion-card opacity-0">
                    
                    <h2 class="text-[15px] font-semibold tracking-tight text-slate-800 flex items-center gap-2 px-1 mb-6">
                        <div class="w-8 h-8 rounded-lg bg-teal-100 text-teal-600 flex items-center justify-center shrink-0 font-bold">3</div>
                        Lokasi & Posyandu
                    </h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 lg:gap-8">
                        
                        {{-- Desa / Kelurahan (Half Width) --}}
                        <div class="flex flex-col gap-2 group/input">
                            <label for="desa" class="text-xs font-medium text-slate-500 tracking-wide uppercase flex items-center justify-between ml-1">
                                <span>DESA / KELURAHAN</span>
                                <span class="text-[9px] font-bold text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full tracking-wider">OPSIONAL</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-teal-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6.75h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" /></svg>
                                </div>
                                <input type="text" id="desa" name="desa" value="{{ old('desa', $address ?? '') }}" placeholder="Nama desa"
                                       class="w-full bg-slate-50/80 border border-slate-200 text-slate-900 rounded-2xl pl-12 pr-4 py-3.5 focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white hover:bg-slate-50 transition-all duration-300 text-[15px] font-medium placeholder-slate-400 outline-none">
                            </div>
                            @error('desa') <p class="text-[12px] text-rose-500 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Kecamatan (Half Width) --}}
                        <div class="flex flex-col gap-2 group/input">
                            <label for="kecamatan" class="text-xs font-medium text-slate-500 tracking-wide uppercase flex items-center justify-between ml-1">
                                <span>KECAMATAN</span>
                                <span class="text-[9px] font-bold text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full tracking-wider">OPSIONAL</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-teal-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                                </div>
                                <input type="text" id="kecamatan" name="kecamatan" value="{{ old('kecamatan', $addressSub ?? '') }}" placeholder="Nama kecamatan"
                                       class="w-full bg-slate-50/80 border border-slate-200 text-slate-900 rounded-2xl pl-12 pr-4 py-3.5 focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white hover:bg-slate-50 transition-all duration-300 text-[15px] font-medium placeholder-slate-400 outline-none">
                            </div>
                            @error('kecamatan') <p class="text-[12px] text-rose-500 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Posyandu Pendaftar (Full Width Read Only) --}}
                        <div class="flex flex-col gap-2 group/input sm:col-span-2">
                            <label class="text-xs font-medium text-slate-500 tracking-wide uppercase ml-1">POSYANDU PENDAFTAR</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-emerald-600/60">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" /></svg>
                                </div>
                                <input type="text" value="{{ $posyanduName ?? 'Posyandu Kader' }}" disabled readonly
                                       class="w-full bg-slate-100/50 border border-slate-200/80 text-slate-500 rounded-2xl pl-12 pr-4 py-3.5 text-[15px] font-medium cursor-not-allowed opacity-80 outline-none shadow-inner">
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <span class="text-[10px] font-bold bg-slate-200/50 text-slate-500 px-2 py-1 rounded-md uppercase tracking-wider hidden sm:block">Otomatis</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- ════════════════════════════════════════════════════════════
                     4. CLIMAX: PENYELESAIAN (SAVE ACTION)
                ═══════════════════════════════════════════════════════════════ --}}
                <div id="simpan" class="bg-white rounded-[24px] p-6 sm:p-8 flex flex-col-reverse sm:flex-row items-center justify-between gap-6 scroll-mt-32 shadow-[0_4px_20px_rgb(0,0,0,0.05)] border border-slate-200/60 motion-card opacity-0 mt-2 mb-8">
                    
                    <div class="flex items-center gap-4 w-full sm:w-auto">
                        <div class="w-12 h-12 rounded-2xl bg-teal-50 flex items-center justify-center text-teal-600 shrink-0 hidden sm:flex font-bold ring-1 ring-inset ring-teal-100">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                        </div>
                        <div class="text-center sm:text-left w-full sm:w-auto">
                            <h3 class="text-[15px] font-bold tracking-tight text-slate-800 hidden sm:block">Siap Disimpan?</h3>
                            <p class="text-[13px] text-slate-500">Pastikan seluruh data wajib (<span class="text-rose-400 font-bold">*</span>) telah terisi benar.</p>
                        </div>
                    </div>
                    
                    <button type="submit" 
                            class="w-full sm:w-auto px-10 py-4 bg-teal-600 hover:bg-teal-500 active:bg-teal-700 text-white rounded-2xl font-bold text-[15px] transition-all duration-300 shadow-[0_8px_16px_-6px_rgba(20,184,166,0.3)] hover:shadow-[0_12px_20px_-8px_rgba(20,184,166,0.4)] hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-teal-500/30 active:scale-[0.98] flex items-center justify-center gap-2.5 group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 text-teal-50 group-hover:scale-110 transition-transform duration-300"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                        <span>{{ isset($isEdit) && $isEdit ? 'Simpan Profil Balita' : 'Daftarkan Balita' }}</span>
                    </button>

                </div>

            </form>
        </div>
    </div>
</div>
@endsection
