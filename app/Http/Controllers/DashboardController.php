<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Import Model
use App\Models\Guru;
use App\Models\TahunPelajaran;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\MataPelajaran;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $dataAdmin = [];
        $dataGuru = [];

        // 1. LOGIKA UNTUK ADMIN
        if ($user->role == 'admin') {

            // Hitung Guru yang akunnya 'Aktif'
            $jumlahGuru = Guru::whereHas('user', function($q) {
                $q->where('status_aktif', 'Aktif');
            })->count();

            // Hitung Siswa yang statusnya 'Aktif'
            $jumlahSiswa = Siswa::where('status', 'Aktif')->count();

            // Hitung Jumlah Kelas
            $jumlahKelas = Kelas::count();

            // Ambil Tahun Pelajaran Aktif
            $tahunAktif = TahunPelajaran::where('status', 'Aktif')->first();
            $taString = $tahunAktif
                ? $tahunAktif->tahun_pelajaran . ' (' . $tahunAktif->semester . ')'
                : 'Belum Diatur';

            // Masukkan ke array dataAdmin
            $dataAdmin = [
                'guruAktif' => $jumlahGuru,
                'siswaAktif' => $jumlahSiswa,
                'kelas' => $jumlahKelas,
                'ta' => $taString
            ];

        // 2. LOGIKA UNTUK GURU
        } elseif ($user->role == 'guru') {

            $profilGuru = $user->guru; // Ambil data dari tabel 'gurus'

            // Ambil Tahun Pelajaran
            $tahunAktif = TahunPelajaran::where('status', 'Aktif')->first();
            $semester = $tahunAktif ? $tahunAktif->semester : '-';

            $mapelUtama = '-';
            $jumlahKelasMengajar = 0;

            // Cek jika profil guru ada
            if ($profilGuru) {
                // Ambil mata pelajaran yang diajar guru ini
                $mapels = MataPelajaran::where('guru_id', $profilGuru->id)->get();

                if ($mapels->isNotEmpty()) {
                    // Ambil nama mapel pertama sebagai mapel utama
                    $mapelUtama = $mapels->first()->nama_mapel;
                    // Hitung jumlah kelas/mapel yang diajar
                    $jumlahKelasMengajar = $mapels->count();
                }
            }

            $dataGuru = [
                'jamMengajar' => '0 Jam', // Masih 0 (karena belum ada tabel jadwal)
                'kelasMengajar' => $jumlahKelasMengajar . ' Kelas', // Data REAL
                'mapelUtama' => $mapelUtama, // Data REAL
                'semester' => $semester // Data REAL
            ];
        }

        return view('dashboard', compact('dataAdmin', 'dataGuru'));
    }
    public function jadwal()
{
    $guru = Auth::user()->guru;

    $jadwal = $guru->jadwal()
        ->with(['mapel', 'kelas'])
        ->orderByRaw("FIELD(hari,'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu')")
        ->orderBy('jam_mulai')
        ->get();

    return view('guru.jadwal.index', compact('jadwal'));
}

}
