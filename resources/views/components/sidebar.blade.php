<!-- Mobile Sidebar Backdrop -->
<div x-show="mobileSidebarOpen" 
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-[100] lg:hidden" 
     @click="mobileSidebarOpen = false"
     style="display: none;"></div>

<!-- Sidebar Container -->
<aside :class="{
        'translate-x-0 w-[260px]': mobileSidebarOpen,
        '-translate-x-full w-[260px]': !mobileSidebarOpen,
        'lg:translate-x-0': true,
        'lg:w-[260px]': sidebarExpanded,
        'lg:w-[88px]': !sidebarExpanded
    }"
    class="fixed lg:static inset-y-0 left-0 z-[110] flex flex-col h-full bg-white border-r border-slate-200 transition-all duration-300 ease-[cubic-bezier(0.16,1,0.3,1)] overflow-hidden shrink-0">
    
    <!-- Top Brand Area -->
    <div class="h-[76px] flex items-center shrink-0 px-5 border-b border-slate-100">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 overflow-hidden">
            <div class="w-8 h-8 shrink-0 flex items-center justify-center">
                <img src="{{ asset('images/logo/logo-nutrigen.png') }}" alt="NutriGen Logo" class="w-full h-full object-contain">
            </div>
            <div class="flex flex-col min-w-0 transition-opacity duration-200"
                 :class="{'opacity-100': sidebarExpanded, 'lg:opacity-0 lg:hidden': !sidebarExpanded}">
                <h1 class="text-[19px] font-black text-slate-900 tracking-tight leading-none whitespace-nowrap">NutriGen</h1>
            </div>
        </a>
    </div>

    <!-- Navigation Area -->
    <div class="flex-1 overflow-y-auto overflow-x-hidden hide-scrollbar py-4 px-3 flex flex-col gap-1.5">
        
        <div class="mb-2 px-2 transition-opacity duration-200" 
             :class="{'opacity-100': sidebarExpanded, 'lg:opacity-0 lg:h-0 lg:overflow-hidden': !sidebarExpanded}">
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Menu Utama</span>
        </div>

        @if(request()->is('puskesmas*'))
            <!-- PUSKESMAS LINKS -->
            <a href="{{ route('puskesmas.dashboard') }}" 
               class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl font-semibold text-[14px] transition-all group whitespace-nowrap {{ request()->routeIs('puskesmas.dashboard') ? 'bg-sky-50 text-sky-700' : 'text-slate-500 hover:bg-slate-50 hover:text-sky-600' }}">
                <x-icon name="squares-four" weight="{{ request()->routeIs('puskesmas.dashboard') ? 'fill' : 'bold' }}" class="text-[20px] shrink-0" />
                <span class="truncate transition-opacity duration-200" :class="{'opacity-100': sidebarExpanded, 'lg:opacity-0 lg:w-0 lg:overflow-hidden': !sidebarExpanded}">Dashboard</span>
            </a>

            <a href="{{ route('puskesmas.validasi') }}" 
               class="flex items-center justify-between px-3 py-2.5 rounded-xl font-semibold text-[14px] transition-all group whitespace-nowrap {{ request()->routeIs('puskesmas.validasi') ? 'bg-sky-50 text-sky-700' : 'text-slate-500 hover:bg-slate-50 hover:text-sky-600' }}">
                <div class="flex items-center gap-3.5">
                    <x-icon name="check-circle" weight="{{ request()->routeIs('puskesmas.validasi') ? 'fill' : 'bold' }}" class="text-[20px] shrink-0" />
                    <span class="truncate transition-opacity duration-200" :class="{'opacity-100': sidebarExpanded, 'lg:opacity-0 lg:w-0 lg:overflow-hidden': !sidebarExpanded}">Validasi</span>
                </div>
                @if(($validationNotifsCount ?? 0) > 0)
                <span class="bg-sky-500 text-white text-[10px] px-1.5 py-0.5 rounded-full font-bold shadow-sm transition-opacity duration-200" :class="{'opacity-100': sidebarExpanded, 'lg:opacity-0 lg:hidden': !sidebarExpanded}">{{ $validationNotifsCount }}</span>
                @endif
            </a>

            <a href="{{ route('puskesmas.balita') }}" 
               class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl font-semibold text-[14px] transition-all group whitespace-nowrap {{ request()->routeIs('puskesmas.balita') ? 'bg-sky-50 text-sky-700' : 'text-slate-500 hover:bg-slate-50 hover:text-sky-600' }}">
                <x-icon name="users" weight="{{ request()->routeIs('puskesmas.balita') ? 'fill' : 'bold' }}" class="text-[20px] shrink-0" />
                <span class="truncate transition-opacity duration-200" :class="{'opacity-100': sidebarExpanded, 'lg:opacity-0 lg:w-0 lg:overflow-hidden': !sidebarExpanded}">Data Balita</span>
            </a>

            <a href="{{ route('puskesmas.posyandu') ?? '/puskesmas/posyandu' }}" 
               class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl font-semibold text-[14px] transition-all group whitespace-nowrap {{ request()->is('puskesmas/posyandu*') ? 'bg-sky-50 text-sky-700' : 'text-slate-500 hover:bg-slate-50 hover:text-sky-600' }}">
                <x-icon name="storefront" weight="{{ request()->is('puskesmas/posyandu*') ? 'fill' : 'bold' }}" class="text-[20px] shrink-0" />
                <span class="truncate transition-opacity duration-200" :class="{'opacity-100': sidebarExpanded, 'lg:opacity-0 lg:w-0 lg:overflow-hidden': !sidebarExpanded}">Posyandu & Kader</span>
            </a>

            <a href="{{ route('puskesmas.laporan') ?? '/puskesmas/laporan' }}" 
               class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl font-semibold text-[14px] transition-all group whitespace-nowrap {{ request()->is('puskesmas/laporan*') ? 'bg-sky-50 text-sky-700' : 'text-slate-500 hover:bg-slate-50 hover:text-sky-600' }}">
                <x-icon name="chart-bar" weight="{{ request()->is('puskesmas/laporan*') ? 'fill' : 'bold' }}" class="text-[20px] shrink-0" />
                <span class="truncate transition-opacity duration-200" :class="{'opacity-100': sidebarExpanded, 'lg:opacity-0 lg:w-0 lg:overflow-hidden': !sidebarExpanded}">Laporan</span>
            </a>

            <a href="{{ route('puskesmas.pengaturan') ?? '/puskesmas/pengaturan' }}" 
               class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl font-semibold text-[14px] transition-all group whitespace-nowrap {{ request()->is('puskesmas/pengaturan*') ? 'bg-sky-50 text-sky-700' : 'text-slate-500 hover:bg-slate-50 hover:text-sky-600' }}">
                <x-icon name="gear" weight="{{ request()->is('puskesmas/pengaturan*') ? 'fill' : 'bold' }}" class="text-[20px] shrink-0" />
                <span class="truncate transition-opacity duration-200" :class="{'opacity-100': sidebarExpanded, 'lg:opacity-0 lg:w-0 lg:overflow-hidden': !sidebarExpanded}">Pengaturan</span>
            </a>

        @else
            <!-- KADER LINKS -->
            <a href="{{ route('kader.dashboard') }}" 
               class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl font-semibold text-[14px] transition-all group whitespace-nowrap {{ request()->routeIs('kader.dashboard') ? 'bg-teal-50 text-teal-700' : 'text-slate-500 hover:bg-slate-50 hover:text-teal-600' }}">
                <x-icon name="squares-four" weight="{{ request()->routeIs('kader.dashboard') ? 'fill' : 'bold' }}" class="text-[20px] shrink-0" />
                <span class="truncate transition-opacity duration-200" :class="{'opacity-100': sidebarExpanded, 'lg:opacity-0 lg:w-0 lg:overflow-hidden': !sidebarExpanded}">Dashboard</span>
            </a>

            <a href="{{ route('balita.index') }}" 
               class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl font-semibold text-[14px] transition-all group whitespace-nowrap {{ request()->routeIs('balita.*') ? 'bg-teal-50 text-teal-700' : 'text-slate-500 hover:bg-slate-50 hover:text-teal-600' }}">
                <x-icon name="users" weight="{{ request()->routeIs('balita.*') ? 'fill' : 'bold' }}" class="text-[20px] shrink-0" />
                <span class="truncate transition-opacity duration-200" :class="{'opacity-100': sidebarExpanded, 'lg:opacity-0 lg:w-0 lg:overflow-hidden': !sidebarExpanded}">Data Balita</span>
            </a>

            <a href="{{ route('jadwal.index') }}" 
               class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl font-semibold text-[14px] transition-all group whitespace-nowrap {{ request()->routeIs('jadwal.*') ? 'bg-teal-50 text-teal-700' : 'text-slate-500 hover:bg-slate-50 hover:text-teal-600' }}">
                <x-icon name="calendar-blank" weight="{{ request()->routeIs('jadwal.*') ? 'fill' : 'bold' }}" class="text-[20px] shrink-0" />
                <span class="truncate transition-opacity duration-200" :class="{'opacity-100': sidebarExpanded, 'lg:opacity-0 lg:w-0 lg:overflow-hidden': !sidebarExpanded}">Jadwal Posyandu</span>
            </a>

            <a href="{{ route('laporan.index') }}" 
               class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl font-semibold text-[14px] transition-all group whitespace-nowrap {{ request()->routeIs('laporan.*') ? 'bg-teal-50 text-teal-700' : 'text-slate-500 hover:bg-slate-50 hover:text-teal-600' }}">
                <x-icon name="chart-bar" weight="{{ request()->routeIs('laporan.*') ? 'fill' : 'bold' }}" class="text-[20px] shrink-0" />
                <span class="truncate transition-opacity duration-200" :class="{'opacity-100': sidebarExpanded, 'lg:opacity-0 lg:w-0 lg:overflow-hidden': !sidebarExpanded}">Laporan</span>
            </a>
            
            <a href="{{ route('kader.profil') }}" 
               class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl font-semibold text-[14px] transition-all group whitespace-nowrap {{ request()->routeIs('kader.profil*') ? 'bg-teal-50 text-teal-700' : 'text-slate-500 hover:bg-slate-50 hover:text-teal-600' }}">
                <x-icon name="user" weight="{{ request()->routeIs('kader.profil*') ? 'fill' : 'bold' }}" class="text-[20px] shrink-0" />
                <span class="truncate transition-opacity duration-200" :class="{'opacity-100': sidebarExpanded, 'lg:opacity-0 lg:w-0 lg:overflow-hidden': !sidebarExpanded}">Profil Kader</span>
            </a>
        @endif

    </div>

    <!-- Collapse Toggle (Desktop Only) -->
    <div class="hidden lg:flex px-4 py-3 border-t border-slate-100 shrink-0">
        <button @click="sidebarExpanded = !sidebarExpanded" 
                class="flex items-center gap-3 text-slate-400 hover:text-slate-700 transition-colors w-full p-2 rounded-xl hover:bg-slate-50 focus:outline-none">
            <x-icon name="caret-left" weight="bold" class="text-[18px] shrink-0 transition-transform duration-300" :class="{ 'rotate-180': !sidebarExpanded }" />
            <span class="text-sm font-semibold whitespace-nowrap transition-opacity duration-200" :class="{'opacity-100': sidebarExpanded, 'lg:opacity-0 lg:w-0 lg:overflow-hidden': !sidebarExpanded}">Collapse Menu</span>
        </button>
    </div>

    <!-- User Profile Area -->
    <div class="p-4 border-t border-slate-100 shrink-0">
        <div class="relative w-full" x-data="{ openProfileMenu: false }">
            <button @click="openProfileMenu = !openProfileMenu" @click.outside="openProfileMenu = false"
                    class="flex items-center gap-3 w-full p-1.5 hover:bg-slate-50 rounded-xl transition-all duration-200 group text-left border border-transparent hover:border-slate-200 cursor-pointer focus:outline-none focus:ring-2 focus:ring-teal-500/20"
                    :class="{ 'justify-center': !sidebarExpanded && window.innerWidth >= 1024 }">
                
                <div class="w-9 h-9 rounded-full bg-gradient-to-br {{ request()->is('puskesmas*') ? 'from-sky-400 to-blue-600' : 'from-teal-400 to-emerald-600' }} flex items-center justify-center text-white shrink-0 shadow-sm border-2 border-white group-hover:scale-105 transition-all overflow-hidden">
                    <x-icon name="user" weight="fill" class="text-lg" />
                </div>
                
                <div class="flex flex-col min-w-0 flex-1 transition-opacity duration-200"
                     :class="{'opacity-100': sidebarExpanded, 'lg:opacity-0 lg:w-0 lg:hidden': !sidebarExpanded}">
                    <span class="text-[13px] font-bold text-slate-800 leading-tight truncate group-hover:{{ request()->is('puskesmas*') ? 'text-blue-600' : 'text-emerald-600' }} transition-colors">{{ Auth::user()->name ?? 'Ibu Kader' }}</span>
                    <span class="text-[11px] font-medium text-slate-500 truncate">{{ request()->is('puskesmas*') ? Auth::user()->puskesmas->nama ?? 'Puskesmas' : $posyanduName ?? 'Posyandu Melati 1' }}</span>
                </div>
                
                <x-icon name="dots-three-vertical" weight="bold" class="text-slate-400 shrink-0 transition-opacity duration-200" :class="{'opacity-100': sidebarExpanded, 'lg:opacity-0 lg:hidden': !sidebarExpanded}" />
            </button>

            <!-- Popup Menu -->
            <div x-show="openProfileMenu" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                 class="absolute bottom-full left-0 mb-2 w-56 bg-white rounded-2xl shadow-[0_10px_30px_-10px_rgba(0,0,0,0.15)] ring-1 ring-slate-100 p-2 z-[120]"
                 style="display: none;">
                
                <a href="javascript:void(0)" onclick="window.NutriAlert.success('Versi Sistem', 'NutriGen v1.0.0')" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-emerald-600 font-bold text-[13px] transition-colors group">
                    <x-icon name="info" weight="bold" class="text-[16px] text-slate-400 group-hover:text-emerald-500" />
                    Tentang Aplikasi
                </a>

                <div class="h-px w-full bg-slate-100 my-1"></div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-rose-600 hover:bg-rose-50 font-bold text-[13px] transition-colors group text-left cursor-pointer">
                        <x-icon name="sign-out" weight="bold" class="text-[16px] text-rose-400 group-hover:text-rose-600" />
                        Keluar Aplikasi
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>
