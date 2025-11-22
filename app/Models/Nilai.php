<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{

    protected $fillable = [
    'siswa_id',
    'guru_id',
    'mapel_id',
    'kelas_id',
    'nilai_tugas',
    'nilai_uts',
    'nilai_uas'
];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function guru()
{
    return $this->belongsTo(Guru::class, 'guru_id');
}

public function mapel()
{
    return $this->belongsTo(MataPelajaran::class, 'mapel_id');
}

public function kelas()
{
    return $this->belongsTo(Kelas::class, 'kelas_id');
}

}
