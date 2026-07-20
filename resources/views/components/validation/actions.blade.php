@props(['childId'])

<div class="border-t border-slate-200 bg-white shrink-0 z-30 sticky bottom-0 w-full px-4 lg:px-6 py-3 h-auto">
    <div class="flex flex-col lg:flex-row items-stretch lg:items-start gap-3 lg:gap-4 w-full">
        <!-- Catatan Validator -->
        <div class="flex-1 relative">
            <span class="absolute right-3 bottom-3 text-[10px] font-bold text-slate-400">0 / 200 karakter</span>
            <textarea 
                class="w-full bg-slate-50 border border-slate-200 text-slate-700 text-xs rounded-xl px-4 py-3 pb-6 focus:ring-1 focus:ring-teal-500 focus:border-teal-500 transition-colors font-medium placeholder-slate-400 resize-none leading-relaxed outline-none" 
                rows="3" 
                placeholder="Catatan Validator (Opsional)..."></textarea>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center gap-3 shrink-0 h-[56px] lg:h-[80px] w-full lg:w-auto">
            <button type="button" class="btn-reject h-full px-4 lg:px-6 rounded-xl text-rose-600 bg-white border border-rose-200 hover:bg-rose-50 transition-colors focus:ring-2 focus:ring-rose-100 flex flex-col items-center justify-center gap-0.5 flex-1 lg:flex-none lg:w-48 outline-none" data-id="{{ $childId }}">
                <div class="flex items-center gap-2 font-bold text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span>Tolak Data</span>
                </div>
                <span class="text-[10px] text-rose-400 font-medium">Perlu diperbaiki</span>
            </button>
            <button type="button" class="btn-approve h-full px-4 lg:px-6 rounded-xl bg-teal-700 text-white hover:bg-teal-800 transition-colors focus:ring-2 focus:ring-teal-200 flex flex-col items-center justify-center gap-0.5 group flex-1 lg:flex-none lg:w-56 outline-none" data-id="{{ $childId }}">
                <div class="flex items-center gap-2 font-bold text-sm">
                    <svg class="icon-approve w-4 h-4 group-hover:scale-110 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    <!-- Spinner (Hidden default) -->
                    <svg class="spinner-approve animate-spin -ml-1 mr-2 h-4 w-4 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="text-approve">Setujui Data</span>
                </div>
                <span class="text-[10px] text-teal-200 font-medium">Data valid & lanjut ke laporan</span>
            </button>
        </div>
    </div>
</div>
