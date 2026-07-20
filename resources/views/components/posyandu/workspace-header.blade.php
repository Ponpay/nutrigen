@props(['posyandu'])

<div class="flex flex-col md:flex-row md:items-center justify-start gap-4 lg:gap-5 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-[2rem] p-5 lg:p-6 shadow-xl shadow-emerald-500/20 shrink-0 relative overflow-hidden">
    <!-- SVG Village/Houses Background Mockup -->
    <div class="absolute right-0 bottom-0 opacity-20 pointer-events-none">
        <svg width="400" height="150" viewBox="0 0 400 150" fill="none" xmlns="http://www.w3.org/2000/svg">
            <!-- Simple Village Silhouette -->
            <path d="M350 150V80L300 40L250 80V150H350Z" fill="white"/>
            <path d="M280 150V110H320V150H280Z" fill="#10b981"/>
            <path d="M220 150V90L180 50L140 90V150H220Z" fill="white"/>
            <path d="M160 150V120H200V150H160Z" fill="#10b981"/>
            <path d="M110 150V100L80 70L50 100V150H110Z" fill="white"/>
            <path d="M30 150V110L0 80V150H30Z" fill="white"/>
            <circle cx="350" cy="30" r="15" fill="white" fill-opacity="0.5"/>
            <!-- Trees -->
            <path d="M120 150V120C120 120 100 120 110 90C120 60 150 90 140 120C130 150 120 150 120 150Z" fill="white" fill-opacity="0.8"/>
            <path d="M240 150V130C240 130 220 130 230 100C240 70 270 100 260 130C250 150 240 150 240 150Z" fill="white" fill-opacity="0.6"/>
        </svg>
    </div>
    
    <!-- Grain overlay for premium texture -->
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0IiBoZWlnaHQ9IjQiPgo8cmVjdCB3aWR0aD0iNCIgaGVpZ2h0PSI0IiBmaWxsPSIjZmZmIiBmaWxsLW9wYWNpdHk9IjAuMDUiLz4KPC9zdmc+')] opacity-20 mix-blend-overlay pointer-events-none"></div>

        <!-- Mobile Back Button -->
        <a href="{{ route('puskesmas.posyandu') }}" class="lg:hidden flex items-center justify-center w-12 h-12 rounded-[1.25rem] bg-white/20 text-white backdrop-blur-md border border-white/30 shrink-0 hover:bg-white/30 transition-colors shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
        </a>

        <!-- Icon -->
        <div class="hidden sm:flex w-14 h-14 lg:w-16 lg:h-16 rounded-[1.25rem] bg-white items-center justify-center text-teal-600 shadow-md shrink-0 relative group">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 lg:w-8 lg:h-8 group-hover:scale-110 group-hover:rotate-6 transition-transform duration-300">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" />
            </svg>
        </div>
        
        <!-- Info -->
        <div class="flex flex-col justify-center mt-0.5">
            <div class="flex flex-col gap-1.5 mt-2">
                <div class="flex items-center gap-4">
                    <h1 class="text-2xl lg:text-3xl font-black text-white tracking-tight leading-tight drop-shadow-md">
                        {{ $posyandu['nama'] }}
                    </h1>
                    <span class="hidden sm:inline-block px-2.5 py-0.5 rounded-full bg-white/20 text-white text-[10px] font-bold uppercase tracking-widest border border-white/30 shadow-sm backdrop-blur-sm">Aktif</span>
                </div>
                
                @php
                    $total_balita = $posyandu['stats']['total_balita'] ?? 0;
                    $diukur = $posyandu['stats']['diukur_bulan_ini'] ?? 0;
                @endphp
                <p class="text-emerald-50 text-sm font-medium max-w-xl">
                    Posyandu aktif dengan <strong>{{ $total_balita }} balita terdaftar</strong> dan mencatat <strong>{{ $diukur }} aktivitas pengukuran</strong> bulan ini.
                </p>
            </div>
            
            <div class="flex items-center gap-1.5 mt-2 text-emerald-50/80 text-[13px]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-emerald-200">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                </svg>
                <span>Desa {{ $posyandu['desa'] }}, {{ $posyandu['alamat'] }}</span>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3 mt-4">
                <div class="flex items-center gap-1.5 text-xs font-semibold text-white/90 bg-white/10 px-3 py-1.5 rounded-lg border border-white/20 backdrop-blur-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-emerald-100">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                    <span>Berdiri: 12 Jan 2020</span>
                </div>
                
                <div class="flex items-center gap-1.5 text-xs font-semibold text-white/90 bg-white/10 px-3 py-1.5 rounded-lg border border-white/20 backdrop-blur-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-emerald-100">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                    </svg>
                    <span>Kode: POS-001</span>
                </div>
        </div>
    </div>
</div>
