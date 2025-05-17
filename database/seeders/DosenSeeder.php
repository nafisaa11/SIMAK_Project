<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Gunakan locale Indonesia untuk data yang lebih realistis

        // Contoh data mahasiswa 1
        Dosen::create([
            
            'nama' => 'Dr. Andi Wijaya',
            'nip' => '1234567890',
            'email' => 'andiwijaya@example.com',
            'no_telp' => '081234567890',
            'alamat' => 'Jl. Raya No. 1, Jakarta',
            'jenis_kelamin' => 'Laki-laki',
            'agama' => 'Islam',
        ]);

        // Anda bisa menambahkan lebih banyak data contoh di sini
        for ($i = 0; $i < 5; $i++) {
            Dosen::create([
                
                'nama' => $faker->name,
                'nip' => $faker->unique()->numerify('##########'),
                'email' => $faker->unique()->safeEmail,
                'no_telp' => $faker->phoneNumber,
                'alamat' => $faker->address,
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']),
            ]);
        }
    }
}
