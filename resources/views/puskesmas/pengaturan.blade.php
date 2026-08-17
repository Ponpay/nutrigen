@extends('layouts.puskesmas')
@section('page-title', 'Pengaturan')
@section('page-breadcrumbs', 'Pengaturan')
@section('page-mode', 'app')
@section('content')

{{-- Backend Contract:
    Controller: PuskesmasController@pengaturan & updatePengaturan
    Expected Variables: $puskesmas, $user
--}}

<div class="flex flex-col lg:flex-row flex-1 overflow-hidden" x-data="{ 
    editMode: false,
    formData: {
        nama: '{{ addslashes($puskesmas['nama']) }}',
        alamat: '{{ addslashes($puskesmas['alamat']) }}'
    }
}">

    <!-- LEFT PANEL: Settings Navigation -->
    <x-puskesmas.settings-sidebar active="profil" />

    <!-- RIGHT PANEL: Settings Canvas -->
    <div class="flex-1 flex flex-col overflow-y-auto bg-slate-50 p-4 lg:p-8">
        
        @if (session('success'))
            <div class="mb-6 mx-auto w-full max-w-4xl bg-[#ECFDF5] border border-[#A7F3D0] text-[#065F46] rounded-xl p-4 flex items-center gap-3 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-[#10B981]">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                </svg>
                <span class="text-sm font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('puskesmas.pengaturan.update') }}" class="max-w-4xl w-full mx-auto flex flex-col gap-6">
            @csrf
            @method('PUT')

            <!-- SECTION: Profil Institusi -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <!-- Header Card -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-6 border-b border-slate-200">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-[#ECFDF5] text-[#10B981] flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                              <path fill-rule="evenodd" d="M3 6a3 3 0 013-3h12a3 3 0 013 3v12a3 3 0 01-3 3H6a3 3 0 01-3-3V6zm14.25 6a.75.75 0 01-.75.75h-2.25v2.25a.75.75 0 01-1.5 0v-2.25H10.5v2.25a.75.75 0 01-1.5 0v-2.25H6.75a.75.75 0 010-1.5h2.25V6.75a.75.75 0 011.5 0v2.25h2.25v-2.25a.75.75 0 011.5 0v2.25h2.25a.75.75 0 01.75.75z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold tracking-tight text-slate-900">Profil Institusi</h3>
                            <p class="text-sm text-slate-500">Informasi resmi puskesmas yang tercatat pada sistem NutriGen.</p>
                        </div>
                    </div>
                    <div>
                        <button type="button" x-show="!editMode" @click="editMode = true" class="px-4 py-2 text-sm font-semibold text-[#047857] bg-white hover:bg-slate-50 border border-[#047857] rounded-xl flex items-center gap-2 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                              <path d="M2.695 14.763l-1.262 3.152a.5.5 0 00.65.65l3.152-1.262a4 4 0 001.343-.885L17.5 5.5a2.121 2.121 0 00-3-3L3.58 13.42a4 4 0 00-.885 1.343z" />
                            </svg>
                            Edit Profil
                        </button>
                        <div x-show="editMode" class="flex items-center gap-2" x-cloak>
                            <button type="button" @click="editMode = false; formData.nama = '{{ addslashes($puskesmas['nama']) }}'; formData.alamat = '{{ addslashes($puskesmas['alamat']) }}'" class="px-4 py-2 text-sm font-semibold text-slate-600 bg-white hover:bg-slate-100 border border-slate-200 rounded-xl transition-colors">
                                Batal
                            </button>
                            <button type="submit" class="px-4 py-2 text-sm font-semibold text-white bg-[#10B981] hover:bg-[#059669] rounded-xl shadow-sm transition-colors">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Body Card -->
                <div class="p-6 md:p-8">
                    <div class="flex flex-col lg:flex-row gap-8">
                        <!-- Left: Logo -->
                        <div class="w-full lg:w-48 shrink-0 flex flex-col gap-4">
                            <p class="text-xs font-bold text-slate-700">Logo Puskesmas</p>
                            <div class="w-32 h-32 rounded-2xl bg-white border border-slate-200 flex flex-col items-center justify-center p-4 text-slate-400 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mb-2 text-[#10B981]">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <span class="text-[10px] font-semibold text-center leading-tight">Ganti Logo</span>
                            </div>
                            <button type="button" disabled class="px-4 py-2 w-32 text-xs font-semibold text-[#047857] bg-white border border-[#047857] rounded-xl cursor-not-allowed flex items-center justify-center gap-2 opacity-50">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                </svg>
                                Ganti Logo
                            </button>
                        </div>

                        <!-- Right: Data Fields -->
                        <div class="flex-1">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                                
                                <!-- Field: Nama Puskesmas -->
                                <div class="col-span-1 md:col-span-2 flex flex-col sm:flex-row sm:items-start py-2 border-b border-[#F1F5F9]">
                                    <span class="w-48 shrink-0 text-xs font-medium text-slate-500 mb-1 sm:mb-0 mt-1">Nama Puskesmas</span>
                                    <div class="flex-1">
                                        <p x-show="!editMode" class="text-sm font-semibold text-slate-900">{{ $puskesmas['nama'] }}</p>
                                        <div x-show="editMode" x-cloak>
                                            <input type="text" name="nama" x-model="formData.nama" class="w-full px-3 py-2 text-sm bg-white border border-[#CBD5E1] rounded-lg text-slate-900 focus:outline-none focus:ring-1 focus:ring-[#10B981] focus:border-[#10B981] font-medium">
                                            @error('nama') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Field: Kode Registrasi -->
                                <div class="col-span-1 md:col-span-2 flex flex-col sm:flex-row sm:items-start py-2 border-b border-[#F1F5F9]">
                                    <span class="w-48 shrink-0 text-xs font-medium text-slate-500 mb-1 sm:mb-0 mt-1">Kode Registrasi</span>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-slate-900">{{ $puskesmas['kode_registrasi'] }}</p>
                                    </div>
                                </div>

                                <!-- Field: Alamat -->
                                <div class="col-span-1 md:col-span-2 flex flex-col sm:flex-row py-2 border-b border-[#F1F5F9]">
                                    <span class="w-48 shrink-0 text-xs font-medium text-slate-500 mb-1 sm:mb-0 mt-1">Alamat</span>
                                    <div class="flex-1">
                                        <p x-show="!editMode" class="text-sm font-semibold text-slate-900 leading-relaxed">{{ $puskesmas['alamat'] }}</p>
                                        <div x-show="editMode" x-cloak>
                                            <textarea name="alamat" x-model="formData.alamat" rows="2" class="w-full px-3 py-2 text-sm bg-white border border-[#CBD5E1] rounded-lg text-slate-900 focus:outline-none focus:ring-1 focus:ring-[#10B981] focus:border-[#10B981] font-medium resize-none"></textarea>
                                            @error('alamat') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION: Tentang Puskesmas -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 flex flex-col md:flex-row gap-6 items-start md:items-center justify-between">
                <div class="flex items-start gap-4 flex-1">
                    <div class="w-12 h-12 rounded-xl bg-[#ECFDF5] text-[#10B981] flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M4.5 3.75a3 3 0 00-3 3v10.5a3 3 0 003 3h15a3 3 0 003-3V6.75a3 3 0 00-3-3h-15zm4.125 3a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5zm-3.873 8.703a4.126 4.126 0 017.746 0 .75.75 0 01-.71.947h-6.326a.75.75 0 01-.71-.947zM15 9a.75.75 0 01.75-.75h2.25a.75.75 0 01.75.75v.5a.75.75 0 01-.75.75h-2.25a.75.75 0 01-.75-.75V9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold tracking-tight text-slate-900">Tentang Puskesmas</h3>
                        <p class="text-sm text-slate-500 mt-1 line-clamp-2">Deskripsi resmi puskesmas belum diatur pada sistem. Data kapasitas tercatat di sistem sebagai berikut:</p>
                    </div>
                </div>
                
                <div class="flex flex-col gap-4 border-l-0 md:border-l border-slate-200 pl-0 md:pl-8 shrink-0">
                    <div class="flex items-center gap-3">
                        <div class="text-slate-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500">Jumlah Posyandu</p>
                            <p class="text-sm font-semibold text-slate-900">{{ $puskesmas['jumlah_posyandu'] }} Posyandu</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- INFO BAR -->
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-4 flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-[#10B981] shrink-0">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                </svg>
                <p class="text-sm text-slate-600">Pastikan data yang Anda lihat sudah benar. Klik tombol <span class="font-bold">"Edit Profil"</span> untuk melakukan perubahan.</p>
            </div>

        </form>
    </div>
</div>

@endsection
