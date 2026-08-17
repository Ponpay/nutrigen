<header :class="{'bg-white/80 backdrop-blur-md shadow-[0_4px_20px_rgba(0,0,0,0.02)] border-slate-200/50': scrolled, 'bg-white border-slate-200': !scrolled}" class="flex-shrink-0 z-50 flex items-center justify-between px-6 lg:px-8 h-[76px] border-b w-full sticky top-0 transition-all duration-300">
    <!-- Left: Hamburger & Mobile Logo -->
    <div class="flex items-center gap-4">
        <!-- Hamburger (Mobile Only) -->
        <button id="sidebarToggle" class="p-2 -ml-2 text-slate-500 hover:text-slate-900 hover:bg-slate-50 rounded-xl transition-all lg:hidden" aria-label="Buka menu">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>
        
        <!-- Logo & Title -->
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
            <div class="w-8 h-8 flex items-center justify-center flex-shrink-0">
                <img src="{{ asset('images/logo/logo-nutrigen.png') }}" alt="NutriGen Logo" class="w-full h-full object-contain">
            </div>
            <div class="flex flex-col">
                <h1 class="text-[17px] font-black text-slate-900 tracking-tight leading-none">NutriGen</h1>
                <span class="text-[8px] font-extrabold text-slate-400 tracking-[0.2em] uppercase mt-0.5 hidden sm:block">Monitoring Gizi Anak</span>
            </div>
        </a>
    </div>

    <!-- Center: Search Bar (Puskesmas Only) -->
    @if(request()->is('puskesmas*'))
    <div class="hidden lg:flex flex-1 max-w-xl mx-8">
        <div class="flex items-center gap-2.5 bg-slate-50 border border-transparent hover:bg-white hover:border-slate-200 px-4 h-11 rounded-xl text-slate-400 text-sm focus-within:bg-white focus-within:border-[#10B981] focus-within:ring-2 focus-within:ring-[#A7F3D0] transition-all duration-300 w-full group shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 group-focus-within:text-[#10B981] transition-colors">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
            <input type="text" placeholder="Cari balita, posyandu, kader, atau data..." class="bg-transparent border-none focus:ring-0 text-slate-900 w-full p-0 text-[13px] font-medium placeholder-[#94A3B8] outline-none">
            <div class="flex items-center gap-1">
                <kbd class="hidden xl:inline-block font-sans text-[9px] font-bold text-slate-400 bg-white border border-slate-200 rounded px-1.5 py-0.5 shadow-sm">⌘</kbd>
                <kbd class="hidden xl:inline-block font-sans text-[9px] font-bold text-slate-400 bg-white border border-slate-200 rounded px-1.5 py-0.5 shadow-sm">K</kbd>
            </div>
        </div>
    </div>
    @else
    <!-- Center: Desktop Navigation (Kader Only) -->
    <div class="hidden lg:flex items-center gap-8 absolute left-1/2 -translate-x-1/2 h-full">
        <a href="{{ route('kader.dashboard') }}" class="group relative flex items-center h-full px-2 text-[14px] font-bold transition-all {{ request()->routeIs('kader.dashboard') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }}">
            Dashboard
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-emerald-500 rounded-t-full transition-transform duration-300 origin-left {{ request()->routeIs('kader.dashboard') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></div>
        </a>
        <a href="{{ route('balita.index') }}" class="group relative flex items-center h-full px-2 text-[14px] font-bold transition-all {{ request()->routeIs('balita.*') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }}">
            Balita
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-emerald-500 rounded-t-full transition-transform duration-300 origin-left {{ request()->routeIs('balita.*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></div>
        </a>
        <a href="{{ route('jadwal.index') }}" class="group relative flex items-center h-full px-2 text-[14px] font-bold transition-all {{ request()->routeIs('jadwal.*') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }}">
            Jadwal
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-emerald-500 rounded-t-full transition-transform duration-300 origin-left {{ request()->routeIs('jadwal.*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></div>
        </a>
        <a href="{{ route('laporan.index') }}" class="group relative flex items-center h-full px-2 text-[14px] font-bold transition-all {{ request()->routeIs('laporan.*') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }}">
            Laporan
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-emerald-500 rounded-t-full transition-transform duration-300 origin-left {{ request()->routeIs('laporan.*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></div>
        </a>
    </div>
    @endif
    
    <!-- Right: Utilities & Profile -->
    <div class="flex items-center gap-2 lg:gap-4 ml-auto">
        <!-- Notification -->
        <button class="relative w-10 h-10 flex items-center justify-center text-slate-500 hover:text-[#10B981] hover:bg-[#ECFDF5] rounded-xl transition-colors group" aria-label="Notifikasi">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-[22px] h-[22px] group-hover:animate-[wiggle_1s_ease-in-out_infinite]">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
            <!-- Badge -->
            <span class="absolute top-2 right-2.5 w-2 h-2 bg-red-500 rounded-full border border-white"></span>
        </button>
        
        <div class="w-px h-6 bg-[#E2E8F0] hidden lg:block mx-1"></div>

        <!-- Desktop Profile Dropdown -->
        <div x-data="{ openProfile: false }" class="relative hidden lg:block">
            <button @click="openProfile = !openProfile" @click.outside="openProfile = false" class="flex items-center gap-3 p-1.5 hover:bg-slate-50 rounded-xl transition-all duration-200 group text-left border border-transparent hover:border-slate-200 cursor-pointer focus:outline-none focus:ring-2 focus:ring-emerald-500/20">
                <div class="w-9 h-9 rounded-full bg-gradient-to-br {{ request()->is('puskesmas*') ? 'from-sky-400 to-blue-600' : 'from-teal-400 to-emerald-600' }} flex items-center justify-center text-white shrink-0 shadow-sm border-2 border-white group-hover:scale-105 group-hover:shadow-md transition-all duration-300 overflow-hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="flex flex-col min-w-0">
                    <span class="text-[13px] font-bold text-slate-800 leading-tight group-hover:{{ request()->is('puskesmas*') ? 'text-blue-600' : 'text-emerald-600' }} transition-colors truncate">{{ Auth::user()->name ?? 'Ibu Kader' }}</span>
                    <span class="text-[11px] font-medium text-slate-500 truncate">{{ request()->is('puskesmas*') ? (Auth::user()->puskesmas->nama ?? 'Puskesmas') : ($posyanduName ?? 'Posyandu Melati 1') }}</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-slate-400 group-hover:text-slate-600 transition-transform duration-300" :class="{'rotate-180': openProfile}">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="openProfile" x-transition:enter="transition ease-[cubic-bezier(0.16,1,0.3,1)] duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-4" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-95 translate-y-2" style="display: none;" class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-[0_12px_40px_-12px_rgba(0,0,0,0.15)] ring-1 ring-slate-100 p-2 overflow-hidden z-50">
                @if(!request()->is('puskesmas*'))
                <a href="{{ route('kader.profil') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-emerald-600 font-bold text-[13px] transition-colors group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-slate-400 group-hover:text-emerald-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                    </svg>
                    Edit Profil
                </a>
                @endif
                
                <a href="javascript:void(0)" onclick="window.NutriAlert.warning('Segera Hadir', 'Fitur Bantuan segera hadir.')" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-emerald-600 font-bold text-[13px] transition-colors group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-slate-400 group-hover:text-emerald-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                    </svg>
                    Pusat Bantuan
                </a>
                <a href="javascript:void(0)" onclick="window.NutriAlert.success('Versi Sistem', 'NutriGen v1.0.0')" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-emerald-600 font-bold text-[13px] transition-colors group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-slate-400 group-hover:text-emerald-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                    Tentang Aplikasi
                </a>

                <div class="h-px w-full bg-slate-100 my-1"></div>

                <form action="{{ route('logout') }}" method="POST" onsubmit="if(window.NutriAlert && typeof window.NutriAlert.confirm === 'function'){ event.preventDefault(); const form = this; window.NutriAlert.confirm('Keluar dari Aplikasi?', 'Anda harus login kembali untuk mengakses data.', 'Keluar', 'Batal').then((r) => { if(r.isConfirmed) form.submit(); }); return false; } return confirm('Keluar dari Aplikasi?');">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-rose-600 hover:bg-rose-50 font-bold text-[13px] transition-colors group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-rose-400 group-hover:text-rose-600 group-hover:-translate-x-0.5 transition-transform">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                        Keluar Aplikasi
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
