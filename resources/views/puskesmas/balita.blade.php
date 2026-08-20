@extends('layouts.puskesmas')
@section('page-title', 'Data Balita (Direktori)')
@section('page-mode', 'app')
@section('content')

    {{-- Backend Contract:
    Controller: PuskesmasBalitaController@index
    Expected Variables: $children, $posyandus, $filters
--}}
    {{--
    Data disuplai oleh PuskesmasController@balita
    Variables tersedia: $children, $posyandus, $filters
--}}




    <!-- Toast Notification Container -->
    <div id="toastContainer" class="fixed top-10 right-5 z-50 flex flex-col gap-2"></div>

    <!-- Full-viewport Split View: Medical Record Workspace -->
    <div class="flex flex-col lg:flex-row lg:gap-4 flex-1 overflow-hidden">

        <!-- LEFT PANEL: Direktori Balita — bg-slate-50/60 (Canvas base) -->
        <div
            class="w-full lg:w-[360px] xl:w-[380px] flex flex-col border-r border-slate-200/80 bg-slate-100/60 shrink-0 overflow-hidden relative z-10">

            <!-- Panel Header (sticky) -->
            <div
                class="flex flex-col border-b border-slate-200/80 sticky top-0 z-20 shrink-0 bg-slate-50/90 backdrop-blur-xl">
                <div class="px-5 pt-5 pb-4">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-0.5">Medical Records</p>
                    <h2 class="text-base font-bold tracking-tight text-slate-800">Direktori Balita</h2>

                    <!-- Search & Filter Form -->
                    <form id="filterForm" action="{{ route('puskesmas.balita') }}" method="GET"
                        class="flex flex-col gap-3 mt-4">
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor"
                                class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                            <input type="text" id="searchInput" name="q" value="{{ $filters['q'] ?? '' }}"
                                placeholder="Cari nama balita..."
                                class="w-full pl-10 pr-3 py-2.5 text-sm border border-slate-200 rounded-lg focus:ring-mint-500 focus:border-mint-500 font-medium bg-white shadow-sm">
                        </div>

                        <div class="flex gap-2.5">
                            <select id="posyanduFilter" name="posyandu_id"
                                class="flex-1 bg-white border border-slate-200 text-slate-700 text-xs rounded-lg px-2.5 py-2 focus:ring-mint-500 focus:border-mint-500 font-medium shadow-sm"
                                onchange="this.form.submit()">
                                <option value="">Semua Posyandu</option>
                                @foreach ($posyandus as $posyandu)
                                    <option value="{{ $posyandu['id'] }}"
                                        {{ (string) ($filters['posyandu_id'] ?? '') === (string) $posyandu['id'] ? 'selected' : '' }}>
                                        {{ $posyandu['nama'] }}</option>
                                @endforeach
                            </select>

                            <select id="statusFilter" name="status_gizi"
                                class="flex-1 bg-white border border-slate-200 text-slate-700 text-xs rounded-lg px-2.5 py-2 focus:ring-mint-500 focus:border-mint-500 font-medium shadow-sm"
                                onchange="this.form.submit()">
                                <option value="">Semua Status Gizi</option>
                                <option value="normal" {{ ($filters['status_gizi'] ?? '') == 'normal' ? 'selected' : '' }}>
                                    Normal / Gizi Baik</option>
                                <option value="kurang" {{ ($filters['status_gizi'] ?? '') == 'kurang' ? 'selected' : '' }}>
                                    Kurang / Kurus</option>
                                <option value="risiko" {{ ($filters['status_gizi'] ?? '') == 'risiko' ? 'selected' : '' }}>
                                    Risiko</option>
                                <option value="stunting"
                                    {{ ($filters['status_gizi'] ?? '') == 'stunting' ? 'selected' : '' }}>Stunting / Gizi
                                    Buruk</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <!-- List Balita (Scrollable) -->
            <div id="balitaListContainer" class="flex-1 overflow-y-auto flex flex-col hide-scrollbar">
                @forelse($children as $index => $child)
                    <x-balita.list-card :child="$child" :isActive="$index === 0" />
                @empty
                    <div class="flex flex-col items-center justify-center h-48 text-slate-400 gap-3">
                        <span class="text-sm font-medium">Tidak ada data balita.</span>
                    </div>
                @endforelse

                <div id="noResultState" class="hidden flex-col items-center justify-center h-48 text-slate-400 gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-12 h-12 opacity-50">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-sm font-medium">Balita tidak ditemukan.</span>
                </div>
            </div>
        </div><!-- end left panel -->

        <!-- Mobile Drawer Overlay -->
        <div id="drawerOverlay"
            class="fixed inset-0 bg-slate-900/40 z-30 hidden opacity-0 transition-opacity duration-300 lg:hidden"></div>

        <!-- RIGHT PANEL: Balita Profile Workspace -->
        <div id="workspaceDrawer"
            class="fixed inset-x-0 bottom-0 z-40 h-[90vh] bg-white rounded-t-3xl transform translate-y-full transition-transform duration-300 ease-in-out shadow-2xl flex flex-col lg:relative lg:inset-auto lg:h-auto lg:translate-y-0 lg:rounded-tl-[2rem] lg:flex-1 lg:z-auto lg:shadow-none border-t border-slate-200 lg:border-t-0 lg:border-l lg:border-slate-200/50">

            <!-- Mobile Drawer Header (Handle & Close Button) -->
            <div id="drawerHandle"
                class="w-full flex items-center justify-between px-5 py-3.5 bg-white rounded-t-3xl border-b border-slate-100 lg:hidden shrink-0 cursor-pointer active:bg-slate-50 transition-colors">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest w-16 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                        stroke="currentColor" class="w-3.5 h-3.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                    Kembali
                </span>
                <div class="w-12 h-1.5 bg-slate-200 rounded-full"></div>
                <div class="w-16 flex justify-end">
                    <div class="bg-slate-100 p-1.5 rounded-full text-slate-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
            </div>

            @if (count($children) > 0)
                <div id="workspacesContainer"
                    class="flex-1 flex flex-col overflow-hidden relative bg-slate-50/80 lg:rounded-tl-[2rem]">
                    @foreach ($children as $index => $child)
                        <!-- WORKSPACE PANEL (1 per anak) -->
                        <div id="workspace-panel-{{ $child['id'] }}"
                            class="workspace-panel flex-1 flex flex-col h-full absolute inset-0 {{ $index === 0 ? '' : 'hidden' }} overflow-y-auto hide-scrollbar">

                            <x-balita.profile-header :child="$child" />

                            <!-- Main Content Flow -->
                            <div class="p-5 lg:p-8 flex flex-col gap-8 shrink-0 pb-24 lg:pb-12 max-w-4xl mx-auto w-full">

                                <!-- Flow: Grafik Pertumbuhan -->
                                <div class="flex flex-col gap-4">
                                    <div class="flex items-center gap-2.5 pb-2 border-b border-slate-200/80">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-sky-100 text-sky-600 flex items-center justify-center shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-[15px] font-black text-slate-800">Grafik Pertumbuhan Antropometri
                                        </h3>
                                    </div>
                                    <div
                                        class="bg-white border border-slate-200 rounded-[2rem] p-5 sm:p-6 shadow-sm relative z-0">
                                        <x-balita.growth-chart :child="$child" />
                                    </div>
                                </div>

                                <!-- Flow: Riwayat Medis -->
                                <div class="flex flex-col gap-4 mt-4">
                                    <div class="flex items-center gap-2.5 pb-2 border-b border-slate-200/80">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-[15px] font-black text-slate-800">Riwayat Pengukuran Medis</h3>
                                    </div>
                                    <x-balita.measurement-history :pengukurans="$child['pengukurans']" />
                                </div>

                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex-1 flex flex-col items-center justify-center text-slate-400 p-8 bg-slate-50">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-16 h-16 opacity-30 mb-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                    <p class="font-medium text-center">Data balita tidak tersedia.</p>
                </div>
            @endif
        </div><!-- end right panel -->

    </div><!-- end split view -->

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const drawer = document.getElementById('workspaceDrawer');
                const overlay = document.getElementById('drawerOverlay');
                const handle = document.getElementById('drawerHandle');

                function openDrawer() {
                    if (window.innerWidth >= 1024) return;
                    drawer.classList.remove('translate-y-full');
                    overlay.classList.remove('hidden');
                    setTimeout(() => overlay.classList.remove('opacity-0'), 10);
                    document.body.style.overflow = 'hidden';
                }

                function closeDrawer() {
                    if (window.innerWidth >= 1024) return;
                    drawer.classList.add('translate-y-full');
                    overlay.classList.add('opacity-0');
                    setTimeout(() => overlay.classList.add('hidden'), 300);
                    document.body.style.overflow = '';
                }

                if (overlay) overlay.addEventListener('click', closeDrawer);
                if (handle) handle.addEventListener('click', closeDrawer);

                function selectBalita(id) {
                    document.querySelectorAll('.balita-card-btn').forEach(btn => {
                        btn.classList.remove('bg-sky-50/60', 'border-l-sky-500', 'z-10');
                        btn.classList.add('border-l-transparent', 'bg-white', 'hover:bg-slate-50',
                            'hover:border-l-slate-300');
                    });

                    const targetBtn = document.querySelector(`.balita-card-btn[data-balita-id="${id}"]`);
                    if (targetBtn) {
                        targetBtn.classList.remove('border-l-transparent', 'bg-white', 'hover:bg-slate-50',
                            'hover:border-l-slate-300');
                        targetBtn.classList.add('bg-sky-50/60', 'border-l-sky-500', 'z-10');
                    }

                    document.querySelectorAll('.workspace-panel').forEach(panel => {
                        panel.classList.add('hidden');
                    });

                    const targetPanel = document.getElementById(`workspace-panel-${id}`);
                    if (targetPanel) {
                        targetPanel.classList.remove('hidden');
                    }

                    openDrawer();
                }

                const listContainer = document.getElementById('balitaListContainer');
                if (listContainer) {
                    listContainer.addEventListener('click', (e) => {
                        const btn = e.target.closest('.balita-card-btn');
                        if (btn) selectBalita(btn.dataset.balitaId);
                    });
                }

                // Initialize active card
                const firstCard = document.querySelector('.balita-card-btn');
                if (firstCard) {
                    selectBalita(firstCard.dataset.balitaId);
                }
            });
        </script>
    @endpush
@endsection
