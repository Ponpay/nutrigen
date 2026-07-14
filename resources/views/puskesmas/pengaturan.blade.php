@extends('layouts.puskesmas')
@section('page-title', 'Pengaturan')
@section('page-mode', 'app')
@section('content')

{{-- Backend Contract:
    Controller: PuskesmasPengaturanController@index
    Expected Variables: $puskesmas, $petugas
--}}

<!-- Full-viewport Split View: Institution Management -->
<div class="flex flex-col lg:flex-row flex-1 overflow-hidden">

    <!-- LEFT PANEL: Settings Navigation -->
    <div class="w-full lg:w-[260px] xl:w-[280px] flex flex-col border-r border-slate-200 bg-slate-50/60 shrink-0 overflow-hidden">

        <!-- Panel Header -->
        <div class="bg-slate-50 border-b border-slate-200 px-5 pt-5 pb-4">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-0.5">Institution</p>
            <h2 class="text-base font-bold text-slate-800">Pengaturan</h2>
        </div>

        <!-- Nav Menu -->
        <nav class="p-3 flex flex-col gap-1 overflow-y-auto">
            <a href="#profil" id="nav-profil" class="settings-nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all bg-white text-teal-700 shadow-sm border border-slate-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                </svg>
                <span>Profil Institusi</span>
            </a>
            <a href="#petugas" id="nav-petugas" class="settings-nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-500 hover:text-slate-800 hover:bg-white hover:shadow-sm border border-transparent hover:border-slate-200 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
                <span>Profil Petugas</span>
            </a>
            <a href="#keamanan" id="nav-keamanan" class="settings-nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-500 hover:text-slate-800 hover:bg-white hover:shadow-sm border border-transparent hover:border-slate-200 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                </svg>
                <span>Keamanan Akun</span>
            </a>
            <a href="#notifikasi" id="nav-notifikasi" class="settings-nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-500 hover:text-slate-800 hover:bg-white hover:shadow-sm border border-transparent hover:border-slate-200 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                </svg>
                <span>Notifikasi</span>
            </a>

            <div class="border-t border-slate-200 mt-2 pt-2">
                <p class="px-4 py-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Sistem</p>
                <a href="#informasi" id="nav-informasi" class="settings-nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-500 hover:text-slate-800 hover:bg-white hover:shadow-sm border border-transparent hover:border-slate-200 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                    <span>Informasi Sistem</span>
                </a>
            </div>
        </nav>
    </div><!-- end left panel -->

    <!-- RIGHT PANEL: Settings Form Canvas -->
    <div class="flex-1 flex flex-col overflow-y-auto bg-slate-50/30">

        <!-- Form Canvas: Padded content area -->
        <div class="max-w-3xl w-full mx-auto my-0 lg:my-6 bg-white lg:border lg:border-slate-200 lg:rounded-3xl lg:shadow-sm px-6 py-8 lg:px-12 lg:py-12 flex flex-col gap-16">

            <!-- SECTION: Profil Institusi -->
            <section id="profil">
                <div class="mb-6">
                    <h3 class="text-xl font-extrabold text-slate-800">Profil Institusi</h3>
                    <p class="text-sm text-slate-500 mt-1">Informasi resmi puskesmas yang tercatat pada sistem NutriGen.</p>
                </div>

                <!-- Logo Upload -->
                <div class="flex items-start gap-5 p-5 bg-slate-50 border border-slate-200 rounded-2xl mb-6">
                    <div class="w-16 h-16 rounded-xl bg-teal-100 text-teal-600 flex items-center justify-center border border-teal-200/60 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-800">Logo Puskesmas</p>
                        <p class="text-xs text-slate-500 mt-0.5 mb-3">Logo resmi yang ditampilkan pada laporan PDF.</p>
                        <button type="button" class="px-4 py-2 text-sm font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-100 shadow-sm transition-colors">
                            Ganti Logo
                        </button>
                    </div>
                </div>

                <!-- Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col gap-2.5">
                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wide">Nama Puskesmas</label>
                        <input type="text" value="Puskesmas Melati" class="w-full px-4 py-3 text-sm bg-white border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500 transition shadow-sm font-medium">
                    </div>
                    <div class="flex flex-col gap-2.5">
                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wide">Kode Registrasi</label>
                        <input type="text" value="P117101" disabled class="w-full px-4 py-3 text-sm bg-slate-100 border border-slate-200 rounded-xl text-slate-400 cursor-not-allowed font-medium">
                    </div>
                    <div class="flex flex-col gap-2.5 md:col-span-2">
                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wide">Alamat</label>
                        <textarea rows="3" class="w-full px-4 py-3 text-sm bg-white border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500 transition shadow-sm resize-none font-medium">Jl. Teuku Umar No. 15, Kec. Baiturrahman, Kota Banda Aceh</textarea>
                    </div>
                </div>

                <!-- Save Action -->
                <div class="flex justify-end mt-8 pt-6 border-t border-slate-100">
                    <button type="button" class="px-6 py-3 text-sm font-bold text-white bg-teal-600 hover:bg-teal-700 rounded-xl shadow-sm transition-all hover:-translate-y-px active:translate-y-0">
                        Simpan Perubahan
                    </button>
                </div>
            </section>

            <!-- SECTION: Profil Petugas -->
            <section id="petugas">
                <div class="mb-6 pb-4 border-t border-slate-200 pt-6">
                    <h3 class="text-xl font-extrabold text-slate-800">Profil Petugas</h3>
                    <p class="text-sm text-slate-500 mt-1">Data identitas petugas yang terdaftar sebagai pengelola portal.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col gap-2.5">
                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wide">Nama Lengkap</label>
                        <input type="text" value="Dr. Siti Rahma, S.Gz" class="w-full px-4 py-3 text-sm bg-white border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500 transition shadow-sm font-medium">
                    </div>
                    <div class="flex flex-col gap-2.5">
                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wide">NIP / NIK</label>
                        <input type="text" value="198505152009012003" class="w-full px-4 py-3 text-sm bg-white border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500 transition shadow-sm font-medium">
                    </div>
                    <div class="flex flex-col gap-2.5">
                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wide">Email</label>
                        <input type="email" value="siti.rahma@puskesmas.id" class="w-full px-4 py-3 text-sm bg-white border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500 transition shadow-sm font-medium">
                    </div>
                    <div class="flex flex-col gap-2.5">
                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wide">No. HP</label>
                        <input type="text" value="+62 813-1234-5678" class="w-full px-4 py-3 text-sm bg-white border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500 transition shadow-sm font-medium">
                    </div>
                </div>

                <div class="flex justify-end mt-8 pt-6 border-t border-slate-100">
                    <button type="button" class="px-6 py-3 text-sm font-bold text-white bg-teal-600 hover:bg-teal-700 rounded-xl shadow-sm transition-all hover:-translate-y-px active:translate-y-0">
                        Simpan Perubahan
                    </button>
                </div>
            </section>

            <!-- SECTION: Informasi Sistem -->
            <section id="informasi">
                <div class="mb-5 pb-4 border-t border-slate-200 pt-6">
                    <h3 class="text-xl font-extrabold text-slate-800">Informasi Sistem</h3>
                    <p class="text-sm text-slate-500 mt-1">Versi aplikasi dan status layanan NutriGen.</p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5">
                        <p class="text-xs text-slate-500 uppercase tracking-wide font-bold">Versi</p>
                        <p class="text-sm font-bold text-slate-800 mt-1.5">NutriGen v2.0.0</p>
                    </div>
                    <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5">
                        <p class="text-xs text-slate-500 uppercase tracking-wide font-bold">Status</p>
                        <div class="flex items-center gap-2 mt-1.5">
                            <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full"></span>
                            <p class="text-sm font-bold text-emerald-700">Operasional</p>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div><!-- end right panel -->

</div><!-- end split view -->

@endsection
