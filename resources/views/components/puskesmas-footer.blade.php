<footer class="fixed bottom-0 inset-x-0 bg-white z-40 border-t border-slate-200 lg:hidden" style="padding-bottom: env(safe-area-inset-bottom)">
    <div class="flex items-center justify-between px-2 h-16">

        <!-- Dashboard -->
        <a href="{{ route('puskesmas.dashboard') ?? '/puskesmas' }}"
           id="nav-dashboard"
           class="flex flex-col items-center justify-center w-full h-full gap-1 transition-colors {{ request()->is('puskesmas', 'puskesmas/dashboard') ? 'text-teal-600' : 'text-slate-400 hover:text-teal-600' }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                 fill="{{ request()->is('puskesmas', 'puskesmas/dashboard') ? 'currentColor' : 'none' }}"
                 stroke="{{ request()->is('puskesmas', 'puskesmas/dashboard') ? 'none' : 'currentColor' }}"
                 stroke-width="1.5" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span class="text-[10px] {{ request()->is('puskesmas', 'puskesmas/dashboard') ? 'font-bold' : 'font-medium' }}">Dashboard</span>
        </a>

        <!-- Validasi -->
        <a href="{{ route('puskesmas.validasi') ?? '/puskesmas/validasi' }}"
           id="nav-validasi"
           class="flex flex-col items-center justify-center w-full h-full gap-1 transition-colors {{ request()->is('puskesmas/validasi*') ? 'text-teal-600' : 'text-slate-400 hover:text-teal-600' }} relative">
            <svg xmlns="http://www.w3.org/2000/svg" fill="{{ request()->is('puskesmas/validasi*') ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.801 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621.504-1.125 1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
            </svg>
            <span class="text-[10px] {{ request()->is('puskesmas/validasi*') ? 'font-bold' : 'font-medium' }}">Validasi</span>
            
            <!-- Red dot for pending -->
            <div class="absolute top-2 right-4 w-2 h-2 rounded-full bg-rose-500 border-2 border-white"></div>
        </a>

        <!-- Balita -->
        <a href="{{ route('puskesmas.balita') ?? '/puskesmas/balita' }}"
           id="nav-balita"
           class="flex flex-col items-center justify-center w-full h-full gap-1 transition-colors {{ request()->is('puskesmas/balita*') ? 'text-teal-600' : 'text-slate-400 hover:text-teal-600' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="{{ request()->is('puskesmas/balita*') ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
            </svg>
            <span class="text-[10px] {{ request()->is('puskesmas/balita*') ? 'font-bold' : 'font-medium' }}">Balita</span>
        </a>

        <!-- Posyandu -->
        <a href="{{ route('puskesmas.posyandu') ?? '/puskesmas/posyandu' }}"
           id="nav-posyandu"
           class="flex flex-col items-center justify-center w-full h-full gap-1 transition-colors {{ request()->is('puskesmas/posyandu*') ? 'text-teal-600' : 'text-slate-400 hover:text-teal-600' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="{{ request()->is('puskesmas/posyandu*') ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" />
            </svg>
            <span class="text-[10px] {{ request()->is('puskesmas/posyandu*') ? 'font-bold' : 'font-medium' }}">Posyandu</span>
        </a>

    </div>
</footer>
