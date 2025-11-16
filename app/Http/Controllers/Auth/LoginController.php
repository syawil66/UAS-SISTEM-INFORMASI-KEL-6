<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman form login.
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
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Jika berhasil...
            $request->session()->regenerate();
            $user = Auth::user();

            // 4. Arahkan berdasarkan peran (role)
            if ($user->role == 'admin') {
                return redirect()->route('dashboard');
            }

            if ($user->role == 'guru') {
                return redirect()->route('dashboard');
            }

            return redirect('/');
        }

        // Jika gagal...
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

        return redirect('/login');
    }
}
