@extends('layouts.app')

@section('page-title', 'Jadwal Posyandu')

@section('content')
<div class="flex flex-col bg-slate-50 min-h-screen pb-32">
    <!-- Hero Section -->
    <div class="bg-white px-5 pt-8 pb-8 rounded-b-[2.5rem] shadow-sm border-b border-slate-200 z-20 relative overflow-hidden">
        <!-- Watermark Icon -->
        <div class="absolute -top-6 -right-6 text-slate-200 opacity-20 transform rotate-12 pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-48 h-48">
              <path d="M12.75 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM7.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM8.25 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM9.75 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM10.5 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM12.75 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM14.25 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 13.5a.75.75 0 100-1.5.75.75 0 000 1.5z" />
              <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z" clip-rule="evenodd" />
            </svg>
        </div>

        <div class="max-w-4xl mx-auto w-full relative z-10 flex flex-col">
            <!-- (1) Judul & Deskripsi -->
            <div class="flex items-center gap-3 pb-5">
                <a href="{{ route('dashboard') }}" class="flex flex-shrink-0 items-center justify-center w-11 h-11 -ml-2 text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-full transition-all focus:outline-none focus:ring-2 focus:ring-slate-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Jadwal Posyandu</h1>
                    <p class="text-sm font-medium text-slate-500 mt-0.5">Kelola seluruh jadwal kegiatan Posyandu.</p>
                </div>
            </div>
            
            <!-- Divider -->
            <div class="border-t border-slate-100/80 mb-5"></div>
            
            <!-- (2) Mini Summary Cards -->
            <div class="grid grid-cols-3 gap-2.5 sm:gap-4 mb-5">
                <!-- Total Jadwal -->
                <div class="bg-gradient-to-br from-white to-slate-50 border border-slate-100 rounded-2xl p-3 sm:p-4 flex flex-col justify-center shadow-sm relative overflow-hidden">
                    <div class="absolute -bottom-2 -right-2 text-slate-200/50">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12">
                          <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="text-[10px] sm:text-xs font-bold text-slate-500 uppercase tracking-wider mb-1 line-clamp-1 relative z-10">Total Jadwal</span>
                    <span class="text-xl sm:text-2xl font-black text-slate-800 relative z-10">{{ $totalSchedule ?? 12 }}</span>
                </div>
                <!-- Hari Ini -->
                <div class="bg-gradient-to-br from-white to-teal-50/50 border border-teal-100/50 rounded-2xl p-3 sm:p-4 flex flex-col justify-center shadow-sm relative overflow-hidden">
                    <div class="absolute -bottom-2 -right-2 text-teal-100/50">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12">
                          <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="text-[10px] sm:text-xs font-bold text-teal-600/80 uppercase tracking-wider mb-1 line-clamp-1 relative z-10">Hari Ini</span>
                    <span class="text-xl sm:text-2xl font-black text-teal-700 relative z-10">{{ $todaySchedule ?? 3 }}</span>
                </div>
                <!-- Balita Terdaftar -->
                <div class="bg-gradient-to-br from-white to-emerald-50/50 border border-emerald-100/50 rounded-2xl p-3 sm:p-4 flex flex-col justify-center shadow-sm relative overflow-hidden">
                    <div class="absolute -bottom-2 -right-2 text-emerald-100/50">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12">
                          <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM6.31 15.117A6.745 6.745 0 0112 12a6.745 6.745 0 016.709 7.498.75.75 0 01-.372.568A12.696 12.696 0 0112 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 01-.372-.568 6.787 6.787 0 011.019-4.38z" clip-rule="evenodd" />
                          <path d="M5.082 14.254a8.287 8.287 0 00-1.308 5.135 9.687 9.687 0 01-1.764-.44l-.115-.04a.563.563 0 01-.373-.487l-.01-.121a3.75 3.75 0 016.576-3.036c.32.32.613.67.872 1.05zM18.918 14.254a8.287 8.287 0 011.308 5.135 9.687 9.687 0 001.764-.44l.115-.04a.563.563 0 00.373-.487l.01-.121a3.75 3.75 0 00-6.576-3.036c-.32.32-.613.67-.872 1.05z" />
                        </svg>
                    </div>
                    <span class="text-[10px] sm:text-xs font-bold text-emerald-600/80 uppercase tracking-wider mb-1 line-clamp-1 relative z-10">Balita Ikut</span>
                    <span class="text-xl sm:text-2xl font-black text-emerald-700 relative z-10">{{ $registeredChildren ?? 128 }}</span>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-slate-100/80 mb-5"></div>

            <!-- (3) Search Bar -->
            <div class="relative w-full">
                <input type="text" placeholder="Cari jadwal, lokasi, atau kegiatan..." class="w-full bg-white border border-slate-200 rounded-2xl pl-12 pr-12 py-4 text-sm text-slate-700 font-medium focus:outline-none focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 transition-all placeholder:text-slate-400 shadow-sm hover:shadow-md">
                <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-slate-400">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </div>
                <!-- Filter Icon (Visual Only) -->
                <div class="absolute inset-y-0 right-4 flex items-center cursor-pointer group">
                    <div class="p-1.5 bg-slate-50 rounded-lg border border-slate-200 group-hover:bg-slate-100 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-slate-500">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Container -->
    <div class="max-w-4xl mx-auto w-full px-5 mt-6 flex flex-col gap-5">
        
        <!-- Filter Chips -->
        <div class="flex items-center gap-2.5 overflow-x-auto pb-2 scrollbar-hide" style="scrollbar-width: none;">
            <button type="button" class="flex-shrink-0 flex items-center gap-1.5 px-5 py-2.5 bg-teal-600 text-white rounded-full text-sm font-bold shadow-md shadow-teal-500/20 transition-all hover:-translate-y-0.5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3.5 h-3.5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
                Semua
            </button>
            <button type="button" class="flex-shrink-0 px-5 py-2.5 bg-white text-slate-500 border border-slate-200 rounded-full text-sm font-semibold hover:bg-slate-50 hover:text-slate-700 hover:shadow-sm transition-all hover:-translate-y-0.5">Hari Ini</button>
            <button type="button" class="flex-shrink-0 px-5 py-2.5 bg-white text-slate-500 border border-slate-200 rounded-full text-sm font-semibold hover:bg-slate-50 hover:text-slate-700 hover:shadow-sm transition-all hover:-translate-y-0.5">Minggu Ini</button>
            <button type="button" class="flex-shrink-0 px-5 py-2.5 bg-white text-slate-500 border border-slate-200 rounded-full text-sm font-semibold hover:bg-slate-50 hover:text-slate-700 hover:shadow-sm transition-all hover:-translate-y-0.5">Selesai</button>
        </div>

        <!-- Schedule List -->
        <div class="flex flex-col gap-4 mt-1">
            
            @forelse($jadwals ?? [1, 2, 3] as $index => $jadwal)
                @php
                    $isToday = $index === 0;
                    $isDone = $index === 2;
                    
                    // Badges with Icons
                    $badgeText = $isToday ? 'Hari Ini' : ($isDone ? 'Selesai' : 'Mendatang');
                    $badgeColor = $isToday ? 'bg-amber-50 text-amber-600 border-amber-200' : ($isDone ? 'bg-slate-100 text-slate-500 border-slate-200' : 'bg-teal-50 text-teal-600 border-teal-200');
                    
                    $badgeIcon = '';
                    if ($isToday) {
                        $badgeIcon = '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />';
                    } elseif ($isDone) {
                        $badgeIcon = '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />';
                    } else {
                        $badgeIcon = '<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />';
                    }
                    
                    // Date blocks
                    $dateNum = $isToday ? '12' : ($isDone ? '07' : '09');
                    $dateMonth = $isToday ? 'MEI' : ($isDone ? 'JUL' : 'JUN');
                    
                    if ($isToday) {
                        $dateBlockBg = 'bg-gradient-to-br from-teal-50 to-teal-100/70 ring-1 ring-teal-200 shadow-sm shadow-teal-500/10';
                        $dateBlockNum = 'text-teal-700';
                        $dateBlockMonth = 'text-teal-600';
                    } elseif ($isDone) {
                        $dateBlockBg = 'bg-gradient-to-br from-slate-50 to-slate-100 ring-1 ring-slate-200 shadow-sm shadow-slate-500/5';
                        $dateBlockNum = 'text-slate-500';
                        $dateBlockMonth = 'text-slate-400';
                    } else {
                        $dateBlockBg = 'bg-gradient-to-br from-emerald-50 to-emerald-100/70 ring-1 ring-emerald-200 shadow-sm shadow-emerald-500/10';
                        $dateBlockNum = 'text-emerald-700';
                        $dateBlockMonth = 'text-emerald-600';
                    }
                @endphp

                <!-- Card Jadwal -->
                <a href="{{ route('jadwal.show') }}" class="group block w-full bg-gradient-to-b from-white to-slate-50/50 border border-slate-200/80 rounded-[1.75rem] p-5 shadow-sm hover:shadow-lg hover:shadow-teal-500/10 hover:border-teal-300 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden flex flex-col gap-4">
                    <!-- Top section -->
                    <div>
                        <div class="flex items-start justify-between mb-4">
                            <h3 class="font-extrabold text-slate-800 text-lg sm:text-xl group-hover:text-teal-700 transition-colors leading-tight max-w-[70%]">{{ $scheduleTitle ?? 'Posyandu Melati 1' }}</h3>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-extrabold uppercase tracking-widest border {{ $badgeColor }} shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                                    {!! $badgeIcon !!}
                                </svg>
                                {{ $badgeText }}
                            </span>
                        </div>

                        <div class="flex gap-4 sm:gap-5">
                            <!-- Date Block -->
                            <div class="flex-shrink-0 w-16 sm:w-20 h-20 sm:h-24 {{ $dateBlockBg }} rounded-2xl flex flex-col items-center justify-center">
                                <span class="text-3xl sm:text-4xl font-black {{ $dateBlockNum }} leading-none tracking-tight">{{ $dateNum }}</span>
                                <span class="text-[10px] sm:text-xs font-extrabold {{ $dateBlockMonth }} uppercase tracking-widest mt-1 sm:mt-1.5">{{ $dateMonth }}</span>
                            </div>
                            
                            <!-- Info Details -->
                            <div class="flex flex-col justify-center gap-2.5 flex-grow">
                                <!-- Date & Time -->
                                <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4">
                                    <div class="flex items-center gap-2 text-slate-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 opacity-70">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                        </svg>
                                        <span class="text-sm font-semibold">Minggu, {{ $dateNum }} {{ ucfirst(strtolower($dateMonth)) }} 2024</span>
                                    </div>
                                    <div class="hidden sm:block w-1.5 h-1.5 rounded-full bg-slate-300"></div>
                                    <div class="flex items-center gap-2 text-slate-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 opacity-70">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="text-sm font-semibold">08.00 - 11.00 WIB</span>
                                    </div>
                                </div>
                                
                                <!-- Location -->
                                <div class="flex items-center gap-2 text-slate-500 mt-0.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 opacity-70">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                    <span class="text-sm font-semibold line-clamp-1">Di Balai Desa Lampeuneurut</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-slate-100 border-dashed"></div>

                    <!-- Footer Section -->
                    <div class="flex items-center justify-between w-full">
                        <!-- Balita Count -->
                        <div class="flex items-center gap-2 text-slate-600 bg-white border border-slate-200 px-3 py-1.5 rounded-lg shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-teal-600">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                            <span class="text-xs font-bold uppercase tracking-wide">{{ $registered ?? 35 }} Balita Terdaftar</span>
                        </div>
                        
                        <span class="inline-flex items-center gap-1.5 text-xs font-extrabold text-teal-600 uppercase tracking-widest group-hover:text-teal-700 transition-colors">
                            Detail Jadwal
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3.5 h-3.5 transition-transform group-hover:translate-x-1">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </span>
                    </div>
                </a>
            @empty
                <!-- Empty State -->
                <div class="flex flex-col items-center justify-center bg-white border border-slate-200 border-dashed rounded-[2rem] py-16 px-6 text-center mt-2 shadow-sm">
                    <div class="w-24 h-24 bg-gradient-to-br from-slate-50 to-slate-100 border border-slate-200 text-slate-300 rounded-[2rem] flex items-center justify-center mb-6 shadow-sm transform -rotate-6 group-hover:rotate-0 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-800 mb-2 tracking-tight">Belum Ada Jadwal</h3>
                    <p class="text-sm font-medium text-slate-500 max-w-[280px] mx-auto leading-relaxed mb-6">Saat ini tidak ada jadwal kegiatan Posyandu yang terdaftar. Yuk, buat jadwal baru untuk balita!</p>
                    <a href="{{ route('jadwal.create') }}" class="inline-flex items-center justify-center gap-2 bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-full shadow-md shadow-teal-500/20 font-bold text-sm transition-all hover:-translate-y-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Tambah Jadwal
                    </a>
                </div>
            @endforelse

        </div>
    </div>

    <!-- Floating Action Button -->
    <div class="fixed bottom-24 lg:bottom-10 right-5 lg:right-10 z-40">
        <a href="{{ route('jadwal.create') }}" class="flex items-center justify-center gap-2 bg-teal-600 hover:bg-teal-700 text-white px-5 py-4 rounded-full shadow-lg shadow-teal-600/30 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-teal-600/40 focus:outline-none font-bold text-sm border border-teal-500/50">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                <path fill-rule="evenodd" d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z" clip-rule="evenodd" />
            </svg>
            <span class="hidden sm:inline">Tambah Jadwal</span>
        </a>
    </div>
</div>
@endsection
