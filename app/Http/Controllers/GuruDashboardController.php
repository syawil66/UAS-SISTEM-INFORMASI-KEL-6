<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\User;
use App\Models\Jadwal;

class GuruDashboardController extends Controller
{
    public function index()
    {
        $idGuru = auth()->user()->id;

        return view('guru.dashboard', [
            'jumlahKelas' => Kelas::where('guru_id', $idGuru)->count(),
            'jumlahMurid' => User::where('role', 'murid')->count(),
            'jadwalHariIni' => Jadwal::where('guru_id', $idGuru)
                                     ->whereDate('tanggal', now()->toDateString())
                                     ->get(),
        ]);
    }
}
