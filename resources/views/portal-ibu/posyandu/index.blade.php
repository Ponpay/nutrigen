<x-layout.mobile-shell>
    <div x-data="{ state: '{{ $pageState ?? 'normal' }}' }" class="flex-1 overflow-y-auto hide-scrollbar flex flex-col relative pb-[100px] pb-safe w-full">
        
        <!-- HEADER (Root Page) -->
        <header class="sticky top-0 z-30 bg-slate-50/90 backdrop-blur-xl px-5 pt-8 pb-4 flex items-center justify-between border-b border-gray-100/50">
            <h1 class="text-[24px] font-extrabold text-gray-900 tracking-tighter">Posyandu</h1>
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
                        title="Belum Terhubung" 
                        message="Sepertinya akun ini belum dihubungkan ke Posyandu manapun oleh Kader."
                        actionText="Bantuan">
                        <x-slot name="icon">
                            <svg class="w-10 h-10 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </x-slot>
                    </x-feedback.empty-state>
                </div>
            </template>

            <!-- PENDING STATE -->
            <template x-if="state === 'pending'">
                <div class="space-y-4">
                    <x-feedback.pending-banner message="Data pengukuran terakhir sedang diproses oleh kader." />
                    <div class="opacity-50 pointer-events-none mt-4">
                        <x-ui.card padding="p-5" class="animate-pulse flex flex-col space-y-4 h-32"></x-ui.card>
                    </div>
                </div>
            </template>

            <!-- NORMAL & CRITICAL ANNOUNCEMENT STATE -->
            <div x-show="state === 'normal' || state === 'critical_announcement'" style="display: none;" class="space-y-5" x-transition>
                
                <!-- CRITICAL ANNOUNCEMENT -->
                <template x-if="state === 'critical_announcement'">
                    <div class="bg-white border border-gray-100 rounded-[24px] p-5 flex items-start space-x-4 shadow-sm relative overflow-hidden">
                        <div class="absolute -right-4 -top-4 w-16 h-16 bg-amber-500 rounded-full opacity-10"></div>
                        <div class="w-10 h-10 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center flex-shrink-0 border border-amber-50 z-10">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <div class="z-10">
                            <h4 class="text-[14px] font-black text-amber-900 mb-0.5">{{ $announcement['title'] ?? 'Info Penting' }}</h4>
                            <p class="text-[12.5px] font-medium text-amber-800 leading-snug">
                                {{ $announcement['message'] ?? 'Karena libur nasional, jadwal digeser ke tanggal 15 Agustus.' }}
                            </p>
                        </div>
                    </div>
                </template>

                <!-- 1. JADWAL UTAMA -->
                <div class="bg-white rounded-[28px] p-7 shadow-[0_8px_30px_-10px_rgba(0,0,0,0.08)] border border-gray-100/60 relative overflow-hidden transition-all duration-300">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-blue-50/30 rounded-bl-full -z-10"></div>
                    
                    @if(isset($schedule['countdown']) || true)
                    <div class="absolute top-5 right-5 bg-gradient-to-r from-red-500 to-rose-500 text-white px-4 py-2 rounded-full flex items-center shadow-[0_6px_16px_-4px_rgba(225,29,72,0.4)] z-10 border border-white/20">
                        <span class="w-1.5 h-1.5 bg-white rounded-full mr-2 animate-pulse shadow-[0_0_8px_rgba(255,255,255,0.8)]"></span>
                        <span class="text-[12px] font-black uppercase tracking-wider drop-shadow-sm">{{ $schedule['countdown'] ?? '13 Hari Lagi' }}</span>
                    </div>
                    @endif

                    <p class="text-[11px] font-black text-blue-500 uppercase tracking-widest mb-4 z-10 relative">{{ $schedule['posyanduName'] ?? 'Posyandu Melati' }}</p>
                    
                    <div class="flex items-start space-x-4 mb-4 mt-2 z-10 relative">
                        <div class="bg-blue-50/80 text-blue-600 p-3.5 rounded-[18px] border border-blue-100 flex-shrink-0 mt-1 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-500 text-[13px] mb-1">Jadwal Penimbangan</h3>
                            <p class="text-[20px] font-black text-gray-900 leading-tight tracking-tighter">{{ $schedule['date'] ?? 'Senin, 12 Ags 2026' }}</p>
                        </div>
                    </div>

                    @if(isset($schedule['address']) || true)
                    <div class="pt-5 border-t border-gray-100 mt-2 flex items-start space-x-2.5 text-gray-500 z-10 relative">
                        <svg class="w-5 h-5 flex-shrink-0 mt-0.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <p class="text-[13px] font-semibold leading-relaxed break-words pr-2">{{ $schedule['address'] ?? 'Balai RW 05, Jl. Bunga Melati No.12' }}</p>
                    </div>
                    @endif
                </div>

                <!-- KADER CARD -->
                <div class="bg-white rounded-[28px] p-4 px-5 flex items-center justify-between border border-mint-50 shadow-[0_8px_24px_-8px_rgba(0,0,0,0.03)] bg-gradient-to-r from-mint-50/30 to-white">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-full overflow-hidden shadow-sm border-2 border-white bg-mint-100 flex-shrink-0 flex items-center justify-center text-mint-700 font-black text-[16px]">
                            @if(isset($kader['avatar']) && $kader['avatar'])
                                <img src="{{ $kader['avatar'] }}" alt="Avatar" class="w-full h-full object-cover">
                            @else
                                {{ substr($kader['name'] ?? 'B', 0, 1) }}
                            @endif
                        </div>
                        <div class="min-w-0 flex-1 pr-2">
                            <h3 class="font-black text-[15px] text-gray-800 tracking-tight truncate">{{ $kader['name'] ?? 'Bu Siti Aminah' }}</h3>
                            <p class="text-[12px] font-bold text-gray-500 truncate">{{ $kader['role'] ?? 'Kader Utama' }}</p>
                        </div>
                    </div>
                    <a href="{{ $kader['whatsapp_url'] ?? '#' }}" target="_blank" class="w-11 h-11 bg-[#25D366] text-white rounded-full flex items-center justify-center shadow-[0_8px_16px_-4px_rgba(37,211,102,0.4)] focus:outline-none hover:bg-green-600 transition-all active:scale-95">
                        <svg class="w-5.5 h-5.5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    </a>
                </div>

                <!-- 3. CHECKLIST PERSIAPAN -->
                <div class="bg-white rounded-[28px] p-7 shadow-sm border border-gray-100">
                    <h2 class="text-[16px] font-black text-indigo-900 tracking-tight mb-5 px-1">Jangan Lupa Bawa Ini Ya, Bu:</h2>
                    <ul class="space-y-4">
                        @forelse($checklist ?? [] as $item)
                            <li class="flex items-start group">
                                <div class="w-6 h-6 rounded-full flex-shrink-0 flex items-center justify-center transition-all shadow-sm 
                                    {{ ($item['checked'] ?? false) ? 'bg-gradient-to-br from-indigo-400 to-indigo-500 shadow-[0_4px_12px_rgba(99,102,241,0.4)] text-white border-none' : 'bg-indigo-50 border border-indigo-200 text-transparent' }}">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <div class="ml-3.5 mt-0.5">
                                    <p class="text-[14px] font-semibold leading-relaxed {{ ($item['checked'] ?? false) ? 'text-indigo-400 line-through' : 'text-indigo-800' }}">
                                        {{ $item['task'] }}
                                    </p>
                                </div>
                            </li>
                        @empty
                            <!-- Fallback Dummy for Dev -->
                            <li class="flex items-start group cursor-pointer">
                                <div class="w-6 h-6 rounded-full flex-shrink-0 flex items-center justify-center transition-all bg-gradient-to-br from-indigo-400 to-indigo-500 text-white shadow-[0_4px_12px_rgba(99,102,241,0.4)] border-none">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <div class="ml-3.5 mt-0.5"><p class="text-[14px] font-semibold text-indigo-400 line-through leading-relaxed">Bawa Buku KIA (KMS)</p></div>
                            </li>
                            <li class="flex items-start group cursor-pointer">
                                <div class="w-6 h-6 rounded-full flex-shrink-0 flex items-center justify-center transition-all bg-indigo-50 border border-indigo-200 text-transparent">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <div class="ml-3.5 mt-0.5"><p class="text-[14px] font-semibold text-indigo-800 leading-relaxed">Pastikan anak dalam kondisi sehat</p></div>
                            </li>
                        @endforelse
                    </ul>
                </div>

            </div>
        </div>
    </div>
        
    <!-- BOTTOM NAVIGATION -->
    <x-navigation.bottom-navigation active="posyandu" />
</x-layout.mobile-shell>
