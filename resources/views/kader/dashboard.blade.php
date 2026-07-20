@extends('layouts.app')
@section('page-title', 'Beranda')
@section('content')
<div class="w-full max-w-6xl mx-auto lg:p-6 lg:pb-12">
    <!-- Main Workspace Container -->
    <div class="flex flex-col gap-8 lg:gap-12 p-5 lg:p-10 w-full bg-white rounded-none lg:rounded-[32px] lg:shadow-[0_4px_24px_-8px_rgba(0,0,0,0.02)] lg:border border-slate-100/50 min-h-[calc(100vh-8rem)]">
    
    <!-- Welcome Section -->
    <div class="flex flex-col mt-2">
        <h1 class="text-2xl lg:text-3xl font-extrabold text-slate-800">
            Selamat pagi, {{ $kaderName ?? 'Ibu Kader' }} 👋
        </h1>
        <p class="text-[14px] text-slate-500 font-medium mt-1">
            {{ $posyanduName ?? 'Posyandu Melati 1' }}
        </p>
    </div>

    <!-- Alert Perlu Revisi -->
    @if(isset($statRevisi) && $statRevisi > 0)
    <div class="mb-1 bg-rose-50 border border-rose-200 rounded-[24px] p-4 lg:p-5 flex items-center justify-between gap-4 shadow-[0_2px_12px_-4px_rgba(225,29,72,0.1)] relative overflow-hidden group">
        <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-rose-500"></div>
        <div class="flex items-center gap-4 relative z-10">
            <div class="w-12 h-12 bg-white rounded-[16px] flex items-center justify-center text-rose-500 shadow-sm shrink-0 border border-rose-100 group-hover:scale-105 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <div class="flex flex-col">
                <h3 class="text-[15px] font-black text-rose-800 tracking-tight leading-tight">Perhatian: Ada {{ $statRevisi }} Data Ditolak</h3>
                <p class="text-[12px] font-medium text-rose-600/90 mt-0.5 max-w-sm">Puskesmas meminta perbaikan pada data pengukuran. Silakan periksa kembali catatan validator.</p>
            </div>
        </div>
        <a href="{{ route('balita.index', ['filter' => 'ditolak']) }}" class="hidden sm:flex shrink-0 px-5 py-3 bg-rose-600 hover:bg-rose-700 text-white rounded-xl text-[13px] font-bold shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all focus:outline-none items-center gap-2">
            Revisi Sekarang
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
        </a>
    </div>
    <!-- Mobile Button -->
    <a href="{{ route('balita.index', ['filter' => 'ditolak']) }}" class="flex sm:hidden w-full px-5 py-3.5 bg-rose-600 text-white rounded-[16px] text-[13px] font-bold shadow-sm items-center justify-center gap-2 mb-2">
        Revisi {{ $statRevisi }} Data
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
    </a>
    @endif

    <!-- Quick Actions -->
    <div class="flex flex-col sm:flex-row gap-3 lg:gap-4 w-full mt-2">
        <!-- Primary Action -->
        <a href="{{ route('balita.create') }}" class="flex items-center justify-center sm:justify-start gap-3.5 bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-3 lg:px-6 lg:py-4 rounded-[20px] shadow-sm hover:shadow-[0_8px_20px_-6px_rgba(16,185,129,0.3)] transition-all duration-300 lg:hover:-translate-y-0.5 flex-1 group border border-emerald-500/20">
            <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </div>
            <div class="flex flex-col">
                <span class="text-[14px] font-bold">Tambah Balita</span>
                <span class="text-[11px] font-medium text-emerald-100/90">Data Baru</span>
            </div>
        </a>
        
        <!-- Secondary Action -->
        <a href="{{ route('balita.index') }}" class="flex items-center justify-center sm:justify-start gap-3.5 bg-white hover:bg-emerald-50/50 text-slate-700 hover:text-emerald-700 px-5 py-3 lg:px-6 lg:py-4 rounded-[20px] shadow-[0_2px_10px_-4px_rgba(0,0,0,0.02)] hover:shadow-sm transition-all duration-300 lg:hover:-translate-y-0.5 flex-1 group border border-slate-200/80 border-l-[4px] border-l-emerald-500 hover:border-emerald-200/50">
            <div class="w-10 h-10 rounded-xl bg-slate-50 text-slate-400 flex items-center justify-center group-hover:scale-110 transition-transform flex-shrink-0 group-hover:text-emerald-600 group-hover:bg-white group-hover:shadow-sm border border-slate-100/50 group-hover:border-emerald-100/50">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0l2.469 10.106c.122.499.106 1.028.589 1.202a5.989 5.989 0 002.031.352 5.989 5.989 0 002.031-.352c.483-.174.711-.703.59-1.202L5.25 4.971z" />
                </svg>
            </div>
            <div class="flex flex-col">
                <span class="text-[14px] font-bold group-hover:text-emerald-700 transition-colors">Ukur Balita</span>
                <span class="text-[11px] font-medium text-slate-400 group-hover:text-emerald-600/70 transition-colors">Catat Pertumbuhan</span>
            </div>
        </a>
    </div>

    <!-- Daily Statistics Section -->
    <div class="flex flex-col gap-4 mt-2">
        <!-- Header -->
        <div class="flex justify-between items-end px-1">
            <span class="text-[14px] font-bold text-slate-800">Statistik Hari Ini</span>
            <span class="text-[13px] font-semibold text-slate-500">{{ $currentDate ?? \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}</span>
        </div>
        
        <!-- Surface Panel -->
        <div class="bg-[#F8FAFC] border border-slate-100/80 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.02)] rounded-[32px] p-2.5 lg:p-3">
            <!-- Grid Stats -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-2.5 lg:gap-3">
                <!-- Total -->
                <a href="{{ route('balita.index') }}" class="block bg-emerald-50 hover:bg-emerald-100 rounded-[24px] p-4 lg:p-5 flex flex-col gap-3 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 relative group border border-emerald-200/60 hover:border-emerald-300">
                    <div class="w-10 h-10 rounded-[14px] bg-emerald-100 text-emerald-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                          <path d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" />
                        </svg>
                    </div>
                    <div class="flex flex-col mt-1">
                        <span class="text-3xl lg:text-4xl font-extrabold text-emerald-900">{{ $statTotal ?? 32 }}</span>
                        <span class="text-[12px] lg:text-[13px] font-bold text-emerald-700/80 mt-0.5">Total Balita</span>
                    </div>
                </a>
                
                <!-- Sudah Diukur -->
                <a href="{{ route('balita.index') }}" class="block bg-blue-50 hover:bg-blue-100 rounded-[24px] p-4 lg:p-5 flex flex-col gap-3 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 relative group border border-blue-200/60 hover:border-blue-300">
                    <div class="w-10 h-10 rounded-[14px] bg-blue-100 text-blue-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                          <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="flex flex-col mt-1">
                        <span class="text-3xl lg:text-4xl font-extrabold text-blue-900">{{ $statSudah ?? 8 }}</span>
                        <span class="text-[12px] lg:text-[13px] font-bold text-blue-700/80 mt-0.5">Sudah Diukur</span>
                    </div>
                </a>
                
                <!-- Belum Diukur -->
                <a href="{{ route('balita.index') }}" class="block bg-amber-50 hover:bg-amber-100 rounded-[24px] p-4 lg:p-5 flex flex-col gap-3 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 relative group border border-amber-200/60 hover:border-amber-300">
                    <div class="w-10 h-10 rounded-[14px] bg-amber-100 text-amber-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                          <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="flex flex-col mt-1">
                        <span class="text-3xl lg:text-4xl font-extrabold text-amber-900">{{ $statBelum ?? 5 }}</span>
                        <span class="text-[12px] lg:text-[13px] font-bold text-amber-700/80 mt-0.5">Belum Diukur</span>
                    </div>
                </a>
                
                <!-- Perlu Perhatian -->
                <a href="{{ route('balita.index') }}" class="block bg-rose-50 hover:bg-rose-100 rounded-[24px] p-4 lg:p-5 flex flex-col gap-3 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 relative group border border-rose-200/60 hover:border-rose-300">
                    <div class="w-10 h-10 rounded-[14px] bg-rose-100 text-rose-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                          <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="flex flex-col mt-1">
                        <span class="text-3xl lg:text-4xl font-extrabold text-rose-900">{{ $statPerlu ?? 3 }}</span>
                        <span class="text-[12px] lg:text-[13px] font-bold text-rose-700/80 mt-0.5">Perlu Perhatian</span>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Priority Attention Section -->
    <div class="flex flex-col gap-4 mt-4">
        <h2 class="text-[14px] font-bold text-slate-800 px-1 flex items-center gap-2">
            Prioritas Perhatian
            <span class="bg-rose-100 text-rose-700 text-[10px] uppercase font-bold tracking-widest px-2.5 py-0.5 rounded-full">{{ count($priorityChildren ?? []) }} Anak</span>
        </h2>
        
        <div class="bg-[#F8FAFC] border border-slate-100/80 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.02)] rounded-[32px] p-2.5 lg:p-3 flex flex-col gap-2.5">
            @forelse($priorityChildren ?? [] as $child)
                <a href="{{ route('balita.show', $child->id) }}" class="flex items-center justify-between p-4 lg:p-5 bg-white border border-slate-100/60 shadow-[0_2px_8px_-4px_rgba(0,0,0,0.03)] rounded-[24px] hover:shadow-[0_8px_24px_-8px_rgba(0,0,0,0.08)] hover:-translate-y-0.5 hover:border-slate-200/80 transition-all duration-300 group cursor-pointer relative overflow-hidden">
                    <div class="absolute inset-0 bg-slate-50/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <!-- Left: Avatar & Info -->
                    <div class="flex items-center gap-4 z-10">
                        <!-- Avatar -->
                        <div class="w-12 h-12 rounded-[16px] bg-slate-50 border border-slate-100 overflow-hidden flex-shrink-0 group-hover:shadow-sm transition-all duration-300 ring-4 ring-[#F8FAFC] group-hover:ring-white">
                            @if(!empty($child->avatar))
                                <img src="{{ $child->avatar }}" alt="{{ $child->name }}" class="w-full h-full object-cover">
                            @else
                                <!-- Fallback Avatar -->
                                <div class="w-full h-full flex items-center justify-center text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                      <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Name & Age -->
                        <div class="flex flex-col">
                            <span class="font-extrabold text-slate-900 text-[15px] group-hover:text-emerald-700 transition-colors">{{ $child->name }}</span>
                            <span class="text-[12px] text-slate-500 font-medium mt-0.5">{{ $child->age }}</span>
                        </div>
                    </div>
                    
                    <!-- Right: Badge -->
                    <div class="z-10">
                        @if(($child->statusType ?? 'warning') === 'danger')
                            <div class="flex items-center gap-2 bg-rose-50/80 text-rose-700 px-3.5 py-1.5 rounded-xl border border-rose-100/50">
                                <div class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></div>
                                <span class="text-[11px] font-extrabold uppercase tracking-widest">{{ $child->status }}</span>
                            </div>
                        @else
                            <div class="flex items-center gap-2 bg-amber-50/80 text-amber-700 px-3.5 py-1.5 rounded-xl border border-amber-100/50">
                                <div class="w-1.5 h-1.5 rounded-full bg-amber-500"></div>
                                <span class="text-[11px] font-extrabold uppercase tracking-widest">{{ $child->status }}</span>
                            </div>
                        @endif
                    </div>
                </a>
            @empty
                <div class="flex flex-col items-center justify-center text-slate-400 py-12 gap-4 bg-white rounded-[24px]">
                    <div class="w-14 h-14 rounded-full bg-slate-50 flex items-center justify-center border border-slate-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 opacity-40">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                        </svg>
                    </div>
                    <span class="text-[14px] font-medium text-slate-500">Belum ada data prioritas perhatian.</span>
                </div>
            @endforelse
            
            <!-- View All Button -->
            <a href="{{ route('balita.index') }}" class="flex items-center justify-center gap-2 w-full bg-slate-100 hover:bg-slate-200 text-slate-700 hover:text-slate-900 font-bold text-[13px] py-3.5 rounded-[20px] text-center transition-all duration-300 group mt-1">
                Lihat Semua Prioritas
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 group-hover:translate-x-1 transition-transform">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </a>
        </div>
    </div>

    <!-- Today's Activity Section -->
    <div class="flex flex-col gap-4 mt-4">
        <h2 class="text-[14px] font-bold text-slate-800 px-1">Aktivitas Hari Ini</h2>
        
        <div class="bg-[#F8FAFC] border border-slate-100/80 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.02)] rounded-[32px] p-2.5 lg:p-3 flex flex-col lg:flex-row gap-2.5 lg:gap-3 transition-all duration-300">
            <!-- Activity Detail Panel -->
            <div class="flex gap-4 items-center flex-1 bg-white p-4 lg:p-5 rounded-[24px] shadow-[0_2px_8px_-4px_rgba(0,0,0,0.02)] border border-slate-100/60 hover:shadow-sm hover:border-slate-200/80 transition-all">
                <div class="w-12 h-12 rounded-[16px] bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0 border border-emerald-100/30">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="font-extrabold text-slate-800 text-[15px] tracking-tight leading-tight">{{ $activityName ?? 'Pengukuran Rutin' }}</span>
                    <span class="text-[12px] text-slate-500 font-medium mt-0.5 flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $activityTime ?? '08.00 - 11.00 WIB' }}
                    </span>
                </div>
            </div>
            
            <!-- Location Detail Panel -->
            <div class="flex gap-4 items-center flex-1 bg-white p-4 lg:p-5 rounded-[24px] shadow-[0_2px_8px_-4px_rgba(0,0,0,0.02)] border border-slate-100/60 hover:shadow-sm hover:border-slate-200/80 transition-all">
                <div class="w-12 h-12 rounded-[16px] bg-slate-50 text-slate-500 flex items-center justify-center flex-shrink-0 border border-slate-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="font-extrabold text-slate-800 text-[15px]">{{ $activityLocation ?? 'Posyandu Melati 1' }}</span>
                    <span class="text-[12px] text-slate-500 font-medium mt-0.5">{{ $activityAddress ?? 'Di Balai Desa Lampeuneurut' }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
