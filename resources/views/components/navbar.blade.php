<header class="fixed top-0 inset-x-0 lg:left-72 bg-white z-30 flex items-center justify-between px-6 h-16 border-b border-slate-200">
    <!-- Hamburger (Mobile) -->
    <button id="sidebarToggle" class="p-2 -ml-2 text-slate-500 hover:text-slate-800 transition-colors lg:hidden" aria-label="Buka menu">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>
    
    <!-- Page Title — Dynamic per halaman -->
    <h1 class="text-lg font-bold text-slate-800 tracking-tight lg:hidden">NutriGen</h1>
    
    <div class="hidden lg:flex items-center gap-3">
        <h1 class="text-lg font-semibold text-slate-800 tracking-tight">@yield('page-title', 'Beranda')</h1>
    </div>
    
    <!-- Utilities -->
    <div class="flex items-center gap-3">
        <button class="relative p-2 text-slate-500 hover:text-slate-800 hover:bg-slate-50 rounded-full transition-colors" aria-label="Notifikasi">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
            <!-- Badge dot -->
            <span class="absolute top-1.5 right-1.5 w-2.5 h-2.5 bg-rose-500 rounded-full border-2 border-white"></span>
        </button>
    </div>
</header>
