<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodies';
    protected $primaryKey = 'id_prodi';
    protected $fillable = ['kode_prodi', 'nama_prodi', 'jenjang']; 
}
