<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $dataAdmin = [];
        $dataGuru = [];

        // 4. Cek Peran (Role)
        if ($user->role == 'admin') {

            $dataAdmin = [
                'guruAktif' => 20, // Nanti: \App\Models\Guru::where('status_aktif', 'Aktif')->count(),
                'siswaAktif' => 100, // Nanti: \App\Models\Siswa::count(),
                'kelas' => 5, // Nanti: \App\Models\Kelas::count(),
                'ta' => 'Ganjil 2025/2026' // Nanti: \App\Models\TahunPelajaran::where('status','Aktif')->first()->nama
            ];

        } elseif ($user->role == 'guru') {

            $dataGuru = [
                'jamMengajar' => '1 Jam',
                'kelasMengajar' => '1 Kelas',
                'mapelUtama' => 'Matematika',
                'semester' => 'Ganjil'
            ];
        }

        return view('dashboard', compact('dataAdmin', 'dataGuru'));
    }
}
