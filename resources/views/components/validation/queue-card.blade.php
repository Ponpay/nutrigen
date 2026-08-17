@props([
    'child',
    'isActive' => false
])

@php
    $initials = collect(explode(' ', $child['name']))->map(fn($n) => substr($n, 0, 1))->take(2)->join('');
    // Clean list-item styles (no stacked cards)
    $activeStyles = 'bg-[#F2FBFC] border-l-[6px] border-l-[#00A9C0] z-10';
    $inactiveStyles = 'bg-white hover:bg-slate-50 border-l-[6px] border-l-transparent';
@endphp

<button type="button" 
    data-validation-id="{{ $child['id'] }}"
    class="validation-card-btn w-full text-left px-3 py-3 border-b border-slate-100 transition-colors duration-200 cursor-pointer focus:outline-none flex gap-3 relative
    {{ $isActive ? $activeStyles : $inactiveStyles }}">
    
    <!-- Photo / Avatar -->
    <div class="shrink-0 mt-0.5">
        @if(isset($child['photo']) && $child['photo'])
            <img src="{{ $child['photo'] }}" alt="{{ $child['name'] }}" class="w-8 h-8 rounded-full object-cover ring-1 ring-slate-200">
        @else
            <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center font-bold text-[10px] ring-1 ring-slate-200">
                {{ strtoupper($initials) }}
            </div>
        @endif
    </div>

    <!-- Content -->
    <div class="flex-1 min-w-0 flex items-center justify-between">
        <div class="flex flex-col justify-center min-w-0 pr-2">
            <h4 class="font-bold tracking-tight truncate text-[13px] text-slate-800 validation-card-name mb-0.5">
                {{ $child['name'] }}
            </h4>
            <div class="text-[10px] text-slate-500 font-medium truncate">
                {{ $child['age'] }} &bull; {{ $child['posyandu'] }} &bull; {{ $child['kader'] }}
            </div>
        </div>
        
        <div class="flex items-center gap-2 shrink-0">
            <x-status-badge :type="$child['statusType']" :label="$child['statusLabel']" />
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-slate-400">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
        </div>
    </div>
</button>
