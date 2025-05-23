<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nilais = [
            [
                'id_mahasiswa' => 1,
                'id_jadwal_kuliah' => 1,
                'nilai_angka' => 85,
                'nilai_huruf' => 'A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_mahasiswa' => 2,
                'id_jadwal_kuliah' => 2,
                'nilai_angka' => 78,
                'nilai_huruf' => 'B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_mahasiswa' => 1,
                'id_jadwal_kuliah' => 3,
                'nilai_angka' => 92,
                'nilai_huruf' => 'A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('nilais')->insert($nilais);
    }
}
