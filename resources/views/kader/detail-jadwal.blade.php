@extends('layouts.app')

@section('page-title', 'Detail Jadwal')

@section('content')

@php
    /*
    ============================================================
    DEMO DATA — REMOVE IN PRODUCTION
    ============================================================
    Backend: Remove this @php block. Inject from JadwalController@show.

    Expected controller variables:
      $jadwalJudul  (string) — schedule title
      $tanggal      (string) — formatted date, e.g. 'Minggu, 12 Mei 2024'
      $waktu        (string) — time range, e.g. '08.00 – 11.00 WIB'
      $lokasi       (string) — venue name
      $kecamatan    (string) — subdistrict
      $status       (string) — display label
      $statusType   (string) — 'today' | 'done' | 'upcoming'
      $catatan      (string) — notes (nullable)
      $petugas      (string) — officer names (nullable)
      $balitaList   (array)  — list of balita with keys: id, name, status, statusType
    ============================================================
    */
    $jadwal = [
        'judul'      => $jadwalJudul ?? 'Posyandu Melati 1',
        'tanggal'    => $tanggal     ?? 'Minggu, 12 Mei 2024',
        'waktu'      => $waktu       ?? '08.00 – 11.00 WIB',
        'lokasi'     => $lokasi      ?? 'Balai Desa Lampeuneurut',
        'kecamatan'  => $kecamatan   ?? 'Kec. Darul Imarah',
        'status'     => $status      ?? 'Hari Ini',
        'statusType' => $statusType  ?? 'today',
        'catatan'    => $catatan     ?? 'Mohon hadir 15 menit sebelum kegiatan dimulai.',
        'petugas'    => $petugas     ?? 'Bidan Ratna, dr. Anita',
    ];

    $balitaList = $balitaList ?? [
        ['id' => 3, 'name' => 'Aisyah Putri',    'status' => 'Belum Diukur', 'statusType' => 'warning'],
        ['id' => 1, 'name' => 'Bima Saputra',    'status' => 'Sudah Diukur', 'statusType' => 'success'],
        ['id' => 7, 'name' => 'Dinda Amanda',    'status' => 'Belum Diukur', 'statusType' => 'warning'],
        ['id' => 4, 'name' => 'Citra Lestari',   'status' => 'Sudah Diukur', 'statusType' => 'success'],
        ['id' => 6, 'name' => 'Fathan Ramadhan', 'status' => 'Belum Diukur', 'statusType' => 'warning'],
    ];

    $totalBalita = count($balitaList);
    $sudahDiukur = collect($balitaList)->where('statusType', 'success')->count();
    $belumDiukur = $totalBalita - $sudahDiukur;
@endphp

<div class="flex flex-col w-full bg-slate-50/50 min-h-screen">

    <!-- Header -->
    <div class="bg-white px-5 pt-5 pb-4 shadow-sm border-b border-slate-100 sticky top-0 z-20">
        <div class="max-w-2xl mx-auto w-full flex items-center gap-3">
            <a href="{{ route('jadwal.index') }}"
               class="flex flex-shrink-0 items-center justify-center w-11 h-11 -ml-2 text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-full transition-all focus:outline-none focus:ring-2 focus:ring-slate-300"
               aria-label="Kembali ke Jadwal">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </a>
            <div class="flex-1 min-w-0">
                <h1 class="text-xl font-extrabold text-slate-800 tracking-tight truncate">Detail Jadwal</h1>
                <p class="text-xs text-slate-500 font-medium mt-0.5">{{ $jadwal['tanggal'] }}</p>
            </div>
            <!-- Status Badge -->
            @if($jadwal['statusType'] === 'today')
                <span class="flex-shrink-0 bg-amber-50 text-amber-600 border border-amber-200 text-[11px] font-bold px-2.5 py-1 rounded-full">
                    Hari Ini
                </span>
            @elseif($jadwal['statusType'] === 'done')
                <span class="flex-shrink-0 bg-slate-100 text-slate-500 border border-slate-200 text-[11px] font-bold px-2.5 py-1 rounded-full">
                    Selesai
                </span>
            @else
                <span class="flex-shrink-0 bg-mint-50 text-mint-600 border border-mint-200 text-[11px] font-bold px-2.5 py-1 rounded-full">
                    Mendatang
                </span>
            @endif
        </div>
    </div>

    <div class="max-w-2xl mx-auto w-full px-5 py-5 pb-28 flex flex-col gap-4">

        <!-- Info Utama Jadwal -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex flex-col gap-4">

            <!-- Judul Kegiatan -->
            <div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Kegiatan</p>
                <h2 class="text-xl font-extrabold text-slate-800 leading-tight">{{ $jadwal['judul'] }}</h2>
            </div>

            <div class="border-t border-slate-100"></div>

            <!-- Tanggal & Waktu -->
            <div class="flex flex-col gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-mint-50 flex items-center justify-center text-mint-600 flex-shrink-0 border border-mint-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Tanggal</p>
                        <p class="text-sm font-bold text-slate-800">{{ $jadwal['tanggal'] }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 flex-shrink-0 border border-blue-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Waktu</p>
                        <p class="text-sm font-bold text-slate-800">{{ $jadwal['waktu'] }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-rose-50 flex items-center justify-center text-rose-500 flex-shrink-0 border border-rose-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Lokasi</p>
                        <p class="text-sm font-bold text-slate-800">{{ $jadwal['lokasi'] }}</p>
                        <p class="text-xs text-slate-500 font-medium">{{ $jadwal['kecamatan'] }}</p>
                    </div>
                </div>

                @if(!empty($jadwal['petugas']))
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-purple-50 flex items-center justify-center text-purple-500 flex-shrink-0 border border-purple-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Petugas</p>
                        <p class="text-sm font-bold text-slate-800">{{ $jadwal['petugas'] }}</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Catatan -->
            @if(!empty($jadwal['catatan']))
                <div class="border-t border-slate-100 pt-3">
                    <div class="bg-amber-50/60 border border-amber-100 rounded-xl px-3 py-2.5 flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-amber-500 flex-shrink-0 mt-0.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                        </svg>
                        <p class="text-xs text-amber-800 font-medium leading-relaxed">{{ $jadwal['catatan'] }}</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Progress Pengukuran -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <h3 class="font-extrabold text-slate-800 text-sm">Progress Pengukuran</h3>
                <span class="text-sm font-black text-mint-600">{{ $sudahDiukur }}/{{ $totalBalita }}</span>
            </div>
            <!-- Progress Bar -->
            <div class="w-full bg-slate-100 rounded-full h-2 mb-3 overflow-hidden">
                <div class="bg-mint-500 h-2 rounded-full transition-all duration-500"
                     style="width: {{ $totalBalita > 0 ? round(($sudahDiukur / $totalBalita) * 100) : 0 }}%"></div>
            </div>
            <!-- Stats Row -->
            <div class="flex gap-3">
                <div class="flex-1 bg-mint-50 border border-mint-100 rounded-xl p-3 flex flex-col items-center">
                    <span class="text-xl font-black text-mint-700">{{ $sudahDiukur }}</span>
                    <span class="text-[10px] font-bold text-mint-600 uppercase tracking-wide mt-0.5">Selesai</span>
                </div>
                <div class="flex-1 bg-amber-50 border border-amber-100 rounded-xl p-3 flex flex-col items-center">
                    <span class="text-xl font-black text-amber-700">{{ $belumDiukur }}</span>
                    <span class="text-[10px] font-bold text-amber-600 uppercase tracking-wide mt-0.5">Menunggu</span>
                </div>
                <div class="flex-1 bg-slate-50 border border-slate-100 rounded-xl p-3 flex flex-col items-center">
                    <span class="text-xl font-black text-slate-700">{{ $totalBalita }}</span>
                    <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wide mt-0.5">Total</span>
                </div>
            </div>
        </div>

        <!-- Daftar Balita -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-extrabold text-slate-800 text-sm">Daftar Balita</h3>
                <span class="text-xs font-semibold text-slate-400">{{ $totalBalita }} terdaftar</span>
            </div>
            <div class="flex flex-col divide-y divide-slate-50">
                @forelse($balitaList as $balita)
                    <a href="{{ route('balita.show', $balita['id'] ?? '') }}" class="flex items-center justify-between px-5 py-3.5 hover:bg-slate-50 transition-colors group">
                        <div class="flex items-center gap-3">
                            <!-- Avatar -->
                            <div class="w-9 h-9 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 flex-shrink-0 group-hover:bg-mint-50 group-hover:text-mint-500 transition-colors border border-slate-200/60">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-sm font-semibold text-slate-800 group-hover:text-mint-700 transition-colors">{{ $balita['name'] }}</span>
                        </div>
                        <!-- Status -->
                        @if($balita['statusType'] === 'success')
                            <div class="flex items-center gap-1.5 bg-mint-50 text-mint-700 px-2 py-1 rounded-lg border border-mint-100 flex-shrink-0">
                                <div class="w-1.5 h-1.5 rounded-full bg-mint-500"></div>
                                <span class="text-[11px] font-bold">{{ $balita['status'] }}</span>
                            </div>
                        @else
                            <div class="flex items-center gap-1.5 bg-amber-50 text-amber-700 px-2 py-1 rounded-lg border border-amber-100 flex-shrink-0">
                                <div class="w-1.5 h-1.5 rounded-full bg-amber-500"></div>
                                <span class="text-[11px] font-bold">{{ $balita['status'] }}</span>
                            </div>
                        @endif
                    </a>
                @empty
                    <div class="px-5 py-8 text-center text-slate-400">
                        <p class="text-sm font-medium">Belum ada balita terdaftar.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    {{-- Backend: 'Mulai Pengukuran' should navigate to daftar-balita filtered by this jadwal's ID.
         Production: route('balita.index', ['jadwal_id' => $jadwalId]) --}}
    <div class="fixed bottom-20 lg:bottom-0 inset-x-0 z-20 pointer-events-none">
        <div class="max-w-2xl mx-auto w-full px-5 py-3 pointer-events-auto">
            <a href="{{ route('balita.index') }}"
               class="w-full flex items-center justify-center gap-2 bg-mint-600 hover:bg-mint-700 text-white px-5 py-4 rounded-2xl font-bold text-base shadow-lg shadow-mint-500/20 transition-all duration-200 focus:outline-none focus:ring-4 focus:ring-mint-500/30">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.82 1.508-2.316a7.5 7.5 0 10-7.516 0c.85.496 1.508 1.333 1.508 2.316V18" />
                </svg>
                Mulai Pengukuran
            </a>
        </div>
    </div>

</div>
@endsection
