<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use App\Models\Guru;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function index()
    {
        // Load relasi guru dan user agar nama guru tampil di tabel
        $mataPelajaran = MataPelajaran::with('guru.user')->get();
        return view('akademik.matapelajaran.index', compact('mataPelajaran'));
    }

    public function create()
    {
        // PENTING: Pakai with('user') agar bisa ambil nama dari tabel users
        $gurus = Guru::with('user')->get();
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

        return redirect()->route('akademik.matapelajaran.index')
                        ->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Ubah parameter jadi $id biar lebih aman jika route model binding bermasalah
        $mataPelajaran = MataPelajaran::findOrFail($id);

        // Ambil guru dengan user-nya
        $gurus = Guru::with('user')->get();

        return view('akademik.matapelajaran.edit', compact('mataPelajaran', 'gurus'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mapel' => 'required',
            'kelompok' => 'required',
            'kelas_tingkat' => 'required',
            'semester' => 'required',
            'guru_id' => 'required',
        ]);

        $mataPelajaran = MataPelajaran::findOrFail($id);
        $mataPelajaran->update($request->all());

        return redirect()->route('akademik.matapelajaran.index')
                        ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mataPelajaran = MataPelajaran::findOrFail($id);
        $mataPelajaran->delete();

        return redirect()->route('akademik.matapelajaran.index')
                        ->with('success', 'Data berhasil dihapus.');
    }
}
