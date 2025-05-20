<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalKuliah extends Model
{
    protected $table = 'jadwal_kuliahs';
    protected $primaryKey = 'id_jadwal_kuliah';
    protected $fillable = [
        'id_matkul',
        'id_dosen',
        'id_prodi',
        'hari',
        'ruangan',
        'kelas',
        'semester',
        'jam_awal',
        'jam_akhir'
    ];

    public function matkul()
    {
        return $this->belongsTo(Matkul::class, 'id_matkul');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }
}
