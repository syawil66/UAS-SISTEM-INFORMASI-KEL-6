<?php

namespace App\Http\Controllers;

use App\Models\Siswa;

class GuruSiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::orderBy('nama', 'asc')->get();

        return view('guru.siswa.index', compact('siswas'));
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);

        return view('guru.siswa.edit', compact('siswa'));
    }
}
