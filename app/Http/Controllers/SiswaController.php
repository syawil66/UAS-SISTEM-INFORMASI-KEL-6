<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::all();
        return view('siswa.index', compact('siswas'));
    }

    public function create()
    {
        $dataKelas = \App\Models\Kelas::all();
        $siswa = new \App\Models\Siswa();
        return view('siswa.create', compact('dataKelas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'nis' => 'required|unique:siswas,nis',
            'nisn' => 'required|unique:siswas,nisn',
            'kelas_id' => 'required|exists:kelas,id',
            'jurusan' => 'required',
            'jk' => 'required',
            'email' => 'required|email|unique:siswas,email',
            'no_hp' => 'required',
            'status' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $infoKelas = \App\Models\Kelas::find($request->kelas_id);
        $validated['kelas'] = $infoKelas->nama_kelas;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFoto = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/siswa'), $namaFoto);
            $validated['foto'] = $namaFoto;
        }

        \App\Models\Siswa::create($validated);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan');
    }

    public function show($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('siswa.show', compact('siswa'));
    }

    public function edit($id)
    {
        $siswa = \App\Models\Siswa::findOrFail($id);
        $dataKelas = \App\Models\Kelas::all();

        return view('siswa.edit', compact('siswa', 'dataKelas'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required',
            'nis' => 'required|unique:siswas,nis,' . $id,
            'nisn' => 'required|unique:siswas,nisn,' . $id,
            'kelas_id' => 'required|exists:kelas,id',
            'jurusan' => 'required',
            'jk' => 'required',
            'email' => 'required|email|unique:siswas,email,' . $id,
            'no_hp' => 'required',
            'status' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $infoKelas = \App\Models\Kelas::find($request->kelas_id);
        $validated['kelas'] = $infoKelas->nama_kelas;

        if ($request->hasFile('foto')) {
            $pathLama = public_path('uploads/siswa/' . $siswa->foto);
            if (File::exists($pathLama) && $siswa->foto) {
                File::delete($pathLama);
            }

            $file = $request->file('foto');
            $namaFoto = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/siswa'), $namaFoto);
            $validated['foto'] = $namaFoto;
        }

        $siswa->update($validated);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);

        $path = public_path('uploads/siswa/' . $siswa->foto);
        if (File::exists($path) && $siswa->foto) {
            File::delete($path);
        }

        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus');
    }
}
