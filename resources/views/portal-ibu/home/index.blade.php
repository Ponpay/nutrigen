<x-layout.mobile-shell>
    <div x-data="{ state: '{{ $pageState ?? 'normal' }}', isPending: {{ isset($hasPending) && $hasPending ? 'true' : 'false' }} }" class="flex-1 overflow-y-auto hide-scrollbar flex flex-col relative pb-[120px] pb-safe w-full bg-[#F6FAFC]">
        
        <!-- CYAN HEADER BACKGROUND -->
        <div class="absolute top-0 left-0 right-0 h-[220px] bg-[#00B4D8] rounded-b-[40px] z-0"></div>

        <!-- MAIN CONTENT CONTAINER -->
        <div class="relative z-10 flex flex-col flex-1">
            
            <!-- 1. HEADER -->
            <header class="flex items-center justify-between px-5 pt-8 pb-6">
                <div class="flex items-center space-x-3 text-left">
                    <div class="w-12 h-12 rounded-full overflow-hidden shadow-sm border-[2.5px] border-white/50 bg-white flex-shrink-0">
                        <img src="{{ $user['avatar'] ?? 'https://ui-avatars.com/api/?name=Ibu' }}" alt="Avatar" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <p class="text-[12px] text-white/90 font-medium mb-0.5 flex items-center gap-1">Selamat pagi, Ibu! <span>👋</span></p>
                        <h1 class="text-white font-extrabold text-[19px] leading-none tracking-tight truncate max-w-[150px] sm:max-w-[200px] mb-1.5">
                            {{ $user['child_name'] ?? 'Ibu' }}
                        </h1>
                        <div class="flex items-center gap-1 opacity-90 border border-white/20 bg-white/10 px-2 py-0.5 rounded-full w-max">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            <span class="text-[9px] text-white font-bold tracking-wide">Akun Terverifikasi</span>
                        </div>
                    </div>
                </div>
                <!-- Action Buttons -->
                <div class="flex items-center gap-2">
                    <button class="w-10 h-10 rounded-full bg-white text-slate-700 flex items-center justify-center shadow-sm focus:outline-none shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </button>
                    <button class="px-3.5 h-10 rounded-full bg-white text-slate-700 flex items-center gap-1.5 shadow-sm focus:outline-none shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        <span class="text-[11px] font-extrabold">Bantuan</span>
                    </button>
                </div>
            </header>

            <!-- WHITE CONTENT CONTAINER -->
            <div class="bg-[#F6FAFC] flex-1 rounded-t-[32px] px-5 pt-6 pb-6 flex flex-col gap-5 min-h-[70vh]">
                
                <!-- PENDING BANNER -->
                <template x-if="isPending">
                    <x-feedback.pending-banner message="Data pengukuran terbaru sedang dikonfirmasi oleh Bidan." class="rounded-[20px] shadow-sm mb-1" />
                </template>

                <!-- EMPTY & ERROR STATES -->
                <template x-if="state === 'error'">
                    <x-feedback.error-state />
                </template>
                <template x-if="state === 'empty'">
                    <div class="space-y-6">
                        <x-feedback.empty-state title="Belum Ada Rekam Medis" message="Yuk bawa si Kecil ke Posyandu terdekat." actionText="Cari Jadwal Posyandu" />
                    </div>
                </template>

                <!-- 2. HERO CARD: STATUS ANAK -->
                <div x-show="['normal', 'kuning', 'merah'].includes(state)" 
                     class="rounded-[32px] p-5 relative overflow-hidden flex flex-col group cursor-pointer border shadow-[0_8px_30px_rgba(0,0,0,0.02)] transition-all bg-white"
                     x-on:click="window.location.href='{!! \Illuminate\Support\Facades\URL::signedRoute('portal-ibu.growth', ['balita' => request('balita') ?? 0]) !!}'">
                    
                    <!-- Dynamic absolute background for light glow effect -->
                    <div class="absolute inset-0 opacity-40 rounded-[32px] pointer-events-none"
                         :class="{
                            'bg-emerald-50': state === 'normal',
                            'bg-amber-50': state === 'kuning',
                            'bg-rose-50': state === 'merah'
                         }"></div>

                    <!-- Top Section -->
                    <div class="flex gap-4 relative z-10">
                        <!-- Left Icon -->
                        <div class="w-[52px] h-[52px] rounded-full flex items-center justify-center shrink-0 border"
                             :class="{
                                'bg-emerald-50 text-emerald-500 border-emerald-100 shadow-[0_4px_12px_rgba(16,185,129,0.1)]': state === 'normal',
                                'bg-amber-50 text-amber-500 border-amber-100 shadow-[0_4px_12px_rgba(245,158,11,0.1)]': state === 'kuning',
                                'bg-rose-50 text-rose-500 border-rose-100 shadow-[0_4px_12px_rgba(225,29,72,0.1)]': state === 'merah'
                             }">
                             <svg x-show="state === 'normal'" class="w-[26px] h-[26px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                             <svg x-show="state === 'kuning'" class="w-[26px] h-[26px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                             <svg x-show="state === 'merah'" class="w-[26px] h-[26px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        
                        <!-- Content Right -->
                        <div class="flex-1 pt-0.5">
                            <div class="flex items-start justify-between">
                                <div>
                                    <span class="inline-block px-2.5 py-1 rounded-full text-[9px] font-black uppercase tracking-widest mb-1.5"
                                          :class="{
                                              'bg-emerald-100 text-emerald-800': state === 'normal',
                                              'bg-amber-100 text-amber-800': state === 'kuning',
                                              'bg-rose-100 text-rose-800': state === 'merah'
                                          }">
                                        {{ $summary['status'] ?? 'Normal' }}
                                    </span>
                                    <h2 class="text-[17px] font-black leading-tight tracking-tight mb-1"
                                        :class="{
                                            'text-emerald-900': state === 'normal',
                                            'text-amber-900': state === 'kuning',
                                            'text-rose-700': state === 'merah'
                                        }">
                                        {{ $summary['title'] ?? 'Sesuai Standar Usia' }}
                                    </h2>
                                </div>
                                <div class="mt-0.5"
                                     :class="{
                                        'text-emerald-400': state === 'normal',
                                        'text-amber-400': state === 'kuning',
                                        'text-rose-400': state === 'merah'
                                     }">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                                </div>
                            </div>
                            <p class="text-[12px] font-medium leading-relaxed mt-1"
                               :class="{
                                   'text-slate-600': state === 'normal',
                                   'text-slate-600': state === 'kuning',
                                   'text-slate-600': state === 'merah'
                               }">
                                {{ $summary['message'] ?? 'Anak Ibu tumbuh dengan baik sesuai kurva KMS.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="h-[1px] w-full my-4 relative z-10"
                         :class="{
                            'bg-emerald-100': state === 'normal',
                            'bg-amber-100': state === 'kuning',
                            'bg-rose-100': state === 'merah'
                         }"></div>

                    <!-- Bottom Section -->
                    <div class="flex items-center justify-between px-1 relative z-10">
                        <div class="flex-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Terakhir Diukur</p>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 shrink-0" 
                                     :class="{
                                        'text-emerald-500': state === 'normal',
                                        'text-amber-500': state === 'kuning',
                                        'text-rose-500': state === 'merah'
                                     }" 
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <p class="text-[13px] font-extrabold text-slate-800">{{ $measurement['date'] ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="w-[1px] h-8 mx-4"
                             :class="{
                                'bg-emerald-100': state === 'normal',
                                'bg-amber-100': state === 'kuning',
                                'bg-rose-100': state === 'merah'
                             }"></div>
                        <div class="flex-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Berat & Tinggi</p>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 shrink-0" 
                                     :class="{
                                        'text-emerald-500': state === 'normal',
                                        'text-amber-500': state === 'kuning',
                                        'text-rose-500': state === 'merah'
                                     }" 
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                <p class="text-[13px] font-extrabold text-slate-800">{{ $measurement['weight'] ?? '-' }} kg <span class="font-normal text-slate-300 mx-0.5">/</span> {{ $measurement['height'] ?? '-' }} cm</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. CARD REKOMENDASI MENU -->
                <div x-show="state !== 'empty' && state !== 'error'" class="bg-[#F0FDF4] rounded-[32px] p-5 flex flex-col gap-4 border border-emerald-50">
                    <div class="flex gap-4">
                        <div class="w-[52px] h-[52px] rounded-full bg-[#E6F8ED] flex items-center justify-center shrink-0 text-emerald-500">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                        </div>
                        <div class="flex-1 relative pt-0.5">
                            <h3 class="text-[16px] font-black text-slate-800 mb-1 pr-6">Butuh ide bekal bergizi?</h3>
                            <p class="text-[12px] font-medium text-slate-500 leading-relaxed pr-2">Temukan resep bernutrisi yang dirancang khusus untuk mendukung masa emas si Kecil.</p>
                            <div class="absolute top-0 right-0 text-emerald-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                            </div>
                        </div>
                    </div>
                    <button class="w-full bg-[#10B981] active:bg-emerald-600 text-white font-extrabold py-3.5 rounded-full transition-colors text-[14px] flex justify-center items-center gap-2 focus:outline-none" x-on:click="window.location.href='{!! \Illuminate\Support\Facades\URL::signedRoute('portal-ibu.nutrition', ['balita' => request('balita') ?? 0]) !!}'">
                        <svg class="w-[18px] h-[18px]" fill="currentColor" viewBox="0 0 24 24"><path d="M11 9H9V2H7v7H5V2H3v7c0 2.12 1.66 3.84 3.75 3.97V22h2.5v-9.03C11.34 12.84 13 11.12 13 9V2h-2v7zm5-3v8h2.5v8H21V2c-2.76 0-5 2.24-5 4z"/></svg>
                        Lihat Rekomendasi Menu
                    </button>
                </div>

                <!-- 4. CARD POSYANDU -->
                <div class="bg-gradient-to-r from-[#F0F9FF] to-[#E0F2FE] rounded-[32px] p-5 shadow-[0_8px_30px_rgba(2,132,199,0.05)] border border-sky-100 flex flex-col relative overflow-hidden">
                    
                    <!-- Decorative Illustration Placeholder -->
                    <div class="absolute right-0 bottom-14 w-40 h-28 opacity-90 pointer-events-none">
                        <!-- Posyandu Illustration -->
                        <svg viewBox="0 0 120 100" class="w-full h-full text-[#38BDF8] fill-current">
                            <!-- Background elements -->
                            <path d="M80 80 Q90 60 110 70 L110 100 L80 100 Z" fill="#BAE6FD" opacity="0.5"/>
                            <!-- Building Base -->
                            <rect x="35" y="45" width="60" height="40" fill="#BAE6FD" rx="2" />
                            <!-- Roof -->
                            <polygon points="20,45 65,30 110,45" fill="#38BDF8" />
                            <rect x="50" y="38" width="30" height="7" fill="#0284C7" />
                            <text x="65" y="43" font-size="4.5" font-weight="bold" fill="white" text-anchor="middle" letter-spacing="0.5">POSYANDU</text>
                            <!-- Door -->
                            <rect x="55" y="60" width="20" height="25" fill="#F0F9FF" />
                            <rect x="64.5" y="60" width="1" height="25" fill="#BAE6FD" />
                            <!-- Windows -->
                            <rect x="40" y="55" width="10" height="12" fill="#F0F9FF" />
                            <rect x="80" y="55" width="10" height="12" fill="#F0F9FF" />
                            <!-- Trees -->
                            <circle cx="20" cy="70" r="12" fill="#86EFAC" />
                            <circle cx="28" cy="55" r="16" fill="#4ADE80" />
                            <circle cx="12" cy="55" r="14" fill="#22C55E" />
                            <rect x="18" y="70" width="6" height="25" fill="#D97706" />
                        </svg>
                    </div>

                    <div class="relative z-10 flex flex-col h-full">
                        <div class="flex items-start mb-4">
                            <div class="bg-blue-100 text-[#1E40AF] px-3 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest flex items-center gap-1.5 shadow-sm">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                SESUAI JADWAL KADER
                            </div>
                        </div>
                        
                        <h3 class="text-[19px] font-black text-slate-800 mb-1.5 max-w-[60%] leading-tight">{{ $posyandu['name'] ?? 'Posyandu Mawar' }}</h3>
                        
                        <div class="flex items-start gap-1.5 mb-5 text-slate-500 max-w-[60%]">
                            <svg class="w-[18px] h-[18px] shrink-0 mt-0.5 text-[#0284C7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <p class="text-[12.5px] font-medium leading-snug">{{ $posyandu['name'] ?? 'Posyandu Mawar' }}<br>{{ $posyandu['schedule'] ?? 'Setiap awal bulan' }}</p>
                        </div>

                        <button class="w-full bg-white text-[#0284C7] font-extrabold py-3.5 rounded-full border border-sky-100 shadow-sm transition-colors text-[14px] flex justify-center items-center gap-1.5 focus:outline-none" x-on:click="window.location.href='{!! \Illuminate\Support\Facades\URL::signedRoute('portal-ibu.posyandu', ['balita' => request('balita') ?? 0]) !!}'">
                            Lihat Profil Anak
                            <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    </div>
                </div>

                <!-- 5. QUICK ACTIONS -->
                <div class="flex items-start justify-between px-1 pt-1 pb-2">
                    <!-- Catat Pengukuran -->
                    <div class="flex flex-col items-center gap-2 cursor-pointer w-[72px]">
                        <div class="w-[52px] h-[52px] rounded-[20px] bg-white flex items-center justify-center border border-emerald-100 text-emerald-500 shadow-[0_4px_16px_rgba(16,185,129,0.08)]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        </div>
                        <span class="text-[10px] font-bold text-center leading-tight text-slate-600">Catat<br>Pengukuran</span>
                    </div>
                    
                    <!-- Edukasi Gizi -->
                    <div class="flex flex-col items-center gap-2 cursor-pointer w-[72px]" x-on:click="window.location.href='{!! \Illuminate\Support\Facades\URL::signedRoute('portal-ibu.nutrition', ['balita' => request('balita') ?? 0]) !!}'">
                        <div class="w-[52px] h-[52px] rounded-[20px] bg-white flex items-center justify-center border border-orange-100 text-orange-500 shadow-[0_4px_16px_rgba(249,115,22,0.08)]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <span class="text-[10px] font-bold text-center leading-tight text-slate-600">Edukasi<br>Gizi</span>
                    </div>

                    <!-- Tanya Kader -->
                    <div class="flex flex-col items-center gap-2 cursor-pointer w-[72px]">
                        <div class="w-[52px] h-[52px] rounded-[20px] bg-white flex items-center justify-center border border-purple-100 text-[#8B5CF6] shadow-[0_4px_16px_rgba(139,92,246,0.08)]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                        </div>
                        <span class="text-[10px] font-bold text-center leading-tight text-slate-600">Tanya<br>Kader</span>
                    </div>

                    <!-- Pantau Tumbuh Kembang -->
                    <div class="flex flex-col items-center gap-2 cursor-pointer w-[72px]" x-on:click="window.location.href='{!! \Illuminate\Support\Facades\URL::signedRoute('portal-ibu.growth', ['balita' => request('balita') ?? 0]) !!}'">
                        <div class="w-[52px] h-[52px] rounded-[20px] bg-white flex items-center justify-center border border-blue-100 text-[#3B82F6] shadow-[0_4px_16px_rgba(59,130,246,0.08)]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                        </div>
                        <span class="text-[10px] font-bold text-center leading-tight text-slate-600">Pantau<br>Tumbuh Kembang</span>
                    </div>
                </div>

                <!-- 6. TIPS HARI INI -->
                <div class="bg-[#FFFBEB] rounded-3xl p-4 flex items-center gap-3 border border-amber-100/50 shadow-sm">
                    <div class="w-[42px] h-[42px] rounded-full bg-[#FEF3C7] flex items-center justify-center shrink-0 text-[#F59E0B]">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-[14px] font-extrabold text-amber-900 mb-0.5">Tips Hari Ini</h4>
                        <p class="text-[11px] font-medium text-amber-800/80 leading-relaxed pr-2">Berikan makanan tinggi protein seperti telur, ikan, tempe, atau ayam untuk mendukung pertumbuhan si Kecil.</p>
                    </div>
                    <div class="text-[#F59E0B] shrink-0 opacity-80">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- 7. BOTTOM NAVIGATION -->
    <x-navigation.bottom-navigation active="home" />
</x-layout.mobile-shell>
