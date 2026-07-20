@props(['zscores'])

<div class="flex flex-col h-full">
    <div class="grid grid-cols-2 gap-3 h-full">
        @foreach($zscores as $key => $valData)
            <div class="bg-white border border-slate-200 rounded-lg p-3 flex flex-col justify-center">
                <div class="flex items-start justify-between">
                    <div>
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $key }}</span>
                        <p class="text-2xl font-black text-slate-800 leading-none mt-1 tracking-tight">{{ $valData['val'] }}</p>
                    </div>
                    <span class="text-[9px] font-bold text-{{ $valData['color'] }}-700 bg-{{ $valData['color'] }}-50 border border-{{ $valData['color'] }}-100 px-1.5 py-0.5 rounded uppercase tracking-wider">
                        {{ $valData['status'] }}
                    </span>
                </div>
            </div>
        @endforeach
    </div>
    
    <!-- Interpretasi Klinis -->
    <div class="mt-4 bg-sky-50/50 border border-sky-100 rounded-lg p-3">
        <div class="flex items-start gap-2 text-sky-800">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 shrink-0 mt-0.5 text-sky-600">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
            </svg>
            <div>
                <p class="text-[11px] font-bold">Interpretasi</p>
                <p class="text-[11px] mt-0.5 leading-relaxed">
                    @php
                        $tbu = collect($zscores)->firstWhere(fn($val, $key) => $key === 'TB/U')['val'] ?? 0;
                        if ((float)$tbu < -2) {
                            echo "Tinggi badan menurut umur dalam kategori Pendek. Disarankan pemantauan gizi dan stimulasi pertumbuhan.";
                        } else {
                            echo "Indikator pertumbuhan dalam batas normal.";
                        }
                    @endphp
                </p>
            </div>
        </div>
    </div>
</div>
