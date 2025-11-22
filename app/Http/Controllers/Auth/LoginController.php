<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan halaman form login.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Menangani proses autentikasi (login).
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Coba lakukan login manual
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Jika berhasil login...
            $request->session()->regenerate();

            // 3. Cek Peran (Role) untuk Redirect
            $user = Auth::user();

            // Cek Status Aktif
            if ($user->status_aktif !== 'Aktif') {
                Auth::logout();
                return back()->withErrors(['email' => 'Akun Anda tidak aktif. Hubungi Admin.']);
            }

            // Redirect Berdasarkan Role
            if ($user->role == 'admin') {
                return redirect()->route('dashboard');
            }

            if ($user->role == 'guru') {
                // Guru juga ke dashboard (yang nanti isinya menyesuaikan)
                return redirect()->route('dashboard');
            }

            // Default
            return redirect()->route('dashboard');
        }

        // 4. Jika gagal login...
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Menangani proses logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login
        return redirect()->route('login');
    }
}
