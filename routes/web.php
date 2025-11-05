<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilSekolahController;

//Route Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

//Route Profil Sekolah
Route::get('/profil-sekolah', [ProfilSekolahController::class, 'index'])->name('profilSekolah');


