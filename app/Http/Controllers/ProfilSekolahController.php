<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilSekolah;

class ProfilSekolahController extends Controller
{
    public function index()
    {
        $profil = ProfilSekolah::first();

        if (!$profil) {
            $profil = new profilSekolah();
        }

        return view('profilSekolah', compact('profil'));
    }
}
