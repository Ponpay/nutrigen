@props([
    'child',
    'isActive' => false
])

@php
    $initials = collect(explode(' ', $child['name']))->map(fn($n) => substr($n, 0, 1))->take(2)->join('');
    // Visual styles for queue card states
    $activeStyles = 'border-sky-300 border-l-[4px] border-l-sky-500 bg-sky-50/60 shadow-sm z-10 rounded-sm -mx-px';
    $inactiveStyles = 'border-transparent border-b-slate-100 bg-white hover:bg-slate-50 hover:border-slate-200 hover:shadow-sm border-l-[4px] border-l-transparent';
@endphp

<button type="button" 
    data-validation-id="{{ $child['id'] }}"
    class="validation-card-btn w-full text-left px-3 py-2 border transition-all duration-200 cursor-pointer focus:outline-none flex gap-3 relative
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
    <div class="flex-1 min-w-0 flex flex-col justify-center">
        <!-- Top Row: Name & Priority Badge -->
        <div class="flex items-center gap-2 mb-0.5">
            <h4 class="font-bold truncate text-xs text-slate-900 validation-card-name max-w-[140px]">
                {{ $child['name'] }}
            </h4>
            <div class="shrink-0">
                <x-status-badge :type="$child['statusType']" :label="$child['statusLabel']" />
            </div>
        </div>
        
        <!-- Main Indicator -->
        <div class="mb-0.5">
            <span class="text-[10px] font-bold {{ $child['statusType'] === 'warning' ? 'text-amber-700' : 'text-rose-700' }}">
                {{ $child['indicator'] }}: {{ $child['value'] }}
            </span>
        </div>

        <!-- Meta Info -->
        <div class="text-[9px] text-slate-500 font-medium truncate">
            {{ $child['age'] }} &bull; {{ $child['posyandu'] }} &bull; {{ $child['kader'] }} &bull; {{ $child['time'] }}
        </div>
    </div>
</button>
