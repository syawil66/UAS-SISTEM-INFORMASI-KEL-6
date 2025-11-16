<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User; // <-- 1. Panggil model User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- 2. Panggil DB
use Illuminate\Support\Facades\Hash; // <-- 3. Panggil Hash
use Illuminate\Support\Facades\Storage; // <-- 4. Panggil Storage

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');
        $statusAktif = $request->input('status_aktif');

        $query = Guru::with('user');

        if ($searchTerm) {
            $query->where(function($q) use ($searchTerm) {
                $q->where('nip', 'like', "%{$searchTerm}%")
                ->orWhere('bidang_ajar', 'like', "%{$searchTerm}%")
                ->orWhereHas('user', function($userQuery) use ($searchTerm) {
                    $userQuery->where('name', 'like', "%{$searchTerm}%");
                });
            });
        }

        if ($statusAktif) {
            $query->whereHas('user', function($userQuery) use ($statusAktif) {
                $userQuery->where('status_aktif', $statusAktif);
            });
        }

        $gurus = $query->get()->sortBy('user.name');
        return view('guru.index', compact('gurus', 'searchTerm', 'statusAktif'));
    }

    public function create()
    {
        $dropdownData = [
            'status_kepegawaian' => ['PNS', 'Honorer', 'GTT', 'Lainnya'],
            'golongan' => ['III/a', 'III/b', 'III/c', 'III/d', 'IV/a', 'Lainnya'],
            'status_aktif' => ['Aktif', 'Tidak Aktif']
        ];
        return view('guru.create', compact('dropdownData'));
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|max:20|unique:gurus,nip',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'no_hp' => 'nullable|string|max:15',
            'status_kepegawaian' => 'required|string',
            'golongan' => 'nullable|string',
            'bidang_ajar' => 'required|string',
            'status_aktif' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $pathFoto = null;
            if ($request->hasFile('foto')) {
                $pathFoto = $request->file('foto')->store('foto_guru', 'public');
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'guru',
                'status_aktif' => $request->status_aktif,
                'foto' => $pathFoto,
            ]);

            $user->guru()->create([
                'nip' => $request->nip,
                'bidang_ajar' => $request->bidang_ajar,
                'status_kepegawaian' => $request->status_kepegawaian,
                'is_wali_kelas' => $request->has('is_wali_kelas') ? true : false,
                'no_hp' => $request->no_hp,
                'npwp' => $request->npwp,
                'no_rekening' => $request->no_rekening,
                'golongan' => $request->golongan,
                'alamat_lengkap' => $request->alamat_lengkap,
            ]);

            DB::commit();
            return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal menyimpan data guru. ' . $e->getMessage()]);
        }
    }

    public function show(Guru $guru)
    {
        $guru->load('user');
        return view('guru.show', compact('guru'));
    }

    public function edit(Guru $guru)
    {
        $guru->load('user');

        $dropdownData = [
            'status_kepegawaian' => ['PNS', 'Honorer', 'GTT', 'Lainnya'],
            'golongan' => ['III/a', 'III/b', 'III/c', 'III/d', 'IV/a', 'Lainnya'],
            'status_aktif' => ['Aktif', 'Tidak Aktif']
        ];

        return view('guru.edit', compact('guru', 'dropdownData'));
    }

    public function update(Request $request, Guru $guru)
    {
        $user = $guru->user;

        $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|max:20|unique:gurus,nip,' . $guru->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'no_hp' => 'nullable|string|max:15',
            'status_kepegawaian' => 'required|string',
            'golongan' => 'nullable|string',
            'bidang_ajar' => 'required|string',
            'status_aktif' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'status_aktif' => $request->status_aktif,
            ];

            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            if ($request->hasFile('foto')) {
                if ($user->foto) {
                    Storage::disk('public')->delete($user->foto);
                }
                $userData['foto'] = $request->file('foto')->store('foto_guru', 'public');
            }

            $user->update($userData);

            $guru->update([
                'nip' => $request->nip,
                'bidang_ajar' => $request->bidang_ajar,
                'status_kepegawaian' => $request->status_kepegawaian,
                'is_wali_kelas' => $request->has('is_wali_kelas') ? true : false,
                'no_hp' => $request->no_hp,
                'npwp' => $request->npwp,
                'no_rekening' => $request->no_rekening,
                'golongan' => $request->golongan,
                'alamat_lengkap' => $request->alamat_lengkap,
            ]);

            DB::commit();
            return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal memperbarui data guru. ' . $e->getMessage()]);
        }
    }

    /**
     * Hapus data guru dari database.
     * FUNGSI INI HARUS DIUBAH (hapus User, bukan Guru)
     */
    public function destroy(Guru $guru)
    {
        DB::beginTransaction();
        try {
            $user = $guru->user;

            // 1. Hapus foto dari storage
            if ($user->foto) {
                Storage::disk('public')->delete($user->foto);
            }

            // 2. Hapus data 'User'.
            // Database akan 'cascade' (otomatis) menghapus data 'Guru' yang terhubung.
            $user->delete();

            DB::commit();
            return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus data guru. ' . $e->getMessage()]);
        }
    }
}
