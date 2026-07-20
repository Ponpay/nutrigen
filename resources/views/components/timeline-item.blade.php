@props(['measurement', 'isLast' => false])

{{--
|--------------------------------------------------------------------------
| x-timeline-item
|--------------------------------------------------------------------------
| Expected $measurement array shape (from $measurements collection):
|   date         (string) — formatted date, e.g. "10 Mei 2026"
|   weight       (float)  — weight in kg
|   weight_trend (float)  — delta from previous measurement (positive = gain)
|   height       (float)  — height in cm
|   head_circ    (float)  — head circumference in cm
|   status       (string) — display label, e.g. "Normal", "Kurang"
|   status_type  (string) — one of: 'success' | 'warning' | 'danger'
|   isLast       (bool)   — hides the connecting timeline line for the last item
--}}

@php
    // Explicit color map — avoids Tailwind purge issues with string interpolation.
    $colorMap = [
        'success' => ['node' => 'bg-emerald-500', 'badge' => 'bg-emerald-50 text-emerald-700 border-emerald-100'],
        'warning' => ['node' => 'bg-amber-500',   'badge' => 'bg-amber-50 text-amber-700 border-amber-100'],
        'danger'  => ['node' => 'bg-rose-500',    'badge' => 'bg-rose-50 text-rose-700 border-rose-100'],
    ];

    $colors = $colorMap[$measurement['status_type']] ?? [
        'node'  => 'bg-slate-300',
        'badge' => 'bg-slate-50 text-slate-600 border-slate-100',
    ];
@endphp

<div class="relative pl-6 pb-6">
    <!-- Timeline Line (hidden for last item) -->
    @unless($isLast)
        <div class="absolute left-[9px] top-4 bottom-0 w-0.5 bg-slate-200"></div>
    @endunless
    
    <!-- Timeline Node -->
    <div class="absolute left-0 top-1.5 w-5 h-5 rounded-full border-[3px] border-white shadow-sm flex items-center justify-center {{ $colors['node'] }}"></div>
    
    <!-- Content Card -->
    <div class="bg-white border border-slate-200 rounded-2xl p-3 shadow-sm hover:border-sky-200 transition-colors">
        <div class="flex justify-between items-center mb-2">
            <span class="font-extrabold text-slate-800 text-sm">{{ $measurement['date'] }}</span>
            <div class="flex items-center gap-1.5">
                <div class="flex items-center gap-1 {{ $colors['badge'] }} px-2 py-0.5 rounded border">
                    <span class="text-[10px] font-bold uppercase tracking-wider">{{ $measurement['status'] }}</span>
                </div>
                
                @if(isset($measurement['status_validasi']))
                    @php
                        $valColors = match($measurement['status_validasi']) {
                            'pending' => 'bg-amber-50 text-amber-700 border-amber-200/60',
                            'approved' => 'bg-emerald-50 text-emerald-700 border-emerald-200/60',
                            'rejected' => 'bg-rose-50 text-rose-700 border-rose-200/60',
                            default => 'bg-slate-50 text-slate-700 border-slate-200/60'
                        };
                        $valIcon = match($measurement['status_validasi']) {
                            'pending' => '⏳',
                            'approved' => '✔',
                            'rejected' => '✖',
                            default => ''
                        };
                    @endphp
                    <div class="flex items-center gap-1 {{ $valColors }} border px-2 py-0.5 rounded">
                        <span class="text-[10px] leading-none">{{ $valIcon }}</span>
                        <span class="text-[10px] font-bold uppercase tracking-wider">{{ $measurement['status_validasi'] }}</span>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="flex items-center gap-4 text-xs font-medium text-slate-600">
            <!-- BB -->
            <div class="flex flex-col">
                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">BB</span>
                <span class="flex items-center gap-1">
                    {{ $measurement['weight'] }}kg
                    @if(isset($measurement['weight_trend']) && $measurement['weight_trend'] > 0)
                        <span class="text-emerald-500 font-bold text-[10px] flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3"><path fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z" clip-rule="evenodd" /></svg>
                            {{ $measurement['weight_trend'] }}
                        </span>
                    @elseif(isset($measurement['weight_trend']) && $measurement['weight_trend'] < 0)
                        <span class="text-rose-500 font-bold text-[10px] flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3"><path fill-rule="evenodd" d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z" clip-rule="evenodd" /></svg>
                            {{ abs($measurement['weight_trend']) }}
                        </span>
                    @endif
                </span>
            </div>
            
            <!-- TB -->
            <div class="flex flex-col border-l border-slate-200 pl-4">
                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">TB</span>
                <span>{{ $measurement['height'] }}cm</span>
            </div>

            <!-- LK -->
            <div class="flex flex-col border-l border-slate-200 pl-4">
                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">LK</span>
                <span>{{ $measurement['head_circ'] ?? '-' }}cm</span>
            </div>
        </div>

        @if(isset($measurement['status_validasi']) && $measurement['status_validasi'] === 'rejected')
            <!-- Rejection Alert -->
            <div class="mt-4 p-3 bg-rose-50 border border-rose-200 rounded-xl relative overflow-hidden">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-rose-500"></div>
                <div class="flex items-start gap-3 pl-1">
                    <svg class="w-5 h-5 text-rose-500 mt-0.5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <div class="flex-1">
                        <span class="text-[12px] font-bold text-rose-700 block mb-1">Ditolak oleh Puskesmas:</span>
                        <p class="text-[13px] text-rose-600 leading-relaxed font-medium">{{ $measurement['catatan_validator'] ?? 'Tidak ada catatan khusus.' }}</p>
                    </div>
                </div>
                <div class="mt-3 flex justify-end">
                    <button type="button" onclick="document.getElementById('editModal-{{ $measurement['id'] }}').classList.remove('hidden')" class="px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white text-[12px] font-bold rounded-lg shadow-sm transition-colors flex items-center gap-2 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" /></svg>
                        Revisi Pengukuran
                    </button>
                </div>
            </div>

            <!-- Edit Modal for this specific measurement -->
            <div id="editModal-{{ $measurement['id'] }}" class="fixed inset-0 z-[110] hidden opacity-100 transition-opacity duration-300">
                <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="document.getElementById('editModal-{{ $measurement['id'] }}').classList.add('hidden')"></div>
                <div class="absolute inset-0 flex items-center justify-center p-4 md:p-6 pointer-events-none">
                    <div class="w-full max-w-lg bg-white rounded-2xl sm:rounded-[24px] shadow-2xl flex flex-col pointer-events-auto overflow-hidden">
                        
                        <div class="px-6 pt-6 pb-4 border-b border-slate-100 flex items-center justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-slate-800">Revisi Pengukuran</h3>
                                <p class="text-sm text-slate-500 mt-1">Perbaiki data sesuai arahan Puskesmas</p>
                            </div>
                            <button type="button" onclick="document.getElementById('editModal-{{ $measurement['id'] }}').classList.add('hidden')" class="p-2 -mr-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-full transition-colors focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                        
                        <div class="p-6">
                            <form action="{{ route('pengukuran.update', $measurement['id']) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="flex flex-col gap-1.5 sm:col-span-2">
                                        <label class="text-sm font-semibold text-slate-700">Tanggal Pengukuran</label>
                                        <input type="date" name="tanggal_ukur" value="{{ $measurement['raw_date'] ?? '' }}" required class="w-full h-12 bg-slate-50 border border-slate-200 focus:border-rose-500 focus:ring-1 focus:ring-rose-500 rounded-xl px-4 text-sm font-medium text-slate-800 transition-all outline-none">
                                    </div>
                                    
                                    <div class="flex flex-col gap-1.5">
                                        <label class="text-sm font-semibold text-slate-700">Berat Badan (kg)</label>
                                        <input type="number" step="any" name="berat_badan" value="{{ $measurement['weight'] }}" required class="w-full h-12 bg-slate-50 border border-slate-200 focus:border-rose-500 focus:ring-1 focus:ring-rose-500 rounded-xl px-4 text-sm font-medium text-slate-800 transition-all outline-none">
                                    </div>
                                    
                                    <div class="flex flex-col gap-1.5">
                                        <label class="text-sm font-semibold text-slate-700">Tinggi Badan (cm)</label>
                                        <input type="number" step="any" name="tinggi_badan" value="{{ $measurement['height'] }}" required class="w-full h-12 bg-slate-50 border border-slate-200 focus:border-rose-500 focus:ring-1 focus:ring-rose-500 rounded-xl px-4 text-sm font-medium text-slate-800 transition-all outline-none">
                                    </div>
                                </div>
                                
                                <div class="mt-6 flex justify-end gap-3">
                                    <button type="button" onclick="document.getElementById('editModal-{{ $measurement['id'] }}').classList.add('hidden')" class="px-5 py-2.5 text-sm font-semibold text-slate-600 hover:text-slate-800 hover:bg-slate-100 rounded-xl transition-colors focus:outline-none">Batal</button>
                                    <button type="submit" class="px-6 py-2.5 bg-rose-600 hover:bg-rose-700 text-white rounded-xl font-semibold text-sm shadow-sm hover:shadow-md transition-all focus:outline-none">Simpan Perbaikan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
