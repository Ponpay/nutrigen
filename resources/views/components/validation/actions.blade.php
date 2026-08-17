@props(['childId'])

<div class="mt-auto shrink-0 w-full lg:w-3/4 mx-auto pt-6 flex flex-col sm:flex-row items-center gap-4 pb-6">
    <!-- Action Buttons -->
    <button type="button" class="btn-reject h-[48px] lg:h-[56px] min-h-[44px] text-sm rounded-xl text-rose-500 bg-white border-2 border-rose-100 hover:bg-rose-50 hover:border-rose-300 transition-colors focus:ring-4 focus:ring-rose-50 flex flex-col items-center justify-center gap-1 flex-1 w-full outline-none" data-id="{{ $childId }}">
        <div class="flex items-center gap-2 font-black text-sm lg:text-base">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4 lg:w-5 lg:h-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <span>Tolak Data</span>
        </div>
        <span class="text-[11px] text-rose-400 font-medium">Perlu diperbaiki</span>
    </button>
    <button type="button" class="btn-approve h-[48px] lg:h-[56px] min-h-[44px] text-sm rounded-xl bg-[#00A9C0] text-white hover:bg-cyan-600 transition-colors focus:ring-4 focus:ring-cyan-100 flex flex-col items-center justify-center gap-1 group flex-1 w-full outline-none shadow-sm" data-id="{{ $childId }}">
        <div class="flex items-center gap-2 font-black text-sm lg:text-base">
            <svg class="icon-approve w-4 h-4 lg:w-5 lg:h-5 group-hover:scale-110 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
            </svg>
            <!-- Spinner (Hidden default) -->
            <svg class="spinner-approve animate-spin -ml-1 mr-2 h-4 w-4 lg:h-5 lg:w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="text-approve">Setujui Data</span>
        </div>
        <span class="text-[11px] text-cyan-100 font-medium">Data valid & lanjut ke laporan</span>
    </button>
</div>
