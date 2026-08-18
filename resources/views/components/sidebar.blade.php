<!-- Sidebar Backdrop Overlay -->
<div id="sidebarOverlay" 
     class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-[100] hidden opacity-0 transition-opacity duration-300 ease-out" 
     onclick="closeSidebarAction()"></div>

<!-- Slide-Over Drawer -->
<aside id="sidebar" 
       class="fixed inset-y-0 left-0 w-[310px] sm:w-[340px] max-w-[88vw] bg-[#F8FAFC] z-[110] transform -translate-x-full transition-transform duration-300 ease-[cubic-bezier(0.16,1,0.3,1)] flex flex-col shadow-2xl border-r border-slate-200/80 overflow-hidden">
    
    <!-- 1. Drawer Header: Profile Hero Card -->
    <div class="p-3.5 sm:p-4 pb-0 shrink-0">
        <div class="relative bg-gradient-to-br from-teal-800 via-teal-700 to-teal-900 rounded-3xl p-5 text-white shadow-[0_8px_24px_rgba(13,148,136,0.18)] overflow-hidden">
            {{-- Ambient radial background lights --}}
            <div class="absolute -right-8 -top-8 w-32 h-32 bg-emerald-400/20 rounded-full blur-2xl pointer-events-none"></div>
            <div class="absolute left-0 bottom-0 w-28 h-28 bg-teal-950/50 rounded-full blur-xl pointer-events-none"></div>
            <div class="absolute inset-0 opacity-[0.04] pointer-events-none" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 14px 14px;"></div>

            {{-- Top Row: Brand pill + Close button --}}
            <div class="flex items-center justify-between relative z-10 mb-4">
                <div class="flex items-center gap-1.5 bg-white/15 backdrop-blur-md px-2.5 py-1 rounded-full border border-white/20">
                    <div class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></div>
                    <span class="text-[11px] font-extrabold tracking-wide uppercase text-white">NutriGen Portal</span>
                </div>

                <button id="closeSidebar" 
                        onclick="closeSidebarAction()" 
                        class="w-7 h-7 rounded-full bg-white/15 hover:bg-white/30 active:bg-white/40 text-white flex items-center justify-center transition-all cursor-pointer border border-white/20 shadow-xs" 
                        aria-label="Tutup menu">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Profile Identity --}}
            <div class="flex items-center gap-3.5 relative z-10">
                <div class="relative shrink-0">
                    <div class="w-13 h-13 rounded-2xl bg-white/20 backdrop-blur-md p-0.5 border border-white/30 shadow-md flex items-center justify-center">
                        <div class="w-full h-full bg-white rounded-[14px] flex items-center justify-center text-teal-700 font-bold overflow-hidden shadow-2xs">
                            @if(Auth::user()?->role === 'puskesmas')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 text-sky-600">
                                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 text-teal-600">
                                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                                </svg>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="flex flex-col min-w-0">
                    <span class="font-extrabold text-[15px] text-white tracking-tight leading-tight truncate">
                        {{ Auth::user()->name ?? 'Ibu Kader' }}
                    </span>
                    <span class="text-[11.5px] text-teal-100/85 font-medium truncate mt-0.5">
                        {{ Auth::user()->email ?? 'kader@nutrigen.com' }}
                    </span>
                    <div class="mt-1.5 flex items-center">
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-teal-900/60 backdrop-blur-xs text-[10px] font-bold text-teal-200 border border-teal-600/40">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                            <span class="truncate max-w-[130px]">{{ Auth::user()->role === 'puskesmas' ? (Auth::user()->puskesmas->nama ?? 'Puskesmas') : (Auth::user()->kader->posyandu->nama ?? 'Posyandu Melati 1') }}</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Drawer Body: Grouped Inset Cards -->
    <div class="flex-1 overflow-y-auto hide-scrollbar p-3.5 sm:p-4 flex flex-col gap-4">
        
        <!-- Group 1: Profil & Akun -->
        <div class="flex flex-col gap-1.5">
            <span class="px-2 text-[10.5px] font-bold text-slate-400 uppercase tracking-widest">Akun & Data</span>

            <div class="bg-white rounded-2xl border border-slate-200/70 shadow-2xs overflow-hidden">
                @if(request()->is('puskesmas*'))
                    {{-- Puskesmas Settings --}}
                    <a href="{{ route('puskesmas.pengaturan') }}" 
                       class="flex items-center justify-between p-3 hover:bg-slate-50 active:bg-slate-100 transition-colors group">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center shrink-0 border border-sky-100 group-hover:scale-105 transition-transform">
                                <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd" /></svg>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="text-[13px] font-bold text-slate-800 leading-tight">Profil Institusi</span>
                                <span class="text-[11px] text-slate-400 font-medium">Data Faskes & Wilayah</span>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-slate-300 group-hover:text-slate-500 group-hover:translate-x-0.5 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </a>

                    <div class="h-px bg-slate-100 ml-15"></div>

                    <a href="{{ route('puskesmas.pengaturan.petugas') }}" 
                       class="flex items-center justify-between p-3 hover:bg-slate-50 active:bg-slate-100 transition-colors group">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0 border border-indigo-100 group-hover:scale-105 transition-transform">
                                <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="text-[13px] font-bold text-slate-800 leading-tight">Profil Petugas</span>
                                <span class="text-[11px] text-slate-400 font-medium">Informasi Akun Petugas</span>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-slate-300 group-hover:text-slate-500 group-hover:translate-x-0.5 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </a>
                @else
                    {{-- Kader Settings --}}
                    <a href="{{ route('kader.profil') }}" 
                       class="flex items-center justify-between p-3 hover:bg-slate-50 active:bg-slate-100 transition-colors group">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center shrink-0 border border-teal-100 group-hover:scale-105 transition-transform">
                                <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="text-[13px] font-bold text-slate-800 leading-tight">Profil Lengkap</span>
                                <span class="text-[11px] text-slate-400 font-medium">Biodata & data posyandu</span>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-slate-300 group-hover:text-teal-600 group-hover:translate-x-0.5 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </a>

                    <div class="h-px bg-slate-100 ml-15"></div>

                    <a href="{{ route('kader.profil.edit') }}" 
                       class="flex items-center justify-between p-3 hover:bg-slate-50 active:bg-slate-100 transition-colors group">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 border border-emerald-100 group-hover:scale-105 transition-transform">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" /></svg>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="text-[13px] font-bold text-slate-800 leading-tight">Edit Biodata</span>
                                <span class="text-[11px] text-slate-400 font-medium">Perbarui kontak & foto</span>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-slate-300 group-hover:text-teal-600 group-hover:translate-x-0.5 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </a>
                @endif
            </div>
        </div>

        <!-- Group 2: Bantuan & Sistem -->
        <div class="flex flex-col gap-1.5">
            <span class="px-2 text-[10.5px] font-bold text-slate-400 uppercase tracking-widest">Bantuan & Info</span>

            <div class="bg-white rounded-2xl border border-slate-200/70 shadow-2xs overflow-hidden">
                <a href="javascript:void(0)" 
                   onclick="window.NutriAlert.toast('Fitur Bantuan & Panduan segera hadir.', 'info', 'Pusat Bantuan')"
                   class="flex items-center justify-between p-3 hover:bg-slate-50 active:bg-slate-100 transition-colors group">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 border border-amber-100 group-hover:scale-105 transition-transform">
                            <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 10-1-1zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg>
                        </div>
                        <div class="flex flex-col min-w-0">
                            <span class="text-[13px] font-bold text-slate-800 leading-tight">Pusat Bantuan</span>
                            <span class="text-[11px] text-slate-400 font-medium">Panduan operasional</span>
                        </div>
                    </div>
                    <span class="text-[10px] font-bold text-slate-400 bg-slate-100 px-2 py-0.5 rounded-md">FAQ</span>
                </a>

                <div class="h-px bg-slate-100 ml-15"></div>

                <a href="javascript:void(0)" 
                   onclick="window.NutriAlert.toast('NutriGen v1.0.0 — Sistem Monitoring Gizi & Pertumbuhan Anak', 'success', 'Versi Aplikasi')"
                   class="flex items-center justify-between p-3 hover:bg-slate-50 active:bg-slate-100 transition-colors group">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-slate-50 text-slate-600 flex items-center justify-center shrink-0 border border-slate-150 group-hover:scale-105 transition-transform">
                            <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" /></svg>
                        </div>
                        <div class="flex flex-col min-w-0">
                            <span class="text-[13px] font-bold text-slate-800 leading-tight">Tentang NutriGen</span>
                            <span class="text-[11px] text-slate-400 font-medium">Monitoring gizi anak</span>
                        </div>
                    </div>
                    <span class="text-[10px] font-bold text-teal-700 bg-teal-50 px-2 py-0.5 rounded-md border border-teal-100">v1.0</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 3. Drawer Footer: Refined Logout Button -->
    <div class="p-3.5 sm:p-4 border-t border-slate-200/60 bg-white shrink-0">
        <form action="{{ route('logout') }}" method="POST" onsubmit="if(window.NutriAlert && typeof window.NutriAlert.confirm === 'function'){ event.preventDefault(); const form = this; window.NutriAlert.confirm('Keluar dari Aplikasi?', 'Anda harus login kembali untuk mengakses data.', 'Keluar', 'Batal').then((r) => { if(r.isConfirmed) form.submit(); }); return false; } return confirm('Keluar dari Aplikasi?');">
            @csrf
            <button type="submit" 
                    class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-2xl text-rose-600 bg-rose-50/70 hover:bg-rose-100/90 active:bg-rose-200/70 border border-rose-200/70 font-bold text-[13px] transition-all shadow-2xs hover:shadow-xs cursor-pointer active:scale-[0.98] group">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4 text-rose-500 group-hover:-translate-x-0.5 transition-transform">
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
