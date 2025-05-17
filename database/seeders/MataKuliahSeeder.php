<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('matkuls')->insert([
            [
                'id_matkul' => 1,
                'kode_matkul' => 'ITD3001',
                'nama_matkul' => 'Workshop Desain Pengalaman Pengguna',
                'sks' => 2,
            ],
            [
                'id_matkul' => 2,
                'kode_matkul' => 'ITD3002',
                'nama_matkul' => 'Wokrshop Pemrograman Perangkat Bergerak',
                'sks' => 2,
            ],
            [
                'id_matkul' => 3,
                'kode_matkul' => 'ITD3003',
                'nama_matkul' => 'Workshop Pemrograman Framework',
                'sks' => 2,
            ],
            [
                'id_matkul' => 4,
                'kode_matkul' => 'ITD3004',
                'nama_matkul' => 'Workshop Administrasi Jaringan',
                'sks' => 2,
            ],
            [
                'id_matkul' => 5,
                'kode_matkul' => 'ITD3005',
                'nama_matkul' => 'Workshop Pengembangan Perangkat Lunak',
                'sks' => 2,
            ],
            [
                'id_matkul' => 6,
                'kode_matkul' => 'ITD3006',
                'nama_matkul' => 'Workshop Aplikasi dan Komputasi Awan',
                'sks' => 2,
            ],
            [
                'id_matkul' => 7,
                'kode_matkul' => 'ITD3007',
                'nama_matkul' => 'Workshop Administrasi Jaringan',
                'sks' => 2,
            ],
            [
                'id_matkul' => 8,
                'kode_matkul' => 'ITD3008',
                'nama_matkul' => 'Bahasa Indonesia',
                'sks' => 1,
            ],
            [
                'id_matkul' => 9,
                'kode_matkul' => 'ITD3009',
                'nama_matkul' => 'Praktek Kecerdasan Buatan',
                'sks' => 1,
            ],
            [
                'id_matkul' => 10,
                'kode_matkul' => 'ITD3010',
                'nama_matkul' => 'Teori Kecerdasan Buatan',
                'sks' => 1,
            ],
        ]);
    }
}
