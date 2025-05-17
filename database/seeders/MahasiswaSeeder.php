<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa; 
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Faker::create('id_ID'); // Gunakan locale Indonesia untuk data yang lebih realistis

        // // Contoh data mahasiswa 1
        // Mahasiswa::create([
        //     'nama' => 'Budi Santoso',
        //     'nrp' => '1234567890',
        //     'email' => 'budi.santoso@example.com',
        //     'prodi' => 'Teknik Informatika',
        //     'kelas' => 'TI-1A',
        //     'no_telp' => '081234567890',
        //     'tanggal_lahir' => '2002-08-17',
        //     'tempat_lahir' => 'Surabaya',
        //     'jenis_kelamin' => 'Laki-laki',
        //     'agama' => 'Islam',
        // ]);

        // // Anda bisa menambahkan lebih banyak data contoh di sini
        // for ($i = 0; $i < 5; $i++) {
        //     Mahasiswa::create([
        //         'nama' => $faker->name,
        //         'nrp' => $faker->unique()->numerify('##########'),
        //         'email' => $faker->unique()->safeEmail,
        //         'prodi' => $faker->randomElement(['Teknik Elektro', 'Teknik Mesin', 'Arsitektur', 'Desain Komunikasi Visual']),
        //         'no_telp' => $faker->phoneNumber,
        //         'kelas' => $faker->randomElement(['TI-1A', 'TI-1B', 'TI-2A', 'TI-2B']),
        //         'tanggal_lahir' => $faker->date('Y-m-d', 'now'),
        //         'tempat_lahir' => $faker->city,
        //         'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
        //         'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']),
        //     ]);
        // }
    }
}