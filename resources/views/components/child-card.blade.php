@props(['balita'])

@php
    // Subtle left accent bar & muted badge styling (low saturation, calm aesthetic)
    $statusType = $balita['status_type'] ?? 'warning';
    $colorMap = [
        'success' => [
            'accent'      => 'bg-emerald-500',
            'badge_bg'    => 'bg-emerald-50/90 text-emerald-800 border-emerald-200/70',
            'badge_dot'   => 'bg-emerald-500',
            'gender_l'    => 'text-sky-600 bg-sky-50 border-sky-100',
            'gender_p'    => 'text-rose-500 bg-rose-50 border-rose-100',
        ],
        'warning' => [
            'accent'      => 'bg-amber-400',
            'badge_bg'    => 'bg-amber-50/90 text-amber-800 border-amber-200/70',
            'badge_dot'   => 'bg-amber-400',
            'gender_l'    => 'text-sky-600 bg-sky-50 border-sky-100',
            'gender_p'    => 'text-rose-500 bg-rose-50 border-rose-100',
        ],
        'danger' => [
            'accent'      => 'bg-rose-500',
            'badge_bg'    => 'bg-rose-50/90 text-rose-800 border-rose-200/70',
            'badge_dot'   => 'bg-rose-500',
            'gender_l'    => 'text-sky-600 bg-sky-50 border-sky-100',
            'gender_p'    => 'text-rose-500 bg-rose-50 border-rose-100',
        ],
    ];

    $colors = $colorMap[$statusType] ?? [
        'accent'      => 'bg-slate-300',
        'badge_bg'    => 'bg-slate-50 text-slate-700 border-slate-200',
        'badge_dot'   => 'bg-slate-400',
        'gender_l'    => 'text-slate-600 bg-slate-50 border-slate-200',
        'gender_p'    => 'text-slate-600 bg-slate-50 border-slate-200',
    ];

    // Status Validasi Mapping (Muted, Clean Indonesian labels)
    $valStatus = $balita['status_validasi'] ?? 'pending';
    $valConfig = match($valStatus) {
        'approved' => [
            'label' => 'Terverifikasi',
            'badge' => 'bg-emerald-50/80 text-emerald-700 border-emerald-200/70',
            'icon'  => '<svg class="w-3 h-3 text-emerald-600 shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg>'
        ],
        'rejected' => [
            'label' => 'Perlu Revisi',
            'badge' => 'bg-rose-50/80 text-rose-700 border-rose-200/70',
            'icon'  => '<svg class="w-3 h-3 text-rose-600 shrink-0" viewBox="0 0 20 20" fill="currentColor"><path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" /></svg>'
        ],
        default => [
            'label' => 'Menunggu Validasi',
            'badge' => 'bg-amber-50/80 text-amber-700 border-amber-200/70',
            'icon'  => '<svg class="w-3 h-3 text-amber-600 shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z" clip-rule="evenodd" /></svg>'
        ]
    };

    $isGirl = in_array(strtolower($balita['gender'] ?? ''), ['p', 'perempuan', 'female']);
@endphp

{{-- Child Card: Scannable 5-Zone Information Architecture --}}
<div class="group relative flex flex-col justify-between bg-white border border-slate-200/90 rounded-2xl overflow-hidden shadow-[0_1px_3px_rgba(0,0,0,0.02),0_4px_16px_rgba(0,0,0,0.03)] hover:shadow-[0_6px_24px_rgba(0,0,0,0.06)] hover:border-slate-300 transition-all duration-200 ease-out h-full w-full">

    {{-- Status Accent Strip (Left edge 3px) --}}
    <div class="absolute left-0 top-0 bottom-0 w-[3.5px] {{ $colors['accent'] }}"></div>

    {{-- Inner Card Body --}}
    <div class="p-3.5 sm:p-4 pl-4.5 sm:pl-5 flex flex-col justify-between h-full gap-3.5">

        {{-- TOP AREA (Zone 1, Zone 2, Zone 3, Zone 4) --}}
        <div class="space-y-3">

            {{-- ── ZONA 1: STATUS GIZI & VERIFIKASI (PRIORITAS UTAMA) ── --}}
            <div class="flex items-center justify-between gap-1.5 flex-wrap">
                {{-- Status Gizi Anak --}}
                <div class="inline-flex items-center gap-1.5 {{ $colors['badge_bg'] }} px-2.5 py-0.5 rounded-full border text-[10.5px] font-semibold tracking-tight shadow-2xs">
                    <span class="w-1.5 h-1.5 rounded-full {{ $colors['badge_dot'] }} shrink-0"></span>
                    <span>{{ $balita['status'] }}</span>
                </div>

                {{-- Status Validasi Puskesmas (Hanya jika belum tercakup di status) --}}
                @if(!str_contains(strtolower($balita['status']), strtolower($valConfig['label'])))
                    <div class="inline-flex items-center gap-1 {{ $valConfig['badge'] }} px-2 py-0.5 rounded-full border text-[10px] font-medium shadow-2xs">
                        {!! $valConfig['icon'] !!}
                        <span>{{ $valConfig['label'] }}</span>
                    </div>
                @endif
            </div>

            {{-- ── ZONA 2: IDENTITAS ANAK ── --}}
            <div class="flex items-start gap-2.5">
                {{-- Gender Icon Indicator --}}
                <div class="w-8 h-8 rounded-xl {{ $isGirl ? 'bg-rose-50 border border-rose-100 text-rose-500' : 'bg-sky-50 border border-sky-100 text-sky-600' }} flex items-center justify-center shrink-0 mt-0.5 shadow-2xs" title="{{ $isGirl ? 'Perempuan' : 'Laki-laki' }}">
                    @if($isGirl)
                        {{-- Icon Perempuan --}}
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><circle cx="12" cy="8" r="5"/><path d="M12 13v8"/><path d="M9 18h6"/></svg>
                    @else
                        {{-- Icon Laki-laki --}}
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><circle cx="10" cy="14" r="5"/><path d="M19 5l-5.4 5.4"/><path d="M19 5h-5"/><path d="M19 5v5"/></svg>
                    @endif
                </div>

                {{-- Nama & Meta Balita --}}
                <div class="flex-1 min-w-0">
                    <a href="{{ route('balita.show', $balita['id'] ?? '') }}" class="font-bold text-slate-800 text-[13.5px] sm:text-[14px] leading-snug truncate block group-hover:text-teal-700 transition-colors">
                        {{ Str::title($balita['name']) }}
                    </a>
                    <p class="text-[11.5px] text-slate-500 font-medium truncate mt-0.5">
                        <span>{{ $balita['age'] }}</span>
                        <span class="mx-1 text-slate-300">•</span>
                        <span>Ibu: <strong class="font-semibold text-slate-700">{{ Str::title($balita['mother']) }}</strong></span>
                    </p>
                </div>
            </div>

            {{-- ── ZONA 3: DATA ANTROPOMETRI TERKINI (MINI-STAT BLOCKS GRID 2 KOLOM) ── --}}
            <div class="p-2.5 rounded-xl bg-slate-50/90 border border-slate-200/70 space-y-2">
                @if(!empty($balita['weight']) || !empty($balita['height']))
                    {{-- Grid 2 Kolom Mini-Stats --}}
                    <div class="grid grid-cols-2 gap-2">
                        
                        {{-- Mini-Stat 1: Berat Badan --}}
                        <div class="bg-white p-2 rounded-lg border border-slate-200/80 shadow-2xs">
                            <span class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider block mb-0.5">Berat Badan</span>
                            <div class="flex items-center justify-between gap-1">
                                <span class="text-xs sm:text-[13px] font-bold text-slate-800">{{ $balita['weight'] ?? '-' }} <span class="text-[10.5px] font-medium text-slate-500">kg</span></span>
                                
                                {{-- Tren Berat Historis (Hanya jika ada data ukur sebelumnya) --}}
                                @if(!empty($balita['trend_weight']))
                                    @php $tw = $balita['trend_weight']; @endphp
                                    <span class="inline-flex items-center text-[9.5px] font-semibold px-1 py-0.2 rounded border {{ $tw['direction'] === 'up' ? 'bg-emerald-50 text-emerald-700 border-emerald-200/60' : ($tw['direction'] === 'down' ? 'bg-amber-50 text-amber-700 border-amber-200/60' : 'bg-slate-100 text-slate-600 border-slate-200') }}" title="Perubahan dari penimbangan sebelumnya">
                                        {{ $tw['direction'] === 'up' ? '↑' : ($tw['direction'] === 'down' ? '↓' : '→') }} {{ $tw['label'] }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Mini-Stat 2: Tinggi Badan --}}
                        <div class="bg-white p-2 rounded-lg border border-slate-200/80 shadow-2xs">
                            <span class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider block mb-0.5">Tinggi Badan</span>
                            <div class="flex items-center justify-between gap-1">
                                <span class="text-xs sm:text-[13px] font-bold text-slate-800">{{ $balita['height'] ?? '-' }} <span class="text-[10.5px] font-medium text-slate-500">cm</span></span>
                                
                                {{-- Tren Tinggi Historis (Hanya jika ada data ukur sebelumnya) --}}
                                @if(!empty($balita['trend_height']))
                                    @php $th = $balita['trend_height']; @endphp
                                    <span class="inline-flex items-center text-[9.5px] font-semibold px-1 py-0.2 rounded border {{ $th['direction'] === 'up' ? 'bg-emerald-50 text-emerald-700 border-emerald-200/60' : ($th['direction'] === 'down' ? 'bg-amber-50 text-amber-700 border-amber-200/60' : 'bg-slate-100 text-slate-600 border-slate-200') }}" title="Perubahan dari pengukuran sebelumnya">
                                        {{ $th['direction'] === 'up' ? '↑' : ($th['direction'] === 'down' ? '↓' : '→') }} {{ $th['label'] }}
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>

                    {{-- Tanggal Ukur Footer --}}
                    <div class="flex items-center justify-between text-[10.5px] text-slate-500 pt-0.5 px-0.5">
                        <span class="flex items-center gap-1">
                            <svg class="w-3 h-3 text-slate-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z" clip-rule="evenodd" /></svg>
                            <span>Terakhir: <strong class="font-medium text-slate-700">{{ $balita['last_measure'] }}</strong></span>
                        </span>
                        @if(!empty($balita['is_birth_measure']))
                            <span class="text-[9.5px] font-semibold text-teal-700 bg-teal-50 border border-teal-200/60 px-1.5 py-0.2 rounded">Saat Lahir</span>
                        @endif
                    </div>
                @else
                    {{-- State Belum Diukur --}}
                    <div class="p-2 text-center text-slate-400 text-xs font-medium">
                        <span>Belum ada riwayat penimbangan</span>
                    </div>
                @endif
            </div>

            {{-- ── ZONA 4: CATATAN REVISI PUSKESMAS (KONDISIONAL) ── --}}
            @if(isset($balita['status_validasi']) && $balita['status_validasi'] === 'rejected')
                <div class="p-2 rounded-xl bg-rose-50/80 border border-rose-200/80 flex items-start gap-1.5 text-[11px] text-rose-800">
                    <svg class="w-3.5 h-3.5 text-rose-600 shrink-0 mt-0.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg>
                    <div class="flex-1 min-w-0">
                        <span class="font-bold block text-[10px] text-rose-900 uppercase tracking-wider">Perlu Revisi Puskesmas:</span>
                        <p class="text-[11px] leading-tight font-medium text-rose-800/90 truncate">{{ $balita['rejection_note'] ?? 'Periksa dan timbang ulang balita.' }}</p>
                    </div>
                </div>
            @endif

        </div>

        {{-- ── ZONA 5: AKSI KADER (TERPISAH DI BAGIAN BAWAH) ── --}}
        <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2">
            {{-- Tombol Detail --}}
            <a href="{{ route('balita.show', $balita['id'] ?? '') }}"
               class="h-[32px] px-3.5 flex items-center justify-center text-xs font-semibold text-slate-600 bg-white border border-slate-200 hover:border-slate-300 hover:bg-slate-50 hover:text-slate-800 rounded-xl shadow-2xs transition-all duration-150 cursor-pointer">
                Detail
            </a>
            {{-- Tombol Ukur --}}
            <a href="{{ route('balita.show', ['id' => $balita['id'] ?? '', 'action' => 'ukur']) }}"
               class="h-[32px] px-4 flex items-center justify-center bg-teal-600 hover:bg-teal-700 active:scale-[0.99] text-white text-xs font-semibold rounded-xl shadow-2xs transition-all duration-150 cursor-pointer flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" /></svg>
                <span>Ukur</span>
            </a>
        </div>

    </div>
</div>
