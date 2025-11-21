<?php

namespace App\Http\Controllers;

use App\Models\JadwalPelajaran;
use App\Models\User;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalPelajaranController extends Controller
{
    // HALAMAN JADWAL UNTUK GURU
    public function index()
    {
        // ID user yang login
        $guruId = Auth::user()->id;

        // Ambil jadwal berdasarkan guru_id
        $jadwal = JadwalPelajaran::with(['mapel', 'kelas'])
            ->where('guru_id', $guruId)
            ->get();

        return view('guru.jadwal.index', compact('jadwal'));
    }

    // HALAMAN FORM INPUT JADWAL (KHUSUS ADMIN)
    public function create()
    {
        return view('jadwal.create', [
            'gurus' => User::where('role', 'guru')->get(),
            'mapels' => MataPelajaran::all(),
            'kelas' => Kelas::all(),
        ]);
    }

    // SIMPAN JADWAL
    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'guru_id' => 'required',
            'mapel_id' => 'required',
            'kelas_id' => 'required',
        ]);

        JadwalPelajaran::create($request->all());

        return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan');
    }
}
