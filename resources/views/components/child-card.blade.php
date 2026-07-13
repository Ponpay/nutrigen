@props(['balita'])

{{--
|--------------------------------------------------------------------------
| x-child-card
|--------------------------------------------------------------------------
| Expected $balita array shape (from controller or dummy data):
|   id          (int)    — used for route generation
|   name        (string) — child's full name
|   age         (string) — human-readable age, e.g. "2 Tahun 3 Bulan"
|   mother      (string) — mother's name
|   status      (string) — display label, e.g. "Stunting", "Normal"
|   status_type (string) — one of: 'danger' | 'warning' | 'success' | 'slate'
|   context_tag (string) — optional badge, e.g. "[!] Absen bulan lalu"
--}}

@php
    // Explicit color map — avoids Tailwind purge issues with interpolated class strings.
    // 'success' = Normal/Sudah Diukur, 'warning' = Gizi Kurang, 'danger' = Stunting
    $colorMap = [
        'success' => [
            'accent' => 'bg-emerald-500',
            'badge'  => 'bg-emerald-50 text-emerald-700 border-emerald-100',
            'dot'    => 'bg-emerald-500',
        ],
        'warning' => [
            'accent' => 'bg-amber-500',
            'badge'  => 'bg-amber-50 text-amber-700 border-amber-100',
            'dot'    => 'bg-amber-500',
        ],
        'danger' => [
            'accent' => 'bg-rose-500',
            'badge'  => 'bg-rose-50 text-rose-700 border-rose-100',
            'dot'    => 'bg-rose-500',
        ],
    ];

    $colors = $colorMap[$balita['status_type']] ?? [
        'accent' => 'bg-slate-500',
        'badge'  => 'bg-slate-50 text-slate-700 border-slate-100',
        'dot'    => 'bg-slate-500',
    ];
@endphp

<!-- Card Balita Compact -->
<div class="relative flex flex-col justify-between bg-white border border-slate-200 rounded-2xl p-4 shadow-sm hover:shadow-md hover:border-sky-200 transition-all duration-200 group overflow-hidden">
    
    <!-- Color Accent Left -->
    <div class="absolute left-0 top-0 bottom-0 w-1.5 {{ $colors['accent'] }}"></div>

    <!-- Top Content: Avatar & Info -->
    <div class="flex items-start gap-3 pl-2">
        <!-- Avatar -->
        <div class="w-10 h-10 rounded-full bg-slate-50 border border-slate-100 shadow-sm flex-shrink-0 flex items-center justify-center text-slate-400">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
            </svg>
        </div>
        
        <!-- Main Info -->
        <div class="flex flex-col flex-1">
            <span class="font-bold text-slate-900 text-base leading-tight mb-0.5">{{ $balita['name'] }}</span>
            <div class="flex items-center gap-1.5 text-sm text-slate-500 font-medium">
                <span>{{ $balita['age'] }}</span>
                <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                <span class="truncate">{{ $balita['mother'] }}</span>
            </div>
            
            <!-- Contextual Tag (e.g. Absen bulan lalu) — optional -->
            @if(isset($balita['context_tag']))
            <div class="mt-1">
                <span class="inline-block px-2 py-0.5 rounded-md bg-amber-100 text-amber-700 text-[10px] font-bold tracking-wide uppercase">
                    {{ $balita['context_tag'] }}
                </span>
            </div>
            @endif
        </div>
    </div>
    
    <!-- Bottom Content: Status Badge & CTAs -->
    <div class="mt-4 pt-3 border-t border-slate-100/80 flex items-center justify-between pl-2">
        
        <!-- Status Badge -->
        <div class="flex items-center gap-1.5 {{ $colors['badge'] }} px-2 py-1 rounded-md border">
            <div class="w-1.5 h-1.5 rounded-full {{ $colors['dot'] }}"></div>
            <span class="text-[10px] font-bold uppercase tracking-widest">{{ $balita['status'] }}</span>
        </div>

        <div class="flex items-center gap-1">
            <!-- View Profile -->
            <a href="{{ route('balita.show', $balita['id'] ?? '') }}" class="text-slate-500 font-bold text-sm px-3 py-1.5 hover:text-sky-600 transition-colors">
                Lihat
            </a>
            <!-- Primary Measure CTA -->
            <a href="{{ route('balita.show', ['id' => $balita['id'] ?? '', 'action' => 'ukur']) }}" class="flex items-center gap-1 bg-sky-500 hover:bg-sky-600 text-white font-bold text-sm px-4 py-2 rounded-full shadow-lg shadow-sky-500/20 transition-colors">
                UKUR
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
    </div>
</div>
