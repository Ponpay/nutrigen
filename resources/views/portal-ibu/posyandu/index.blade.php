<x-layout.mobile-shell>
    <div x-data="{ state: '{{ $pageState ?? 'normal' }}' }" class="flex-1 overflow-y-auto hide-scrollbar flex flex-col relative pb-[90px] w-full bg-white">
        
        <!-- HEADER -->
        <header class="sticky top-0 z-30 bg-white/90 backdrop-blur-xl px-6 pt-10 pb-5 flex items-center justify-between">
            <h1 class="text-[24px] font-black text-[#1E293B] tracking-tight">Posyandu</h1>
            
            <div class="flex items-center gap-3">
                <!-- Avatar with small chevron -->
                <button class="flex items-center gap-1.5 focus:outline-none bg-orange-50 rounded-full pr-1.5 p-1 border border-orange-100">
                    <div class="w-8 h-8 rounded-full bg-orange-200 flex items-center justify-center overflow-hidden">
                        @if(isset($user['avatar']) && $user['avatar'])
                            <img src="{{ $user['avatar'] }}" alt="Avatar" class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('images/avatar-boy.png') }}" onerror="this.style.display='none'" class="w-full h-full object-cover">
                            <!-- Fallback initials -->
                            <span class="text-orange-600 font-bold text-[14px] absolute -z-10">{{ $user['initials'] ?? 'A' }}</span>
                        @endif
                    </div>
                    <svg class="w-3.5 h-3.5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                
                <!-- Notification Bell -->
                <div class="relative">
                    <button class="w-10 h-10 rounded-full bg-white border border-slate-200 shadow-sm flex items-center justify-center text-slate-700 focus:outline-none">
                        <svg class="w-[22px] h-[22px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </button>
                    <!-- Red Dot -->
                    <div class="absolute top-0 right-0 w-[18px] h-[18px] bg-[#EF4444] rounded-full border-2 border-white flex items-center justify-center text-[9px] text-white font-bold">2</div>
                </div>
            </div>
        </header>

        <div class="px-5 pb-6 space-y-5 flex-1 flex flex-col">

            @if(isset($schedule))
            <!-- 1. HERO POSYANDU CARD -->
            <div class="bg-gradient-to-br from-[#F4FDF9] to-[#E5F9F1] rounded-[32px] p-6 shadow-[0_8px_30px_rgba(16,185,129,0.06)] border border-[#D1FAE5] relative overflow-hidden">
                <!-- Decorative Building Placeholder -->
                <div class="absolute right-[-10px] top-4 w-40 h-28 pointer-events-none z-0">
                    <svg viewBox="0 0 100 100" class="w-full h-full opacity-95">
                        <path d="M0 100 L100 100 L100 80 L0 80 Z" fill="#D1FAE5" />
                        <!-- Building base -->
                        <rect x="20" y="50" width="60" height="30" fill="#A7F3D0" />
                        <!-- Roof -->
                        <polygon points="10,50 50,25 90,50" fill="#34D399" />
                        <!-- Windows -->
                        <rect x="30" y="60" width="12" height="12" fill="#ECFDF5" />
                        <rect x="58" y="60" width="12" height="12" fill="#ECFDF5" />
                        <!-- Door -->
                        <rect x="44" y="60" width="12" height="20" fill="#059669" />
                        <text x="50" y="56" fill="#065F46" font-size="4" font-weight="bold" text-anchor="middle">POSYANDU</text>
                    </svg>
                </div>

                <div class="relative z-10">
                    <h2 class="text-[22px] font-extrabold text-[#064E3B] tracking-tight mb-2.5">{{ $schedule['posyanduName'] ?? 'Posyandu Mawar' }}</h2>
                    <div class="inline-flex items-center gap-1.5 bg-white text-[#10B981] px-3 py-1.5 rounded-full shadow-sm mb-6">
                        <div class="bg-[#10B981] rounded-full p-0.5 text-white">
                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="text-[11px] font-bold">Jadwal sudah tersedia</span>
                    </div>

                    <div class="flex items-center w-full border-t border-[#A7F3D0]/60 pt-5 mb-5">
                        <!-- Date -->
                        <div class="flex items-start gap-2.5 flex-1 border-r border-[#A7F3D0]/60 pr-2">
                            <svg class="w-[18px] h-[18px] text-[#10B981] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <div class="flex flex-col">
                                <span class="text-[10px] text-[#059669] font-semibold mb-0.5">Hari/Tgl</span>
                                <span class="text-[12px] font-bold text-[#1E293B] leading-tight">
                                    {{ $schedule['date'] ?? '-' }}
                                </span>
                            </div>
                        </div>

                        <!-- Time -->
                        <div class="flex items-start gap-2.5 flex-1 border-r border-[#A7F3D0]/60 px-3">
                            <svg class="w-[18px] h-[18px] text-[#10B981] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div class="flex flex-col">
                                <span class="text-[10px] text-[#059669] font-semibold mb-0.5">Jam</span>
                                <span class="text-[12px] font-bold text-[#1E293B] leading-tight">
                                    {{ $schedule['time'] ?? 'Sesuai Jadwal' }}
                                </span>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="flex items-start gap-2.5 flex-1 pl-3">
                            <svg class="w-[18px] h-[18px] text-[#10B981] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <div class="flex flex-col">
                                <span class="text-[10px] text-[#059669] font-semibold mb-0.5">Lokasi</span>
                                <span class="text-[12px] font-bold text-[#1E293B] leading-tight truncate w-14">
                                    {{ $schedule['address'] ?? '-' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <button class="inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-full border border-[#10B981] text-[#059669] font-bold text-[12px] active:scale-95 transition-transform bg-white/50">
                        <svg class="w-3.5 h-3.5 text-[#10B981]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Lihat Lokasi
                        <svg class="w-3.5 h-3.5 text-[#10B981]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>
            @endif

            @if(isset($kader))
            <!-- 2. KADER CARD -->
            @php
                $rawWa = isset($kader['whatsapp_url']) ? preg_replace('/[^0-9]/', '', $kader['whatsapp_url']) : '';
                $formattedWa = $rawWa;
                if (str_starts_with($rawWa, '62')) {
                    $formattedWa = '0' . substr($rawWa, 2);
                }
                if (strlen($formattedWa) >= 10) {
                    $formattedWa = substr($formattedWa, 0, 4) . ' ' . substr($formattedWa, 4, 4) . ' ' . substr($formattedWa, 8);
                }
            @endphp
            <div class="bg-white rounded-[32px] p-5 flex items-center justify-between shadow-[0_4px_24px_rgba(0,0,0,0.04)] border border-slate-100/60">
                <div class="flex items-center gap-4">
                    <div class="w-[60px] h-[60px] rounded-full overflow-hidden bg-slate-100 flex-shrink-0 relative">
                        @if(isset($kader['avatar']) && $kader['avatar'])
                            <img src="{{ $kader['avatar'] }}" alt="Kader" class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('images/avatar-kader.png') }}" onerror="this.style.display='none'" class="w-full h-full object-cover relative z-10">
                            <!-- Fallback initals behind image -->
                            <div class="absolute inset-0 flex items-center justify-center text-emerald-600 font-bold bg-emerald-50 text-xl z-0">{{ substr($kader['name'] ?? 'K', 0, 1) }}</div>
                        @endif
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[11px] font-bold text-[#059669] mb-1">Kader Posyandu</span>
                        <h3 class="text-[18px] font-black text-[#1E293B] tracking-tight leading-none mb-1.5">{{ $kader['name'] ?? 'Kader' }}</h3>
                        <div class="flex items-center gap-1.5 mb-1.5">
                            <svg class="w-3.5 h-3.5 text-[#10B981]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <span class="text-[11px] font-bold text-[#10B981]">{{ $kader['role'] ?? 'Kader Utama' }}</span>
                        </div>
                        <div class="flex items-center gap-1.5 text-slate-500">
                            <svg class="w-[14px] h-[14px] text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <span class="text-[12px] font-semibold">{{ $formattedWa ?: '-' }}</span>
                        </div>
                    </div>
                </div>
                
                <a href="{{ $kader['whatsapp_url'] ?? '#' }}" target="_blank" class="bg-[#10B981] active:bg-[#059669] text-white px-3 py-2.5 rounded-[12px] flex items-center gap-1.5 shadow-[0_8px_16px_rgba(16,185,129,0.25)] transition-colors self-center border border-[#059669]/20">
                    <svg class="w-[18px] h-[18px]" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    <span class="text-[11px] font-bold">Chat WhatsApp</span>
                </a>
            </div>
            @endif

            <!-- 3. PERSIAPAN SEBELUM DATANG CARD -->
            @php
                $defaultChecklist = [
                    ['task' => 'Bawa Buku KIA (KMS)', 'checked' => true],
                    ['task' => 'Pastikan anak sudah sarapan', 'checked' => false],
                    ['task' => 'Bawa popok / pakaian ganti', 'checked' => false],
                    ['task' => 'Bawa air minum', 'checked' => false],
                    ['task' => 'Bawa Kartu BPJS (opsional)', 'checked' => false],
                ];
                $activeChecklist = !empty($checklist) ? $checklist : $defaultChecklist;
            @endphp
            <div class="bg-white rounded-[32px] p-7 shadow-[0_4px_24px_rgba(0,0,0,0.04)] border border-slate-100/60 relative overflow-hidden" 
                 x-data="{ items: {{ json_encode($activeChecklist) }} }">
                
                <div class="flex items-center gap-3 mb-6 relative z-10">
                    <div class="w-[36px] h-[36px] rounded-full bg-[#F3E8FF] text-[#8B5CF6] flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    </div>
                    <h2 class="text-[18px] font-black text-[#1E293B] tracking-tight">Persiapan Sebelum Datang</h2>
                </div>

                <div class="space-y-4 relative z-10">
                    <template x-for="(item, index) in items" :key="index">
                        <div class="flex items-center gap-3.5 cursor-pointer group" @click="item.checked = !item.checked">
                            <!-- Checkbox -->
                            <div class="w-6 h-6 rounded-md border-[2.5px] flex items-center justify-center transition-colors"
                                 :class="item.checked ? 'bg-[#10B981] border-[#10B981]' : 'border-slate-300 group-hover:border-[#10B981] bg-white'">
                                <svg x-show="item.checked" class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3.5" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <!-- Text -->
                            <p class="text-[14px] font-semibold transition-colors flex-1"
                               :class="item.checked ? 'text-slate-400 line-through' : 'text-slate-700'">
                                <span x-text="item.task"></span>
                            </p>
                        </div>
                    </template>
                </div>

                <!-- Decorative Illustration Container -->
                <div class="absolute right-[-10px] bottom-10 w-[140px] h-[140px] pointer-events-none opacity-90 z-0">
                    <svg viewBox="0 0 100 100" class="w-full h-full">
                        <rect x="75" y="45" width="12" height="35" rx="3" fill="#93C5FD"/>
                        <rect x="78" y="38" width="6" height="7" fill="#60A5FA" />
                        <rect x="77" y="35" width="8" height="3" fill="#2563EB" />
                        <rect x="25" y="70" width="40" height="6" rx="3" fill="#FDE68A" />
                        <rect x="25" y="77" width="40" height="8" rx="3" fill="#93C5FD" />
                        <path d="M40 35 L70 35 L75 75 L35 75 Z" fill="#A7F3D0" />
                        <path d="M45 35 Q55 10 65 35" fill="none" stroke="#34D399" stroke-width="4" />
                        <path d="M55 60 A 3 3 0 0 0 52 57 A 3 3 0 0 0 49 60 Q 49 65 55 68 Q 61 65 61 60 A 3 3 0 0 0 58 57 A 3 3 0 0 0 55 60 Z" fill="#6EE7B7" />
                        <path d="M30 40 L32 43 L35 44 L32 45 L30 48 L28 45 L25 44 L28 43 Z" fill="#A7F3D0" />
                        <path d="M80 30 L81 33 L84 34 L81 35 L80 38 L79 35 L76 34 L79 33 Z" fill="#93C5FD" />
                    </svg>
                </div>
            </div>

            <!-- 4. INFORMASI POSYANDU CARD -->
            <div class="bg-[#F4F9FF] rounded-[32px] p-7 shadow-[0_4px_24px_rgba(0,0,0,0.02)] border border-[#E0F2FE]">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-[36px] h-[36px] rounded-full bg-blue-100 text-[#3B82F6] flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h2 class="text-[18px] font-black text-[#1E293B] tracking-tight">Informasi Posyandu</h2>
                </div>

                <div class="space-y-5">
                    <!-- Alamat -->
                    <div class="flex items-start gap-4">
                        <div class="w-5 h-5 text-blue-500 shrink-0 mt-0.5">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </div>
                        <div class="flex-1 border-b border-blue-100/50 pb-5">
                            <h4 class="text-[13px] font-bold text-[#1E293B] mb-1">Alamat</h4>
                            <p class="text-[13px] font-medium text-slate-500 leading-relaxed pr-2">{{ $schedule['address'] ?? '-' }}</p>
                        </div>
                    </div>

                    <!-- Jam Buka -->
                    <div class="flex items-start gap-4">
                        <div class="w-5 h-5 text-blue-500 shrink-0 mt-0.5">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="flex-1 border-b border-blue-100/50 pb-5">
                            <h4 class="text-[13px] font-bold text-[#1E293B] mb-1">Jam Buka</h4>
                            <p class="text-[13px] font-medium text-slate-500 leading-relaxed">{{ $schedule['time'] ?? '08.00 - 12.00 WIB' }}</p>
                        </div>
                    </div>

                    <!-- Catatan Kader -->
                    <div class="flex items-start gap-4">
                        <div class="w-5 h-5 text-blue-500 shrink-0 mt-0.5">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-[13px] font-bold text-[#1E293B] mb-1">Catatan Kader</h4>
                            <p class="text-[13px] font-medium text-slate-500 leading-relaxed pr-2">
                                {{ $announcement['message'] ?? 'Datang lebih awal untuk menghindari antrean, ya Bu 😊' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
        
    <!-- BOTTOM NAVIGATION -->
    <x-navigation.bottom-navigation active="posyandu" />
</x-layout.mobile-shell>
