<header
    :class="{ 'bg-white/80 backdrop-blur-md shadow-[0_4px_20px_rgba(0,0,0,0.02)] border-slate-200/50': scrolled, 'bg-white border-slate-200':
            !scrolled }"
    class="flex-shrink-0 z-50 flex items-center justify-between px-6 lg:px-8 h-[76px] border-b w-full sticky top-0 transition-all duration-300">
    <!-- Left: Hamburger & Mobile Logo -->
    <div class="flex items-center gap-4">
        <!-- Hamburger (Mobile Only) -->
        <button id="sidebarToggle"
            class="p-2 -ml-2 text-slate-500 hover:text-slate-900 hover:bg-slate-50 rounded-xl transition-all lg:hidden"
            aria-label="Buka menu">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>

        <!-- Logo & Title -->
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
            <div class="w-8 h-8 flex items-center justify-center flex-shrink-0">
                <img src="{{ asset('images/logo/logo-nutrigen.png') }}" alt="NutriGen Logo"
                    class="w-full h-full object-contain">
            </div>
            <div class="flex flex-col">
                <h1 class="text-[17px] font-black text-slate-900 tracking-tight leading-none">NutriGen</h1>
                <span
                    class="text-[8px] font-extrabold text-slate-400 tracking-[0.2em] uppercase mt-0.5 hidden sm:block">Monitoring
                    Gizi Anak</span>
            </div>
        </a>
    </div>

    <!-- Center: Search Bar (Puskesmas Only) -->
    @if (request()->is('puskesmas*'))
        <div class="hidden lg:flex flex-1 max-w-xl mx-8">
            <div
                class="flex items-center gap-2.5 bg-slate-50 border border-transparent hover:bg-white hover:border-slate-200 px-4 h-11 rounded-xl text-slate-400 text-sm focus-within:bg-white focus-within:border-[#10B981] focus-within:ring-2 focus-within:ring-[#A7F3D0] transition-all duration-300 w-full group shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="currentColor" class="w-4 h-4 group-focus-within:text-[#10B981] transition-colors">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                <input type="text" placeholder="Cari balita, posyandu, kader, atau data..."
                    class="bg-transparent border-none focus:ring-0 text-slate-900 w-full p-0 text-[13px] font-medium placeholder-[#94A3B8] outline-none">
                <div class="flex items-center gap-1">
                    <kbd
                        class="hidden xl:inline-block font-sans text-[9px] font-bold text-slate-400 bg-white border border-slate-200 rounded px-1.5 py-0.5 shadow-sm">⌘</kbd>
                    <kbd
                        class="hidden xl:inline-block font-sans text-[9px] font-bold text-slate-400 bg-white border border-slate-200 rounded px-1.5 py-0.5 shadow-sm">K</kbd>
                </div>
            </div>
        </div>
    @else
        <!-- Center: Desktop Navigation (Kader Only) -->
        <div class="hidden lg:flex items-center gap-8 absolute left-1/2 -translate-x-1/2 h-full">
            <a href="{{ route('kader.dashboard') }}"
                class="group relative flex items-center h-full px-2 text-[14px] font-bold transition-all {{ request()->routeIs('kader.dashboard') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }}">
                Dashboard
                <div
                    class="absolute bottom-0 left-0 right-0 h-1 bg-emerald-500 rounded-t-full transition-transform duration-300 origin-left {{ request()->routeIs('kader.dashboard') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}">
                </div>
            </a>
            <a href="{{ route('balita.index') }}"
                class="group relative flex items-center h-full px-2 text-[14px] font-bold transition-all {{ request()->routeIs('balita.*') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }}">
                Balita
                <div
                    class="absolute bottom-0 left-0 right-0 h-1 bg-emerald-500 rounded-t-full transition-transform duration-300 origin-left {{ request()->routeIs('balita.*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}">
                </div>
            </a>
            <a href="{{ route('jadwal.index') }}"
                class="group relative flex items-center h-full px-2 text-[14px] font-bold transition-all {{ request()->routeIs('jadwal.*') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }}">
                Jadwal
                <div
                    class="absolute bottom-0 left-0 right-0 h-1 bg-emerald-500 rounded-t-full transition-transform duration-300 origin-left {{ request()->routeIs('jadwal.*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}">
                </div>
            </a>
            <a href="{{ route('laporan.index') }}"
                class="group relative flex items-center h-full px-2 text-[14px] font-bold transition-all {{ request()->routeIs('laporan.*') ? 'text-emerald-600' : 'text-slate-500 hover:text-emerald-600' }}">
                Laporan
                <div
                    class="absolute bottom-0 left-0 right-0 h-1 bg-emerald-500 rounded-t-full transition-transform duration-300 origin-left {{ request()->routeIs('laporan.*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}">
                </div>
            </a>
        </div>
    @endif

    <!-- Right: Utilities & Profile -->
    <div x-data="{ openNotif: false, openProfile: false }" class="flex items-center gap-2 lg:gap-4 ml-auto">

        <!-- Notification Modal Trigger -->
        <button @click="openNotif = true"
            class="relative w-10 h-10 flex items-center justify-center text-slate-600 hover:text-teal-600 hover:bg-teal-50/80 rounded-xl transition-all duration-200 group cursor-pointer focus:outline-none focus:ring-2 focus:ring-teal-500/20"
            aria-label="Notifikasi">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="w-[22px] h-[22px] group-hover:animate-[wiggle_1s_ease-in-out_infinite]">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>

            {{-- Notification Badge (Red dot with count) --}}
            @if ($notificationRole === 'puskesmas' && ($validationNotifsCount ?? 0) > 0)
                <span
                    class="absolute top-1.5 right-1.5 min-w-[18px] h-[18px] px-1 bg-sky-500 text-white text-[10px] font-extrabold rounded-full flex items-center justify-center border-2 border-white shadow-xs animate-pulse">
                    {{ $validationNotifsCount }}
                </span>
            @elseif(isset($revisiNotifsCount) && $revisiNotifsCount > 0)
                <span
                    class="absolute top-1.5 right-1.5 min-w-[18px] h-[18px] px-1 bg-rose-500 text-white text-[10px] font-extrabold rounded-full flex items-center justify-center border-2 border-white shadow-xs animate-pulse">
                    {{ $revisiNotifsCount }}
                </span>
            @endif
        </button>

        <!-- Modern Centered Pop-up Modal (Persis Sesuai Screenshot Referensi & Responsif Mobile) -->
        <template x-teleport="body">
            <div x-show="openNotif" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-3 sm:p-6"
                style="display: none;" role="dialog" aria-modal="true" @keydown.escape.window="openNotif = false">

                {{-- Backdrop Blur --}}
                <div x-show="openNotif" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" @click="openNotif = false"
                    class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>

                {{-- Modal Box Container (Max height & scrollable on mobile) --}}
                <div x-show="openNotif" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95 translate-y-3"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                    x-transition:leave-end="opacity-0 scale-95 translate-y-3" @click.stop
                    class="relative w-full max-w-[560px] max-h-[90vh] sm:max-h-[85vh] bg-white rounded-2xl sm:rounded-[28px] shadow-[0_25px_70px_-15px_rgba(0,0,0,0.25)] border border-slate-100 overflow-hidden flex flex-col z-10">

                    {{-- 1. Modal Header --}}
                    <div
                        class="px-4 pt-4 pb-3 sm:px-6 sm:pt-6 sm:pb-4 flex items-center justify-between border-b border-slate-100/80 shrink-0">
                        <div class="flex items-center gap-2.5 sm:gap-3">
                            <div
                                class="w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-rose-50 border border-rose-100 text-rose-500 flex items-center justify-center shrink-0 shadow-2xs">
                                <svg class="w-4.5 h-4.5 sm:w-5 sm:h-5 fill-current" viewBox="0 0 20 20">
                                    <path
                                        d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                                </svg>
                            </div>
                            <div>
                                <h3
                                    class="text-sm sm:text-[17px] font-bold text-slate-900 tracking-tight leading-tight">
                                    {{ $notificationRole === 'puskesmas' ? 'Data Baru untuk Validasi' : 'Revisi dari Puskesmas' }}
                                </h3>
                                <p class="text-[10.5px] sm:text-xs text-slate-400 font-medium mt-0.5">
                                    {{ $notificationRole === 'puskesmas' ? 'Pengukuran baru dari kader posyandu' : 'Catatan perbaikan data balita' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 sm:gap-2.5">
                            @if ($notificationRole === 'puskesmas' && $validationNotifsCount > 0)
                                <span
                                    class="bg-sky-50 text-sky-600 border border-sky-200/60 text-[9.5px] sm:text-[10.5px] font-bold px-2.5 py-0.5 sm:px-3.5 sm:py-1 rounded-full uppercase tracking-wider shadow-2xs">
                                    {{ $validationNotifsCount }} PENDING
                                </span>
                            @elseif(isset($revisiNotifsCount) && $revisiNotifsCount > 0)
                                <span
                                    class="bg-rose-50 text-rose-600 border border-rose-200/60 text-[9.5px] sm:text-[10.5px] font-bold px-2.5 py-0.5 sm:px-3.5 sm:py-1 rounded-full uppercase tracking-wider shadow-2xs">
                                    {{ $revisiNotifsCount }} REVISI
                                </span>
                            @endif
                            <button @click="openNotif = false"
                                class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-400 hover:text-slate-700 flex items-center justify-center transition-colors cursor-pointer"
                                aria-label="Tutup modal">
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- 2. Modal Body (List Revisi dengan scroll halus di mobile) --}}
                    <div
                        class="px-4 py-3 sm:px-6 sm:py-4 space-y-3 sm:space-y-4 max-h-[calc(90vh-140px)] sm:max-h-[420px] overflow-y-auto hide-scrollbar divide-y divide-slate-100">
                        @if ($notificationRole === 'puskesmas')
                            @forelse($validationNotifs as $notif)
                                <a href="{{ route('puskesmas.validasi', ['tab' => 'pending']) }}"
                                    class="flex items-start gap-3 group pt-3 first:pt-0 pb-1 cursor-pointer block">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 border border-sky-100 flex items-center justify-center shrink-0 font-bold text-xs">
                                        {{ strtoupper(substr($notif['balita_nama'], 0, 2)) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between gap-2">
                                            <h4
                                                class="text-sm font-bold text-slate-900 group-hover:text-sky-700 transition-colors truncate">
                                                {{ Str::title($notif['balita_nama']) }}</h4>
                                            <span
                                                class="text-[10px] font-semibold text-slate-400 shrink-0">{{ $notif['tanggal'] }}</span>
                                        </div>
                                        <p class="text-[11px] font-semibold text-slate-600 mt-1">Dikirim oleh
                                            {{ $notif['kader_nama'] }}</p>
                                        <div
                                            class="mt-2 p-2.5 rounded-xl bg-sky-50/70 border border-sky-100 text-[11px] text-sky-900 font-medium">
                                            BB {{ $notif['bb'] }} kg / TB {{ $notif['tb'] }} cm &middot; Menunggu
                                            validasi
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="p-6 sm:p-8 text-center bg-white">
                                    <div
                                        class="w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2.2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4.5 12.75l6 6 9-13.5" />
                                        </svg>
                                    </div>
                                    <h4 class="text-sm font-bold text-slate-800">Tidak ada data baru</h4>
                                    <p class="text-xs text-slate-500 mt-1">Semua pengukuran kader sudah diproses.</p>
                                </div>
                            @endforelse
                        @else
                            @if (isset($revisiNotifs) && count($revisiNotifs) > 0)
                                @foreach ($revisiNotifs as $notif)
                                    @php
                                        $palettes = [
                                            0 => [
                                                'avatar' => 'bg-rose-100/70 text-rose-700 ring-rose-200/60',
                                                'bubble' => 'bg-rose-50/80 border-rose-100 text-rose-900',
                                                'icon' => 'text-rose-500',
                                            ],
                                            1 => [
                                                'avatar' => 'bg-purple-100/70 text-purple-700 ring-purple-200/60',
                                                'bubble' => 'bg-purple-50/80 border-purple-100 text-purple-900',
                                                'icon' => 'text-purple-500',
                                            ],
                                            2 => [
                                                'avatar' => 'bg-amber-100/70 text-amber-700 ring-amber-200/60',
                                                'bubble' => 'bg-amber-50/80 border-amber-100 text-amber-900',
                                                'icon' => 'text-amber-500',
                                            ],
                                        ];
                                        $pal = $palettes[$loop->index % 3];
                                    @endphp
                                    <a href="{{ route('balita.show', ['id' => $notif['balita_id'], 'action' => 'ukur']) }}"
                                        class="flex items-start gap-2.5 sm:gap-3.5 group pt-3 sm:pt-3.5 first:pt-0 pb-1 cursor-pointer block">

                                        {{-- Avatar Inisial --}}
                                        <div
                                            class="w-9 h-9 sm:w-10 sm:h-10 rounded-full {{ $pal['avatar'] }} ring-2 flex items-center justify-center shrink-0 mt-0.5 font-bold text-[11px] sm:text-xs shadow-2xs">
                                            {{ strtoupper(substr($notif['balita_nama'], 0, 2)) }}
                                        </div>

                                        {{-- Info Detail & Catatan --}}
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between gap-1.5 sm:gap-2">
                                                <h4
                                                    class="text-[13px] sm:text-sm font-bold text-slate-900 group-hover:text-teal-700 transition-colors truncate">
                                                    {{ Str::title($notif['balita_nama']) }}
                                                </h4>
                                                <div
                                                    class="flex items-center gap-1 text-[10.5px] sm:text-xs font-semibold text-slate-400 group-hover:text-teal-600 transition-colors shrink-0">
                                                    <span>{{ $notif['tanggal'] }}</span>
                                                    <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 group-hover:translate-x-1 transition-transform"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="2.5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                                    </svg>
                                                </div>
                                            </div>

                                            {{-- BB / TB --}}
                                            <p class="text-[11.5px] sm:text-xs font-bold text-slate-700 mt-0.5">
                                                BB {{ $notif['bb'] }} kg / TB {{ $notif['tb'] }} cm
                                            </p>

                                            {{-- Note Bubble Box (Persis Screenshot) --}}
                                            <div
                                                class="mt-2 sm:mt-2.5 p-2.5 sm:p-3 rounded-xl sm:rounded-2xl {{ $pal['bubble'] }} border text-[11px] sm:text-xs leading-relaxed font-medium">
                                                <div class="flex items-start gap-1.5 sm:gap-2">
                                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 {{ $pal['icon'] }} shrink-0 mt-0.5"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="line-clamp-2">{{ $notif['catatan'] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                {{-- Empty State (Clean & Elegant) --}}
                                <div class="p-6 sm:p-8 text-center bg-white">
                                    <div
                                        class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center mx-auto mb-2.5 sm:mb-3 shadow-2xs">
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2.2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4.5 12.75l6 6 9-13.5" />
                                        </svg>
                                    </div>
                                    <h4 class="text-sm font-bold text-slate-800">Semua Data Valid</h4>
                                    <p
                                        class="text-[11px] sm:text-xs text-slate-500 font-normal mt-1 max-w-[260px] mx-auto leading-relaxed">
                                        Tidak ada catatan revisi balita dari Puskesmas saat ini.
                                    </p>
                                </div>
                            @endif
                        @endif
                    </div>

                    {{-- 3. Modal Footer --}}
                    <div
                        class="bg-slate-50/70 border-t border-slate-100 px-4 py-3 sm:px-6 sm:py-4 flex items-center justify-between gap-2 shrink-0">
                        <div
                            class="flex items-center gap-1.5 sm:gap-2 text-[11px] sm:text-xs text-slate-600 font-medium min-w-0">
                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-emerald-600 shrink-0" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span
                                class="hidden sm:inline truncate">{{ $notificationRole === 'puskesmas' ? 'Periksa pengukuran yang masuk dari kader' : 'Pastikan data sudah diperbaiki agar laporan lebih akurat' }}</span>
                            <span
                                class="sm:hidden text-[10.5px] truncate">{{ $notificationRole === 'puskesmas' ? 'Validasi data baru' : 'Perbaiki data balita' }}</span>
                        </div>
                        <a href="{{ $notificationRole === 'puskesmas' ? route('puskesmas.validasi') : route('balita.index', ['filter' => 'ditolak']) }}"
                            class="h-8 sm:h-9 px-3 sm:px-4 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-800 font-bold text-[11px] sm:text-xs flex items-center gap-1.5 transition-all shadow-2xs cursor-pointer shrink-0">
                            <span>Lihat Semua</span>
                            <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </a>
                    </div>

                </div>
            </div>
        </template>

        <div class="w-px h-6 bg-[#E2E8F0] hidden lg:block mx-1"></div>

        <!-- Desktop Profile Dropdown -->
        <div class="relative hidden lg:block">
            <button @click="openProfile = !openProfile" @click.outside="openProfile = false"
                class="flex items-center gap-3 p-1.5 hover:bg-slate-50 rounded-xl transition-all duration-200 group text-left border border-transparent hover:border-slate-200 cursor-pointer focus:outline-none focus:ring-2 focus:ring-emerald-500/20">
                <div
                    class="w-9 h-9 rounded-full bg-gradient-to-br {{ request()->is('puskesmas*') ? 'from-sky-400 to-blue-600' : 'from-teal-400 to-emerald-600' }} flex items-center justify-center text-white shrink-0 shadow-sm border-2 border-white group-hover:scale-105 group-hover:shadow-md transition-all duration-300 overflow-hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd"
                            d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="flex flex-col min-w-0">
                    <span
                        class="text-[13px] font-bold text-slate-800 leading-tight group-hover:{{ request()->is('puskesmas*') ? 'text-blue-600' : 'text-emerald-600' }} transition-colors truncate">{{ Auth::user()->name ?? 'Ibu Kader' }}</span>
                    <span
                        class="text-[11px] font-medium text-slate-500 truncate">{{ request()->is('puskesmas*') ? Auth::user()->puskesmas->nama ?? 'Puskesmas' : $posyanduName ?? 'Posyandu Melati 1' }}</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="currentColor"
                    class="w-4 h-4 text-slate-400 group-hover:text-slate-600 transition-transform duration-300"
                    :class="{ 'rotate-180': openProfile }">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="openProfile" x-transition:enter="transition ease-[cubic-bezier(0.16,1,0.3,1)] duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-2" style="display: none;"
                class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-[0_12px_40px_-12px_rgba(0,0,0,0.15)] ring-1 ring-slate-100 p-2 overflow-hidden z-50">
                @if (!request()->is('puskesmas*'))
                    <a href="{{ route('kader.profil') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-emerald-600 font-bold text-[13px] transition-colors group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4 text-slate-400 group-hover:text-emerald-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                        </svg>
                        Edit Profil
                    </a>
                @endif

                <a href="javascript:void(0)"
                    onclick="window.NutriAlert.warning('Segera Hadir', 'Fitur Bantuan segera hadir.')"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-emerald-600 font-bold text-[13px] transition-colors group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-4 h-4 text-slate-400 group-hover:text-emerald-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                    </svg>
                    Pusat Bantuan
                </a>
                <a href="javascript:void(0)" onclick="window.NutriAlert.success('Versi Sistem', 'NutriGen v1.0.0')"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-emerald-600 font-bold text-[13px] transition-colors group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-4 h-4 text-slate-400 group-hover:text-emerald-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                    Tentang Aplikasi
                </a>

                <div class="h-px w-full bg-slate-100 my-1"></div>

                <form action="{{ route('logout') }}" method="POST"
                    onsubmit="if(window.NutriAlert && typeof window.NutriAlert.confirm === 'function'){ event.preventDefault(); const form = this; window.NutriAlert.confirm('Keluar dari Aplikasi?', 'Anda harus login kembali untuk mengakses data.', 'Keluar', 'Batal').then((r) => { if(r.isConfirmed) form.submit(); }); return false; } return confirm('Keluar dari Aplikasi?');">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-rose-600 hover:bg-rose-50 font-bold text-[13px] transition-colors group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="2.5" stroke="currentColor"
                            class="w-4 h-4 text-rose-400 group-hover:text-rose-600 group-hover:-translate-x-0.5 transition-transform">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                        Keluar Aplikasi
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
