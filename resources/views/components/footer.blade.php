<footer class="fixed bottom-0 inset-x-0 bg-white z-40 border-t border-gray-100 lg:hidden" style="padding-bottom: env(safe-area-inset-bottom)">
    <div class="flex items-center justify-between px-2 h-16">

        <!-- Beranda -->
        <a href="{{ route('dashboard') }}"
           id="nav-beranda"
           class="flex flex-col items-center justify-center w-full h-full gap-1 transition-colors {{ request()->is('/') ? 'text-teal-600' : 'text-gray-400 hover:text-teal-600' }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                 fill="{{ request()->is('/') ? 'currentColor' : 'none' }}"
                 stroke="{{ request()->is('/') ? 'none' : 'currentColor' }}"
                 stroke-width="1.5" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.99 8.99a.75.75 0 1 1-1.06 1.06l-8.46-8.46-8.46 8.46a.75.75 0 1 1-1.06-1.06l8.99-8.99Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5.432l8.159 8.159c.03.03.052.065.076.098v6.561a2.25 2.25 0 0 1-2.25 2.25H13.5a.75.75 0 0 1-.75-.75V15a.75.75 0 0 0-.75-.75H12a.75.75 0 0 0-.75.75v6.75a.75.75 0 0 1-.75.75H6.015a2.25 2.25 0 0 1-2.25-2.25v-6.561c.024-.033.046-.068.076-.098L12 5.432Z" />
            </svg>
            <span class="text-[10px] {{ request()->is('/') ? 'font-bold' : 'font-medium' }}">Beranda</span>
        </a>

        <!-- Balita -->
        <a href="{{ route('balita.index') }}"
           id="nav-balita"
           class="flex flex-col items-center justify-center w-full h-full gap-1 transition-colors {{ request()->is('daftar-balita', 'profil-balita*', 'daftar-balita-baru', 'edit-balita') ? 'text-teal-600' : 'text-gray-400 hover:text-teal-600' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
            <span class="text-[10px] {{ request()->is('daftar-balita', 'profil-balita*', 'daftar-balita-baru', 'edit-balita') ? 'font-bold' : 'font-medium' }}">Balita</span>
        </a>

        <!-- Jadwal -->
        <a href="{{ route('jadwal.index') }}"
           id="nav-jadwal"
           class="flex flex-col items-center justify-center w-full h-full gap-1 transition-colors {{ request()->is('jadwal', 'detail-jadwal*', 'tambah-jadwal') ? 'text-teal-600' : 'text-gray-400 hover:text-teal-600' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5M9 15h.008v.008H9V15Zm0 2.25h.008v.008H9v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008Zm3-2.25h.008v.008H15V15Zm0 2.25h.008v.008H15v-.008Z" />
            </svg>
            <span class="text-[10px] {{ request()->is('jadwal', 'detail-jadwal*', 'tambah-jadwal') ? 'font-bold' : 'font-medium' }}">Jadwal</span>
        </a>

        <!-- Laporan -->
        <a href="{{ route('laporan.index') }}"
           id="nav-laporan"
           class="flex flex-col items-center justify-center w-full h-full gap-1 transition-colors {{ request()->is('laporan') ? 'text-teal-600' : 'text-gray-400 hover:text-teal-600' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
            </svg>
            <span class="text-[10px] {{ request()->is('laporan') ? 'font-bold' : 'font-medium' }}">Laporan</span>
        </a>

    </div>
</footer>
