<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'gurus';

    protected $fillable = [
        'foto',
        'nama_guru',
        'nip',
        'bidang_ajar',
        'status_kepegawaian',
        'is_wali_kelas',
        'email',
        'no_hp',
        'status_aktif',
        'npwp',
        'no_rekening',
        'golongan',
        'alamat_lengkap',
    ];
}
