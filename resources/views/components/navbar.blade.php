<header class="fixed top-0 inset-x-0 lg:left-72 bg-white z-30 flex items-center justify-between px-5 h-16 border-b border-gray-100">
    <!-- Hamburger (Mobile) -->
    <button id="sidebarToggle" class="p-2 -ml-2 text-gray-700 hover:text-teal-600 transition-colors lg:hidden" aria-label="Buka menu">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>
    
    <!-- Page Title — Dynamic per halaman -->
    <!-- Mobile: Branding NutriGen, Desktop: Nama Halaman -->
    <h1 class="text-lg font-bold text-gray-900 tracking-tight lg:hidden">NutriGen</h1>
    <h1 class="hidden lg:block text-xl font-bold text-slate-800">@yield('page-title', 'Beranda')</h1>
    
    <!-- Bell Notifikasi -->
    <button class="p-2 -mr-2 text-gray-700 hover:text-teal-600 transition-colors" aria-label="Notifikasi">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
        </svg>
    </button>
</header>
