@props(['child'])

@php
    $rekomendasi = '';
    
    if ($child['statusType'] === 'danger') {
        $rekomendasi = "Data menunjukkan deviasi dari standar. Mohon periksa kembali hasil pengukuran.";
    } elseif ($child['statusType'] === 'warning') {
        $rekomendasi = "Terdapat indikator yang memerlukan perhatian khusus dari petugas.";
    } else {
        $rekomendasi = "Data indikator pertumbuhan terpantau berada pada rentang normal.";
    }
@endphp

<div class="px-5 lg:px-6 py-4 lg:py-5 bg-[#00A9C0] shrink-0 rounded-t-xl lg:rounded-none">
    <div class="flex items-start justify-between">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center text-[#00A9C0] font-black text-lg shrink-0">
                {{ collect(explode(' ', $child['name']))->map(fn($n) => substr($n, 0, 1))->take(2)->join('') }}
            </div>
            <div>
                <h1 class="text-xl font-bold tracking-tight text-white leading-tight mb-1">{{ $child['name'] }}</h1>
                <div class="flex items-center gap-2 text-white/90 text-xs font-medium">
                    <span>{{ $child['age'] }}</span>
                    <span>&bull;</span>
                    <span>Laki-laki</span> <!-- Placeholder gender since it's in mockup -->
                    <span>&bull;</span>
                    <span>Posyandu {{ $child['posyandu'] }}</span>
                    <span>&bull;</span>
                    <span>Kader {{ $child['kader'] }}</span>
                </div>
            </div>
        </div>
        <div class="text-right flex flex-col items-end gap-1.5">
            @php
                $badgeColors = [
                    'danger' => 'bg-[#FF3B30] text-white border-transparent',
                    'warning' => 'bg-[#FF9500] text-white border-transparent',
                    'success' => 'bg-[#34C759] text-white border-transparent'
                ];
                $color = $badgeColors[$child['statusType']] ?? $badgeColors['success'];
            @endphp
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold border {{ $color }} uppercase tracking-wider">
                <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                {{ $child['statusLabel'] }}
            </span>
            <span class="text-xs text-white/90 font-medium">{{ $child['date'] }} &bull; {{ $child['time'] ?? '09:00 WIB' }}</span>
        </div>
    </div>
</div>

<!-- Clinical Alert -->
<div class="px-5 lg:px-6 py-3 {{ $child['statusType'] === 'danger' ? 'bg-[#FFF2F2] text-[#FF3B30]' : ($child['statusType'] === 'warning' ? 'bg-[#FFF9F2] text-[#FF9500]' : 'bg-[#F2FFF4] text-[#34C759]') }} flex items-center gap-2 text-sm font-medium border-b {{ $child['statusType'] === 'danger' ? 'border-[#FFE5E5]' : ($child['statusType'] === 'warning' ? 'border-[#FFECCC]' : 'border-[#E5FFE9]') }}">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 shrink-0">
        <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
    </svg>
    <span>{{ $rekomendasi }}</span>
</div>
