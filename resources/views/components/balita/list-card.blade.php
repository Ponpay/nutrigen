@props([
    'child',
    'isActive' => false
])

@php
    $initials = collect(explode(' ', $child['nama']))->map(fn($n) => substr($n, 0, 1))->take(2)->join('');
    
    // Get latest measurement for list display (if any)
    $latestMeasurement = count($child['pengukurans']) > 0 ? $child['pengukurans'][0] : null;
    
    // Determine badge color based on status_gizi (simplified logic for dummy)
    $statusGizi = $latestMeasurement ? $latestMeasurement['status_gizi'] : 'Belum Diukur';
    $statusType = 'slate';
    if(in_array($statusGizi, ['Normal', 'Gizi Baik'])) $statusType = 'emerald';
    elseif(in_array($statusGizi, ['Kurang', 'Kurus', 'Risiko Lebih'])) $statusType = 'amber';
    elseif(in_array($statusGizi, ['Stunting', 'Gizi Buruk', 'Sangat Kurus', 'Obesitas'])) $statusType = 'rose';
@endphp

<button type="button" 
    data-balita-id="{{ $child['id'] }}"
    data-nama="{{ strtolower($child['nama']) }}"
    data-posyandu="{{ strtolower($child['posyandu']['nama']) }}"
    data-status="{{ strtolower($latestMeasurement['status_gizi'] ?? 'belum_diukur') }}"
    class="balita-card-btn w-full text-left px-4 py-3.5 border-b border-slate-200 transition-all duration-200 focus:outline-none flex gap-4 relative
    {{ $isActive ? 'bg-teal-50/40 border-l-4 border-l-teal-600 z-10' : 'bg-white hover:bg-slate-50 hover:border-l-slate-300 border-l-4 border-l-transparent' }}">
    
    <!-- Photo / Avatar -->
    <div class="shrink-0 mt-0.5">
        @if(isset($child['foto']) && $child['foto'])
            <img src="{{ $child['foto'] }}" alt="{{ $child['nama'] }}" class="w-11 h-11 rounded-full object-cover border border-slate-200">
        @else
            <div class="w-11 h-11 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center font-bold text-sm border border-slate-200">
                {{ strtoupper($initials) }}
            </div>
        @endif
    </div>

    <!-- Content -->
    <div class="flex-1 min-w-0">
        <!-- Top Row -->
        <div class="flex justify-between items-start mb-0.5">
            <h4 class="font-bold truncate text-sm text-slate-800 balita-card-name">
                {{ $child['nama'] }}
            </h4>
            <span class="text-[10px] text-slate-400 font-medium whitespace-nowrap ml-2">
                {{ $child['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' }}
            </span>
        </div>
        
        <!-- Second Row -->
        <div class="flex items-center gap-1.5 text-[11px] mb-2">
            <span class="text-slate-500 font-medium">
                @if($latestMeasurement)
                    {{ $latestMeasurement['umur_bulan'] }} bln
                @else
                    Baru Daftar
                @endif
            </span>
            <span class="text-slate-300">&bull;</span>
            <x-status-badge :type="$statusType" :label="$statusGizi" />
        </div>

        <!-- Bottom Row -->
        <div class="flex items-center gap-1.5 text-[10px] text-slate-500 mt-1.5 truncate">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3 h-3 text-slate-400 shrink-0">
              <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
            </svg>
            <span class="truncate">{{ $child['posyandu']['nama'] }}</span>
        </div>
    </div>
</button>
