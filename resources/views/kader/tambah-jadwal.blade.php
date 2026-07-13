@extends('layouts.app')

@section('page-title', 'Tambah Jadwal')

@section('content')
<div class="flex flex-col bg-slate-50 min-h-screen pb-20">
    <!-- Header Premium -->
    <div class="bg-white px-5 pt-6 pb-5 shadow-sm border-b border-slate-100 sticky top-0 z-30 relative overflow-hidden">
        <!-- Watermark -->
        <div class="absolute -top-10 -right-5 text-slate-800 opacity-[0.015] transform rotate-12 pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-56 h-56">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
            </svg>
        </div>
        
        <div class="max-w-5xl mx-auto w-full flex items-start gap-3 relative z-10">
            <a href="{{ route('jadwal.index') }}" class="flex flex-shrink-0 items-center justify-center w-11 h-11 -ml-2 mt-1 text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-full transition-all focus:outline-none focus:ring-2 focus:ring-slate-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </a>
            <div class="flex flex-col">
                <span class="inline-flex items-center px-1.5 py-0.5 bg-teal-50 text-teal-700 text-[10px] font-extrabold uppercase tracking-widest rounded border border-teal-200/60 w-max mb-1">
                    Operasional Posyandu
                </span>
                <h1 class="text-xl font-black text-slate-800 tracking-tight leading-none mb-1">Tambah Jadwal Baru</h1>
                <p class="text-[11px] font-medium text-slate-500">Jadwalkan agenda layanan kesehatan Posyandu.</p>
            </div>
        </div>
    </div>

    <!-- Main Content Container -->
    <div class="max-w-5xl mx-auto w-full px-5 mt-5">
        
        <!-- Mobile Information Banner -->
        <div class="lg:hidden bg-gradient-to-r from-teal-50/80 to-white border border-teal-100 rounded-xl p-3 mb-5 flex items-center gap-3 shadow-sm">
            <div class="p-1.5 bg-white border border-teal-100 text-teal-600 rounded-lg shrink-0 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                </svg>
            </div>
            <span class="text-[11px] font-medium text-slate-600 leading-snug">
                <strong class="text-teal-700 font-extrabold">Tips:</strong> Pastikan jadwal tidak berbenturan dengan agenda lain.
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            
            <!-- Left: Form Area (2 columns on desktop) -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 relative overflow-hidden">
                    {{--
                        Backend: This form POSTs to JadwalController@store.
                        Form field names:
                          posyandu_id  (int)    — FK to posyandu table
                          lokasi       (string) — venue address detail
                          tanggal      (date)   — date in Y-m-d format
                          waktu_mulai  (time)   — start time
                          waktu_selesai(time)   — end time
                          catatan      (text)   — nullable notes

                        Backend variables expected by the info panel (right column):
                          $nearestPosyandu (string) — nearest posyandu name
                          $nearestTime     (string) — next scheduled time
                    --}}
                    <form action="{{ route('jadwal.store') }}" method="POST" class="flex flex-col">
                        @csrf
                        
                        <!-- SECTION 1: Informasi Penyelenggara -->
                        <div class="mb-5">
                            <h3 class="text-[10px] font-extrabold text-slate-800 uppercase tracking-widest mb-4 flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-teal-500 shadow-sm shadow-teal-500/50"></div> 
                                Informasi Lokasi
                            </h3>
                            <div class="space-y-4">
                                <!-- Posyandu -->
                                <div class="flex flex-col gap-1.5">
                                    <label for="posyandu_id" class="flex items-center gap-1.5 text-xs font-bold text-slate-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5 text-slate-400">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                                        </svg>
                                        Pilih Posyandu
                                    </label>
                                    <div class="relative">
                                        <select id="posyandu_id" name="posyandu_id" class="w-full bg-slate-50 border border-slate-200 hover:border-teal-300 text-slate-800 text-sm font-semibold rounded-2xl px-4 py-3.5 appearance-none focus:outline-none focus:ring-4 focus:ring-teal-500/10 focus:border-teal-400 transition-all cursor-pointer shadow-sm">
                                            <option value="" disabled selected>Pilih nama Posyandu penyelenggara</option>
                                            <option value="1">Posyandu Melati 1</option>
                                            <option value="2">Posyandu Mawar 2</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Lokasi -->
                                <div class="flex flex-col gap-1.5">
                                    <label for="lokasi" class="flex items-center gap-1.5 text-xs font-bold text-slate-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5 text-slate-400">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>
                                        Tempat Kegiatan
                                    </label>
                                    <input type="text" id="lokasi" name="lokasi" placeholder="Masukkan lokasi atau alamat spesifik" class="w-full bg-slate-50 border border-slate-200 hover:border-teal-300 text-slate-800 text-sm font-semibold rounded-2xl px-4 py-3.5 focus:outline-none focus:ring-4 focus:ring-teal-500/10 focus:border-teal-400 transition-all placeholder:text-slate-400 placeholder:font-medium shadow-sm">
                                </div>
                            </div>
                        </div>

                        <!-- Divider elegan (60-70% lebar) -->
                        <div class="border-t border-slate-100/80 mb-5 w-2/3"></div>

                        <!-- SECTION 2: Waktu Pelaksanaan -->
                        <div class="mb-5">
                            <h3 class="text-[10px] font-extrabold text-slate-800 uppercase tracking-widest mb-4 flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-blue-500 shadow-sm shadow-blue-500/50"></div> 
                                Waktu Pelaksanaan
                            </h3>
                            <div class="space-y-4">
                                <!-- Tanggal -->
                                <div class="flex flex-col gap-1.5">
                                    <label for="tanggal" class="flex items-center gap-1.5 text-xs font-bold text-slate-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5 text-slate-400">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                        </svg>
                                        Tanggal
                                    </label>
                                    <input type="date" id="tanggal" name="tanggal" class="w-full bg-slate-50 border border-slate-200 hover:border-teal-300 text-slate-800 text-sm font-semibold rounded-2xl px-4 py-3.5 focus:outline-none focus:ring-4 focus:ring-teal-500/10 focus:border-teal-400 transition-all placeholder:text-slate-400 shadow-sm">
                                </div>

                                <!-- Waktu Mulai & Selesai Terhubung -->
                                <div>
                                    <label class="flex items-center gap-1.5 text-xs font-bold text-slate-700 mb-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5 text-slate-400">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Rentang Waktu
                                    </label>
                                    <div class="flex items-center gap-2">
                                        <input type="time" id="waktu_mulai" name="waktu_mulai" class="flex-1 bg-slate-50 border border-slate-200 hover:border-teal-300 text-slate-800 text-sm font-semibold rounded-2xl px-3 py-3.5 focus:outline-none focus:ring-4 focus:ring-teal-500/10 focus:border-teal-400 transition-all shadow-sm">
                                        
                                        <span class="text-slate-300 font-black shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                            </svg>
                                        </span>
                                        
                                        <input type="time" id="waktu_selesai" name="waktu_selesai" class="flex-1 bg-slate-50 border border-slate-200 hover:border-teal-300 text-slate-800 text-sm font-semibold rounded-2xl px-3 py-3.5 focus:outline-none focus:ring-4 focus:ring-teal-500/10 focus:border-teal-400 transition-all shadow-sm">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Divider elegan -->
                        <div class="border-t border-slate-100/80 mb-5 w-2/3"></div>

                        <!-- SECTION 3: Catatan Khusus -->
                        <div class="mb-6">
                            <h3 class="text-[10px] font-extrabold text-slate-800 uppercase tracking-widest mb-4 flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-amber-500 shadow-sm shadow-amber-500/50"></div> 
                                Keterangan Tambahan
                            </h3>
                            <div class="flex flex-col gap-1.5">
                                <label for="catatan" class="flex items-center gap-1.5 text-xs font-bold text-slate-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5 text-slate-400">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v-3.375c0-.621-.504-1.125-1.125-1.125h-2.25c-.621 0-1.125.504-1.125 1.125v3.375c0 .621.504 1.125 1.125 1.125h2.25c.621 0 1.125-.504 1.125-1.125zM10.5 2.25h-5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-1.5a.75.75 0 00-.75-.75h-1.5a.75.75 0 00-.75.75v1.5z" />
                                    </svg>
                                    Catatan Penjadwalan
                                </label>
                                <textarea id="catatan" name="catatan" rows="3" placeholder="Tambahkan catatan khusus bila ada..." class="w-full bg-slate-50 border border-slate-200 hover:border-teal-300 text-slate-800 text-sm font-semibold rounded-2xl px-4 py-3.5 focus:outline-none focus:ring-4 focus:ring-teal-500/10 focus:border-teal-400 transition-all placeholder:text-slate-400 placeholder:font-medium resize-none shadow-sm"></textarea>
                            </div>
                        </div>
                        
                        <!-- CTA Isolated Area -->
                        <div class="mt-4 pt-6 pb-6 px-6 bg-slate-50/50 -mx-6 -mb-6 border-t border-slate-100 flex justify-center rounded-b-3xl">
                            <button type="submit" class="w-full sm:max-w-xs bg-teal-600 text-white px-5 py-3.5 rounded-full font-bold shadow-lg shadow-teal-500/20 hover:bg-teal-700 hover:shadow-xl hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-teal-500/20 transition-all duration-200 flex items-center justify-center gap-2 group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 transition-transform group-hover:scale-110">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Simpan Jadwal
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right: Decorative Info Panel (Desktop Only) -->
            <div class="hidden lg:block lg:col-span-1">
                <div class="bg-gradient-to-br from-white to-slate-50/50 rounded-3xl p-5 border border-slate-200 shadow-sm sticky top-28 mb-5">
                    
                    <!-- Agenda Terdekat -->
                    <div class="mb-6">
                        <h3 class="text-[10px] font-extrabold text-slate-500 uppercase tracking-widest mb-3 px-1">Agenda Berikutnya</h3>
                        
                        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-200 relative overflow-hidden group hover:border-blue-300 hover:shadow-md transition-all duration-200 flex items-center gap-4">
                            <!-- Status Badge -->
                            <div class="absolute top-0 right-0 bg-blue-50 text-blue-600 text-[10px] font-extrabold uppercase tracking-widest px-2.5 py-1 rounded-bl-lg border-b border-l border-blue-100">
                                Mendatang
                            </div>
                            
                            <!-- Date Block -->
                            <div class="flex flex-col items-center justify-center bg-blue-50 text-blue-700 rounded-xl p-2 min-w-[3.25rem] border border-blue-100/50 shrink-0">
                                <span class="text-lg font-black leading-none">15</span>
                                <span class="text-[10px] font-extrabold uppercase mt-0.5">Ags</span>
                            </div>
                            
                            <!-- Info -->
                            <div class="flex flex-col pr-2">
                                <h4 class="font-bold text-slate-800 text-sm mb-1 group-hover:text-blue-700 transition-colors truncate">{{ $nearestPosyandu ?? 'Posyandu Melati 1' }}</h4>
                                <span class="flex items-center gap-1.5 text-xs text-slate-500 font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5 text-slate-400 shrink-0">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $nearestTime ?? '08.00 - 11.00 WIB' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Checklist Tips -->
                    <div class="border-t border-slate-100/80 pt-5 px-1">
                        <h3 class="text-[10px] font-extrabold text-teal-600 uppercase tracking-widest mb-3">Checklist Penjadwalan</h3>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-2">
                                <div class="shrink-0 text-teal-600 mt-0.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3.5 h-3.5">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-slate-600 pt-0.5 leading-snug">Hindari tanggal merah/libur.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <div class="shrink-0 text-teal-600 mt-0.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3.5 h-3.5">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-slate-600 pt-0.5 leading-snug">Cek tenaga medis tersedia.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <div class="shrink-0 text-teal-600 mt-0.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3.5 h-3.5">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-slate-600 pt-0.5 leading-snug">Durasi cukup untuk registrasi.</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
