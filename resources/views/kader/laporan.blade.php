@extends('layouts.app')

@section('page-title', 'Generate Laporan')

@section('content')
<div class="flex flex-col w-full bg-slate-50/50 min-h-screen relative max-w-3xl mx-auto">
    
    <!-- 1. Hero Section (Final Summary) -->
    <div class="bg-white border-b border-slate-200 pt-4 pb-4 px-4 sm:px-6 relative overflow-hidden flex-shrink-0">
        <!-- Watermark Decorative -->
        <div class="absolute -right-8 -top-8 text-slate-800 opacity-[0.02] pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-40 h-40">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>
        </div>
        
        <div class="relative z-10 flex flex-col gap-2">
            <div class="flex items-center gap-2">
                <a href="{{ route('dashboard') }}" class="flex flex-shrink-0 items-center justify-center w-11 h-11 -ml-2 text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-full transition-all focus:outline-none focus:ring-2 focus:ring-slate-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </a>
                <div class="bg-slate-50 text-teal-600 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-widest border border-slate-200/60">
                    Laporan Posyandu
                </div>
            </div>
            <div>
                <h1 class="text-xl sm:text-2xl font-black text-slate-800 tracking-tight leading-tight mb-1">Generate Laporan Bulanan</h1>
                
                <!-- Mini Summary Horizontal -->
                <div class="mt-2 flex flex-wrap items-center gap-x-3 gap-y-1.5 text-[11px] font-medium text-slate-600 bg-slate-50 border border-slate-100 rounded-lg py-1.5 px-3 w-fit shadow-sm">
                    <div class="flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                        <span>Posyandu <span class="font-bold text-slate-800">{{ $posyanduAktif ?? 'Melati 1' }}</span></span>
                    </div>
                    <div class="hidden sm:block w-px h-3 bg-slate-200"></div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                        <span>Periode <span class="font-bold text-slate-800">{{ $periode ?? 'Juli 2026' }}</span></span>
                    </div>
                    <div class="hidden sm:block w-px h-3 bg-slate-200"></div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                        <span>Balita <span class="font-bold text-slate-800">{{ $totalBalita ?? 32 }}</span></span>
                    </div>
                    <div class="hidden sm:block w-px h-3 bg-slate-200"></div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        <span>Cakupan <span class="font-bold text-slate-800">{{ $persentase ?? 75 }}%</span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex flex-col gap-3 p-4 sm:p-5 flex-1">
        
        {{--
            Backend: This form GETs laporan filtered by posyandu_id and periode.
            Action: route('laporan.index') with query params.
            Production: LaporanController@index(Request $request)

            Controller expected variables (for the summary below):
              $posyanduAktif  (string) — selected posyandu name
              $periode        (string) — selected period, e.g. 'Juli 2026'
              $totalBalita    (int)
              $sudahDiukur    (int)
              $belumDiukur    (int)
              $perluPerhatian (int)
              $berisiko       (int)
              $persentase     (int)   — 0-100
              $dataKosong     (bool)  — true if no measurement data exists
        --}}
        <!-- 2. Form Filter -->
        <div class="bg-white rounded-xl p-3 shadow-sm border border-slate-100">
            <form id="form-laporan-filter" action="{{ route('laporan.index') }}" method="GET">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div class="flex flex-col gap-1.5 relative">
                    <label for="posyandu_id" class="text-[10px] font-bold text-slate-500 flex items-center gap-1.5 uppercase tracking-wider">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3 text-slate-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                        </svg>
                        Pilih Posyandu
                    </label>
                    <div class="relative">
                        <select id="posyandu_id" name="posyandu_id" class="w-full bg-slate-50 border border-slate-200/60 text-slate-800 text-[12px] rounded-lg pl-3 pr-10 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 font-bold appearance-none hover:bg-slate-100/50 transition-colors cursor-pointer">
                            <option value="1">Melati 1</option>
                            <option value="2">Melati 2</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-1.5">
                    <label for="periode" class="text-[10px] font-bold text-slate-500 flex items-center gap-1.5 uppercase tracking-wider">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3 text-slate-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                        Periode Laporan
                    </label>
                    <input type="month" id="periode" name="periode" value="{{ date('Y-m') }}" class="w-full bg-slate-50 border border-slate-200/60 text-slate-800 text-[12px] rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 font-bold hover:bg-slate-100/50 transition-colors cursor-pointer">
                </div>
            </div>
            </form>
        </div>

        @if(isset($dataKosong) && $dataKosong)
            <!-- Empty State -->
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100 flex flex-col items-center justify-center text-center mt-2">
                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 mb-4 border border-slate-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                </div>
                <h3 class="text-[14px] font-bold text-slate-800 mb-1">Belum Ada Data</h3>
                <p class="text-[11px] text-slate-500 max-w-sm mb-4 leading-relaxed">Belum ada pengukuran yang dilakukan pada periode ini. Lakukan pengukuran terlebih dahulu.</p>
                <a href="{{ route('balita.index') }}" class="bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 px-4 py-2 rounded-lg font-bold text-[11px] shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-slate-200">
                    Mulai Pengukuran
                </a>
            </div>
        @else
            <!-- 3. Ringkasan Laporan Dashboard (bg-white) -->
            <div class="bg-white rounded-xl p-3 sm:p-4 shadow-sm border border-slate-100 flex flex-col gap-2.5">
                
                <!-- Progress Indicator -->
                <div class="flex flex-col gap-1">
                    <div class="flex justify-between items-end">
                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Cakupan Pengukuran</span>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total <span class="text-slate-700">{{ $totalBalita ?? 32 }}</span></span>
                    </div>
                    <div class="flex items-center gap-2.5 mt-0.5">
                        <div class="flex-1 bg-slate-100 border border-slate-200/50 rounded-full h-1.5 overflow-hidden shadow-inner">
                            <div class="bg-teal-500 h-1.5 rounded-full" style="width: {{ $persentase ?? 75 }}%"></div>
                        </div>
                        <span class="text-sm font-black text-teal-600 leading-none">{{ $persentase ?? 75 }}%</span>
                    </div>
                    <!-- Added helper text below progress bar -->
                    <p class="text-[10px] text-slate-500 mt-0.5">{{ $sudahDiukur ?? 24 }} dari {{ $totalBalita ?? 32 }} balita telah diukur.</p>
                </div>
                
                <!-- Metrics Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 pt-1.5 border-t border-slate-50">
                    <!-- Sudah Diukur -->
                    <div class="rounded-lg p-2.5 flex flex-col gap-0.5 border border-slate-100 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-sm hover:border-slate-200 group bg-slate-50/50">
                        <div class="flex justify-between items-start mb-0.5">
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider group-hover:text-slate-700 transition-colors">Sudah Diukur</span>
                            <div class="w-4 h-4 rounded text-teal-600 bg-teal-100/50 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-2.5 h-2.5"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg>
                            </div>
                        </div>
                        <span class="text-xl font-black text-slate-800 leading-none">{{ $sudahDiukur ?? 24 }}</span>
                    </div>
                    
                    <!-- Belum Diukur -->
                    <div class="rounded-lg p-2.5 flex flex-col gap-0.5 border border-slate-100 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-sm hover:border-slate-200 group bg-slate-50/50">
                        <div class="flex justify-between items-start mb-0.5">
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider group-hover:text-slate-700 transition-colors">Belum Diukur</span>
                            <div class="w-4 h-4 rounded text-slate-500 bg-slate-200/50 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-2.5 h-2.5"><path fill-rule="evenodd" d="M4 10a.75.75 0 01.75-.75h10.5a.75.75 0 010 1.5H4.75A.75.75 0 014 10z" clip-rule="evenodd" /></svg>
                            </div>
                        </div>
                        <span class="text-xl font-black text-slate-800 leading-none">{{ $belumDiukur ?? 8 }}</span>
                    </div>

                    <!-- Perlu Perhatian -->
                    <div class="rounded-lg p-2.5 flex flex-col gap-0.5 border border-slate-100 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-sm hover:border-amber-200 group bg-slate-50/50">
                        <div class="flex justify-between items-start mb-0.5">
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider group-hover:text-amber-600 transition-colors">Perhatian</span>
                            <div class="w-4 h-4 rounded text-amber-600 bg-amber-100/50 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-2.5 h-2.5"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg>
                            </div>
                        </div>
                        <span class="text-xl font-black text-amber-600 leading-none">{{ $perluPerhatian ?? 5 }}</span>
                    </div>

                    <!-- Berisiko -->
                    <div class="rounded-lg p-2.5 flex flex-col gap-0.5 border border-slate-100 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-sm hover:border-rose-200 group bg-slate-50/50">
                        <div class="flex justify-between items-start mb-0.5">
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider group-hover:text-rose-600 transition-colors">Berisiko</span>
                            <div class="w-4 h-4 rounded text-rose-600 bg-rose-100/50 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-2.5 h-2.5"><path fill-rule="evenodd" d="M10 1.414a.75.75 0 01.442.144l7 5a.75.75 0 01.308.614v6.656a.75.75 0 01-.22.53l-6.497 6.498a.75.75 0 01-1.06 0l-6.498-6.498a.75.75 0 01-.22-.53V7.172a.75.75 0 01.308-.614l7-5a.75.75 0 01.442-.144zM8.5 6.5a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm-.25 5a.75.75 0 00-.75.75v3.5a.75.75 0 001.5 0v-3.5a.75.75 0 00-.75-.75h-1zm3.5 0a.75.75 0 00-.75.75v3.5a.75.75 0 001.5 0v-3.5a.75.75 0 00-.75-.75h-1z" clip-rule="evenodd" /></svg>
                            </div>
                        </div>
                        <span class="text-xl font-black text-rose-600 leading-none">{{ $berisiko ?? 2 }}</span>
                    </div>
                </div>
            </div>

            <!-- Preview PDF & Isi Laporan Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                
                <!-- 4. Preview PDF (bg-slate-50) -->
                <div class="bg-slate-50/80 rounded-xl p-3 border border-slate-200/70 shadow-sm flex items-start gap-2.5 transition-all duration-200 hover:shadow-md hover:-translate-y-0.5">
                    <div class="w-9 h-9 rounded-lg bg-white text-rose-500 flex items-center justify-center flex-shrink-0 border border-rose-100 shadow-sm mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </div>
                    <div class="flex flex-col flex-1 min-w-0">
                        <div class="flex items-center justify-between gap-2 mb-0.5">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Format PDF</span>
                            <div class="bg-emerald-100/50 text-emerald-700 px-1.5 py-0.5 rounded text-[10px] font-black tracking-wider uppercase border border-emerald-200/50 shadow-sm">
                                Siap
                            </div>
                        </div>
                        <h3 class="text-[11px] font-bold text-slate-800 truncate mb-1">Laporan_Bulanan_{{ $periode ?? 'Juli_2026' }}.pdf</h3>
                        <div class="flex flex-col gap-0.5">
                            <div class="flex items-center text-[10px] text-slate-500 font-medium">
                                <span class="w-1 h-1 rounded-full bg-slate-300 mr-1.5"></span>
                                Estimasi 4 Halaman
                            </div>
                            <div class="flex items-center text-[10px] text-slate-500 font-medium">
                                <span class="w-1 h-1 rounded-full bg-slate-300 mr-1.5"></span>
                                Ukuran File ~250 KB
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 5. Isi Laporan Card (bg-teal-50 transparan) -->
                <div class="bg-teal-50/50 rounded-xl p-3 border border-teal-100/60 shadow-sm transition-all duration-200 hover:shadow-md hover:-translate-y-0.5 flex flex-col">
                    <span class="text-[10px] font-bold text-teal-800 mb-0.5 uppercase tracking-wider">Isi Laporan</span>
                    <p class="text-[10px] text-teal-600 mb-1.5">Laporan akan memuat:</p>
                    <ul class="flex flex-col gap-1">
                        <li class="flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3 text-teal-500 flex-shrink-0">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-[10px] font-medium text-teal-900/80">Rekap Pengukuran</span>
                        </li>
                        <li class="flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3 text-teal-500 flex-shrink-0">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-[10px] font-medium text-teal-900/80">Statistik Status Gizi</span>
                        </li>
                        <li class="flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3 text-teal-500 flex-shrink-0">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-[10px] font-medium text-teal-900/80">Daftar Balita Terukur</span>
                        </li>
                        <li class="flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3 text-teal-500 flex-shrink-0">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-[10px] font-medium text-teal-900/80">Ringkasan Posyandu</span>
                        </li>
                        <li class="flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3 text-teal-500 flex-shrink-0">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-[10px] font-medium text-teal-900/80">Periode Pelaporan</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- 6. Confirmation Card (emerald-50) -->
            <div class="bg-emerald-50/40 rounded-xl p-2.5 border border-emerald-100/50 shadow-sm flex flex-col gap-1.5">
                <div class="flex items-center gap-2">
                    <div class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider block leading-none mb-0.5">Status</span>
                        <span class="text-[10px] font-bold text-emerald-900">Semua data siap diproses</span>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-y-0.5 gap-x-2 pl-7">
                    <div class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-2.5 h-2.5 text-emerald-500"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg>
                        <span class="text-[10px] font-medium text-emerald-800/80">Data Posyandu tersedia</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-2.5 h-2.5 text-emerald-500"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg>
                        <span class="text-[10px] font-medium text-emerald-800/80">Rekap pengukuran lengkap</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-2.5 h-2.5 text-emerald-500"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg>
                        <span class="text-[10px] font-medium text-emerald-800/80">Statistik berhasil dihitung</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-2.5 h-2.5 text-emerald-500"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg>
                        <span class="text-[10px] font-medium text-emerald-800/80">Laporan siap diunduh</span>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- 7. CTA Area (Footer Action) -->
    @if(!isset($dataKosong) || !$dataKosong)
    <div class="mt-auto w-full bg-slate-50 border-t border-slate-200/60 p-4 flex flex-col items-center gap-2">
        <p class="text-[10px] font-semibold text-slate-500 text-center px-4 mb-0.5">Seluruh data telah diverifikasi dan siap dibuat menjadi laporan.</p>
        {{-- Backend: wire this button to a PDF generation action.
             Production: <form action="{{ route('laporan.generate') }}" method="POST"> @csrf
             or use a JavaScript fetch to /api/laporan/generate --}}
        <button
            id="btn-generate-laporan"
            type="button"
            form="form-laporan-filter"
            class="w-full sm:max-w-sm flex items-center justify-center gap-2 bg-teal-600 text-white px-5 py-2.5 rounded-xl transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md hover:shadow-teal-600/30 font-bold text-[12px] focus:outline-none focus:ring-2 focus:ring-teal-600 focus:ring-offset-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                <path fill-rule="evenodd" d="M5.625 1.5H9a3.75 3.75 0 013.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 013.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 01-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875zm6.905 9.971a.75.75 0 00-1.06 0l-3 3a.75.75 0 101.06 1.06l1.72-1.72V18a.75.75 0 001.5 0v-4.189l1.72 1.72a.75.75 0 101.06-1.06l-3-3z" clip-rule="evenodd" />
                <path d="M14.25 5.25a5.23 5.23 0 00-1.279-3.434 9.768 9.768 0 016.963 6.963A5.23 5.23 0 0016.5 7.5h-1.875a.375.375 0 01-.375-.375V5.25z" />
            </svg>
            Generate Laporan PDF
        </button>
        <span class="text-[10px] font-medium text-slate-400">Laporan akan diunduh dalam format PDF (.pdf)</span>
    </div>
    @endif
</div>
@endsection
