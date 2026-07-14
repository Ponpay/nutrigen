@extends('layouts.puskesmas')
@section('page-title', 'Dashboard')
@section('content')

{{-- Backend Contract:
    Controller: PuskesmasDashboardController@index
    Expected Variables: $stats, $distribution
--}}
@php
    $stats = [
        'user_name' => 'Dr. Siti (Ahli Gizi)',
        'pending_total' => 46,
        'pending_anomali' => 12,
        'pending_berisiko' => 5,
        'total_balita' => 1248,
        'diukur' => 842,
        'valid' => 706,
        'pending' => 136,
        'current_month' => 'April 2025'
    ];

    $distribution = [
        'normal' => ['count' => 471, 'percentage' => 56],
        'perlu_perhatian' => ['count' => 253, 'percentage' => 30],
        'berisiko' => ['count' => 118, 'percentage' => 14],
        'total_diukur' => 842
    ];
@endphp

<!-- Main Layout Canvas is bg-slate-50 -->
<div class="flex flex-col gap-8 w-full max-w-7xl mx-auto pb-10">
    
    <!-- Page Header -->
    <x-page-header 
        breadcrumbs="Portal Puskesmas • Command Center"
        title="Selamat Pagi, {{ $stats['user_name'] }} ??" 
        subtitle="Anda memiliki beberapa tugas yang membutuhkan perhatian." 
    />

    <!-- Flow: Urgent Task Summary -->
    <section>
        <!-- Task Inbox Summary Card -->
        <div class="bg-gradient-to-br from-rose-50 to-orange-50 border border-rose-200 rounded-2xl p-6 lg:p-8 shadow-sm flex flex-col lg:flex-row lg:items-center justify-between gap-8 relative overflow-hidden">
            <!-- Decoration -->
            <div class="absolute -right-6 -top-6 text-rose-500/10 rotate-12">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-48 h-48">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>

            <div class="flex flex-col relative z-10">
                <div class="flex items-center gap-3 mb-2">
                    <div class="bg-rose-100 text-rose-600 p-2.5 rounded-xl flex-shrink-0 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h2 class="text-xl lg:text-2xl font-bold text-rose-900">{{ $stats['pending_total'] }} Pengukuran Menunggu Validasi</h2>
                </div>
                
                <ul class="flex flex-col gap-2.5 mt-3 ml-2 lg:ml-16 border-l-2 border-rose-200 pl-4 text-sm font-medium text-rose-800">
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                        <span>{{ $stats['pending_anomali'] }} Anomali Data (Ekstrem)</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                        <span>{{ $stats['pending_berisiko'] }} Balita Berisiko (Gizi Buruk/Stunting)</span>
                    </li>
                </ul>
            </div>
            
            <div class="relative z-10 w-full lg:w-auto mt-2 lg:mt-0">
                <a href="{{ route('puskesmas.validasi') }}" class="flex items-center justify-center gap-2 bg-rose-600 hover:bg-rose-700 text-white font-bold px-8 py-4 rounded-xl shadow-md transition-all duration-200 lg:hover:-translate-y-0.5 w-full whitespace-nowrap">
                    Mulai Validasi Sekarang
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Flow: Overview Statistik -->
    <section class="flex flex-col gap-6 mt-2">
        <h3 class="text-base font-bold text-slate-800 border-b border-slate-200 pb-3">Overview Operasional Bulan {{ $stats['current_month'] }}</h3>
        <!-- Quick Stats -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
            <x-stat-card color="slate" title="Total Balita" value="{{ number_format($stats['total_balita'], 0, ',', '.') }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                    <path d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" />
                </svg>
            </x-stat-card>

            <x-stat-card color="blue" title="Diukur Bln Ini" value="{{ number_format($stats['diukur'], 0, ',', '.') }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                </svg>
            </x-stat-card>

            <x-stat-card color="emerald" title="Tervalidasi" value="{{ number_format($stats['valid'], 0, ',', '.') }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                    <path fill-rule="evenodd" d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                </svg>
            </x-stat-card>

            <x-stat-card color="rose" title="Pending" value="{{ number_format($stats['pending'], 0, ',', '.') }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd" />
                </svg>
            </x-stat-card>
        </div>
    </section>

    <!-- Flow: Visualisasi & Insights -->
    <section class="mt-4">
        <div class="bg-white border border-slate-200 rounded-2xl p-6 lg:p-10 shadow-sm flex flex-col">
            <div class="flex items-center justify-between mb-8 pb-4 border-b border-slate-200">
                <div>
                    <h2 class="font-bold text-slate-800 text-lg">Distribusi Status Gizi</h2>
                    <p class="text-sm font-medium text-slate-500 mt-0.5">Berdasarkan data pengukuran tervalidasi bulan {{ $stats['current_month'] }}</p>
                </div>
                <a href="{{ route('puskesmas.laporan') }}" class="hidden sm:inline-flex text-sm font-bold text-teal-700 hover:text-teal-800 bg-teal-50 hover:bg-teal-100 px-5 py-2.5 rounded-xl transition-colors items-center gap-2">
                    Lihat Analitik Lengkap
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>

            <div class="flex flex-col lg:flex-row items-center justify-center gap-12 lg:gap-32 px-4 lg:px-12 py-4">
                <!-- Donut Chart -->
                <div class="relative w-48 h-48 flex-shrink-0 flex items-center justify-center">
                    <svg viewBox="0 0 36 36" class="w-full h-full transform -rotate-90 drop-shadow-sm">
                        <!-- Normal (56%) -->
                        <path class="text-emerald-500" stroke-dasharray="{{ $distribution['normal']['percentage'] }}, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="4"></path>
                        <!-- Perlu Perhatian (30%) - offset 56 -->
                        <path class="text-amber-500" stroke-dasharray="{{ $distribution['perlu_perhatian']['percentage'] }}, 100" stroke-dashoffset="-{{ $distribution['normal']['percentage'] }}" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="4"></path>
                        <!-- Berisiko (14%) - offset 86 -->
                        <path class="text-rose-500" stroke-dasharray="{{ $distribution['berisiko']['percentage'] }}, 100" stroke-dashoffset="-{{ $distribution['normal']['percentage'] + $distribution['perlu_perhatian']['percentage'] }}" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="4"></path>
                    </svg>
                    <!-- Center Text -->
                    <div class="absolute flex flex-col items-center justify-center">
                        <span class="text-3xl font-extrabold text-slate-800">{{ $distribution['total_diukur'] }}</span>
                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-1">Total Diukur</span>
                    </div>
                </div>

                <!-- Legends Layered as Sub-Cards -->
                <div class="flex flex-col gap-4 w-full lg:w-96">
                    <!-- Normal -->
                    <div class="flex items-center justify-between group bg-slate-50 border border-slate-100 p-3.5 rounded-xl hover:bg-slate-100 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-3.5 h-3.5 rounded-full bg-emerald-500 shadow-sm group-hover:scale-125 transition-transform"></div>
                            <span class="font-bold text-slate-700">Normal</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="font-bold text-slate-800">{{ $distribution['normal']['count'] }}</span>
                            <span class="text-xs font-bold text-emerald-700 bg-emerald-100/50 px-2.5 py-1 rounded-lg w-14 text-center">{{ $distribution['normal']['percentage'] }}%</span>
                        </div>
                    </div>
                    
                    <!-- Perlu Perhatian -->
                    <div class="flex items-center justify-between group bg-slate-50 border border-slate-100 p-3.5 rounded-xl hover:bg-slate-100 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-3.5 h-3.5 rounded-full bg-amber-500 shadow-sm group-hover:scale-125 transition-transform"></div>
                            <span class="font-bold text-slate-700">Perlu Perhatian</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="font-bold text-slate-800">{{ $distribution['perlu_perhatian']['count'] }}</span>
                            <span class="text-xs font-bold text-amber-700 bg-amber-100/50 px-2.5 py-1 rounded-lg w-14 text-center">{{ $distribution['perlu_perhatian']['percentage'] }}%</span>
                        </div>
                    </div>

                    <!-- Berisiko -->
                    <div class="flex items-center justify-between group bg-slate-50 border border-slate-100 p-3.5 rounded-xl hover:bg-slate-100 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-3.5 h-3.5 rounded-full bg-rose-500 shadow-sm group-hover:scale-125 transition-transform"></div>
                            <span class="font-bold text-slate-700">Berisiko</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="font-bold text-slate-800">{{ $distribution['berisiko']['count'] }}</span>
                            <span class="text-xs font-bold text-rose-700 bg-rose-100/50 px-2.5 py-1 rounded-lg w-14 text-center">{{ $distribution['berisiko']['percentage'] }}%</span>
                        </div>
                    </div>
                </div>
                
                <a href="{{ route('puskesmas.laporan') }}" class="sm:hidden mt-2 text-sm font-bold text-teal-600 hover:text-teal-700 bg-teal-50 px-4 py-3 rounded-xl transition-colors text-center w-full">
                    Lihat Analitik Lengkap
                </a>
            </div>
        </div>
    </section>

</div>
@endsection
