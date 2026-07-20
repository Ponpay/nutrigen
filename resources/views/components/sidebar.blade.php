<!-- Sidebar Overlay (Mobile & Desktop) -->
<div id="sidebarOverlay" class="fixed inset-0 bg-slate-900/30 backdrop-blur-md z-[60] hidden opacity-0 transition-all duration-300" onclick="document.getElementById('sidebar').classList.add('-translate-x-full'); this.classList.add('opacity-0'); setTimeout(() => this.classList.add('hidden'), 300); document.body.style.overflow = '';"></div>

<!-- Offcanvas Wrapper -->
<aside id="sidebar" class="fixed inset-y-0 left-0 w-[320px] z-[70] transform -translate-x-full transition-transform duration-[400ms] ease-[cubic-bezier(0.16,1,0.3,1)] p-3 lg:p-4 flex flex-col">
    
    <!-- Floating Drawer Container -->
    <div class="bg-white/95 backdrop-blur-3xl w-full h-full rounded-[2.5rem] shadow-[0_24px_48px_-12px_rgba(0,0,0,0.2)] border border-white flex flex-col overflow-hidden relative flex-1">
        
        <!-- Abstract Top Glow -->
        <div class="absolute top-0 inset-x-0 h-40 bg-gradient-to-b from-emerald-50 to-transparent pointer-events-none"></div>

        <!-- Close Button -->
        <button id="closeSidebar" onclick="document.getElementById('sidebar').classList.add('-translate-x-full'); document.getElementById('sidebarOverlay').classList.add('opacity-0'); setTimeout(() => document.getElementById('sidebarOverlay').classList.add('hidden'), 300); document.body.style.overflow = '';" class="absolute top-5 right-5 w-10 h-10 bg-white hover:bg-slate-50 rounded-full shadow-sm flex items-center justify-center text-slate-400 hover:text-slate-600 transition-all z-20 border border-slate-100" aria-label="Tutup menu">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Profile Section -->
        <div class="pt-12 pb-8 px-6 flex flex-col items-center text-center relative z-10 border-b border-slate-100">
            <!-- Avatar -->
            <div class="w-24 h-24 rounded-full p-1 bg-gradient-to-br from-emerald-400 to-teal-500 shadow-xl shadow-emerald-500/20 mb-5 relative">
                <div class="w-full h-full bg-white rounded-full flex items-center justify-center text-emerald-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>

            <!-- Identity -->
            <h3 class="font-black text-slate-800 text-[22px] tracking-tight leading-none mb-3">{{ $kaderName ?? 'Ibu Kader' }}</h3>
            <span class="text-[13px] font-bold text-emerald-600 tracking-wide bg-emerald-50 border border-emerald-100 px-4 py-1.5 rounded-full">{{ $posyanduName ?? 'Posyandu Melati 1' }}</span>
            
            <!-- Edit Profile Button -->
            <a href="{{ route('kader.profil') }}" class="mt-6 flex items-center justify-center gap-2 w-full bg-slate-50 hover:bg-slate-100 border border-slate-200/60 text-slate-600 font-bold text-[14px] py-3.5 rounded-2xl transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                </svg>
                Edit Profil
            </a>
        </div>

        <!-- Menu Section -->
        <div class="flex-1 px-4 py-6 flex flex-col gap-2 overflow-y-auto hide-scrollbar">
            <h4 class="px-2 mb-2 text-[11px] font-black text-slate-400 uppercase tracking-widest">Informasi Sistem</h4>
            
            <a href="javascript:void(0)" onclick="window.NutriAlert.warning('Segera Hadir', 'Fitur Bantuan segera hadir.')" class="flex items-center gap-4 px-3 py-3 rounded-[1.5rem] text-slate-600 hover:text-emerald-700 hover:bg-emerald-50/80 font-bold text-[15px] transition-all group">
                <div class="w-12 h-12 rounded-[1.25rem] bg-slate-50 flex items-center justify-center group-hover:bg-emerald-100 group-hover:text-emerald-600 transition-colors shadow-sm border border-slate-100 group-hover:border-emerald-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                    </svg>
                </div>
                <span>Pusat Bantuan</span>
            </a>

            <a href="javascript:void(0)" onclick="window.NutriAlert.success('Versi Sistem', 'NutriGen v1.0.0')" class="flex items-center gap-4 px-3 py-3 rounded-[1.5rem] text-slate-600 hover:text-emerald-700 hover:bg-emerald-50/80 font-bold text-[15px] transition-all group">
                <div class="w-12 h-12 rounded-[1.25rem] bg-slate-50 flex items-center justify-center group-hover:bg-emerald-100 group-hover:text-emerald-600 transition-colors shadow-sm border border-slate-100 group-hover:border-emerald-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                </div>
                <span>Tentang Aplikasi</span>
            </a>
        </div>

        <!-- Logout Section -->
        <div class="p-5 mt-auto">
            <form action="{{ route('logout') }}" method="POST" onsubmit="if(window.NutriAlert && typeof window.NutriAlert.confirm === 'function'){ event.preventDefault(); const form = this; window.NutriAlert.confirm('Keluar dari Aplikasi?', 'Anda harus login kembali untuk mengakses data.', 'Keluar', 'Batal').then((r) => { if(r.isConfirmed) form.submit(); }); return false; } return confirm('Keluar dari Aplikasi?');">
                @csrf
                <button type="submit" class="flex items-center justify-center gap-2 w-full py-4 rounded-[1.25rem] text-rose-600 bg-rose-50 border border-rose-100 hover:bg-rose-100 hover:border-rose-200 font-black text-[15px] transition-all group shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 group-hover:-translate-x-1 transition-transform">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                    Keluar Aplikasi
                </button>
            </form>
        </div>

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
