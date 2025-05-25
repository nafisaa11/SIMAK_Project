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

    public function frs()
    {
        return $this->hasOne(Frs::class, 'id_nilai');
    }

    public function getNilaiHurufAttribute()
    {
        $nilai = $this->nilai_angka;

        return match (true) {
            $nilai >= 86 => 'A',
            $nilai >= 81 => 'A-',
            $nilai >= 76 => 'AB',
            $nilai >= 71 => 'B+',
            $nilai >= 66 => 'B',
            $nilai >= 61 => 'BC',
            $nilai >= 56 => 'C',
            $nilai >= 41 => 'D',
            default => 'E',
        };
    }

    public function getBobot()
    {
        return match ($this->nilai_huruf) {
            'A'  => 4.00,
            'A-' => 3.75,
            'AB' => 3.50,
            'B+' => 3.25,
            'B'  => 3.00,
            'BC' => 2.50,
            'C'  => 2.00,
            'D'  => 1.00,
            'E'  => 0.00,
            default => 0.00,
        };
    }

}
