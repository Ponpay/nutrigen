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

<div class="px-5 lg:px-6 py-4 border-b border-slate-200 bg-white shrink-0">
    <div class="flex items-start justify-between">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-sky-100 flex items-center justify-center text-sky-700 font-black text-sm border border-sky-200 shrink-0">
                {{ collect(explode(' ', $child['name']))->map(fn($n) => substr($n, 0, 1))->take(2)->join('') }}
            </div>
            <div>
                <h1 class="text-lg font-bold text-slate-800 leading-tight">{{ $child['name'] }}</h1>
                <div class="flex items-center gap-1.5 mt-0.5 text-slate-500 text-[11px] font-medium">
                    <span class="text-slate-700">NIK: {{ $child['nik'] }}</span>
                    <span>&bull;</span>
                    <span>{{ $child['age'] }}</span>
                    <span>&bull;</span>
                    <span>{{ $child['posyandu'] }}</span>
                    <span>&bull;</span>
                    <span>Kader {{ $child['kader'] }}</span>
                </div>
            </div>
        </div>
        <div class="text-right flex flex-col items-end">
            @php
                $badgeColors = [
                    'danger' => 'bg-rose-50 text-rose-700 border-rose-200',
                    'warning' => 'bg-amber-50 text-amber-700 border-amber-200',
                    'success' => 'bg-emerald-50 text-emerald-700 border-emerald-200'
                ];
                $color = $badgeColors[$child['statusType']] ?? $badgeColors['success'];
            @endphp
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold border {{ $color }}">
                <span class="w-1.5 h-1.5 rounded-full {{ str_replace(['bg-', '-50', '-100'], ['bg-', '-500', '-500'], explode(' ', $color)[0]) }}"></span>
                {{ mb_strtoupper($child['statusLabel']) }}
            </span>
            <span class="text-[9px] text-slate-400 font-bold mt-1.5 uppercase tracking-widest">{{ \Carbon\Carbon::parse($child['date'])->format('d M') }} {{ $child['time'] }}</span>
        </div>
    </div>
    
    <!-- Thin Clinical Alert -->
    <div class="mt-4 flex items-center gap-2 {{ $child['statusType'] === 'danger' ? 'bg-rose-50/50 border-rose-200 text-rose-800' : ($child['statusType'] === 'warning' ? 'bg-amber-50/50 border-amber-200 text-amber-800' : 'bg-emerald-50/50 border-emerald-200 text-emerald-800') }} border rounded-lg px-3 py-2 text-[11px]">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5 shrink-0">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
        </svg>
        <span class="font-medium">{{ $rekomendasi }}</span>
    </div>
</div>
