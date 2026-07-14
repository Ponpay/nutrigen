@props(['childId'])

<div class="border-t border-slate-200 p-4 lg:p-5 bg-white shrink-0 flex items-center justify-end gap-3 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] z-20 sticky bottom-0">
    <button type="button" class="btn-reject px-6 py-2.5 rounded-lg text-rose-600 bg-white border border-slate-200 font-bold hover:bg-rose-50 hover:border-rose-200 transition-colors focus:ring-4 focus:ring-rose-100 shadow-sm flex items-center justify-center w-full sm:w-auto" data-id="{{ $childId }}">
        <span>Tolak</span>
    </button>
    <button type="button" class="btn-approve px-8 py-2.5 rounded-lg bg-teal-600 text-white font-bold hover:bg-teal-700 shadow-sm transition-transform lg:hover:-translate-y-0.5 focus:ring-4 focus:ring-teal-200 flex items-center justify-center gap-2 group w-full sm:w-auto" data-id="{{ $childId }}">
        <svg class="icon-approve w-4 h-4 group-hover:scale-110 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
        </svg>
        <!-- Spinner (Hidden default) -->
        <svg class="spinner-approve animate-spin -ml-1 mr-2 h-4 w-4 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <span class="text-approve">Approve Data</span>
    </button>
</div>
