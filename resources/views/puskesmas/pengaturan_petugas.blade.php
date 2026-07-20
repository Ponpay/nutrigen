@extends('layouts.puskesmas')
@section('page-title', 'Pengaturan')
@section('page-breadcrumbs')
    Pengaturan 
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3 text-[#CBD5E1]">
        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
    </svg>
    Profil Petugas
@endsection
@section('page-mode', 'app')
@section('content')

{{-- Backend Contract:
    Controller: PuskesmasController@petugas & updatePetugas
    Expected Variables: $user, $puskesmas
--}}

<!-- Full-viewport Split View: Petugas Management -->
<div class="flex flex-col lg:flex-row flex-1 overflow-hidden" x-data="{ 
    editMode: false,
    formData: {
        nama: '{{ addslashes($user['nama']) }}',
        email: '{{ addslashes($user['email']) }}'
    }
}">

    <!-- LEFT PANEL: Settings Navigation -->
    <x-puskesmas.settings-sidebar active="petugas" />

    <!-- RIGHT PANEL: Settings Canvas -->
    <div class="flex-1 flex flex-col overflow-y-auto bg-[#F8FAFC] p-4 lg:p-8">
        
        <div class="max-w-4xl w-full mx-auto">
            @if (session('success'))
                <div class="mb-6 bg-[#ECFDF5] border border-[#A7F3D0] text-[#065F46] rounded-xl p-4 flex items-center gap-3 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-[#10B981]">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm font-semibold">{{ session('success') }}</span>
                </div>
            @endif
            
            @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-800 rounded-xl p-4 flex items-start gap-3 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-red-500 shrink-0 mt-0.5">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                    </svg>
                    <div class="text-sm font-semibold">
                        Terjadi kesalahan:
                        <ul class="list-disc ml-5 mt-1 font-medium text-xs">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('puskesmas.pengaturan.petugas.update') }}" class="flex flex-col gap-6">
                @csrf
                @method('PUT')

                <!-- SECTION: Profil Petugas -->
                <div class="bg-white border border-[#E2E8F0] rounded-2xl shadow-sm overflow-hidden">
                    <!-- Header Card -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-6 border-b border-[#E2E8F0] bg-white">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-[#ECFDF5] text-[#10B981] flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-[#1E293B]">Profil Petugas</h3>
                                <p class="text-sm text-[#64748B]">Informasi akun petugas yang digunakan untuk mengakses sistem NutriGen.</p>
                            </div>
                        </div>
                        <div>
                            <button type="button" x-show="!editMode" @click="editMode = true" class="px-4 py-2 text-sm font-semibold text-[#047857] bg-white hover:bg-[#F8FAFC] border border-[#047857] rounded-xl flex items-center gap-2 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                  <path d="M2.695 14.763l-1.262 3.152a.5.5 0 00.65.65l3.152-1.262a4 4 0 001.343-.885L17.5 5.5a2.121 2.121 0 00-3-3L3.58 13.42a4 4 0 00-.885 1.343z" />
                                </svg>
                                Edit Profil
                            </button>
                            <div x-show="editMode" class="flex items-center gap-2" x-cloak>
                                <button type="button" @click="editMode = false; formData.nama = '{{ addslashes($user['nama']) }}'; formData.email = '{{ addslashes($user['email']) }}'" class="px-4 py-2 text-sm font-semibold text-[#475569] bg-white hover:bg-[#F1F5F9] border border-[#E2E8F0] rounded-xl transition-colors">
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
                        <div class="flex flex-col md:flex-row gap-8 lg:gap-12">
                            <!-- Left: Avatar -->
                            <div class="w-full md:w-48 shrink-0 flex flex-col items-center gap-5">
                                <div class="w-32 h-32 rounded-full bg-[#ECFDF5] border-4 border-white shadow-md flex items-center justify-center overflow-hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-16 h-16 text-[#A7F3D0] mt-4">
                                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <button type="button" disabled class="px-4 py-2 w-32 text-xs font-semibold text-[#047857] bg-white border border-[#047857] rounded-xl cursor-not-allowed flex items-center justify-center gap-2 opacity-60">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                    </svg>
                                    Ganti Foto
                                </button>
                            </div>

                            <!-- Right: Data Fields -->
                            <div class="flex-1 flex flex-col">
                                <!-- Field: Nama Lengkap -->
                                <div class="flex flex-col sm:flex-row py-3.5 border-b border-[#F1F5F9] items-center">
                                    <span class="w-48 shrink-0 text-sm font-medium text-[#64748B]">Nama Lengkap</span>
                                    <div class="flex-1 w-full">
                                        <p x-show="!editMode" class="text-sm font-semibold text-[#1E293B]">{{ $user['nama'] }}</p>
                                        <div x-show="editMode" x-cloak>
                                            <input type="text" name="nama" x-model="formData.nama" class="w-full px-3 py-2 text-sm bg-white border border-[#CBD5E1] rounded-lg text-[#1E293B] focus:outline-none focus:ring-1 focus:ring-[#10B981] focus:border-[#10B981] font-medium">
                                        </div>
                                    </div>
                                </div>

                                <!-- Field: Email -->
                                <div class="flex flex-col sm:flex-row py-3.5 border-b border-[#F1F5F9] items-center">
                                    <span class="w-48 shrink-0 text-sm font-medium text-[#64748B]">Email</span>
                                    <div class="flex-1 w-full">
                                        <p x-show="!editMode" class="text-sm font-semibold text-[#1E293B]">{{ $user['email'] }}</p>
                                        <div x-show="editMode" x-cloak>
                                            <input type="email" name="email" x-model="formData.email" class="w-full px-3 py-2 text-sm bg-white border border-[#CBD5E1] rounded-lg text-[#1E293B] focus:outline-none focus:ring-1 focus:ring-[#10B981] focus:border-[#10B981] font-medium">
                                        </div>
                                    </div>
                                </div>

                                <!-- Removed No. Telepon and NIP / NIK -->

                                <!-- Field: Unit Kerja -->
                                <div class="flex flex-col sm:flex-row py-3.5 border-b border-[#F1F5F9] items-center">
                                    <span class="w-48 shrink-0 text-sm font-medium text-[#64748B]">Unit Kerja</span>
                                    <div class="flex-1 w-full">
                                        <p class="text-sm font-semibold text-[#1E293B]">{{ $puskesmas['nama'] }}</p>
                                    </div>
                                </div>

                                <!-- Field: Peran -->
                                <div class="flex flex-col sm:flex-row py-3.5 border-b border-[#F1F5F9] items-center">
                                    <span class="w-48 shrink-0 text-sm font-medium text-[#64748B]">Peran</span>
                                    <div class="flex-1 w-full">
                                        <span class="text-sm font-bold text-[#10B981] capitalize">
                                            Petugas {{ $user['role'] }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Field: Terdaftar Sejak -->
                                <div class="flex flex-col sm:flex-row py-3.5 border-b border-[#F1F5F9] items-center">
                                    <span class="w-48 shrink-0 text-sm font-medium text-[#64748B]">Terdaftar Sejak</span>
                                    <div class="flex-1 w-full">
                                        <p class="text-sm font-semibold text-[#1E293B]">{{ \Carbon\Carbon::parse($user['created_at'])->translatedFormat('d F Y') }}</p>
                                    </div>
                                </div>

                                <!-- Field: Status Akun -->
                                <div class="flex flex-col sm:flex-row py-3.5 border-b border-[#F1F5F9] items-center">
                                    <span class="w-48 shrink-0 text-sm font-medium text-[#64748B]">Status Akun</span>
                                    <div class="flex-1 w-full">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-[#ECFDF5] text-[#10B981]">
                                            Aktif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION: Keamanan & Akses Akun -->
                <div class="bg-white border border-[#E2E8F0] rounded-2xl shadow-sm p-6 flex flex-col md:flex-row gap-6 items-start md:items-center justify-between">
                    <div class="flex items-start gap-4 flex-1">
                        <div class="w-12 h-12 rounded-xl bg-[#ECFDF5] text-[#10B981] flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-[#1E293B]">Keamanan & Akses Akun</h3>
                            <p class="text-sm text-[#64748B] mt-1 line-clamp-2">Informasi terkait keamanan akun dan akses sistem Anda.</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-col gap-4 border-l-0 md:border-l border-[#E2E8F0] pl-0 md:pl-8 shrink-0">
                        <!-- Password Terakhir Diubah -->
                        <div class="flex items-center gap-3">
                            <div class="text-[#64748B]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-[#64748B]">Password Terakhir Diubah</p>
                                <p class="text-sm font-semibold text-[#1E293B]">{{ \Carbon\Carbon::parse($user['updated_at'])->translatedFormat('d M Y') }}</p>
                            </div>
                        </div>

                        <!-- Login Terakhir -->
                        <div class="flex items-center gap-3">
                            <div class="text-[#64748B]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-[#64748B]">Login Terakhir</p>
                                <p class="text-sm font-semibold text-[#1E293B]">{{ now()->translatedFormat('d M Y, H:i') }} WIB</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- INFO BAR -->
                <div class="bg-[#F8FAFC] border border-[#E2E8F0] rounded-2xl p-4 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-[#10B981] shrink-0">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                    <p class="text-sm text-[#475569]">Pastikan informasi profil Anda selalu diperbarui agar sistem dapat digunakan secara optimal.</p>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
