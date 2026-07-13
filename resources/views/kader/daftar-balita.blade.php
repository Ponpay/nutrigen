@extends('layouts.app')

@section('page-title', 'Daftar Balita')

@section('content')

@php
    /*
    ============================================================
    DEMO DATA — REMOVE IN PRODUCTION
    ============================================================
    Backend: Replace this entire @php block by injecting the
    $balitas collection from BalitaController@index.

    Expected controller data:
      $balitas — Collection of balita arrays with keys:
        id, name, age, mother, nik, last_measure,
        status, status_type, context_tag (nullable)

    The frontend separates $balitas into two display groups:
      $priorityBalitas — status_type in ['danger', 'warning']
      $queueBalitas    — status_type = 'success'

    Both groups should ideally be pre-sorted and filtered
    by the controller/query scope, not in the view.
    ============================================================
    */
    $balitasData = [
        ['id' => 1, 'name' => 'Bima Saputra',    'age' => '8 Bulan',           'mother' => 'Rina Mulyani',  'nik' => '320104...', 'last_measure' => '10 Mei 2024',    'status' => 'Stunting',      'status_type' => 'danger'],
        ['id' => 2, 'name' => 'Gita Gutawa',      'age' => '4 Tahun 2 Bulan',  'mother' => 'Erwin Gutawa',  'nik' => '320107...', 'last_measure' => '5 Mei 2024',     'status' => 'Gizi Kurang',   'status_type' => 'warning'],
        ['id' => 3, 'name' => 'Aisyah Putri',     'age' => '2 Tahun 2 Bulan',  'mother' => 'Siti Aminah',   'nik' => '320101...', 'last_measure' => '10 April 2024',  'status' => 'Belum Diukur', 'status_type' => 'success', 'context_tag' => '[!] Absen bulan lalu'],
        ['id' => 4, 'name' => 'Citra Lestari',    'age' => '3 Tahun 1 Bulan',  'mother' => 'Yuni Arumsari', 'nik' => '320105...', 'last_measure' => 'Belum Diukur', 'status' => 'Belum Diukur', 'status_type' => 'success', 'context_tag' => '[+] Baru terdaftar'],
        ['id' => 5, 'name' => 'Rizky Maulana',    'age' => '1 Tahun 11 Bulan', 'mother' => 'Dewi Sartika',  'nik' => '320102...', 'last_measure' => '10 Mei 2024',    'status' => 'Belum Diukur', 'status_type' => 'success'],
        ['id' => 6, 'name' => 'Fathan Ramadhan',  'age' => '1 Tahun 5 Bulan',  'mother' => 'Nia Ramadhani', 'nik' => '320106...', 'last_measure' => '12 Mei 2024',    'status' => 'Belum Diukur', 'status_type' => 'success'],
    ];

    $balitas = $balitas ?? collect($balitasData);

    // View-layer separation — ideally this filtering lives in the controller/scope
    $priorityBalitas = $balitas->filter(fn($b) => in_array($b['status_type'], ['danger', 'warning']));
    $queueBalitas    = $balitas->filter(fn($b) => !in_array($b['status_type'], ['danger', 'warning']));
@endphp

<!-- Main Container -->
<div class="flex flex-col bg-slate-50 min-h-screen pb-32 lg:pb-12 relative">
    
    <!-- CONTEXT & STATUS HEADER -->
    <div class="bg-white px-5 pt-6 pb-4 shadow-sm border-b border-slate-200">
        <div class="max-w-4xl mx-auto w-full">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h1 class="text-xl font-extrabold text-slate-900 tracking-tight">Sesi: Posyandu Melati 1</h1>
                    <p class="text-xs font-medium text-slate-500 mt-1 flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                        15 Agustus 2026
                    </p>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="flex flex-col gap-2">
                <div class="w-full bg-slate-200 rounded-full h-2">
                    <div class="bg-sky-500 h-2 rounded-full" style="width: 25%"></div>
                </div>
                <div class="flex justify-between items-center text-xs font-bold text-slate-600">
                    <span><span class="text-sky-600">32</span> Selesai</span>
                    <span>96 Belum Diukur</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ACTION ZONE (Sticky on scroll) -->
    <div class="sticky top-0 z-40 bg-slate-50/95 backdrop-blur-sm px-5 py-4 border-b border-slate-200 shadow-sm">
        <div class="max-w-4xl mx-auto w-full flex items-center gap-3">
            <!-- Search Bar -->
            <div class="relative flex-1 group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-slate-400 group-focus-within:text-sky-500 transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </div>
                <input type="text" placeholder="Cari nama balita atau NIK..." class="w-full pl-11 pr-4 py-3.5 bg-white border border-slate-200 rounded-2xl text-sm font-medium text-slate-900 placeholder:text-slate-400 transition-all shadow-sm focus:outline-none focus:ring-4 focus:ring-sky-500/20 focus:border-sky-400">
            </div>
            
            <!-- + Baru Button (FAB Alternative) -->
            <a href="{{ route('balita.create') }}" class="flex-shrink-0 flex items-center justify-center gap-2 bg-sky-500 hover:bg-sky-600 text-white px-5 py-3.5 rounded-full font-bold shadow-lg shadow-sky-500/20 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span class="hidden sm:block">Baru</span>
            </a>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="max-w-4xl mx-auto w-full px-5 mt-6">
        
        <!-- PRIORITAS HARI INI -->
        <div class="mb-8">
            <h2 class="text-sm font-extrabold text-slate-900 flex items-center gap-2 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-amber-500">
                  <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                </svg>
                Prioritas Hari Ini
                <span class="bg-amber-100 text-amber-700 px-2 py-0.5 rounded-full text-[10px]">{{ count($priorityBalitas) }} Anak</span>
            </h2>
            
            <div class="flex overflow-x-auto gap-4 pb-4 snap-x hide-scrollbar -mx-5 px-5 lg:mx-0 lg:px-0">
                @foreach($priorityBalitas as $balita)
                    <div class="w-72 shrink-0 snap-start">
                        <x-child-card :balita="$balita" />
                    </div>
                @endforeach
            </div>
        </div>

        <!-- ANTRIAN PENGUKURAN (Smart Queue) -->
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-sm font-extrabold text-slate-900">Antrian Pengukuran</h2>
            </div>
            
            <!-- Quick Filters (Chips) -->
            <div class="flex items-center gap-2 overflow-x-auto pb-4 hide-scrollbar -mx-5 px-5 lg:mx-0 lg:px-0">
                <button class="shrink-0 flex items-center px-4 h-9 rounded-full bg-slate-800 text-white font-bold text-xs shadow-sm focus:outline-none focus:ring-4 focus:ring-slate-500/20 transition-all">
                    Belum Diukur
                </button>
                <button class="shrink-0 flex items-center px-4 h-9 rounded-full bg-white border border-slate-200 text-slate-600 font-bold text-xs hover:bg-slate-50 transition-all shadow-sm focus:outline-none focus:ring-4 focus:ring-slate-500/10">
                    Absen Bulan Lalu
                </button>
                <button class="shrink-0 flex items-center px-4 h-9 rounded-full bg-white border border-slate-200 text-slate-600 font-bold text-xs hover:bg-slate-50 transition-all shadow-sm focus:outline-none focus:ring-4 focus:ring-slate-500/10">
                    Bayi < 6 Bln
                </button>
                <button class="shrink-0 flex items-center px-4 h-9 rounded-full bg-white border border-slate-200 text-slate-600 font-bold text-xs hover:bg-slate-50 transition-all shadow-sm focus:outline-none focus:ring-4 focus:ring-slate-500/10">
                    Sudah Selesai
                </button>
            </div>

            <!-- Queue List -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @forelse($queueBalitas as $balita)
                    <x-child-card :balita="$balita" />
                @empty
                    <!-- Empty State -->
                    <div class="col-span-full flex flex-col items-center justify-center text-slate-400 py-16 px-6 gap-3 bg-white border border-slate-200 rounded-2xl shadow-sm mt-2 text-center">
                        <div class="w-14 h-14 rounded-full bg-slate-50 flex items-center justify-center mb-1 shadow-sm border border-slate-100">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-emerald-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-base font-extrabold text-slate-900 tracking-tight">Semua Balita Sudah Diukur!</span>
                        <span class="text-sm font-medium text-slate-500 max-w-sm mb-3">Luar biasa, tidak ada lagi antrian hari ini.</span>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<style>
/* Custom Hide Scrollbar Class */
.hide-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}
</style>

@endsection
