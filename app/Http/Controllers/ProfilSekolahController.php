<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilSekolah;
use Illuminate\Support\Facades\Auth;

class ProfilSekolahController extends Controller
{
    /**
     * Tampilkan halaman 'Lihat Profil' (untuk semua role).
     */
    public function index()
    {
        // Ambil data baris pertama dari tabel profil_sekolah
        // firstOrNew() penting agar tidak error jika tabel masih kosong
        $profil = ProfilSekolah::firstOrNew([]);

        return view('profilSekolah.index', compact('profil'));
    }

    /**
     * Tampilkan halaman 'Form Edit Profil'.
     */
    public function edit()
    {
        // Cek lagi (walau sudah ada middleware)
        if (Auth::user()->role != 'admin') {
            abort(403);
        }

        $profil = ProfilSekolah::firstOrNew([]);
        return view('profilSekolah.edit', compact('profil'));
    }

    /**
     * Simpan perubahan dari form edit.
     */
    public function update(Request $request)
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }

        // Validasi data
        $validatedData = $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'jenjang' => 'nullable|string|max:50',
            'alamat' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'nama_kepala_sekolah' => 'nullable|string|max:255',
        ]);

        ProfilSekolah::updateOrCreate(
            ['id' => 1],
            $validatedData
        );

        return redirect()->route('profilSekolah.index')->with('success', 'Profil sekolah berhasil diperbarui.');
    }
}