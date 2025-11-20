<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
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
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'nis' => 'required|unique:siswas',
            'nisn' => 'required|unique:siswas',
            'kelas' => 'required',
            'jurusan' => 'required',
            'jk' => 'required',
            'email' => 'required|email|unique:siswas',
            'no_hp' => 'required',
            'status' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Upload foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFoto = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/siswa'), $namaFoto);
            $validated['foto'] = $namaFoto;
        }

        Siswa::create($validated);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan');
    }

    public function show($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('siswa.show', compact('siswa'));
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required',
            'nis' => 'required|unique:siswas,nis,' . $id,
            'nisn' => 'required|unique:siswas,nisn,' . $id,
            'kelas' => 'required',
            'jurusan' => 'required',
            'jk' => 'required',
            'email' => 'required|email|unique:siswas,email,' . $id,
            'no_hp' => 'required',
            'status' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // replace foto
        if ($request->hasFile('foto')) {
            $path = public_path('uploads/siswa/' . $siswa->foto);
            if (File::exists($path)) {
                File::delete($path);
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

        // hapus foto
        $path = public_path('uploads/siswa/' . $siswa->foto);
        if (File::exists($path)) {
            File::delete($path);
        }

        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus');
    }
}
