<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosens';
    protected $primaryKey = 'id_dosen';
    protected $fillable = [
        'user_id',
        'nip',
        'no_telp',
        'alamat',
        'jenis_kelamin',
        'agama',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    

}

