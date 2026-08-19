@props(['balita'])

@php
    $statusType = $balita['status_type'] ?? 'warning';
    
    // Aksen status: HANYA untuk bar kiri 3px dan 1 dot status
    $accentColor = match($statusType) {
        'success' => ['bar' => 'bg-emerald-500', 'dot' => 'bg-emerald-500', 'text' => 'text-emerald-700'],
        'danger'  => ['bar' => 'bg-rose-500',    'dot' => 'bg-rose-500',    'text' => 'text-rose-700'],
        default   => ['bar' => 'bg-amber-400',   'dot' => 'bg-amber-400',   'text' => 'text-amber-700'],
    };

    $valLabel = match($balita['status_validasi'] ?? 'pending') {
        'approved' => 'Terverifikasi Puskesmas',
        'rejected' => 'Perlu Revisi',
        default    => 'Menunggu Validasi'
    };

    $isGirl = in_array(strtolower($balita['gender'] ?? ''), ['p', 'perempuan', 'female']);
@endphp

<div class="group relative flex flex-col justify-between bg-white border border-slate-200/90 rounded-2xl overflow-hidden shadow-xs hover:shadow-md hover:border-slate-300 transition-all duration-150 h-full w-full">

    {{-- Aksen Status Bar Kiri (3.5px) --}}
    <div class="absolute left-0 top-0 bottom-0 w-[3.5px] {{ $accentColor['bar'] }}"></div>

    {{-- Konten Kartu (p-4 sm:p-4.5, tanpa kotak bertumpuk) --}}
    <div class="p-4 sm:p-4.5 pl-5 sm:pl-5.5 flex flex-col justify-between h-full gap-3.5">

        <div class="space-y-3">
            
            {{-- 1. IDENTITAS ANAK (Level 1: Nama Paling Menonjol) --}}
            <div class="flex items-start gap-2.5">
                {{-- Icon Gender (Slate Netral) --}}
                <div class="w-8 h-8 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center shrink-0 mt-0.5" title="{{ $isGirl ? 'Perempuan' : 'Laki-laki' }}">
                    @if($isGirl)
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><circle cx="12" cy="8" r="5"/><path d="M12 13v8"/><path d="M9 18h6"/></svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><circle cx="10" cy="14" r="5"/><path d="M19 5l-5.4 5.4"/><path d="M19 5h-5"/><path d="M19 5v5"/></svg>
                    @endif
                </div>

                {{-- Nama (Level 1) & Meta (Level 3) --}}
                <div class="flex-1 min-w-0">
                    <a href="{{ route('balita.show', $balita['id'] ?? '') }}" class="text-[15px] sm:text-base font-bold text-slate-900 tracking-tight leading-snug truncate block group-hover:text-teal-700 transition-colors">
                        {{ Str::title($balita['name']) }}
                    </a>
                    <p class="text-xs text-slate-500 font-normal leading-relaxed truncate mt-0.5">
                        <span>{{ $balita['age'] }}</span>
                        <span class="mx-1 text-slate-300">•</span>
                        <span>Ibu: {{ Str::title($balita['mother']) }}</span>
                    </p>
                </div>
            </div>

            {{-- 2. STATUS GIZI & VERIFIKASI (Teks Wrap Alami, Bebas Truncate Rusak) --}}
            <div class="flex flex-wrap items-center gap-1.5 text-xs text-slate-600 font-medium leading-relaxed">
                <span class="w-2 h-2 rounded-full {{ $accentColor['dot'] }} shrink-0"></span>
                <span class="{{ $accentColor['text'] }} font-semibold">{{ $balita['status'] }}</span>
                <span class="text-slate-300">·</span>
                <span class="text-slate-500 font-normal">{{ $valLabel }}</span>
            </div>

            {{-- Divider Jelas Antar Section --}}
            <div class="border-t border-slate-200/90"></div>

            {{-- 3. DATA ANTROPOMETRI (Grid 2 Kolom Eksplisit & Konsisten di Semua Layar) --}}
            @if(!empty($balita['weight']) || !empty($balita['height']))
                <div class="grid grid-cols-2 gap-4 w-full items-start">
                    {{-- Kolom BB --}}
                    <div class="min-w-0 flex flex-col">
                        <span class="text-[10px] sm:text-[10.5px] font-semibold text-slate-600 uppercase tracking-wide truncate">Berat Badan</span>
                        <div class="flex items-baseline gap-1.5 mt-0.5 flex-wrap">
                            <div class="flex items-baseline gap-0.5 whitespace-nowrap">
                                <span class="text-base sm:text-lg font-bold text-slate-900">{{ $balita['weight'] ?? '-' }}</span>
                                <span class="text-xs font-normal text-slate-500">kg</span>
                            </div>
                            
                            {{-- Tren Berat dengan SVG Icon --}}
                            @if(!empty($balita['trend_weight']))
                                @php $tw = $balita['trend_weight']; @endphp
                                <span class="inline-flex items-center gap-0.5 text-xs font-semibold whitespace-nowrap {{ $tw['direction'] === 'up' ? 'text-emerald-600' : ($tw['direction'] === 'down' ? 'text-amber-600' : 'text-slate-400') }}">
                                    @if($tw['direction'] === 'up')
                                        <svg class="w-3 h-3 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18" /></svg>
                                    @elseif($tw['direction'] === 'down')
                                        <svg class="w-3 h-3 text-amber-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" /></svg>
                                    @else
                                        <svg class="w-3 h-3 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                                    @endif
                                    <span>{{ $tw['label'] }}</span>
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Kolom TB --}}
                    <div class="min-w-0 flex flex-col">
                        <span class="text-[10px] sm:text-[10.5px] font-semibold text-slate-600 uppercase tracking-wide truncate">Tinggi Badan</span>
                        <div class="flex items-baseline gap-1.5 mt-0.5 flex-wrap">
                            <div class="flex items-baseline gap-0.5 whitespace-nowrap">
                                <span class="text-base sm:text-lg font-bold text-slate-900">{{ $balita['height'] ?? '-' }}</span>
                                <span class="text-xs font-normal text-slate-500">cm</span>
                            </div>
                            
                            {{-- Tren Tinggi dengan SVG Icon --}}
                            @if(!empty($balita['trend_height']))
                                @php $th = $balita['trend_height']; @endphp
                                <span class="inline-flex items-center gap-0.5 text-xs font-semibold whitespace-nowrap {{ $th['direction'] === 'up' ? 'text-emerald-600' : ($th['direction'] === 'down' ? 'text-amber-600' : 'text-slate-400') }}">
                                    @if($th['direction'] === 'up')
                                        <svg class="w-3 h-3 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18" /></svg>
                                    @elseif($th['direction'] === 'down')
                                        <svg class="w-3 h-3 text-amber-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" /></svg>
                                    @else
                                        <svg class="w-3 h-3 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                                    @endif
                                    <span>{{ $th['label'] }}</span>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Tanggal Terakhir Ukur (Level 3) --}}
                <div class="flex items-center justify-between text-xs text-slate-500 font-normal pt-0.5">
                    <span>Terakhir: <strong class="font-medium text-slate-700">{{ $balita['last_measure'] }}</strong></span>
                    @if(!empty($balita['is_birth_measure']))
                        <span class="text-[10.5px] text-teal-700 font-medium bg-teal-50 px-1.5 py-0.5 rounded border border-teal-200/60">Saat Lahir</span>
                    @endif
                </div>
            @else
                <p class="text-xs text-slate-400 py-1 font-normal">Belum ada riwayat penimbangan</p>
            @endif

            {{-- 4. CATATAN REVISI PUSKESMAS (Jika status Ditolak) --}}
            @if(isset($balita['status_validasi']) && $balita['status_validasi'] === 'rejected')
                <div class="p-2.5 rounded-xl bg-rose-50 border border-rose-200/70 text-xs text-rose-800">
                    <span class="font-bold block text-[10.5px] uppercase text-rose-900 tracking-wide mb-0.5">Perlu Revisi Puskesmas:</span>
                    <p class="font-normal text-rose-800/90 leading-snug">{{ $balita['rejection_note'] ?? 'Mohon timbang ulang balita.' }}</p>
                </div>
            @endif

        </div>

        {{-- 5. AKSI KADER (Zona Bawah, Tap Target Minimal 40-44px di Mobile) --}}
        <div class="pt-3 border-t border-slate-200/90 flex items-center justify-end gap-2.5">
            <a href="{{ route('balita.show', $balita['id'] ?? '') }}"
               class="min-h-[40px] sm:min-h-[34px] h-10 sm:h-8 px-4 sm:px-3.5 flex items-center justify-center text-xs font-medium text-slate-600 bg-white border border-slate-200 hover:border-slate-300 hover:bg-slate-50 rounded-xl transition-colors cursor-pointer">
                Detail
            </a>
            <a href="{{ route('balita.show', ['id' => $balita['id'] ?? '', 'action' => 'ukur']) }}"
               class="min-h-[40px] sm:min-h-[34px] h-10 sm:h-8 px-4 sm:px-3.5 flex items-center justify-center bg-teal-600 hover:bg-teal-700 active:scale-[0.99] text-white text-xs font-semibold rounded-xl transition-colors cursor-pointer flex items-center gap-1.5 shadow-2xs">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" /></svg>
                <span>Ukur</span>
            </a>
        </div>

    </div>
</div>
