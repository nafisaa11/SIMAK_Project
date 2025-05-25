<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Frs extends Model
{
    protected $table = 'frses';
    protected $primaryKey = 'id_frs';
    protected $fillable = [
        'id_nilai',
        'disetujui'
    ];

    // Di dalam model Frs.php
    public function nilai()
    {
        return $this->belongsTo(Nilai::class, 'id_nilai', 'id_nilai');
    }


    // Hapus relasi mahasiswa dan jadwalKuliah yang salah
}

