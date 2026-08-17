@props(['measurement', 'isLast' => false, 'isLatest' => false])

{{--
|--------------------------------------------------------------------------
| x-timeline-item
|--------------------------------------------------------------------------
| Expected $measurement array shape:
|   date           (string) — formatted date, e.g. "10 Mei 2026"
|   age_at_measure (string) — e.g. "1 Thn 11 Bln" or "23 Bulan"
|   weight         (float)  — weight in kg
|   weight_trend   (float)  — delta from previous measurement (positive = gain)
|   height         (float)  — height in cm
|   height_trend   (float)  — delta from previous measurement
|   z_score_bbu    (float)  — Z-score BB/U
|   z_score_tbu    (float)  — Z-score TB/U
|   head_circ      (float)  — head circumference in cm
|   status         (string) — display label, e.g. "Normal", "Risiko Stunting"
|   status_type    (string) — 'success' | 'warning' | 'danger'
|   status_validasi (string) — 'approved' | 'pending' | 'rejected'
|   catatan_validator (string)
|   isLast         (bool)   — hides connecting timeline line
|   isLatest       (bool)   — highlights latest measurement
--}}

@php
    $colorMap = [
        'success' => [
            'ring'   => 'border-emerald-500 text-emerald-500',
            'dot'    => 'bg-emerald-500',
            'badge'  => 'bg-emerald-50 text-emerald-700 border-emerald-200/60',
        ],
        'warning' => [
            'ring'   => 'border-amber-500 text-amber-500',
            'dot'    => 'bg-amber-500',
            'badge'  => 'bg-amber-50 text-amber-700 border-amber-200/60',
        ],
        'danger'  => [
            'ring'   => 'border-rose-500 text-rose-500',
            'dot'    => 'bg-rose-500',
            'badge'  => 'bg-rose-50 text-rose-700 border-rose-200/60',
        ],
    ];

    $colors = $colorMap[$measurement['status_type']] ?? [
        'ring'  => 'border-slate-400 text-slate-400',
        'dot'   => 'bg-slate-400',
        'badge' => 'bg-slate-50 text-slate-600 border-slate-200',
    ];

    $statusValidasi = $measurement['status_validasi'] ?? 'pending';
    $valConfig = match($statusValidasi) {
        'approved' => [
            'badge' => 'bg-emerald-50 text-emerald-700 border-emerald-200/60',
            'label' => 'Terverifikasi Puskesmas',
            'icon'  => '<svg class="w-3.5 h-3.5 text-emerald-600 shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg>'
        ],
        'rejected' => [
            'badge' => 'bg-rose-50 text-rose-700 border-rose-200/60',
            'label' => 'Perlu Revisi',
            'icon'  => '<svg class="w-3.5 h-3.5 text-rose-600 shrink-0" viewBox="0 0 20 20" fill="currentColor"><path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" /></svg>'
        ],
        default => [
            'badge' => 'bg-amber-50 text-amber-700 border-amber-200/60',
            'label' => 'Menunggu Validasi',
            'icon'  => '<svg class="w-3.5 h-3.5 text-amber-600 shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z" clip-rule="evenodd" /></svg>'
        ]
    };
@endphp

<div class="relative pl-8 sm:pl-10 pb-6 group">
    <!-- Timeline Track Line -->
    @unless($isLast)
        <div class="absolute left-[13px] sm:left-[15px] top-7 bottom-0 w-[2px] bg-slate-200 group-hover:bg-teal-200 transition-colors"></div>
    @endunless
    
    <!-- Timeline Node Indicator -->
    <div class="absolute left-0 top-1 w-[28px] h-[28px] sm:w-[32px] sm:h-[32px] rounded-full bg-white border-2 {{ $colors['ring'] }} shadow-sm flex items-center justify-center transition-all group-hover:scale-110">
        <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full {{ $colors['dot'] }}"></div>
    </div>
    
    <!-- Content Card -->
    <div class="bg-white border {{ $isLatest ? 'border-teal-300 shadow-[0_6px_25px_rgba(13,148,136,0.08)] ring-1 ring-teal-200/50' : 'border-slate-200/80 shadow-[0_4px_20px_rgb(0,0,0,0.03)]' }} rounded-[22px] p-4 sm:p-5 hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:border-slate-300 transition-all duration-200">
        
        <!-- Header: Tanggal, Usia & Badges -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2.5 mb-4">
            <div class="flex items-center flex-wrap gap-2">
                <span class="text-[15px] font-bold text-slate-800">{{ $measurement['date'] }}</span>
                @if(isset($measurement['age_at_measure']))
                    <span class="px-2.5 py-0.5 bg-slate-100 text-slate-600 rounded-md text-[11px] font-semibold">
                        Usia {{ $measurement['age_at_measure'] }}
                    </span>
                @endif

                @if($isLatest)
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-teal-50 text-teal-700 border border-teal-200/60">
                        <span class="w-1.5 h-1.5 rounded-full bg-teal-500 animate-pulse"></span>
                        Terbaru
                    </span>
                @endif
            </div>
            
            <div class="flex items-center flex-wrap gap-1.5">
                <!-- Status Gizi Badge -->
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold border {{ $colors['badge'] }}">
                    {{ $measurement['status'] }}
                </span>
                
                <!-- Status Validasi Badge -->
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold border {{ $valConfig['badge'] }}">
                    {!! $valConfig['icon'] !!}
                    <span>{{ $valConfig['label'] }}</span>
                </span>
            </div>
        </div>
        
        <!-- Measurement Metrics Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 sm:gap-3">
            
            <!-- Berat Badan (BB) -->
            <div class="bg-slate-50/70 hover:bg-slate-50 border border-slate-100 rounded-xl p-3 flex flex-col justify-between transition-colors">
                <div class="flex items-center justify-between mb-1">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Berat Badan</span>
                    <div class="w-5 h-5 rounded-md bg-emerald-100 text-emerald-600 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3"><path fill-rule="evenodd" d="M10 2a.75.75 0 01.75.75v1.543a6.502 6.502 0 014.71 4.71h1.54a.75.75 0 010 1.5h-1.54a6.502 6.502 0 01-4.71 4.71v1.543a.75.75 0 01-1.5 0v-1.543a6.502 6.502 0 01-4.71-4.71H2.75a.75.75 0 010-1.5h1.54a6.502 6.502 0 014.71-4.71V2.75A.75.75 0 0110 2zm0 3.5a5 5 0 100 10 5 5 0 000-10z" clip-rule="evenodd" /></svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-1">
                    <span class="text-[16px] font-semibold text-slate-800">{{ $measurement['weight'] }}</span>
                    <span class="text-[12px] font-medium text-slate-500">kg</span>
                </div>
                <div class="mt-1.5 flex items-center">
                    @if(isset($measurement['weight_trend']) && $measurement['weight_trend'] > 0)
                        <span class="inline-flex items-center gap-0.5 text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded border border-emerald-200/50">
                            <svg class="w-3 h-3" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z" clip-rule="evenodd" /></svg>
                            +{{ $measurement['weight_trend'] }} kg
                        </span>
                    @elseif(isset($measurement['weight_trend']) && $measurement['weight_trend'] < 0)
                        <span class="inline-flex items-center gap-0.5 text-[11px] font-semibold text-rose-600 bg-rose-50 px-1.5 py-0.5 rounded border border-rose-200/50">
                            <svg class="w-3 h-3" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z" clip-rule="evenodd" /></svg>
                            {{ $measurement['weight_trend'] }} kg
                        </span>
                    @elseif(isset($measurement['weight_trend']) && $measurement['weight_trend'] == 0)
                        <span class="text-[11px] font-medium text-slate-400">Tetap (0 kg)</span>
                    @else
                        <span class="text-[11px] font-medium text-slate-400">Pengukuran awal</span>
                    @endif
                </div>
            </div>
            
            <!-- Tinggi Badan (TB) -->
            <div class="bg-slate-50/70 hover:bg-slate-50 border border-slate-100 rounded-xl p-3 flex flex-col justify-between transition-colors">
                <div class="flex items-center justify-between mb-1">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Tinggi Badan</span>
                    <div class="w-5 h-5 rounded-md bg-amber-100 text-amber-600 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3"><path fill-rule="evenodd" d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z" clip-rule="evenodd" /></svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-1">
                    <span class="text-[16px] font-semibold text-slate-800">{{ $measurement['height'] }}</span>
                    <span class="text-[12px] font-medium text-slate-500">cm</span>
                </div>
                <div class="mt-1.5 flex items-center">
                    @if(isset($measurement['height_trend']) && $measurement['height_trend'] > 0)
                        <span class="inline-flex items-center gap-0.5 text-[11px] font-semibold text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded border border-emerald-200/50">
                            <svg class="w-3 h-3" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z" clip-rule="evenodd" /></svg>
                            +{{ $measurement['height_trend'] }} cm
                        </span>
                    @elseif(isset($measurement['height_trend']) && $measurement['height_trend'] == 0)
                        <span class="text-[11px] font-medium text-slate-400">Tetap (0 cm)</span>
                    @else
                        <span class="text-[11px] font-medium text-slate-400">Pengukuran awal</span>
                    @endif
                </div>
            </div>

            <!-- Lingkar Kepala (LK) -->
            <div class="bg-slate-50/70 hover:bg-slate-50 border border-slate-100 rounded-xl p-3 flex flex-col justify-between transition-colors">
                <div class="flex items-center justify-between mb-1">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Lingkar Kepala</span>
                    <div class="w-5 h-5 rounded-md bg-teal-100 text-teal-600 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm0-2a6 6 0 100-12 6 6 0 000 12z" clip-rule="evenodd" /></svg>
                    </div>
                </div>
                <div class="flex items-baseline gap-1">
                    <span class="text-[16px] font-semibold text-slate-800">{{ $measurement['head_circ'] ?? '-' }}</span>
                    <span class="text-[12px] font-medium text-slate-500">cm</span>
                </div>
                <div class="mt-1.5 flex items-center">
                    @if(!empty($measurement['asi_eksklusif']))
                        <span class="inline-flex items-center gap-1 text-[10px] font-bold text-teal-700 bg-teal-50 px-1.5 py-0.5 rounded border border-teal-200/50">
                            ASI Eksklusif
                        </span>
                    @else
                        <span class="text-[11px] font-medium text-slate-400">
                            {{ !empty($measurement['head_circ']) ? 'Tercatat' : 'Tidak diukur' }}
                        </span>
                    @endif
                </div>
            </div>

            <!-- Indeks Z-Score & KMS -->
            <div class="bg-slate-50/70 hover:bg-slate-50 border border-slate-100 rounded-xl p-3 flex flex-col justify-between transition-colors">
                <div class="flex items-center justify-between mb-1">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Status KMS & Z-Score</span>
                    @if(!empty($measurement['status_kenaikan']))
                        <span class="px-1.5 py-0.5 text-[10px] font-bold rounded {{ $measurement['status_kenaikan'] === 'N' ? 'bg-emerald-100 text-emerald-700' : ($measurement['status_kenaikan'] === 'T' ? 'bg-rose-100 text-rose-700' : 'bg-slate-200 text-slate-700') }}">
                            KMS: {{ $measurement['status_kenaikan'] }}
                        </span>
                    @endif
                </div>
                <div class="flex flex-col gap-0.5 mt-0.5">
                    <div class="flex items-center justify-between text-[11px]">
                        <span class="text-slate-500 font-medium">BB/U:</span>
                        <span class="font-semibold {{ isset($measurement['z_score_bbu']) && $measurement['z_score_bbu'] < -2 ? 'text-amber-600 font-bold' : 'text-slate-700' }}">
                            {{ $measurement['z_score_bbu'] !== null ? $measurement['z_score_bbu'] . ' SD' : '-' }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between text-[11px]">
                        <span class="text-slate-500 font-medium">TB/U:</span>
                        <span class="font-semibold {{ isset($measurement['z_score_tbu']) && $measurement['z_score_tbu'] < -2 ? 'text-amber-600 font-bold' : 'text-slate-700' }}">
                            {{ $measurement['z_score_tbu'] !== null ? $measurement['z_score_tbu'] . ' SD' : '-' }}
                        </span>
                    </div>
                </div>
            </div>
            
        </div>

        @if(!empty($measurement['catatan_kader']))
            {{-- Catatan Kader Callout --}}
            <div class="mt-3 p-3 bg-slate-50/80 border border-slate-200/60 rounded-xl flex items-start gap-2.5 text-slate-700">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 text-teal-600 shrink-0 mt-0.5">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
                </svg>
                <div class="flex-1">
                    <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider block mb-0.5">Catatan Kader:</span>
                    <p class="text-[12.5px] font-medium text-slate-800 leading-relaxed">{{ $measurement['catatan_kader'] }}</p>
                </div>
            </div>
        @endif

        @if(isset($measurement['status_validasi']) && $measurement['status_validasi'] === 'rejected')
            <!-- Rejection Alert -->
            <div class="mt-4 p-3.5 bg-rose-50 border border-rose-200/80 rounded-xl relative overflow-hidden">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-rose-500"></div>
                <div class="flex items-start gap-3 pl-1">
                    <svg class="w-5 h-5 text-rose-500 mt-0.5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <div class="flex-1">
                        <span class="text-[12px] font-bold text-rose-700 block mb-0.5">Catatan Revisi dari Puskesmas:</span>
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
                                <h3 class="text-xl font-bold tracking-tight text-slate-800">Revisi Pengukuran</h3>
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

                                    <div class="flex flex-col gap-1.5 sm:col-span-2">
                                        <label class="text-sm font-semibold text-slate-700">Lingkar Kepala (cm)</label>
                                        <input type="number" step="any" name="lingkar_kepala" value="{{ $measurement['head_circ'] ?? '' }}" placeholder="Opsional" class="w-full h-12 bg-slate-50 border border-slate-200 focus:border-rose-500 focus:ring-1 focus:ring-rose-500 rounded-xl px-4 text-sm font-medium text-slate-800 transition-all outline-none">
                                    </div>

                                    <div class="flex flex-col gap-1.5 sm:col-span-2">
                                        <label class="text-sm font-semibold text-slate-700">Catatan Perbaikan Kader</label>
                                        <textarea name="catatan_kader" rows="2" placeholder="Catatan respons atau konfirmasi untuk Puskesmas..." class="w-full bg-slate-50 border border-slate-200 focus:border-rose-500 focus:ring-1 focus:ring-rose-500 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-800 transition-all outline-none resize-none">{{ $measurement['catatan_kader'] ?? '' }}</textarea>
                                    </div>
                                </div>
                                
                                <div class="mt-6 flex justify-end gap-3">
                                    <button type="button" onclick="document.getElementById('editModal-{{ $measurement['id'] }}').classList.add('hidden')" class="px-3 py-2 min-h-[44px] text-sm font-semibold text-slate-600 hover:text-slate-800 hover:bg-slate-100 rounded-xl transition-colors focus:outline-none">Batal</button>
                                    <button type="submit" class="px-6 py-2.5 bg-rose-600 hover:bg-rose-700 text-white rounded-xl font-semibold text-sm shadow-sm hover:shadow-sm border border-slate-200/60 transition-all focus:outline-none">Simpan Perbaikan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
