<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
        [
            'name' => 'Admin',
            'email' => 'admin@admin.ac.id',
            'password' => bcrypt('admin123')
        ],
        [
            'name' => 'Dosen',
            'email' => 'dosen@dosen.ac.id',
            'password' => bcrypt('dosen123')
        ],
        [
            'name' => 'Mahasiswa',
            'email' => 'mahasiswa@student.ac.id',
            'password' => bcrypt('mahasiswa123')
        ],
    ];

    foreach ($users as $user) {
        User::create($user);    
    }
    }
}
