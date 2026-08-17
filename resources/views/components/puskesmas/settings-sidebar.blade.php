@props(['active' => 'profil'])

<!-- LEFT PANEL: Settings Navigation -->
<div class="w-full lg:w-[260px] xl:w-[280px] flex flex-col border-r border-slate-200 bg-slate-50/60 shrink-0 overflow-hidden">
    <!-- Panel Header -->
    <div class="bg-slate-50 border-b border-slate-200 px-5 pt-5 pb-4">
        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-0.5">Institution</p>
        <h2 class="text-base font-bold tracking-tight text-slate-800">Pengaturan</h2>
    </div>

    <!-- Nav Menu -->
    <nav class="p-3 flex flex-col gap-1 overflow-y-auto">
        <a href="{{ route('puskesmas.pengaturan') }}" class="settings-nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-sm transition-all shadow-sm border {{ $active === 'profil' ? 'bg-mint-50 text-mint-700 border-mint-100 font-semibold' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-100 border-transparent font-medium' }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="{{ $active === 'profil' ? 'currentColor' : 'none' }}" stroke="{{ $active === 'profil' ? 'none' : 'currentColor' }}" stroke-width="{{ $active === 'profil' ? '0' : '1.5' }}" class="w-4 h-4 shrink-0">
                <path fill-rule="evenodd" d="M3 6a3 3 0 013-3h12a3 3 0 013 3v12a3 3 0 01-3 3H6a3 3 0 01-3-3V6zm14.25 6a.75.75 0 01-.75.75h-2.25v2.25a.75.75 0 01-1.5 0v-2.25H10.5v2.25a.75.75 0 01-1.5 0v-2.25H6.75a.75.75 0 010-1.5h2.25V6.75a.75.75 0 011.5 0v2.25h2.25v-2.25a.75.75 0 011.5 0v2.25h2.25a.75.75 0 01.75.75z" clip-rule="evenodd" />
            </svg>
            <span>Profil Institusi</span>
        </a>
        <a href="{{ route('puskesmas.pengaturan.petugas') }}" class="settings-nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-sm transition-all shadow-sm border {{ $active === 'petugas' ? 'bg-mint-50 text-mint-700 border-mint-100 font-semibold' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-100 border-transparent font-medium' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="{{ $active === 'petugas' ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke-width="{{ $active === 'petugas' ? '0' : '1.5' }}" stroke="{{ $active === 'petugas' ? 'none' : 'currentColor' }}" class="w-4 h-4 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
            <span>Profil Petugas</span>
        </a>
        
        <div class="flex items-center justify-between px-4 py-3 rounded-xl text-sm font-medium text-slate-400 opacity-60 cursor-not-allowed">
            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                </svg>
                <span>Keamanan Akun</span>
            </div>
            <span class="text-[9px] font-bold bg-slate-200 text-slate-500 px-1.5 py-0.5 rounded-md uppercase">Segera Hadir</span>
        </div>
        
        <div class="flex items-center justify-between px-4 py-3 rounded-xl text-sm font-medium text-slate-400 opacity-60 cursor-not-allowed">
            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                </svg>
                <span>Notifikasi</span>
            </div>
            <span class="text-[9px] font-bold bg-slate-200 text-slate-500 px-1.5 py-0.5 rounded-md uppercase">Segera Hadir</span>
        </div>

        <div class="border-t border-slate-200 mt-2 pt-2">
            <p class="px-4 py-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Sistem</p>
            <div class="flex items-center justify-between px-4 py-3 rounded-xl text-sm font-medium text-slate-400 opacity-60 cursor-not-allowed">
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                    <span>Informasi Sistem</span>
                </div>
                <span class="text-[9px] font-bold bg-slate-200 text-slate-500 px-1.5 py-0.5 rounded-md uppercase">Tahap Berikutnya</span>
            </div>
        </div>
    </nav>
</div>
