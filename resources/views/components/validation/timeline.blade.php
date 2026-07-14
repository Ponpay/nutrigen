@props(['history'])

<div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
    <h3 class="text-xs font-bold text-slate-800 uppercase tracking-widest mb-4 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-slate-400">
            <path fill-rule="evenodd" d="M12 2.25v1.5a.75.75 0 01-1.5 0V2.25H9v1.5a.75.75 0 01-1.5 0V2.25H6v1.5a.75.75 0 01-1.5 0V2.25H3v19.5h18V2.25h-1.5v1.5a.75.75 0 01-1.5 0V2.25h-1.5v1.5a.75.75 0 01-1.5 0V2.25h-1.5zM7.5 12a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm4.5 0a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm4.5 0a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm-9 4.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm4.5 0a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm4.5 0a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" clip-rule="evenodd" />
        </svg>
        Histori Pengukuran Sebelumnya
    </h3>
    
    <div class="relative pl-4 border-l-2 border-slate-200 flex flex-col gap-5">
        @foreach($history as $h)
            <div class="relative">
                <div class="absolute -left-[21px] top-1.5 w-2.5 h-2.5 rounded-full bg-slate-300 ring-4 ring-white"></div>
                <div class="bg-slate-50 border border-slate-100 rounded-xl p-3">
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-xs font-bold text-slate-700">{{ $h['month'] }} 2025</span>
                        <span class="text-[10px] font-bold text-emerald-600 bg-emerald-100 px-1.5 py-0.5 rounded">{{ $h['status'] }}</span>
                    </div>
                    <p class="text-xs text-slate-500 font-medium">BB: {{ $h['bb'] }} &bull; TB: {{ $h['tb'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
