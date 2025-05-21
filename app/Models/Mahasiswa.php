<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswas';
    protected $primaryKey = 'id_mahasiswa';
    protected $fillable = [
        'user_id',
        'id_kelas',
        'nama',
        'nrp',
        'email',
        'prodi',
        'no_telp',
        'tanggal_lahir',
        'tempat_lahir',
        'jenis_kelamin',
        'agama'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

}
