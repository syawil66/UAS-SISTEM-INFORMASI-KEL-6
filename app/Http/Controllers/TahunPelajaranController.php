<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunPelajaran;

class TahunPelajaranController extends Controller
{
    public function index()
    {
        $semuaTahunPelajaran = TahunPelajaran::all();
        return view('tahunPelajaran', compact('semuaTahunPelajaran'));
    }

    /**
     * Menyimpan data baru (Tambah)
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'tahun_pelajaran' => 'required|string|max:10',
            'semester' => 'required|string',
        ]);

        // Jika user meng-check "Aktifkan",
        // non-aktifkan semua tahun pelajaran lainnya dulu.
        if ($request->status == 'Aktif') {
            TahunPelajaran::query()->update(['status' => 'Tidak Aktif']);
        }

        TahunPelajaran::create([
            'tahun_pelajaran' => $request->tahun_pelajaran,
            'semester' => $request->semester,
            'status' => $request->status ?? 'Tidak Aktif',
        ]);

        return redirect()->route('tahunPelajaran')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Memperbarui data (Edit)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tahun_pelajaran' => 'required|string|max:10',
            'semester' => 'required|string',
        ]);

        $tahunPelajaran = TahunPelajaran::findOrFail($id);

        // Jika user meng-check "Aktifkan",
        // non-aktifkan semua tahun pelajaran lainnya dulu.
        if ($request->status == 'Aktif') {
            TahunPelajaran::where('id', '!=', $id)->update(['status' => 'Tidak Aktif']);
        }

        $tahunPelajaran->update([
            'tahun_pelajaran' => $request->tahun_pelajaran,
            'semester' => $request->semester,
            'status' => $request->status ?? 'Tidak Aktif',
        ]);

        return redirect()->route('tahunPelajaran')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Menghapus data (Hapus)
     */
    public function destroy($id)
    {
        $tahunPelajaran = TahunPelajaran::findOrFail($id);
        $tahunPelajaran->delete();

        return redirect()->route('tahunPelajaran')->with('success', 'Data berhasil dihapus.');
    }
}

