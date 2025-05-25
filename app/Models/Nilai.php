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
        'id_jadwal_kuliah',
        'nilai_angka',   
    ];

    // Mengambil nrp, nama, kelas, prodi mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }
    

    public function jadwal()
    {
        return $this->belongsTo(JadwalKuliah::class, 'id_jadwal_kuliah');
    }

    public function getNilaiHurufAttribute()
    {
        $nilai = $this->nilai_angka;

        return match (true) {
            $nilai >= 86 => 'A',
            $nilai >= 81 => 'AB',
            $nilai >= 76 => 'A-',
            $nilai >= 71 => 'B+',
            $nilai >= 66 => 'B',
            $nilai >= 61 => 'B-',
            $nilai >= 56 => 'C',
            $nilai >= 41 => 'D',
            default => 'E',
        };
    }
}
