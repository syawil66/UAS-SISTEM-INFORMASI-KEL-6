<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilSekolahController;
use App\Http\Controllers\TahunPelajaranController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekapNilaiController;
use App\Http\Controllers\JadwalPelajaranController;


// ==========================
// RUTE UNTUK TAMU
// ==========================
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

// ==========================
// RUTE UNTUK USER LOGIN (SEMUA ROLE)
// ==========================
Route::middleware('auth')->group(function () {

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // --- FITUR UMUM ---

    // Profile User (Edit akun sendiri - Admin & Guru)
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Profil Sekolah (Lihat Data - Semua Role)
    Route::get('/profil-sekolah', [ProfilSekolahController::class, 'index'])->name('profilSekolah.index');


    // ==========================
    // RUTE KHUSUS ADMIN
    // ==========================
    Route::middleware('role:admin')->group(function () {

        // Jadwal Pelajaran
        Route::get('/jadwal-pelajaran', [JadwalPelajaranController::class, 'index'])->name('jadwalPelajaran.index');
        Route::post('/jadwal-pelajaran', [JadwalPelajaranController::class, 'store'])->name('jadwalPelajaran.store');
        Route::delete('/jadwal-pelajaran/{id}', [JadwalPelajaranController::class, 'destroy'])->name('jadwalPelajaran.destroy');

        // Edit Profil Sekolah (Hanya Admin)
        Route::get('/profil-sekolah/edit', [ProfilSekolahController::class, 'edit'])->name('profilSekolah.edit');
        Route::put('/profil-sekolah', [ProfilSekolahController::class, 'update'])->name('profilSekolah.update');

        // Tahun Pelajaran
        Route::get('/tahun-pelajaran', [TahunPelajaranController::class, 'index'])->name('tahunPelajaran');
        Route::post('/tahun-pelajaran', [TahunPelajaranController::class, 'store'])->name('tahunPelajaran.store');
        Route::put('/tahun-pelajaran/{id}', [TahunPelajaranController::class, 'update'])->name('tahunPelajaran.update');
        Route::delete('/tahun-pelajaran/{id}', [TahunPelajaranController::class, 'destroy'])->name('tahunPelajaran.destroy');

        // Data Akademik Group
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
        Route::get('/data-guru', [GuruController::class, 'index'])->name('guru.index');
        Route::get('/data-guru/tambah', [GuruController::class, 'create'])->name('guru.create');
        Route::post('/data-guru', [GuruController::class, 'store'])->name('guru.store');
        Route::get('/data-guru/{guru}', [GuruController::class, 'show'])->name('guru.show');
        Route::get('/data-guru/{guru}/edit', [GuruController::class, 'edit'])->name('guru.edit');
        Route::put('/data-guru/{guru}', [GuruController::class, 'update'])->name('guru.update');
        Route::delete('/data-guru/{guru}', [GuruController::class, 'destroy'])->name('guru.destroy');

        // Data Siswa
        Route::resource('siswa', SiswaController::class);

        // Rekap Nilai
        Route::get('/admin/nilai', [RekapNilaiController::class, 'index'])->name('rekapNilai');
    });


    // ==========================
    // RUTE KHUSUS GURU
    // ==========================
    Route::middleware('role:guru')->prefix('guru')->name('guru.')->group(function () {

        // 1. Data Siswa Ajar
        Route::get('/siswa', [TeacherController::class, 'indexSiswa'])->name('siswa.index');

        // 2. Jadwal Mengajar
        Route::get('/jadwal', [TeacherController::class, 'indexJadwal'])->name('jadwal.index');

        // 3. Input Nilai
        Route::get('/nilai', [TeacherController::class, 'indexNilai'])->name('nilai.index');
        Route::post('/nilai', [TeacherController::class, 'storeNilai'])->name('nilai.store');
    });

});
