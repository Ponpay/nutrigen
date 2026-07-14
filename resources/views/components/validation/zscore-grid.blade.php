@props(['zscores'])

<div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
    <h3 class="text-xs font-bold text-slate-800 uppercase tracking-widest mb-4 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-slate-400">
            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
        </svg>
        Indikator Z-Score Saat Ini
    </h3>
    <div class="grid grid-cols-2 gap-3 sm:gap-4">
        @foreach($zscores as $key => $valData)
            <div class="bg-slate-50 border border-slate-100 rounded-xl p-3 relative overflow-hidden group">
                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ $key }}</span>
                <p class="text-xl font-extrabold text-{{ $valData['color'] }}-600 mt-0.5">{{ $valData['val'] }}</p>
                <span class="text-[10px] font-bold text-{{ $valData['color'] }}-700 bg-{{ $valData['color'] }}-100 px-1.5 py-0.5 rounded mt-1 inline-block">
                    {{ $valData['status'] }}
                </span>
            </div>
        @endforeach
    </div>
</div>
