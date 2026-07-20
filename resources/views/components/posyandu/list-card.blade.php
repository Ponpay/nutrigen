@props(['posyandu', 'isActive' => false])

<a href="{{ route('puskesmas.posyandu', ['id' => $posyandu['id']]) }}" class="block text-left w-full transition-all duration-300 px-5 py-4 relative group rounded-[1rem] border {{ $isActive ? 'bg-white border-transparent border-l-[4px] border-l-emerald-500 shadow-[0_4px_20px_-4px_rgba(16,185,129,0.15)] ring-1 ring-emerald-200/60' : 'bg-white border-slate-100 hover:border-emerald-200 hover:shadow-sm' }}">
    


    <div class="flex justify-between items-start mb-2.5 gap-3 relative z-10">
        <div class="min-w-0 pr-4">
            <h3 class="text-[15px] font-extrabold truncate {{ $isActive ? 'text-slate-800 tracking-tight' : 'text-slate-700 group-hover:text-slate-900' }}">
                {{ $posyandu['nama'] }}
            </h3>
            <div class="flex items-center gap-1.5 text-[11px] font-medium {{ $isActive ? 'text-slate-500' : 'text-slate-400' }} mt-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                </svg>
                <span>Desa {{ $posyandu['desa'] }}</span>
            </div>
        </div>
        
        <div class="flex flex-col items-end shrink-0 gap-2">
            @if($isActive)
                <span class="px-2 py-0.5 rounded-full bg-emerald-100/80 text-emerald-700 text-[9px] font-bold uppercase tracking-widest border border-emerald-200/50 shadow-sm">Aktif</span>
            @endif
            <div class="flex flex-col items-end">
                <span class="text-xl font-black {{ $isActive ? 'text-slate-800' : 'text-slate-700' }} leading-none">{{ $posyandu['balita_count'] }}</span>
                <span class="text-[9px] text-slate-400 font-bold uppercase tracking-widest mt-1">Balita</span>
            </div>
        </div>
    </div>
    
    <div class="flex items-center gap-2 mt-3 relative z-10">
        <div class="flex items-center gap-1 bg-white text-slate-500 border-slate-100 border px-2.5 py-1 rounded-md text-[10px] font-bold shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3 text-slate-400">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
            </svg>
            {{ $posyandu['kader_count'] ?? count($posyandu['kaders'] ?? []) }} Kader
        </div>
        
        @if(isset($posyandu['has_jadwal_this_month']) && $posyandu['has_jadwal_this_month'])
        <div class="flex items-center gap-1 {{ $isActive ? 'bg-white/60 text-emerald-700 border-emerald-100' : 'bg-blue-50/50 text-blue-600 border-blue-50' }} border px-2.5 py-1 rounded-md text-[10px] font-bold transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
            </svg>
            Ada Jadwal
        </div>
        @endif
    </div>
</a>
