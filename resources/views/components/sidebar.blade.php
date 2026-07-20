<!-- Sidebar Overlay (Mobile) -->
<div id="sidebarOverlay" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40 hidden opacity-0 transition-all duration-300 lg:hidden"></div>

<!-- Sidebar -->
<aside id="sidebar" class="fixed inset-y-0 left-0 w-[280px] bg-white lg:bg-[#F8FAFC] z-50 transform -translate-x-full lg:translate-x-0 lg:static transition-transform duration-300 ease-out shadow-2xl lg:shadow-none lg:border-r border-slate-200/80 flex flex-col h-screen overflow-hidden">
    
    <!-- Header: Logo -->
    <div class="flex items-center justify-between px-6 lg:px-8 py-7 flex-shrink-0">
        <div class="flex items-center gap-3">
            <div class="w-14 h-14 flex items-center justify-center flex-shrink-0 -ml-2">
                <img src="{{ asset('images/logo/logo-nutrigen.png') }}" alt="NutriGen Logo" class="w-full h-full object-contain">
            </div>
            <div class="flex flex-col justify-center">
                <h2 class="text-[20px] font-black tracking-tight text-slate-900 leading-none">NutriGen</h2>
                <span class="text-[9px] font-extrabold text-slate-400 tracking-[0.2em] uppercase mt-1">Monitoring Gizi Anak</span>
            </div>
        </div>
        <button id="closeSidebar" class="p-2 -mr-2 text-slate-400 hover:text-slate-900 hover:bg-slate-100 rounded-full transition-all lg:hidden" aria-label="Tutup menu">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Menu Utama (Desktop & Mobile) -->
    <div class="flex flex-col gap-1 px-4 py-2 overflow-y-auto flex-1">
        <h3 class="px-4 mt-4 mb-2 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Menu Utama</h3>
        
        <a href="{{ route('kader.dashboard') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-2xl {{ request()->routeIs('kader.dashboard') ? 'bg-gradient-to-r from-emerald-50/80 to-transparent border border-emerald-100/50 text-emerald-700 shadow-[0_2px_10px_-4px_rgba(16,185,129,0.1)]' : 'text-slate-500 border border-transparent hover:bg-slate-50 hover:text-emerald-700' }} font-bold text-[15px] transition-all group">
            <div class="{{ request()->routeIs('kader.dashboard') ? 'text-emerald-600' : 'text-slate-400 group-hover:text-emerald-500 transition-colors' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>
            </div>
            Dashboard
        </a>
        <a href="{{ route('balita.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-2xl {{ request()->routeIs('balita.*') ? 'bg-gradient-to-r from-emerald-50/80 to-transparent border border-emerald-100/50 text-emerald-700 shadow-[0_2px_10px_-4px_rgba(16,185,129,0.1)]' : 'text-slate-500 border border-transparent hover:bg-slate-50 hover:text-emerald-700' }} font-bold text-[15px] transition-all group">
            <div class="{{ request()->routeIs('balita.*') ? 'text-emerald-600' : 'text-slate-400 group-hover:text-emerald-500 transition-colors' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
            </div>
            Balita
        </a>
        <a href="{{ route('jadwal.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-2xl {{ request()->routeIs('jadwal.*') ? 'bg-gradient-to-r from-emerald-50/80 to-transparent border border-emerald-100/50 text-emerald-700 shadow-[0_2px_10px_-4px_rgba(16,185,129,0.1)]' : 'text-slate-500 border border-transparent hover:bg-slate-50 hover:text-emerald-700' }} font-bold text-[15px] transition-all group">
            <div class="{{ request()->routeIs('jadwal.*') ? 'text-emerald-600' : 'text-slate-400 group-hover:text-emerald-500 transition-colors' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                </svg>
            </div>
            Jadwal
        </a>
        <a href="{{ route('laporan.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-2xl {{ request()->routeIs('laporan.*') ? 'bg-gradient-to-r from-emerald-50/80 to-transparent border border-emerald-100/50 text-emerald-700 shadow-[0_2px_10px_-4px_rgba(16,185,129,0.1)]' : 'text-slate-500 border border-transparent hover:bg-slate-50 hover:text-emerald-700' }} font-bold text-[15px] transition-all group">
            <div class="{{ request()->routeIs('laporan.*') ? 'text-emerald-600' : 'text-slate-400 group-hover:text-emerald-500 transition-colors' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
            </div>
            Laporan
        </a>

        <h3 class="px-4 mt-6 mb-2 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Informasi</h3>
        <a href="javascript:void(0)" onclick="window.NutriAlert.warning('Segera Hadir', 'Fitur Bantuan segera hadir.')" class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-slate-500 border border-transparent hover:bg-slate-50 hover:text-emerald-700 font-bold text-[15px] transition-all group">
            <div class="text-slate-400 group-hover:text-emerald-500 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 opacity-70">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                </svg>
            </div>
            <span>Bantuan</span>
        </a>
        <a href="javascript:void(0)" onclick="window.NutriAlert.success('Versi Sistem', 'NutriGen v1.0.0')" class="flex items-center gap-3.5 px-4 py-3 rounded-2xl text-slate-500 border border-transparent hover:bg-slate-50 hover:text-emerald-700 font-bold text-[15px] transition-all group">
            <div class="text-slate-400 group-hover:text-emerald-500 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 opacity-70">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                </svg>
            </div>
            <span>Tentang Aplikasi</span>
        </a>
    </div>
    

    <!-- Profil Kader (Premium Floating Card) -->
    <div class="p-5 pt-2 pb-8 flex-shrink-0">
        <a href="{{ route('kader.profil') }}" class="flex items-center gap-4 p-5 rounded-[24px] bg-white border border-slate-200/80 border-l-[4px] border-l-emerald-500 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_8px_24px_-8px_rgba(16,185,129,0.12)] hover:-translate-y-0.5 hover:border-emerald-200/50 transition-all duration-300 group relative overflow-hidden">
            <!-- Background Tint -->
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            
            <!-- Avatar -->
            <div class="w-12 h-12 rounded-[16px] bg-emerald-50 flex items-center justify-center text-emerald-600 flex-shrink-0 border border-emerald-100/50 z-10 group-hover:scale-110 group-hover:bg-white group-hover:shadow-sm transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                </svg>
            </div>
            
            <!-- Info -->
            <div class="flex flex-col min-w-0 flex-1 z-10">
                <span class="font-extrabold text-slate-900 text-[15px] truncate group-hover:text-emerald-700 transition-colors">{{ $kaderName ?? 'Ibu Kader' }}</span>
                <span class="text-[12px] font-medium text-slate-500 truncate mt-0.5 group-hover:text-emerald-600/70 transition-colors">{{ $posyanduName ?? 'Posyandu Melati 1' }}</span>
            </div>
            
            <!-- Settings Gear -->
            <div class="text-slate-300 group-hover:text-emerald-500 transition-transform group-hover:rotate-90 duration-500 z-10">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
        </a>
        
        <!-- Logout Button -->
        <form action="{{ route('logout') }}" method="POST" onsubmit="if(window.NutriAlert && typeof window.NutriAlert.confirm === 'function'){ event.preventDefault(); const form = this; window.NutriAlert.confirm('Keluar dari Aplikasi?', 'Anda harus login kembali untuk mengakses data.', 'Keluar', 'Batal').then((r) => { if(r.isConfirmed) form.submit(); }); return false; } return confirm('Keluar dari Aplikasi?');">
            @csrf
            <button type="submit" class="flex items-center justify-center gap-2 w-full mt-3 py-3 rounded-2xl text-rose-500 bg-rose-50/50 border border-rose-100/50 hover:text-rose-600 hover:bg-rose-100 font-bold text-[13px] transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                </svg>
                Keluar
            </button>
        </form>
    </div>
</aside>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleBtn = document.getElementById('sidebarToggle');
        const closeBtn = document.getElementById('closeSidebar');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            setTimeout(() => overlay.classList.remove('opacity-0'), 10);
            document.body.style.overflow = 'hidden';
        }

        function closeSidebarAction() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('opacity-0');
            setTimeout(() => overlay.classList.add('hidden'), 300);
            document.body.style.overflow = '';
        }

        if (toggleBtn) toggleBtn.addEventListener('click', openSidebar);
        if (closeBtn) closeBtn.addEventListener('click', closeSidebarAction);
        if (overlay) overlay.addEventListener('click', closeSidebarAction);

        // Logout is now handled by an inline onclick attribute for foolproof execution.
    });
</script>
