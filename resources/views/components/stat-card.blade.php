@props(['color' => 'blue', 'title', 'value'])

@php
    $bgClass = '';
    $iconColorClass = '';
    $titleColorClass = 'text-slate-600';
    $valueColorClass = 'text-slate-900';
    $shadowClass = 'shadow-sm';

    switch($color) {
        case 'emerald':
            $bgClass = 'bg-gradient-to-br from-emerald-50 to-emerald-100/80 border border-emerald-200/60';
            $iconColorClass = 'text-emerald-700 bg-white shadow-sm ring-1 ring-emerald-200';
            $titleColorClass = 'text-emerald-800';
            $valueColorClass = 'text-emerald-950';
            break;
        case 'blue':
            $bgClass = 'bg-gradient-to-br from-blue-50 to-blue-100/80 border border-blue-200/60';
            $iconColorClass = 'text-blue-700 bg-white shadow-sm ring-1 ring-blue-200';
            $titleColorClass = 'text-blue-800';
            $valueColorClass = 'text-blue-950';
            break;
        case 'amber':
            $bgClass = 'bg-gradient-to-br from-amber-50 to-amber-100/80 border border-amber-200/60';
            $iconColorClass = 'text-amber-700 bg-white shadow-sm ring-1 ring-amber-200';
            $titleColorClass = 'text-amber-800';
            $valueColorClass = 'text-amber-950';
            break;
        case 'rose':
            $bgClass = 'bg-gradient-to-br from-rose-50 to-rose-100/80 border border-rose-200/60';
            $iconColorClass = 'text-rose-700 bg-white shadow-sm ring-1 ring-rose-200';
            $titleColorClass = 'text-rose-800';
            $valueColorClass = 'text-rose-950';
            break;
        default:
            $bgClass = 'bg-gradient-to-br from-slate-50 to-slate-100/80 border border-slate-200/60';
            $iconColorClass = 'text-slate-700 bg-white shadow-sm ring-1 ring-slate-200';
            $titleColorClass = 'text-slate-800';
            $valueColorClass = 'text-slate-950';
            break;
    }
@endphp

<div class="{{ $bgClass }} rounded-[1.25rem] p-4 lg:p-5 flex flex-col shadow-sm relative overflow-hidden group hover:shadow-md transition-shadow duration-300 h-full">
    <!-- Subtle glow overlay on hover -->
    <div class="absolute inset-0 bg-white/40 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>

    <div class="p-2 rounded-xl {{ $iconColorClass }} self-start z-10 shrink-0 mb-3">
        {{ $slot }}
    </div>
    
    <div class="z-10 flex flex-col flex-1">
        <span class="text-[11px] font-black {{ $titleColorClass }} tracking-wider uppercase leading-snug mb-2 break-words">{{ $title }}</span>
        
        <div class="mt-auto flex flex-col">
            <span class="text-3xl lg:text-4xl font-black {{ $valueColorClass }} tracking-tight leading-none">{{ $value }}</span>
            
            @if(isset($subtext))
                <div class="text-[11px] text-slate-500 font-medium mt-2">
                    {{ $subtext }}
                </div>
            @endif
        </div>
    </div>
</div>
