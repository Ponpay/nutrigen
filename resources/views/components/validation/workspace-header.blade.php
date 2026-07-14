@props(['child'])

@php
    $initials = collect(explode(' ', $child['name']))->map(fn($n) => substr($n, 0, 1))->take(2)->join('');
@endphp

<div class="bg-white border-b border-slate-200 p-5 shrink-0 sticky top-0 z-10 shadow-sm">
    <div class="flex items-start gap-5">
        <!-- Avatar -->
        <div class="w-16 h-16 rounded-full bg-slate-200 text-slate-500 font-bold text-xl flex items-center justify-center shrink-0 border-2 border-white shadow-md">
            <span>{{ strtoupper($initials) }}</span>
        </div>
        
        <!-- Profile Info -->
        <div class="flex-1 min-w-0">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-0">
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-800 leading-none truncate">{{ $child['name'] }}</h2>
                    <div class="flex flex-wrap items-center gap-2 mt-2 text-xs font-medium text-slate-500">
                        <span class="bg-slate-100 px-2 py-0.5 rounded text-slate-600 border border-slate-200">NIK: {{ $child['nik'] }}</span>
                        <span class="hidden sm:inline">&bull;</span>
                        <span>{{ $child['gender'] == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                        <span class="hidden sm:inline">&bull;</span>
                        <span>{{ $child['age'] }}</span>
                        <span class="hidden sm:inline">&bull;</span>
                        <span>Anak {{ $child['parent'] }}</span>
                    </div>
                </div>
                <div class="flex flex-col sm:items-end gap-1 sm:text-right shrink-0">
                    <span class="text-[10px] uppercase font-bold tracking-widest text-slate-400">Status Validasi</span>
                    <x-status-badge :type="$child['statusType']" :label="$child['statusLabel']" />
                </div>
            </div>
        </div>
    </div>

    <!-- Meta Info Bar -->
    <div class="mt-5 flex flex-wrap items-center gap-3 sm:gap-4 text-xs bg-slate-50 p-3 rounded-lg border border-slate-100">
        <div class="flex items-center gap-1.5 text-slate-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-slate-400">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
            </svg>
            <span class="font-semibold">{{ $child['posyandu'] }}</span>
        </div>
        <div class="hidden sm:block w-px h-4 bg-slate-300"></div>
        <div class="flex items-center gap-1.5 text-slate-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-slate-400">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
            <span>{{ $child['kader'] }}</span>
        </div>
        <div class="hidden sm:block w-px h-4 bg-slate-300"></div>
        <div class="flex items-center gap-1.5 text-slate-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-slate-400">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
            </svg>
            <span>{{ $child['date'] }} ({{ $child['time'] }})</span>
        </div>
    </div>
</div>
