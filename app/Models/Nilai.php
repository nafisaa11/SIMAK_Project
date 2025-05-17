<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Nilai extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_nilai';

    protected $fillable = [
        'id_mahasiswa',
        'id_matkul',
        'nilai_angka',
        'nilai_huruf',
    ];

    // Mengambil nrp, nama, kelas, prodi mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function matkul()
    {
        return $this->belongsTo(Matkul::class, 'id_matkul');
    }
}
