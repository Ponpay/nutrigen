<header :class="{'bg-white/80 backdrop-blur-md shadow-[0_4px_20px_rgba(0,0,0,0.02)] border-[#E2E8F0]/50': scrolled, 'bg-white border-[#E2E8F0]': !scrolled}" class="flex-shrink-0 z-50 flex items-center justify-between px-6 lg:px-8 h-[76px] border-b w-full sticky top-0 transition-all duration-300">
    <!-- Left: Hamburger & Mobile Logo -->
    <div class="flex items-center gap-4">
        <!-- Hamburger (Mobile Only) -->
        <button id="sidebarToggle" class="p-2 -ml-2 text-[#64748B] hover:text-[#1E293B] hover:bg-[#F8FAFC] rounded-xl transition-all lg:hidden" aria-label="Buka menu">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>
        
        <!-- Logo & Title (Mobile Only) -->
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 lg:hidden">
            <div class="w-8 h-8 flex items-center justify-center flex-shrink-0">
                <img src="{{ asset('images/logo/logo-nutrigen.png') }}" alt="NutriGen Logo" class="w-full h-full object-contain">
            </div>
            <div class="flex flex-col">
                <h1 class="text-[17px] font-black text-[#1E293B] tracking-tight leading-none">NutriGen</h1>
                <span class="text-[8px] font-extrabold text-slate-400 tracking-[0.2em] uppercase mt-0.5 hidden sm:block">Monitoring Gizi Anak</span>
            </div>
        </a>
    </div>

    <!-- Center: Search Bar (Puskesmas Only) -->
    @if(request()->is('puskesmas*'))
    <div class="hidden lg:flex flex-1 max-w-xl mx-8">
        <div class="flex items-center gap-2.5 bg-[#F8FAFC] border border-transparent hover:bg-white hover:border-[#E2E8F0] px-4 h-11 rounded-xl text-[#94A3B8] text-sm focus-within:bg-white focus-within:border-[#10B981] focus-within:ring-2 focus-within:ring-[#A7F3D0] transition-all duration-300 w-full group shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 group-focus-within:text-[#10B981] transition-colors">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
            <input type="text" placeholder="Cari balita, posyandu, kader, atau data..." class="bg-transparent border-none focus:ring-0 text-[#1E293B] w-full p-0 text-[13px] font-medium placeholder-[#94A3B8] outline-none">
            <div class="flex items-center gap-1">
                <kbd class="hidden xl:inline-block font-sans text-[9px] font-bold text-slate-400 bg-white border border-slate-200 rounded px-1.5 py-0.5 shadow-sm">⌘</kbd>
                <kbd class="hidden xl:inline-block font-sans text-[9px] font-bold text-slate-400 bg-white border border-slate-200 rounded px-1.5 py-0.5 shadow-sm">K</kbd>
            </div>
        </div>
    </div>
    @else
    <!-- Center: Desktop Navigation (Kader Only) -->
    <div class="hidden lg:flex items-center gap-8 absolute left-1/2 -translate-x-1/2 h-full">
        <a href="{{ route('kader.dashboard') }}" class="relative flex items-center h-full px-2 text-[14px] font-bold transition-all {{ request()->routeIs('kader.dashboard') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }}">
            Dashboard
            @if(request()->routeIs('kader.dashboard'))
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-emerald-500 rounded-t-full"></div>
            @endif
        </a>
        <a href="{{ route('balita.index') }}" class="relative flex items-center h-full px-2 text-[14px] font-bold transition-all {{ request()->routeIs('balita.*') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }}">
            Balita
            @if(request()->routeIs('balita.*'))
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-emerald-500 rounded-t-full"></div>
            @endif
        </a>
        <a href="{{ route('jadwal.index') }}" class="relative flex items-center h-full px-2 text-[14px] font-bold transition-all {{ request()->routeIs('jadwal.*') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }}">
            Jadwal
            @if(request()->routeIs('jadwal.*'))
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-emerald-500 rounded-t-full"></div>
            @endif
        </a>
        <a href="{{ route('laporan.index') }}" class="relative flex items-center h-full px-2 text-[14px] font-bold transition-all {{ request()->routeIs('laporan.*') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }}">
            Laporan
            @if(request()->routeIs('laporan.*'))
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-emerald-500 rounded-t-full"></div>
            @endif
        </a>
    </div>
    @endif
    
    <!-- Right: Utilities & Profile -->
    <div class="flex items-center gap-2 lg:gap-4 ml-auto">
        <!-- Search Toggle (Mobile Only) -->
        <button class="lg:hidden p-2 text-[#64748B] hover:text-[#1E293B] hover:bg-[#F8FAFC] rounded-xl transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
        </button>
        
        @if(!request()->is('puskesmas*'))
        <!-- Search (Kader Desktop) -->
        <div class="hidden md:flex items-center gap-2.5 bg-[#F8FAFC] border border-transparent hover:bg-white hover:border-[#E2E8F0] px-4 h-10 rounded-xl text-[#94A3B8] text-sm focus-within:bg-white focus-within:border-[#10B981] focus-within:ring-2 focus-within:ring-[#A7F3D0] transition-all duration-300 w-64 group shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 group-focus-within:text-[#10B981] transition-colors">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
            <input type="text" placeholder="Cari data..." class="bg-transparent border-none focus:ring-0 text-[#1E293B] w-full p-0 text-[13px] font-medium placeholder-[#94A3B8] outline-none">
        </div>
        @endif

        <!-- Notification -->
        <button class="relative w-10 h-10 flex items-center justify-center text-[#64748B] hover:text-[#10B981] hover:bg-[#ECFDF5] rounded-xl transition-colors group" aria-label="Notifikasi">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-[22px] h-[22px] group-hover:animate-[wiggle_1s_ease-in-out_infinite]">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
            <!-- Badge -->
            <span class="absolute top-2 right-2.5 w-2 h-2 bg-red-500 rounded-full border border-white"></span>
        </button>
        
        <div class="w-px h-6 bg-[#E2E8F0] hidden lg:block mx-1"></div>

        @if(request()->is('puskesmas*'))
        <!-- Profile Dropdown Trigger (Puskesmas Desktop) -->
        <button class="hidden lg:flex items-center gap-3 p-1.5 hover:bg-slate-50 rounded-xl transition-colors group text-left">
            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-sky-400 to-blue-600 flex items-center justify-center text-white shrink-0 shadow-sm border-2 border-white overflow-hidden">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="flex flex-col min-w-0">
                <span class="text-[13px] font-bold text-slate-800 leading-tight group-hover:text-blue-600 transition-colors truncate">{{ Auth::user()->name ?? 'Admin' }}</span>
                <span class="text-[11px] font-medium text-slate-500 truncate">{{ Auth::user()->puskesmas->nama ?? 'Puskesmas' }}</span>
            </div>
        </button>
        @endif
    </div>
</header>
