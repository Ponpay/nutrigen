<!-- Sidebar Overlay (Mobile) -->
<div id="sidebarOverlay" class="fixed inset-0 bg-gray-900/50 z-40 hidden opacity-0 transition-opacity duration-300 lg:hidden"></div>

<!-- Sidebar -->
<aside id="sidebar" class="fixed inset-y-0 left-0 w-72 bg-white z-50 transform -translate-x-full lg:translate-x-0 lg:static lg:block transition-transform duration-300 ease-in-out shadow-xl lg:shadow-sm lg:border-r lg:border-gray-100 flex flex-col">
    
    <!-- Header: Logo -->
    <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100 bg-white flex-shrink-0">
        <div>
            <h2 class="text-2xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-emerald-500">
                NutriGen
            </h2>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mt-0.5">Monitoring Gizi Anak</p>
        </div>
        <button id="closeSidebar" class="p-2 -mr-2 text-gray-400 hover:text-gray-600 transition-colors lg:hidden" aria-label="Tutup menu">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Profil Kader (Mini Card) -->
    <a href="{{ route('kader.profil') }}" class="mx-4 mt-4 flex items-center gap-3 p-3 rounded-2xl border border-slate-100 bg-slate-50 hover:bg-slate-100 transition-colors group focus:outline-none focus:ring-2 focus:ring-teal-500/30">
        <!-- Avatar -->
        <div class="w-11 h-11 rounded-xl bg-teal-100 flex items-center justify-center text-teal-600 flex-shrink-0 border border-teal-200/50">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
            </svg>
        </div>
        <!-- Info -->
        <div class="flex flex-col min-w-0 flex-1">
            <span class="font-bold text-slate-800 text-sm truncate group-hover:text-teal-700 transition-colors">{{ $kaderName ?? 'Ibu Kader' }}</span>
            <span class="text-[11px] text-slate-500 truncate">{{ $posyanduName ?? 'Posyandu Melati 1' }}</span>
        </div>
        <!-- Chevron -->
        <div class="text-slate-400 group-hover:text-teal-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
        </div>
    </a>

    <!-- Menu Sekunder -->
    <div class="flex flex-col gap-1 px-3 py-4 overflow-y-auto flex-1">
        <h3 class="px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Informasi</h3>

        <!-- Bantuan -->
        <a href="javascript:void(0)" onclick="alert('Fitur Bantuan segera hadir.')" class="flex items-center gap-3 px-3 py-3 rounded-xl text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
            </svg>
            <span>Bantuan</span>
        </a>

        <!-- Tentang Aplikasi -->
        <a href="javascript:void(0)" onclick="alert('NutriGen v1.0.0')" class="flex items-center gap-3 px-3 py-3 rounded-xl text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
            </svg>
            <span>Tentang NutriGen</span>
        </a>
    </div>

    <!-- Logout — Bottom -->
    <div class="p-4 border-t border-gray-100 flex-shrink-0">
        {{-- Backend: replace with a POST form to route('logout') when Laravel auth is wired --}}
        <a href="{{ route('logout') }}" onclick="return confirm('Apakah Anda yakin ingin keluar?')" class="flex items-center gap-3 px-3 py-3 rounded-xl text-rose-600 hover:bg-rose-50 font-medium transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 flex-shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
            </svg>
            <span>Keluar</span>
        </a>
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
    });
</script>
