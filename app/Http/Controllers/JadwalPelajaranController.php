<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Guru;

class JadwalPelajaranController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data untuk dropdown
        $dataKelas = Kelas::all();
        $dataMapel = MataPelajaran::all();
        $dataGuru  = Guru::with('user')->get();

        // Logika Filter Kelas
        $jadwal = [];
        $kelasTerpilih = null;

        if ($request->has('kelas_id')) {
            $kelasTerpilih = Kelas::find($request->kelas_id);
            if ($kelasTerpilih) {
                $jadwal = JadwalPelajaran::with(['mapel', 'guru.user'])
                    ->where('kelas_id', $kelasTerpilih->id)
                    ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')")
                    ->orderBy('jam_mulai')
                    ->get();
            }
        }

        return view('jadwalPelajaran.index', compact('dataKelas', 'dataMapel', 'dataGuru', 'jadwal', 'kelasTerpilih'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'mapel_id' => 'required',
            'guru_id' => 'required',
        ]);

        JadwalPelajaran::create([
            'kelas_id' => $request->kelas_id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'mata_pelajaran_id' => $request->mapel_id,
            'mapel_id' => $request->mapel_id,
            'mata_pelajaran_id' => $request->mapel_id,
            'guru_id' => $request->guru_id,
        ]);


        return redirect()->route('jadwalPelajaran.index', ['kelas_id' => $request->kelas_id])
                         ->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $jadwal = JadwalPelajaran::findOrFail($id);
        $kelas_id = $jadwal->kelas_id;
        $jadwal->delete();

        return redirect()->route('jadwalPelajaran.index', ['kelas_id' => $kelas_id])
                         ->with('success', 'Jadwal berhasil dihapus');
    }
}
