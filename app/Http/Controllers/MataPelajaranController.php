<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use App\Models\Guru;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $mataPelajaran = MataPelajaran::all();
        return view('akademik.matapelajaran.index', compact('mataPelajaran'));
    }

    public function create()
    {
        $gurus = Guru::all(); // ambil semua data guru
        return view('akademik.matapelajaran.create', compact('gurus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mapel' => 'required|unique:mata_pelajarans,kode_mapel',
            'nama_mapel' => 'required',
            'kelompok' => 'required',
            'kelas_tingkat' => 'required',
            'semester' => 'required',
            'guru_id' => 'required',
        ]);

        MataPelajaran::create($request->all());
        return redirect()->route('akademik.matapelajaran.index')->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    public function edit(MataPelajaran $mataPelajaran)
    {
        $gurus = Guru::all(); // tambahkan juga agar dropdown guru muncul di edit
        return view('akademik.matapelajaran.edit', compact('mataPelajaran', 'gurus'));
    }

    public function update(Request $request, MataPelajaran $mataPelajaran)
    {
        $request->validate([
            'nama_mapel' => 'required',
            'kelompok' => 'required',
            'kelas_tingkat' => 'required',
            'semester' => 'required',
            'guru_id' => 'required',
        ]);

        $mataPelajaran->update($request->all());
        return redirect()->route('akademik.matapelajaran.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(MataPelajaran $mataPelajaran)
    {
        $mataPelajaran->delete();
        return redirect()->route('akademik.matapelajaran.index')->with('success', 'Data berhasil dihapus.');
    }
}
