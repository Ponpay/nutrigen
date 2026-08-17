@extends('layouts.app')

@section('page-title', 'Pusat Laporan Posyandu')

@section('content')
<div class="flex flex-col w-full bg-slate-50/80 min-h-screen relative mx-auto pb-28 lg:pb-16 font-sans">
    
    <!-- 1. Executive Top Header -->
    <div class="bg-white border-b border-slate-200 sticky top-0 z-30 shadow-2xs">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5 sm:py-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-4">
                
                <!-- Title & Back Navigation -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('dashboard') }}" class="w-9 h-9 flex items-center justify-center bg-slate-50 hover:bg-slate-100 text-slate-700 rounded-xl border border-slate-200 transition-colors shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                    </a>
                    <div>
                        <div class="flex items-center gap-2">
                            <h1 class="text-lg sm:text-xl font-extrabold text-slate-900 tracking-tight">Pusat Laporan Posyandu</h1>
                            <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-800 text-[10.5px] font-extrabold px-2.5 py-0.5 rounded-full border border-emerald-200">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                Terintegrasi
                            </span>
                        </div>
                        <p class="text-xs text-slate-600 font-medium mt-0.5">Rekapitulasi data penimbangan bulanan siap kirim ke Puskesmas</p>
                    </div>
                </div>

                <!-- Filter Controls Toolbar -->
                <form id="form-laporan-filter" action="{{ route('laporan.index') }}" method="GET" class="flex items-center gap-2 w-full sm:w-auto">
                    <!-- Location Pill -->
                    <div class="flex items-center gap-1.5 px-3 py-2 bg-teal-50 rounded-xl border border-teal-200 text-teal-950 text-xs font-bold shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5 text-teal-700">
                            <path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 103 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 002.273 1.765 11.842 11.842 0 00.976.544l.062.029.018.008.006.003zM10 11.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z" clip-rule="evenodd" />
                        </svg>
                        <span class="truncate max-w-[130px] sm:max-w-none">{{ $posyanduAktif ?? 'Posyandu' }}</span>
                    </div>

                    <!-- Month Picker Input -->
                    <div class="relative flex-1 sm:w-44">
                        <input type="month" id="periode" name="periode" value="{{ $periodeValue }}" onchange="this.form.submit()" class="w-full bg-white hover:bg-slate-50 text-slate-900 text-xs font-bold rounded-xl px-3 py-2 border border-slate-300 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-600 cursor-pointer shadow-2xs transition-all">
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- 2. Main Workspace Canvas -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-5 sm:mt-6 w-full flex flex-col gap-6">

        @if(isset($dataKosong) && $dataKosong)
            <!-- Clean, Startup-Grade Minimalist Empty State -->
            <div class="bg-white rounded-3xl p-8 sm:p-14 border border-slate-200/90 shadow-2xs flex flex-col items-center justify-center text-center max-w-2xl mx-auto w-full my-4">
                
                <!-- Icon with Ambient Ring -->
                <div class="w-14 h-14 rounded-2xl bg-teal-50 border border-teal-100/90 flex items-center justify-center text-teal-600 mb-5 shadow-2xs">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                </div>

                <!-- Period Pill -->
                <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-teal-50 text-teal-800 rounded-full border border-teal-200/80 text-[11px] font-bold uppercase tracking-wider mb-3">
                    <span>Periode {{ $periode }}</span>
                    <span class="text-teal-400">&bull;</span>
                    <span>{{ $posyanduAktif }}</span>
                </div>

                <!-- Heading & Description -->
                <h2 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight">
                    Belum Ada Data Penimbangan
                </h2>
                <p class="text-xs sm:text-[13px] text-slate-500 font-medium max-w-md mt-2 mb-7 leading-relaxed">
                    Tidak ada riwayat pengukuran balita yang tercatat pada periode ini. Mulai input penimbangan balita untuk mengaktifkan export laporan resmi (PDF & Excel).
                </p>

                <!-- Clean Dual Actions -->
                <div class="flex flex-wrap items-center justify-center gap-3 w-full sm:w-auto">
                    <a href="{{ route('balita.index') }}" class="w-full sm:w-auto h-11 px-6 bg-teal-600 hover:bg-teal-700 active:bg-teal-800 text-white rounded-xl font-bold text-xs shadow-xs hover:shadow transition-all flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        <span>Input Pengukuran Balita</span>
                    </a>

                    <a href="{{ route('jadwal.index') }}" class="w-full sm:w-auto h-11 px-5 bg-slate-50 hover:bg-slate-100 text-slate-700 rounded-xl font-bold text-xs border border-slate-200 transition-all flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-4 h-4 text-teal-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                        <span>Lihat Jadwal Posyandu</span>
                    </a>
                </div>

            </div>
        @else

            <!-- Section A: Elegant Soft-Teal Overview Card (Balanced & Gentle on the Eyes) -->
            <div class="bg-gradient-to-br from-teal-50/90 via-emerald-50/60 to-slate-50 rounded-3xl p-5 sm:p-7 shadow-xs border border-teal-200/80 relative overflow-hidden">
                <!-- Ambient Subtle Glow -->
                <div class="absolute -right-16 -top-16 w-56 h-56 bg-teal-300/15 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                    
                    <!-- Left: Coverage & Headline -->
                    <div class="flex-1 max-w-xl">
                        <div class="flex items-center gap-2 mb-1.5">
                            <span class="text-[10.5px] font-bold text-teal-800 bg-teal-100/90 border border-teal-200 px-2.5 py-0.5 rounded-lg uppercase tracking-wider">
                                Periode {{ $periode }}
                            </span>
                            <span class="text-slate-500 text-xs font-medium truncate">&bull; {{ $posyanduAktif }}</span>
                        </div>
                        <h2 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight leading-tight">
                            Rekapitulasi Penimbangan Balita
                        </h2>
                        <p class="text-xs sm:text-[13px] text-slate-600 font-medium mt-1">
                            Sebanyak <strong>{{ $sudahDiukur ?? 0 }}</strong> dari total <strong>{{ $totalBalita ?? 0 }}</strong> balita terdaftar telah selesai diukur.
                        </p>

                        <!-- Sleek Progress Bar -->
                        <div class="mt-4 flex items-center gap-3">
                            <div class="flex-1 h-3 bg-slate-200/90 rounded-full overflow-hidden border border-slate-300/60 p-0.5">
                                <div class="h-full bg-teal-600 rounded-full transition-all duration-700" style="width: {{ $persentase ?? 0 }}%"></div>
                            </div>
                            <span class="text-sm font-extrabold text-teal-900 shrink-0">{{ $persentase ?? 0 }}%</span>
                        </div>
                    </div>

                    <!-- Right: 4 Clean White Floating Metric Tiles -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 sm:gap-3 lg:w-[480px] shrink-0">
                        <!-- Terukur -->
                        <div class="bg-white/95 rounded-2xl p-3 sm:p-3.5 border border-teal-200/80 shadow-2xs flex flex-col">
                            <span class="text-xs font-bold text-teal-900 flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-teal-600"></span> Terukur
                            </span>
                            <span class="text-2xl font-black text-slate-900 mt-1">{{ $sudahDiukur ?? 0 }}</span>
                        </div>

                        <!-- Belum Diukur -->
                        <div class="bg-white/95 rounded-2xl p-3 sm:p-3.5 border border-slate-200 shadow-2xs flex flex-col">
                            <span class="text-xs font-bold text-slate-600 flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-slate-400"></span> Belum
                            </span>
                            <span class="text-2xl font-black text-slate-800 mt-1">{{ $belumDiukur ?? 0 }}</span>
                        </div>

                        <!-- Pantauan Gizi -->
                        <div class="bg-white/95 rounded-2xl p-3 sm:p-3.5 border border-amber-200 shadow-2xs flex flex-col">
                            <span class="text-xs font-bold text-amber-800 flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-amber-500"></span> Pantauan
                            </span>
                            <span class="text-2xl font-black text-amber-950 mt-1">{{ $perluPerhatian ?? 0 }}</span>
                        </div>

                        <!-- Konfirmasi TB -->
                        <div class="bg-white/95 rounded-2xl p-3 sm:p-3.5 border border-rose-200 shadow-2xs flex flex-col">
                            <span class="text-xs font-bold text-rose-800 flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-rose-500"></span> Konfirmasi
                            </span>
                            <span class="text-2xl font-black text-rose-950 mt-1">{{ $berisiko ?? 0 }}</span>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Section B: Dual Action Export Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">

                <!-- 1. PDF Official Export Card -->
                <div class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-6 border border-slate-200/90 shadow-2xs hover:border-teal-300 transition-all flex flex-col justify-between group">
                    <div>
                        <div class="flex items-start justify-between gap-3 mb-4">
                            <div class="w-11 h-11 rounded-xl bg-rose-50 border border-rose-100 flex items-center justify-center text-rose-600 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                            </div>
                            <span class="text-[10.5px] font-bold text-rose-700 bg-rose-50 border border-rose-200/70 px-2.5 py-1 rounded-full uppercase tracking-wider">
                                Format Kedinasan
                            </span>
                        </div>

                        <h3 class="text-base font-bold text-slate-900 tracking-tight">Laporan Resmi Posyandu (PDF)</h3>
                        <p class="text-xs text-slate-500 font-medium mt-1.5 leading-relaxed">
                            Dokumen resmi format A4 Landscape dengan Kop Surat Dinas Kesehatan / Puskesmas, rekapitulasi data KMS, dan kolom tanda tangan ganda Kader & Tenaga Gizi.
                        </p>

                        <!-- Feature Chips -->
                        <div class="flex flex-wrap gap-2 my-4">
                            <span class="text-[11.5px] font-medium text-slate-600 bg-slate-50 border border-slate-200/80 px-2.5 py-1 rounded-lg">Kop Surat Resmi</span>
                            <span class="text-[11.5px] font-medium text-slate-600 bg-slate-50 border border-slate-200/80 px-2.5 py-1 rounded-lg">Tanda Tangan Ganda</span>
                            <span class="text-[11.5px] font-medium text-slate-600 bg-slate-50 border border-slate-200/80 px-2.5 py-1 rounded-lg">A4 Landscape</span>
                        </div>
                    </div>

                    <form action="{{ route('laporan.generate') }}" method="POST" class="w-full mt-2">
                        @csrf
                        <input type="hidden" name="posyandu_id" value="{{ request('posyandu_id') }}">
                        <input type="hidden" name="periode" value="{{ $periodeValue }}">
                        <button type="submit" class="w-full h-11 bg-teal-600 hover:bg-teal-700 active:bg-teal-800 text-white rounded-xl font-bold text-xs shadow-xs hover:shadow transition-all flex items-center justify-center gap-2 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h10.5M6.75 17.25h10.5M4.5 10.5h15M6.75 3h10.5a2.25 2.25 0 012.25 2.25v13.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 18.75V5.25A2.25 2.25 0 016.75 3z" />
                            </svg>
                            <span>Cetak PDF Resmi</span>
                        </button>
                    </form>
                </div>

                <!-- 2. Excel Spreadsheet Export Card -->
                <div class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-6 border border-slate-200/90 shadow-2xs hover:border-emerald-300 transition-all flex flex-col justify-between group">
                    <div>
                        <div class="flex items-start justify-between gap-3 mb-4">
                            <div class="w-11 h-11 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0112 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m0 1.5v-1.5m0 1.5c0 .621.504 1.125 1.125 1.125M12 17.25h1.125m-1.125 0c-.621 0-1.125-.504-1.125-1.125" />
                                </svg>
                            </div>
                            <span class="text-[10.5px] font-bold text-emerald-700 bg-emerald-50 border border-emerald-200/80 px-2.5 py-1 rounded-full uppercase tracking-wider">
                                Excel (.xls)
                            </span>
                        </div>

                        <h3 class="text-base font-bold text-slate-900 tracking-tight">Data Tabel Pengukuran (Excel)</h3>
                        <p class="text-xs text-slate-500 font-medium mt-1.5 leading-relaxed">
                            Dataset 16 kolom komprehensif mencakup NIK, identitas orang tua, tanggal ukur, BB/TB/LK, status kenaikan KMS, dan catatan medis untuk Puskesmas.
                        </p>

                        <!-- Feature Chips -->
                        <div class="flex flex-wrap gap-2 my-4">
                            <span class="text-[11.5px] font-medium text-slate-600 bg-slate-50 border border-slate-200/80 px-2.5 py-1 rounded-lg">16 Kolom Lengkap</span>
                            <span class="text-[11.5px] font-medium text-slate-600 bg-slate-50 border border-slate-200/80 px-2.5 py-1 rounded-lg">Format Spreadsheet</span>
                            <span class="text-[11.5px] font-medium text-slate-600 bg-slate-50 border border-slate-200/80 px-2.5 py-1 rounded-lg">Arsip Digital</span>
                        </div>
                    </div>

                    <a href="{{ route('laporan.export.excel', ['periode' => $periodeValue]) }}" class="w-full h-11 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white rounded-xl font-bold text-xs shadow-xs hover:shadow transition-all flex items-center justify-center gap-2 mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        <span>Export ke Excel (.xls)</span>
                    </a>
                </div>

            </div>

            <!-- Section C: Live Data Preview Table (Clean, Modern & Elegant) -->
            @if(isset($previewBalitas) && $previewBalitas->isNotEmpty())
                <div class="bg-white rounded-2xl sm:rounded-3xl border border-slate-200/90 shadow-2xs overflow-hidden">
                    
                    <!-- Table Header Toolbar -->
                    <div class="p-4 sm:p-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-teal-50 border border-teal-100 flex items-center justify-center text-teal-700 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 011.875 1.875v11.25a1.875 1.875 0 01-1.875 1.875H5.625a1.875 1.875 0 01-1.875-1.875V6.375A1.875 1.875 0 015.625 4.5z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-slate-900">Pratinjau Data Penimbangan ({{ $periode }})</h3>
                                <p class="text-[11.5px] text-slate-500 font-medium">Cuplikan data balita terukur yang akan disertakan pada laporan</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold text-teal-800 bg-teal-50 border border-teal-200/80 px-3 py-1 rounded-full">
                                {{ $sudahDiukur ?? count($previewBalitas) }} Balita Terukur
                            </span>
                        </div>
                    </div>

                    <!-- Modern Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs text-slate-600">
                            <thead class="bg-slate-100/90 text-[11px] font-bold text-slate-800 uppercase tracking-wider border-b border-slate-200">
                                <tr>
                                    <th class="py-3 px-4 sm:px-5">Balita</th>
                                    <th class="py-3 px-4">Nama Ibu</th>
                                    <th class="py-3 px-4">Tgl Ukur</th>
                                    <th class="py-3 px-4 text-center">BB (kg)</th>
                                    <th class="py-3 px-4 text-center">TB (cm)</th>
                                    <th class="py-3 px-4 text-center">KMS</th>
                                    <th class="py-3 px-4 text-center">Status / Diagnosa</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 font-medium">
                                @foreach($previewBalitas as $b)
                                    @php
                                        $m = $b->pengukurans->first();
                                        $statusGizi = $m ? $m->status_gizi : '-';
                                        $statusValidasi = $m ? $m->status_validasi : null;
                                        $isApproved = $statusValidasi === 'approved';
                                        $isMale = ($b->jenis_kelamin ?? 'L') === 'L';
                                        $kms = $m ? ($m->status_kenaikan ?? '-') : '-';
                                    @endphp
                                    <tr class="hover:bg-teal-50/20 transition-colors">
                                        <!-- Balita Info -->
                                        <td class="py-3 px-4 sm:px-5">
                                            <div class="flex items-center gap-3">
                                                <div class="w-7 h-7 rounded-full flex items-center justify-center text-[10px] font-extrabold shrink-0 {{ $isMale ? 'bg-cyan-50 text-cyan-700 border border-cyan-200/70' : 'bg-rose-50 text-rose-700 border border-rose-200/70' }}">
                                                    {{ $isMale ? 'L' : 'P' }}
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="font-bold text-slate-900 text-xs">{{ $b->nama }}</span>
                                                    <span class="text-[10.5px] text-slate-400 font-mono">{{ $b->nik ?? '-' }}</span>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Ibu -->
                                        <td class="py-3 px-4 text-slate-700 text-xs font-medium">{{ $b->orangTua->nama_ibu ?? '-' }}</td>

                                        <!-- Tanggal Ukur -->
                                        <td class="py-3 px-4 text-slate-500 text-xs">
                                            {{ $m ? \Carbon\Carbon::parse($m->tanggal_ukur)->translatedFormat('d M Y') : '-' }}
                                        </td>

                                        <!-- BB -->
                                        <td class="py-3 px-4 text-center">
                                            <span class="font-bold text-slate-900 text-xs">{{ $m ? number_format((float)$m->berat_badan, 1) : '-' }}</span>
                                            <span class="text-[10px] text-slate-400 ml-0.5">kg</span>
                                        </td>

                                        <!-- TB -->
                                        <td class="py-3 px-4 text-center">
                                            <span class="font-bold text-slate-900 text-xs">{{ $m ? number_format((float)$m->tinggi_badan, 1) : '-' }}</span>
                                            <span class="text-[10px] text-slate-400 ml-0.5">cm</span>
                                        </td>

                                        <!-- KMS -->
                                        <td class="py-3 px-4 text-center">
                                            @if($kms === 'N' || str_contains($kms, 'Naik'))
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10.5px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/80">
                                                    Naik (N)
                                                </span>
                                            @elseif($kms === 'T' || str_contains($kms, 'Tetap'))
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10.5px] font-bold bg-amber-50 text-amber-700 border border-amber-200/80">
                                                    Tetap (T)
                                                </span>
                                            @else
                                                <span class="text-slate-400 text-xs font-semibold">{{ $kms }}</span>
                                            @endif
                                        </td>

                                        <!-- Status Diagnosa -->
                                        <td class="py-3 px-4 text-center">
                                            @if($isApproved)
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10.5px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                    {{ ucfirst($statusGizi) }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10.5px] font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                                    Menunggu Validasi
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Table Footer Link -->
                    <div class="p-3 sm:p-4 bg-slate-50/80 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-slate-500">
                        <span>Menampilkan 5 data balita teratas &bull; Berkas ekspor memuat seluruh {{ $sudahDiukur ?? count($previewBalitas) }} balita terukur</span>
                        <a href="{{ route('balita.index') }}" class="font-bold text-teal-700 hover:text-teal-800 flex items-center gap-1 transition-colors">
                            <span>Buka Daftar Semua Balita</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5">
                                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endif

        @endif

    </div>

</div>
@endsection
