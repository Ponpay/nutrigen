@extends('layouts.app')

@section('page-title', isset($isEdit) && $isEdit ? 'Edit Data Balita' : 'Daftar Balita Baru')

@section('content')
<div class="flex flex-col w-full bg-slate-50/50 min-h-screen">

    <!-- Header -->
    <div class="bg-white px-5 pt-5 pb-3 shadow-sm border-b border-slate-100 sticky top-0 z-20">
        <div class="max-w-4xl mx-auto w-full flex items-center gap-3">
            <a href="{{ !empty($isEdit) ? route('balita.show') : route('balita.index') }}"
               class="flex flex-shrink-0 items-center justify-center w-11 h-11 -ml-2 text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-full transition-all focus:outline-none focus:ring-2 focus:ring-slate-300"
               aria-label="Kembali">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </a>
            <div>
                <h1 class="text-xl font-extrabold text-slate-800 tracking-tight">
                    {{ isset($isEdit) && $isEdit ? 'Edit Data Balita' : 'Daftar Balita Baru' }}
                </h1>
                <p class="text-xs text-slate-500 font-medium mt-0.5">
                    {{ isset($isEdit) && $isEdit ? 'Perbarui data balita yang sudah terdaftar.' : 'Daftarkan balita baru ke sistem Posyandu.' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="max-w-4xl mx-auto w-full px-5 py-3 flex flex-col gap-5 pb-28">

        {{--
            Backend: Change method to POST and update action:
              Create: action="{{ route('balita.store') }}"   method="POST"
              Edit:   action="{{ route('balita.update', $balita->id) }}"  method="POST"  (+ @method('PUT'))
        --}}
        <form
            action="{{ isset($isEdit) && $isEdit ? route('balita.show') : route('balita.index') }}"
            method="GET">
            {{-- Backend: uncomment @csrf when switching to POST --}}
            {{-- @csrf --}}

            <!-- SECTION 1: Data Balita -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex flex-col gap-4">
                <h2 class="text-[11px] font-extrabold text-slate-500 uppercase tracking-widest flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-teal-500 inline-block"></span>
                    Data Balita
                </h2>

                <!-- Nama Balita -->
                <div class="flex flex-col gap-1.5">
                    <label for="nama_balita" class="text-sm font-semibold text-slate-700">
                        Nama Lengkap Balita <span class="text-rose-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="nama_balita"
                        name="nama_balita"
                        value="{{ $childName ?? '' }}"
                        placeholder="Masukkan nama lengkap balita"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3.5 text-sm font-medium text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-4 focus:ring-teal-500/10 focus:border-teal-400 transition-all"
                        required
                        autocomplete="off">
                </div>

                <!-- NIK Balita -->
                <div class="flex flex-col gap-1.5">
                    <label for="nik_balita" class="text-sm font-semibold text-slate-700">
                        NIK Balita <span class="text-rose-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="nik_balita"
                        name="nik_balita"
                        value="{{ $nik ?? '' }}"
                        placeholder="16 digit NIK balita"
                        maxlength="16"
                        inputmode="numeric"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3.5 text-sm font-medium text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-4 focus:ring-teal-500/10 focus:border-teal-400 transition-all"
                        required>
                </div>

                <!-- Tanggal Lahir & Jenis Kelamin (berdampingan) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="flex flex-col gap-1.5">
                        <label for="tanggal_lahir" class="text-sm font-semibold text-slate-700">
                            Tanggal Lahir <span class="text-rose-500">*</span>
                        </label>
                        <input
                            type="date"
                            id="tanggal_lahir"
                            name="tanggal_lahir"
                            value="{{ $birthDate ?? '' }}"
                            class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-4 focus:ring-teal-500/10 focus:border-teal-400 transition-all"
                            required>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="jenis_kelamin" class="text-sm font-semibold text-slate-700">
                            Jenis Kelamin <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <select
                                id="jenis_kelamin"
                                name="jenis_kelamin"
                                class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3.5 text-sm font-medium text-slate-800 appearance-none focus:outline-none focus:ring-4 focus:ring-teal-500/10 focus:border-teal-400 transition-all"
                                required>
                                <option value="" disabled {{ empty($gender) ? 'selected' : '' }}>Pilih</option>
                                <option value="Laki-laki" {{ ($gender ?? '') === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ ($gender ?? '') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Posyandu -->
                <div class="flex flex-col gap-1.5">
                    <label for="posyandu_id" class="text-sm font-semibold text-slate-700">
                        Posyandu <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <select
                            id="posyandu_id"
                            name="posyandu_id"
                            class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3.5 text-sm font-medium text-slate-800 appearance-none focus:outline-none focus:ring-4 focus:ring-teal-500/10 focus:border-teal-400 transition-all"
                            required>
                            <option value="" disabled {{ empty($posyanduId) ? 'selected' : '' }}>Pilih Posyandu</option>
                            {{-- Backend: @foreach($posyandus as $p) <option value="{{ $p->id }}" {{ $posyanduId == $p->id ? 'selected' : '' }}>{{ $p->nama }}</option> @endforeach --}}
                            <option value="1" {{ ($posyanduId ?? '') == '1' ? 'selected' : '' }}>Posyandu Melati 1</option>
                            <option value="2" {{ ($posyanduId ?? '') == '2' ? 'selected' : '' }}>Posyandu Mawar 2</option>
                        </select>
                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 2: Data Orang Tua / Wali -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex flex-col gap-4 mt-4">
                <h2 class="text-[11px] font-extrabold text-slate-500 uppercase tracking-widest flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-blue-500 inline-block"></span>
                    Data Orang Tua / Wali
                </h2>

                <!-- Nama Ibu -->
                <div class="flex flex-col gap-1.5">
                    <label for="nama_ibu" class="text-sm font-semibold text-slate-700">
                        Nama Ibu <span class="text-rose-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="nama_ibu"
                        name="nama_ibu"
                        value="{{ $motherName ?? '' }}"
                        placeholder="Nama lengkap ibu balita"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3.5 text-sm font-medium text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-4 focus:ring-teal-500/10 focus:border-teal-400 transition-all"
                        required>
                </div>

                <!-- NIK Ibu -->
                <div class="flex flex-col gap-1.5">
                    <label for="nik_ibu" class="text-sm font-semibold text-slate-700">NIK Ibu</label>
                    <input
                        type="text"
                        id="nik_ibu"
                        name="nik_ibu"
                        value="{{ $motherNik ?? '' }}"
                        placeholder="16 digit NIK ibu"
                        maxlength="16"
                        inputmode="numeric"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3.5 text-sm font-medium text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-4 focus:ring-teal-500/10 focus:border-teal-400 transition-all">
                </div>

                <!-- No. HP Ibu -->
                <div class="flex flex-col gap-1.5">
                    <label for="no_hp_ibu" class="text-sm font-semibold text-slate-700">
                        Nomor HP Ibu <span class="text-rose-500">*</span>
                    </label>
                    <input
                        type="tel"
                        id="no_hp_ibu"
                        name="no_hp_ibu"
                        value="{{ $motherPhone ?? '' }}"
                        placeholder="Contoh: 08123456789"
                        inputmode="tel"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3.5 text-sm font-medium text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-4 focus:ring-teal-500/10 focus:border-teal-400 transition-all"
                        required>
                </div>
            </div>

            <!-- SECTION 3: Alamat -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex flex-col gap-4 mt-4">
                <h2 class="text-[11px] font-extrabold text-slate-500 uppercase tracking-widest flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-amber-500 inline-block"></span>
                    Alamat
                </h2>

                <!-- Desa / Kelurahan -->
                <div class="flex flex-col gap-1.5">
                    <label for="desa" class="text-sm font-semibold text-slate-700">Desa / Kelurahan</label>
                    <input
                        type="text"
                        id="desa"
                        name="desa"
                        value="{{ $address ?? '' }}"
                        placeholder="Nama desa atau kelurahan"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3.5 text-sm font-medium text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-4 focus:ring-teal-500/10 focus:border-teal-400 transition-all">
                </div>

                <!-- Kecamatan -->
                <div class="flex flex-col gap-1.5">
                    <label for="kecamatan" class="text-sm font-semibold text-slate-700">Kecamatan</label>
                    <input
                        type="text"
                        id="kecamatan"
                        name="kecamatan"
                        value="{{ $addressSub ?? '' }}"
                        placeholder="Nama kecamatan"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3.5 text-sm font-medium text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-4 focus:ring-teal-500/10 focus:border-teal-400 transition-all">
                </div>
            </div>

            <!-- Keterangan wajib diisi -->
            <p class="text-xs text-slate-400 font-medium mt-3 px-1">
                <span class="text-rose-500">*</span> Wajib diisi
            </p>

            <!-- CTA Button -->
            <div class="mt-8 flex justify-center w-full">
            {{-- Backend: This button submits the form above. Ensure form action is set correctly. --}}
            <button
                type="submit"
                class="w-full sm:max-w-xs flex items-center justify-center gap-2 bg-teal-600 hover:bg-teal-700 text-white px-6 py-4 rounded-full font-bold text-base shadow-lg shadow-teal-500/20 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-teal-500/30">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ isset($isEdit) && $isEdit ? 'Simpan Perubahan' : 'Daftarkan Balita' }}
            </button>
            </div>

        </form>
    </div>

</div>
@endsection
