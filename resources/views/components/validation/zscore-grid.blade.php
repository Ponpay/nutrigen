@props(['zscores'])

<div class="grid grid-cols-2 md:grid-cols-5 gap-3 lg:gap-4">
    @foreach($zscores as $key => $valData)
        <div class="bg-white border border-slate-200 rounded-xl p-3 lg:p-4 flex flex-col items-center justify-center text-center shadow-sm hover:border-cyan-200 hover:shadow-sm border border-slate-200/60 transition-all">
            <span class="block text-xs font-bold text-slate-500 mb-1.5">{{ $key }}</span>
            <p class="text-[22px] lg:text-2xl font-black text-slate-800 leading-none mb-2.5">{{ $valData['val'] }}</p>
            
            @php
                $isNormal = str_contains(strtolower($valData['status']), 'normal');
                $badgeBg = $isNormal ? 'bg-emerald-50/80' : 'bg-rose-50';
                $badgeText = $isNormal ? 'text-emerald-600' : 'text-rose-600';
                $displayText = $isNormal ? '< Normal' : $valData['status'];
            @endphp
            
            <span class="text-[10px] font-bold px-2 py-0.5 rounded-md {{ $badgeBg }} {{ $badgeText }}">
                {{ $displayText }}
            </span>
        </div>
    @endforeach
</div>
