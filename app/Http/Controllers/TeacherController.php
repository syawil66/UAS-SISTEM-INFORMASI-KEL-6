<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Nilai;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\MataPelajaran;

class TeacherController extends Controller
{
    // ==============================================================
    // 1. FITUR DATA SISWA AJAR
    // ==============================================================
    public function indexSiswa()
    {
        // Ambil data guru yang login
        $guru = Auth::user()->guru;

        // Logika Efisien:
        // Cari ID Kelas yang diajar oleh guru ini berdasarkan Jadwal
        $kelasIds = JadwalPelajaran::where('guru_id', $guru->id)
                    ->pluck('kelas_id')
                    ->unique();

        // Ambil siswa HANYA di kelas yang diajar
        $siswas = Siswa::whereIn('kelas_id', $kelasIds)
                    ->with('kelas') // Load relasi kelas biar nama kelas muncul
                    ->orderBy('kelas_id')
                    ->orderBy('nama')
                    ->get();

        // Arahkan ke folder view yang baru (teacher/siswa/index)
        return view('teacher.siswa.index', compact('siswas'));
    }

    // ==============================================================
    // 2. FITUR JADWAL PELAJARAN
    // ==============================================================
    public function indexJadwal()
    {
        $guru = Auth::user()->guru;

        // Ambil jadwal milik guru ini saja
        $jadwals = JadwalPelajaran::with(['mataPelajaran', 'kelas'])
                    ->where('guru_id', $guru->id)
                    ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')")
                    ->orderBy('jam_mulai')
                    ->get();

        return view('teacher.jadwal.index', compact('jadwals'));
    }


    // ==============================================================
    // 3. FITUR INPUT NILAI
    // ==============================================================
    public function indexNilai(Request $request)
    {
        $guru = Auth::user()->guru;

        // Ambil daftar kelas yang diajar guru ini untuk Dropdown Filter
        // Kita ambil dari jadwal agar akurat
        $listKelas = JadwalPelajaran::where('guru_id', $guru->id)
                    ->with(['kelas', 'mataPelajaran'])
                    ->get()
                    ->unique('kelas_id');

        $selectedKelas = null;
        $siswas = [];

        // Jika Guru sudah memilih kelas dari dropdown
        if ($request->has('kelas_id')) {
            $kelasId = $request->kelas_id;
            $selectedKelas = Kelas::find($kelasId);

            // Ambil siswa di kelas tersebut beserta nilainya (jika sudah ada)
            $siswas = Siswa::where('kelas_id', $kelasId)
                        ->orderBy('nama')
                        ->get();
        }

        return view('teacher.nilai.index', compact('listKelas', 'siswas', 'selectedKelas'));
    }

    public function storeNilai(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|array',
            'kelas_id' => 'required',
            'nilai_tugas.*' => 'nullable|integer|min:0|max:100',
            'nilai_uts.*'   => 'nullable|integer|min:0|max:100',
            'nilai_uas.*'   => 'nullable|integer|min:0|max:100',
        ]);

        // Ambil ID Guru
        $guru = Auth::user()->guru;

        // Cari Mapel yang diajar guru ini di kelas tersebut
        // (Asumsi 1 guru 1 mapel di kelas tsb. Jika lebih kompleks, butuh input mapel_id di form)
        $jadwal = JadwalPelajaran::where('guru_id', $guru->id)
                    ->where('kelas_id', $request->kelas_id)
                    ->first();

        if(!$jadwal) {
            return back()->with('error', 'Anda tidak memiliki jadwal di kelas ini.');
        }

        $mapelId = $jadwal->mata_pelajaran_id; // Atau $jadwal->mapel_id sesuai struktur tabel

        // Loop setiap siswa untuk simpan/update nilai
        foreach ($request->siswa_id as $siswaId) {

            // Siapkan data nilai
            $nilaiData = [
                'nilai_tugas' => $request->nilai_tugas[$siswaId] ?? 0,
                'nilai_uts'   => $request->nilai_uts[$siswaId] ?? 0,
                'nilai_uas'   => $request->nilai_uas[$siswaId] ?? 0,
            ];

            // UpdateOrCreate: Update jika sudah ada, Buat baru jika belum
            Nilai::updateOrCreate(
                [
                    'siswa_id' => $siswaId,
                    'guru_id'  => $guru->id,
                    'mapel_id' => $mapelId, // Pastikan tabel nilai punya mapel_id
                    // 'kelas_id' => $request->kelas_id (Opsional jika struktur tabel butuh)
                ],
                $nilaiData
            );
        }

        return redirect()->back()->with('success', 'Nilai berhasil disimpan.');
    }
}
