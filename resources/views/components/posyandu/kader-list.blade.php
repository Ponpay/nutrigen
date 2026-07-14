@props(['kaders'])

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col h-full">
    <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between shrink-0 bg-slate-50">
        <h3 class="font-bold text-slate-800 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-teal-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
            </svg>
            Daftar Kader
        </h3>
        <span class="bg-teal-100 text-teal-800 text-[10px] font-bold px-2 py-0.5 rounded-full">{{ count($kaders) }} Relawan</span>
    </div>

    <div class="flex-1 overflow-y-auto hide-scrollbar p-0">
        @forelse($kaders as $kader)
            <div class="flex items-center justify-between p-4 border-b border-slate-50 last:border-0 hover:bg-slate-50 transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-teal-100 text-teal-700 font-bold flex items-center justify-center shrink-0">
                        {{ substr($kader['nama'], 0, 1) }}
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-800">{{ $kader['nama'] }}</h4>
                        <div class="flex items-center gap-2 mt-0.5">
                            <span class="text-[10px] text-slate-500 font-medium">NIK: {{ substr($kader['nik'], 0, 6) }}******</span>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center gap-3">
                    <div class="hidden sm:flex flex-col items-end text-right mr-2">
                        @if(($kader['aktivitas_bulan_ini'] ?? 0) > 0)
                            <span class="text-xs font-bold text-emerald-600">{{ $kader['aktivitas_bulan_ini'] }} balita</span>
                            <span class="text-[9px] text-slate-400 font-medium">diukur bulan ini</span>
                        @else
                            <span class="text-xs font-bold text-slate-400">Belum aktif</span>
                            <span class="text-[9px] text-slate-400 font-medium">Terakhir: {{ \Carbon\Carbon::parse($kader['terakhir_aktif'] ?? 'now')->translatedFormat('d M') }}</span>
                        @endif
                    </div>

                    @if(!empty($kader['no_hp']))
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $kader['no_hp']) }}" target="_blank" class="w-8 h-8 rounded-full bg-emerald-50 hover:bg-emerald-100 text-emerald-600 flex items-center justify-center transition-colors shadow-sm shrink-0" title="Hubungi via WhatsApp">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-4 h-4">
                        <path fill-rule="evenodd" d="M1.026 10.165A10.985 10.985 0 001.5 12c0 1.942.502 3.766 1.397 5.378l-1.35 4.93a1.5 1.5 0 001.874 1.875l4.93-1.35A10.985 10.985 0 0012 22.5c6.075 0 11-4.925 11-11s-4.925-11-11-11-11 4.925-11 11zm3.83-4.22c.243-.448.653-.787 1.134-.935l1.643-.506c.642-.198 1.348.067 1.688.636l1.246 2.083c.33.551.272 1.258-.14 1.758l-.668.809a.75.75 0 00-.142.748c.571 1.547 1.83 2.806 3.377 3.377a.75.75 0 00.748-.142l.81-.668c.499-.412 1.206-.47 1.757-.14l2.083 1.246c.57.34.834 1.046.636 1.688l-.506 1.643c-.148.481-.487.891-.935 1.134A7.472 7.472 0 0112 19.5c-4.142 0-7.5-3.358-7.5-7.5a7.473 7.473 0 011.356-4.055z" clip-rule="evenodd" />
                    </svg>
                </a>
                @endif
                </div>
            </div>
        @empty
            <div class="flex flex-col items-center justify-center p-8 text-slate-400 gap-2 h-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 opacity-50">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
                <span class="text-sm">Belum ada kader terdaftar.</span>
            </div>
        @endforelse
    </div>
</div>
