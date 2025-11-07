<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilSekolahController;
use App\Http\Controllers\TahunPelajaranController;
use App\Http\Controllers\GuruController;

//Route Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

//Route Profil Sekolah
Route::get('/profil-sekolah', [ProfilSekolahController::class, 'index'])->name('profilSekolah');

//Route Tahun Pelajaran
Route::get('/tahun-pelajaran', [TahunPelajaranController::class, 'index'])->name('tahunPelajaran');
Route::post('/tahun-pelajaran', [TahunPelajaranController::class, 'store'])->name('tahunPelajaran.store');
Route::put('/tahun-pelajaran/{id}', [TahunPelajaranController::class, 'update'])->name('tahunPelajaran.update');
Route::delete('/tahun-pelajaran/{id}', [TahunPelajaranController::class, 'destroy'])->name('tahunPelajaran.destroy');

//Route Data Guru
Route::get('/data-guru', [App\Http\Controllers\GuruController::class, 'index'])->name('guru.index');
Route::get('/data-guru/tambah', [GuruController::class, 'create'])->name('guru.create');
Route::post('/data-guru', [GuruController::class, 'store'])->name('guru.store');
Route::get('/data-guru/{guru}', [GuruController::class, 'show'])->name('guru.show');
Route::get('/data-guru/{guru}/edit', [GuruController::class, 'edit'])->name('guru.edit');
Route::put('/data-guru/{guru}', [GuruController::class, 'update'])->name('guru.update');
Route::delete('/data-guru/{guru}', [GuruController::class, 'destroy'])->name('guru.destroy');
