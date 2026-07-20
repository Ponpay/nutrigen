@props(['distribution', 'topBerisiko' => []])

@php
    $pctNormal = $distribution['pct_normal'] ?? 0;
    $pctStunting = $distribution['pct_stunting'] ?? 0;
    
    // Normal starts at 0. Stunting starts after Normal
    $stuntingOffset = -$pctNormal;
    $totalDiukur = ($distribution['normal'] ?? 0) + ($distribution['stunting'] ?? 0);
@endphp

<div class="w-full h-full flex flex-col">
    <div class="px-6 py-5 border-b border-slate-100 flex flex-col justify-center bg-white shrink-0">
        <h3 class="font-extrabold text-slate-800 text-[15px]">Ringkasan Status Gizi</h3>
        <p class="text-[12px] text-slate-500 mt-1">Distribusi status gizi dari total yang diukur</p>
    </div>
    
    <div class="flex-1 p-6 flex flex-col justify-center items-center">
        <!-- Donut Container -->
        <div class="relative w-40 h-40 shrink-0 mb-6">
            <svg viewBox="0 0 36 36" class="w-full h-full transform -rotate-90">
                <!-- Background Ring (Optional, if we want full circle) -->
                <path class="text-slate-100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="4"></path>
                <!-- Normal -->
                <path class="text-emerald-500 transition-all duration-1000 ease-out" stroke-dasharray="{{ $pctNormal }}, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="4"></path>
                <!-- Berisiko -->
                <path class="text-rose-500 transition-all duration-1000 ease-out" stroke-dasharray="{{ $pctStunting }}, 100" stroke-dashoffset="{{ $stuntingOffset }}" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="4"></path>
            </svg>
            <!-- Inner Text -->
            <div class="absolute inset-0 flex flex-col items-center justify-center">
                <span class="text-3xl font-extrabold text-slate-800">{{ number_format($totalDiukur) }}</span>
                <span class="text-[10px] font-medium text-slate-500 mt-1">Total Diukur</span>
            </div>
        </div>

        <!-- Legend -->
        <div class="flex flex-col gap-4 w-full px-2">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="w-2.5 h-2.5 rounded-full bg-emerald-500"></div>
                    <span class="text-[13px] font-bold text-slate-700">Normal</span>
                </div>
                <div class="text-[13px] font-medium text-slate-500">
                    <span class="font-extrabold text-slate-800 mr-1">{{ $distribution['normal'] ?? 0 }}</span>
                    ({{ $pctNormal }}%)
                </div>
            </div>
            
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="w-2.5 h-2.5 rounded-full bg-rose-500"></div>
                    <span class="text-[13px] font-bold text-slate-700">Berisiko</span>
                </div>
                <div class="text-[13px] font-medium text-slate-500">
                    <span class="font-extrabold text-slate-800 mr-1">{{ $distribution['stunting'] ?? 0 }}</span>
                    ({{ $pctStunting }}%)
                </div>
            </div>
        </div>
    </div>
    
    <div class="p-6 pt-0 shrink-0">
        <div class="flex items-start gap-2 bg-blue-50/50 p-3 rounded-xl border border-blue-100/50">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-blue-500 shrink-0 mt-0.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
            </svg>
            <p class="text-[11px] font-medium text-slate-500 leading-relaxed">
                Persentase dihitung dari total sasaran. <br>
                Bukan dari total yang diukur.
            </p>
        </div>
    </div>
</div>
