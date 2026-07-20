<x-layout.mobile-shell>
    <div x-data="{ state: '{{ $pageState ?? 'normal' }}', openRecipe: false }" class="flex-1 overflow-y-auto hide-scrollbar flex flex-col relative pb-[100px] pb-safe w-full">
        
        <!-- HEADER (Root Page) -->
        <header class="sticky top-0 z-30 bg-slate-50/90 backdrop-blur-xl px-5 pt-8 pb-4 flex items-center justify-between border-b border-gray-100/50">
            <h1 class="text-[24px] font-extrabold text-gray-900 tracking-tighter">Gizi & Menu</h1>
            <x-ui.avatar src="{{ $user['avatar'] ?? null }}" initials="{{ $user['initials'] ?? 'A' }}" size="w-10 h-10" />
        </header>

        <div class="px-5 pt-6 pb-6 space-y-6 flex-1 flex flex-col">
            
            <!-- LOADING STATE -->
            <template x-if="state === 'loading'">
                <x-feedback.loading-state class="top-16" />
            </template>

            <!-- ERROR STATE -->
            <template x-if="state === 'error'">
                <div class="mt-20">
                    <x-feedback.error-state />
                </div>
            </template>

            <!-- EMPTY STATE -->
            <template x-if="state === 'empty'">
                <div class="mt-10">
                    <x-feedback.empty-state 
                        title="Belum Ada Rekomendasi Menu" 
                        message="Rekomendasi menu akan otomatis muncul setelah kader mencatat pertumbuhan anak bulan ini."
                        actionText="Cek Jadwal Posyandu">
                        <x-slot name="icon">
                            <svg class="w-10 h-10 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </x-slot>
                    </x-feedback.empty-state>
                </div>
            </template>

            <!-- NORMAL STATE -->
            <div x-show="state === 'normal'" style="display: none;" class="space-y-8" x-transition>
                
                <!-- Trust Banner -->
                <div class="bg-gradient-to-br from-blue-100 to-indigo-50 border border-blue-200/50 rounded-[24px] p-5 flex items-start space-x-3 shadow-sm">
                    <div class="bg-blue-100 text-blue-600 rounded-full p-2 flex-shrink-0 mt-0.5 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-[13px] font-black text-blue-900 mb-1">Khusus untuk si Kecil</h4>
                        <p class="text-[12px] font-medium text-blue-800/80 leading-relaxed">
                            {{ $trustBannerMessage ?? 'Kami menyusun rekomendasi padat gizi untuk mendukung pertumbuhannya bulan ini.' }}
                        </p>
                    </div>
                </div>

                <!-- Hero Recommendation -->
                <div>
                    <h2 class="text-[17px] font-black text-gray-900 tracking-tighter mb-3 px-1">Ide Resep Hari Ini</h2>
                    @if(!empty($heroMeal))
                    <div class="relative w-full rounded-[28px] overflow-hidden shadow-[0_4px_24px_-8px_rgba(0,0,0,0.06)] border border-gray-100/60 group cursor-pointer active:scale-[0.98] transition-transform duration-300" x-on:click="openRecipe = true">
                        <!-- Image -->
                        <div class="h-56 w-full bg-gray-100 relative">
                            <img src="{{ asset('images/menu/' . ($heroMeal['image'] ?? 'placeholder.jpg')) }}" 
                                 alt="{{ $heroMeal['title'] ?? 'Menu Utama' }}" 
                                 class="w-full h-full object-cover transform scale-105 group-hover:scale-110 transition-transform duration-700">
                            
                            <!-- Gradient Overlay (Only at bottom for readability) -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-95"></div>
                        </div>

                        <!-- Content -->
                        <div class="absolute bottom-0 left-0 w-full p-6 text-white flex flex-col justify-end">
                            <div class="flex items-center space-x-2 mb-2.5">
                                <span class="bg-brand/90 backdrop-blur-md px-2.5 py-1 rounded-[10px] text-[10px] font-black uppercase tracking-widest text-white">{{ $heroMeal['calories'] ?? '250 Kkal' }}</span>
                                <span class="bg-white/20 backdrop-blur-md px-2.5 py-1 rounded-[10px] text-[10px] font-black uppercase tracking-widest text-white/90">⏱️ {{ $heroMeal['duration'] ?? '20 Menit' }} | Mudah</span>
                            </div>
                            <h3 class="text-[26px] font-black leading-tight tracking-tight mb-4 drop-shadow-md break-words">{{ $heroMeal['title'] ?? 'Sup Ayam Makaroni' }}</h3>
                            
                            <button class="w-full min-h-[44px] bg-white/20 hover:bg-white/30 backdrop-blur-md border border-white/30 text-white font-extrabold py-3.5 rounded-[20px] transition-all duration-300 text-[14px] flex justify-center items-center active:scale-95 shadow-sm focus:outline-none focus-visible:ring-2 focus-visible:ring-white/50 cursor-pointer">
                                Lihat Resep Lengkap
                            </button>
                        </div>
                    </div>
                    @else
                    <div class="bg-white border border-gray-100 rounded-[28px] p-7 text-center flex flex-col items-center justify-center shadow-[0_8px_30px_rgba(0,0,0,0.04)]">
                        <div class="w-14 h-14 bg-indigo-100/80 rounded-full flex items-center justify-center mb-4 text-indigo-500 shadow-sm border border-indigo-50">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <h3 class="text-[15px] font-black text-indigo-900 tracking-tight mb-2">Tips Nutrisi Si Kecil</h3>
                        <p class="text-[13px] font-medium text-indigo-800/80 leading-relaxed px-2">Rekomendasi resep personalisasi khusus untuk {{ $user['child_name'] ?? 'anak Anda' }} sedang dalam tahap pengembangan MVP V3.</p>
                    </div>
                    @endif
                </div>

                <!-- Alternative Carousel -->
                <div class="pt-2">
                    <div class="px-1 mb-4 flex justify-between items-end">
                        <div>
                            <h2 class="text-[17px] font-black text-gray-900 tracking-tighter">Ide Praktis Lainnya</h2>
                            <p class="text-[13px] font-medium text-gray-400 mt-0.5">Pilihan kaya gizi untuk variasi makan si Kecil.</p>
                        </div>
                        <!-- Swipe Affordance Icon -->
                        <div class="text-gray-300 animate-pulse flex items-center pr-1">
                            <span class="text-[10px] font-bold uppercase tracking-widest mr-1">Geser</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </div>
                    </div>
                    
                    <!-- Negative margin to allow full-width scroll, padding-right to show cutoff of next item -->
                    <div class="flex overflow-x-auto hide-scrollbar space-x-4 pb-6 -mx-5 px-5 snap-x snap-mandatory">
                        @forelse($alternatives ?? [] as $meal)
                            <button class="w-[170px] min-h-[44px] flex-shrink-0 text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-brand/50 rounded-[28px] group active:scale-95 transition-transform snap-start cursor-pointer" x-on:click="openRecipe = true">
                                <div class="w-full h-[180px] rounded-[28px] overflow-hidden bg-gray-50 relative mb-3 shadow-[0_8px_24px_-8px_rgba(0,0,0,0.06)] group-hover:shadow-[0_12px_32px_-8px_rgba(0,0,0,0.1)] transition-all border border-gray-100">
                                    <img src="{{ asset('images/menu/' . ($meal['image'] ?? 'placeholder.jpg')) }}" alt="{{ $meal['title'] ?? 'Alternatif Menu' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                </div>
                                <h4 class="font-black text-[14.5px] text-gray-900 leading-tight mb-1.5 tracking-tight group-hover:text-brand transition-colors px-1">{{ $meal['title'] }}</h4>
                                <p class="text-[11.5px] font-black uppercase tracking-widest text-brand px-1">{{ $meal['calories'] }}</p>
                            </button>
                        @empty
                            <div class="px-1 text-sm text-gray-500 py-4">Belum ada alternatif menu hari ini.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recipe Bottom Sheet -->
        <x-domain.recipe-bottom-sheet :recipe="$heroMeal ?? []" />
    </div>

    <!-- BOTTOM NAVIGATION -->
    <x-navigation.bottom-navigation active="nutrition" />
</x-layout.mobile-shell>
