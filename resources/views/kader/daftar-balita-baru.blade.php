@extends('layouts.app')

@section('page-title', isset($isEdit) && $isEdit ? 'Edit Data Balita' : 'Daftar Balita Baru')

@section('content')
{{-- 
    CANVAS BACKGROUND 
    Provides strong contrast against the white workspace. 
    Eliminates the "White-on-White" eye fatigue.
--}}
<div class="-mt-4 lg:mt-0 min-h-screen bg-slate-50/50 pb-24 lg:pb-16 selection:bg-emerald-100 selection:text-emerald-900">

    {{-- ── 1. MOBILE: COMPACT STICKY HEADER (Glassmorphism Emerald) ── --}}
    <div class="md:hidden bg-gradient-to-r from-emerald-600/85 to-emerald-500/85 backdrop-blur-xl sticky -top-4 z-[45] isolate shadow-[0_4px_20px_-10px_rgba(16,185,129,0.3)] border-b border-emerald-400/30 px-4 py-3 flex items-center justify-between">
        <a href="{{ !empty($isEdit) ? route('balita.show', $balitaId ?? '') : route('balita.index') }}" 
           class="p-2 -ml-2 bg-white/20 text-white hover:bg-white/30 rounded-full backdrop-blur-sm transition-colors focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
        </a>
        <div class="flex flex-col items-center">
            <h2 class="text-[15px] font-bold text-white">{{ $childName ?? 'Balita Baru' }}</h2>
            <div class="text-[10px] font-bold tracking-widest uppercase text-emerald-100 mt-0.5">
                {{ isset($isEdit) && $isEdit ? 'Mode Edit' : 'Pendaftaran' }}
            </div>
        </div>
        <div class="w-9"></div> {{-- Spacer for absolute centering --}}
    </div>

    {{-- ── 2. TABLET: COMPACT STATIC CONTEXT (Above Workspace) ── --}}
    <div class="hidden md:flex lg:hidden flex-col items-center text-center px-6 pt-10 pb-4">
        <div class="w-16 h-16 rounded-2xl {{ isset($isEdit) && $isEdit ? 'bg-gradient-to-br from-emerald-400 to-teal-500 ring-emerald-50' : 'bg-gradient-to-br from-blue-400 to-indigo-500 ring-blue-50' }} shadow-inner flex items-center justify-center text-white mb-4 ring-4">
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
    <div class="max-w-6xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-6 md:py-8 lg:py-16 flex flex-col lg:flex-row gap-8 lg:gap-16 relative z-10 isolate">
        
        {{-- ── 3. DESKTOP: LEFT STICKY CONTEXT PANEL ── --}}
        <div class="hidden lg:block lg:w-1/3 flex-shrink-0">
            <div class="sticky top-12 max-h-[calc(100vh-6rem)] overflow-y-auto pb-8 scrollbar-hide">
                
                {{-- Back Action --}}
                <a href="{{ !empty($isEdit) ? route('balita.show', $balitaId ?? '') : route('balita.index') }}" 
                   class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-slate-800 bg-white shadow-sm ring-1 ring-slate-200 px-4 py-2 rounded-full transition-all hover:shadow mb-10 focus:outline-none focus:ring-4 focus:ring-slate-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Kembali
                </a>

                {{-- Desktop Context Hero --}}
                <div class="mb-10 pr-4">
                    <div class="w-20 h-20 rounded-[1.25rem] {{ isset($isEdit) && $isEdit ? 'bg-gradient-to-br from-emerald-400 to-teal-500 ring-emerald-50' : 'bg-gradient-to-br from-blue-400 to-indigo-500 ring-blue-50' }} shadow-inner flex items-center justify-center text-white mb-6 ring-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                            @if(isset($isEdit) && $isEdit)
                                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                            @else
                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 9a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25V15a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V9z" clip-rule="evenodd" />
                            @endif
                        </svg>
                    </div>
                    <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight leading-tight mb-2">
                        {{ isset($isEdit) && $isEdit ? ($childName ?? 'Profil Balita') : 'Daftar Balita Baru' }}
                    </h1>
                    <p class="text-base font-medium text-slate-500 leading-relaxed">
                        {{ isset($isEdit) && $isEdit ? 'Kelola data master dan riwayat balita.' : 'Tambahkan balita baru ke ekosistem Posyandu.' }}
                    </p>
                </div>

                {{-- Table of Contents (Mental Map) --}}
                <nav class="flex flex-col gap-1 border-l-2 border-slate-200/80 pl-5 py-2">
                    <div class="text-[11px] font-extrabold text-slate-400 uppercase tracking-widest mb-4">Alur Pengisian</div>
                    <a href="#identitas" class="py-1.5 text-sm font-semibold text-slate-800 hover:text-emerald-600 transition-colors">1. Identitas Anak</a>
                    <a href="#orangtua" class="py-1.5 text-sm font-semibold text-slate-500 hover:text-emerald-600 transition-colors">2. Orang Tua / Wali</a>
                    <a href="#lokasi" class="py-1.5 text-sm font-semibold text-slate-500 hover:text-emerald-600 transition-colors">3. Lokasi & Posyandu</a>
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <a href="#simpan" class="py-1.5 text-sm font-bold text-emerald-600 hover:text-emerald-700 transition-colors flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" /></svg>
                            Penyelesaian
                        </a>
                    </div>
                </nav>
            </div>
        </div>

        {{-- 
            RIGHT COLUMN: SINGLE COHESIVE WORKSPACE 
            Avoids card-in-card design. Uses scrolling document metaphor.
        --}}
        <div class="w-full lg:w-2/3">
            
            {{-- PRESERVED: Action, Method, CSRF, PUT --}}
            <form action="{{ isset($isEdit) && $isEdit ? route('balita.update', $balitaId) : route('balita.store') }}" method="POST"
                  class="bg-white rounded-[24px] sm:rounded-[32px] shadow-sm ring-1 ring-inset ring-slate-200/60 p-3 sm:p-4 flex flex-col gap-3 sm:gap-4">
                @csrf
                @if(isset($isEdit) && $isEdit)
                    @method('PUT')
                @endif
                
                {{-- ════════════════════════════════════════════════════════════
                     1. IDENTITAS ANAK
                ═══════════════════════════════════════════════════════════════ --}}
                <div id="identitas" class="bg-gradient-to-br from-emerald-50/60 to-emerald-50/10 rounded-[20px] sm:rounded-[28px] p-6 sm:p-8 lg:p-10 flex flex-col gap-8 scroll-mt-32">
                    {{-- Section Header with Personality --}}
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-600 font-bold flex items-center justify-center ring-1 ring-inset ring-emerald-200/50 shrink-0">1</div>
                        <div>
                            <h2 class="text-xl font-bold text-slate-800 tracking-tight">Identitas Anak</h2>
                            <p class="text-[13px] sm:text-sm text-slate-500 mt-0.5">Informasi dasar untuk identifikasi balita.</p>
                        </div>
                    </div>
                    
                    {{-- Form Grid (Hanging indent aligns fields with text, not the icon) --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-6 pl-0 sm:pl-[3.5rem]">
                        
                        {{-- Nama Lengkap (Full Width) --}}
                        <div class="flex flex-col gap-2 sm:col-span-2">
                            <label for="nama_balita" class="text-sm font-semibold text-slate-700">Nama Lengkap <span class="text-rose-500">*</span></label>
                            {{-- PRESERVED: id, name, value, required, etc --}}
                            <input type="text" id="nama_balita" name="nama" value="{{ $childName ?? '' }}" required placeholder="Contoh: Budi Santoso" autocomplete="off"
                                   class="w-full h-12 bg-white shadow-sm ring-1 ring-inset ring-slate-200 focus:ring-2 focus:ring-inset focus:ring-emerald-500 rounded-xl px-4 text-[15px] font-medium text-slate-800 placeholder:text-slate-400 transition-all outline-none">
                            @error('nama') <p class="text-[12px] text-rose-500 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- NIK Balita (Full Width on Mobile, Full Width on Desktop to accommodate 16 digits comfortably) --}}
                        <div class="flex flex-col gap-2 sm:col-span-2">
                            <label for="nik_balita" class="text-sm font-semibold text-slate-700">NIK Balita <span class="text-rose-500">*</span></label>
                            {{-- PRESERVED: id, name, value, required, maxlength, inputmode --}}
                            <input type="text" id="nik_balita" name="nik" value="{{ $nik ?? '' }}" required placeholder="16 digit NIK" maxlength="16" inputmode="numeric"
                                   class="w-full h-12 bg-white shadow-sm ring-1 ring-inset ring-slate-200 focus:ring-2 focus:ring-inset focus:ring-emerald-500 rounded-xl px-4 text-[15px] font-medium text-slate-800 placeholder:text-slate-400 transition-all outline-none">
                            @error('nik') <p class="text-[12px] text-rose-500 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Tanggal Lahir (Half Width Desktop) --}}
                        <div class="flex flex-col gap-2">
                            <label for="tanggal_lahir" class="text-sm font-semibold text-slate-700">Tanggal Lahir <span class="text-rose-500">*</span></label>
                            {{-- PRESERVED: id, name, value, required --}}
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ $birthDate ?? '' }}" required
                                   class="w-full h-12 bg-white shadow-sm ring-1 ring-inset ring-slate-200 focus:ring-2 focus:ring-inset focus:ring-emerald-500 rounded-xl px-4 text-[15px] font-medium text-slate-800 transition-all outline-none">
                            @error('tanggal_lahir') <p class="text-[12px] text-rose-500 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Jenis Kelamin (Half Width Desktop) --}}
                        <div class="flex flex-col gap-2">
                            <label for="jenis_kelamin" class="text-sm font-semibold text-slate-700">Jenis Kelamin <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                {{-- PRESERVED: id, name, logic, required --}}
                                <select id="jenis_kelamin" name="jenis_kelamin" required
                                        class="w-full h-12 bg-white shadow-sm ring-1 ring-inset ring-slate-200 focus:ring-2 focus:ring-inset focus:ring-emerald-500 rounded-xl pl-4 pr-10 text-[15px] font-medium text-slate-800 appearance-none transition-all outline-none">
                                    <option value="" disabled {{ empty($gender) ? 'selected' : '' }}>Pilih kelamin</option>
                                    <option value="L" {{ ($gender ?? '') === 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ ($gender ?? '') === 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                <div class="absolute right-3 top-0 bottom-0 flex items-center pointer-events-none text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                                </div>
                            </div>
                            @error('jenis_kelamin') <p class="text-[12px] text-rose-500 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- ════════════════════════════════════════════════════════════
                     2. ORANG TUA / WALI
                ═══════════════════════════════════════════════════════════════ --}}
                <div id="orangtua" class="bg-gradient-to-br from-sky-50/60 to-sky-50/10 rounded-[20px] sm:rounded-[28px] p-6 sm:p-8 lg:p-10 flex flex-col gap-8 scroll-mt-32">
                    {{-- Section Header with Personality --}}
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-2xl bg-blue-50 text-blue-600 font-bold flex items-center justify-center ring-1 ring-inset ring-blue-200/50 shrink-0">2</div>
                        <div>
                            <h2 class="text-xl font-bold text-slate-800 tracking-tight">Orang Tua / Wali</h2>
                            <p class="text-[13px] sm:text-sm text-slate-500 mt-0.5">Identitas kontak darurat dan keluarga.</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-6 pl-0 sm:pl-[3.5rem]">
                        
                        {{-- Nama Ibu (Full Width) --}}
                        <div class="flex flex-col gap-2 sm:col-span-2">
                            <label for="nama_ibu" class="text-sm font-semibold text-slate-700">Nama Ibu <span class="text-rose-500">*</span></label>
                            {{-- PRESERVED: id, name, value, required --}}
                            <input type="text" id="nama_ibu" name="nama_ibu" value="{{ $motherName ?? '' }}" required placeholder="Contoh: Siti Aminah"
                                   class="w-full h-12 bg-white shadow-sm ring-1 ring-inset ring-slate-200 focus:ring-2 focus:ring-inset focus:ring-emerald-500 rounded-xl px-4 text-[15px] font-medium text-slate-800 placeholder:text-slate-400 transition-all outline-none">
                            @error('nama_ibu') <p class="text-[12px] text-rose-500 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- NIK Ibu (Half Width) --}}
                        <div class="flex flex-col gap-2">
                            <label for="nik_ibu" class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                                NIK Ibu <span class="text-[10px] font-medium text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full">Opsional</span>
                            </label>
                            {{-- PRESERVED: id, name, value, maxlength, inputmode --}}
                            <input type="text" id="nik_ibu" name="nik_ibu" value="{{ $motherNik ?? '' }}" placeholder="16 digit NIK" maxlength="16" inputmode="numeric"
                                   class="w-full h-12 bg-white shadow-sm ring-1 ring-inset ring-slate-200 focus:ring-2 focus:ring-inset focus:ring-emerald-500 rounded-xl px-4 text-[15px] font-medium text-slate-800 placeholder:text-slate-400 transition-all outline-none">
                            @error('nik_ibu') <p class="text-[12px] text-rose-500 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- No HP (Half Width) --}}
                        <div class="flex flex-col gap-2">
                            <label for="no_hp_ibu" class="text-sm font-semibold text-slate-700">Nomor HP Ibu <span class="text-rose-500">*</span></label>
                            {{-- PRESERVED: id, name, value, inputmode, required --}}
                            <input type="tel" id="no_hp_ibu" name="no_hp" value="{{ $motherPhone ?? '' }}" required placeholder="Contoh: 08123456789" inputmode="tel"
                                   class="w-full h-12 bg-white shadow-sm ring-1 ring-inset ring-slate-200 focus:ring-2 focus:ring-inset focus:ring-emerald-500 rounded-xl px-4 text-[15px] font-medium text-slate-800 placeholder:text-slate-400 transition-all outline-none">
                            @error('no_hp') <p class="text-[12px] text-rose-500 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                    </div>
                </div>

                {{-- ════════════════════════════════════════════════════════════
                     3. LOKASI & POSYANDU
                ═══════════════════════════════════════════════════════════════ --}}
                <div id="lokasi" class="bg-gradient-to-br from-amber-50/60 to-amber-50/10 rounded-[20px] sm:rounded-[28px] p-6 sm:p-8 lg:p-10 flex flex-col gap-8 scroll-mt-32">
                    {{-- Section Header with Personality --}}
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-2xl bg-amber-50 text-amber-600 font-bold flex items-center justify-center ring-1 ring-inset ring-amber-200/50 shrink-0">3</div>
                        <div>
                            <h2 class="text-xl font-bold text-slate-800 tracking-tight">Lokasi & Posyandu</h2>
                            <p class="text-[13px] sm:text-sm text-slate-500 mt-0.5">Alamat domisili saat ini dan lokasi pendaftaran.</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-6 pl-0 sm:pl-[3.5rem]">
                        
                        {{-- Desa / Kelurahan (Half Width) --}}
                        <div class="flex flex-col gap-2">
                            <label for="desa" class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                                Desa / Kelurahan <span class="text-[10px] font-medium text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full">Opsional</span>
                            </label>
                            {{-- PRESERVED: id, name, value --}}
                            <input type="text" id="desa" name="desa" value="{{ $address ?? '' }}" placeholder="Nama desa"
                                   class="w-full h-12 bg-white shadow-sm ring-1 ring-inset ring-slate-200 focus:ring-2 focus:ring-inset focus:ring-emerald-500 rounded-xl px-4 text-[15px] font-medium text-slate-800 placeholder:text-slate-400 transition-all outline-none">
                            @error('desa') <p class="text-[12px] text-rose-500 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Kecamatan (Half Width) --}}
                        <div class="flex flex-col gap-2">
                            <label for="kecamatan" class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                                Kecamatan <span class="text-[10px] font-medium text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full">Opsional</span>
                            </label>
                            {{-- PRESERVED: id, name, value --}}
                            <input type="text" id="kecamatan" name="kecamatan" value="{{ $addressSub ?? '' }}" placeholder="Nama kecamatan"
                                   class="w-full h-12 bg-white shadow-sm ring-1 ring-inset ring-slate-200 focus:ring-2 focus:ring-inset focus:ring-emerald-500 rounded-xl px-4 text-[15px] font-medium text-slate-800 placeholder:text-slate-400 transition-all outline-none">
                            @error('kecamatan') <p class="text-[12px] text-rose-500 font-medium mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Posyandu Pendaftar (Full Width Read Only) --}}
                        <div class="flex flex-col gap-2 sm:col-span-2">
                            <label class="text-sm font-semibold text-slate-700">Posyandu Pendaftar</label>
                            {{-- PRESERVED: $posyanduName --}}
                            <div class="w-full h-12 bg-slate-50 ring-1 ring-inset ring-slate-200/60 rounded-xl px-4 flex items-center gap-3 text-[15px] font-medium text-slate-500 cursor-not-allowed select-none">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-emerald-600/60">
                                    <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                </svg>
                                <span class="truncate">{{ $posyanduName ?? 'Posyandu Kader' }}</span>
                                <span class="ml-auto text-[11px] font-bold bg-slate-200/50 text-slate-500 px-2.5 py-1 rounded-md uppercase tracking-wider hidden sm:block">Otomatis</span>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- ════════════════════════════════════════════════════════════
                     4. CLIMAX: PENYELESAIAN (SAVE ACTION)
                ═══════════════════════════════════════════════════════════════ --}}
                <div id="simpan" class="bg-slate-50/60 rounded-[20px] sm:rounded-[28px] p-6 sm:p-8 lg:p-10 flex flex-col-reverse sm:flex-row items-center justify-between gap-6 scroll-mt-32 ring-1 ring-inset ring-slate-200/50">
                    
                    {{-- Completion context reinforces the end of the workflow --}}
                    <div class="flex items-center gap-4 w-full sm:w-auto">
                        <div class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 ring-1 ring-inset ring-slate-200/60 shrink-0 hidden sm:flex">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        </div>
                        <div class="text-center sm:text-left w-full sm:w-auto">
                            <h3 class="text-sm font-bold text-slate-800 hidden sm:block">Penyelesaian</h3>
                            <p class="text-[13px] text-slate-500">Pastikan seluruh data wajib <span class="text-rose-500 font-bold">*</span> terisi.</p>
                        </div>
                    </div>
                    
                    {{-- The Action Climax --}}
                    <button type="submit" 
                            class="w-full sm:w-auto h-14 px-8 sm:px-10 bg-emerald-600 hover:bg-emerald-500 active:bg-emerald-700 text-white rounded-2xl font-bold text-[15px] shadow-lg shadow-emerald-500/25 hover:shadow-xl hover:-translate-y-0.5 transition-all flex items-center justify-center gap-3 focus:outline-none focus:ring-4 focus:ring-emerald-500/30">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                        <span>{{ isset($isEdit) && $isEdit ? 'Simpan Profil Balita' : 'Daftarkan Balita' }}</span>
                    </button>

                </div>

            </form>
        </div>
    </div>
</div>
@endsection
