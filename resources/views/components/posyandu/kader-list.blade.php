@props(['kaders', 'posyanduId'])

<div class="flex flex-col h-full relative">
    <div class="pb-3 flex items-center justify-between shrink-0">
        <h3 class="font-extrabold text-slate-800 flex items-center gap-2 text-[15px]">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                class="w-5 h-5 text-emerald-600">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
            </svg>
            Daftar Kader
        </h3>
        <span class="text-emerald-600 text-[11px] font-bold">{{ count($kaders) }} Kader Terdaftar</span>
    </div>

    <div class="flex-1 overflow-y-auto hide-scrollbar pb-2">
        <div class="flex flex-col gap-3">
            @forelse($kaders as $kader)
                <div
                    class="bg-white rounded-[1.25rem] p-4 flex items-center justify-between shadow-sm border border-slate-100 transition-all group relative overflow-hidden gap-2">

                    <div class="flex items-center gap-3 min-w-0">
                        @php
                            $colors = ['teal', 'emerald', 'blue', 'indigo', 'rose', 'amber'];
                            $colorIndex = crc32($kader['nama']) % count($colors);
                            $color = $colors[$colorIndex];

                            $bgClass = "bg-{$color}-100/80 text-{$color}-700 shadow-inner shadow-{$color}-200/50";
                        @endphp
                        <div
                            class="w-11 h-11 rounded-full {{ $bgClass }} font-black text-lg flex items-center justify-center shrink-0">
                            {{ substr($kader['nama'], 0, 1) }}
                        </div>
                        <div class="min-w-0">
                            <h4 class="text-[14px] font-extrabold text-slate-800 truncate" title="{{ $kader['nama'] }}">
                                {{ $kader['nama'] }}</h4>
                            <div class="flex items-center gap-2 mt-0.5">
                                <span
                                    class="text-[10px] text-emerald-600 font-bold bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-100/50 whitespace-nowrap">Kader
                                    Aktif</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 shrink-0">
                        <div class="hidden sm:flex flex-col items-end text-right mr-1">
                            @if (($kader['aktivitas_bulan_ini'] ?? 0) > 0)
                                <span
                                    class="text-[14px] font-black text-emerald-600 leading-none whitespace-nowrap">{{ $kader['aktivitas_bulan_ini'] }}
                                    Pengukuran</span>
                                <span
                                    class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1 whitespace-nowrap">Bulan
                                    Ini</span>
                            @else
                                <span class="text-[14px] font-black text-slate-400 leading-none whitespace-nowrap">0
                                    Pengukuran</span>
                                <span
                                    class="text-[9px] text-slate-400 font-bold uppercase tracking-widest mt-1 whitespace-nowrap">Terakhir:
                                    {{ \Carbon\Carbon::parse($kader['terakhir_aktif'] ?? 'now')->translatedFormat('d M') }}</span>
                            @endif
                        </div>

                        @if (!empty($kader['no_hp']))
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $kader['no_hp']) }}" target="_blank"
                                class="w-9 h-9 rounded-full bg-emerald-50 border border-emerald-100 hover:bg-emerald-500 hover:text-white text-emerald-600 flex items-center justify-center transition-all duration-300 shadow-sm shrink-0"
                                title="Hubungi via WhatsApp">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12.01 2.01c-5.52 0-9.99 4.47-9.99 9.99 0 1.76.46 3.4 1.25 4.81L2 22l5.34-1.25c1.39.75 2.99 1.18 4.67 1.18 5.52 0 9.99-4.47 9.99-9.99S17.53 2.01 12.01 2.01zm5.54 14.15c-.24.69-1.39 1.25-1.93 1.34-.49.08-1.12.15-3.32-.76-2.65-1.09-4.34-3.8-4.48-3.98-.12-.17-1.07-1.42-1.07-2.7 0-1.28.66-1.92.89-2.17.22-.24.47-.29.63-.29.16 0 .32 0 .45.01.14.01.32-.05.5.39.18.45.62 1.51.68 1.62.05.12.09.25.01.41-.08.16-.12.25-.24.4-.12.14-.25.33-.35.42-.12.11-.25.23-.11.47.14.24.63 1.04 1.36 1.69.93.84 1.7 1.1 1.94 1.22.24.11.38.09.52-.07.14-.16.6-.7.77-.94.16-.24.32-.2.54-.12.22.08 1.39.66 1.63.78.24.12.4.18.46.28.05.1.05.6-.2 1.29z" />
                                </svg>
                            </a>
                        @endif

                    </div>
                </div>
            @empty
                <div
                    class="flex flex-col items-center justify-center p-8 bg-white rounded-2xl border border-slate-100 border-dashed text-slate-400 gap-3 h-32">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-10 h-10 opacity-50">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                    <span class="text-sm font-bold">Belum ada kader terdaftar.</span>
                </div>
            @endforelse
        </div>

        <!-- Tambah Button -->
        <div class="pt-4 shrink-0 mt-1">
            <button type="button" data-open-modal="kaderModal"
                class="w-full py-3 rounded-xl bg-emerald-50/50 text-emerald-600 font-bold text-sm hover:bg-emerald-50 transition-colors flex items-center justify-center gap-2 border border-emerald-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Kader Baru
            </button>
        </div>
    </div>
</div>
