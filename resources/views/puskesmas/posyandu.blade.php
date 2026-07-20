@extends('layouts.puskesmas')
@section('page-title', 'Posyandu & Kader')
@section('page-mode', 'app')
@section('content')

{{-- Backend Contract:
    Controller: PuskesmasPosyanduController@index
    Expected Variables: $posyandus, $filters, $selectedPosyandu
--}}
@php
    $filters = [
        'q' => request('q', '')
    ];
    
    // Server-side selection logic
    $requestedId = request('id');
    $selectedPosyandu = null;
    
    if ($requestedId) {
        $selectedPosyandu = collect($posyandus)->firstWhere('id', (int)$requestedId);
    }
    
    // Default to first posyandu if none selected or invalid ID
    if (!$selectedPosyandu && count($posyandus) > 0) {
        $selectedPosyandu = $posyandus[0];
    }
@endphp

<!-- Toast Notification Container -->
<div id="toastContainer" class="fixed top-10 right-5 z-50 flex flex-col gap-2"></div>

<!-- Full-viewport Main Container -->
<div class="flex-1 overflow-y-auto bg-slate-50/80 hide-scrollbar relative">
    
    <!-- Main Content Wrapper -->
    <div class="p-5 lg:p-8 max-w-[1300px] mx-auto w-full pt-4 lg:pt-5">
        
        <!-- CSS Grid Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- LEFT PANEL: Direktori Posyandu -->
            <div class="lg:col-span-4 {{ $selectedPosyandu ? 'hidden lg:flex' : 'flex' }} flex-col sticky top-0 lg:top-4 h-[calc(100vh-2rem)] lg:h-[calc(100vh-4rem)]">
                
                <!-- Panel Header -->
                <div class="shrink-0 pb-4">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-0.5">Regional Monitoring</p>
                    <h2 class="text-[17px] font-black text-slate-800 tracking-tight">Direktori Posyandu</h2>
                    
                    <!-- Search Bar -->
                    <form action="{{ route('puskesmas.posyandu') }}" method="GET" class="mt-4">
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                            <input type="text" name="q" value="{{ $filters['q'] ?? '' }}" placeholder="Cari posyandu..." class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-[1rem] text-[13px] focus:outline-none focus:ring-2 focus:ring-emerald-500 font-semibold transition-all shadow-sm">
                        </div>
                    </form>
                </div>

                <!-- List Posyandu (Scrollable) -->
                <div class="flex-1 overflow-y-auto flex flex-col gap-3.5 hide-scrollbar pb-10 px-1 -mx-1">
                    @forelse($posyandus as $posyandu)
                        <x-posyandu.list-card :posyandu="$posyandu" :isActive="$selectedPosyandu && $selectedPosyandu['id'] === $posyandu['id']" />
                    @empty
                        <div class="flex flex-col items-center justify-center h-32 text-slate-400 gap-3">
                            <span class="text-sm font-medium">Posyandu tidak ditemukan.</span>
                        </div>
                    @endforelse
                    
                    <!-- Tambah Button -->
                    <div class="mt-2 shrink-0">
                        <button class="w-full py-3.5 rounded-[1rem] bg-emerald-50/80 text-emerald-600 font-bold text-sm hover:bg-emerald-100 transition-colors flex items-center justify-center gap-2 border border-emerald-100/50 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Tambah Posyandu Baru
                        </button>
                    </div>
                </div>

            </div>

            <!-- RIGHT PANEL: Regional Monitoring Workspace -->
            <div class="lg:col-span-8 flex flex-col gap-6 lg:gap-8 {{ $selectedPosyandu ? 'flex' : 'hidden lg:flex' }}">
                
                @if($selectedPosyandu)
                    <!-- Mobile Back Button (To Queue) -->
                    <div class="lg:hidden sticky top-4 z-30 flex items-center justify-between shrink-0 mb-[-0.5rem] px-1">
                        <a href="{{ route('puskesmas.posyandu') }}" class="flex items-center gap-2 text-sm font-bold text-slate-700 hover:text-slate-900 bg-white/95 backdrop-blur-sm px-3.5 py-2 rounded-xl border border-slate-200 shadow-sm transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                            </svg>
                            Kembali ke Direktori
                        </a>
                    </div>

                    <!-- Header Component (Floating Island) -->
                    <x-posyandu.workspace-header :posyandu="$selectedPosyandu" />
                    
                    <!-- Flow: Statistik Operasional -->
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center gap-2">
                            <h3 class="text-[15px] font-extrabold text-slate-800">Statistik Operasional (Bulan Ini)</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-slate-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                            </svg>
                        </div>
                        <x-posyandu.kpi-summary :posyandu="$selectedPosyandu" />
                    </div>

                    <!-- Flow: Manajemen Operasional -->
                    <div class="flex flex-col gap-4 mt-2">
                        <div class="flex items-center justify-between">
                            <h3 class="text-[15px] font-extrabold text-slate-800">Manajemen Operasional</h3>
                        </div>
                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 items-start">
                            <!-- Kaders Section -->
                            <x-posyandu.kader-list :kaders="$selectedPosyandu['kaders'] ?? []" />

                            <!-- Jadwals Section -->
                            <x-posyandu.jadwal-list :jadwals="$selectedPosyandu['jadwals'] ?? []" />
                        </div>
                    </div>

                    <!-- Footer Last Updated -->
                    <div class="pt-4 pb-24 lg:pb-12 flex items-center gap-2 text-[11px] font-semibold text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Data terakhir diperbarui: {{ now()->format('d M Y H:i') }} WIB
                    </div>
                    
                @else
                    <!-- Empty State / No Selection -->
                    <div class="flex-1 flex flex-col items-center justify-center bg-white rounded-[2rem] border border-slate-100 min-h-[400px]">
                        <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mb-4 text-slate-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                            </svg>
                        </div>
                        <h3 class="text-slate-800 font-bold mb-1">Pilih Posyandu</h3>
                        <p class="text-slate-500 text-sm">Pilih posyandu di panel kiri untuk melihat detailnya.</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection
