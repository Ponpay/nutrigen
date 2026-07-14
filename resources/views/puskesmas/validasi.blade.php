@extends('layouts.puskesmas')
@section('page-title', 'Antrean Validasi')
@section('page-mode', 'app')
@section('content')

{{-- Backend Contract:
    Controller: PuskesmasValidasiController@index
    Expected Variables: $children, $filters
--}}
@php
    $filters = [
        'tab' => request('tab', 'pending'),
        'posyandu_id' => request('posyandu_id', '')
    ];

    $children = [
        [
            'id' => 'v1',
            'name' => 'Dinda Amanda',
            'nik' => '3273110204230001',
            'gender' => 'P',
            'age' => '27 bln',
            'indicator' => 'TB/U',
            'value' => '-2.45 (Pendek)',
            'posyandu' => 'Melati 2',
            'kader' => 'Kader Siti',
            'time' => '10:30',
            'date' => '12 April 2025',
            'statusType' => 'danger',
            'statusLabel' => 'Berisiko',
            'parent' => 'Ibu Aisyah',
            'bb' => '12.1 kg',
            'tb' => '85.0 cm',
            'zscores' => [
                'BB/U' => ['val' => '-1.10', 'status' => 'Normal', 'color' => 'emerald'],
                'TB/U' => ['val' => '-2.45', 'status' => 'Pendek', 'color' => 'rose'],
                'BB/TB'=> ['val' => '+0.50', 'status' => 'Normal', 'color' => 'emerald'],
                'IMT/U'=> ['val' => '+0.80', 'status' => 'Normal', 'color' => 'emerald'],
            ],
            'history' => [
                ['month' => 'Mar', 'bb' => '11.5 kg', 'tb' => '84.0 cm', 'status' => 'Valid'],
                ['month' => 'Feb', 'bb' => '11.2 kg', 'tb' => '83.0 cm', 'status' => 'Valid'],
            ]
        ],
        [
            'id' => 'v2',
            'name' => 'Nazwa Aulia',
            'nik' => '3273110504230004',
            'gender' => 'P',
            'age' => '29 bln',
            'indicator' => 'IMT/U',
            'value' => '-2.01',
            'posyandu' => 'Melati 3',
            'kader' => 'Kader Rina',
            'time' => '09:15',
            'date' => '12 April 2025',
            'statusType' => 'warning',
            'statusLabel' => 'Anomali',
            'parent' => 'Ibu Budi',
            'bb' => '10.5 kg',
            'tb' => '88.0 cm',
            'zscores' => [
                'BB/U' => ['val' => '-1.80', 'status' => 'Normal', 'color' => 'emerald'],
                'TB/U' => ['val' => '-1.50', 'status' => 'Normal', 'color' => 'emerald'],
                'BB/TB'=> ['val' => '-2.10', 'status' => 'Kurus', 'color' => 'amber'],
                'IMT/U'=> ['val' => '-2.01', 'status' => 'Kurus', 'color' => 'amber'],
            ],
            'history' => [
                ['month' => 'Mar', 'bb' => '10.0 kg', 'tb' => '86.5 cm', 'status' => 'Valid'],
                ['month' => 'Feb', 'bb' => '9.8 kg', 'tb' => '85.0 cm', 'status' => 'Valid'],
            ]
        ],
        [
            'id' => 'v3',
            'name' => 'Alif Pratama',
            'nik' => '3273110804240002',
            'gender' => 'L',
            'age' => '18 bln',
            'indicator' => 'BB/U',
            'value' => '-2.18',
            'posyandu' => 'Melati 4',
            'kader' => 'Kader Yuni',
            'time' => '08:45',
            'date' => '12 April 2025',
            'statusType' => 'warning',
            'statusLabel' => 'Anomali',
            'parent' => 'Ibu Caca',
            'bb' => '9.2 kg',
            'tb' => '78.5 cm',
            'zscores' => [
                'BB/U' => ['val' => '-2.18', 'status' => 'Kurang', 'color' => 'amber'],
                'TB/U' => ['val' => '-1.90', 'status' => 'Normal', 'color' => 'emerald'],
                'BB/TB'=> ['val' => '-1.20', 'status' => 'Normal', 'color' => 'emerald'],
                'IMT/U'=> ['val' => '-1.15', 'status' => 'Normal', 'color' => 'emerald'],
            ],
            'history' => [
                ['month' => 'Mar', 'bb' => '8.9 kg', 'tb' => '77.0 cm', 'status' => 'Valid'],
                ['month' => 'Feb', 'bb' => '8.6 kg', 'tb' => '76.0 cm', 'status' => 'Valid'],
            ]
        ]
    ];
@endphp

<!-- Toast Notification Container -->
<div id="toastContainer" class="fixed top-10 right-5 z-50 flex flex-col gap-2"></div>

<!-- Full-viewport Split View: Clinical Workspace -->
<div class="flex flex-col lg:flex-row flex-1 overflow-hidden">

    <!-- LEFT PANEL: Antrean Queue — bg-slate-50/60 (Canvas base) -->
    <div class="w-full lg:w-[360px] xl:w-[380px] flex flex-col border-r border-slate-200 bg-slate-50/60 shrink-0 overflow-hidden relative z-10">

        <!-- Panel Header (sticky) -->
        <div class="flex flex-col border-b border-slate-200 sticky top-0 z-20 shrink-0 bg-slate-50">
            <!-- Section Label -->
            <div class="px-5 pt-5 pb-3 flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Clinical Workspace</p>
                    <h2 class="text-base font-bold text-slate-800 mt-0.5">Antrean Validasi</h2>
                </div>
            </div>
            <!-- Tabs -->
            <div class="flex overflow-x-auto lg:overflow-x-visible hide-scrollbar border-b border-slate-200 px-2 gap-1">
                <a href="?tab=pending" class="px-3 py-2.5 text-xs font-bold whitespace-nowrap {{ $filters['tab'] === 'pending' ? 'text-teal-700 border-b-2 border-teal-600 bg-white rounded-t-lg' : 'text-slate-500 hover:text-slate-800' }}">Semua Pending</a>
                <a href="?tab=anomali" class="px-3 py-2.5 text-xs font-bold whitespace-nowrap {{ $filters['tab'] === 'anomali' ? 'text-teal-700 border-b-2 border-teal-600 bg-white rounded-t-lg' : 'text-slate-500 hover:text-slate-800' }}">Anomali</a>
                <a href="?tab=berisiko" class="px-3 py-2.5 text-xs font-bold whitespace-nowrap {{ $filters['tab'] === 'berisiko' ? 'text-teal-700 border-b-2 border-teal-600 bg-white rounded-t-lg' : 'text-slate-500 hover:text-slate-800' }}">Berisiko</a>
            </div>
            <!-- Filter Bar -->
            <form action="{{ route('puskesmas.validasi') }}" method="GET" class="px-4 py-3 flex items-center gap-2 border-b border-slate-100 bg-slate-50">
                <input type="hidden" name="tab" value="{{ $filters['tab'] }}">
                <select name="posyandu_id" class="bg-white border border-slate-200 text-slate-700 text-[11px] rounded flex-1 p-2 focus:ring-teal-500 focus:border-teal-500 font-medium">
                    <option value="">Semua Posyandu</option>
                    <option value="melati 1" {{ $filters['posyandu_id'] == 'melati 1' ? 'selected' : '' }}>Melati 1</option>
                    <option value="melati 2" {{ $filters['posyandu_id'] == 'melati 2' ? 'selected' : '' }}>Melati 2</option>
                </select>
                <button type="submit" class="bg-white border border-slate-200 p-2 rounded text-slate-500 hover:bg-slate-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                    </svg>
                </button>
            </form>
        </div>

        <!-- List Antrean (Scrollable) -->
        <div id="queueListContainer" class="flex-1 overflow-y-auto flex flex-col hide-scrollbar">
            @forelse($children as $index => $child)
                <div id="card-{{ $child['id'] }}" class="queue-card-wrapper transition-all duration-300 origin-top">
                    <x-validation.queue-card :child="$child" :isActive="$index === 0" />
                </div>
            @empty
                <div id="emptyStateQueue" class="flex flex-col items-center justify-center h-48 text-slate-400 gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 opacity-50">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-sm font-medium">Semua antrean telah divalidasi.</span>
                </div>
            @endforelse
            
            <div id="emptyState" class="hidden flex-col items-center justify-center h-48 text-slate-400 gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 opacity-50">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium">Semua antrean telah divalidasi.</span>
            </div>
        </div>
    </div><!-- end left panel -->

    <!-- Mobile Drawer Overlay Background -->
    <div id="drawerOverlay" class="fixed inset-0 bg-slate-900/40 z-30 hidden opacity-0 transition-opacity duration-300 lg:hidden"></div>

    <!-- RIGHT PANEL: Validation Workspace — bg-white, pure work surface with shadow separation -->
    <div id="workspaceDrawer" class="fixed inset-x-0 bottom-0 z-40 h-[90vh] bg-white rounded-t-3xl transform translate-y-full transition-transform duration-300 ease-in-out shadow-2xl flex flex-col lg:relative lg:inset-auto lg:h-auto lg:translate-y-0 lg:rounded-none lg:flex-1 lg:z-auto lg:shadow-none border-t border-slate-200 lg:border-t-0">
        
        <!-- Mobile Drawer Handle -->
        <div id="drawerHandle" class="w-full flex items-center justify-center py-3 bg-white rounded-t-3xl border-b border-slate-100 lg:hidden shrink-0 cursor-pointer">
            <div class="w-12 h-1.5 bg-slate-300 rounded-full"></div>
        </div>

        @if(count($children) > 0)
            <div id="workspacesContainer" class="flex-1 flex flex-col overflow-hidden relative bg-slate-50/30">
                @foreach($children as $index => $child)
                    <!-- WORKSPACE PANEL (1 per anak) -->
                    <div id="workspace-panel-{{ $child['id'] }}" class="workspace-panel flex-1 flex flex-col h-full absolute inset-0 {{ $index === 0 ? '' : 'hidden' }} overflow-y-auto hide-scrollbar">
                        
                        <x-validation.workspace-header :child="$child" />
                        
                        <!-- Flow Content Container: Unified group with clear typography and spacing -->
                        <div class="p-5 lg:p-8 flex flex-col gap-8 shrink-0 pb-24 max-w-4xl mx-auto w-full">
                            
                            <!-- Clinical Data Flow -->
                            <div class="flex flex-col gap-6">
                                <h3 class="text-sm font-bold text-slate-800 border-b border-slate-200 pb-2">Data Klinis & Antropometri</h3>
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
                                    <x-validation.zscore-grid :zscores="$child['zscores']" />
                                    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm h-full">
                                        <x-validation.growth-chart />
                                    </div>
                                </div>
                            </div>

                            <!-- Context & History Flow -->
                            <div class="flex flex-col gap-6">
                                <h3 class="text-sm font-bold text-slate-800 border-b border-slate-200 pb-2">Riwayat & Catatan</h3>
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
                                    <x-validation.timeline :history="$child['history']" />
                                    <x-validation.notes :child="$child" />
                                </div>
                            </div>

                        </div>

                        <!-- Sticky Actions -->
                        <div class="mt-auto sticky bottom-0 bg-white border-t border-slate-200 px-6 py-4 z-10 w-full flex justify-end shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]">
                            <x-validation.actions :childId="$child['id']" />
                        </div>
                        
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex-1 flex flex-col items-center justify-center text-slate-400 p-8 bg-slate-50">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 opacity-30 mb-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="font-medium text-center">Tidak ada antrean validasi.</p>
            </div>
        @endif
        
        <!-- Empty Workspace State -->
        <div id="emptyWorkspaceState" class="hidden flex-1 flex flex-col items-center justify-center text-slate-400 p-8 bg-slate-50 absolute inset-0 z-10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 opacity-30 mb-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="font-medium text-center">Tidak ada antrean validasi aktif.</p>
        </div>
    </div><!-- end right panel -->

</div><!-- end split view -->

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const drawer = document.getElementById('workspaceDrawer');
        const overlay = document.getElementById('drawerOverlay');
        const handle = document.getElementById('drawerHandle');
        let isProcessing = false;
        
        function openDrawer() {
            if(window.innerWidth >= 1024) return;
            drawer.classList.remove('translate-y-full');
            overlay.classList.remove('hidden');
            setTimeout(() => overlay.classList.remove('opacity-0'), 10);
            document.body.style.overflow = 'hidden';
        }

        function closeDrawer() {
            if(window.innerWidth >= 1024) return;
            drawer.classList.add('translate-y-full');
            overlay.classList.add('opacity-0');
            setTimeout(() => overlay.classList.add('hidden'), 300);
            document.body.style.overflow = '';
        }

        if(overlay) overlay.addEventListener('click', closeDrawer);
        if(handle) handle.addEventListener('click', closeDrawer);

        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            const bgColor = type === 'success' ? 'bg-teal-600' : 'bg-rose-600';
            const icon = type === 'success' 
                ? `<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />`
                : `<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />`;

            toast.className = `transform transition-all duration-300 translate-x-full opacity-0 ${bgColor} text-white px-4 py-3 rounded-xl shadow-lg flex items-center gap-3 w-max max-w-xs`;
            toast.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 shrink-0">${icon}</svg><span class="text-sm font-bold">${message}</span>`;
            
            container.appendChild(toast);
            requestAnimationFrame(() => toast.classList.remove('translate-x-full', 'opacity-0'));
            setTimeout(() => {
                toast.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        function selectValidation(id) {
            if (isProcessing) return;
            
            document.querySelectorAll('.validation-card-btn').forEach(btn => {
                btn.classList.remove('ring-2', 'ring-teal-600', 'bg-white', 'shadow-md');
                btn.classList.add('border-transparent', 'bg-slate-50', 'hover:bg-white', 'hover:shadow-sm', 'opacity-75');
                btn.classList.remove('opacity-100');
            });
            
            const targetBtn = document.querySelector(`.validation-card-btn[data-validation-id="${id}"]`);
            if (targetBtn) {
                targetBtn.classList.remove('border-transparent', 'bg-slate-50', 'hover:bg-white', 'hover:shadow-sm', 'opacity-75');
                targetBtn.classList.add('ring-2', 'ring-teal-600', 'bg-white', 'shadow-md', 'opacity-100');
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

        const queueContainer = document.getElementById('queueListContainer');
        if(queueContainer) {
            queueContainer.addEventListener('click', (e) => {
                const btn = e.target.closest('.validation-card-btn');
                if(btn) selectValidation(btn.dataset.validationId);
            });
        }

        document.addEventListener('click', (e) => {
            const btnApprove = e.target.closest('.btn-approve');
            const btnReject = e.target.closest('.btn-reject');
            
            if(btnApprove) processValidation(btnApprove.dataset.id, 'approve', btnApprove);
            if(btnReject) processValidation(btnReject.dataset.id, 'reject', btnReject);
        });

        function processValidation(id, action, btnEl) {
            if(isProcessing) return;
            isProcessing = true;
            
            if(action === 'approve') {
                btnEl.querySelector('.icon-approve').classList.add('hidden');
                btnEl.querySelector('.spinner-approve').classList.remove('hidden');
                btnEl.querySelector('.text-approve').innerText = 'Saving...';
                btnEl.classList.add('opacity-80', 'cursor-not-allowed');
            } else {
                btnEl.classList.add('opacity-50', 'cursor-not-allowed');
                btnEl.innerHTML = '<span>Processing...</span>';
            }

            setTimeout(() => {
                if(action === 'approve') {
                    btnEl.querySelector('.icon-approve').classList.remove('hidden');
                    btnEl.querySelector('.spinner-approve').classList.add('hidden');
                    btnEl.querySelector('.text-approve').innerText = 'Approve Data';
                    btnEl.classList.remove('opacity-80', 'cursor-not-allowed');
                } else {
                    btnEl.classList.remove('opacity-50', 'cursor-not-allowed');
                    btnEl.innerHTML = '<span>Tolak</span>';
                }

                if(Math.random() < 0.1) {
                    showToast(`Gagal memproses data. Silakan coba lagi.`, 'error');
                    isProcessing = false;
                    return;
                }

                showToast(`Data berhasil ${action === 'approve' ? 'disetujui' : 'ditolak'}.`, 'success');

                const cardEl = document.getElementById(`card-${id}`);
                if (cardEl) {
                    cardEl.style.height = cardEl.offsetHeight + 'px';
                    cardEl.style.transform = 'translateY(-10px)';
                    cardEl.style.opacity = '0';
                    cardEl.style.marginBottom = '-' + cardEl.offsetHeight + 'px';
                    setTimeout(() => cardEl.remove(), 300);
                }

                const panelEl = document.getElementById(`workspace-panel-${id}`);
                if (panelEl) panelEl.remove();

                setTimeout(() => {
                    const remainingCards = document.querySelectorAll('.validation-card-btn');
                    if (remainingCards.length > 0) {
                        selectValidation(remainingCards[0].dataset.validationId);
                    } else {
                        const wsEmpty = document.getElementById('emptyWorkspaceState');
                        if(wsEmpty) wsEmpty.classList.remove('hidden');
                        const queueEmpty = document.getElementById('emptyState');
                        if(queueEmpty) {
                            queueEmpty.classList.remove('hidden');
                            queueEmpty.classList.add('flex');
                        }
                        closeDrawer();
                    }
                    isProcessing = false;
                }, 350);
            }, 1000);
        }
        
        // Initialize first active card style
        const firstCard = document.querySelector('.validation-card-btn');
        if (firstCard) {
            selectValidation(firstCard.dataset.validationId);
        }
    });
</script>
@endpush
@endsection
