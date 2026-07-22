@extends('layouts.app')

@section('page-title', 'Profil Balita')

@section('content')

@php
    $colorMap = [
        'success' => 'emerald',
        'warning' => 'amber',
        'danger'  => 'rose',
    ];
    $colorClass = $colorMap[$status_type] ?? 'slate';

    $statusBadgeClasses = [
        'success' => 'bg-emerald-500 text-white shadow-sm border-0',
        'warning' => 'bg-amber-500 text-white shadow-sm border-0',
        'danger'  => 'bg-rose-500 text-white shadow-sm border-0',
    ];
    $badgeClasses = $statusBadgeClasses[$status_type] ?? 'bg-slate-500 text-white shadow-sm border-0';
    $badgeIcon = match($status_type) {
        'danger' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2.25m0 2.625h.008v.008H12v-.008zM12 3a9 9 0 100 18 9 9 0 000-18z" /></svg>',
        'warning' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2.25m0 2.625h.008v.008H12v-.008zM12 3a9 9 0 100 18 9 9 0 000-18z" /></svg>',
        default => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>'
    };
@endphp

<!-- MAIN CANVAS -->
<div class="bg-slate-50 min-h-screen relative w-full pb-[calc(5rem+env(safe-area-inset-bottom))] lg:pb-16 font-sans">
    
    <!-- Top Header Actions -->
    <div class="max-w-7xl mx-auto px-4 lg:px-8 pt-6 pb-4 flex items-center justify-between">
        <a href="{{ route('balita.index') }}" class="flex items-center gap-3 text-slate-500 hover:text-slate-800 transition-colors font-medium text-[14px]">
            <div class="w-9 h-9 rounded-full border border-slate-200 bg-white flex items-center justify-center hover:bg-slate-50 transition-colors shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </div>
            Daftar Balita
        </a>
        <div class="flex items-center gap-2 lg:gap-3">
            <a href="{{ route('balita.edit', $balitaId) }}" class="flex items-center gap-2 px-4 py-2 lg:px-5 lg:py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold text-[13px] shadow-sm transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" /></svg> Edit <span class="hidden sm:inline">Data</span>
            </a>
            <form id="delete-balita-{{ $balitaId }}" action="{{ route('balita.destroy', $balitaId) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" onclick="window.NutriAlert.confirm('Hapus Data Balita?', 'Hapus permanen data balita beserta seluruh riwayat pengukurannya?', 'Ya, Hapus', 'Batal').then((result) => { if(result.isConfirmed) document.getElementById('delete-balita-{{ $balitaId }}').submit(); })" class="flex items-center gap-2 px-4 py-2 lg:px-5 lg:py-2.5 rounded-xl border border-rose-100 bg-rose-50 hover:bg-rose-100 text-rose-600 font-bold text-[13px] shadow-sm transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg> Hapus
                </button>
            </form>
        </div>
    </div>

    <!-- Hero Card -->
    <div class="max-w-7xl mx-auto px-4 lg:px-8 mb-6">
        <div class="bg-white rounded-[24px] p-5 lg:p-8 shadow-sm border border-slate-100 flex flex-col lg:flex-row items-center lg:items-start lg:justify-between gap-6 lg:gap-10">
            
            <!-- Left & Center: Avatar and Info -->
            <div class="flex flex-col lg:flex-row items-center lg:items-start gap-5 lg:gap-8 w-full lg:w-auto">
                <!-- Avatar -->
                <div class="relative shrink-0 mt-2 lg:mt-0">
                    <div class="w-[72px] h-[72px] lg:w-32 lg:h-32 rounded-full overflow-hidden bg-emerald-50 border-[3px] border-emerald-100 flex items-center justify-center text-emerald-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 lg:w-16 lg:h-16 opacity-50">
                            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="absolute bottom-0 right-0 w-7 h-7 lg:w-10 lg:h-10 bg-white rounded-full flex items-center justify-center shadow-md border border-emerald-100 text-emerald-600 translate-x-1 lg:translate-x-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5 lg:w-5 lg:h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                        </svg>
                    </div>
                </div>
                
                <!-- Info -->
                <div class="flex flex-col items-center lg:items-start gap-3 lg:gap-4 w-full">
                    <!-- Name & Age -->
                    <div class="flex flex-col items-center lg:items-start gap-1 w-full">
                        <h1 class="text-[20px] lg:text-[28px] font-black text-slate-900 tracking-tight text-center lg:text-left">{{ $childName }}</h1>
                        <div class="flex items-center gap-1.5 px-3 py-1 bg-blue-50 text-blue-700 rounded-full mt-1 border border-blue-100/50">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-[12px] font-bold">{{ $age }}</span>
                        </div>
                    </div>
                    
                    <!-- Badges -->
                    <div class="flex flex-wrap items-center justify-center lg:justify-start gap-2 w-full">
                        <div class="flex items-center gap-1.5 {{ $badgeClasses }} px-3 py-1 lg:px-3.5 lg:py-1.5 rounded-full">
                            {!! $badgeIcon !!}
                            <span class="text-[10px] lg:text-[11px] font-extrabold uppercase tracking-wider">{{ $status }}</span>
                        </div>
                        @if(isset($latestMeasure) && $latestMeasure['status_validasi'])
                            @php
                                $valColors = match($latestMeasure['status_validasi']) {
                                    'pending' => 'bg-amber-400 text-white',
                                    'approved' => 'bg-emerald-500 text-white',
                                    'rejected' => 'bg-rose-500 text-white',
                                    default => 'bg-slate-500 text-white'
                                };
                                $valIcon = match($latestMeasure['status_validasi']) {
                                    'pending' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" /></svg>', // Placeholder for hourglass
                                    'approved' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>',
                                    'rejected' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>',
                                    default => ''
                                };
                            @endphp
                            <div class="flex items-center gap-1.5 {{ $valColors }} px-3 py-1 lg:px-3.5 lg:py-1.5 rounded-full shadow-sm border-0">
                                {!! $valIcon !!}
                                <span class="text-[10px] lg:text-[11px] font-extrabold uppercase tracking-wider">{{ $latestMeasure['status_validasi'] }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Info Cards -->
                    <div class="grid grid-cols-2 lg:flex lg:flex-row items-center gap-3 w-full mt-2 lg:mt-3">
                        <!-- Ibu -->
                        <div class="flex items-center gap-3 px-3 py-2 lg:px-4 lg:py-2.5 rounded-2xl border border-slate-100 bg-white shadow-sm w-full lg:w-auto">
                            <div class="w-8 h-8 rounded-full bg-purple-50 flex items-center justify-center text-purple-500 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                            </div>
                            <div class="flex flex-col overflow-hidden">
                                <span class="text-[11px] text-slate-500 font-medium">Ibu</span>
                                <span class="text-[13px] font-bold text-slate-800 truncate">{{ $motherName }}</span>
                            </div>
                        </div>
                        <!-- NIK -->
                        <div class="flex items-center justify-between gap-3 px-3 py-2 lg:px-4 lg:py-2.5 rounded-2xl border border-slate-100 bg-white shadow-sm w-full lg:w-auto">
                            <div class="flex items-center gap-3 overflow-hidden">
                                <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600 shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" /></svg>
                                </div>
                                <div class="flex flex-col overflow-hidden">
                                    <span class="text-[11px] text-slate-500 font-medium">NIK</span>
                                    <span class="text-[13px] font-bold text-slate-800 font-mono tracking-wider truncate">{{ $nik }}</span>
                                </div>
                            </div>
                            <button onclick="navigator.clipboard.writeText('{{ $nik }}'); window.NutriAlert.toast('Berhasil!', 'NIK disalin', 'success');" class="text-slate-400 hover:text-slate-600 shrink-0 hidden sm:block">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" /></svg>
                            </button>
                        </div>
                        <!-- Posyandu -->
                        <div class="col-span-2 sm:col-span-1 lg:col-span-1 flex items-center gap-3 px-3 py-2 lg:px-4 lg:py-2.5 rounded-2xl border border-slate-100 bg-white shadow-sm w-full lg:w-auto">
                            <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-500 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                            </div>
                            <div class="flex flex-col overflow-hidden">
                                <span class="text-[11px] text-slate-500 font-medium">Posyandu</span>
                                <span class="text-[13px] font-bold text-slate-800 truncate">{{ $posyanduName }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Aksi Cepat (Mobile: full width button at bottom) -->
            <div class="w-full lg:w-[280px] shrink-0 bg-emerald-50 rounded-[20px] p-4 lg:p-6 flex flex-col border border-emerald-100 mt-4 lg:mt-0">
                <div class="hidden lg:flex items-center gap-2 mb-5">
                    <div class="text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                    </div>
                    <span class="text-[15px] font-bold text-emerald-800">Aksi Cepat</span>
                </div>
                <button onclick="openMeasurementModal()" class="w-full flex items-center justify-center gap-2 px-6 py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-[15px] rounded-xl shadow-[0_4px_12px_-2px_rgba(16,185,129,0.5)] transition-all active:scale-[0.98]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg> Ukur Sekarang
                </button>
            </div>
        </div>
    </div>

    <!-- Alert Skrining -->
    <div class="max-w-7xl mx-auto px-4 lg:px-8 mb-8">
        @php
            $alertBg = $status_type == 'danger' ? 'bg-orange-50' : ($status_type == 'warning' ? 'bg-amber-50' : 'bg-emerald-50');
            $alertBorder = $status_type == 'danger' ? 'border-orange-200' : ($status_type == 'warning' ? 'border-amber-200' : 'border-emerald-200');
            $alertSide = $status_type == 'danger' ? 'bg-orange-400' : ($status_type == 'warning' ? 'bg-amber-400' : 'bg-emerald-400');
            $alertText = $status_type == 'danger' ? 'text-orange-600' : ($status_type == 'warning' ? 'text-amber-600' : 'text-emerald-600');
            $alertIcon = $status_type == 'danger' ? 'text-orange-500' : ($status_type == 'warning' ? 'text-amber-500' : 'text-emerald-500');
        @endphp
        <div class="flex items-start gap-3 p-4 {{ $alertBg }} {{ $alertBorder }} rounded-[16px] border relative overflow-hidden">
            <div class="absolute left-0 top-0 bottom-0 w-1.5 {{ $alertSide }}"></div>
            <div class="shrink-0 {{ $alertIcon }} pl-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" /></svg>
            </div>
            <div class="flex flex-col">
                <span class="text-[14px] font-bold text-slate-700">Hasil Skrining: <span class="{{ $alertText }} font-black">{{ $latestMeasure['status'] ?? 'Belum Diukur' }}</span></span>
                <span class="text-[13px] text-slate-600 mt-0.5 leading-relaxed">{{ $latestMeasure['education'] ?? 'Lakukan pengukuran rutin setiap bulan untuk memantau tumbuh kembang anak.' }}</span>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="max-w-7xl mx-auto px-4 lg:px-8 border-b border-slate-200 mb-6 lg:mb-8" id="profile-tabs">
        <div class="flex items-center gap-6 lg:gap-8 overflow-x-auto hide-scrollbar">
            <button onclick="switchTab('ringkasan')" id="tab-ringkasan" class="tab-btn pb-3 flex items-center gap-2 border-b-[3px] border-emerald-500 text-emerald-600 font-bold text-[14px] whitespace-nowrap transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" /></svg>
                Ringkasan
            </button>
            <button onclick="switchTab('riwayat')" id="tab-riwayat" class="tab-btn pb-3 flex items-center gap-2 border-b-[3px] border-transparent text-slate-500 hover:text-slate-800 font-semibold text-[14px] whitespace-nowrap transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                Riwayat Pengukuran
            </button>
            <button onclick="switchTab('grafik')" id="tab-grafik" class="tab-btn pb-3 flex items-center gap-2 border-b-[3px] border-transparent text-slate-500 hover:text-slate-800 font-semibold text-[14px] whitespace-nowrap transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" /></svg>
                Grafik Pertumbuhan
            </button>
        </div>
    </div>

    <!-- Content Area -->
    <div class="max-w-7xl mx-auto px-4 lg:px-8 pb-10">
        
        <!-- TAB: RINGKASAN -->
        <div id="content-ringkasan" class="tab-content flex flex-col lg:grid lg:grid-cols-12 gap-6 lg:gap-8">
            
            <!-- Pengukuran Terakhir -->
            <div class="lg:col-span-7 flex flex-col">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-[16px] font-black text-slate-900 tracking-tight">Pengukuran Terakhir</h2>
                    <div class="flex items-center gap-1.5 text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" /></svg>
                        <span class="text-[12px] font-bold">{{ $latestMeasure['date'] ?? 'Belum ada data' }}</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <!-- Berat Badan -->
                    <div class="bg-gradient-to-br from-emerald-50 to-emerald-100/50 border border-emerald-200/60 rounded-2xl p-5 flex flex-col lg:items-center items-start text-left lg:text-center shadow-sm">
                        <div class="flex items-center gap-3 lg:flex-col lg:gap-3 mb-4 lg:mb-5">
                            <div class="w-10 h-10 rounded-[10px] bg-emerald-100 text-emerald-600 flex items-center justify-center shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M12 7.5a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5z" /><path fill-rule="evenodd" d="M1.5 4.875C1.5 3.839 2.34 3 3.375 3h17.25c1.035 0 1.875.84 1.875 1.875v9.75c0 1.036-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 011.5 14.625v-9.75zM8.25 9.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM18.75 9a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75V9.75a.75.75 0 00-.75-.75h-.008zM4.5 9.75A.75.75 0 015.25 9h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H5.25a.75.75 0 01-.75-.75V9.75z" clip-rule="evenodd" /></svg>
                            </div>
                            <span class="text-[13px] font-bold text-slate-700">Berat Badan</span>
                        </div>
                        <div class="flex items-baseline gap-1.5 mb-3 lg:mb-4">
                            <span class="text-3xl font-black text-slate-900">{{ $latestMeasure['weight'] ?? '-' }}</span><span class="text-[13px] font-bold text-slate-500">kg</span>
                        </div>
                        <span class="px-3.5 py-1 rounded-full bg-orange-100 text-orange-700 text-[11px] font-bold mb-2">Risiko</span>
                        <span class="text-[12px] font-medium text-slate-500">Z-Score: -2.10</span>
                    </div>
                    
                    <!-- Tinggi Badan -->
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100/50 border border-purple-200/60 rounded-2xl p-5 flex flex-col lg:items-center items-start text-left lg:text-center shadow-sm">
                        <div class="flex items-center gap-3 lg:flex-col lg:gap-3 mb-4 lg:mb-5">
                            <div class="w-10 h-10 rounded-[10px] bg-purple-100 text-purple-600 flex items-center justify-center shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M11.47 2.47a.75.75 0 011.06 0l4.5 4.5a.75.75 0 01-1.06 1.06l-3.22-3.22V16.5a.75.75 0 01-1.5 0V4.81L8.03 8.03a.75.75 0 01-1.06-1.06l4.5-4.5z" clip-rule="evenodd" /><path fill-rule="evenodd" d="M3 20.25a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75z" clip-rule="evenodd" /></svg>
                            </div>
                            <span class="text-[13px] font-bold text-slate-700">Tinggi Badan</span>
                        </div>
                        <div class="flex items-baseline gap-1.5 mb-3 lg:mb-4">
                            <span class="text-3xl font-black text-slate-900">{{ $latestMeasure['height'] ?? '-' }}</span><span class="text-[13px] font-bold text-slate-500">cm</span>
                        </div>
                        <span class="px-3.5 py-1 rounded-full bg-orange-100 text-orange-700 text-[11px] font-bold mb-2">Risiko</span>
                        <span class="text-[12px] font-medium text-slate-500">Z-Score: -2.25</span>
                    </div>
                    
                    <!-- Lingkar Kepala -->
                    <div class="bg-gradient-to-br from-sky-50 to-sky-100/50 border border-sky-200/60 rounded-2xl p-5 flex flex-col lg:items-center items-start text-left lg:text-center shadow-sm">
                        <div class="flex items-center gap-3 lg:flex-col lg:gap-3 mb-4 lg:mb-5">
                            <div class="w-10 h-10 rounded-[10px] bg-sky-100 text-sky-600 flex items-center justify-center shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm0 15a5.25 5.25 0 100-10.5 5.25 5.25 0 000 10.5z" clip-rule="evenodd" /></svg>
                            </div>
                            <span class="text-[13px] font-bold text-slate-700">Lingkar Kepala</span>
                        </div>
                        <div class="flex items-baseline gap-1.5 mb-3 lg:mb-4">
                            <span class="text-3xl font-black text-slate-400">-</span><span class="text-[13px] font-bold text-slate-400">cm</span>
                        </div>
                        <span class="px-3.5 py-1 rounded-full bg-sky-100 text-sky-600 text-[11px] font-bold">Belum Ada Data</span>
                    </div>
                </div>
            </div>

            <!-- Informasi Personal -->
            <div class="lg:col-span-5 flex flex-col mt-6 lg:mt-0">
                <h2 class="text-[16px] font-black text-slate-900 tracking-tight mb-4">Informasi Personal</h2>
                <div class="bg-white border border-slate-200 rounded-2xl p-5 lg:p-6 flex flex-col shadow-sm">
                    
                    <!-- Jenis Kelamin -->
                    <div class="flex items-center justify-between py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                            </div>
                            <span class="text-[13px] font-bold text-slate-600">Jenis Kelamin</span>
                        </div>
                        <span class="text-[13px] font-bold text-slate-900">{{ $gender }}</span>
                    </div>
                    <hr class="border-slate-100 my-1">
                    
                    <!-- Posyandu -->
                    <div class="flex items-center justify-between py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" /></svg>
                            </div>
                            <span class="text-[13px] font-bold text-slate-600">Posyandu</span>
                        </div>
                        <span class="text-[13px] font-bold text-slate-900">{{ $posyanduName }}</span>
                    </div>
                    <hr class="border-slate-100 my-1">
                    
                    <!-- No HP Ibu -->
                    <div class="flex items-center justify-between py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" /></svg>
                            </div>
                            <span class="text-[13px] font-bold text-slate-600">Nomor HP Ibu</span>
                        </div>
                        <span class="text-[13px] font-bold text-slate-900">{{ $motherPhone }}</span>
                    </div>
                    <hr class="border-slate-100 my-1">
                    
                    <!-- Alamat -->
                    <div class="flex items-center justify-between py-3">
                        <div class="flex items-center gap-3 shrink-0">
                            <div class="w-8 h-8 rounded-full bg-orange-50 text-orange-500 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                            </div>
                            <span class="text-[13px] font-bold text-slate-600">Alamat Lengkap</span>
                        </div>
                        <span class="text-[13px] font-bold text-slate-900 text-right ml-4 max-w-[160px] sm:max-w-none">{{ $address }}</span>
                    </div>
                    
                </div>
            </div>
            
        </div>

        <!-- TAB: RIWAYAT -->
        <div id="content-riwayat" class="tab-content hidden flex flex-col p-6 bg-white border border-slate-200 rounded-2xl shadow-sm">
            <h2 class="text-[16px] font-black text-slate-900 tracking-tight mb-6">Riwayat Pengukuran</h2>
            <div class="flex flex-col">
                @forelse($measurements as $measure)
                    <x-timeline-item :measurement="$measure" :is-last="$loop->last" />
                @empty
                    <div class="py-12 flex flex-col items-center justify-center text-center">
                        <div class="w-16 h-16 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mb-5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <span class="text-[14px] font-bold text-slate-900">Belum Ada Riwayat</span>
                        <p class="text-[13px] text-slate-500 mt-1">Anak belum pernah diukur.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- TAB: GRAFIK -->
        <div id="content-grafik" class="tab-content hidden flex flex-col p-6 bg-white border border-slate-200 rounded-2xl shadow-sm">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-6 gap-4">
                <h2 class="text-[16px] font-black text-slate-900 tracking-tight">Grafik Pertumbuhan</h2>
                @if(count($measurements) > 0)
                <div class="max-w-xs w-full lg:w-auto">
                    <select class="w-full bg-slate-50 border border-slate-200 text-slate-700 text-[13px] font-bold rounded-xl px-4 h-[40px] focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400 transition-colors shadow-sm">
                        <option>Berat Badan per Umur (BB/U)</option>
                        <option>Tinggi Badan per Umur (TB/U)</option>
                    </select>
                </div>
                @endif
            </div>

            @if(count($measurements) > 0)
            <div class="relative h-[350px] w-full rounded-[16px] overflow-hidden border border-slate-100 bg-slate-50/50 p-4 lg:p-6">
                <canvas id="growthChart" class="w-full h-full"></canvas>
            </div>
            @else
            <div class="py-12 flex flex-col items-center text-center">
                <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center mb-5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-slate-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                    </svg>
                </div>
                <span class="text-[14px] font-bold text-slate-900">Belum Ada Grafik</span>
                <p class="text-[13px] text-slate-500 mt-1 max-w-[250px] mx-auto">Lakukan pengukuran terlebih dahulu untuk melihat grafik pertumbuhan.</p>
            </div>
            @endif
        </div>
        
    </div>
</div>

@push('modals')

<script>
    function switchTab(tabId) {
        document.querySelectorAll('.tab-content').forEach(el => {
            el.classList.add('hidden');
        });
        
        const activeClasses = ['border-emerald-500', 'text-emerald-600'];
        const inactiveClasses = ['border-transparent', 'text-slate-500', 'hover:text-slate-800'];
        
        ['ringkasan', 'riwayat', 'grafik'].forEach(id => {
            const btn = document.getElementById('tab-' + id);
            if(btn) {
                btn.classList.remove(...activeClasses);
                btn.classList.add(...inactiveClasses);
            }
        });
        
        const selectedContent = document.getElementById('content-' + tabId);
        const selectedBtn = document.getElementById('tab-' + tabId);
        
        if(selectedContent && selectedBtn) {
            selectedContent.classList.remove('hidden');
            selectedBtn.classList.remove(...inactiveClasses);
            selectedBtn.classList.add(...activeClasses);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('action') === 'ukur') {
            if (typeof openMeasurementModal === 'function') {
                setTimeout(openMeasurementModal, 150);
            }
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rawData = @json($measurements);
        const chartData = [...rawData].reverse();
        
        const labels = chartData.map(d => d.date);
        const bbData = chartData.map(d => d.weight);
        
        const ctx = document.getElementById('growthChart');
        if (ctx && rawData.length > 0) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Berat Badan (kg)',
                        data: bbData,
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        borderWidth: 3,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#10b981',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(15, 23, 42, 0.9)',
                            titleFont: { size: 13, family: "'Inter', sans-serif" },
                            bodyFont: { size: 14, family: "'Inter', sans-serif", weight: 'bold' },
                            padding: 12,
                            cornerRadius: 8,
                            callbacks: {
                                label: function(context) { return context.parsed.y + ' kg'; }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(226, 232, 240, 0.6)', borderDash: [4, 4], drawBorder: false },
                            ticks: { font: { family: "'Inter', sans-serif", size: 12 }, color: '#64748b' }
                        },
                        x: {
                            grid: { display: false, drawBorder: false },
                            ticks: { font: { family: "'Inter', sans-serif", size: 12 }, color: '#64748b' }
                        }
                    }
                }
            });
        }
    });
</script>

<x-measurement-modal 
    :balita-id="$balitaId"
    :child-name="$childName" 
    :age="$age" 
    :last-weight="$latestMeasure['weight'] ?? null" 
    :last-height="$latestMeasure['height'] ?? null" 
    :last-date="$latestMeasure['date'] ?? null" 
/>
@endpush

@endsection
