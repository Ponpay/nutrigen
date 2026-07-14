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

    // DUMMY DATA FOR DEMO PURPOSES
    $dummyPosyandus = [
        [
            'id' => 1,
            'nama' => 'Posyandu Melati 1',
            'desa' => 'Lampeuneurut',
            'alamat' => 'Jl. Mawar No. 2, Balai Desa',
            'balita_count' => 120,
            'kader_count' => 5,
            'has_jadwal_this_month' => true,
            'stats' => [
                'total_balita' => 120,
                'diukur_bulan_ini' => 95,
            ],
            'kaders' => [
                ['id' => 1, 'nama' => 'Ibu Ratna', 'nik' => '1171012345678901', 'no_hp' => '628123456789', 'aktivitas_bulan_ini' => 45, 'terakhir_aktif' => '2026-07-13'],
                ['id' => 2, 'nama' => 'Ibu Siti', 'nik' => '1171012345678902', 'no_hp' => '628987654321', 'aktivitas_bulan_ini' => 50, 'terakhir_aktif' => '2026-07-14'],
                ['id' => 3, 'nama' => 'Ibu Fitri', 'nik' => '1171012345678903', 'no_hp' => '', 'aktivitas_bulan_ini' => 0, 'terakhir_aktif' => '2026-06-25'],
            ],
            'jadwals' => [
                ['id' => 1, 'judul' => 'Penimbangan Balita Juli', 'tanggal' => '2026-07-20', 'waktu_mulai' => '08:00', 'lokasi' => 'Balai Desa Melati'],
                ['id' => 2, 'judul' => 'Kelas Ibu Hamil', 'tanggal' => '2026-07-25', 'waktu_mulai' => '09:00', 'lokasi' => 'Puskesmas Pembantu'],
            ]
        ],
        [
            'id' => 2,
            'nama' => 'Posyandu Mawar 2',
            'desa' => 'Lamreung',
            'alamat' => 'Meunasah Desa Lamreung',
            'balita_count' => 85,
            'kader_count' => 3,
            'has_jadwal_this_month' => false,
            'stats' => [
                'total_balita' => 85,
                'diukur_bulan_ini' => 0,
            ],
            'kaders' => [
                ['id' => 4, 'nama' => 'Ibu Aisyah', 'nik' => '1171022345678901', 'no_hp' => '628111222333', 'aktivitas_bulan_ini' => 0, 'terakhir_aktif' => '2026-06-20'],
                ['id' => 5, 'nama' => 'Ibu Budi', 'nik' => '1171022345678902', 'no_hp' => '628444555666', 'aktivitas_bulan_ini' => 0, 'terakhir_aktif' => '2026-06-21'],
            ],
            'jadwals' => []
        ],
        [
            'id' => 3,
            'nama' => 'Posyandu Kenanga 3',
            'desa' => 'Lambaro',
            'alamat' => 'Jl. Pendidikan No. 4',
            'balita_count' => 150,
            'kader_count' => 6,
            'has_jadwal_this_month' => true,
            'stats' => [
                'total_balita' => 150,
                'diukur_bulan_ini' => 140,
            ],
            'kaders' => [
                ['id' => 6, 'nama' => 'Ibu Citra', 'nik' => '1171032345678901', 'no_hp' => '628777888999', 'aktivitas_bulan_ini' => 140, 'terakhir_aktif' => '2026-07-10'],
            ],
            'jadwals' => [
                ['id' => 3, 'judul' => 'Penimbangan Balita Juli', 'tanggal' => '2026-07-10', 'waktu_mulai' => '08:30', 'lokasi' => 'Balai Desa Lambaro'],
            ]
        ]
    ];

    $posyandus = $dummyPosyandus;
    
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

<!-- Full-viewport Split View: Regional Monitoring Workspace -->
<div class="flex flex-col lg:flex-row flex-1 overflow-hidden">

    <!-- LEFT PANEL: Direktori Posyandu — bg-slate-50/60 -->
    <div class="w-full lg:w-[340px] xl:w-[360px] flex flex-col border-r border-slate-200 bg-slate-50/60 shrink-0 overflow-hidden relative z-10">

        <!-- Panel Header (sticky) -->
        <div class="flex flex-col bg-slate-50 border-b border-slate-200 sticky top-0 z-20 shrink-0">
            <div class="px-5 pt-5 pb-4">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-0.5">Regional Monitoring</p>
                <h2 class="text-base font-bold text-slate-800">Direktori Posyandu</h2>
                
                <!-- Search Bar -->
                <form action="{{ route('puskesmas.posyandu') }}" method="GET" class="mt-4">
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                        <input type="text" name="q" value="{{ $filters['q'] }}" placeholder="Cari nama posyandu atau desa..." class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 font-medium shadow-sm">
                    </div>
                </form>
            </div>
        </div>

        <!-- List Posyandu (Scrollable) -->
        <div class="flex-1 overflow-y-auto flex flex-col hide-scrollbar">
            @forelse($posyandus as $posyandu)
                <x-posyandu.list-card :posyandu="$posyandu" :isActive="$selectedPosyandu && $selectedPosyandu['id'] === $posyandu['id']" />
            @empty
                <div class="flex flex-col items-center justify-center h-48 text-slate-400 gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 opacity-50">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                    </svg>
                    <span class="text-sm font-medium">Posyandu tidak ditemukan.</span>
                </div>
            @endforelse
        </div>
    </div><!-- end left panel -->

    <!-- RIGHT PANEL: Regional Monitoring Workspace -->
    <div class="flex-1 flex flex-col overflow-y-auto bg-slate-50/30 {{ $selectedPosyandu ? '' : 'hidden lg:flex' }}">
        
        @if($selectedPosyandu)
            <!-- Mobile Back Button (To Queue) -->
            <div class="lg:hidden bg-white px-4 py-3 border-b border-slate-200 sticky top-0 z-30 flex items-center justify-between shrink-0">
                <a href="{{ route('puskesmas.posyandu') }}" class="flex items-center gap-2 text-sm font-bold text-slate-600 hover:text-slate-900 bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                    Kembali ke Daftar
                </a>
            </div>

            <!-- Workspace Content Flow -->
            <div class="flex-1 overflow-y-auto hide-scrollbar">
                <!-- Header Component -->
                <x-posyandu.workspace-header :posyandu="$selectedPosyandu" />

                <!-- Main Content Flow Container -->
                <div class="p-5 lg:p-8 flex flex-col gap-8 shrink-0 pb-24 max-w-5xl mx-auto w-full">
                    
                    <!-- Flow: Statistik Operasional -->
                    <div class="flex flex-col gap-6">
                        <h3 class="text-sm font-bold text-slate-800 border-b border-slate-200 pb-2">Statistik Operasional (Bulan Ini)</h3>
                        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
                            <x-posyandu.kpi-summary :posyandu="$selectedPosyandu" />
                        </div>
                    </div>

                    <!-- Flow: Operasional & Ketenagaan -->
                    <div class="flex flex-col gap-6">
                        <h3 class="text-sm font-bold text-slate-800 border-b border-slate-200 pb-2">Manajemen Operasional</h3>
                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 items-start">
                            <!-- Kaders Section -->
                            <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm h-full flex flex-col">
                                <x-posyandu.kader-list :kaders="$selectedPosyandu['kaders'] ?? []" />
                            </div>

                            <!-- Jadwals Section -->
                            <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm h-full flex flex-col">
                                <x-posyandu.jadwal-list :jadwals="$selectedPosyandu['jadwals'] ?? []" />
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
        @else
            <!-- Empty State / No Selection -->
            <div class="flex-1 flex flex-col items-center justify-center bg-slate-50/50">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-sm mb-4 border border-slate-100 text-slate-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-700">Pilih Posyandu</h3>
                <p class="text-sm text-slate-500 mt-1 max-w-xs text-center">Pilih posyandu dari daftar di sebelah kiri untuk melihat detail monitoring operasional.</p>
            </div>
        @endif
        
    </div><!-- end right panel -->

</div><!-- end split view -->
@endsection
