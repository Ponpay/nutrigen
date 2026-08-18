<!-- Sidebar Backdrop Overlay -->
<div id="sidebarOverlay" 
     class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-[100] hidden opacity-0 transition-opacity duration-300 ease-out" 
     onclick="closeSidebarAction()"></div>

<!-- Slide-Over Drawer -->
<aside id="sidebar" 
       class="fixed inset-y-0 left-0 w-[300px] sm:w-[340px] max-w-[85vw] bg-white z-[110] transform -translate-x-full transition-transform duration-300 ease-[cubic-bezier(0.16,1,0.3,1)] flex flex-col shadow-2xl border-r border-slate-200/80 overflow-hidden">
    
    <!-- 1. Drawer Header (Profile Hero) -->
    <div class="relative bg-gradient-to-br from-teal-700 via-teal-600 to-teal-800 p-5 sm:p-6 text-white overflow-hidden shrink-0">
        {{-- Decorative ambient glow --}}
        <div class="absolute -right-8 -top-8 w-32 h-32 bg-teal-400/20 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute left-0 bottom-0 w-24 h-24 bg-teal-900/40 rounded-full blur-xl pointer-events-none"></div>

        {{-- Top Bar: Logo & Close Button --}}
        <div class="flex items-center justify-between relative z-10 mb-4">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-lg bg-white/15 backdrop-blur-sm border border-white/20 flex items-center justify-center p-1">
                    <img src="{{ asset('images/logo/logo-nutrigen.png') }}" alt="NutriGen" class="w-full h-full object-contain brightness-0 invert">
                </div>
                <span class="font-extrabold text-[15px] tracking-tight text-white">NutriGen</span>
            </div>

            <button id="closeSidebar" 
                    onclick="closeSidebarAction()" 
                    class="w-8 h-8 rounded-full bg-white/15 hover:bg-white/25 active:bg-white/30 text-white flex items-center justify-center transition-all cursor-pointer border border-white/20 shadow-xs" 
                    aria-label="Tutup menu">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- User Identity Card --}}
        <div class="flex items-center gap-3.5 relative z-10">
            <div class="relative shrink-0">
                <div class="w-13 h-13 rounded-2xl bg-white/20 backdrop-blur-md p-0.5 border border-white/30 shadow-md flex items-center justify-center">
                    <div class="w-full h-full bg-white rounded-[14px] flex items-center justify-center text-teal-700 font-bold overflow-hidden shadow-xs">
                        @if(Auth::user()?->role === 'puskesmas')
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 text-sky-600">
                                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 text-teal-600">
                                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                            </svg>
                        @endif
                    </div>
                </div>
                {{-- Active status dot --}}
                <div class="absolute -bottom-0.5 -right-0.5 w-3.5 h-3.5 rounded-full bg-emerald-400 border-2 border-teal-800"></div>
            </div>

            <div class="flex flex-col min-w-0">
                <span class="font-bold text-[15px] text-white tracking-tight leading-tight truncate">
                    {{ Auth::user()->name ?? 'Ibu Kader' }}
                </span>
                <span class="text-[11.5px] text-teal-100/90 font-medium truncate mt-0.5">
                    {{ Auth::user()->email ?? 'kader@nutrigen.com' }}
                </span>
                <div class="mt-1.5 flex items-center">
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-white/20 backdrop-blur-xs text-[10.5px] font-bold text-white tracking-wide border border-white/20">
                        {{ Auth::user()->role === 'puskesmas' ? (Auth::user()->puskesmas->nama ?? 'Puskesmas') : (Auth::user()->kader->posyandu->nama ?? 'Posyandu Melati 1') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Drawer Body (Scrollable Menu Items) -->
    <div class="flex-1 overflow-y-auto hide-scrollbar p-3.5 sm:p-4 flex flex-col gap-5">
        
        <!-- Navigation Group -->
        <div class="flex flex-col gap-1">
            <span class="px-2.5 text-[10.5px] font-extrabold text-slate-400 uppercase tracking-wider mb-1">Menu Utama</span>

            @if(request()->is('puskesmas*'))
                {{-- Puskesmas Links --}}
                <a href="{{ route('puskesmas.dashboard') }}" 
                   class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('puskesmas.dashboard') ? 'bg-sky-50 text-sky-700 font-extrabold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ request()->routeIs('puskesmas.dashboard') ? 'bg-sky-500 text-white' : 'bg-slate-100 text-slate-500' }}">
                            <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" /></svg>
                        </div>
                        <span>Dashboard</span>
                    </div>
                    <svg class="w-4 h-4 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </a>

                <a href="{{ route('puskesmas.balita') }}" 
                   class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('puskesmas.balita') ? 'bg-sky-50 text-sky-700 font-extrabold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ request()->routeIs('puskesmas.balita') ? 'bg-sky-500 text-white' : 'bg-slate-100 text-slate-500' }}">
                            <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" /></svg>
                        </div>
                        <span>Data Balita</span>
                    </div>
                    <svg class="w-4 h-4 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </a>

                <a href="{{ route('puskesmas.validasi') }}" 
                   class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('puskesmas.validasi*') ? 'bg-sky-50 text-sky-700 font-extrabold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ request()->routeIs('puskesmas.validasi*') ? 'bg-sky-500 text-white' : 'bg-slate-100 text-slate-500' }}">
                            <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                        </div>
                        <span>Validasi Data</span>
                    </div>
                    <svg class="w-4 h-4 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </a>
            @else
                {{-- Kader Links --}}
                <a href="{{ route('kader.dashboard') }}" 
                   class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('kader.dashboard') ? 'bg-teal-50 text-teal-800 font-extrabold shadow-2xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ request()->routeIs('kader.dashboard') ? 'bg-teal-600 text-white shadow-xs' : 'bg-slate-100 text-slate-500' }}">
                            <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" /></svg>
                        </div>
                        <span>Dashboard</span>
                    </div>
                    <svg class="w-4 h-4 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </a>

                <a href="{{ route('balita.index') }}" 
                   class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('balita.*') ? 'bg-teal-50 text-teal-800 font-extrabold shadow-2xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ request()->routeIs('balita.*') ? 'bg-teal-600 text-white shadow-xs' : 'bg-slate-100 text-slate-500' }}">
                            <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" /></svg>
                        </div>
                        <span>Daftar Balita</span>
                    </div>
                    <svg class="w-4 h-4 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </a>

                <a href="{{ route('jadwal.index') }}" 
                   class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('jadwal.*') ? 'bg-teal-50 text-teal-800 font-extrabold shadow-2xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ request()->routeIs('jadwal.*') ? 'bg-teal-600 text-white shadow-xs' : 'bg-slate-100 text-slate-500' }}">
                            <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" /></svg>
                        </div>
                        <span>Jadwal Posyandu</span>
                    </div>
                    <svg class="w-4 h-4 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </a>

                <a href="{{ route('laporan.index') }}" 
                   class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('laporan.*') ? 'bg-teal-50 text-teal-800 font-extrabold shadow-2xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ request()->routeIs('laporan.*') ? 'bg-teal-600 text-white shadow-xs' : 'bg-slate-100 text-slate-500' }}">
                            <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" /></svg>
                        </div>
                        <span>Pusat Laporan</span>
                    </div>
                    <svg class="w-4 h-4 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </a>
            @endif
        </div>

        <div class="h-px bg-slate-100 -mx-1"></div>

        <!-- Account & System Group -->
        <div class="flex flex-col gap-1">
            <span class="px-2.5 text-[10.5px] font-extrabold text-slate-400 uppercase tracking-wider mb-1">Akun & Bantuan</span>

            @if(!request()->is('puskesmas*'))
            <a href="{{ route('kader.profil') }}" 
               class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('kader.profil*') ? 'bg-teal-50 text-teal-800 font-extrabold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center bg-slate-100 text-slate-500">
                        <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" /></svg>
                    </div>
                    <span>Profil Saya</span>
                </div>
                <svg class="w-4 h-4 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </a>
            @endif

            <a href="javascript:void(0)" 
               onclick="window.NutriAlert.toast('Fitur Bantuan segera hadir.', 'info', 'Pusat Bantuan')"
               class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-all">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center bg-slate-100 text-slate-500">
                        <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 10-1-1zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg>
                    </div>
                    <span>Pusat Bantuan</span>
                </div>
                <span class="text-[10px] font-bold text-slate-400 bg-slate-100 px-2 py-0.5 rounded-md">FAQ</span>
            </a>

            <a href="javascript:void(0)" 
               onclick="window.NutriAlert.toast('Sistem NutriGen v1.0.0 (Latest)', 'success', 'Versi Aplikasi')"
               class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-all">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center bg-slate-100 text-slate-500">
                        <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" /></svg>
                    </div>
                    <span>Tentang Aplikasi</span>
                </div>
                <span class="text-[10px] font-bold text-teal-700 bg-teal-50 px-2 py-0.5 rounded-md border border-teal-100">v1.0</span>
            </a>
        </div>
    </div>

    <!-- 3. Drawer Footer (Clean Logout Action) -->
    <div class="p-4 border-t border-slate-100 bg-slate-50/70 shrink-0">
        <form action="{{ route('logout') }}" method="POST" onsubmit="if(window.NutriAlert && typeof window.NutriAlert.confirm === 'function'){ event.preventDefault(); const form = this; window.NutriAlert.confirm('Keluar dari Aplikasi?', 'Anda harus login kembali untuk mengakses data.', 'Keluar', 'Batal').then((r) => { if(r.isConfirmed) form.submit(); }); return false; } return confirm('Keluar dari Aplikasi?');">
            @csrf
            <button type="submit" 
                    class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-xl text-rose-700 bg-rose-50/80 hover:bg-rose-100 border border-rose-200/80 font-bold text-xs transition-all shadow-2xs hover:shadow-xs cursor-pointer active:scale-[0.99] group">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4 text-rose-500 group-hover:-translate-x-0.5 transition-transform">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                </svg>
                <span>Keluar Akun</span>
            </button>
        </form>
    </div>
</aside>

<script>
    function openSidebarAction() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        if (!sidebar || !overlay) return;
        
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        setTimeout(() => overlay.classList.remove('opacity-0'), 10);
        document.body.style.overflow = 'hidden';
    }

    function closeSidebarAction() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        if (!sidebar || !overlay) return;

        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('opacity-0');
        setTimeout(() => overlay.classList.add('hidden'), 300);
        document.body.style.overflow = '';
    }

    document.addEventListener('DOMContentLoaded', () => {
        const toggleBtn = document.getElementById('sidebarToggle');
        const closeBtn = document.getElementById('closeSidebar');
        const overlay = document.getElementById('sidebarOverlay');

        if (toggleBtn) toggleBtn.addEventListener('click', openSidebarAction);
        if (closeBtn) closeBtn.addEventListener('click', closeSidebarAction);
        if (overlay) overlay.addEventListener('click', closeSidebarAction);
    });
</script>
