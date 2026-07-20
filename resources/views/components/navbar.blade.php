<header class="flex-shrink-0 bg-white z-50 flex items-center justify-between px-6 lg:px-8 h-[76px] border-b border-[#E2E8F0] w-full sticky top-0 transition-all duration-300">
    <!-- Hamburger (Mobile) -->
    <button id="sidebarToggle" class="p-2 -ml-2 text-[#64748B] hover:text-[#1E293B] hover:bg-[#F8FAFC] rounded-xl transition-all lg:hidden" aria-label="Buka menu">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>
    
    <!-- Mobile Title -->
    <h1 class="text-[17px] font-black text-[#1E293B] tracking-tight lg:hidden">NutriGen</h1>
    
    <!-- Left: Page Title & Breadcrumbs -->
    <div class="hidden lg:flex flex-col justify-center h-full">
        <h1 class="text-xl font-extrabold text-[#1E293B] tracking-tight leading-none mb-1.5">@yield('page-title', 'Beranda')</h1>
        @hasSection('page-breadcrumbs')
            <div class="text-[11px] font-medium text-[#94A3B8] flex items-center gap-1.5">
                Beranda
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3 text-[#CBD5E1]">
                    <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                </svg>
                @yield('page-breadcrumbs')
            </div>
        @endif
    </div>
    
    <!-- Right: Utilities -->
    <div class="flex items-center gap-4">
        <!-- Search -->
        <div class="hidden md:flex items-center gap-2.5 bg-[#F8FAFC] border border-transparent hover:bg-white hover:border-[#E2E8F0] px-4 h-10 rounded-xl text-[#94A3B8] text-sm focus-within:bg-white focus-within:border-[#10B981] focus-within:ring-2 focus-within:ring-[#A7F3D0] transition-all duration-300 w-64 group shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 group-focus-within:text-[#10B981] transition-colors">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
            <input type="text" placeholder="Cari data..." class="bg-transparent border-none focus:ring-0 text-[#1E293B] w-full p-0 text-[13px] font-medium placeholder-[#94A3B8] outline-none">
        </div>
        
        <div class="w-px h-6 bg-[#E2E8F0] hidden md:block mx-1"></div>

        <!-- Notification -->
        <button class="relative w-10 h-10 flex items-center justify-center text-[#64748B] hover:text-[#10B981] hover:bg-[#ECFDF5] rounded-xl transition-colors group" aria-label="Notifikasi">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-[22px] h-[22px] group-hover:animate-[wiggle_1s_ease-in-out_infinite]">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
            <!-- Badge -->
            <span class="absolute top-2 right-2.5 w-2 h-2 bg-red-500 rounded-full border border-white"></span>
        </button>
    </div>
</header>
