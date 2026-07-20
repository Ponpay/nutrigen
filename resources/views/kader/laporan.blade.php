@extends('layouts.app')

@section('page-title', 'Generate Laporan')

@section('content')
<div class="flex flex-col w-full bg-slate-50 min-h-screen relative mx-auto">
    
    <!-- 1. Hero Workspace (Layered Surface) -->
    <div class="bg-gradient-to-b from-emerald-50/80 to-slate-50 pb-5 sm:pb-6 relative overflow-hidden flex-shrink-0">
        <!-- Ambient Glow -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[300px] bg-emerald-400/10 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(circle at 2px 2px, slate-800 1px, transparent 0); background-size: 24px 24px;"></div>
        
        <div class="relative z-10 px-4 sm:px-8 max-w-5xl mx-auto pt-5 sm:pt-6">
            <div class="flex flex-col md:flex-row md:items-start justify-between gap-6">
                
                <!-- Title & Subtitle -->
                <div class="flex items-start gap-4">
                    <a href="{{ route('dashboard') }}" class="flex items-center justify-center w-10 h-10 bg-white/60 text-slate-500 hover:text-slate-800 hover:bg-white rounded-full transition-all focus:outline-none shadow-[0_2px_8px_-4px_rgba(0,0,0,0.05)] mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                    </a>
                    <div class="flex flex-col gap-1.5">
                        <div class="flex items-center gap-3">
                            <h1 class="text-[24px] sm:text-[28px] font-bold text-slate-800 tracking-tight leading-none">Workspace Pelaporan</h1>
                            <div class="hidden sm:flex items-center gap-1.5 bg-white/80 text-emerald-600 px-2.5 py-1 rounded-md border border-emerald-100/50 shadow-sm">
                                <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></div>
                                <span class="text-[9px] font-bold uppercase tracking-widest">Siap</span>
                            </div>
                        </div>
                        <p class="text-[14px] font-medium text-slate-500/80 leading-snug mt-1">Tinjau dan hasilkan dokumen laporan posyandu bulanan.</p>
                    </div>
                </div>

                <!-- Form Filter & Stats -->
                <form id="form-laporan-filter" action="{{ route('laporan.index') }}" method="GET" class="w-full md:w-auto mt-2 md:mt-0">
                    <div class="flex flex-col sm:flex-row items-center gap-3">
                        <div class="flex bg-white/60 backdrop-blur-sm p-1.5 rounded-2xl border border-white/80 shadow-[0_4px_12px_-4px_rgba(0,0,0,0.03)] w-full sm:w-auto">
                            <!-- Posyandu -->
                            <div class="relative flex-1 sm:w-40">
                                <select id="posyandu_id" name="posyandu_id" class="w-full bg-transparent text-slate-700 text-[13px] font-semibold rounded-xl pl-3 pr-8 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 appearance-none cursor-pointer hover:bg-white/50 transition-colors">
                                    <option value="1" {{ request('posyandu_id') == 1 ? 'selected' : '' }}>Melati 1</option>
                                    <option value="2" {{ request('posyandu_id') == 2 ? 'selected' : '' }}>Melati 2</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" /></svg>
                                </div>
                            </div>
                            <div class="w-px bg-slate-200/50 my-1.5 mx-1.5"></div>
                            <!-- Periode -->
                            <div class="relative flex-1 sm:w-40">
                                <input type="month" id="periode" name="periode" value="{{ $periodeValue }}" onchange="this.form.submit()" class="w-full bg-transparent text-slate-700 text-[13px] font-semibold rounded-xl pl-3 pr-2 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 cursor-pointer hover:bg-white/50 transition-colors">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- 2. Main Canvas Content -->
    <div class="px-4 sm:px-8 max-w-5xl mx-auto w-full pb-16">
        @if(isset($dataKosong) && $dataKosong)
            <!-- Empty State -->
            <div class="bg-white rounded-[32px] p-10 shadow-[0_8px_30px_-4px_rgba(0,0,0,0.04)] ring-1 ring-slate-100 flex flex-col items-center justify-center text-center mt-2">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 mb-5 ring-1 ring-slate-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                </div>
                <h3 class="text-[16px] font-bold text-slate-800 mb-2">Belum Ada Data</h3>
                <p class="text-[13px] text-slate-500 max-w-sm mb-6 leading-relaxed">Belum ada pengukuran yang dilakukan pada periode ini. Lakukan pengukuran terlebih dahulu.</p>
                <a href="{{ route('balita.index') }}" class="bg-emerald-600 hover:bg-emerald-500 text-white px-6 py-3 rounded-xl font-bold text-[13px] shadow-[0_4px_12px_-2px_rgba(16,185,129,0.3)] transition-all hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-emerald-500/30">
                    Mulai Pengukuran
                </a>
            </div>
        @else
            <!-- Body Content Container -->
            <div class="flex flex-col gap-6 sm:gap-8 -mt-2">
                
                <!-- 2. Coverage Tinted Section -->
                <div class="bg-emerald-50/40 rounded-[24px] p-6 sm:p-8 flex flex-col gap-5 sm:gap-6 relative overflow-hidden group/coverage">
                    <div class="absolute right-0 top-0 w-64 h-64 bg-emerald-100/30 rounded-bl-full pointer-events-none -z-10 blur-3xl"></div>
                    
                    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                        <div class="flex-1 max-w-md">
                            <h3 class="text-[15px] font-semibold text-slate-800">Status Pengukuran</h3>
                            <p class="text-[12px] font-medium text-slate-500 mt-1 mb-4">{{ $sudahDiukur ?? 24 }} dari {{ $totalBalita ?? 32 }} balita telah diverifikasi bulan ini.</p>
                            
                            <div class="relative w-full sm:w-4/5 h-2 bg-emerald-100/60 rounded-full overflow-hidden shadow-inner">
                                <div class="absolute top-0 left-0 h-full bg-emerald-500 rounded-full transition-all duration-1000 ease-out relative overflow-hidden" style="width: {{ $persentase ?? 75 }}%">
                                    <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/30 to-transparent -translate-x-full group-hover/coverage:animate-[shimmer_2s_infinite]"></div>
                                </div>
                            </div>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <span class="text-5xl sm:text-6xl font-bold text-emerald-600 tracking-tighter leading-none">{{ $persentase ?? 75 }}<span class="text-3xl text-emerald-500/60">%</span></span>
                        </div>
                    </div>
                    
                    <!-- Metrics Tinted Sections (No Border, No Shadow) -->
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mt-1">
                        <!-- Sudah Diukur -->
                        <div class="rounded-[20px] p-4 flex flex-col gap-2.5 bg-emerald-100/40 transition-all hover:-translate-y-0.5 hover:bg-emerald-200/30 group">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-emerald-200/50 text-emerald-700 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg>
                                </div>
                                <span class="text-[12px] font-semibold text-emerald-900/70">Sudah Diukur</span>
                            </div>
                            <div class="flex items-baseline gap-1.5 ml-1">
                                <span class="text-3xl font-bold text-emerald-800">{{ $sudahDiukur ?? 24 }}</span>
                            </div>
                        </div>
                        
                        <!-- Belum Diukur -->
                        <div class="rounded-[20px] p-4 flex flex-col gap-2.5 bg-slate-200/40 transition-all hover:-translate-y-0.5 hover:bg-slate-200/60 group">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-slate-300/50 text-slate-700 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z" clip-rule="evenodd" /></svg>
                                </div>
                                <span class="text-[12px] font-semibold text-slate-700/80">Pending</span>
                            </div>
                            <div class="flex items-baseline gap-1.5 ml-1">
                                <span class="text-3xl font-bold text-slate-800">{{ $belumDiukur ?? 8 }}</span>
                            </div>
                        </div>

                        <!-- Perhatian -->
                        <div class="rounded-[20px] p-4 flex flex-col gap-2.5 bg-amber-100/40 transition-all hover:-translate-y-0.5 hover:bg-amber-100/60 group">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-amber-200/50 text-amber-700 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg>
                                </div>
                                <span class="text-[12px] font-semibold text-amber-900/70">Perhatian</span>
                            </div>
                            <div class="flex items-baseline gap-1.5 ml-1">
                                <span class="text-3xl font-bold text-amber-800">{{ $perluPerhatian ?? 5 }}</span>
                            </div>
                        </div>

                        <!-- Berisiko -->
                        <div class="rounded-[20px] p-4 flex flex-col gap-2.5 bg-rose-100/40 transition-all hover:-translate-y-0.5 hover:bg-rose-100/60 group">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-rose-200/50 text-rose-700 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path fill-rule="evenodd" d="M10 1.414a.75.75 0 01.442.144l7 5a.75.75 0 01.308.614v6.656a.75.75 0 01-.22.53l-6.497 6.498a.75.75 0 01-1.06 0l-6.498-6.498a.75.75 0 01-.22-.53V7.172a.75.75 0 01.308-.614l7-5a.75.75 0 01.442-.144zM8.5 6.5a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm-.25 5a.75.75 0 00-.75.75v3.5a.75.75 0 001.5 0v-3.5a.75.75 0 00-.75-.75h-1zm3.5 0a.75.75 0 00-.75.75v3.5a.75.75 0 001.5 0v-3.5a.75.75 0 00-.75-.75h-1z" clip-rule="evenodd" /></svg>
                                </div>
                                <span class="text-[12px] font-semibold text-rose-900/70">Risiko Tinggi</span>
                            </div>
                            <div class="flex items-baseline gap-1.5 ml-1">
                                <span class="text-3xl font-bold text-rose-800">{{ $berisiko ?? 2 }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. Document Floating Panel & Checklist Surface -->
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 sm:gap-8">
                    
                    <!-- Preview PDF (The Floating White Panel) -->
                    <div class="lg:col-span-3 bg-white rounded-[24px] p-6 sm:p-8 shadow-[0_8px_30px_-4px_rgba(0,0,0,0.06)] ring-1 ring-slate-100 flex flex-col sm:flex-row items-center sm:items-start gap-6 transition-all hover:shadow-[0_12px_40px_-4px_rgba(0,0,0,0.08)] group relative overflow-hidden text-center sm:text-left">
                        <!-- Subtle Document Pattern & Glow -->
                        <div class="absolute inset-0 opacity-[0.015] pointer-events-none" style="background-image: linear-gradient(slate-800 1px, transparent 1px); background-size: 100% 24px;"></div>
                        <div class="absolute right-0 bottom-0 w-64 h-64 bg-rose-400/5 rounded-full blur-3xl pointer-events-none group-hover:bg-emerald-400/5 transition-colors duration-700"></div>
                        
                        <div class="absolute -right-6 top-10 rotate-12 opacity-[0.02] pointer-events-none">
                            <span class="text-6xl font-black uppercase tracking-widest text-slate-900">CONFIDENTIAL</span>
                        </div>

                        <!-- Large Thumbnail -->
                        <div class="w-24 h-32 sm:w-28 sm:h-36 rounded-[14px] bg-white text-rose-500 flex flex-col items-center justify-center flex-shrink-0 shadow-[0_8px_24px_-4px_rgba(0,0,0,0.12)] ring-1 ring-slate-200/60 group-hover:-translate-y-1 group-hover:shadow-[0_16px_32px_-4px_rgba(225,29,72,0.15)] transition-all duration-500 relative overflow-hidden mx-auto sm:mx-0">
                            <!-- Fold effect -->
                            <div class="absolute top-0 right-0 w-7 h-7 bg-slate-50 rounded-bl-xl shadow-sm border-b border-l border-slate-200/60 z-10"></div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 sm:w-12 sm:h-12 mt-2 opacity-90 group-hover:scale-110 transition-transform duration-500">
                                <path d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0016.5 9h-1.875a1.875 1.875 0 01-1.875-1.875V5.25A3.75 3.75 0 009 1.5H5.625zM7.5 15a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5A.75.75 0 017.5 15zm.75 2.25a.75.75 0 000 1.5H12a.75.75 0 000-1.5H8.25z" clip-rule="evenodd" />
                                <path d="M12.971 1.816A5.23 5.23 0 0114.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 013.434 1.279 9.768 9.768 0 00-6.963-6.963z" />
                            </svg>
                            <span class="text-[10px] sm:text-[11px] font-black uppercase tracking-widest mt-2 sm:mt-3 bg-rose-50 text-rose-600 px-2 py-0.5 rounded-md">PDF</span>
                        </div>

                        <div class="flex flex-col flex-1 w-full justify-center mt-1 sm:mt-0 relative z-10">
                            <div class="flex items-center justify-center sm:justify-start gap-2.5 mb-2.5">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest bg-slate-100 px-2.5 py-1 rounded-full">Draft</span>
                                <div class="bg-emerald-50 text-emerald-700 px-2.5 py-1 rounded-full text-[10px] font-bold tracking-widest uppercase border border-emerald-100/80 shadow-sm flex items-center gap-1.5">
                                    <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></div>
                                    Siap Cetak
                                </div>
                            </div>
                            
                            <h4 class="text-[17px] sm:text-[19px] font-bold text-slate-800 break-all leading-tight mb-3 group-hover:text-emerald-600 transition-colors">Laporan_Posyandu_{{ str_replace(' ', '_', $periode ?? 'Juli_2026') }}.pdf</h4>
                            
                            <!-- Document details -->
                            <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3 sm:gap-4 text-[12px] font-medium text-slate-500 w-full">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg> 
                                    4 Halaman
                                </div>
                                <div class="w-1 h-1 rounded-full bg-slate-300"></div>
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.118l-12.162.912c-1.076.081-1.966-.77-1.966-1.844v-4.226m15.9-2.257c-.22.542-.716 1.01-1.284 1.154-1.21.306-2.433.565-3.67.771-1.13.192-2.31.298-3.486.298s-2.356-.106-3.486-.298c-1.237-.206-2.46-.465-3.67-.771-1.14-.288-1.74-1.23-1.636-2.366A48.342 48.342 0 0112 10.5c3.272 0 6.446.223 9.486.657.48.069.95.277 1.25.753v2.24z" /></svg> 
                                    250 KB
                                </div>
                                <div class="w-1 h-1 rounded-full bg-slate-300"></div>
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" /></svg>
                                    {{ \Carbon\Carbon::parse($periodeValue ?? now())->translatedFormat('F Y') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Checklist (Tinted Surface) -->
                    <div class="lg:col-span-2 bg-slate-100/60 rounded-[24px] p-6 sm:p-8 flex flex-col justify-center gap-4">
                        <h3 class="text-[14px] font-semibold text-slate-700 mb-1">Memuat Informasi:</h3>
                        <ul class="flex flex-col gap-4">
                            <li class="flex items-start gap-3.5 group">
                                <div class="w-6 h-6 rounded-full bg-white text-emerald-500 flex items-center justify-center flex-shrink-0 shadow-sm group-hover:scale-110 group-hover:bg-emerald-500 group-hover:text-white transition-all mt-0.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[13px] font-semibold text-slate-800">Rekapitulasi Pengukuran</span>
                                    <span class="text-[11px] text-slate-500 mt-0.5">Data berat & tinggi badan</span>
                                </div>
                            </li>
                            <div class="w-full h-[1px] bg-gradient-to-r from-transparent via-slate-200/80 to-transparent ml-2"></div>
                            <li class="flex items-start gap-3.5 group">
                                <div class="w-6 h-6 rounded-full bg-white text-emerald-500 flex items-center justify-center flex-shrink-0 shadow-sm group-hover:scale-110 group-hover:bg-emerald-500 group-hover:text-white transition-all mt-0.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[13px] font-semibold text-slate-800">Statistik Status Gizi</span>
                                    <span class="text-[11px] text-slate-500 mt-0.5">Distribusi status gizi</span>
                                </div>
                            </li>
                            <div class="w-full h-[1px] bg-gradient-to-r from-transparent via-slate-200/80 to-transparent ml-2"></div>
                            <li class="flex items-start gap-3.5 group">
                                <div class="w-6 h-6 rounded-full bg-white text-emerald-500 flex items-center justify-center flex-shrink-0 shadow-sm group-hover:scale-110 group-hover:bg-emerald-500 group-hover:text-white transition-all mt-0.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[13px] font-semibold text-slate-800">Daftar Balita Terukur</span>
                                    <span class="text-[11px] text-slate-500 mt-0.5">Rincian {{ $sudahDiukur ?? 24 }} anak</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- 4. Completion Panel & CTA (Climax) -->
                <div class="bg-gradient-to-br from-emerald-100/70 via-emerald-50 to-white rounded-[24px] p-6 sm:p-10 flex flex-col md:flex-row items-center justify-between gap-6 sm:gap-8 relative overflow-hidden mt-2">
                    <!-- Glow & Highlights -->
                    <div class="absolute right-0 bottom-0 w-[500px] h-[500px] bg-emerald-300/10 rounded-full blur-[80px] pointer-events-none"></div>
                    <div class="absolute inset-0 bg-white/10 backdrop-blur-[1px] pointer-events-none"></div>
                    <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-emerald-200/80 to-transparent"></div>
                    
                    <div class="flex flex-col gap-3 relative z-10 w-full md:w-auto text-center md:text-left items-center md:items-start">
                        <h2 class="text-2xl sm:text-3xl font-bold text-emerald-950 tracking-tight">Data Siap Diproses</h2>
                        <p class="text-[14px] text-emerald-800/80 font-medium md:max-w-md leading-relaxed">Seluruh rekapan telah diverifikasi. Laporan bulanan siap di-generate menjadi format PDF untuk dicetak atau dibagikan.</p>
                    </div>

                    <div class="w-full md:w-auto flex-shrink-0 relative z-10 hidden md:block">
                        <form action="{{ route('laporan.generate') }}" method="POST" class="w-full">
                            @csrf
                            <input type="hidden" name="posyandu_id" value="{{ request('posyandu_id') }}">
                            <input type="hidden" name="periode" value="{{ request('periode') }}">
                            <button type="submit" class="group relative inline-flex items-center justify-center h-14 sm:h-16 px-8 sm:px-10 bg-emerald-600 hover:bg-emerald-500 active:bg-emerald-700 text-white rounded-[20px] font-bold text-[15px] shadow-[0_8px_24px_-4px_rgba(16,185,129,0.4)] hover:shadow-[0_16px_32px_-4px_rgba(16,185,129,0.5)] hover:-translate-y-1 transition-all duration-300 gap-3 focus:outline-none focus:ring-4 focus:ring-emerald-500/30 whitespace-nowrap overflow-hidden w-full md:w-auto">
                                <!-- Button Shine -->
                                <div class="absolute inset-0 -translate-x-full group-hover:animate-[shimmer_1.5s_infinite] bg-gradient-to-r from-transparent via-white/25 to-transparent pointer-events-none"></div>
                                
                                <span class="relative z-10">Generate Laporan PDF</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 relative z-10 group-hover:translate-x-1.5 transition-transform duration-300">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Mobile Sticky CTA Area -->
    @if(!isset($dataKosong) || !$dataKosong)
    <div class="md:hidden sticky bottom-0 left-0 right-0 z-50 bg-white/90 backdrop-blur-md border-t border-slate-200/60 p-4 pb-safe flex flex-col shadow-[0_-4px_12px_-4px_rgba(0,0,0,0.1)] mt-auto">
        <form action="{{ route('laporan.generate') }}" method="POST" class="w-full">
            @csrf
            <input type="hidden" name="posyandu_id" value="{{ request('posyandu_id') }}">
            <input type="hidden" name="periode" value="{{ request('periode') }}">
            <button type="submit" class="group relative w-full flex items-center justify-center gap-2.5 h-14 bg-emerald-600 hover:bg-emerald-500 active:bg-emerald-700 text-white rounded-[16px] font-semibold text-[14px] shadow-[0_8px_16px_-4px_rgba(16,185,129,0.4)] focus:outline-none focus:ring-4 focus:ring-emerald-500/30 overflow-hidden transition-all active:scale-[0.98]">
                <div class="absolute inset-0 -translate-x-full group-hover:animate-[shimmer_1.5s_infinite] bg-gradient-to-r from-transparent via-white/20 to-transparent pointer-events-none"></div>
                <span class="relative z-10">Generate Laporan PDF</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 relative z-10">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
            </button>
        </form>
    </div>
    @endif
</div>
@endsection
