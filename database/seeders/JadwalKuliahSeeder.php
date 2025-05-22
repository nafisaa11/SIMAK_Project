<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JadwalKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek data dari tabel matkuls dan dosens
        $matkuls = DB::table('matkuls')->get();
        $dosens = DB::table('dosens')->get();

        // Jika tabel matkuls dan dosens kosong, tidak bisa membuat jadwal
        if ($matkuls->isEmpty() || $dosens->isEmpty()) {
            $this->command->info('Tabel matkuls atau dosens kosong. Silakan jalankan seeder matkuls dan dosens terlebih dahulu.');
            return;
        }
        
        
        $jadwal_kuliahs = [
            // Contoh data jadwal kuliah id_kelas = 1
            [
                'id_matkul' => 1,
                'id_dosen' => 1,
                'id_kelas' => 1,
                'hari' => 'Senin',
                'ruangan' => 'A-101',
                'jam_awal' => Carbon::createFromTime(8, 0, 0),
                'jam_akhir' => Carbon::createFromTime(10, 0, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_matkul' => 2,
                'id_dosen' => 2,
                'id_kelas' => 1,
                'hari' => 'Selasa',
                'ruangan' => 'A-102',
                'jam_awal' => Carbon::createFromTime(10, 0, 0),
                'jam_akhir' => Carbon::createFromTime(12, 0, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_matkul' => 3,
                'id_dosen' => 3,
                'id_kelas' => 1,
                'hari' => 'Rabu',
                'ruangan' => 'A-103',
                'jam_awal' => Carbon::createFromTime(13, 0, 0),
                'jam_akhir' => Carbon::createFromTime(15, 0, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_matkul' => 4,
                'id_dosen' => 4,
                'id_kelas' => 1,
                'hari' => 'Kamis',
                'ruangan' => 'A-104',
                'jam_awal' => Carbon::createFromTime(15, 0, 0),
                'jam_akhir' => Carbon::createFromTime(17, 0, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_matkul' => 5,
                'id_dosen' => 5,
                'id_kelas' => 1,
                'hari' => 'Jumat',
                'ruangan' => 'A-105',
                'jam_awal' => Carbon::createFromTime(8, 0, 0),
                'jam_akhir' => Carbon::createFromTime(10, 0, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Contoh data jadwal kuliah id_kelas 2
            [
                'id_matkul' => 6,
                'id_dosen' => 6,
                'id_kelas' => 2,
                'hari' => 'Senin',
                'ruangan' => 'B-201',
                'jam_awal' => Carbon::createFromTime(10, 0, 0),
                'jam_akhir' => Carbon::createFromTime(12, 0, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_matkul' => 7,
                'id_dosen' => 7,
                'id_kelas' => 2,
                'hari' => 'Selasa',
                'ruangan' => 'B-202',
                'jam_awal' => Carbon::createFromTime(13, 0, 0),
                'jam_akhir' => Carbon::createFromTime(15, 0, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_matkul' => 8,
                'id_dosen' => 8,
                'id_kelas' => 2,
                'hari' => 'Rabu',
                'ruangan' => 'B-203',
                'jam_awal' => Carbon::createFromTime(15, 0, 0),
                'jam_akhir' => Carbon::createFromTime(17, 0, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_matkul' => 9,
                'id_dosen' => 9,
                'id_kelas' => 2,
                'hari' => 'Kamis',
                'ruangan' => 'B-204',
                'jam_awal' => Carbon::createFromTime(8, 0, 0),
                'jam_akhir' => Carbon::createFromTime(10, 0, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_matkul' => 10,
                'id_dosen' => 10,
                'id_kelas' => 2,
                'hari' => 'Jumat',
                'ruangan' => 'B-205',
                'jam_awal' => Carbon::createFromTime(10, 0, 0),
                'jam_akhir' => Carbon::createFromTime(12, 0, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Contoh data jadwal kuliah id_kelas 3
            [
                'id_matkul' => 1,
                'id_dosen' => 1,
                'id_kelas' => 3,
                'hari' => 'Senin',  
                'ruangan' => 'C-201',
                'jam_awal' => Carbon::createFromTime(8, 0, 0),
                'jam_akhir' => Carbon::createFromTime(10, 0, 0),
                'created_at' => now(),  
                'updated_at' => now(),
            ],
            [
                'id_matkul' => 2,
                'id_dosen' => 2,
                'id_kelas' => 3,
                'hari' => 'Selasa',
                'ruangan' => 'C-101',
                'jam_awal' => Carbon::createFromTime(10, 0, 0),
                'jam_akhir' => Carbon::createFromTime(12, 0, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_matkul' => 3,
                'id_dosen' => 3,
                'id_kelas' => 3,
                'hari' => 'Rabu',
                'ruangan' => 'C-302',
                'jam_awal' => Carbon::createFromTime(13, 0, 0),
                'jam_akhir' => Carbon::createFromTime(15, 0, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_matkul' => 4,
                'id_dosen' => 4,
                'id_kelas' => 3,
                'hari' => 'Kamis',
                'ruangan' => 'B-201',
                'jam_awal' => Carbon::createFromTime(15, 0, 0),
                'jam_akhir' => Carbon::createFromTime(17, 0, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_matkul' => 5,
                'id_dosen' => 5,
                'id_kelas' => 3,
                'hari' => 'Jumat',
                'ruangan' => 'B-301',
                'jam_awal' => Carbon::createFromTime(8, 0, 0),
                'jam_akhir' => Carbon::createFromTime(10, 0, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],  
            [
                'id_matkul' => 6,
                'id_dosen' => 6,
                'id_kelas' => 3,
                'hari' => 'Senin',
                'ruangan' => 'A-101',
                'jam_awal' => Carbon::createFromTime(10, 0, 0),
                'jam_akhir' => Carbon::createFromTime(12, 0, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_matkul' => 7,
                'id_dosen' => 7,
                'id_kelas' => 3,
                'hari' => 'Selasa',
                'ruangan' => 'A-201',
                'jam_awal' => Carbon::createFromTime(13, 0, 0),
                'jam_akhir' => Carbon::createFromTime(15, 0, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_matkul' => 8,
                'id_dosen' => 8,
                'id_kelas' => 3,
                'hari' => 'Rabu',
                'ruangan' => 'A-301',
                'jam_awal' => Carbon::createFromTime(15, 0, 0),
                'jam_akhir' => Carbon::createFromTime(17, 0, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_matkul' => 9,
                'id_dosen' => 9,
                'id_kelas' => 3,
                'hari' => 'Kamis',
                'ruangan' => 'A-401',
                'jam_awal' => Carbon::createFromTime(8, 0, 0),
                'jam_akhir' => Carbon::createFromTime(10, 0, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_matkul' => 10,
                'id_dosen' => 10,
                'id_kelas' => 3,
                'hari' => 'Jumat',
                'ruangan' => 'A-501',
                'jam_awal' => Carbon::createFromTime(10, 0, 0),
                'jam_akhir' => Carbon::createFromTime(12, 0, 0),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan jadwal lain sesuai kebutuhan
        ];

        // Insert data ke database
        DB::table('jadwal_kuliahs')->insert($jadwal_kuliahs);

        $this->command->info('Data jadwal kuliah berhasil ditambahkan!');
    }
}