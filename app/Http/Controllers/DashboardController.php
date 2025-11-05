<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // $jumlahSiswa = Siswa::count();
        // $jumlahGuru = Guru::count();

        $dataAdmin = [
            'guruAktif' => 20,
            'siswaAktif' => 100,
            'kelas' => 5,
            'ta' => 'Ganjil 2025/2026'
        ];

        $dataSiswa = [];

        return view('dashboard', compact('dataAdmin', 'dataSiswa'));
    }
}
