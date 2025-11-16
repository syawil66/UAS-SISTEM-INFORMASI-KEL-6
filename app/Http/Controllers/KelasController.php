<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('akademik.kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('akademik.kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'wali_kelas' => 'required',
            'nama_kelas' => 'required',
            'jurusan' => 'required',
            'jumlah_siswa' => 'required|integer',
        ]);

        Kelas::create($request->all());
        return redirect()->route('akademik.kelas.index')->with('success', 'Data kelas berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('akademik.kelas.edit', compact('kelas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'wali_kelas' => 'required',
            'nama_kelas' => 'required',
            'jurusan' => 'required',
            'jumlah_siswa' => 'required|integer',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update($request->all());

        return redirect()->route('akademik.kelas.index')->with('success', 'Data kelas berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('akademik.kelas.index')->with('success', 'Data kelas berhasil dihapus');
    }
}
