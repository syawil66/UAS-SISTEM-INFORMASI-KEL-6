<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilSekolahController;
use App\Http\Controllers\TahunPelajaranController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\Guru\DashboardController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\KelasController;

//Rute untuk yang belum login (tamu)
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

//Rute untuk yang sudah login (autentikasi)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//Route Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

//Route Profil Sekolah
Route::get('/profil-sekolah', [ProfilSekolahController::class, 'index'])->name('profilSekolah.index');

//Rute Untuk Admin
Route::middleware('role:admin')->group(function () {

//Route Profil Sekolah
Route::get('/profil-sekolah/edit', [ProfilSekolahController::class, 'edit'])->name('profilSekolah.edit');
Route::put('/profil-sekolah', [ProfilSekolahController::class, 'update'])->name('profilSekolah.update');

//Route Tahun Pelajaran
Route::get('/tahun-pelajaran', [TahunPelajaranController::class, 'index'])->name('tahunPelajaran');
Route::post('/tahun-pelajaran', [TahunPelajaranController::class, 'store'])->name('tahunPelajaran.store');
Route::put('/tahun-pelajaran/{id}', [TahunPelajaranController::class, 'update'])->name('tahunPelajaran.update');
Route::delete('/tahun-pelajaran/{id}', [TahunPelajaranController::class, 'destroy'])->name('tahunPelajaran.destroy');


route::prefix('data-akademik')->name('akademik.')->group(function () {

//Route Mata Pelajaran
Route::get('matapelajaran', [MataPelajaranController::class, 'index'])->name('matapelajaran.index');
Route::get('/matapelajaran/create', [MataPelajaranController::class, 'create'])->name('matapelajaran.create');
Route::post('/matapelajaran', [MataPelajaranController::class, 'store'])->name('matapelajaran.store');
Route::get('/matapelajaran/{id}/edit', [MataPelajaranController::class, 'edit'])->name('matapelajaran.edit');
Route::put('/matapelajaran/{id}', [MataPelajaranController::class, 'update'])->name('matapelajaran.update');
Route::delete('/matapelajaran/{id}', [MataPelajaranController::class, 'destroy'])->name('matapelajaran.destroy');
//Route Kelas
Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
Route::get('/kelas/create', [KelasController::class, 'create'])->name('kelas.create');
Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');
Route::get('/kelas/{id}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
Route::put('/kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');
Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');
});

//Route Data Guru
Route::get('/data-guru', [App\Http\Controllers\GuruController::class, 'index'])->name('guru.index');
Route::get('/data-guru/tambah', [GuruController::class, 'create'])->name('guru.create');
Route::post('/data-guru', [GuruController::class, 'store'])->name('guru.store');
Route::get('/data-guru/{guru}', [GuruController::class, 'show'])->name('guru.show');
Route::get('/data-guru/{guru}/edit', [GuruController::class, 'edit'])->name('guru.edit');
Route::put('/data-guru/{guru}', [GuruController::class, 'update'])->name('guru.update');
Route::delete('/data-guru/{guru}', [GuruController::class, 'destroy'])->name('guru.destroy');
});

});

//Rute untuk Guru
Route::middleware(['auth', 'role:guru'])->group(function () {
    // Tambahkan rute khusus untuk guru di sini
Route::get('/guru/dashboard', [GuruDashboardController::class, 'index'])
    ->middleware(['auth', 'role:guru']);

});
