@extends('layouts.public')

@section('title', 'NutriGen | Platform Monitoring Gizi Balita')

@push('head')
<style>
    .plus-texture {
        background-image: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M20 16V24M16 20H24' stroke='%23CBD5E1' stroke-width='1' stroke-linecap='round'/%3E%3C/svg%3E");
        background-size: 40px 40px;
    }
    .plus-texture-dark {
        background-image: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M20 16V24M16 20H24' stroke='%23334155' stroke-width='1' stroke-linecap='round'/%3E%3C/svg%3E");
        background-size: 40px 40px;
    }
    .chart-line {
        stroke-dasharray: 300;
        stroke-dashoffset: 300;
        transition: stroke-dashoffset 1.8s cubic-bezier(0.16,1,0.3,1);
    }
    .chart-line.drawn { stroke-dashoffset: 0; }
    @media (prefers-reduced-motion: reduce) {
        #hero-left, #hero-dashboard-card, #hero-stat-row,
        #problem-text, .problem-item, #stat-card, .section-reveal {
            opacity: 1 !important; transform: none !important; transition: none !important;
        }
        .chart-line { stroke-dashoffset: 0 !important; transition: none !important; }
    }
</style>
@endpush

@section('content')

    {{-- 1. HERO - Split layout --}}
    <section class="relative min-h-screen flex items-center pt-28 pb-20 lg:pt-32 lg:pb-24 overflow-hidden bg-white">
        <div class="absolute inset-0 plus-texture opacity-40 pointer-events-none z-0"></div>
        <div class="absolute -top-32 -left-32 w-[600px] h-[600px] bg-emerald-100/40 rounded-full blur-[100px] pointer-events-none z-0"></div>
        <div class="absolute -bottom-32 -right-32 w-[500px] h-[500px] bg-amber-100/30 rounded-full blur-[120px] pointer-events-none z-0"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                {{-- LEFT: Content --}}
                <div id="hero-left" style="opacity:0;transform:translateY(28px)">
                    <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full bg-emerald-600 text-white font-bold text-xs mb-8 shadow-[0_4px_16px_rgba(5,150,105,0.3)]">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                        </span>
                        Platform Posyandu Digital &middot; Hackathon Digdaya 2026
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.05] mb-6">
                        Bersama Tuntaskan<br>
                        Stunting,<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-emerald-400">Bangun Generasi Emas</span>
                    </h1>

                    <p class="text-lg text-slate-500 font-medium leading-relaxed mb-8 max-w-lg">
                        Ekosistem digital yang menghubungkan <strong class="text-slate-700 font-semibold">Ibu</strong>, <strong class="text-slate-700 font-semibold">Kader Posyandu</strong>, dan <strong class="text-slate-700 font-semibold">Puskesmas</strong> &mdash; pemantauan gizi berbasis WHO 2006, real-time, tanpa kertas.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-3 mb-10">
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-2xl shadow-[0_8px_24px_rgba(5,150,105,0.3)] hover:shadow-[0_12px_32px_rgba(5,150,105,0.4)] transition-all duration-300 hover:-translate-y-0.5 active:scale-95 group">
                            <span>Masuk ke Sistem</span>
                            <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                        <a href="#how-it-works" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white hover:bg-slate-50 text-slate-700 font-bold rounded-2xl border border-slate-200 shadow-[0_2px_8px_rgba(0,0,0,0.05)] hover:shadow-[0_6px_20px_rgba(0,0,0,0.08)] transition-all duration-300 hover:-translate-y-0.5 active:scale-95">
                            Pelajari Ekosistem
                        </a>
                    </div>

                    {{-- Mini Stat Cards --}}
                    <div id="hero-stat-row" class="grid grid-cols-3 gap-3" style="opacity:0;transform:translateY(16px)">
                        <div class="bg-white rounded-2xl p-4 border border-rose-100 shadow-[0_4px_16px_rgba(244,63,94,0.06)] text-center">
                            <div class="text-2xl font-extrabold text-rose-500 mb-0.5">21.6<span class="text-base">%</span></div>
                            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wide leading-tight">Angka Stunting</div>
                        </div>
                        <div class="bg-white rounded-2xl p-4 border border-emerald-100 shadow-[0_4px_16px_rgba(5,150,105,0.06)] text-center">
                            <div class="text-2xl font-extrabold text-emerald-600 mb-0.5">3</div>
                            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wide leading-tight">Portal Aktif</div>
                        </div>
                        <div class="bg-white rounded-2xl p-4 border border-amber-100 shadow-[0_4px_16px_rgba(245,158,11,0.06)] text-center">
                            <div class="text-2xl font-extrabold text-amber-500 mb-0.5">WHO</div>
                            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wide leading-tight">Standar 2006</div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT: Dashboard Preview Card --}}
                <div id="hero-dashboard-card" class="hidden lg:block" style="opacity:0;transform:translateX(24px)">
                    <div class="relative">
                        <div class="absolute -inset-4 bg-gradient-to-br from-emerald-100/60 to-amber-100/40 rounded-[2.5rem] blur-xl pointer-events-none"></div>
                        <div class="relative bg-white rounded-[24px] shadow-[0_20px_60px_rgba(0,0,0,0.1)] border border-slate-100 overflow-hidden">
                            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-50 bg-slate-50/60">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-emerald-600 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-800 leading-none">Kurva Pertumbuhan</p>
                                        <p class="text-[10px] text-slate-400 font-medium mt-0.5">Hafiz &middot; 18 bulan</p>
                                    </div>
                                </div>
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-[10px] font-bold text-emerald-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Normal
                                </span>
                            </div>
                            <div class="px-6 pt-5 pb-3">
                                <svg viewBox="0 0 280 100" class="w-full h-24" fill="none">
                                    <path d="M0 75 Q70 72 140 65 Q210 58 280 52" stroke="#D1FAE5" stroke-width="14" fill="none" opacity="0.7"/>
                                    <path class="chart-line" id="chart-path" d="M0 82 Q30 79 60 74 Q90 69 120 62 Q150 56 180 51 Q210 46 240 42 Q260 40 280 38" stroke="#10B981" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                                    <circle cx="60" cy="74" r="3" fill="#10B981"/>
                                    <circle cx="120" cy="62" r="3" fill="#10B981"/>
                                    <circle cx="180" cy="51" r="3" fill="#10B981"/>
                                    <circle cx="280" cy="38" r="4" fill="#059669"/>
                                    <text x="4" y="97" font-size="8" fill="#94A3B8" font-family="Inter,sans-serif" font-weight="600">6 bln</text>
                                    <text x="110" y="97" font-size="8" fill="#94A3B8" font-family="Inter,sans-serif" font-weight="600">12 bln</text>
                                    <text x="258" y="97" font-size="8" fill="#94A3B8" font-family="Inter,sans-serif" font-weight="600">18 bln</text>
                                </svg>
                            </div>
                            <div class="px-6 pb-5 space-y-2.5">
                                <div class="flex items-center justify-between py-2.5 border-b border-slate-50">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-7 h-7 rounded-lg bg-emerald-50 flex items-center justify-center">
                                            <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>
                                        </div>
                                        <span class="text-xs font-semibold text-slate-500">Berat Badan</span>
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <span class="text-sm font-bold text-slate-800">10.2 kg</span>
                                        <span class="w-4 h-4 rounded-full bg-emerald-100 flex items-center justify-center"><svg class="w-2.5 h-2.5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between py-2.5 border-b border-slate-50">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-7 h-7 rounded-lg bg-amber-50 flex items-center justify-center">
                                            <svg class="w-3.5 h-3.5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                        <span class="text-xs font-semibold text-slate-500">Tinggi Badan</span>
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <span class="text-sm font-bold text-slate-800">76.5 cm</span>
                                        <span class="w-4 h-4 rounded-full bg-emerald-100 flex items-center justify-center"><svg class="w-2.5 h-2.5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between py-2">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-7 h-7 rounded-lg bg-emerald-50 flex items-center justify-center">
                                            <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                        </div>
                                        <span class="text-xs font-semibold text-slate-500">Z-Score (TB/U)</span>
                                    </div>
                                    <span class="text-sm font-bold text-emerald-600">-0.8 SD</span>
                                </div>
                            </div>
                            <div class="px-6 py-3.5 bg-slate-50/80 border-t border-slate-50 flex items-center justify-between">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wide">Tervalidasi Ahli Gizi</span>
                                <div class="flex items-center gap-1.5">
                                    <div class="w-5 h-5 rounded-full bg-emerald-600 flex items-center justify-center"><svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div>
                                    <span class="text-[10px] font-bold text-emerald-700">Disetujui</span>
                                </div>
                            </div>
                        </div>
                        <div class="absolute -bottom-4 -left-6 bg-white rounded-2xl shadow-[0_8px_24px_rgba(0,0,0,0.1)] border border-slate-100 px-4 py-2.5 flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-xl bg-amber-50 flex items-center justify-center">
                                <svg class="w-4 h-4 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-800 leading-none">Standar WHO 2006</p>
                                <p class="text-[10px] text-slate-400 font-medium mt-0.5">Z-Score Terstandarisasi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 2 & 3. PROBLEM + STATS --}}
    <section id="problem" class="py-24 lg:py-32 bg-slate-50 relative overflow-hidden border-y border-slate-100">
        <div class="absolute inset-0 plus-texture opacity-30 pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
                <div id="problem-text" class="lg:col-span-7" style="opacity:0;transform:translateY(28px)">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-rose-50 border border-rose-200 rounded-full text-rose-700 text-xs font-bold uppercase tracking-widest mb-5">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        Realita Saat Ini
                    </div>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-[1.1] mb-6">Pemantauan Manual<br>Meninggalkan Celah Berbahaya.</h2>
                    <p class="text-lg text-slate-500 font-medium leading-relaxed mb-10">Jutaan buku KIA tersimpan di laci tanpa dievaluasi. Data Posyandu memakan waktu berminggu-minggu untuk direkap, menyebabkan keterlambatan intervensi pada masa <em>golden age</em> balita.</p>
                    <div class="space-y-3" id="problem-items">
                        <div class="problem-item flex items-start gap-4 group p-4 rounded-2xl bg-white border border-slate-100 hover:border-rose-200 hover:shadow-[0_8px_30px_rgba(244,63,94,0.07)] transition-all duration-300 shadow-[0_2px_8px_rgba(0,0,0,0.04)]" style="opacity:0;transform:translateY(20px)">
                            <div class="flex-shrink-0 w-11 h-11 rounded-xl bg-rose-500 flex items-center justify-center group-hover:scale-105 transition-all duration-300 shadow-[0_4px_12px_rgba(244,63,94,0.25)]"><svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                            <div><h3 class="text-slate-900 font-bold text-base leading-snug mb-1">Data Lambat Diproses</h3><p class="text-slate-500 text-sm leading-relaxed">Data lambat sampai ke tenaga kesehatan Puskesmas, menunda tindakan preventif yang kritis.</p></div>
                        </div>
                        <div class="problem-item flex items-start gap-4 group p-4 rounded-2xl bg-white border border-slate-100 hover:border-amber-200 hover:shadow-[0_8px_30px_rgba(245,158,11,0.07)] transition-all duration-300 shadow-[0_2px_8px_rgba(0,0,0,0.04)]" style="opacity:0;transform:translateY(20px)">
                            <div class="flex-shrink-0 w-11 h-11 rounded-xl bg-amber-500 flex items-center justify-center group-hover:scale-105 transition-all duration-300 shadow-[0_4px_12px_rgba(245,158,11,0.25)]"><svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg></div>
                            <div><h3 class="text-slate-900 font-bold text-base leading-snug mb-1">Kurangnya Edukasi Mandiri</h3><p class="text-slate-500 text-sm leading-relaxed">Ibu tidak memahami kurva pertumbuhan anaknya secara mandiri di rumah.</p></div>
                        </div>
                        <div class="problem-item flex items-start gap-4 group p-4 rounded-2xl bg-white border border-slate-100 hover:border-emerald-200 hover:shadow-[0_8px_30px_rgba(5,150,105,0.07)] transition-all duration-300 shadow-[0_2px_8px_rgba(0,0,0,0.04)]" style="opacity:0;transform:translateY(20px)">
                            <div class="flex-shrink-0 w-11 h-11 rounded-xl bg-emerald-600 flex items-center justify-center group-hover:scale-105 transition-all duration-300 shadow-[0_4px_12px_rgba(5,150,105,0.25)]"><svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg></div>
                            <div><h3 class="text-slate-900 font-bold text-base leading-snug mb-1">Rawan Human Error</h3><p class="text-slate-500 text-sm leading-relaxed">Risiko kesalahan perhitungan manual dalam menentukan status stunting Z-Score.</p></div>
                        </div>
                    </div>
                </div>
                <div id="stat-card" class="lg:col-span-5" style="opacity:0;transform:translateY(32px)">
                    <div class="bg-white rounded-[28px] border border-slate-100 shadow-[0_20px_60px_rgba(0,0,0,0.08)] p-8 sm:p-10 relative overflow-hidden">
                        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-rose-400 via-amber-400 to-emerald-500"></div>
                        <div class="mb-2 flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg bg-rose-50 flex items-center justify-center"><svg class="w-4 h-4 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/></svg></div>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Angka Stunting Nasional 2024</span>
                        </div>
                        <div class="flex items-baseline mt-4 mb-2">
                            <span id="stat-counter" class="text-7xl sm:text-8xl font-extrabold text-slate-900 tracking-tight tabular-nums" aria-label="21.6">0</span>
                            <span class="text-4xl font-bold text-rose-400 ml-2">%</span>
                        </div>
                        <h4 class="text-base font-semibold text-slate-600 mb-4 pb-4 border-b border-slate-100">dari seluruh balita Indonesia mengalami stunting</h4>
                        <p class="text-slate-500 font-medium leading-relaxed text-sm mb-6">Masih di atas ambang batas WHO (20%). Target pemerintah 2025 adalah <strong class="text-slate-700">14%</strong> &mdash; butuh kecepatan data dan intervensi gizi yang tepat.</p>
                        <div>
                            <div class="flex justify-between text-xs font-bold text-slate-400 mb-2"><span>Target 14%</span><span class="text-rose-500">Saat ini 21.6%</span></div>
                            <div class="h-3 bg-slate-100 rounded-full overflow-hidden"><div id="stat-progress-bar" class="h-full bg-gradient-to-r from-rose-400 to-amber-400 rounded-full" style="width:0%"></div></div>
                            <div class="flex justify-between text-[10px] font-semibold text-slate-400 mt-1.5"><span>0%</span><span class="text-amber-600 font-bold">&#9650; 7.6% di atas target</span><span>30%</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. SOLUTION CARDS --}}
    <section class="py-24 lg:py-32 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16 section-reveal" style="opacity:0;transform:translateY(24px)">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-emerald-50 border border-emerald-200 rounded-full text-emerald-700 text-xs font-bold uppercase tracking-widest mb-5"><span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>Solusi NutriGen</div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-[1.1] mb-5 max-w-3xl mx-auto">Satu Sistem. Data Real-Time.<br class="hidden sm:block"> Eksekusi Tepat Sasaran.</h2>
                <p class="text-lg text-slate-500 font-medium leading-relaxed max-w-2xl mx-auto">NutriGen bukan sekadar aplikasi pencatat &mdash; ekosistem cerdas yang memutus birokrasi data dan memberi tenaga medis &ldquo;mata&rdquo; ke setiap desa secara instan.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                <div class="section-reveal group rounded-[24px] bg-white border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:shadow-[0_20px_50px_rgba(5,150,105,0.12)] hover:-translate-y-2 transition-all duration-300 overflow-hidden" style="opacity:0;transform:translateY(28px)">
                    <div class="h-1.5 bg-gradient-to-r from-emerald-500 to-emerald-400"></div>
                    <div class="p-7 sm:p-8">
                        <div class="text-5xl font-extrabold text-slate-50 leading-none mb-4 select-none">01</div>
                        <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-300"><svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3 tracking-tight">100% Paperless</h3>
                        <p class="text-slate-500 font-medium text-sm leading-relaxed">Buku KIA bertransformasi menjadi dashboard personal di saku tiap Ibu. Aman, terenkripsi, dan selalu dapat diakses.</p>
                        <div class="mt-6 flex items-center gap-2 text-emerald-600 font-semibold text-xs"><span class="w-5 h-0.5 bg-emerald-300 rounded-full"></span><span>Zero kertas, zero hilang</span></div>
                    </div>
                </div>
                <div class="section-reveal group rounded-[24px] bg-emerald-600 shadow-[0_8px_30px_rgba(5,150,105,0.2)] hover:shadow-[0_20px_50px_rgba(5,150,105,0.32)] hover:-translate-y-2 transition-all duration-300 overflow-hidden" style="opacity:0;transform:translateY(28px)">
                    <div class="h-1.5 bg-white/25"></div>
                    <div class="p-7 sm:p-8">
                        <div class="text-5xl font-extrabold text-white/10 leading-none mb-4 select-none">02</div>
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-300"><svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg></div>
                        <h3 class="text-xl font-bold text-white mb-3 tracking-tight">Sinkronisasi Real-Time</h3>
                        <p class="text-white/75 font-medium text-sm leading-relaxed">Keputusan intervensi stunting puskesmas diambil dari data bulan ini, bukan rekap tahun lalu.</p>
                        <div class="mt-6 flex items-center gap-2 text-emerald-100 font-semibold text-xs"><span class="w-5 h-0.5 bg-white/40 rounded-full"></span><span>Detik, bukan bulan</span></div>
                    </div>
                </div>
                <div class="section-reveal group rounded-[24px] bg-white border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:shadow-[0_20px_50px_rgba(245,158,11,0.12)] hover:-translate-y-2 transition-all duration-300 overflow-hidden" style="opacity:0;transform:translateY(28px)">
                    <div class="h-1.5 bg-gradient-to-r from-amber-400 to-amber-500"></div>
                    <div class="p-7 sm:p-8">
                        <div class="text-5xl font-extrabold text-slate-50 leading-none mb-4 select-none">03</div>
                        <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-300"><svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg></div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3 tracking-tight">Validasi Berlapis</h3>
                        <p class="text-slate-500 font-medium text-sm leading-relaxed">Algoritma otomatis mendeteksi anomali penimbangan dan menugaskan petugas gizi untuk verifikasi langsung.</p>
                        <div class="mt-6 flex items-center gap-2 text-amber-600 font-semibold text-xs"><span class="w-5 h-0.5 bg-amber-300 rounded-full"></span><span>AI-powered detection</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 5. WORKFLOW --}}
    <section id="how-it-works" class="py-24 lg:py-32 bg-slate-50 relative overflow-hidden border-y border-slate-100">
        <div class="absolute inset-0 plus-texture opacity-30 pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16 section-reveal" style="opacity:0;transform:translateY(24px)">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-emerald-50 border border-emerald-200 rounded-full text-emerald-700 text-xs font-bold uppercase tracking-widest mb-5">Cara Kerja</div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight mb-4">Kecepatan Menyelamatkan Generasi</h2>
                <p class="text-lg text-slate-500 font-medium max-w-2xl mx-auto leading-relaxed">Data bergerak dari Posyandu ke Ahli Gizi dalam hitungan detik, bukan minggu.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 lg:gap-12 relative">
                <div class="hidden md:block absolute top-[3.25rem] left-[22%] right-[22%] h-0.5 bg-gradient-to-r from-emerald-200 via-emerald-400 to-emerald-200 z-0 rounded-full"></div>
                <div class="section-reveal relative z-10 text-center group" style="opacity:0;transform:translateY(28px)">
                    <div class="w-24 h-24 mx-auto bg-white border-2 border-emerald-100 rounded-3xl flex items-center justify-center mb-3 shadow-[0_8px_24px_rgba(0,0,0,0.06)] group-hover:border-emerald-400 group-hover:scale-110 group-hover:shadow-[0_16px_40px_rgba(5,150,105,0.12)] transition-all duration-300">
                        <svg class="w-10 h-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19l7-7 3 3-7 7-3-3z"/><path stroke-linecap="round" stroke-linejoin="round" d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2 2l7.586 7.586"/><circle cx="11" cy="11" r="2"/></svg>
                    </div>
                    <div class="w-7 h-7 mx-auto mb-4 bg-emerald-600 rounded-full flex items-center justify-center text-white text-xs font-extrabold shadow-[0_4px_12px_rgba(5,150,105,0.3)]">1</div>
                    <h3 class="text-xl font-bold mb-3 text-slate-900 tracking-tight">Input Kader</h3>
                    <p class="text-slate-500 font-medium text-sm leading-relaxed max-w-[260px] mx-auto">Kader Posyandu memasukkan data ukur balita melalui Web App dari smartphone langsung di lokasi.</p>
                </div>
                <div class="section-reveal relative z-10 text-center group" style="opacity:0;transform:translateY(28px)">
                    <div class="w-24 h-24 mx-auto bg-emerald-600 rounded-3xl flex items-center justify-center mb-3 shadow-[0_8px_24px_rgba(5,150,105,0.3)] group-hover:scale-110 group-hover:shadow-[0_16px_40px_rgba(5,150,105,0.4)] transition-all duration-300">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75"><path stroke-linecap="round" stroke-linejoin="round" d="M3 22h18"/><path stroke-linecap="round" stroke-linejoin="round" d="M6 18H4c-.6 0-1-.4-1-1V5c0-.6.4-1 1-1h4c.6 0 1 .4 1 1v13"/><path stroke-linecap="round" stroke-linejoin="round" d="M14 18h-2V7c0-.6.4-1 1-1h4c.6 0 1 .4 1 1v10c0 .6-.4 1-1 1h-2"/><path stroke-linecap="round" stroke-linejoin="round" d="M10 22V8c0-.6.4-1 1-1h2c.6 0 1 .4 1 1v14"/><path stroke-linecap="round" stroke-linejoin="round" d="M10 12h4M12 10v4"/></svg>
                    </div>
                    <div class="w-7 h-7 mx-auto mb-4 bg-emerald-600 rounded-full flex items-center justify-center text-white text-xs font-extrabold shadow-[0_4px_12px_rgba(5,150,105,0.3)]">2</div>
                    <h3 class="text-xl font-bold mb-3 text-slate-900 tracking-tight">Validasi Klinis</h3>
                    <p class="text-slate-500 font-medium text-sm leading-relaxed max-w-[260px] mx-auto">Sistem mendeteksi anomali stunting dan memasukkannya ke antrean validasi Ahli Gizi Puskesmas.</p>
                </div>
                <div class="section-reveal relative z-10 text-center group" style="opacity:0;transform:translateY(28px)">
                    <div class="w-24 h-24 mx-auto bg-white border-2 border-amber-200 rounded-3xl flex items-center justify-center mb-3 shadow-[0_8px_24px_rgba(0,0,0,0.06)] group-hover:border-amber-400 group-hover:scale-110 group-hover:shadow-[0_16px_40px_rgba(245,158,11,0.15)] transition-all duration-300">
                        <svg class="w-10 h-10 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    </div>
                    <div class="w-7 h-7 mx-auto mb-4 bg-amber-500 rounded-full flex items-center justify-center text-white text-xs font-extrabold shadow-[0_4px_12px_rgba(245,158,11,0.3)]">3</div>
                    <h3 class="text-xl font-bold mb-3 text-slate-900 tracking-tight">Notifikasi Ibu</h3>
                    <p class="text-slate-500 font-medium text-sm leading-relaxed max-w-[260px] mx-auto">Ibu menerima ringkasan kurva &amp; rekomendasi gizi instan melalui WhatsApp secara privat dan aman.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- 6 & 7. ECOSYSTEM BENTO GRID --}}
    <section id="features" class="py-24 lg:py-32 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="mb-16 section-reveal" style="opacity:0;transform:translateY(24px)">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-emerald-50 border border-emerald-200 rounded-full text-emerald-700 text-xs font-bold uppercase tracking-widest mb-5">Ekosistem Sinergis</div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-[1.1] max-w-3xl">Tiga Aktor, Satu Sumber Kebenaran.</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-6 md:grid-rows-2 gap-5 auto-rows-fr">
                <div class="section-reveal md:col-span-4 bg-white rounded-[24px] p-8 lg:p-10 shadow-[0_4px_24px_rgba(0,0,0,0.06)] border border-slate-100 hover:border-rose-200 hover:shadow-[0_16px_48px_rgba(244,63,94,0.08)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-center group relative overflow-hidden" style="opacity:0;transform:translateY(24px)">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-rose-400 to-rose-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-t-[24px]"></div>
                    <div class="w-12 h-12 bg-rose-50 text-rose-500 rounded-xl flex items-center justify-center mb-6 ring-1 ring-rose-100 group-hover:scale-110 transition-transform duration-300"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg></div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-3 tracking-tight">Portal Ibu (B2C)</h3>
                    <p class="text-slate-500 font-medium leading-relaxed max-w-lg">Tidak perlu install aplikasi. Ibu cukup klik tautan WhatsApp untuk melihat kurva pertumbuhan standar WHO, evaluasi status gizi, dan rekomendasi menu resep harian.</p>
                </div>
                <div class="section-reveal md:col-span-2 bg-slate-900 rounded-[24px] p-8 lg:p-10 shadow-[0_8px_32px_rgba(15,23,42,0.15)] hover:shadow-[0_20px_60px_rgba(15,23,42,0.25)] text-white flex flex-col justify-between group relative overflow-hidden transition-all duration-300 hover:-translate-y-1" style="opacity:0;transform:translateY(24px)">
                    <div class="absolute inset-0 plus-texture-dark opacity-30"></div>
                    <div class="relative z-10 h-full flex flex-col">
                        <div class="w-12 h-12 bg-emerald-500 rounded-xl flex items-center justify-center mb-6 group-hover:-translate-y-1 group-hover:shadow-lg group-hover:shadow-emerald-500/30 transition-all duration-300"><svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg></div>
                        <div class="mt-auto">
                            <div class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-emerald-500/20 rounded-full text-emerald-400 text-[10px] font-bold uppercase tracking-wide mb-3">AI-Powered</div>
                            <h3 class="text-2xl font-bold text-white mb-3 tracking-tight">AI Nutrition</h3>
                            <p class="text-slate-400 font-medium text-sm leading-relaxed">Resep dikurasi otomatis berdasarkan status gizi aktual balita.</p>
                        </div>
                    </div>
                </div>
                <div class="section-reveal md:col-span-2 bg-white rounded-[24px] p-8 lg:p-10 border border-slate-100 flex flex-col justify-between group shadow-[0_4px_24px_rgba(0,0,0,0.06)] hover:border-emerald-200 hover:shadow-[0_16px_48px_rgba(5,150,105,0.08)] hover:-translate-y-1 transition-all duration-300" style="opacity:0;transform:translateY(24px)">
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg></div>
                    <div class="mt-auto"><h3 class="text-xl font-bold text-slate-900 mb-3 tracking-tight">Portal Puskesmas</h3><p class="text-slate-500 font-medium text-sm leading-relaxed">Dashboard agregat untuk validasi klinis tingkat kecamatan secara real-time.</p></div>
                </div>
                <div class="section-reveal md:col-span-4 bg-white rounded-[24px] p-8 lg:p-10 shadow-[0_4px_24px_rgba(0,0,0,0.06)] border border-slate-100 hover:border-amber-200 hover:shadow-[0_16px_48px_rgba(245,158,11,0.08)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-center group relative overflow-hidden" style="opacity:0;transform:translateY(24px)">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-amber-400 to-amber-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-t-[24px]"></div>
                    <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center mb-6 ring-1 ring-amber-100 group-hover:scale-110 transition-transform duration-300"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg></div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-3 tracking-tight">Portal Kader Posyandu</h3>
                    <p class="text-slate-500 font-medium leading-relaxed max-w-lg">Form input digital cerdas yang menggantikan buku tulis. Validasi Z-Score bawaan mencegah kesalahan input data antropometri sebelum dikirim ke server pusat.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- 8. VIDEO DEMO --}}
    <section id="video-demo" class="py-20 lg:py-28 bg-slate-50 relative border-y border-slate-100">
        <div class="max-w-5xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-12 section-reveal" style="opacity:0;transform:translateY(24px)">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-emerald-50 border border-emerald-200 rounded-full text-emerald-700 text-xs font-bold uppercase tracking-widest mb-5">Demo</div>
                <h2 class="text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight mb-3">Lihat Bagaimana NutriGen Bekerja</h2>
                <p class="text-base text-slate-500 font-medium max-w-xl mx-auto leading-relaxed">Demo eksklusif alur kerja NutriGen dari posyandu ke puskesmas dalam 1 menit.</p>
            </div>
            <div class="section-reveal relative max-w-3xl mx-auto" style="opacity:0;transform:translateY(24px)">
                <div class="absolute -inset-3 bg-gradient-to-br from-emerald-200/30 to-amber-200/20 rounded-[2rem] blur-xl pointer-events-none"></div>
                <div class="relative rounded-[20px] border border-slate-200 bg-white p-2 shadow-[0_20px_60px_rgba(0,0,0,0.1)] overflow-hidden">
                    <div class="flex items-center gap-1.5 px-3 py-2.5 bg-slate-50 rounded-t-[14px] border-b border-slate-100">
                        <div class="w-2.5 h-2.5 rounded-full bg-rose-400"></div><div class="w-2.5 h-2.5 rounded-full bg-amber-400"></div><div class="w-2.5 h-2.5 rounded-full bg-emerald-400"></div>
                    </div>
                    <div class="aspect-video bg-slate-900 rounded-b-[14px] relative overflow-hidden">
                        <iframe class="absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/99Radiqy15c" title="NutriGen Demo" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 9. FAQ --}}
    <section class="py-24 lg:py-32 relative overflow-hidden bg-slate-900">
        <div class="absolute inset-0 plus-texture-dark opacity-20 pointer-events-none"></div>
        <div class="absolute -top-40 right-0 w-96 h-96 bg-emerald-500/10 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute -bottom-40 left-0 w-96 h-96 bg-amber-500/10 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="max-w-4xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="text-center mb-14 section-reveal" style="opacity:0;transform:translateY(24px)">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/10 border border-white/20 rounded-full text-white/80 text-xs font-bold uppercase tracking-widest mb-6">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    FAQ
                </div>
                <h2 class="text-3xl lg:text-4xl font-extrabold text-white tracking-tight mb-3">Pertanyaan yang Sering Ditanyakan</h2>
                <p class="text-slate-400 font-medium max-w-lg mx-auto leading-relaxed">Semua yang perlu Anda ketahui tentang NutriGen.</p>
            </div>
            <div class="space-y-3">
                <div x-data="{ open: false }" class="group">
                    <div class="bg-white/8 border border-white/15 rounded-2xl overflow-hidden transition-all duration-300 hover:bg-white/12 hover:border-white/25" :class="open ? 'bg-white/12 border-white/25' : ''">
                        <button @click="open = !open" class="w-full px-6 py-5 text-left flex items-center gap-4 focus:outline-none">
                            <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 transition-all duration-300" :class="open ? 'bg-emerald-500 text-white' : 'bg-white/15 text-white/70'"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg></div>
                            <span class="font-bold text-white text-base flex-1">Apakah Ibu harus mendownload aplikasi NutriGen?</span>
                            <div class="w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center shrink-0"><svg class="w-4 h-4 text-white/70 transition-transform duration-300" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg></div>
                        </button>
                        <div x-show="open" x-collapse><div class="px-6 pb-5 pl-[4.25rem] text-slate-400 font-medium leading-relaxed text-sm border-t border-white/10 pt-4">Tidak perlu. NutriGen menggunakan sistem <strong class="text-white font-bold">Magic Link</strong> yang dikirim melalui WhatsApp Bot. Ibu cukup klik tautan untuk membuka Portal Ibu di browser HP &mdash; tanpa install apapun.</div></div>
                    </div>
                </div>
                <div x-data="{ open: false }" class="group">
                    <div class="bg-white/8 border border-white/15 rounded-2xl overflow-hidden transition-all duration-300 hover:bg-white/12 hover:border-white/25" :class="open ? 'bg-white/12 border-white/25' : ''">
                        <button @click="open = !open" class="w-full px-6 py-5 text-left flex items-center gap-4 focus:outline-none">
                            <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 transition-all duration-300" :class="open ? 'bg-emerald-500 text-white' : 'bg-white/15 text-white/70'"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg></div>
                            <span class="font-bold text-white text-base flex-1">Bagaimana cara mendaftar?</span>
                            <div class="w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center shrink-0"><svg class="w-4 h-4 text-white/70 transition-transform duration-300" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg></div>
                        </button>
                        <div x-show="open" x-collapse><div class="px-6 pb-5 pl-[4.25rem] text-slate-400 font-medium leading-relaxed text-sm border-t border-white/10 pt-4">Registrasi publik ditutup untuk menjaga integritas data medis. Akun Ibu didaftarkan oleh <strong class="text-white font-bold">Kader Posyandu</strong> saat kunjungan pertama, sedangkan akun Kader dan Puskesmas dikelola oleh Administrator Dinas Kesehatan.</div></div>
                    </div>
                </div>
                <div x-data="{ open: false }" class="group">
                    <div class="bg-white/8 border border-white/15 rounded-2xl overflow-hidden transition-all duration-300 hover:bg-white/12 hover:border-white/25" :class="open ? 'bg-white/12 border-white/25' : ''">
                        <button @click="open = !open" class="w-full px-6 py-5 text-left flex items-center gap-4 focus:outline-none">
                            <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 transition-all duration-300" :class="open ? 'bg-emerald-500 text-white' : 'bg-white/15 text-white/70'"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg></div>
                            <span class="font-bold text-white text-base flex-1">Apakah standar pengukuran sudah sesuai WHO?</span>
                            <div class="w-8 h-8 rounded-xl bg-white/10 flex items-center justify-center shrink-0"><svg class="w-4 h-4 text-white/70 transition-transform duration-300" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg></div>
                        </button>
                        <div x-show="open" x-collapse><div class="px-6 pb-5 pl-[4.25rem] text-slate-400 font-medium leading-relaxed text-sm border-t border-white/10 pt-4">Ya, sistem <em>backend</em> kami mengimplementasikan standar <strong class="text-white font-bold">Z-Score WHO 2006</strong> untuk menghitung persentil pertumbuhan tinggi dan berat badan balita secara instan dan akurat.</div></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 10. ABOUT --}}
    <section class="relative overflow-hidden bg-white">
        <div class="grid grid-cols-1 lg:grid-cols-2 min-h-[460px]">
            <div class="relative bg-emerald-600 flex flex-col justify-center px-10 lg:px-16 py-20 overflow-hidden">
                <div class="absolute inset-0 plus-texture opacity-10 pointer-events-none"></div>
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-amber-400/15 rounded-full blur-3xl pointer-events-none"></div>
                <div class="relative z-10">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-white/20 border border-white/30 rounded-full text-white text-xs font-bold uppercase tracking-widest mb-8"><span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span>Misi Utama NutriGen</div>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-[1.1] mb-6">Generasi<br><span class="text-emerald-200">Bebas Stunting.</span></h2>
                    <p class="text-white/80 font-medium leading-relaxed text-base max-w-md">NutriGen dibangun dengan satu keyakinan: data yang akurat dan intervensi yang cepat dapat menyelamatkan masa depan seorang anak.</p>
                </div>
            </div>
            <div class="bg-slate-50 flex flex-col justify-center px-10 lg:px-16 py-20 relative overflow-hidden">
                <div class="absolute inset-0 plus-texture opacity-30 pointer-events-none"></div>
                <div class="relative z-10">
                    <p class="text-slate-600 font-medium leading-relaxed text-base mb-10">Kami menggabungkan teknologi modern dengan infrastruktur kesehatan masyarakat yang ada, <strong class="text-emerald-700 font-bold">memberdayakan Kader</strong>, memudahkan Puskesmas, dan mengedukasi Ibu secara simultan.</p>
                    <div class="grid grid-cols-3 gap-3">
                        <div class="bg-white rounded-2xl p-4 sm:p-5 border border-emerald-100 shadow-sm text-center"><div class="text-xl sm:text-2xl font-extrabold text-emerald-600 mb-1">3</div><div class="text-[10px] sm:text-xs font-semibold text-slate-500 uppercase tracking-wide">Portal Pengguna</div></div>
                        <div class="bg-white rounded-2xl p-4 sm:p-5 border border-amber-100 shadow-sm text-center"><div class="text-xl sm:text-2xl font-extrabold text-amber-600 mb-1">WHO</div><div class="text-[10px] sm:text-xs font-semibold text-slate-500 uppercase tracking-wide">Standar 2006</div></div>
                        <div class="bg-white rounded-2xl p-4 sm:p-5 border border-rose-100 shadow-sm text-center"><div class="text-xl sm:text-2xl font-extrabold text-rose-500 mb-1">100%</div><div class="text-[10px] sm:text-xs font-semibold text-slate-500 uppercase tracking-wide">Paperless</div></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FINAL CTA --}}
    <section class="relative py-24 sm:py-32 dark-mesh overflow-hidden border-t border-slate-900">
        <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center relative z-10 section-reveal" style="opacity:0;transform:translateY(24px)">
            <h2 class="text-4xl lg:text-5xl font-extrabold text-white tracking-tight mb-6">Siap Merubah Masa Depan?</h2>
            <p class="text-xl text-slate-400 font-medium mb-12 max-w-2xl mx-auto">Bergabunglah dalam revolusi digital penanggulangan stunting di Indonesia.</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="w-full sm:w-auto px-8 py-4 bg-emerald-500 hover:bg-emerald-400 text-white font-bold rounded-2xl shadow-lg shadow-emerald-500/20 transition-all hover:-translate-y-1">Buka Dashboard Saya</a>
                @else
                    <a href="{{ route('login') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 bg-emerald-500 hover:bg-emerald-400 text-white font-bold rounded-2xl shadow-[0_8px_24px_rgba(5,150,105,0.3)] hover:shadow-[0_12px_32px_rgba(5,150,105,0.4)] transition-all hover:-translate-y-1 group">
                        <span>Masuk ke Sistem</span>
                        <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                @endauth
            </div>
        </div>
    </section>

    {{-- TEAM --}}
    <section class="py-24 lg:py-32 bg-slate-50 relative overflow-hidden border-t border-slate-200">
        <div class="absolute inset-0 plus-texture opacity-30 pointer-events-none"></div>
        <div class="max-w-3xl mx-auto px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-emerald-50 border border-emerald-200 rounded-full text-emerald-700 text-xs font-bold uppercase tracking-widest mb-8">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Tim Pengembang
            </div>
            <div class="relative bg-white p-10 lg:p-14 rounded-[2.5rem] border border-slate-200 shadow-[0_15px_50px_rgba(0,0,0,0.04)] w-full overflow-hidden group">
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[300px] h-1 bg-gradient-to-r from-transparent via-emerald-400 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                <h2 class="text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight mb-5">Built by <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-emerald-400">Student Innovators</span></h2>
                <p class="text-lg text-slate-500 font-medium leading-relaxed max-w-2xl mx-auto mb-4">NutriGen dikembangkan oleh mahasiswa lintas universitas yang berkolaborasi dalam Hackathon Digdaya 2026.</p>
                <div class="flex flex-wrap items-center justify-center gap-3 mb-10">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-full text-xs font-semibold text-slate-600"><div class="w-2 h-2 rounded-full bg-emerald-500"></div>Universitas Syiah Kuala</div>
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-full text-xs font-semibold text-slate-600"><div class="w-2 h-2 rounded-full bg-amber-500"></div>UIN Ar-Raniry Banda Aceh</div>
                </div>
                <div class="flex items-center justify-center -space-x-4 mb-10">
                    <div class="w-14 h-14 rounded-full border-4 border-white overflow-hidden z-40 relative shadow-md hover:-translate-y-2 hover:scale-110 transition-all duration-300 cursor-pointer"><img src="{{ asset('images/team/member-1.png') }}" alt="Team Member 1" class="w-full h-full object-cover"></div>
                    <div class="w-14 h-14 rounded-full border-4 border-white overflow-hidden z-30 relative shadow-md hover:-translate-y-2 hover:scale-110 transition-all duration-300 cursor-pointer"><img src="{{ asset('images/team/member-2.jpeg') }}" alt="Team Member 2" class="w-full h-full object-cover"></div>
                    <div class="w-14 h-14 rounded-full border-4 border-white overflow-hidden z-20 relative shadow-md hover:-translate-y-2 hover:scale-110 transition-all duration-300 cursor-pointer"><img src="{{ asset('images/team/member-3.jpeg') }}" alt="Team Member 3" class="w-full h-full object-cover"></div>
                    <div class="w-14 h-14 rounded-full border-4 border-white overflow-hidden z-10 relative shadow-md hover:-translate-y-2 hover:scale-110 transition-all duration-300 cursor-pointer"><img src="{{ asset('images/team/member-4.jpeg') }}" alt="Team Member 4" class="w-full h-full object-cover"></div>
                </div>
                <a href="{{ route('team') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-slate-900 text-white font-bold rounded-full shadow-[0_4px_15px_rgba(15,23,42,0.2)] hover:shadow-[0_8px_25px_rgba(5,150,105,0.3)] hover:bg-emerald-600 transition-all duration-500 hover:-translate-y-1 active:scale-95 group/btn">
                    <span>Kenali Tim Kami Lebih Dekat</span>
                    <svg class="w-5 h-5 group-hover/btn:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <x-public-footer description="Platform manajemen stunting end-to-end yang mengintegrasikan data dari Posyandu ke Puskesmas secara real-time. Membangun generasi emas Indonesia.">
        <x-slot name="badges">
            <div class="inline-flex items-center gap-2.5 px-4 py-2 bg-slate-900/80 backdrop-blur-md rounded-2xl border border-slate-800 text-sm font-semibold text-slate-300 hover:border-slate-700 transition-colors">
                <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" x2="4" y1="22" y2="15"/></svg>
                <span>Built in Indonesia</span>
            </div>
            <div class="inline-flex items-center gap-2.5 px-4 py-2 bg-slate-900/80 backdrop-blur-md rounded-2xl border border-slate-800 text-sm font-semibold text-slate-300 hover:border-slate-700 transition-colors">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse shadow-[0_0_10px_rgba(16,185,129,0.8)]"></span>
                <span>Digdaya 2026</span>
            </div>
            <div class="inline-flex items-center gap-2.5 px-4 py-2 bg-emerald-950/30 backdrop-blur-md rounded-2xl border border-emerald-900/50 text-sm font-semibold text-emerald-400 hover:border-emerald-800/50 transition-colors">
                <svg class="w-4 h-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                <span>v1.0 MVP</span>
            </div>
        </x-slot>
        <x-slot name="platformLinks">
            <li><a href="#how-it-works" class="text-base font-medium text-slate-400 hover:text-emerald-400 transition-all duration-300 flex items-center gap-3 group hover:translate-x-2"><span class="w-1.5 h-1.5 rounded-full bg-slate-700 group-hover:bg-emerald-400 transition-colors duration-300"></span> Cara Kerja</a></li>
            <li><a href="#features" class="text-base font-medium text-slate-400 hover:text-emerald-400 transition-all duration-300 flex items-center gap-3 group hover:translate-x-2"><span class="w-1.5 h-1.5 rounded-full bg-slate-700 group-hover:bg-emerald-400 transition-colors duration-300"></span> Ekosistem NutriGen</a></li>
            <li><a href="{{ route('team') }}" class="text-base font-medium text-emerald-500 hover:text-emerald-400 transition-all duration-300 flex items-center gap-3 group hover:translate-x-2"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500 group-hover:bg-emerald-400 transition-colors duration-300"></span> Meet Our Team</a></li>
            <li><a href="{{ route('login') }}" class="text-base font-medium text-slate-400 hover:text-emerald-400 transition-all duration-300 flex items-center gap-3 group hover:translate-x-2"><span class="w-1.5 h-1.5 rounded-full bg-slate-700 group-hover:bg-emerald-400 transition-colors duration-300"></span> Portal Petugas</a></li>
        </x-slot>
        <x-slot name="contactLinks">
            <li>
                <a href="mailto:teamnutrigen@gmail.com" class="text-base font-medium text-slate-400 hover:text-emerald-400 transition-all duration-300 flex items-center gap-4 group hover:translate-x-2">
                    <div class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center group-hover:border-emerald-500/50 group-hover:bg-emerald-950/30 transition-all duration-300"><svg class="w-4 h-4 text-slate-500 group-hover:text-emerald-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></div>
                    teamnutrigen@gmail.com
                </a>
            </li>
            <li>
                <a href="#" class="text-base font-medium text-slate-400 hover:text-emerald-400 transition-all duration-300 flex items-center gap-4 group hover:translate-x-2">
                    <div class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center group-hover:border-emerald-500/50 group-hover:bg-emerald-950/30 transition-all duration-300"><svg class="w-4 h-4 text-slate-500 group-hover:text-emerald-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
                    Banda Aceh, Indonesia
                </a>
            </li>
        </x-slot>
        <x-slot name="copyright">
            <span class="text-slate-300 font-bold tracking-wide">NutriGen MVP</span> &bull; Hackathon Digdaya 2026 &bull; Version 1.0 &bull; <span class="text-emerald-400">2026</span>
        </x-slot>
    </x-public-footer>

    {{-- ANIMATION SCRIPTS --}}
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (prefersReduced) {
            document.querySelectorAll('[style*="opacity:0"]').forEach(el => { el.style.opacity = '1'; el.style.transform = 'none'; });
            document.querySelectorAll('.chart-line').forEach(el => el.classList.add('drawn'));
            return;
        }
        const { animate, inView, stagger } = window.Motion || {};
        if (!animate || !inView || !stagger) {
            document.querySelectorAll('[style*="opacity:0"]').forEach(el => { el.style.opacity = '1'; el.style.transform = 'none'; });
            document.querySelectorAll('.chart-line').forEach(el => el.classList.add('drawn'));
            return;
        }
        const ease = [0.16, 1, 0.3, 1];
        const heroLeft = document.getElementById('hero-left');
        const heroDash = document.getElementById('hero-dashboard-card');
        const heroStatRow = document.getElementById('hero-stat-row');
        if (heroLeft)    animate(heroLeft,    { opacity: [0,1], y: [28,0] }, { duration: 0.55, delay: 0,    easing: ease });
        if (heroDash)    animate(heroDash,    { opacity: [0,1], x: [24,0] }, { duration: 0.6,  delay: 0.18, easing: ease });
        if (heroStatRow) animate(heroStatRow, { opacity: [0,1], y: [16,0] }, { duration: 0.5,  delay: 0.32, easing: ease });
        setTimeout(() => { const p = document.getElementById('chart-path'); if (p) p.classList.add('drawn'); }, 800);
        const problemText = document.getElementById('problem-text');
        if (problemText) {
            inView(problemText, () => {
                animate(problemText, { opacity: [0,1], y: [28,0] }, { duration: 0.5, easing: ease });
                animate(document.querySelectorAll('.problem-item'), { opacity: [0,1], y: [20,0] }, { duration: 0.45, delay: stagger(0.12, { start: 0.2 }), easing: ease });
            }, { amount: 0.2 });
        }
        const statCard = document.getElementById('stat-card');
        const statCounter = document.getElementById('stat-counter');
        const statBar = document.getElementById('stat-progress-bar');
        if (statCard && statCounter) {
            let counted = false;
            inView(statCard, () => {
                animate(statCard, { opacity: [0,1], y: [32,0] }, { duration: 0.55, easing: ease });
                if (counted) return;
                counted = true;
                const target = 21.6, dur = 1500, t0 = performance.now();
                const easeOut = t => 1 - Math.pow(1-t, 4);
                function tick(now) {
                    const p = Math.min((now - t0) / dur, 1);
                    statCounter.textContent = (target * easeOut(p)).toFixed(1);
                    if (p < 1) requestAnimationFrame(tick);
                    else statCounter.textContent = '21.6';
                }
                setTimeout(() => {
                    requestAnimationFrame(tick);
                    if (statBar) { statBar.style.transition = 'width 1.5s cubic-bezier(0.16,1,0.3,1)'; statBar.style.width = '72%'; }
                }, 300);
            }, { amount: 0.3 });
        }
        document.querySelectorAll('.section-reveal').forEach(el => {
            inView(el, () => { animate(el, { opacity: [0,1], y: [24,0] }, { duration: 0.5, easing: ease }); }, { amount: 0.15 });
        });
    });
    </script>

@endsection
