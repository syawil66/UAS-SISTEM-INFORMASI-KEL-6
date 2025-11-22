<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mapel;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Guru;
use App\Models\Nilai;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas';

    protected $fillable = [
        'nama',
        'nis',
        'nisn',
        'email',
        'jk',
        'no_hp',
        'status',
        'foto',
        'kelas',
        'kelas_id',
        'jurusan',
    ];

    // Relasi ke tabel Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    // Relasi ke tabel Mapel
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }

    // Relasi ke Nilai
    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }
}
