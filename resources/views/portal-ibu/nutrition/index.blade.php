<x-layout.mobile-shell>
    <div x-data="{ state: '{{ $pageState ?? 'normal' }}', openRecipe: false }" class="flex-1 overflow-y-auto hide-scrollbar flex flex-col relative pb-[120px] pb-safe w-full bg-white">
        
        <!-- HEADER -->
        <header class="sticky top-0 z-30 bg-white/90 backdrop-blur-xl px-5 pt-8 pb-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <button class="w-10 h-10 rounded-full bg-white border border-slate-100 shadow-sm flex items-center justify-center text-slate-700 active:scale-95 transition-transform focus:outline-none" onclick="history.back()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </button>
                <div>
                    <h2 class="text-[13px] font-bold tracking-tight text-teal-500 leading-none mb-1">Edukasi</h2>
                    <h1 class="text-[19px] font-black text-slate-800 leading-none tracking-tight">Gizi & Menu</h1>
                </div>
            </div>
            
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-teal-50 text-teal-600 flex items-center justify-center font-bold text-[15px]">
                    {{ $user['initials'] ?? 'A' }}
                </div>
                <div class="relative">
                    <button class="w-10 h-10 rounded-full bg-white border border-slate-100 shadow-sm flex items-center justify-center text-slate-700 active:scale-95 transition-transform focus:outline-none">
                        <svg class="w-[20px] h-[20px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </button>
                    <!-- Red Dot -->
                    <div class="absolute top-2 right-2.5 w-[7px] h-[7px] bg-rose-500 rounded-full"></div>
                </div>
            </div>
        </header>

        <div class="px-5 pt-2 pb-6 space-y-7 flex-1 flex flex-col">
            
            <!-- 1. HERO BANNER: Khusus untuk si Kecil -->
            <div class="bg-gradient-to-br from-[#F0F9FF] to-[#F8FAFC] border border-blue-50 rounded-[32px] p-5 shadow-[0_4px_24px_rgba(2,132,199,0.03)] relative overflow-hidden">
                <div class="relative z-10 w-[70%]">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-7 h-7 rounded-full bg-blue-600 text-white flex items-center justify-center shadow-sm">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.381z" clip-rule="evenodd"></path></svg>
                        </div>
                        <span class="bg-blue-100/80 text-blue-700 px-2.5 py-1 rounded-full text-[9.5px] font-black uppercase tracking-widest">Informasi Penting</span>
                    </div>
                    <h2 class="text-[17.5px] font-black text-slate-800 mb-2 leading-tight tracking-tight">Khusus untuk si Kecil</h2>
                    <p class="text-[12px] font-medium text-slate-500 leading-relaxed">
                        {{ $trustBannerMessage ?? 'Tingkatkan asupan protein hewani (telur, ikan, daging) dan kalori pada setiap kali makan.' }}
                    </p>
                </div>
                
                <!-- Illustration Container (Reusable / Replaceable) -->
                <!-- Layout is structured so that even without this illustration, the banner remains premium with white space -->
                <div class="absolute right-[-15px] bottom-[-15px] w-40 h-40 flex items-center justify-center pointer-events-none opacity-95">
                    <!-- Placeholder using simple SVG elements representing a healthy bowl -->
                    <svg viewBox="0 0 100 100" class="w-full h-full">
                        <!-- Bowl base -->
                        <circle cx="50" cy="65" r="30" fill="#E0F2FE" />
                        <path d="M20 60 Q50 95 80 60 Z" fill="#BAE6FD" />
                        <!-- Egg -->
                        <circle cx="35" cy="50" r="14" fill="white" />
                        <circle cx="37" cy="52" r="6" fill="#FBBF24" />
                        <!-- Salmon piece -->
                        <path d="M50 45 Q70 38 80 50 Q65 65 50 45 Z" fill="#FCA5A5" />
                        <path d="M55 45 L72 52 M58 49 L70 56 M62 55 L68 59" stroke="white" stroke-width="1.5" stroke-linecap="round" />
                        <!-- Greens -->
                        <path d="M60 35 Q75 20 85 35 Q75 50 60 35 Z" fill="#86EFAC" />
                        <path d="M70 30 Q80 20 90 35 Q80 45 70 30 Z" fill="#4ADE80" />
                    </svg>
                </div>
            </div>

            <!-- 2. IDE RESEP HARI INI -->
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-[42px] h-[42px] rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center shrink-0">
                        <svg class="w-[20px] h-[20px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-[17px] font-black text-slate-800 tracking-tight leading-tight mb-0.5">Ide Resep Hari Ini</h3>
                        <p class="text-[12px] font-medium text-slate-500">Resep praktis dan bernutrisi untuk si Kecil</p>
                    </div>
                </div>

                @if(!empty($heroMeal))
                    <!-- Render dynamic recipe card if available from backend -->
                    <div class="relative w-full rounded-[32px] overflow-hidden shadow-[0_8px_30px_rgba(0,0,0,0.06)] border border-slate-100 group cursor-pointer active:scale-[0.98] transition-transform" x-on:click="openRecipe = true">
                        <div class="h-56 w-full bg-slate-100 relative">
                            <img src="{{ asset('images/menu/' . ($heroMeal['image'] ?? 'placeholder.jpg')) }}" 
                                 alt="{{ $heroMeal['title'] ?? 'Menu Utama' }}" 
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-95"></div>
                        </div>
                        <div class="absolute bottom-0 left-0 w-full p-6 text-white flex flex-col justify-end">
                            <h3 class="text-[22px] font-black leading-tight tracking-tight mb-4 drop-shadow-sm border border-slate-200/60">{{ $heroMeal['title'] ?? 'Menu Hari Ini' }}</h3>
                            <button class="w-full bg-emerald-500 text-white font-extrabold py-3.5 rounded-full text-[14px] flex justify-center items-center">
                                Lihat Resep
                            </button>
                        </div>
                    </div>
                @else
                    <!-- EMPTY STATE: Tips Nutrisi Si Kecil (Purple Card) -->
                    <div class="bg-white border border-slate-100 rounded-[32px] p-6 text-center flex flex-col items-center shadow-[0_8px_30px_rgba(0,0,0,0.02)] relative overflow-hidden">
                        <!-- Soft purple glow at the top -->
                        <div class="absolute top-0 left-0 right-0 h-32 bg-gradient-to-b from-[#F3E8FF] to-transparent opacity-40 pointer-events-none"></div>
                        
                        <div class="relative z-10 flex flex-col items-center w-full">
                            <div class="w-[52px] h-[52px] rounded-full bg-[#F3E8FF] text-[#7C3AED] flex items-center justify-center mb-4 mt-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <h3 class="text-[17.5px] font-black text-[#6D28D9] tracking-tight mb-2.5">Tips Nutrisi Si Kecil</h3>
                            <p class="text-[12px] font-medium text-slate-500 leading-relaxed mb-6 max-w-[90%]">
                                Rekomendasi resep personalisasi khusus untuk anak Anda sedang dalam tahap pengembangan MVP V3.
                            </p>
                            <button class="w-full bg-[#7C3AED] active:bg-[#6D28D9] text-white font-extrabold py-3.5 rounded-full transition-colors text-[14px] flex justify-center items-center gap-2 focus:outline-none">
                                <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                Lihat Tips & Resep
                                <svg class="w-[14px] h-[14px] ml-1 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                            </button>
                        </div>
                    </div>
                @endif
            </div>

            <!-- 3. IDE PRAKTIS LAINNYA -->
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-[42px] h-[42px] rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center shrink-0">
                        <svg class="w-[20px] h-[20px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-[17px] font-black text-slate-800 tracking-tight leading-tight mb-0.5">Ide Praktis Lainnya</h3>
                        <p class="text-[12px] font-medium text-slate-500">Pilihan kaya gizi untuk variasi makan si Kecil</p>
                    </div>
                </div>

                <div class="flex flex-col gap-3">
                    @forelse($alternatives ?? [] as $meal)
                        <!-- Dynamic Item Ready for Future Realtime Data -->
                        <button class="bg-white border border-slate-100 rounded-[24px] p-4 flex items-center justify-between shadow-[0_4px_20px_rgba(0,0,0,0.02)] active:scale-[0.98] transition-transform text-left">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-emerald-50 flex items-center justify-center shrink-0">
                                    <img src="{{ asset('images/menu/' . ($meal['image'] ?? 'placeholder.jpg')) }}" class="w-8 h-8 rounded-full object-cover">
                                </div>
                                <div>
                                    <h4 class="text-[14.5px] font-black text-slate-800 mb-0.5">{{ $meal['title'] }}</h4>
                                    <p class="text-[11.5px] font-medium text-slate-500">{{ $meal['calories'] }}</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    @empty
                        <!-- EMPTY STATE BANNER (Rendered automatically if $alternatives is empty, No dummy items) -->
                        <div class="bg-gradient-to-r from-[#F0FDF4] to-[#F8FAFC] border border-emerald-50 rounded-[28px] p-5 flex items-center gap-4 shadow-[0_4px_20px_rgba(16,185,129,0.03)] mt-1 relative overflow-hidden">
                            <!-- Empty State Illustration Container -->
                            <div class="w-[65px] h-[65px] shrink-0 relative flex items-center justify-center z-10">
                                <!-- Reusable Illustration Block -->
                                <svg viewBox="0 0 100 100" class="w-full h-full">
                                    <!-- Clipboard -->
                                    <rect x="25" y="20" width="50" height="65" rx="5" fill="#10B981" />
                                    <rect x="30" y="25" width="40" height="55" rx="2" fill="white" />
                                    <!-- Clip -->
                                    <rect x="40" y="10" width="20" height="15" rx="3" fill="#34D399" />
                                    <!-- Lines -->
                                    <line x1="40" y1="40" x2="60" y2="40" stroke="#9CA3AF" stroke-width="4" stroke-linecap="round" />
                                    <line x1="40" y1="55" x2="55" y2="55" stroke="#9CA3AF" stroke-width="4" stroke-linecap="round" />
                                    <line x1="40" y1="70" x2="60" y2="70" stroke="#9CA3AF" stroke-width="4" stroke-linecap="round" />
                                    <!-- Checkmarks -->
                                    <path d="M30 40 L35 45 L42 35" stroke="#34D399" stroke-width="3" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M30 55 L35 60 L42 50" stroke="#D1D5DB" stroke-width="3" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                                    <!-- Carrot -->
                                    <path d="M15 75 Q25 90 35 75 Q25 60 15 75 Z" fill="#F97316" />
                                    <path d="M12 72 Q5 65 10 60 Q15 65 15 70" stroke="#22C55E" stroke-width="3" fill="none" stroke-linecap="round" />
                                    <!-- Broccoli -->
                                    <circle cx="80" cy="70" r="10" fill="#22C55E" />
                                    <circle cx="72" cy="75" r="8" fill="#16A34A" />
                                    <circle cx="88" cy="78" r="9" fill="#15803D" />
                                    <circle cx="80" cy="85" r="6" fill="#15803D" />
                                </svg>
                                <!-- Floating Check / Sparkles -->
                                <div class="absolute top-[-5px] left-[-5px] text-emerald-400 opacity-80">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                </div>
                            </div>
                            
                            <div class="flex-1 relative z-10 pt-0.5">
                                <h4 class="text-[13px] font-black text-slate-800 mb-1.5 leading-tight tracking-tight">Belum ada alternatif menu hari ini.</h4>
                                <p class="text-[11.5px] font-medium text-slate-500 leading-relaxed pr-2">Kami akan menambahkan inspirasi menu lain untuk Anda di sini.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
        
        <!-- Recipe Bottom Sheet Component -->
        <x-domain.recipe-bottom-sheet :recipe="$heroMeal ?? []" />
    </div>

    <!-- BOTTOM NAVIGATION -->
    <x-navigation.bottom-navigation active="nutrition" />
</x-layout.mobile-shell>
