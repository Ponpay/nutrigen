<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — NutriGen Kader Module
|--------------------------------------------------------------------------
|
| Named routes follow Laravel resource conventions so future controllers
| can be wired with zero route changes. All route names are declared here
| to serve as the single source of truth for the entire frontend.
|
*/

// ─── Dashboard ────────────────────────────────────────────────────────────────
Route::get('/', function () {
    return view('kader.dashboard');
})->name('dashboard');

// ─── Manajemen Balita ──────────────────────────────────────────────────────────
Route::view('/daftar-balita', 'kader.daftar-balita')->name('balita.index');
Route::view('/daftar-balita-baru', 'kader.daftar-balita-baru')->name('balita.create');

// Placeholder POST route — backend: replace with BalitaController@store
Route::post('/daftar-balita-baru', function () {
    return redirect()->route('balita.index');
})->name('balita.store');

// Edit Balita: reuses the same view with $isEdit=true.
// Production: replace with a controller method that fetches $balita by ID.
Route::view('/edit-balita', 'kader.daftar-balita-baru', ['isEdit' => true])->name('balita.edit');

// ─── Profil & Detail Balita ────────────────────────────────────────────────────
// $id is passed to the view as $balitaId for backend awareness.
// Production: replace with BalitaController@show and remove the dummy @php block.
Route::get('/profil-balita/{id?}', function ($id = null) {
    return view('kader.profil-balita', ['balitaId' => $id]);
})->name('balita.show');

// ─── Jadwal Posyandu ───────────────────────────────────────────────────────────
Route::view('/jadwal', 'kader.jadwal')->name('jadwal.index');

// Production: /detail-jadwal/{id} — ID should be passed by the controller.
Route::view('/detail-jadwal', 'kader.detail-jadwal')->name('jadwal.show');
Route::view('/tambah-jadwal', 'kader.tambah-jadwal')->name('jadwal.create');

// Placeholder POST route — backend: replace with JadwalController@store
Route::post('/tambah-jadwal', function () {
    return redirect()->route('jadwal.index');
})->name('jadwal.store');

// ─── Laporan ───────────────────────────────────────────────────────────────────
Route::view('/laporan', 'kader.laporan')->name('laporan.index');

// ─── Profil Kader ──────────────────────────────────────────────────────────────
Route::view('/profil-kader', 'kader.profil-kader')->name('kader.profil');

// ─── Auth Placeholder ─────────────────────────────────────────────────────────
// Production: replace with Laravel Breeze/Sanctum logout (POST /logout).
// This GET redirect is a prototype-only convenience.
Route::get('/logout', function () {
    return redirect()->route('dashboard');
})->name('logout');