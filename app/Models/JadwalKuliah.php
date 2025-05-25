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
        'id_kelas',
        'hari',
        'ruangan',
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

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    // app/Models/JadwalKuliah.php

    public function nilais()
    {
        return $this->hasMany(\App\Models\Nilai::class, 'id_jadwal_kuliah');
    }

}
