@props(['posyandu'])

<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-5 lg:p-6 border-b border-slate-200 shrink-0 relative overflow-hidden">
    <!-- Decorator -->
    <div class="absolute right-0 top-0 w-32 h-32 bg-gradient-to-br from-teal-50 to-emerald-50 rounded-full blur-2xl -mr-10 -mt-10 pointer-events-none"></div>

    <div class="flex items-start gap-4 relative z-10">
        <!-- Icon -->
        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-teal-500 to-emerald-600 flex items-center justify-center text-white shadow-md shadow-teal-200 shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" />
            </svg>
        </div>
        
        <!-- Info -->
        <div>
            <h1 class="text-xl lg:text-2xl font-extrabold text-slate-800 tracking-tight leading-tight">
                {{ $posyandu['nama'] }}
            </h1>
            <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3 mt-1">
                <div class="flex items-center gap-1 text-xs text-slate-500 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                    <span>Desa {{ $posyandu['desa'] }}</span>
                </div>
                <span class="hidden sm:inline text-slate-300">•</span>
                <div class="flex items-center gap-1 text-xs text-slate-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                    </svg>
                    <span>{{ $posyandu['alamat'] }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
