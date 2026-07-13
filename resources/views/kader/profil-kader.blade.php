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
| Replace the current GET redirect with a POST form.
--}}

@section('content')
<div class="flex flex-col w-full bg-slate-50/50 min-h-screen">

    <!-- Header -->
    <div class="bg-white px-5 pt-5 pb-4 shadow-sm border-b border-slate-100 sticky top-0 z-20">
        <div class="max-w-2xl mx-auto w-full flex items-center gap-3">
            <button onclick="history.back()"
                    class="flex flex-shrink-0 items-center justify-center w-11 h-11 -ml-2 text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-full transition-all focus:outline-none focus:ring-2 focus:ring-slate-300"
                    aria-label="Kembali">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>
            <h1 class="text-xl font-extrabold text-slate-800 tracking-tight">Profil Kader</h1>
        </div>
    </div>

    <div class="max-w-2xl mx-auto w-full px-5 py-5 pb-24 flex flex-col gap-5">

        <!-- Hero: Avatar & Identitas Utama -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex flex-col items-center text-center gap-3">
            <!-- Avatar -->
            <div class="relative">
                <div class="w-20 h-20 rounded-2xl bg-teal-100 border-2 border-teal-200 flex items-center justify-center text-teal-600 overflow-hidden">
                    @if(isset($avatarUrl))
                        <img src="{{ $avatarUrl }}" alt="Foto Kader" class="w-full h-full object-cover">
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                        </svg>
                    @endif
                </div>
                <!-- Status Aktif -->
                <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-emerald-500 rounded-full border-2 border-white flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="white" class="w-3 h-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                </div>
            </div>

            <!-- Nama & Role -->
            <div>
                <h2 class="text-xl font-extrabold text-slate-800 tracking-tight leading-tight">
                    {{ $kaderName ?? 'Ibu Siti Aminah' }}
                </h2>
                <div class="mt-1 inline-flex items-center gap-1.5 bg-teal-50 text-teal-700 px-3 py-1 rounded-full border border-teal-200/60">
                    <div class="w-1.5 h-1.5 rounded-full bg-teal-500"></div>
                    <span class="text-[11px] font-bold uppercase tracking-wider">{{ $role ?? 'Kader Posyandu' }}</span>
                </div>
            </div>
        </div>

        <!-- Data Diri -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-5 py-3.5 border-b border-slate-100">
                <h3 class="text-[11px] font-extrabold text-slate-500 uppercase tracking-widest">Informasi Akun</h3>
            </div>
            <div class="flex flex-col divide-y divide-slate-50">

                <!-- Email -->
                <div class="flex items-center gap-3 px-5 py-3.5 hover:bg-slate-50 transition-colors">
                    <div class="w-8 h-8 rounded-xl bg-slate-100 flex items-center justify-center text-slate-500 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                    </div>
                    <div class="flex flex-col flex-1 min-w-0">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Email</span>
                        <span class="text-sm font-semibold text-slate-800 truncate">{{ $email ?? 'siti.aminah@posyandu.go.id' }}</span>
                    </div>
                </div>

                <!-- Nomor HP -->
                <div class="flex items-center gap-3 px-5 py-3.5 hover:bg-slate-50 transition-colors">
                    <div class="w-8 h-8 rounded-xl bg-slate-100 flex items-center justify-center text-slate-500 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.069-3.769-6.665-6.666l1.292-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                        </svg>
                    </div>
                    <div class="flex flex-col flex-1 min-w-0">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Nomor HP</span>
                        <span class="text-sm font-semibold text-slate-800">{{ $phone ?? '08123456789' }}</span>
                    </div>
                </div>

                <!-- Status Akun -->
                <div class="flex items-center gap-3 px-5 py-3.5 hover:bg-slate-50 transition-colors">
                    <div class="w-8 h-8 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>
                    </div>
                    <div class="flex flex-col flex-1 min-w-0">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Status Akun</span>
                        <span class="text-sm font-bold text-emerald-600">{{ $status ?? 'Aktif' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Penugasan -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-5 py-3.5 border-b border-slate-100">
                <h3 class="text-[11px] font-extrabold text-slate-500 uppercase tracking-widest">Data Penugasan</h3>
            </div>
            <div class="flex flex-col divide-y divide-slate-50">

                <!-- Posyandu -->
                <div class="flex items-center gap-3 px-5 py-3.5 hover:bg-slate-50 transition-colors">
                    <div class="w-8 h-8 rounded-xl bg-teal-50 flex items-center justify-center text-teal-600 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                        </svg>
                    </div>
                    <div class="flex flex-col flex-1 min-w-0">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Posyandu</span>
                        <span class="text-sm font-semibold text-slate-800">{{ $posyanduName ?? 'Posyandu Melati 1' }}</span>
                    </div>
                </div>

                <!-- Desa -->
                <div class="flex items-center gap-3 px-5 py-3.5 hover:bg-slate-50 transition-colors">
                    <div class="w-8 h-8 rounded-xl bg-slate-100 flex items-center justify-center text-slate-500 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                    </div>
                    <div class="flex flex-col flex-1 min-w-0">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Desa / Kelurahan</span>
                        <span class="text-sm font-semibold text-slate-800">{{ $desa ?? 'Desa Lampeuneurut' }}</span>
                    </div>
                </div>

                <!-- Puskesmas -->
                <div class="flex items-center gap-3 px-5 py-3.5 hover:bg-slate-50 transition-colors">
                    <div class="w-8 h-8 rounded-xl bg-slate-100 flex items-center justify-center text-slate-500 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <div class="flex flex-col flex-1 min-w-0">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Puskesmas</span>
                        <span class="text-sm font-semibold text-slate-800">{{ $puskesmas ?? 'Puskesmas Darul Imarah' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-rose-100 shadow-sm overflow-hidden mt-2">
            {{-- Backend: Logout should use POST form, not GET.
                 <form action="{{ route('logout') }}" method="POST">@csrf
                   <button type="submit">Keluar dari Akun</button>
                 </form> --}}
            <a href="{{ route('logout') }}"
               class="flex items-center gap-3 px-5 py-4 text-rose-600 hover:bg-rose-50 transition-colors"
               onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                <div class="w-8 h-8 rounded-xl bg-rose-50 flex items-center justify-center text-rose-500 flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                </div>
                <span class="text-sm font-bold">Keluar dari Akun</span>
            </a>
        </div>

        <!-- Versi Aplikasi -->
        <p class="text-center text-[11px] text-slate-400 font-medium pb-2">
            NutriGen v1.0.0 · Sistem Monitoring Gizi Anak
        </p>

    </div>
</div>
@endsection
