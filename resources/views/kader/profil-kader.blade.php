@extends('layouts.app')

@section('page-title', 'Profil Kader')

{{--
|--------------------------------------------------------------------------
| kader.profil-kader
|--------------------------------------------------------------------------
| Controller contract — expected variables (from auth()->user() or KaderController@profil):
|   $kaderName     (string) — full name
|   $role          (string) — e.g. 'Kader Posyandu'
|   $email         (string)
|   $phone         (string)
|   $status        (string) — e.g. 'Aktif'
|   $avatarUrl     (string|null) — URL to profile photo, null = default SVG
|   $posyanduName  (string)
|   $desa          (string)
|   $puskesmas     (string)
|   $kecamatan     (string)
|
| Backend: Logout must use POST to route('logout') per Laravel auth convention.
--}}

@section('content')

<style>
    /* Force main container to have 0 padding on mobile so header sits perfectly flush */
    @media (max-width: 1024px) {
        main {
            padding-top: 0 !important;
        }
    }
</style>

<!-- Ambient Emerald Background -->
<div class="bg-gradient-to-br from-emerald-100/50 via-emerald-50/20 to-slate-50 min-h-[calc(100vh-72px)] w-full flex flex-col selection:bg-emerald-500/30 relative">
    
    <!-- Profil Header (Dempet Navbar App - Glassmorphism Emerald) -->
    <div class="sticky top-0 z-30 bg-emerald-600/80 backdrop-blur-xl transition-all w-full shadow-[0_4px_20px_-10px_rgba(16,185,129,0.3)] border-b border-emerald-500/30">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 py-3.5 flex items-center gap-4">
            <button onclick="history.back()" class="flex items-center justify-center w-9 h-9 rounded-full bg-emerald-700/50 text-white hover:bg-emerald-700 transition-all focus:outline-none flex-shrink-0" aria-label="Kembali">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>
            <div class="flex flex-col">
                <h1 class="font-extrabold text-white text-[16px] tracking-tight">Profil Kader</h1>
                <span class="text-[11px] font-bold text-emerald-200 uppercase tracking-widest">Pusat Akun</span>
            </div>
        </div>
    </div>

    <!-- Main Workspace -->
    <div class="flex-1 w-full flex flex-col items-center py-6 sm:py-8 px-4 sm:px-6">
        
        <!-- Big Premium White Card -->
        <div class="w-full max-w-5xl bg-white rounded-[24px] sm:rounded-[32px] shadow-[0_12px_40px_-12px_rgba(16,185,129,0.15)] border border-emerald-100/50 flex flex-col overflow-hidden relative">
            
            <!-- Hero (Inside Card) -->
            <div class="w-full flex flex-col items-center text-center pt-10 pb-8 px-6 bg-gradient-to-b from-emerald-50/40 to-white relative">
                
                <!-- Avatar -->
                <div class="relative group">
                    <!-- Colored Circular Ring (Garis Melingkar Berwarna) -->
                    <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-full p-[3px] bg-gradient-to-tr from-emerald-500 to-teal-400 flex items-center justify-center transition-transform duration-500 hover:scale-105 shadow-[0_0_15px_rgba(16,185,129,0.2)] hover:shadow-[0_0_25px_rgba(16,185,129,0.4)] relative z-10">
                        <!-- Inner White Border & Avatar Content -->
                        <div class="w-full h-full rounded-full border-[3px] border-white overflow-hidden relative flex items-center justify-center bg-slate-100 text-slate-300 shadow-inner">
                            @if(isset($avatarUrl))
                                <img src="{{ $avatarUrl }}" alt="Foto Kader" class="w-full h-full object-cover">
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12 text-slate-300">
                                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                                </svg>
                            @endif
                        </div>
                    </div>
                    <!-- Status Indicator -->
                    <div class="absolute bottom-1 right-0 sm:right-1 z-20">
                        <div class="bg-emerald-500 w-5 h-5 rounded-full shadow-sm relative border-2 border-white">
                            <div class="absolute inset-0 rounded-full bg-emerald-500 animate-ping opacity-60"></div>
                        </div>
                    </div>
                </div>

                <!-- Text Identity -->
                <div class="mt-5 flex flex-col">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">{{ $kaderName ?? 'Ibu Siti Aminah' }}</h2>
                    <p class="text-[14px] text-slate-500 font-medium mt-1">{{ $role ?? 'Kader Posyandu' }} • {{ $posyanduName ?? 'Posyandu Melati 1' }}</p>
                </div>

                <!-- CTA -->
                <div class="mt-6">
                    <a href="{{ route('kader.profil.edit') }}" class="group inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-500 text-white px-6 py-2.5 rounded-full text-[13px] sm:text-[14px] font-bold shadow-[0_6px_16px_-4px_rgba(16,185,129,0.3)] transition-all hover:-translate-y-0.5 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-emerald-200 group-hover:text-white transition-colors">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                        </svg>
                        Edit Profil
                    </a>
                </div>
            </div>

            <!-- Soft Divider inside card -->
            <div class="w-full h-px bg-slate-100"></div>

            <!-- Content Area -->
            <div class="p-6 sm:p-10 flex flex-col gap-8">
                
                <!-- Grid Informasi -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
                    
                    <!-- Akun -->
                    <div class="flex flex-col gap-3">
                        <h3 class="text-[13px] font-bold text-slate-800 px-1 border-l-4 border-emerald-500 pl-2">Informasi Akun</h3>
                        <div class="flex flex-col mt-1">
                            
                            <div class="flex items-center gap-3.5 py-3.5 border-b border-slate-100/80">
                                <div class="w-10 h-10 rounded-full bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-500 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                    </svg>
                                </div>
                                <div class="flex flex-col flex-1 min-w-0">
                                    <span class="text-[11px] font-semibold text-slate-500 uppercase tracking-wide">Email</span>
                                    <span class="text-[14px] font-bold text-slate-800 truncate">{{ $email ?? 'siti.aminah@posyandu.go.id' }}</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3.5 py-3.5 border-b border-slate-100/80">
                                <div class="w-10 h-10 rounded-full bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-500 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.069-3.769-6.665-6.666l1.292-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                    </svg>
                                </div>
                                <div class="flex flex-col flex-1 min-w-0">
                                    <span class="text-[11px] font-semibold text-slate-500 uppercase tracking-wide">Nomor Telepon</span>
                                    <span class="text-[14px] font-bold text-slate-800 truncate">{{ $phone ?? '0812-3456-7890' }}</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3.5 py-3.5">
                                <div class="w-10 h-10 rounded-full bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                    </svg>
                                </div>
                                <div class="flex flex-col flex-1 min-w-0">
                                    <span class="text-[11px] font-semibold text-slate-500 uppercase tracking-wide">Status Akun</span>
                                    <span class="text-[14px] font-bold text-emerald-600 truncate">{{ $status ?? 'Aktif' }}</span>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <!-- Penugasan -->
                    <div class="flex flex-col gap-3">
                        <h3 class="text-[13px] font-bold text-slate-800 px-1 border-l-4 border-sky-500 pl-2">Data Penugasan</h3>
                        <div class="flex flex-col mt-1">
                            
                            <div class="flex items-center gap-3.5 py-3.5 border-b border-slate-100/80">
                                <div class="w-10 h-10 rounded-full bg-sky-50 border border-sky-100 flex items-center justify-center text-sky-600 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                                    </svg>
                                </div>
                                <div class="flex flex-col flex-1 min-w-0">
                                    <span class="text-[11px] font-semibold text-slate-500 uppercase tracking-wide">Posyandu</span>
                                    <span class="text-[14px] font-bold text-slate-800 truncate">{{ $posyanduName ?? 'Posyandu Melati 1' }}</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3.5 py-3.5 border-b border-slate-100/80">
                                <div class="w-10 h-10 rounded-full bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                </div>
                                <div class="flex flex-col flex-1 min-w-0">
                                    <span class="text-[11px] font-semibold text-slate-500 uppercase tracking-wide">Wilayah Cakupan</span>
                                    <span class="text-[14px] font-bold text-slate-800 truncate">{{ $desa ?? 'Desa Lampeuneurut' }}, Kec. {{ $kecamatan ?? 'Darul Imarah' }}</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3.5 py-3.5">
                                <div class="w-10 h-10 rounded-full bg-teal-50 border border-teal-100 flex items-center justify-center text-teal-600 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                    </svg>
                                </div>
                                <div class="flex flex-col flex-1 min-w-0">
                                    <span class="text-[11px] font-semibold text-slate-500 uppercase tracking-wide">Fasilitas Rujukan</span>
                                    <span class="text-[14px] font-bold text-slate-800 truncate">{{ $puskesmas ?? 'Puskesmas Darul Imarah' }}</span>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <!-- Danger Zone -->
                <div class="mt-2 pt-6 border-t border-slate-100">
                    <div class="bg-rose-50/50 rounded-2xl p-5 sm:p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 border border-rose-100/60">
                        <div class="flex flex-col gap-1 text-center sm:text-left">
                            <h4 class="text-[14px] font-bold text-rose-900">Keluar dari Perangkat</h4>
                            <p class="text-[12px] sm:text-[13px] text-rose-700/70 font-medium">Akhiri sesi ini untuk mencegah akses yang tidak sah.</p>
                        </div>
                        
                        <form action="{{ route('logout') }}" method="POST" onsubmit="if(window.NutriAlert && typeof window.NutriAlert.confirm === 'function'){ event.preventDefault(); const form = this; window.NutriAlert.confirm('Keluar dari Akun?', 'Apakah Anda yakin ingin keluar dari Portal Kader?', 'Keluar', 'Batal').then((r) => { if(r.isConfirmed) form.submit(); }); return false; } return confirm('Keluar dari Portal Kader?');">
                            @csrf
                            <button type="submit" class="inline-flex items-center justify-center px-5 py-2.5 bg-white text-rose-600 border border-rose-200 shadow-sm hover:shadow-md hover:bg-rose-50 rounded-[14px] text-[13px] font-bold transition-all gap-2 flex-shrink-0 w-full sm:w-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>
                                <span>Keluar Sesi</span>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="flex justify-center opacity-40">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">NutriGen v1.0.0</p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
