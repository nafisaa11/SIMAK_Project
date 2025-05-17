<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosens';
    protected $primaryKey = 'id_dosen';
    protected $fillable = [
        'nama',
        'nip',
        'email',
        'no_telp',
        'alamat',
        'jenis_kelamin',
        'agama'
    ];
}
