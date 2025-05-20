<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $mahasiswas =[

            [
                'user_id' => 6,
                'nrp' => '312350001',
                'prodi' => 'Teknik Informatika',
                'kelas' => 'B',
                'no_telp' => '081212345001',
                'tanggal_lahir' => '2003-01-15',
                'tempat_lahir' => 'Jakarta',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 7,
                'nrp' => '312350002',
                'prodi' => 'Sistem Informasi',
                'kelas' => 'C',
                'no_telp' => '081212345002',
                'tanggal_lahir' => '2003-05-22',
                'tempat_lahir' => 'Bandung',
                'jenis_kelamin' => 'Perempuan',
                'agama' => 'Islam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 8,
                'nrp' => '312350003',
                'prodi' => 'Teknik Elektro',
                'kelas' => 'D',
                'no_telp' => '081212345003',
                'tanggal_lahir' => '2002-09-30',
                'tempat_lahir' => 'Surabaya',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Kristen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 9,
                'nrp' => '312350004',
                'prodi' => 'Manajemen Informatika',
                'kelas' => 'B',
                'no_telp' => '081212345004',
                'tanggal_lahir' => '2003-04-12',
                'tempat_lahir' => 'Semarang',
                'jenis_kelamin' => 'Perempuan',
                'agama' => 'Katolik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 10,
                'nrp' => '312350005',
                'prodi' => 'Teknik Sipil',
                'kelas' => 'A',
                'no_telp' => '081212345005',
                'tanggal_lahir' => '2002-11-11',
                'tempat_lahir' => 'Denpasar',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Hindu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 11,
                'nrp' => '312350006',
                'prodi' => 'Sistem Informasi',
                'kelas' => 'C',
                'no_telp' => '081212345006',
                'tanggal_lahir' => '2003-06-20',
                'tempat_lahir' => 'Medan',
                'jenis_kelamin' => 'Perempuan',
                'agama' => 'Islam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 12,
                'nrp' => '312350007',
                'prodi' => 'Teknik Informatika',
                'kelas' => 'D',
                'no_telp' => '081212345007',
                'tanggal_lahir' => '2003-07-01',
                'tempat_lahir' => 'Pontianak',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Konghucu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 13,
                'nrp' => '312350008',
                'prodi' => 'Teknik Komputer',
                'kelas' => 'A',
                'no_telp' => '081212345008',
                'tanggal_lahir' => '2002-12-25',
                'tempat_lahir' => 'Yogyakarta',
                'jenis_kelamin' => 'Perempuan',
                'agama' => 'Katolik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 14,
                'nrp' => '312350009',
                'prodi' => 'Teknik Mesin',
                'kelas' => 'B',
                'no_telp' => '081212345009',
                'tanggal_lahir' => '2003-08-19',
                'tempat_lahir' => 'Makassar',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 15,
                'nrp' => '312350010',
                'prodi' => 'Teknik Industri',
                'kelas' => 'C',
                'no_telp' => '081212345010',
                'tanggal_lahir' => '2003-02-05',
                'tempat_lahir' => 'Palembang',
                'jenis_kelamin' => 'Perempuan',
                'agama' => 'Buddha',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($mahasiswas as $mahasiswa) {
            Mahasiswa::create($mahasiswa);
        }
    }
}
