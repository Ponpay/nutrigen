@extends('layouts.app')

@section('page-title', 'Edit Profil Kader')

@section('content')

{{-- Script for Framer Motion --}}
<script type="module">
    document.addEventListener('DOMContentLoaded', () => {
        if(window.Motion) {
            const { animate, stagger, hover } = window.Motion;
            
            animate('.motion-card', 
                { opacity: [0, 1], y: [20, 0] }, 
                { delay: stagger(0.1), duration: 0.5, easing: "ease-out" }
            );
        }
    });
</script>

<div class="w-full min-h-screen bg-slate-50/50 pb-20 lg:pb-12">
    <!-- HERO SECTION (Teal Gradient) -->
    <div class="relative bg-gradient-to-br from-teal-700 via-teal-600 to-teal-800 pt-8 pb-20 lg:pt-12 lg:pb-24 px-4 sm:px-6 lg:px-8 overflow-hidden lg:rounded-b-[40px] shadow-sm border-b border-teal-900/10">
        <div class="absolute -right-10 -top-10 w-64 h-64 bg-teal-400/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute left-0 bottom-0 w-40 h-40 bg-teal-900/40 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute inset-0 opacity-[0.05] pointer-events-none" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 24px 24px;"></div>
        
        <div class="max-w-6xl mx-auto relative z-10 motion-card opacity-0 flex flex-col sm:flex-row gap-6 sm:gap-8 items-center sm:items-start text-center sm:text-left">
            <!-- Avatar Upload Area -->
            <div class="relative group/avatar shrink-0">
                <div class="w-24 h-24 sm:w-32 sm:h-32 rounded-full p-1.5 bg-white/20 backdrop-blur-sm shadow-md flex items-center justify-center transition-transform duration-500 hover:scale-105 relative z-10 cursor-pointer">
                    <div class="w-full h-full rounded-full overflow-hidden bg-white text-slate-300 relative flex items-center justify-center">
                        @if(isset($avatarUrl))
                            <img src="{{ $avatarUrl }}" alt="Foto Kader" class="w-full h-full object-cover">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-14 h-14 text-slate-300">
                                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                            </svg>
                        @endif
                        <!-- Camera Overlay (Edit Mode) -->
                        <div class="absolute inset-0 bg-slate-900/40 flex flex-col items-center justify-center opacity-0 group-hover/avatar:opacity-100 transition-opacity backdrop-blur-[2px]">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-white mb-1"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" /><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" /></svg>
                            <span class="text-[10px] font-bold text-white uppercase tracking-widest drop-shadow-md">Ubah</span>
                        </div>
                    </div>
                </div>
                <!-- Editing Indicator -->
                <div class="absolute bottom-1 right-1 sm:bottom-2 sm:right-2 z-20">
                    <div class="bg-amber-400 w-6 h-6 rounded-full shadow-sm relative border-2 border-teal-700 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3.5 h-3.5 text-white"><path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.158 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" /></svg>
                    </div>
                </div>
            </div>

            <!-- Header Info -->
            <div class="flex flex-col flex-1 mt-2 sm:mt-6">
                <div>
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white tracking-tight drop-shadow-sm leading-tight">Edit Profil Saya</h1>
                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2 mt-3">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white text-[13px] font-bold text-amber-600 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.158 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" /></svg>
                            Mode Edit Aktif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FORM WORKSPACE -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 lg:-mt-14 relative z-20 flex flex-col gap-6 lg:gap-8">
        
        <form action="{{ route('kader.profil.update') }}" method="POST" class="flex flex-col gap-6 lg:gap-8 motion-card opacity-0">
            @csrf
            @method('PUT')

            <!-- Card 1: Data Pribadi -->
            <div class="flex flex-col bg-white p-6 lg:p-8 rounded-[24px] shadow-[0_8px_30px_rgb(0,0,0,0.08)] border border-slate-200/60">
                <h2 class="text-[15px] font-semibold tracking-tight text-slate-800 flex items-center gap-2 px-1 mb-6">
                    <div class="w-8 h-8 rounded-lg bg-teal-100 text-teal-600 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" /></svg>
                    </div>
                    Data Pribadi
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                    <!-- Input Nama Lengkap -->
                    <div class="flex flex-col gap-2 group/input">
                        <label for="nama" class="text-xs font-medium text-slate-500 tracking-wide uppercase flex items-center ml-1">
                            NAMA LENGKAP <sup class="text-rose-400 font-bold ml-1 text-[14px] top-[-2px]">*</sup>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-teal-600 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                            </div>
                            <input type="text" id="nama" name="nama" value="{{ old('nama', $name ?? 'Ibu Siti Aminah') }}" required
                                class="w-full bg-slate-50/80 border border-slate-200 text-slate-900 rounded-2xl pl-12 pr-4 py-3.5 focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white hover:bg-slate-50 transition-all duration-300 text-[15px] font-medium placeholder-slate-400 outline-none"
                                placeholder="Masukkan nama lengkap">
                        </div>
                        @error('nama')
                            <p class="text-rose-500 text-[12px] font-medium mt-1 ml-1 flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <!-- Input Nomor WhatsApp -->
                    <div class="flex flex-col gap-2 group/input">
                        <label for="no_hp" class="text-xs font-medium text-slate-500 tracking-wide uppercase flex items-center ml-1">
                            NOMOR WHATSAPP <sup class="text-rose-400 font-bold ml-1 text-[14px] top-[-2px]">*</sup>
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
                            <input type="tel" id="no_hp" name="no_hp" value="{{ str_starts_with(old('no_hp', $phone ?? ''), '+62') ? substr(old('no_hp', $phone ?? ''), 3) : (str_starts_with(old('no_hp', $phone ?? ''), '0') ? substr(old('no_hp', $phone ?? ''), 1) : old('no_hp', $phone ?? '')) }}" required
                                   class="w-full bg-slate-50/80 border border-slate-200 text-slate-900 rounded-2xl pl-[104px] pr-4 py-3.5 focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white hover:bg-slate-50 transition-all duration-300 text-[15px] font-medium placeholder-slate-400 outline-none"
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

            <!-- Card: Area Penugasan (Read Only) -->
            <div class="flex flex-col bg-white p-6 lg:p-8 rounded-[24px] shadow-[0_8px_30px_rgb(0,0,0,0.08)] border border-slate-200/60">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-[15px] font-semibold tracking-tight text-slate-800 flex items-center gap-2 px-1">
                        <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" /></svg>
                        </div>
                        Area Penugasan
                    </h2>
                    <span class="px-2.5 py-1 bg-slate-100 text-slate-500 rounded-lg text-[11px] font-bold uppercase tracking-wider">Tidak Dapat Diubah</span>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                    <!-- Input Wilayah -->
                    <div class="flex flex-col gap-2 group/input">
                        <label class="text-xs font-medium text-slate-500 tracking-wide uppercase ml-1">CAKUPAN WILAYAH</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-teal-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6.75h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" /></svg>
                            </div>
                            <input type="text" value="{{ $desa ?? 'Desa Lampeuneurut' }}, Kec. {{ $kecamatan ?? 'Darul Imarah' }}" disabled readonly
                                   class="w-full bg-slate-100/50 border border-slate-200/80 text-slate-900 rounded-2xl pl-12 pr-4 py-3.5 text-[15px] font-medium cursor-not-allowed opacity-80 outline-none shadow-inner">
                        </div>
                    </div>
                    
                    <!-- Input Fasilitas Rujukan -->
                    <div class="flex flex-col gap-2 group/input">
                        <label class="text-xs font-medium text-slate-500 tracking-wide uppercase ml-1">FASILITAS RUJUKAN UTAMA</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-teal-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>
                            </div>
                            <input type="text" value="{{ $puskesmas ?? 'Puskesmas Darul Imarah' }}" disabled readonly
                                   class="w-full bg-slate-100/50 border border-slate-200/80 text-slate-900 rounded-2xl pl-12 pr-4 py-3.5 text-[15px] font-medium cursor-not-allowed opacity-80 outline-none shadow-inner">
                        </div>
                    </div>
                </div>
                <div class="mt-4 inline-flex items-center gap-1.5 px-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 text-slate-400"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" /></svg>
                    <span class="text-[12px] font-medium text-slate-500">Hubungi Admin Bidan untuk pengajuan pindah tugas atau mutasi wilayah.</span>
                </div>
            </div>

            <!-- Card 3: Kredensial Keamanan -->
            <div class="flex flex-col bg-white p-6 lg:p-8 rounded-[24px] shadow-[0_8px_30px_rgb(0,0,0,0.08)] border border-slate-200/60">
                <h2 class="text-[15px] font-semibold tracking-tight text-slate-800 flex items-center gap-2 px-1 mb-6">
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" /></svg>
                    </div>
                    Keamanan Sesi
                </h2>
                
                <div class="flex flex-col gap-2 group/input max-w-2xl">
                    <label for="email" class="text-xs font-medium text-slate-500 tracking-wide uppercase ml-1">ALAMAT EMAIL UTAMA</label>
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                        <div class="relative flex-1">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-teal-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                </svg>
                            </div>
                            <input type="email" id="email" value="{{ $email ?? '' }}" disabled readonly
                                   class="w-full bg-slate-100/50 border border-slate-200/80 text-slate-900 rounded-2xl pl-12 pr-4 py-3.5 text-[15px] font-medium cursor-not-allowed opacity-80 outline-none shadow-inner">
                        </div>
                        <button type="button" class="w-full sm:w-auto px-4 py-2 bg-white hover:bg-slate-50 text-slate-700 rounded-2xl font-bold text-[14px] transition-all duration-300 ring-1 ring-slate-200 shadow-sm whitespace-nowrap focus:outline-none focus:ring-4 focus:ring-slate-200/50 active:scale-[0.98]" onclick="window.NutriAlert.warning('Fitur Dalam Pengembangan', 'Fitur penggantian email dengan verifikasi OTP sedang dalam pengembangan (Future Development).')">
                            Ubah Email
                        </button>
                    </div>
                </div>
                
                <hr class="border-slate-100 my-6">
                
                <div class="flex flex-col gap-2 group/input max-w-2xl">
                    <label class="text-xs font-medium text-slate-500 tracking-wide uppercase ml-1">PASSWORD & AUTENTIKASI</label>
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                        <div class="relative flex-1">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-teal-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                            </div>
                            <input type="password" value="********" disabled readonly
                                   class="w-full bg-slate-100/50 border border-slate-200/80 text-slate-900 rounded-2xl pl-12 pr-4 py-3.5 text-[15px] font-medium tracking-widest cursor-not-allowed opacity-80 outline-none shadow-inner">
                        </div>
                        <button type="button" class="w-full sm:w-auto px-4 py-2 bg-white hover:bg-slate-50 text-slate-700 rounded-2xl font-bold text-[14px] transition-all duration-300 ring-1 ring-slate-200 shadow-sm whitespace-nowrap focus:outline-none focus:ring-4 focus:ring-slate-200/50 active:scale-[0.98]" onclick="window.NutriAlert.warning('Fitur Dalam Pengembangan', 'Fitur penggantian password sedang dalam tahap pengembangan.')">
                            Ubah Password
                        </button>
                    </div>
                    <div class="mt-1.5 inline-flex items-center gap-1.5 self-start px-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 text-emerald-500 flex-shrink-0"><path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" /></svg>
                        <span class="text-[12px] font-bold text-slate-500">Terakhir diubah 2 bulan yang lalu</span>
                    </div>
                </div>
            </div>

            <!-- Action Bar -->
            <div class="flex flex-col-reverse sm:flex-row items-center justify-end gap-3 sm:gap-4 mt-2 mb-8">
                <a href="{{ route('kader.profil') }}" class="w-full sm:w-auto px-6 py-4 bg-white hover:bg-slate-50 text-slate-700 rounded-2xl font-bold text-[15px] transition-all duration-300 focus:outline-none text-center shadow-sm border border-slate-200">
                    Batal Edit
                </a>
                <button type="submit" class="w-full sm:w-auto px-10 py-4 bg-teal-600 hover:bg-teal-500 active:bg-teal-700 text-white rounded-2xl font-bold text-[15px] transition-all duration-300 shadow-[0_8px_16px_-6px_rgba(20,184,166,0.3)] hover:shadow-[0_12px_20px_-8px_rgba(20,184,166,0.4)] hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-teal-500/30 active:scale-[0.98] flex items-center justify-center gap-2.5 group">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-teal-50 group-hover:scale-110 transition-transform duration-300">
                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
            
        </form>
    </div>
</div>
@endsection
