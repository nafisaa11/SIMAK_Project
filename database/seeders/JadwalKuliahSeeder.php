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
        
        // Contoh data jadwal kuliah
        $jadwal_kuliahs = [
            [
                'id_matkul' => $matkuls[0]->id_matkul,
                'id_dosen' => $dosens[0]->id_dosen,
                'id_prodi' => '1',
                'hari' => 'Senin',
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'ruangan' => 'A101',
                'kelas' => 'A',
                'sks' => 3,
                'jam_awal' => '08:00:00',
                'jam_akhir' => '10:30:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_matkul' => $matkuls[0]->id_matkul, 
                'id_dosen' => $dosens[0]->id_dosen,
                'id_prodi' => '1',
                'hari' => 'Rabu',
                'tanggal' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'ruangan' => 'B203',
                'kelas' => 'B',
                'sks' => 3,
                'jam_awal' => '13:00:00',
                'jam_akhir' => '15:30:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Tambahkan jadwal lain sesuai kebutuhan
        ];
        
        // Insert data ke database
        DB::table('jadwal_kuliahs')->insert($jadwal_kuliahs);
        
        $this->command->info('Data jadwal kuliah berhasil ditambahkan!');
    }
}