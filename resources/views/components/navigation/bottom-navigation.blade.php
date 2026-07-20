@props(['active' => 'home'])

<nav class="fixed bottom-6 left-1/2 -translate-x-1/2 w-[calc(100%-2.5rem)] max-w-[340px] bg-white/80 backdrop-blur-3xl px-3 py-3 shadow-[0_8px_32px_-8px_rgba(0,0,0,0.15)] rounded-full border border-white/60 z-50 flex justify-between items-center transition-all duration-300">
    
    <!-- Beranda Tab -->
    <a href="{!! \Illuminate\Support\Facades\URL::signedRoute('portal-ibu.home', ['balita' => request('balita')]) !!}" class="flex-1 flex justify-center focus:outline-none group active:scale-[0.96] transition-transform relative">
        @if($active === 'home')
            <div class="flex flex-col items-center text-emerald-600">
                <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 24 24"><path d="M11.4 1.2c.4-.3 1-.3 1.3 0l9.3 7.8c.4.3.6.8.6 1.3V20c0 1.1-.9 2-2 2h-4c-1.1 0-2-.9-2-2v-3c0-.6-.4-1-1-1h-2c-.6 0-1 .4-1 1v3c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2v-9.7c0-.5.2-1 .6-1.3l8.8-7.8z"/></svg>
                <span class="text-[10px] font-bold tracking-tight leading-none">Beranda</span>
                <div class="absolute -bottom-3 w-1 h-1 bg-emerald-600 rounded-full"></div>
            </div>
        @else
            <div class="flex flex-col items-center text-gray-400 group-hover:text-gray-500 transition-colors">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span class="text-[10px] font-semibold tracking-tight leading-none opacity-0 group-hover:opacity-100 transition-opacity">Beranda</span>
            </div>
        @endif
    </a>
    
    <!-- Gizi & Menu Tab -->
    <a href="{!! \Illuminate\Support\Facades\URL::signedRoute('portal-ibu.nutrition', ['balita' => request('balita')]) !!}" class="flex-1 flex justify-center focus:outline-none group active:scale-[0.96] transition-transform relative">
        @if($active === 'nutrition')
            <div class="flex flex-col items-center text-emerald-600">
                <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                <span class="text-[10px] font-bold tracking-tight leading-none">Nutrisi</span>
                <div class="absolute -bottom-3 w-1 h-1 bg-emerald-600 rounded-full"></div>
            </div>
        @else
            <div class="flex flex-col items-center text-gray-400 group-hover:text-gray-500 transition-colors">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                <span class="text-[10px] font-semibold tracking-tight leading-none opacity-0 group-hover:opacity-100 transition-opacity">Nutrisi</span>
            </div>
        @endif
    </a>

    <!-- Posyandu Tab -->
    <a href="{!! \Illuminate\Support\Facades\URL::signedRoute('portal-ibu.posyandu', ['balita' => request('balita')]) !!}" class="flex-1 flex justify-center focus:outline-none group active:scale-[0.96] transition-transform relative">
        @if($active === 'posyandu')
            <div class="flex flex-col items-center text-emerald-600">
                <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                <span class="text-[10px] font-bold tracking-tight leading-none">Posyandu</span>
                <div class="absolute -bottom-3 w-1 h-1 bg-emerald-600 rounded-full"></div>
            </div>
        @else
            <div class="flex flex-col items-center text-gray-400 group-hover:text-gray-500 transition-colors">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                <span class="text-[10px] font-semibold tracking-tight leading-none opacity-0 group-hover:opacity-100 transition-opacity">Posyandu</span>
            </div>
        @endif
    </a>
</nav>
