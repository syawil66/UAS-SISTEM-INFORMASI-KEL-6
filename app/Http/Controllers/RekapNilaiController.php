<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;

class RekapNilaiController extends Controller
{
    public function index()
    {
        // Ambil semua nilai + relasi siswa
        $nilai = Nilai::with('siswa')->get();

        return view('admin.nilai.rekap', compact('nilai'));
    }
}
