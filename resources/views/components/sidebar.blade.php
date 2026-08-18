<!-- Sidebar Backdrop Overlay (Soft blur on background content) -->
<div id="sidebarOverlay" 
     class="fixed inset-0 bg-slate-950/40 backdrop-blur-xs z-[100] hidden opacity-0 transition-opacity duration-300 ease-out" 
     onclick="closeSidebarAction()"></div>

<!-- Slide-Over Drawer: Floating Glassmorphic Modern Sidebar -->
<aside id="sidebar" 
       class="fixed inset-y-0 left-0 w-[285px] sm:w-[320px] max-w-[85vw] h-[100dvh] z-[110] transform -translate-x-full transition-transform duration-300 ease-[cubic-bezier(0.16,1,0.3,1)] p-2.5 sm:p-4 flex flex-col pointer-events-auto select-none">
    
    <!-- Floating Glassmorphic Container (macOS / Dribbble Style) -->
    <div class="w-full h-full max-h-[calc(100dvh-20px)] sm:max-h-[calc(100dvh-32px)] bg-white/95 backdrop-blur-2xl rounded-[28px] sm:rounded-[32px] border border-white/90 shadow-[0_20px_50px_-15px_rgba(0,0,0,0.16)] flex flex-col overflow-hidden relative">
        
        <!-- Top Bar: Window Controls & Collapse/Close Button -->
        <div class="px-4 sm:px-5 pt-3.5 sm:pt-4 pb-1.5 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-1.5">
                <div class="w-2.5 h-2.5 rounded-full bg-rose-400 shadow-2xs"></div>
                <div class="w-2.5 h-2.5 rounded-full bg-amber-400 shadow-2xs"></div>
                <div class="w-2.5 h-2.5 rounded-full bg-emerald-400 shadow-2xs"></div>
            </div>
            
            <button id="closeSidebar" 
                    onclick="closeSidebarAction()" 
                    class="w-6.5 h-6.5 rounded-full bg-slate-100 hover:bg-slate-200 active:bg-slate-300 text-slate-400 hover:text-slate-600 flex items-center justify-center transition-all cursor-pointer" 
                    aria-label="Tutup menu">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>
        </div>

        <!-- Profile Hero Row -->
        <div class="px-4 sm:px-5 py-2.5 sm:py-3 flex items-center gap-3 shrink-0 border-b border-slate-100/70">
            <div class="w-9.5 h-9.5 rounded-full p-0.5 bg-gradient-to-tr from-teal-500 to-emerald-400 shadow-2xs shrink-0">
                <div class="w-full h-full bg-white rounded-full flex items-center justify-center font-bold text-[13.5px] overflow-hidden">
                    @if(Auth::user()?->role === 'puskesmas')
                        <span class="text-sky-600">{{ strtoupper(substr(Auth::user()->name ?? 'P', 0, 1)) }}</span>
                    @else
                        <span class="text-teal-600">{{ strtoupper(substr(Auth::user()->name ?? 'K', 0, 1)) }}</span>
                    @endif
                </div>
            </div>
            
            <div class="flex flex-col min-w-0">
                <span class="text-[10.5px] font-medium text-slate-400 flex items-center gap-1 leading-none mb-0.5">
                    Selamat Bertugas 👋
                </span>
                <span class="text-[13.5px] font-bold text-slate-800 leading-snug truncate">
                    {{ Auth::user()->name ?? 'Ibu Kader' }}
                </span>
                <span class="text-[11px] text-teal-600 font-semibold truncate leading-tight">
                    {{ Auth::user()->role === 'puskesmas' ? (Auth::user()->puskesmas->nama ?? 'Puskesmas') : (Auth::user()->kader->posyandu->nama ?? 'Posyandu Melati 1') }}
                </span>
            </div>
        </div>

        <!-- Scrollable Body with Grouped Inset Cards -->
        <div class="flex-1 overflow-y-auto overscroll-contain hide-scrollbar p-3 sm:p-3.5 flex flex-col gap-3">
            
            <!-- Section 1: Pengaturan Akun -->
            <div>
                <div class="flex items-center justify-between px-1.5 mb-1.5">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Pengaturan Akun</span>
                    <span class="w-4 h-4 rounded-full bg-slate-100 text-slate-400 text-[9.5px] font-bold flex items-center justify-center">2</span>
                </div>

                <div class="bg-white rounded-[18px] sm:rounded-[20px] border border-slate-100 shadow-[0_2px_10px_rgba(0,0,0,0.03)] p-1.5 flex flex-col gap-0.5">
                    @if(request()->is('puskesmas*'))
                        <a href="{{ route('puskesmas.pengaturan') }}" 
                           class="flex items-center justify-between p-2 rounded-xl transition-all group {{ request()->routeIs('puskesmas.pengaturan') ? 'bg-sky-600 text-white shadow-xs font-semibold' : 'hover:bg-slate-50 active:bg-slate-100 text-slate-700 font-medium' }}">
                            <div class="flex items-center gap-2.5 min-w-0">
                                <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 {{ request()->routeIs('puskesmas.pengaturan') ? 'bg-white/20 text-white' : 'bg-sky-50 text-sky-600' }}">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd" /></svg>
                                </div>
                                <span class="text-[12.5px] sm:text-[13px] leading-tight truncate">Profil Faskes</span>
                            </div>
                            <svg class="w-3.5 h-3.5 shrink-0 {{ request()->routeIs('puskesmas.pengaturan') ? 'text-white/80' : 'text-slate-300 group-hover:text-slate-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" /></svg>
                        </a>

                        <a href="{{ route('puskesmas.pengaturan.petugas') }}" 
                           class="flex items-center justify-between p-2 rounded-xl transition-all group {{ request()->routeIs('puskesmas.pengaturan.petugas*') ? 'bg-sky-600 text-white shadow-xs font-semibold' : 'hover:bg-slate-50 active:bg-slate-100 text-slate-700 font-medium' }}">
                            <div class="flex items-center gap-2.5 min-w-0">
                                <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 {{ request()->routeIs('puskesmas.pengaturan.petugas*') ? 'bg-white/20 text-white' : 'bg-indigo-50 text-indigo-600' }}">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
                                </div>
                                <span class="text-[12.5px] sm:text-[13px] leading-tight truncate">Akun Petugas</span>
                            </div>
                            <svg class="w-3.5 h-3.5 shrink-0 {{ request()->routeIs('puskesmas.pengaturan.petugas*') ? 'text-white/80' : 'text-slate-300 group-hover:text-slate-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" /></svg>
                        </a>
                    @else
                        <a href="{{ route('kader.profil') }}" 
                           class="flex items-center justify-between p-2 rounded-xl transition-all group {{ request()->routeIs('kader.profil') && !request()->routeIs('kader.profil.edit') ? 'bg-teal-600 text-white shadow-xs font-semibold' : 'hover:bg-slate-50 active:bg-slate-100 text-slate-700 font-medium' }}">
                            <div class="flex items-center gap-2.5 min-w-0">
                                <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 {{ request()->routeIs('kader.profil') && !request()->routeIs('kader.profil.edit') ? 'bg-white/20 text-white' : 'bg-teal-50 text-teal-600' }}">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
                                </div>
                                <span class="text-[12.5px] sm:text-[13px] leading-tight truncate">Profil Kader</span>
                            </div>
                            <svg class="w-3.5 h-3.5 shrink-0 {{ request()->routeIs('kader.profil') && !request()->routeIs('kader.profil.edit') ? 'text-white/80' : 'text-slate-300 group-hover:text-slate-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" /></svg>
                        </a>

                        <a href="{{ route('kader.profil.edit') }}" 
                           class="flex items-center justify-between p-2 rounded-xl transition-all group {{ request()->routeIs('kader.profil.edit') ? 'bg-teal-600 text-white shadow-xs font-semibold' : 'hover:bg-slate-50 active:bg-slate-100 text-slate-700 font-medium' }}">
                            <div class="flex items-center gap-2.5 min-w-0">
                                <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 {{ request()->routeIs('kader.profil.edit') ? 'bg-white/20 text-white' : 'bg-emerald-50 text-emerald-600' }}">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" /></svg>
                                </div>
                                <span class="text-[12.5px] sm:text-[13px] leading-tight truncate">Edit Biodata</span>
                            </div>
                            <svg class="w-3.5 h-3.5 shrink-0 {{ request()->routeIs('kader.profil.edit') ? 'text-white/80' : 'text-slate-300 group-hover:text-slate-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" /></svg>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Section 2: Layanan & Informasi -->
            <div>
                <div class="flex items-center justify-between px-1.5 mb-1.5">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Layanan & Bantuan</span>
                    <span class="w-4 h-4 rounded-full bg-slate-100 text-slate-400 text-[9.5px] font-bold flex items-center justify-center">2</span>
                </div>

                <div class="bg-white rounded-[18px] sm:rounded-[20px] border border-slate-100 shadow-[0_2px_10px_rgba(0,0,0,0.03)] p-1.5 flex flex-col gap-0.5">
                    <a href="javascript:void(0)" 
                       onclick="window.NutriAlert.toast('Fitur Bantuan segera hadir.', 'info', 'Pusat Bantuan')"
                       class="flex items-center justify-between p-2 rounded-xl hover:bg-slate-50 active:bg-slate-100 text-slate-700 font-medium transition-all group">
                        <div class="flex items-center gap-2.5 min-w-0">
                            <div class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 10-1-1zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg>
                            </div>
                            <span class="text-[12.5px] sm:text-[13px] leading-tight truncate">Pusat Bantuan</span>
                        </div>
                        <span class="text-[9px] sm:text-[9.5px] font-bold text-slate-400 bg-slate-100 px-2 py-0.5 rounded-md shrink-0">FAQ</span>
                    </a>

                    <a href="javascript:void(0)" 
                       onclick="window.NutriAlert.toast('NutriGen v1.0.0 — Platform Monitoring Gizi Anak', 'success', 'Versi Sistem')"
                       class="flex items-center justify-between p-2 rounded-xl hover:bg-slate-50 active:bg-slate-100 text-slate-700 font-medium transition-all group">
                        <div class="flex items-center gap-2.5 min-w-0">
                            <div class="w-7 h-7 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center shrink-0">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" /></svg>
                            </div>
                            <span class="text-[12.5px] sm:text-[13px] leading-tight truncate">Tentang Aplikasi</span>
                        </div>
                        <span class="text-[9px] sm:text-[9.5px] font-bold text-teal-700 bg-teal-50 px-2 py-0.5 rounded-md border border-teal-100 shrink-0">v1.0</span>
                    </a>
                </div>
            </div>

        </div>

        <!-- Bottom Action: Floating Inset Logout Card -->
        <div class="p-3 sm:p-3.5 pt-0 shrink-0">
            <form action="{{ route('logout') }}" method="POST" onsubmit="if(window.NutriAlert && typeof window.NutriAlert.confirm === 'function'){ event.preventDefault(); const form = this; window.NutriAlert.confirm('Keluar dari Aplikasi?', 'Anda harus login kembali untuk mengakses data.', 'Keluar', 'Batal').then((r) => { if(r.isConfirmed) form.submit(); }); return false; } return confirm('Keluar dari Aplikasi?');">
                @csrf
                <button type="submit" 
                        class="w-full bg-white hover:bg-rose-50/70 active:bg-rose-100/70 rounded-[18px] sm:rounded-[20px] border border-slate-100 hover:border-rose-100 p-2.5 flex items-center justify-center gap-2.5 text-slate-700 hover:text-rose-600 font-semibold text-[12.5px] sm:text-[13px] shadow-[0_2px_10px_rgba(0,0,0,0.03)] transition-all cursor-pointer group active:scale-[0.98]">
                    <div class="w-6 h-6 sm:w-6.5 sm:h-6.5 rounded-full bg-rose-50 group-hover:bg-rose-500 group-hover:text-white text-rose-500 flex items-center justify-center transition-all shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                    </div>
                    <span>Keluar Aplikasi</span>
                </button>
            </form>
        </div>

    </div>
</aside>

<script>
    function openSidebarAction() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        if (!sidebar || !overlay) return;
        
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        setTimeout(() => overlay.classList.remove('opacity-0'), 10);
        document.body.style.overflow = 'hidden';
    }

    function closeSidebarAction() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        if (!sidebar || !overlay) return;

        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('opacity-0');
        setTimeout(() => overlay.classList.add('hidden'), 300);
        document.body.style.overflow = '';
    }

    document.addEventListener('DOMContentLoaded', () => {
        const toggleBtn = document.getElementById('sidebarToggle');
        const closeBtn = document.getElementById('closeSidebar');
        const overlay = document.getElementById('sidebarOverlay');

        if (toggleBtn) toggleBtn.addEventListener('click', openSidebarAction);
        if (closeBtn) closeBtn.addEventListener('click', closeSidebarAction);
        if (overlay) overlay.addEventListener('click', closeSidebarAction);

        // Close on Escape key press
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeSidebarAction();
            }
        });
    });
</script>
