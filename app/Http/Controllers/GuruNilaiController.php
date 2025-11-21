<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Nilai;
use Illuminate\Http\Request;

class GuruNilaiController extends Controller
{
    public function index()
    {
        $siswas = Siswa::orderBy('nama')->get();
        return view('guru.nilai.index', compact('siswas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required',
            'mapel'    => 'required',
            'kelas'    => 'required',
            'nilai'    => 'required|integer|min:0|max:100',
        ]);

        Nilai::create($request->all());

        return redirect()->back()->with('success', 'Nilai berhasil disimpan');
    }
}
