<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            // Dosen (1–10)
            [
                'name' => 'Dr. Andi Wijaya',
                'email' => 'andi.wijaya@lecturer.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Prof. Siti Aminah',
                'email' => 'siti.aminah@lecturer.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Budi Santoso',
                'email' => 'budi.santoso@lecturer.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dra. Maria Yuliana',
                'email' => 'maria.yuliana@lecturer.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Iwan Kurniawan',
                'email' => 'iwan.kurniawan@lecturer.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Clara Setiawan',
                'email' => 'clara@lecturer.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Rudi Hartono',
                'email' => 'Rudi@lecturer.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dra. Lestari Indah',
                'email' => 'lestari@lecturer.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Hendra Prasetyo',
                'email' => 'hendra@lecturer.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dra. Yuni Astuti',
                'email' => 'yuni@lecturer.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Mahasiswa (11–20)
            [
                'name' => 'Ahmad Rafi',
                'email' => 'ahmad.rafi@student.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Siti Marlina',
                'email' => 'siti.marlina@student.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Johan Santoso',
                'email' => 'johan.santoso@student.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dewi Anggraini',
                'email' => 'dewi.anggraini@student.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'I Gede Surya',
                'email' => 'gede.surya@student.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Maya Putri',
                'email' => 'maya.putri@student.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kevin Hartono',
                'email' => 'kevin.hartono@student.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Natalia Veronica',
                'email' => 'natalia.veronica@student.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rizky Hidayat',
                'email' => 'rizky.hidayat@student.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Clara Wijaya',
                'email' => 'clara.wijaya@student.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@admin.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],

    ];

    foreach ($users as $user) {
        User::create($user);    
    }
    }
}
