<footer class="fixed bottom-0 inset-x-0 z-40 lg:hidden bg-white/95 backdrop-blur-xl border-t border-slate-200/80 shadow-[0_-4px_20px_rgba(0,0,0,0.04)] select-none" style="padding-bottom: env(safe-area-inset-bottom)">
    <div class="grid grid-cols-4 items-center h-[58px] sm:h-[62px] px-1 max-w-lg mx-auto">

        <!-- 1. Beranda -->
        <a href="{{ route('kader.dashboard') }}" 
           class="flex flex-col items-center justify-center gap-1 py-1 transition-all duration-200 active:scale-95 {{ request()->routeIs('kader.dashboard') ? 'text-teal-600' : 'text-slate-400 hover:text-slate-600' }}">
            @if(request()->routeIs('kader.dashboard'))
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5.5 h-5.5">
                    <path d="M11.47 3.84a.75.75 0 011.06 0l8.99 8.99a.75.75 0 11-1.06 1.06l-8.46-8.46-8.46 8.46a.75.75 0 11-1.06-1.06l8.99-8.99z" />
                    <path d="M12 5.432l8.159 8.159c.03.03.052.065.076.098v6.561a2.25 2.25 0 01-2.25 2.25H13.5a.75.75 0 01-.75-.75V15a.75.75 0 00-.75-.75H12a.75.75 0 00-.75.75v6.75a.75.75 0 01-.75.75H6.015a2.25 2.25 0 01-2.25-2.25v-6.561a.753.753 0 01.076-.098L12 5.432z" />
                </svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor" class="w-5.5 h-5.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
            @endif
            <span class="text-[11px] leading-tight {{ request()->routeIs('kader.dashboard') ? 'font-bold text-teal-600' : 'font-medium text-slate-400' }}">Beranda</span>
        </a>

        <!-- 2. Balita -->
        <a href="{{ route('balita.index') }}" 
           class="flex flex-col items-center justify-center gap-1 py-1 transition-all duration-200 active:scale-95 {{ request()->routeIs('balita.*') ? 'text-teal-600' : 'text-slate-400 hover:text-slate-600' }}">
            @if(request()->routeIs('balita.*'))
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5.5 h-5.5">
                    <path d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor" class="w-5.5 h-5.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
            @endif
            <span class="text-[11px] leading-tight {{ request()->routeIs('balita.*') ? 'font-bold text-teal-600' : 'font-medium text-slate-400' }}">Balita</span>
        </a>

        <!-- 3. Jadwal -->
        <a href="{{ route('jadwal.index') }}" 
           class="flex flex-col items-center justify-center gap-1 py-1 transition-all duration-200 active:scale-95 {{ request()->routeIs('jadwal.*') ? 'text-teal-600' : 'text-slate-400 hover:text-slate-600' }}">
            @if(request()->routeIs('jadwal.*'))
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5.5 h-5.5">
                    <path d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5M9 15h.008v.008H9V15Zm0 2.25h.008v.008H9v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008Zm3-2.25h.008v.008H15V15Zm0 2.25h.008v.008H15v-.008Z" />
                </svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor" class="w-5.5 h-5.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5M9 15h.008v.008H9V15Zm0 2.25h.008v.008H9v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008Zm3-2.25h.008v.008H15V15Zm0 2.25h.008v.008H15v-.008Z" />
                </svg>
            @endif
            <span class="text-[11px] leading-tight {{ request()->routeIs('jadwal.*') ? 'font-bold text-teal-600' : 'font-medium text-slate-400' }}">Jadwal</span>
        </a>

        <!-- 4. Laporan -->
        <a href="{{ route('laporan.index') }}" 
           class="flex flex-col items-center justify-center gap-1 py-1 transition-all duration-200 active:scale-95 {{ request()->routeIs('laporan.*') ? 'text-teal-600' : 'text-slate-400 hover:text-slate-600' }}">
            @if(request()->routeIs('laporan.*'))
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5.5 h-5.5">
                    <path d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor" class="w-5.5 h-5.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
            @endif
            <span class="text-[11px] leading-tight {{ request()->routeIs('laporan.*') ? 'font-bold text-teal-600' : 'font-medium text-slate-400' }}">Laporan</span>
        </a>

    </div>
</footer>
