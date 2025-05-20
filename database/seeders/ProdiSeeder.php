<?php

namespace Database\Seeders;

use App\Models\Prodi; 
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prodies')->insert([
            [
                'id_prodi' => 1,
                'kode_prodi' => 'D3IT',
                'nama_prodi' => 'Teknik Informatika',
                'jenjang' => 'D3',
            ],
            [
                'id_prodi' => 2,
                'kode_prodi' => 'D4IT',
                'nama_prodi' => 'Teknik Informatika',
                'jenjang' => 'D4',
            ],
            [
                'id_prodi' => 3,
                'kode_prodi' => 'SDT',
                'nama_prodi' => 'Sains Data',
                'jenjang' => 'D4',
            ],
            [
                'id_prodi' => 4,
                'kode_prodi' => 'D3CE',
                'nama_prodi' => 'Teknik Komputer',
                'jenjang' => 'D3',
            ],
            [
                'id_prodi' => 5,
                'kode_prodi' => 'D4CE',
                'nama_prodi' => 'Teknik Komputer',
                'jenjang' => 'D4',
            ],
        ]);
    }
}
