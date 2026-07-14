@props(['color' => 'blue', 'title', 'value'])

@php
    $bgClass = 'bg-white';
    $borderClass = 'border-slate-200';
    $iconColorClass = '';
    $titleColorClass = 'text-slate-600';
    $valueColorClass = 'text-slate-900';
    $accentColorClass = '';

    switch($color) {
        case 'emerald':
            $iconColorClass = 'text-emerald-500 bg-emerald-50';
            $accentColorClass = 'border-l-emerald-500';
            break;
        case 'blue':
            $iconColorClass = 'text-blue-500 bg-blue-50';
            $accentColorClass = 'border-l-blue-500';
            break;
        case 'amber':
            $iconColorClass = 'text-amber-500 bg-amber-50';
            $accentColorClass = 'border-l-amber-500';
            break;
        case 'rose':
            $iconColorClass = 'text-rose-500 bg-rose-50';
            $accentColorClass = 'border-l-rose-500';
            break;
        default:
            $iconColorClass = 'text-slate-500 bg-slate-100';
            $accentColorClass = 'border-l-slate-400';
            break;
    }
@endphp

<div class="{{ $bgClass }} border {{ $borderClass }} border-l-[3px] {{ $accentColorClass }} rounded-xl p-4 lg:p-5 flex flex-col gap-1 shadow-sm relative overflow-hidden group hover:shadow-md transition-shadow">
    <div class="flex items-center gap-3 z-10 mb-2">
        <div class="p-2 rounded-lg {{ $iconColorClass }} shrink-0 group-hover:scale-110 transition-transform">
            {{ $slot }}
        </div>
        <span class="text-[10px] font-bold {{ $titleColorClass }} tracking-wider uppercase leading-snug">{{ $title }}</span>
    </div>
    <span class="text-3xl font-extrabold {{ $valueColorClass }} z-10">{{ $value }}</span>
</div>
