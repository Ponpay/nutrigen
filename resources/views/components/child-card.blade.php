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

<div class="group relative flex flex-col justify-between bg-white border border-slate-200/80 rounded-xl overflow-hidden shadow-xs hover:shadow-md hover:border-slate-300 transition-all duration-150 h-full w-full">

    {{-- Aksen Status Bar Kiri (3px) --}}
    <div class="absolute left-0 top-0 bottom-0 w-[3px] {{ $accentColor['bar'] }}"></div>

    {{-- Konten Kartu (p-4 ringkas, tanpa kotak bertumpuk) --}}
    <div class="p-4 pl-5 flex flex-col justify-between h-full gap-3.5">

        <div class="space-y-3">
            
            {{-- 1. IDENTITAS ANAK (Level 1: Nama Paling Menonjol) --}}
            <div class="flex items-start gap-2.5">
                {{-- Icon Gender (Slate Netral) --}}
                <div class="w-7 h-7 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center shrink-0 mt-0.5" title="{{ $isGirl ? 'Perempuan' : 'Laki-laki' }}">
                    @if($isGirl)
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5"><circle cx="12" cy="8" r="5"/><path d="M12 13v8"/><path d="M9 18h6"/></svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5"><circle cx="10" cy="14" r="5"/><path d="M19 5l-5.4 5.4"/><path d="M19 5h-5"/><path d="M19 5v5"/></svg>
                    @endif
                </div>

                {{-- Nama (Level 1) & Meta (Level 3) --}}
                <div class="flex-1 min-w-0">
                    <a href="{{ route('balita.show', $balita['id'] ?? '') }}" class="text-base font-bold text-slate-900 tracking-tight leading-snug truncate block group-hover:text-teal-700 transition-colors">
                        {{ Str::title($balita['name']) }}
                    </a>
                    <p class="text-xs text-slate-500 font-normal leading-relaxed truncate mt-0.5">
                        <span>{{ $balita['age'] }}</span>
                        <span class="mx-1 text-slate-300">•</span>
                        <span>Ibu: {{ Str::title($balita['mother']) }}</span>
                    </p>
                </div>
            </div>

            {{-- 2. STATUS GIZI & VERIFIKASI (1 Baris Ringkas, Tanpa Pill Box) --}}
            <div class="flex items-center gap-1.5 text-xs text-slate-600 font-medium truncate">
                <span class="w-2 h-2 rounded-full {{ $accentColor['dot'] }} shrink-0"></span>
                <span class="{{ $accentColor['text'] }} truncate">{{ $balita['status'] }}</span>
                <span class="text-slate-300">·</span>
                <span class="text-slate-500 font-normal truncate">{{ $valLabel }}</span>
            </div>

            {{-- Divider Tipis Menuju Data Fisik --}}
            <div class="border-t border-slate-100"></div>

            {{-- 3. DATA ANTROPOMETRI (1 Lapis, Grid 2 Kolom, Tanpa Border Kotak Tambahan) --}}
            @if(!empty($balita['weight']) || !empty($balita['height']))
                <div class="grid grid-cols-2 gap-3">
                    {{-- Kolom BB --}}
                    <div>
                        <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-wide block">Berat Badan</span>
                        <div class="flex items-baseline gap-1.5 mt-0.5">
                            <span class="text-lg font-bold text-slate-800">{{ $balita['weight'] ?? '-' }} <span class="text-xs font-normal text-slate-500">kg</span></span>
                            @if(!empty($balita['trend_weight']))
                                @php $tw = $balita['trend_weight']; @endphp
                                <span class="text-xs font-semibold {{ $tw['direction'] === 'up' ? 'text-emerald-600' : ($tw['direction'] === 'down' ? 'text-amber-600' : 'text-slate-400') }}">
                                    {{ $tw['direction'] === 'up' ? '↑' : ($tw['direction'] === 'down' ? '↓' : '→') }}{{ $tw['label'] }}
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Kolom TB --}}
                    <div>
                        <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-wide block">Tinggi Badan</span>
                        <div class="flex items-baseline gap-1.5 mt-0.5">
                            <span class="text-lg font-bold text-slate-800">{{ $balita['height'] ?? '-' }} <span class="text-xs font-normal text-slate-500">cm</span></span>
                            @if(!empty($balita['trend_height']))
                                @php $th = $balita['trend_height']; @endphp
                                <span class="text-xs font-semibold {{ $th['direction'] === 'up' ? 'text-emerald-600' : ($th['direction'] === 'down' ? 'text-amber-600' : 'text-slate-400') }}">
                                    {{ $th['direction'] === 'up' ? '↑' : ($th['direction'] === 'down' ? '↓' : '→') }}{{ $th['label'] }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Tanggal Terakhir Ukur (Level 3) --}}
                <div class="flex items-center justify-between text-xs text-slate-400 font-normal">
                    <span>Terakhir: <strong class="font-normal text-slate-600">{{ $balita['last_measure'] }}</strong></span>
                    @if(!empty($balita['is_birth_measure']))
                        <span class="text-[10.5px] text-teal-700 font-medium">Saat Lahir</span>
                    @endif
                </div>
            @else
                <p class="text-xs text-slate-400 py-1 font-normal">Belum ada riwayat penimbangan</p>
            @endif

            {{-- 4. CATATAN REVISI PUSKESMAS (Jika status Ditolak) --}}
            @if(isset($balita['status_validasi']) && $balita['status_validasi'] === 'rejected')
                <div class="p-2.5 rounded-lg bg-rose-50 border border-rose-100 text-xs text-rose-800">
                    <span class="font-semibold block text-[10px] uppercase text-rose-900 tracking-wide">Perlu Revisi:</span>
                    <p class="font-normal text-rose-800/90 truncate">{{ $balita['rejection_note'] ?? 'Mohon timbang ulang balita.' }}</p>
                </div>
            @endif

        </div>

        {{-- 5. AKSI KADER (Zona Bawah, Terpisah Jelas) --}}
        <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2">
            <a href="{{ route('balita.show', $balita['id'] ?? '') }}"
               class="h-8 px-3.5 flex items-center justify-center text-xs font-medium text-slate-600 bg-white border border-slate-200 hover:border-slate-300 hover:bg-slate-50 rounded-lg transition-colors cursor-pointer">
                Detail
            </a>
            <a href="{{ route('balita.show', ['id' => $balita['id'] ?? '', 'action' => 'ukur']) }}"
               class="h-8 px-3.5 flex items-center justify-center bg-teal-600 hover:bg-teal-700 text-white text-xs font-semibold rounded-lg transition-colors cursor-pointer flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" /></svg>
                <span>Ukur</span>
            </a>
        </div>

    </div>
</div>
