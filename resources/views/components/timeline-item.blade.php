@props(['measurement', 'isLast' => false])

{{--
|--------------------------------------------------------------------------
| x-timeline-item
|--------------------------------------------------------------------------
| Expected $measurement array shape (from $measurements collection):
|   date         (string) — formatted date, e.g. "10 Mei 2026"
|   weight       (float)  — weight in kg
|   weight_trend (float)  — delta from previous measurement (positive = gain)
|   height       (float)  — height in cm
|   head_circ    (float)  — head circumference in cm
|   status       (string) — display label, e.g. "Normal", "Kurang"
|   status_type  (string) — one of: 'success' | 'warning' | 'danger'
|   isLast       (bool)   — hides the connecting timeline line for the last item
--}}

@php
    // Explicit color map — avoids Tailwind purge issues with string interpolation.
    $colorMap = [
        'success' => ['node' => 'bg-emerald-500', 'badge' => 'bg-emerald-50 text-emerald-700 border-emerald-100'],
        'warning' => ['node' => 'bg-amber-500',   'badge' => 'bg-amber-50 text-amber-700 border-amber-100'],
        'danger'  => ['node' => 'bg-rose-500',    'badge' => 'bg-rose-50 text-rose-700 border-rose-100'],
    ];

    $colors = $colorMap[$measurement['status_type']] ?? [
        'node'  => 'bg-slate-300',
        'badge' => 'bg-slate-50 text-slate-600 border-slate-100',
    ];
@endphp

<div class="relative pl-6 pb-6">
    <!-- Timeline Line (hidden for last item) -->
    @unless($isLast)
        <div class="absolute left-[9px] top-4 bottom-0 w-0.5 bg-slate-200"></div>
    @endunless
    
    <!-- Timeline Node -->
    <div class="absolute left-0 top-1.5 w-5 h-5 rounded-full border-[3px] border-white shadow-sm flex items-center justify-center {{ $colors['node'] }}"></div>
    
    <!-- Content Card -->
    <div class="bg-white border border-slate-200 rounded-2xl p-3 shadow-sm hover:border-sky-200 transition-colors">
        <div class="flex justify-between items-center mb-2">
            <span class="font-extrabold text-slate-800 text-sm">{{ $measurement['date'] }}</span>
            <div class="flex items-center gap-1 {{ $colors['badge'] }} px-2 py-0.5 rounded border">
                <span class="text-[10px] font-bold uppercase tracking-wider">{{ $measurement['status'] }}</span>
            </div>
        </div>
        
        <div class="flex items-center gap-4 text-xs font-medium text-slate-600">
            <!-- BB -->
            <div class="flex flex-col">
                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">BB</span>
                <span class="flex items-center gap-1">
                    {{ $measurement['weight'] }}kg
                    @if(isset($measurement['weight_trend']) && $measurement['weight_trend'] > 0)
                        <span class="text-emerald-500 font-bold text-[10px] flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3"><path fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z" clip-rule="evenodd" /></svg>
                            {{ $measurement['weight_trend'] }}
                        </span>
                    @elseif(isset($measurement['weight_trend']) && $measurement['weight_trend'] < 0)
                        <span class="text-rose-500 font-bold text-[10px] flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3"><path fill-rule="evenodd" d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z" clip-rule="evenodd" /></svg>
                            {{ abs($measurement['weight_trend']) }}
                        </span>
                    @endif
                </span>
            </div>
            
            <!-- TB -->
            <div class="flex flex-col border-l border-slate-200 pl-4">
                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">TB</span>
                <span>{{ $measurement['height'] }}cm</span>
            </div>

            <!-- LK -->
            <div class="flex flex-col border-l border-slate-200 pl-4">
                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">LK</span>
                <span>{{ $measurement['head_circ'] }}cm</span>
            </div>
        </div>
    </div>
</div>
