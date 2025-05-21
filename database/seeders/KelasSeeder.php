<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kelases')->insert([
            'id_prodi' => 1,
            'id_dosen' => 1,
            'kelas' => 'A',
            'angkatan' => '2023',
        ],
        [
            'id_prodi' => 1,
            'id_dosen' => 2,
            'kelas' => 'B',
            'angkatan' => '2023',
        ],
        [
            'id_prodi' => 2,
            'id_dosen' => 3,
            'kelas' => 'A',
            'angkatan' => '2023',
        ],
        [
            'id_prodi' => 2,
            'id_dosen' => 4,
            'kelas' => 'B',
            'angkatan' => '2023',
        ],
        [
            'id_prodi' => 3,
            'id_dosen' => 5,
            'kelas' => 'A',
            'angkatan' => '2023',
        ],
        [
            'id_prodi' => 3,
            'id_dosen' => 6,
            'kelas' => 'B',
            'angkatan' => '2023',
        ],
        [
            'id_prodi' => 4,
            'id_dosen' => 7,
            'kelas' => 'A',
            'angkatan' => '2023',
        ],
        [
            'id_prodi' => 4,
            'id_dosen' => 8,
            'kelas' => 'B',
            'angkatan' => '2023',
        ],
        [
            'id_prodi' => 5,
            'id_dosen' => 9,
            'kelas' => 'A',
            'angkatan' => '2023',
        ],
        [
            'id_prodi' => 5,
            'id_dosen' => 10,
            'kelas' => 'B',
            'angkatan' => '2023',
        ],
    );
        
    }
}
