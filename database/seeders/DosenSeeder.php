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
            [
                'user_id' => 6,
                'nip' => '199001012022031006',
                'no_telp' => '086689012345',
                'alamat' => 'Jl. Melati No. 34, Medan',
                'status' => 'Dosen Biasa',
                'jenis_kelamin' => 'Perempuan',
                'agama' => 'Islam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 7,
                'nip' => '198501012023031007',
                'no_telp' => '087790123456',
                'alamat' => 'Jl. Mawar No. 56, Semarang',
                'status' => 'Dosen wali',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Katolik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 8,
                'nip' => '199501012024031008',
                'no_telp' => '088801234567',
                'alamat' => 'Jl. Cempaka No. 89, Jakarta',
                'status' => 'Dosen Biasa',
                'jenis_kelamin' => 'Perempuan',
                'agama' => 'Hindu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 9,
                'nip' => '199601012025031009',
                'no_telp' => '089912345678',
                'alamat' => 'Jl. Flamboyan No. 23, Bandung',
                'status' => 'Dosen Biasa',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Kristen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 10,
                'nip' => '199701012026031010',
                'no_telp' => '090012345678',
                'alamat' => 'Jl. Kamboja No. 45, Yogyakarta',
                'status' => 'Dosen Biasa',
                'jenis_kelamin' => 'Perempuan',
                'agama' => 'Buddha',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 22,
                'nip' => '199701012026031018',
                'no_telp' => '090012345678',
                'alamat' => 'Jl. Kamboja No. 45, Yogyakarta',
                'status' => 'Dosen wali',
                'jenis_kelamin' => 'Perempuan',
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
