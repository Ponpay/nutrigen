<!-- Sidebar Backdrop Overlay (Soft blur on background content) -->
<div id="sidebarOverlay" 
     class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs z-[100] hidden opacity-0 transition-opacity duration-200 ease-out" 
     onclick="closeSidebarAction()"></div>

<!-- Slide-Over Drawer: Clean Modern Profile & Settings -->
<aside id="sidebar" 
       class="fixed inset-y-0 left-0 w-[290px] sm:w-[320px] max-w-[85vw] bg-white z-[110] transform -translate-x-full transition-transform duration-300 ease-[cubic-bezier(0.16,1,0.3,1)] flex flex-col shadow-2xl border-r border-slate-200 overflow-hidden">
    
    <!-- 1. Clean Header: User Identity & Close Button -->
    <div class="p-5 pb-4 border-b border-slate-100 shrink-0">
        <div class="flex items-center justify-between mb-3.5">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-lg bg-teal-600 flex items-center justify-center p-1 shadow-2xs">
                    <img src="{{ asset('images/logo/logo-nutrigen.png') }}" alt="NutriGen" class="w-full h-full object-contain brightness-0 invert">
                </div>
                <span class="font-extrabold text-[14px] tracking-tight text-slate-900">NutriGen</span>
            </div>

            <button id="closeSidebar" 
                    onclick="closeSidebarAction()" 
                    class="w-7 h-7 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-100 flex items-center justify-center transition-colors cursor-pointer" 
                    aria-label="Tutup menu">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full {{ Auth::user()?->role === 'puskesmas' ? 'bg-sky-600' : 'bg-teal-600' }} text-white flex items-center justify-center font-bold text-[14px] shadow-xs shrink-0 ring-2 {{ Auth::user()?->role === 'puskesmas' ? 'ring-sky-100' : 'ring-teal-100' }}">
                {{ strtoupper(substr(Auth::user()->name ?? 'K', 0, 1)) }}
            </div>
            <div class="flex flex-col min-w-0">
                <span class="font-bold text-[14px] text-slate-900 leading-tight truncate">
                    {{ Auth::user()->name ?? 'Ibu Kader' }}
                </span>
                <span class="text-[11.5px] text-slate-500 font-normal truncate mt-0.5">
                    {{ Auth::user()->email ?? 'kader@nutrigen.com' }}
                </span>
            </div>
        </div>

        <!-- Posyandu / Faskes Status Pill -->
        <div class="mt-3">
            <div class="flex items-center justify-between px-3 py-1.5 rounded-lg {{ Auth::user()?->role === 'puskesmas' ? 'bg-sky-50/80 border border-sky-100 text-sky-800' : 'bg-teal-50/80 border border-teal-100 text-teal-800' }} text-[11.5px] font-medium">
                <div class="flex items-center gap-1.5 truncate">
                    <span class="w-1.5 h-1.5 rounded-full {{ Auth::user()?->role === 'puskesmas' ? 'bg-sky-500' : 'bg-teal-500' }} shrink-0"></span>
                    <span class="truncate font-semibold">{{ Auth::user()->role === 'puskesmas' ? (Auth::user()->puskesmas->nama ?? 'Puskesmas') : (Auth::user()->kader->posyandu->nama ?? 'Posyandu Melati 1') }}</span>
                </div>
                <span class="text-[10px] font-bold uppercase tracking-wider {{ Auth::user()?->role === 'puskesmas' ? 'text-sky-600' : 'text-teal-600' }} shrink-0">Aktif</span>
            </div>
        </div>
    </div>

    <!-- 2. Clean Menu Body -->
    <div class="flex-1 overflow-y-auto hide-scrollbar px-3 py-4 flex flex-col gap-4">
        
        <!-- Group 1: Akun -->
        <div>
            <div class="px-2.5 mb-1.5 text-[10.5px] font-bold text-slate-400 uppercase tracking-wider">Pengaturan Akun</div>
            <div class="flex flex-col gap-0.5">
                @if(request()->is('puskesmas*'))
                    <a href="{{ route('puskesmas.pengaturan') }}" 
                       class="flex items-center justify-between px-2.5 py-2 rounded-xl text-slate-700 hover:text-sky-700 hover:bg-sky-50/60 transition-all group {{ request()->routeIs('puskesmas.pengaturan') ? 'bg-sky-50 text-sky-800 font-semibold' : '' }}">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 group-hover:bg-sky-100 group-hover:text-sky-700 flex items-center justify-center transition-colors shrink-0">
                                <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd" /></svg>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-[13px] font-medium text-slate-800 group-hover:text-sky-900 leading-tight">Profil Institusi</span>
                                <span class="text-[11px] text-slate-400">Data Faskes & Wilayah</span>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-slate-300 group-hover:text-sky-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </a>

                    <a href="{{ route('puskesmas.pengaturan.petugas') }}" 
                       class="flex items-center justify-between px-2.5 py-2 rounded-xl text-slate-700 hover:text-sky-700 hover:bg-sky-50/60 transition-all group {{ request()->routeIs('puskesmas.pengaturan.petugas*') ? 'bg-sky-50 text-sky-800 font-semibold' : '' }}">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 group-hover:bg-sky-100 group-hover:text-sky-700 flex items-center justify-center transition-colors shrink-0">
                                <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-[13px] font-medium text-slate-800 group-hover:text-sky-900 leading-tight">Profil Petugas</span>
                                <span class="text-[11px] text-slate-400">Informasi Akun Petugas</span>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-slate-300 group-hover:text-sky-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </a>
                @else
                    <a href="{{ route('kader.profil') }}" 
                       class="flex items-center justify-between px-2.5 py-2 rounded-xl text-slate-700 hover:text-teal-700 hover:bg-teal-50/60 transition-all group {{ request()->routeIs('kader.profil') && !request()->routeIs('kader.profil.edit') ? 'bg-teal-50/80 text-teal-800 font-semibold' : '' }}">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 group-hover:bg-teal-100 group-hover:text-teal-700 flex items-center justify-center transition-colors shrink-0">
                                <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-[13px] font-medium text-slate-800 group-hover:text-teal-900 leading-tight">Profil Lengkap</span>
                                <span class="text-[11px] text-slate-400">Biodata & data posyandu</span>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-slate-300 group-hover:text-teal-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </a>

                    <a href="{{ route('kader.profil.edit') }}" 
                       class="flex items-center justify-between px-2.5 py-2 rounded-xl text-slate-700 hover:text-teal-700 hover:bg-teal-50/60 transition-all group {{ request()->routeIs('kader.profil.edit') ? 'bg-teal-50/80 text-teal-800 font-semibold' : '' }}">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 group-hover:bg-teal-100 group-hover:text-teal-700 flex items-center justify-center transition-colors shrink-0">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" /></svg>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-[13px] font-medium text-slate-800 group-hover:text-teal-900 leading-tight">Edit Biodata</span>
                                <span class="text-[11px] text-slate-400">Perbarui kontak & foto</span>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-slate-300 group-hover:text-teal-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </a>
                @endif
            </div>
        </div>

        <div class="h-px bg-slate-100 mx-1"></div>

        <!-- Group 2: Bantuan & Info -->
        <div>
            <div class="px-2.5 mb-1.5 text-[10.5px] font-bold text-slate-400 uppercase tracking-wider">Bantuan & Info</div>
            <div class="flex flex-col gap-0.5">
                <a href="javascript:void(0)" 
                   onclick="window.NutriAlert.toast('Fitur Bantuan & Panduan segera hadir.', 'info', 'Pusat Bantuan')"
                   class="flex items-center justify-between px-2.5 py-2 rounded-xl text-slate-700 hover:text-teal-700 hover:bg-teal-50/60 transition-all group">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 group-hover:bg-teal-100 group-hover:text-teal-700 flex items-center justify-center transition-colors shrink-0">
                            <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 10-1-1zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[13px] font-medium text-slate-800 group-hover:text-teal-900 leading-tight">Pusat Bantuan</span>
                            <span class="text-[11px] text-slate-400">Panduan operasional sistem</span>
                        </div>
                    </div>
                    <span class="text-[10px] font-bold text-slate-500 bg-slate-100 px-2 py-0.5 rounded-md">FAQ</span>
                </a>

                <a href="javascript:void(0)" 
                   onclick="window.NutriAlert.toast('NutriGen v1.0.0 — Sistem Monitoring Gizi & Pertumbuhan Anak', 'success', 'Versi Aplikasi')"
                   class="flex items-center justify-between px-2.5 py-2 rounded-xl text-slate-700 hover:text-teal-700 hover:bg-teal-50/60 transition-all group">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 group-hover:bg-teal-100 group-hover:text-teal-700 flex items-center justify-center transition-colors shrink-0">
                            <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" /></svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[13px] font-medium text-slate-800 group-hover:text-teal-900 leading-tight">Tentang NutriGen</span>
                            <span class="text-[11px] text-slate-400">Monitoring gizi anak</span>
                        </div>
                    </div>
                    <span class="text-[10.5px] font-bold text-teal-700 bg-teal-50 px-2 py-0.5 rounded-md border border-teal-100">v1.0</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 3. Clean Footer Logout Button -->
    <div class="p-4 border-t border-slate-100 bg-slate-50/50 shrink-0">
        <form action="{{ route('logout') }}" method="POST" onsubmit="if(window.NutriAlert && typeof window.NutriAlert.confirm === 'function'){ event.preventDefault(); const form = this; window.NutriAlert.confirm('Keluar dari Aplikasi?', 'Anda harus login kembali untuk mengakses data.', 'Keluar', 'Batal').then((r) => { if(r.isConfirmed) form.submit(); }); return false; } return confirm('Keluar dari Aplikasi?');">
            @csrf
            <button type="submit" 
                    class="w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl text-slate-700 hover:text-rose-600 bg-white hover:bg-rose-50 border border-slate-200 hover:border-rose-200 font-semibold text-[13px] transition-all shadow-2xs cursor-pointer active:scale-[0.98] group">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-slate-400 group-hover:text-rose-500 transition-colors">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                </svg>
                <span>Keluar Akun</span>
            </button>
        </form>
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
    });
</script>
