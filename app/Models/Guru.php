<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'gurus';

    protected $fillable = [
        'user_id',
        'nip',
        'bidang_ajar',
        'status_kepegawaian',
        'is_wali_kelas',
        'no_hp',
        'npwp',
        'no_rekening',
        'golongan',
        'alamat_lengkap',
    ];

public function mataPelajaran()
    {
        return $this->hasMany(MataPelajaran::class, 'guru_id');
    }

public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function nilai()
{
    return $this->hasMany(Nilai::class, 'guru_id');
}

public function jadwal()
{
    return $this->hasMany(JadwalPelajaran::class);
}


}
