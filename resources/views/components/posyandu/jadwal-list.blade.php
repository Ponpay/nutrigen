@props(['jadwals'])

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col h-full">
    <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between shrink-0 bg-slate-50">
        <h3 class="font-bold text-slate-800 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-blue-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
            </svg>
            Agenda Terdekat
        </h3>
        <span class="bg-blue-100 text-blue-800 text-[10px] font-bold px-2 py-0.5 rounded-full">{{ count($jadwals) }} Jadwal</span>
    </div>

    <div class="flex-1 overflow-y-auto hide-scrollbar p-0">
        @forelse($jadwals as $jadwal)
            <div class="p-4 border-b border-slate-50 last:border-0 hover:bg-slate-50 transition-colors relative pl-6">
                <!-- Timeline line -->
                <div class="absolute left-[13px] top-6 bottom-0 w-[2px] bg-slate-100 last:hidden"></div>
                <!-- Timeline dot -->
                <div class="absolute left-2.5 top-5 w-2 h-2 rounded-full bg-blue-500 ring-4 ring-blue-50"></div>

                <div class="ml-4">
                    <h4 class="text-sm font-bold text-slate-800">{{ $jadwal['judul'] }}</h4>
                    <div class="flex items-center gap-4 mt-2">
                        <div class="flex items-center gap-1.5 text-xs text-slate-600 font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-slate-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ \Carbon\Carbon::parse($jadwal['tanggal'])->translatedFormat('d M Y') }} • {{ substr($jadwal['waktu_mulai'], 0, 5) }}
                        </div>
                    </div>
                    
                    @if(!empty($jadwal['lokasi']))
                    <div class="flex items-center gap-1.5 text-xs text-slate-500 mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-slate-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        {{ $jadwal['lokasi'] }}
                    </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="flex flex-col items-center justify-center p-8 text-slate-400 gap-2 h-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 opacity-50">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008z" />
                </svg>
                <span class="text-sm">Belum ada jadwal terdaftar bulan ini.</span>
            </div>
        @endforelse
    </div>
</div>
