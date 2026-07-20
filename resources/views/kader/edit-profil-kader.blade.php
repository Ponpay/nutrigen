@extends('layouts.app')

@section('page-title', 'Edit Profil')

@section('content')
<!-- Ambient Mesh Background -->
<div class="flex flex-col w-full bg-slate-50 min-h-[calc(100vh-72px)] relative overflow-x-hidden selection:bg-emerald-500/20 py-6 sm:py-12">

    <!-- Premium Mesh Gradient Background -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute top-[-10%] left-[-10%] w-[50vw] h-[50vw] max-w-[600px] max-h-[600px] bg-emerald-300/20 blur-[100px] rounded-full mix-blend-multiply"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[50vw] h-[50vw] max-w-[600px] max-h-[600px] bg-teal-200/20 blur-[100px] rounded-full mix-blend-multiply"></div>
    </div>

    <div class="max-w-4xl mx-auto w-full px-4 sm:px-6 relative z-10">
        
        <!-- Flash Message (Floating above card) -->
        @if(session('success'))
        <div class="mb-6 bg-emerald-50/90 backdrop-blur-md border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl flex items-center gap-4 shadow-[0_8px_30px_-12px_rgba(16,185,129,0.2)] animate-fade-in relative overflow-hidden group">
            <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0 text-emerald-600 ring-4 ring-white relative z-10">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
            </div>
            <div class="flex flex-col relative z-10">
                <span class="text-[14px] font-bold text-emerald-900 tracking-wide">Pembaruan Berhasil</span>
                <span class="text-[13px] text-emerald-700 font-medium">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        <!-- The Master Unified Card -->
        <div class="w-full bg-white/90 backdrop-blur-2xl rounded-[24px] sm:rounded-[32px] shadow-[0_20px_60px_-15px_rgba(0,0,0,0.05)] border border-white/80 overflow-hidden flex flex-col transition-all duration-500 hover:shadow-[0_20px_60px_-15px_rgba(0,0,0,0.08)]">
            
            <!-- Header Area -->
            <div class="w-full px-6 sm:px-10 py-5 sm:py-6 border-b border-slate-100/80 bg-white/60 flex items-center justify-between sticky top-0 z-20 backdrop-blur-md">
                <div class="flex items-center gap-4 sm:gap-5">
                    <a href="{{ route('kader.profil') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-50 hover:bg-slate-100 border border-slate-200/60 text-slate-500 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 group-hover:-translate-x-0.5 transition-transform duration-300">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </a>
                    <div class="flex flex-col">
                        <h1 class="font-bold text-slate-900 text-[18px] sm:text-[22px] tracking-tight">Pengaturan Akun</h1>
                        <p class="text-[13px] font-medium text-slate-500 mt-0.5">Pusat kendali profil Anda</p>
                    </div>
                </div>
                <div class="hidden sm:flex items-center gap-2 bg-emerald-50 px-3.5 py-1.5 rounded-full border border-emerald-100">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse shadow-sm"></span>
                    <span class="text-[11px] font-bold text-emerald-700 tracking-wider uppercase">Mode Edit Aktif</span>
                </div>
            </div>

            <!-- Body Area -->
            <div class="p-6 sm:p-10 flex flex-col gap-10">
                
                <form action="{{ route('kader.profil.update') }}" method="POST" class="flex flex-col gap-10">
                    @csrf
                    @method('PUT')

                    <!-- Hero / Avatar Section Inside Card -->
                    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6 sm:gap-8 group">
                        <!-- Interactive Avatar -->
                        <div class="relative cursor-pointer flex-shrink-0">
                            <!-- Colored Circular Ring (Garis Melingkar Berwarna) -->
                            <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-full p-[3px] bg-gradient-to-tr from-emerald-500 to-teal-400 flex items-center justify-center transition-all duration-500 group-hover:scale-105 group-hover:shadow-[0_0_20px_rgba(16,185,129,0.3)]">
                                <!-- Inner White Border & Avatar Content -->
                                <div class="w-full h-full rounded-full border-[3px] border-white overflow-hidden relative flex items-center justify-center bg-slate-100 text-slate-300 shadow-inner">
                                    @if(isset($avatarUrl))
                                        <img src="{{ $avatarUrl }}" alt="Foto Kader" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 relative z-10">
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-14 h-14 transition-transform duration-700 group-hover:scale-110 text-slate-300 relative z-10">
                                            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                    
                                    <!-- Glass Overlay on Hover (With Camera Icon) -->
                                    <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 flex flex-col items-center justify-center transition-all duration-300 backdrop-blur-[2px] z-20">
                                        <div class="w-10 h-10 rounded-full border border-white/60 bg-white/20 flex items-center justify-center mb-1 transform translate-y-2 group-hover:translate-y-0 transition-all duration-300 shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Z" />
                                            </svg>
                                        </div>
                                        <span class="text-[10px] font-extrabold text-white tracking-widest transform translate-y-2 group-hover:translate-y-0 transition-all duration-300 delay-75 drop-shadow-md">UBAH</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Verified Badge -->
                            <div class="absolute bottom-1 right-1 bg-emerald-500 w-8 h-8 rounded-full border-[3px] border-white flex items-center justify-center shadow-sm transform group-hover:scale-110 transition-transform duration-300 z-30">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 text-white"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg>
                            </div>
                        </div>

                        <!-- Basic Identity -->
                        <div class="flex flex-col items-center sm:items-start text-center sm:text-left mt-2 sm:mt-5">
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight">{{ old('nama', $name ?? 'Nama Kader') }}</h2>
                            <p class="text-[15px] font-medium text-slate-500 mt-1 flex items-center justify-center sm:justify-start gap-2">
                                Kader Posyandu 
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                <span class="text-emerald-600 font-semibold">ID Aktif</span>
                            </p>
                        </div>
                    </div>

                    <div class="w-full h-px bg-slate-100"></div>

                    <!-- Unified Form Fields Grid -->
                    <div class="flex flex-col gap-8">
                        <div class="flex flex-col gap-1.5">
                            <h3 class="text-[16px] font-bold text-slate-800 tracking-tight">Data Pribadi</h3>
                            <p class="text-[13px] font-medium text-slate-500">Informasi ini akan ditampilkan di direktori kader Posyandu.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                            
                            <!-- Input Nama (With Icon) -->
                            <div class="flex flex-col gap-2 relative group/input">
                                <label for="nama" class="text-[13px] font-semibold text-slate-600 tracking-wide flex items-center gap-1.5 ml-1">
                                    Nama Lengkap
                                    <span class="text-emerald-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within/input:text-emerald-500 transition-colors duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="nama" name="nama" value="{{ old('nama', $name ?? '') }}" required
                                           class="w-full bg-slate-50/80 border border-slate-200 text-slate-800 rounded-2xl pl-12 pr-4 py-3.5 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white hover:bg-slate-50 transition-all duration-300 text-[15px] font-medium placeholder-slate-400 outline-none"
                                           placeholder="Masukkan nama lengkap">
                                </div>
                                @error('nama')
                                    <p class="text-rose-500 text-[12px] font-medium mt-1 ml-1 flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Input Nomor HP (With Icon) -->
                            <div class="flex flex-col gap-2 relative group/input">
                                <label for="no_hp" class="text-[13px] font-semibold text-slate-600 tracking-wide flex items-center gap-1.5 ml-1">
                                    Nomor WhatsApp
                                    <span class="text-emerald-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within/input:text-emerald-500 transition-colors duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                        </svg>
                                    </div>
                                    <div class="absolute inset-y-0 left-12 flex items-center pointer-events-none border-r border-slate-200 pr-3 my-2">
                                        <span class="text-slate-800 font-medium text-[15px]">+62</span>
                                    </div>
                                    <input type="tel" id="no_hp" name="no_hp" value="{{ str_starts_with(old('no_hp', $phone ?? ''), '+62') ? substr(old('no_hp', $phone ?? ''), 3) : (str_starts_with(old('no_hp', $phone ?? ''), '0') ? substr(old('no_hp', $phone ?? ''), 1) : old('no_hp', $phone ?? '')) }}" required
                                           class="w-full bg-slate-50/80 border border-slate-200 text-slate-800 rounded-2xl pl-[88px] pr-4 py-3.5 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white hover:bg-slate-50 transition-all duration-300 text-[15px] font-medium placeholder-slate-400 outline-none"
                                           placeholder="81234567890">
                                </div>
                                @error('no_hp')
                                    <p class="text-rose-500 text-[12px] font-medium mt-1 ml-1 flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <!-- Keamanan Section -->
                    <div class="flex flex-col gap-6">
                        <div class="flex flex-col gap-1.5">
                            <h3 class="text-[16px] font-bold text-slate-800 tracking-tight">Kredensial Keamanan</h3>
                            <p class="text-[13px] font-medium text-slate-500">Email yang terhubung dengan akun NutriGen Anda.</p>
                        </div>
                        
                        <!-- Input Email (Disabled with Icon) -->
                        <div class="flex flex-col gap-2 relative group/input">
                            <label for="email" class="text-[13px] font-semibold text-slate-600 tracking-wide ml-1">Alamat Email Utama</label>
                            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                                <div class="relative flex-1">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                        </svg>
                                    </div>
                                    <input type="email" id="email" value="{{ $email ?? '' }}" disabled readonly
                                           class="w-full bg-slate-100/50 border border-slate-200/80 text-slate-500 rounded-2xl pl-12 pr-4 py-3.5 text-[15px] font-medium cursor-not-allowed opacity-80 outline-none">
                                </div>
                                <button type="button" class="w-full sm:w-auto px-6 py-3.5 bg-white hover:bg-slate-50 text-slate-700 rounded-2xl font-bold text-[14px] transition-all duration-300 ring-1 ring-slate-200 shadow-sm whitespace-nowrap focus:outline-none focus:ring-4 focus:ring-slate-200/50 active:scale-[0.98]" onclick="window.NutriAlert.warning('Fitur Dalam Pengembangan', 'Fitur penggantian email dengan verifikasi OTP sedang dalam pengembangan (Future Development).')">
                                    Ubah Email
                                </button>
                            </div>
                            <div class="mt-1 inline-flex items-center gap-1.5 self-start px-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 text-emerald-500 flex-shrink-0"><path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" /></svg>
                                <span class="text-[12px] font-medium text-slate-500">Dilindungi dengan verifikasi OTP berlapis</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Bar Inside Card -->
                    <div class="mt-4 pt-8 border-t border-slate-100 flex flex-col-reverse sm:flex-row items-center justify-end gap-3 sm:gap-4">
                        <a href="{{ route('kader.profil') }}" class="w-full sm:w-auto px-6 py-3.5 bg-transparent hover:bg-slate-100 text-slate-600 rounded-xl font-bold text-[14px] transition-all duration-300 focus:outline-none text-center">
                            Batal
                        </a>
                        <button type="submit" class="w-full sm:w-auto px-10 py-3.5 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white rounded-xl font-bold text-[14px] transition-all duration-300 shadow-[0_8px_16px_-6px_rgba(16,185,129,0.3)] hover:shadow-[0_12px_20px_-8px_rgba(16,185,129,0.4)] hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-emerald-500/30 active:scale-[0.98] flex items-center justify-center gap-2.5 group">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 text-emerald-50 group-hover:scale-110 transition-transform duration-300">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</div>
@endsection
