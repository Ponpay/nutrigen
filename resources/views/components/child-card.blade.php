@props(['balita'])

{{--
|--------------------------------------------------------------------------
| x-child-card
|--------------------------------------------------------------------------
| Expected $balita array shape (from controller or dummy data):
|   id          (int)    — used for route generation
|   name        (string) — child's full name
|   age         (string) — human-readable age, e.g. "2 Tahun 3 Bulan"
|   mother      (string) — mother's name
|   status      (string) — display label, e.g. "Stunting", "Normal"
|   status_type (string) — one of: 'danger' | 'warning' | 'success' | 'slate'
|   context_tag (string) — optional badge, e.g. "[!] Absen bulan lalu"
--}}

@php
    // Left-accent color system — card stays white, only the accent strip changes.
    // This is the Linear/Stripe approach: neutral surface, colored signal.
    $colorMap = [
        'success' => [
            'accent'      => 'bg-emerald-500',
            'badge_bg'    => 'bg-emerald-50',
            'badge_text'  => 'text-emerald-700',
            'badge_dot'   => 'bg-emerald-500',
            'avatar_text' => 'text-emerald-500',
            'avatar_ring' => 'ring-emerald-100',
        ],
        'warning' => [
            'accent'      => 'bg-amber-400',
            'badge_bg'    => 'bg-amber-50',
            'badge_text'  => 'text-amber-700',
            'badge_dot'   => 'bg-amber-400',
            'avatar_text' => 'text-amber-500',
            'avatar_ring' => 'ring-amber-100',
        ],
        'danger' => [
            'accent'      => 'bg-rose-500',
            'badge_bg'    => 'bg-rose-50',
            'badge_text'  => 'text-rose-700',
            'badge_dot'   => 'bg-rose-500',
            'avatar_text' => 'text-rose-500',
            'avatar_ring' => 'ring-rose-100',
        ],
    ];

    $colors = $colorMap[$balita['status_type']] ?? [
        'accent'      => 'bg-slate-300',
        'badge_bg'    => 'bg-slate-50',
        'badge_text'  => 'text-slate-500',
        'badge_dot'   => 'bg-slate-400',
        'avatar_text' => 'text-slate-400',
        'avatar_ring' => 'ring-slate-100',
    ];
@endphp

{{-- Child Card: White surface + left accent strip. Clean, scannable, premium. --}}
<div class="group relative flex flex-col justify-between bg-white border border-slate-200/60 rounded-2xl overflow-hidden shadow-[0_1px_4px_rgba(0,0,0,0.04),0_4px_16px_rgba(0,0,0,0.03)] hover:shadow-[0_4px_20px_rgba(0,0,0,0.08)] hover:border-slate-300/60 transition-all duration-200 ease-out">

    {{-- Status Accent Strip (left edge) — 4px, standard Tailwind w-1 --}}
    <div class="absolute left-0 top-0 bottom-0 w-1 {{ $colors['accent'] }}"></div>

    {{-- Card Body --}}
    <div class="p-3 lg:p-4 pl-4 lg:pl-5">

        {{-- Top: Avatar + Info --}}
        <div class="flex items-center gap-3 mb-3 lg:mb-4">
            {{-- Avatar --}}
            <div class="w-10 h-10 rounded-full bg-slate-50 ring-2 {{ $colors['avatar_ring'] }} flex-shrink-0 flex items-center justify-center {{ $colors['avatar_text'] }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 opacity-70">
                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                </svg>
            </div>

            {{-- Name + Meta --}}
            <div class="flex-1 min-w-0">
                <p class="font-semibold text-slate-800 text-[13.5px] leading-snug truncate">{{ Str::title($balita['name']) }}</p>
                <div class="flex items-center gap-1.5 mt-0.5">
                    <span class="text-[11.5px] font-medium text-slate-500">{{ $balita['age'] }}</span>
                    <span class="w-0.5 h-0.5 rounded-full bg-slate-300 flex-shrink-0"></span>
                    <span class="text-[11.5px] text-slate-400 truncate">{{ Str::title($balita['mother']) }}</span>
                </div>
            </div>
        </div>

        {{-- Context Tag (Catatan Revisi Puskesmas / Tag) --}}
        @if(isset($balita['context_tag']) && $balita['context_tag'])
            @php
                $isRevision = str_contains(strtolower($balita['context_tag']), 'revisi') || str_contains(strtolower($balita['context_tag']), 'ditolak');
            @endphp
            <div class="mb-3">
                @if($isRevision)
                    <div class="p-2 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 flex items-start gap-2 shadow-xs">
                        <svg class="w-3.5 h-3.5 text-rose-600 shrink-0 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-[11px] font-bold leading-tight line-clamp-2">{{ $balita['context_tag'] }}</span>
                    </div>
                @else
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-slate-50 border border-slate-200/70 text-slate-600 text-[11px] font-medium">
                        {{ $balita['context_tag'] }}
                    </span>
                @endif
            </div>
        @endif

        {{-- Divider --}}
        <div class="w-full h-px bg-slate-100 mb-3.5"></div>

        {{-- Bottom: Status + Actions --}}
        <div class="flex flex-col gap-3">

            {{-- Status Badges --}}
            <div class="flex flex-wrap items-center gap-1.5">
                {{-- Status Gizi Badge --}}
                <div class="flex items-center gap-1.5 {{ $colors['badge_bg'] }} {{ $colors['badge_text'] }} px-3 py-1 rounded-full">
                    <span class="w-1.5 h-1.5 rounded-full {{ $colors['badge_dot'] }} flex-shrink-0"></span>
                    <span class="text-[11px] font-semibold tracking-wide">{{ $balita['status'] }}</span>
                </div>
                
                {{-- Status Validasi Badge --}}
                @if(isset($balita['status_validasi']) && $balita['status_validasi'])
                    @php
                        $valColors = match($balita['status_validasi']) {
                            'pending' => 'bg-amber-50 text-amber-700 border-amber-200/60',
                            'approved' => 'bg-emerald-50 text-emerald-700 border-emerald-200/60',
                            'rejected' => 'bg-rose-50 text-rose-700 border-rose-200/60',
                            default => 'bg-slate-50 text-slate-700 border-slate-200'
                        };
                        $valIcon = match($balita['status_validasi']) {
                            'pending' => '<svg class="w-3 h-3 text-amber-600 shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z" clip-rule="evenodd" /></svg>',
                            'approved' => '<svg class="w-3 h-3 text-emerald-600 shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg>',
                            'rejected' => '<svg class="w-3 h-3 text-rose-600 shrink-0" viewBox="0 0 20 20" fill="currentColor"><path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" /></svg>',
                            default => ''
                        };
                    @endphp
                    <div class="inline-flex items-center gap-1 {{ $valColors }} px-2.5 py-0.5 rounded-full border shadow-sm">
                        {!! $valIcon !!}
                        <span class="text-[10px] font-bold uppercase tracking-wide">{{ $balita['status_validasi'] }}</span>
                    </div>
                @endif
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-1.5 mt-1 lg:mt-1.5">
                {{-- Outline: Detail --}}
                <a href="{{ route('balita.show', $balita['id'] ?? '') }}"
                   class="h-[36px] px-3 flex items-center justify-center text-[12px] font-bold text-slate-600 bg-white border border-slate-200 hover:border-slate-300 hover:bg-slate-50 hover:text-slate-800 rounded-[10px] shadow-sm transition-all duration-150 cursor-pointer">
                    Detail
                </a>
                {{-- Primary: Ukur --}}
                <a href="{{ route('balita.show', ['id' => $balita['id'] ?? '', 'action' => 'ukur']) }}"
                   class="h-[36px] px-4 flex items-center justify-center bg-teal-600 hover:bg-teal-500 text-white text-[12px] font-bold rounded-[10px] shadow-[0_1px_3px_rgba(13,148,136,0.25)] hover:shadow-[0_2px_8px_rgba(13,148,136,0.35)] transition-all duration-150 cursor-pointer">
                    Ukur
                </a>
            </div>
        </div>

    </div>
</div>
