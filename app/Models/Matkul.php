<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    protected $table = 'matkuls';
    protected $primaryKey = 'id_matkul';
    protected $fillable = ['kode_matkul', 'nama_matkul', 'sks'];

    
}
