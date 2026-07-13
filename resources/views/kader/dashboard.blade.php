@extends('layouts.app')
@section('page-title', 'Beranda')
@section('content')
<div class="flex flex-col gap-8 p-5 w-full bg-slate-50/50">
    
    <!-- Welcome Section -->
    <div class="flex flex-col">
        <h1 class="text-xl font-bold text-gray-800">
            Selamat pagi, {{ $kaderName ?? 'Ibu Kader' }} 👋
        </h1>
        <p class="text-sm text-gray-500 font-medium mt-1">
            {{ $posyanduName ?? 'Posyandu Melati 1' }}
        </p>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-2 gap-3">
        <a href="{{ route('balita.create') }}" class="flex items-center gap-3 bg-white border border-slate-200 p-3 rounded-xl shadow-sm hover:shadow-md transition-all lg:hover:-translate-y-0.5 group">
            <div class="w-10 h-10 rounded-full bg-teal-50 text-teal-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </div>
            <div class="flex flex-col">
                <span class="text-sm font-bold text-slate-800">Tambah</span>
                <span class="text-[11px] font-medium text-slate-500">Balita Baru</span>
            </div>
        </a>
        <a href="{{ route('balita.index') }}" class="flex items-center gap-3 bg-white border border-slate-200 p-3 rounded-xl shadow-sm hover:shadow-md transition-all lg:hover:-translate-y-0.5 group">
            <div class="w-10 h-10 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0l2.469 10.106c.122.499.106 1.028.589 1.202a5.989 5.989 0 002.031.352 5.989 5.989 0 002.031-.352c.483-.174.711-.703.59-1.202L5.25 4.971z" />
                </svg>
            </div>
            <div class="flex flex-col">
                <span class="text-sm font-bold text-slate-800">Ukur</span>
                <span class="text-[11px] font-medium text-slate-500">Pilih Balita</span>
            </div>
        </a>
    </div>

    <!-- Daily Statistics Section -->
    <div class="border border-slate-200 rounded-2xl p-5 shadow-sm bg-white flex flex-col gap-5">
        <!-- Header: Hari ini & Date -->
        <div class="flex justify-between items-center">
            <span class="font-bold text-slate-800 text-base">Hari ini</span>
            <div class="flex items-center gap-1 text-xs font-semibold text-slate-600 bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-200">
                <span>{{ $currentDate ?? 'Selasa, 10 Mei 2024' }}</span>
            </div>
        </div>
        
        <!-- Grid Stats -->
        <div class="grid grid-cols-2 gap-4">
            <!-- Total -->
            <a href="{{ route('balita.index') }}" class="block bg-emerald-50 border border-emerald-200 rounded-xl p-4 flex flex-col justify-center gap-1 shadow-sm lg:hover:shadow-md transition-all duration-200 lg:hover:-translate-y-0.5 relative overflow-hidden group cursor-pointer">
                <div class="absolute right-0 top-0 p-3 opacity-20 text-emerald-600 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12">
                      <path d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" />
                    </svg>
                </div>
                <span class="text-xs font-bold text-emerald-800 tracking-wide uppercase">Total Balita</span>
                <span class="text-4xl font-extrabold text-emerald-900 z-10">{{ $statTotal ?? 32 }}</span>
            </a>
            
            <!-- Sudah Diukur -->
            <a href="{{ url('/daftar-balita') }}" class="block bg-blue-50 border border-blue-200 rounded-xl p-3.5 flex flex-col justify-center gap-1 shadow-sm lg:hover:shadow-md transition-all duration-200 lg:hover:-translate-y-0.5 relative overflow-hidden group cursor-pointer">
                <div class="absolute right-0 top-0 p-3 opacity-20 text-blue-600 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                      <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="text-xs font-bold text-blue-800 tracking-wide uppercase">Sudah Diukur</span>
                <span class="text-3xl font-extrabold text-blue-900 z-10">{{ $statSudah ?? 8 }}</span>
            </a>
            
            <!-- Belum Diukur -->
            <a href="{{ url('/daftar-balita') }}" class="block bg-amber-50 border border-amber-200 rounded-xl p-3.5 flex flex-col justify-center gap-1 shadow-sm lg:hover:shadow-md transition-all duration-200 lg:hover:-translate-y-0.5 relative overflow-hidden group cursor-pointer">
                <div class="absolute right-0 top-0 p-3 opacity-20 text-amber-600 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                      <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="text-xs font-bold text-amber-800 tracking-wide uppercase">Belum Diukur</span>
                <span class="text-3xl font-extrabold text-amber-900 z-10">{{ $statBelum ?? 5 }}</span>
            </a>
            
            <!-- Perlu Perhatian -->
            <a href="{{ url('/daftar-balita') }}" class="block bg-rose-50 border border-rose-200 rounded-xl p-3.5 flex flex-col justify-center gap-1 shadow-sm lg:hover:shadow-md transition-all duration-200 lg:hover:-translate-y-0.5 relative overflow-hidden group cursor-pointer">
                <div class="absolute right-0 top-0 p-3 opacity-20 text-rose-600 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                      <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="text-xs font-bold text-rose-800 tracking-wide uppercase">Perhatian</span>
                <span class="text-3xl font-extrabold text-rose-900 z-10">{{ $statPerlu ?? 3 }}</span>
            </a>
        </div>
    </div>

    <!-- Priority Attention Section -->
    <div class="flex flex-col gap-4">
        <h2 class="font-bold text-slate-800 text-base">Prioritas Perhatian</h2>
        
        <div class="flex flex-col gap-3">
            @forelse($priorityChildren ?? [] as $child)
                <a href="{{ route('balita.show') }}" class="flex items-center justify-between border border-slate-200 rounded-xl p-3.5 shadow-sm bg-white lg:hover:shadow-md transition-all duration-200 lg:hover:-translate-y-0.5 group cursor-pointer block">
                    <!-- Left: Avatar & Info -->
                    <div class="flex items-center gap-3">
                        <!-- Avatar -->
                        <div class="w-11 h-11 rounded-full bg-slate-100 border border-slate-200 overflow-hidden flex-shrink-0 group-hover:ring-2 group-hover:ring-teal-100 transition-all">
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
                            <span class="font-bold text-slate-800 text-sm group-hover:text-teal-700 transition-colors">{{ $child->name }}</span>
                            <span class="text-xs text-slate-500 font-medium">{{ $child->age }}</span>
                        </div>
                    </div>
                    
                    <!-- Right: Badge -->
                    <div>
                        @if(($child->statusType ?? 'warning') === 'danger')
                            <div class="flex items-center gap-1.5 bg-rose-50 text-rose-700 px-2.5 py-1 rounded-full border border-rose-200">
                                <div class="w-1.5 h-1.5 rounded-full bg-rose-500"></div>
                                <span class="text-[10px] font-bold uppercase tracking-wide">{{ $child->status }}</span>
                            </div>
                        @else
                            <div class="flex items-center gap-1.5 bg-amber-50 text-amber-700 px-2.5 py-1 rounded-full border border-amber-200">
                                <div class="w-1.5 h-1.5 rounded-full bg-amber-500"></div>
                                <span class="text-[10px] font-bold uppercase tracking-wide">{{ $child->status }}</span>
                            </div>
                        @endif
                    </div>
                </a>
            @empty
                <div class="flex flex-col items-center justify-center text-slate-400 py-8 gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 opacity-50">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                    </svg>
                    <span class="text-xs font-medium">Belum ada data prioritas perhatian.</span>
                </div>
            @endforelse
        </div>
        
        <!-- View All Button (Changed to Link) -->
        <a href="{{ route('balita.index') }}" class="flex items-center justify-center gap-2 w-full bg-white border-2 border-teal-600 text-teal-700 hover:bg-teal-50 hover:border-teal-700 font-bold text-sm py-3 rounded-xl mt-2 text-center transition-all duration-200 shadow-sm lg:hover:shadow-md lg:hover:-translate-y-0.5 group">
            Lihat Semua Prioritas
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 group-hover:translate-x-1 transition-transform">
              <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
        </a>
    </div>

    <!-- Today's Activity Section -->
    <div class="flex flex-col gap-4">
        <h2 class="font-bold text-slate-800 text-base">Aktivitas Hari Ini</h2>
        
        <div class="border border-slate-200 rounded-xl p-5 shadow-sm bg-white flex flex-col gap-5 lg:hover:shadow-md transition-all duration-200">
            <!-- Activity Detail -->
            <div class="flex gap-3 items-start">
                <div class="w-6 h-6 flex items-center justify-center text-gray-400 flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="font-bold text-gray-800 text-sm">{{ $activityName ?? 'Pengukuran Rutin' }}</span>
                    <span class="text-[11px] text-gray-500 font-medium">{{ $activityTime ?? '08.00 - 11.00' }}</span>
                </div>
            </div>
            
            <!-- Location Detail -->
            <div class="flex gap-3 items-start">
                <div class="w-6 h-6 flex items-center justify-center text-gray-400 flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="font-bold text-gray-800 text-sm">{{ $activityLocation ?? 'Posyandu Melati 1' }}</span>
                    <span class="text-[11px] text-gray-500 font-medium">{{ $activityAddress ?? 'Di Balai Desa Lampeuneurut' }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
