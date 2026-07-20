<x-layout.mobile-shell>
    <div x-data="{ state: '{{ $pageState ?? 'normal' }}', isPending: {{ isset($hasPending) && $hasPending ? 'true' : 'false' }} }" class="flex-1 overflow-y-auto hide-scrollbar flex flex-col relative pb-[100px] pb-safe w-full">
        
        <!-- LOADING OVERLAY -->
        <template x-if="state === 'loading'">
            <x-feedback.loading-state />
        </template>

        <!-- MAIN CONTENT -->
        <div x-show="state !== 'loading'" style="display: none;" class="px-5 pt-6 pb-6 flex flex-col space-y-6 flex-1" x-transition>
            
            <!-- HEADER -->
            <header class="flex items-center justify-between mb-2">
                <div class="flex items-center space-x-3.5 text-left">
                    <div class="w-12 h-12 rounded-full overflow-hidden shadow-sm border-2 border-white bg-gray-100 flex-shrink-0">
                        <img src="{{ $user['avatar'] ?? 'https://i.pravatar.cc/150?img=47' }}" alt="Avatar" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <p class="text-[12.5px] text-gray-400 font-medium mb-0.5 tracking-wide">Selamat pagi, Ibu!</p>
                        <h1 class="text-gray-900 font-extrabold text-[20px] leading-none tracking-tighter truncate max-w-[180px] sm:max-w-[250px]">
                            {{ $user['child_name'] ?? 'Aisyah Putri' }}
                        </h1>
                    </div>
                </div>
                <!-- Trust Badge -->
                <div class="bg-blue-100/80 text-blue-700 px-3 py-1.5 rounded-full flex items-center space-x-1.5 shadow-sm border border-blue-200/50">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    <span class="text-[10.5px] font-black uppercase tracking-wider">Tervalidasi</span>
                </div>
            </header>

            <!-- PENDING BANNER -->
            <template x-if="isPending">
                <div class="space-y-4">
                    <template x-if="state === 'empty'">
                        <x-feedback.pending-banner message="Rapor perdana si Kecil sedang disiapkan oleh Bidan. Mohon ditunggu ya, Ibu." class="shadow-[0_8px_30px_-6px_rgba(0,0,0,0.03)] rounded-[20px]" />
                    </template>
                    <template x-if="state !== 'empty'">
                        <x-feedback.pending-banner message="Data pengukuran terbaru sedang dikonfirmasi oleh Bidan. Ini adalah hasil bulan sebelumnya." class="shadow-[0_8px_30px_-6px_rgba(0,0,0,0.03)] rounded-[20px]" />
                    </template>
                </div>
            </template>

            <!-- ERROR STATE -->
            <template x-if="state === 'error'">
                <x-feedback.error-state />
            </template>

            <!-- EMPTY STATE -->
            <template x-if="state === 'empty'">
                <div class="space-y-6">
                    <x-domain.hero-card state="empty" icon="🌱" title="Rapor Sedang Disiapkan." message="Tunggu dokter puskesmas meninjau datanya." />
                    <x-feedback.empty-state title="Belum Ada Rekam Medis" message="Yuk bawa si Kecil ke Posyandu terdekat bulan ini." actionText="Cari Jadwal Posyandu">
                        <x-slot name="icon">
                            <svg class="w-10 h-10 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </x-slot>
                    </x-feedback.empty-state>
                </div>
            </template>

            <!-- NORMAL / WARNING / DANGER STATE -->
            <div x-show="['normal', 'kuning', 'merah'].includes(state)" class="space-y-5">
                
                <div x-show="state !== 'error'" 
                     class="rounded-[32px] p-7 text-center shadow-[0_16px_40px_-12px_rgba(5,150,105,0.4)] transition-all duration-500 relative overflow-hidden flex flex-col items-center"
                     :class="{
                        'bg-gradient-to-br from-emerald-500 to-emerald-600 shadow-[0_16px_40px_-12px_rgba(5,150,105,0.4)]': state === 'normal',
                        'bg-gradient-to-br from-amber-400 to-amber-500 shadow-[0_16px_40px_-12px_rgba(245,158,11,0.4)]': state === 'kuning',
                        'bg-gradient-to-br from-rose-500 to-rose-600 shadow-[0_16px_40px_-12px_rgba(225,29,72,0.4)]': state === 'merah',
                        'bg-gradient-to-br from-blue-500 to-blue-600 shadow-[0_16px_40px_-12px_rgba(37,99,235,0.4)]': !['normal', 'kuning', 'merah'].includes(state)
                     }">

                    <!-- Status Pill -->
                    <div class="mt-2 mb-4">
                        <span class="px-4 py-1.5 rounded-full text-[11px] font-black uppercase tracking-widest bg-white/20 text-white backdrop-blur-md">
                            {{ $summary['status'] ?? 'Belum Ada Data' }}
                        </span>
                    </div>

                    <h2 class="text-[20px] font-black text-white leading-tight tracking-tight z-10 drop-shadow-sm px-4">
                        {{ $summary['title'] ?? 'Sesuai Standar Usia' }}
                    </h2>
                    
                    <!-- INLAY DATA CARD (White Box inside Hero Card) -->
                    <div x-show="state !== 'empty'" class="w-full bg-white rounded-[24px] mt-6 shadow-[0_8px_24px_-8px_rgba(0,0,0,0.1)] overflow-hidden">
                        
                        <!-- Top Half: Measurements -->
                        <div class="flex justify-between items-center px-5 py-4 border-b border-gray-100">
                            <div class="text-left w-1/2">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Terakhir Diukur</p>
                                <p class="text-[13.5px] font-extrabold text-gray-800">{{ $measurement['date'] ?? '12 Ags 2026' }}</p>
                            </div>
                            <div class="h-8 w-[1px] bg-gray-100 mx-2"></div>
                            <div class="text-right w-1/2">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Berat & Tinggi</p>
                                <p class="text-[13.5px] font-extrabold text-gray-800">{{ $measurement['weight'] ?? '10.2' }} kg <span class="text-gray-300 font-normal mx-0.5">/</span> {{ $measurement['height'] ?? '85' }} cm</p>
                            </div>
                        </div>

                        <!-- Bottom Half: Action -->
                        <div class="px-5 py-4 bg-gray-50/80 text-left">
                            <div class="flex items-center space-x-2.5 mb-1.5">
                                <div class="p-1 rounded-full bg-white shadow-sm border border-gray-100/50">
                                    <svg class="w-3.5 h-3.5" :class="{'text-emerald-500': state === 'normal', 'text-amber-500': state === 'kuning', 'text-rose-500': state === 'merah', 'text-blue-500': state === 'empty'}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <h4 class="text-[11px] font-black text-gray-700 uppercase tracking-wider">Tindakan Selanjutnya</h4>
                            </div>
                            <p class="text-[13px] font-medium text-gray-600 leading-relaxed pl-[32px]">
                                {{ $summary['action'] ?? 'Lanjutkan pemberian nutrisi seimbang harian.' }}
                            </p>
                        </div>

                    </div>
                </div>

                <!-- ACHIEVEMENT DELTA -->
                <div x-show="state !== 'empty' && state !== 'error'" class="grid grid-cols-2 gap-4 relative z-20">
                    <!-- GROWTH CARD -->
                    <button class="bg-white rounded-[24px] p-6 shadow-[0_4px_24px_-8px_rgba(0,0,0,0.06)] border border-gray-100/60 hover:shadow-[0_8px_32px_-8px_rgba(0,0,0,0.08)] flex flex-col relative overflow-hidden text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-brand/50 transition-all duration-300 active:scale-[0.98] group cursor-pointer" x-on:click="window.location.href='{!! \Illuminate\Support\Facades\URL::signedRoute('portal-ibu.growth', ['balita' => request('balita')]) !!}'">
                        <div class="absolute -right-6 -top-6 w-24 h-24 rounded-full opacity-[0.06] transition-colors group-hover:scale-110 duration-500" :class="{'bg-mint-500': state !== 'merah', 'bg-rose-500': state === 'merah'}"></div>
                        <div class="flex items-center justify-between mb-3 z-10">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Berat</p>
                            @if(!($delta['is_first'] ?? false))
                            <div class="p-1.5 rounded-[10px] bg-gradient-to-br from-mint-50 to-mint-100/50 text-mint-600 shadow-[0_2px_8px_rgba(16,185,129,0.15)]" :class="{'from-rose-50 to-rose-100/50 text-rose-600 shadow-[0_2px_8px_rgba(225,29,72,0.15)]': state === 'merah'}">
                                <svg x-show="state !== 'merah'" class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 1.125rem; height: 1.125rem;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                                <svg x-show="state === 'merah'" class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 1.125rem; height: 1.125rem;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                            </div>
                            @endif
                        </div>
                        <h3 class="{{ ($delta['is_first'] ?? false) ? 'text-[15px]' : 'text-[24px]' }} font-black z-10 tracking-tight transition-colors group-hover:opacity-90 {{ ($delta['is_first'] ?? false) ? 'text-gray-500' : 'text-mint-700' }}">
                            {{ ($delta['is_first'] ?? false) ? 'Pengukuran Pertama' : ($delta['height'] ?? 'Naik 2cm') }}
                        </h3>
                    </button>
                    
                    <!-- Tinggi Delta -->
                    <button class="bg-white rounded-[24px] p-6 shadow-[0_4px_24px_-8px_rgba(0,0,0,0.06)] border border-gray-100/60 hover:shadow-[0_8px_32px_-8px_rgba(0,0,0,0.08)] flex flex-col relative overflow-hidden text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-brand/50 transition-all duration-300 active:scale-[0.98] group cursor-pointer" x-on:click="window.location.href='{!! \Illuminate\Support\Facades\URL::signedRoute('portal-ibu.growth', ['balita' => request('balita')]) !!}'">
                        <div class="absolute -right-6 -top-6 w-24 h-24 bg-mint-500 rounded-full opacity-[0.06] transition-transform duration-500 group-hover:scale-110"></div>
                        <div class="flex items-center justify-between mb-3 z-10">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Tinggi</p>
                            @if(!($delta['is_first'] ?? false))
                            <div class="p-1.5 rounded-[10px] bg-gradient-to-br from-mint-50 to-mint-100/50 text-mint-600 shadow-[0_2px_8px_rgba(16,185,129,0.15)]">
                                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 1.125rem; height: 1.125rem;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                            </div>
                            @endif
                        </div>
                        <h3 class="{{ ($delta['is_first'] ?? false) ? 'text-[15px]' : 'text-[24px]' }} font-black z-10 tracking-tight transition-colors group-hover:opacity-90 {{ ($delta['is_first'] ?? false) ? 'text-gray-500' : 'text-mint-700' }}">
                            {{ ($delta['is_first'] ?? false) ? 'Pengukuran Pertama' : ($delta['height'] ?? 'Naik 2cm') }}
                        </h3>
                    </button>
                </div>

                <!-- COMPANION CTA CARD (NUTRITION) -->
                <div x-show="state !== 'error'" class="bg-white rounded-[28px] p-6 shadow-sm border border-gray-100 transition-all duration-300 relative overflow-hidden">
                    
                    <div class="relative z-10 flex flex-col h-full">
                        <h3 class="text-[17px] font-black text-gray-900 leading-tight mb-2 tracking-tighter">Butuh ide bekal bergizi?</h3>
                        <p class="text-[13.5px] font-medium text-gray-500 mb-5 leading-relaxed">
                            Temukan resep bernutrisi yang dirancang khusus untuk mendukung masa emas si Kecil.
                        </p>
                        
                        <div class="mt-auto">
                            <button class="w-full min-h-[44px] bg-orange-500 hover:bg-orange-600 text-white font-extrabold py-3.5 rounded-[20px] shadow-[0_8px_24px_-4px_rgba(249,115,22,0.3)] transition-all duration-300 text-[14px] flex justify-center items-center active:scale-[0.98] z-10 relative focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-500/50 cursor-pointer" x-on:click="window.location.href='{!! \Illuminate\Support\Facades\URL::signedRoute('portal-ibu.nutrition', ['balita' => request('balita')]) !!}'">
                                Lihat Rekomendasi Menu
                            </button>
                        </div>
                    </div>
                </div>

                <!-- SCHEDULE CARD -->
                <div class="bg-gradient-to-br from-sky-500 to-blue-600 rounded-[28px] p-6 shadow-[0_12px_32px_-8px_rgba(14,165,233,0.4)] relative overflow-hidden">
                    <div class="relative z-10">
                        <div class="flex justify-between items-start mb-4">
                            <div class="bg-white/20 backdrop-blur-md p-2 rounded-xl">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <span class="bg-white/20 backdrop-blur-md px-3 py-1.5 rounded-full text-[10px] font-black text-white tracking-widest uppercase">
                                {{ $posyandu['countdown'] ?? 'Akan Datang' }}
                            </span>
                        </div>
                        
                        <h3 class="text-[17px] font-black text-white leading-tight tracking-tighter mb-1.5">{{ $posyandu['name'] ?? 'Posyandu Mawar' }}</h3>
                        <p class="text-[13.5px] font-medium text-white/90 mb-6 drop-shadow-sm">{{ $posyandu['schedule'] ?? 'Sabtu, 24 Ags 2026' }}</p>

                        <button class="w-full min-h-[44px] bg-white border border-sky-200/50 hover:bg-sky-50 text-sky-700 font-extrabold py-3.5 rounded-[20px] transition-all duration-300 text-[13px] flex items-center justify-center active:scale-[0.98] shadow-sm focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-500/50 cursor-pointer" x-on:click="window.location.href='{!! \Illuminate\Support\Facades\URL::signedRoute('portal-ibu.posyandu', ['balita' => request('balita')]) !!}'">
                            <span>Lihat Profil Anak</span>
                            <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- BOTTOM NAVIGATION -->
    <x-navigation.bottom-navigation active="home" />
</x-layout.mobile-shell>
