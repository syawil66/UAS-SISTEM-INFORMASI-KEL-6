<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilSekolahController;
use App\Http\Controllers\TahunPelajaranController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\GuruSiswaController;
use App\Http\Controllers\GuruJadwalController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruNilaiController;
use App\Http\Controllers\RekapNilaiController;
use App\Http\Controllers\JadwalPelajaranController;


// ==========================
// RUTE UNTUK TAMU
// ==========================
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

// ==========================
// RUTE UNTUK USER LOGIN
// ==========================
Route::middleware('auth')->group(function () {

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Profil Sekolah
    Route::get('/profil-sekolah', [ProfilSekolahController::class, 'index'])->name('profilSekolah.index');

    // ==========================
    // RUTE ADMIN
    // ==========================
    Route::middleware('role:admin')->group(function () {

        // Profil Sekolah
        Route::get('/profil-sekolah/edit', [ProfilSekolahController::class, 'edit'])->name('profilSekolah.edit');
        Route::put('/profil-sekolah', [ProfilSekolahController::class, 'update'])->name('profilSekolah.update');

        // Tahun Pelajaran
        Route::get('/tahun-pelajaran', [TahunPelajaranController::class, 'index'])->name('tahunPelajaran');
        Route::post('/tahun-pelajaran', [TahunPelajaranController::class, 'store'])->name('tahunPelajaran.store');
        Route::put('/tahun-pelajaran/{id}', [TahunPelajaranController::class, 'update'])->name('tahunPelajaran.update');
        Route::delete('/tahun-pelajaran/{id}', [TahunPelajaranController::class, 'destroy'])->name('tahunPelajaran.destroy');

        // Data Akademik
        Route::prefix('data-akademik')->name('akademik.')->group(function () {

            // Mata Pelajaran
            Route::get('/matapelajaran', [MataPelajaranController::class, 'index'])->name('matapelajaran.index');
            Route::get('/matapelajaran/create', [MataPelajaranController::class, 'create'])->name('matapelajaran.create');
            Route::post('/matapelajaran', [MataPelajaranController::class, 'store'])->name('matapelajaran.store');
            Route::get('/matapelajaran/{id}/edit', [MataPelajaranController::class, 'edit'])->name('matapelajaran.edit');
            Route::put('/matapelajaran/{id}', [MataPelajaranController::class, 'update'])->name('matapelajaran.update');
            Route::delete('/matapelajaran/{id}', [MataPelajaranController::class, 'destroy'])->name('matapelajaran.destroy');
           




            // Kelas
            Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
            Route::get('/kelas/create', [KelasController::class, 'create'])->name('kelas.create');
            Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');
            Route::get('/kelas/{id}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
            Route::put('/kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');
            Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');
        });

        // Data Guru
        Route::resource('/data-guru', GuruController::class)->names([
            'index' => 'guru.index',
            'create' => 'guru.create',
            'store' => 'guru.store',
            'show' => 'guru.show',
            'edit' => 'guru.edit',
            'update' => 'guru.update',
            'destroy' => 'guru.destroy',
        ]);
    });

    // Resource Siswa (Admin)
    Route::resource('siswa', SiswaController::class);
    // Rekap Nilai Admin
Route::get('/admin/nilai', [RekapNilaiController::class, 'index'])->name('admin.nilai');
Route::get('/rekap-nilai', function () {
    return 'Halaman Rekap Nilai'; // sementara biar tidak error
})->name('rekap.nilai');

Route::middleware(['auth', 'role:guru'])->group(function () {

    Route::get('/guru/jadwal', [JadwalPelajaranController::class, 'index'])
        ->name('guru.jadwal.index');

});



Route::middleware(['auth', 'role:guru'])->group(function () {

    // HALAMAN LIST JADWAL
    Route::get('/guru/jadwal', [JadwalPelajaranController::class, 'index'])
        ->name('guru.jadwal.index');

    // HALAMAN FORM TAMBAH JADWAL
    Route::get('/guru/jadwal/create', [JadwalPelajaranController::class, 'create'])
        ->name('guru.jadwal.create');

    // SIMPAN JADWAL
    Route::post('/guru/jadwal', [JadwalPelajaranController::class, 'store'])
        ->name('guru.jadwal.store');
});

});


// ==========================
// RUTE UNTUK GURU
// ==========================
Route::prefix('guru')->middleware(['auth', 'role:guru'])->group(function () {

    // Data Siswa
    Route::get('/siswa', [GuruSiswaController::class, 'index'])->name('guru.siswa.index');
    Route::get('/siswa/{id}/edit', [GuruSiswaController::class, 'edit'])->name('guru.siswa.edit');

    // Input Nilai
    Route::get('/nilai', [GuruNilaiController::class, 'index'])->name('guru.nilai.index');
    Route::post('/nilai', [GuruNilaiController::class, 'store'])->name('guru.nilai.store');
});


Route::middleware(['auth', 'role:guru'])->group(function () {

    Route::get('/guru/jadwal', [JadwalPelajaranController::class, 'index'])
        ->name('guru.jadwal.index');

    Route::get('/guru/jadwal/create', [JadwalPelajaranController::class, 'create'])
        ->name('guru.jadwal.create');

    Route::post('/guru/jadwal', [JadwalPelajaranController::class, 'store'])
        ->name('guru.jadwal.store');

});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
