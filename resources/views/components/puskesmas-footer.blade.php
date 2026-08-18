<footer class="fixed bottom-0 inset-x-0 z-40 lg:hidden bg-white/95 backdrop-blur-xl border-t border-slate-200/80 shadow-[0_-4px_20px_rgba(0,0,0,0.04)] select-none" style="padding-bottom: env(safe-area-inset-bottom)">
    <div class="grid grid-cols-4 items-center h-[58px] sm:h-[62px] px-1 max-w-lg mx-auto">

        <!-- 1. Dashboard -->
        <a href="{{ route('puskesmas.dashboard') ?? '/puskesmas' }}"
           id="nav-dashboard"
           class="flex flex-col items-center justify-center gap-1 py-1 transition-all duration-200 active:scale-95 {{ request()->is('puskesmas', 'puskesmas/dashboard') ? 'text-teal-600' : 'text-slate-400 hover:text-slate-600' }}">
            @if(request()->is('puskesmas', 'puskesmas/dashboard'))
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5.5 h-5.5">
                    <path d="M11.47 3.84a.75.75 0 011.06 0l8.99 8.99a.75.75 0 11-1.06 1.06l-8.46-8.46-8.46 8.46a.75.75 0 11-1.06-1.06l8.99-8.99z" />
                    <path d="M12 5.432l8.159 8.159c.03.03.052.065.076.098v6.561a2.25 2.25 0 01-2.25 2.25H13.5a.75.75 0 01-.75-.75V15a.75.75 0 00-.75-.75H12a.75.75 0 00-.75.75v6.75a.75.75 0 01-.75.75H6.015a2.25 2.25 0 01-2.25-2.25v-6.561a.753.753 0 01.076-.098L12 5.432z" />
                </svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor" class="w-5.5 h-5.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
            @endif
            <span class="text-[11px] leading-tight {{ request()->is('puskesmas', 'puskesmas/dashboard') ? 'font-bold text-teal-600' : 'font-medium text-slate-400' }}">Dashboard</span>
        </a>

        <!-- 2. Validasi -->
        <a href="{{ route('puskesmas.validasi') ?? '/puskesmas/validasi' }}"
           id="nav-validasi"
           class="flex flex-col items-center justify-center gap-1 py-1 transition-all duration-200 active:scale-95 relative {{ request()->is('puskesmas/validasi*') ? 'text-teal-600' : 'text-slate-400 hover:text-slate-600' }}">
            @if(request()->is('puskesmas/validasi*'))
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5.5 h-5.5">
                    <path fill-rule="evenodd" d="M7.502 6h7.128A3.375 3.375 0 0 1 18 9.375v9.375a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V9.375m1.875-1.875A1.875 1.875 0 0 1 6.75 5.625h10.5a1.875 1.875 0 0 1 1.875 1.875v12a1.875 1.875 0 0 1-1.875 1.875H6.75A1.875 1.875 0 0 1 4.875 19.5v-12Z" clip-rule="evenodd" />
                    <path fill-rule="evenodd" d="M9.75 3.75A1.5 1.5 0 0 1 11.25 2.25h1.5a1.5 1.5 0 0 1 1.5 1.5v1.5a.75.75 0 0 1-.75.75h-3a.75.75 0 0 1-.75-.75v-1.5Z" clip-rule="evenodd" />
                </svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor" class="w-5.5 h-5.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.801 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621.504-1.125 1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                </svg>
            @endif
            <!-- Notification badge indicator -->
            <span class="absolute top-1.5 right-[calc(50%-14px)] w-2 h-2 rounded-full bg-rose-500 ring-2 ring-white"></span>
            <span class="text-[11px] leading-tight {{ request()->is('puskesmas/validasi*') ? 'font-bold text-teal-600' : 'font-medium text-slate-400' }}">Validasi</span>
        </a>

        <!-- 3. Balita -->
        <a href="{{ route('puskesmas.balita') ?? '/puskesmas/balita' }}"
           id="nav-balita"
           class="flex flex-col items-center justify-center gap-1 py-1 transition-all duration-200 active:scale-95 {{ request()->is('puskesmas/balita*') ? 'text-teal-600' : 'text-slate-400 hover:text-slate-600' }}">
            @if(request()->is('puskesmas/balita*'))
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5.5 h-5.5">
                    <path d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor" class="w-5.5 h-5.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
            @endif
            <span class="text-[11px] leading-tight {{ request()->is('puskesmas/balita*') ? 'font-bold text-teal-600' : 'font-medium text-slate-400' }}">Balita</span>
        </a>

        <!-- 4. Posyandu -->
        <a href="{{ route('puskesmas.posyandu') ?? '/puskesmas/posyandu' }}"
           id="nav-posyandu"
           class="flex flex-col items-center justify-center gap-1 py-1 transition-all duration-200 active:scale-95 {{ request()->is('puskesmas/posyandu*') ? 'text-teal-600' : 'text-slate-400 hover:text-slate-600' }}">
            @if(request()->is('puskesmas/posyandu*'))
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5.5 h-5.5">
                    <path fill-rule="evenodd" d="M3 2.25a.75.75 0 0 0 0 1.5v16.5h-.75a.75.75 0 0 0 0 1.5H15v-18a.75.75 0 0 0 0-1.5H3ZM6.75 6a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-.75.75h-3a.75.75 0 0 1-.75-.75V6Zm0 4.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-.75.75h-3a.75.75 0 0 1-.75-.75v-1.5Zm0 4.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-.75.75h-3a.75.75 0 0 1-.75-.75v-1.5ZM16.5 7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75h-3a.75.75 0 0 1 0-1.5h2.25V8.25h-2.25a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                </svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9" stroke="currentColor" class="w-5.5 h-5.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.333M4.5 21V10.333M4.5 21h15" />
                </svg>
            @endif
            <span class="text-[11px] leading-tight {{ request()->is('puskesmas/posyandu*') ? 'font-bold text-teal-600' : 'font-medium text-slate-400' }}">Posyandu</span>
        </a>

    </div>
</footer>
