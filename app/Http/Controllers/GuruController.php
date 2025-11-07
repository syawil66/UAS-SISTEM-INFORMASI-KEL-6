<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;

class GuruController extends Controller
{
    /**
     * Tampilkan halaman daftar guru.
     */
    public function index(Request $request) // <-- Tambahkan Request $request
    {
        // Ambil input filter dari request
        $searchTerm = $request->input('search');
        $statusAktif = $request->input('status_aktif');

        // Mulai query builder
        $query = Guru::query();

        // 1. Filter berdasarkan Search Term (Nama, NIP, Bidang Ajar)
        if ($searchTerm) {
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_guru', 'like', "%{$searchTerm}%")
                ->orWhere('nip', 'like', "%{$searchTerm}%")
                ->orWhere('bidang_ajar', 'like', "%{$searchTerm}%");
            });
        }

        // 2. Filter berdasarkan Status Aktif
        if ($statusAktif) {
            $query->where('status_aktif', $statusAktif);
        }

        // Ambil hasil setelah difilter dan urutkan
        $gurus = $query->orderBy('nama_guru', 'asc')->get();

        // Kirim data guru DAN nilai filter ke view (agar form tetap terisi)
        return view('guru.index', compact('gurus', 'searchTerm', 'statusAktif'));
    }

    /**
     * Tampilkan halaman form tambah guru.
     */
    public function create()
    {
        // Data untuk dropdown
        $dropdownData = [
            'status_kepegawaian' => ['PNS', 'Honorer', 'GTT', 'Lainnya'],
            'golongan' => ['III/a', 'III/b', 'III/c', 'III/d', 'IV/a', 'Lainnya'],
            'status_aktif' => ['Aktif', 'Tidak Aktif']
        ];
        return view('guru.create', compact('dropdownData'));
    }

    /**
     * Simpan data guru baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'nama_guru' => 'required|string|max:255',
            'nip' => 'required|string|max:20|unique:gurus,nip',
            'email' => 'required|email|max:255|unique:gurus,email',
            'no_hp' => 'nullable|string|max:15',
            'status_kepegawaian' => 'required|string',
            'golongan' => 'nullable|string',
            'bidang_ajar' => 'required|string',
            'status_aktif' => 'required|string',
            'alamat_lengkap' => 'nullable|string',
            'npwp' => 'nullable|string|max:20',
            'no_rekening' => 'nullable|string|max:30',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $pathFoto = null;
        // 2. Handle Upload Foto (jika ada)
        if ($request->hasFile('foto')) {
            // Simpan file ke storage/app/public/foto_guru
            $pathFoto = $request->file('foto')->store('foto_guru', 'public');
        }

        // 3. Buat dan Simpan Data
        Guru::create([
            'nama_guru' => $request->nama_guru,
            'nip' => $request->nip,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'status_kepegawaian' => $request->status_kepegawaian,
            'golongan' => $request->golongan,
            'bidang_ajar' => $request->bidang_ajar,
            'status_aktif' => $request->status_aktif,
            'alamat_lengkap' => $request->alamat_lengkap,
            'npwp' => $request->npwp,
            'no_rekening' => $request->no_rekening,
            'foto' => $pathFoto,
            'is_wali_kelas' => $request->has('is_wali_kelas') ? true : false,
        ]);

        // 4. Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    /**
     * Tampilkan halaman detail untuk satu guru.
     */
    public function show(Guru $guru)
    {
        return view('guru.show', compact('guru'));
    }

    /**
     * Tampilkan halaman form edit guru.
     */
    public function edit(Guru $guru)
    {
        // Data untuk dropdown (sama seperti create)
        $dropdownData = [
            'status_kepegawaian' => ['PNS', 'Honorer', 'GTT', 'Lainnya'],
            'golongan' => ['III/a', 'III/b', 'III/c', 'III/d', 'IV/a', 'Lainnya'],
            'status_aktif' => ['Aktif', 'Tidak Aktif']
        ];

        // Kirim data guru yang mau diedit DAN data dropdown ke view
        return view('guru.edit', compact('guru', 'dropdownData'));
    }

    /**
     * Update data guru yang ada di database.
     */
    public function update(Request $request, Guru $guru)
    {
        // 1. Validasi
        $request->validate([
            'nama_guru' => 'required|string|max:255',
            'nip' => 'required|string|max:20|unique:gurus,nip,' . $guru->id,
            'email' => 'required|email|max:255|unique:gurus,email,' . $guru->id,
            'no_hp' => 'nullable|string|max:15',
            'status_kepegawaian' => 'required|string',
            'golongan' => 'nullable|string',
            'bidang_ajar' => 'required|string',
            'status_aktif' => 'required|string',
            'alamat_lengkap' => 'nullable|string',
            'npwp' => 'nullable|string|max:20',
            'no_rekening' => 'nullable|string|max:30',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Siapkan data (sama seperti store)
        $dataToUpdate = $request->except('foto'); // Ambil semua kecuali foto
        $dataToUpdate['is_wali_kelas'] = $request->has('is_wali_kelas') ? true : false;

        // 3. Handle Upload Foto (jika ada foto baru)
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($guru->foto) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($guru->foto);
            }

            // Simpan file baru
            $pathFoto = $request->file('foto')->store('foto_guru', 'public');
            $dataToUpdate['foto'] = $pathFoto;
        }

        // 4. Update Data di Database
        $guru->update($dataToUpdate);

        // 5. Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(Guru $guru)
    {
        // 1. Hapus foto dari storage (jika ada)
        if ($guru->foto) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($guru->foto);
        }

        // 2. Hapus data dari database
        $guru->delete();

        // 3. Redirect kembali dengan pesan sukses
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
