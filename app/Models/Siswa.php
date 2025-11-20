<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nis',
        'nisn',
        'kelas',
        'jurusan',
        'jk',
        'email',
        'no_hp',
        'status',
        'foto'
    ];
}
