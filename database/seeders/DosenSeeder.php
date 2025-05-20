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

        $dosens =[

            [
                'user_id' => 1,
                'nip' => '198001012022031001',
                'no_telp' => '081234567890',
                'alamat' => 'Jl. Merdeka No. 123, Jakarta',
                'status' => 'Dosen wali',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'nip' => '197512052019042002',
                'no_telp' => '082345678901',
                'alamat' => 'Jl. Anggrek No. 45, Bandung',
                'status' => 'Dosen Biasa',
                'jenis_kelamin' => 'Perempuan',
                'agama' => 'Katolik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'nip' => '197001012018031003',
                'no_telp' => '083356789012',
                'alamat' => 'Jl. Raya Ubud No. 99, Bali',
                'status' => 'Dosen Biasa',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Hindu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'nip' => '198405062020112004',
                'no_telp' => '084467890123',
                'alamat' => 'Jl. Kenanga No. 12, Surabaya',
                'status' => 'Dosen wali',
                'jenis_kelamin' => 'Perempuan',
                'agama' => 'Kristen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'nip' => '198306082021122005',
                'no_telp' => '085578901234',
                'alamat' => 'Jl. Mangga No. 77, Yogyakarta',
                'status' => 'Dosen Biasa',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Buddha',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($dosens as $dosen) {
            Dosen::create($dosen);
        }
    }
}
