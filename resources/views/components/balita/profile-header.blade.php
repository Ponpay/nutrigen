@props(['child'])

@php
    $initials = collect(explode(' ', $child['nama']))->map(fn($n) => substr($n, 0, 1))->take(2)->join('');
    // Hitung umur dalam bulan berdasarkan tanggal lahir (dummy logic for view)
    $birthDate = new DateTime($child['tanggal_lahir']);
    $today = new DateTime('2026-07-14'); // Simulated current date
    $diff = $today->diff($birthDate);
    $ageMonths = ($diff->y * 12) + $diff->m;
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
                    <h2 class="text-2xl font-extrabold text-slate-800 leading-none truncate">{{ $child['nama'] }}</h2>
                    <div class="flex flex-wrap items-center gap-2 mt-2 text-xs font-medium text-slate-500">
                        <span class="bg-slate-100 px-2 py-0.5 rounded text-slate-600 border border-slate-200">NIK: {{ $child['nik'] }}</span>
                        <span class="hidden sm:inline">&bull;</span>
                        <span>{{ $child['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                        <span class="hidden sm:inline">&bull;</span>
                        <span>{{ $ageMonths }} Bulan</span>
                        <span class="hidden sm:inline">&bull;</span>
                        <span>Lahir: {{ date('d M Y', strtotime($child['tanggal_lahir'])) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Meta Info Bar (Ibu & Posyandu) -->
    <div class="mt-5 flex flex-wrap items-center gap-3 sm:gap-4 text-xs bg-slate-50 p-3 rounded-lg border border-slate-100">
        <div class="flex items-center gap-1.5 text-slate-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-slate-400">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
            <span class="font-semibold text-slate-700">Ibu {{ $child['ibu']['nama'] }}</span>
        </div>
        <div class="hidden sm:block w-px h-4 bg-slate-300"></div>
        <div class="flex items-center gap-1.5 text-slate-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-emerald-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
            </svg>
            <a href="https://wa.me/{{ $child['ibu']['no_hp_wa'] }}" target="_blank" class="hover:text-emerald-600 transition-colors">
                +{{ $child['ibu']['no_hp_wa'] }}
            </a>
        </div>
        <div class="hidden sm:block w-px h-4 bg-slate-300"></div>
        <div class="flex items-center gap-1.5 text-slate-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-slate-400">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
            </svg>
            <span class="font-semibold">{{ $child['posyandu']['nama'] }}</span>
        </div>
    </div>
</div>
