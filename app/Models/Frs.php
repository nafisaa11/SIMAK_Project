<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Frs extends Model
{
    protected $table = 'frses';
    protected $primaryKey = 'id_frs';
    protected $fillable = [
        'id_mahasiswa',
        'id_dosen',
        'id_nilai',
        'id_jadwal_kuliah',
        'tahun_ajaran',
        'semester',
        'disetujui'
    ];

    // Mengambil nama mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    // Mengambil nama dosen
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }

    // Mengambil ips mahasiswa
    public function nilai()
    {
        return $this->belongsTo(Nilai::class, 'id_nilai');
    }

    // Mengambil jadwal kuliah
    public function jadwalKuliah()
    {
        return $this->belongsTo(JadwalKuliah::class, 'id_jadwal_kuliah');
    }
}
