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
    <div class="pl-5 pr-4 pt-4 pb-4">

        {{-- Top: Avatar + Info --}}
        <div class="flex items-center gap-3 mb-4">
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

        {{-- Context Tag (optional) --}}
        @if(isset($balita['context_tag']))
        <div class="mb-3">
            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-slate-50 border border-slate-200/70 text-slate-500 text-[11px] font-normal">
                {{ $balita['context_tag'] }}
            </span>
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
                            'pending' => 'bg-amber-50 text-amber-700',
                            'approved' => 'bg-emerald-50 text-emerald-700',
                            'rejected' => 'bg-rose-50 text-rose-700',
                            default => 'bg-slate-50 text-slate-700'
                        };
                        $valIcon = match($balita['status_validasi']) {
                            'pending' => '⏳',
                            'approved' => '✔',
                            'rejected' => '✖',
                            default => ''
                        };
                    @endphp
                    <div class="flex items-center gap-1 {{ $valColors }} px-2.5 py-1 rounded-full border border-slate-200/50 shadow-sm">
                        <span class="text-[10px] leading-none">{{ $valIcon }}</span>
                        <span class="text-[10.5px] font-bold uppercase tracking-wide">{{ $balita['status_validasi'] }}</span>
                    </div>
                @endif
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-1 mt-1">
                {{-- Ghost: Detail --}}
                <a href="{{ route('balita.show', $balita['id'] ?? '') }}"
                   class="h-9 px-3 flex items-center text-[12px] font-medium text-slate-400 hover:text-slate-700 hover:bg-slate-50 rounded-xl transition-colors duration-150 cursor-pointer">
                    Detail
                </a>
                {{-- Primary: Ukur --}}
                <a href="{{ route('balita.show', ['id' => $balita['id'] ?? '', 'action' => 'ukur']) }}"
                   class="h-9 px-4 flex items-center bg-emerald-600 hover:bg-emerald-500 text-white text-[12px] font-semibold rounded-xl shadow-[0_1px_3px_rgba(16,185,129,0.25)] hover:shadow-[0_2px_8px_rgba(16,185,129,0.35)] transition-all duration-150 cursor-pointer">
                    Ukur
                </a>
            </div>
        </div>

    </div>
</div>
