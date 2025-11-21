<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Jika user adalah guru, muat relasi 'guru'
        if ($user->role == 'guru') {
            $user->load('guru');
        }

        return view('profile.index', compact('user'));
    }

    /**
     * Tampilkan Form Edit
     */
    public function edit()
    {
        $user = Auth::user();
        if ($user->role == 'guru') {
            $user->load('guru');
        }
        return view('profile.edit', compact('user'));
    }

    /**
     * Simpan Perubahan
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // 1. Validasi Dasar (User)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // 2. Validasi Tambahan (Khusus Guru)
        if ($user->role == 'guru') {
            $request->validate([
                'no_hp' => 'nullable|string|max:15',
                'alamat_lengkap' => 'nullable|string',
            ]);
        }

        // 3. Update Foto (Jika ada upload baru)
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika bukan default
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }
            // Simpan foto baru
            $path = $request->file('foto')->store('foto_profil', 'public');
            $user->foto = $path;
        }

        // 4. Update Data User (Akun)
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // 5. Update Data Guru (Jika role guru)
        if ($user->role == 'guru' && $user->guru) {
            $user->guru->update([
                'no_hp' => $request->no_hp,
                'alamat_lengkap' => $request->alamat_lengkap,
            ]);
        }

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
