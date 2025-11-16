<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  ...$roles (Ini akan berisi 'admin' atau 'guru')
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Cek apakah rolenya sesuai dengan yang diizinkan
        foreach ($roles as $role) {
            if (Auth::user()->role == $role) {
                return $next($request);
            }
        }
        // 3. Jika tidak sesuai, tolak akses
        abort(403, 'Akses Ditolak. Anda tidak memiliki hak akses untuk halaman ini.');
    }
}
