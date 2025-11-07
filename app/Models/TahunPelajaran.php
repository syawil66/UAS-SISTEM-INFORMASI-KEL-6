<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TahunPelajaran extends Model
{
    use HasFactory;

    protected $table = 'tahun_pelajarans';

    protected $fillable = [
        'tahun_pelajaran',
        'semester',
        'status',
    ];
}
