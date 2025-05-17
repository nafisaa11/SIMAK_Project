<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //daftar permission admin
        //create permission for admin to manage mahasiswa
        Permission::create(['name' => 'tambah-mahasiswa']);
        Permission::create(['name' => 'edit-mahasiswa']);
        Permission::create(['name' => 'hapus-mahasiswa']);
        Permission::create(['name' => 'lihat-mahasiswa']);

        //create permission for admin to manage dosen
        Permission::create(['name' => 'tambah-dosen']);
        Permission::create(['name' => 'edit-dosen']);
        Permission::create(['name' => 'hapus-dosen']);
        Permission::create(['name' => 'lihat-dosen']);

        //create permission for admin to manage jadwal
        Permission::create(['name' => 'tambah-jadwal']);
        Permission::create(['name' => 'edit-jadwal']);
        Permission::create(['name' => 'hapus-jadwal']);
        Permission::create(['name' => 'lihat-jadwal']);

        //daftar permission dosen
        Permission::create(['name' => 'tambah-nilai']);
        Permission::create(['name' => 'edit-nilai']);
        Permission::create(['name' => 'hapus-nilai']);
        Permission::create(['name' => 'lihat-nilai']);
        
        //daftar role
        Role::create((['name' => 'admin']));
        Role::create((['name' => 'dosen']));
        Role::create((['name' => 'mahasiswa']));

        //assign permission to role
        $roleAdmin = Role::findByName('admin');
        $roleAdmin->givePermissionTo([
            'tambah-mahasiswa',
            'edit-mahasiswa',
            'hapus-mahasiswa',
            'lihat-mahasiswa',
            'tambah-dosen',
            'edit-dosen',
            'hapus-dosen',
            'lihat-dosen',
            'tambah-jadwal',
            'edit-jadwal',
            'hapus-jadwal',
            'lihat-jadwal',
        ]);

        $roleDosen = Role::findByName('dosen');
        $roleDosen->givePermissionTo([
            'tambah-nilai',
            'edit-nilai',
            'hapus-nilai',
            'lihat-nilai',
            'lihat-mahasiswa',
            'lihat-jadwal',
        ]);

        $roleMahasiswa = Role::findByName('mahasiswa');
        $roleMahasiswa->givePermissionTo([
            'lihat-nilai',
            'lihat-jadwal',
            'lihat-dosen',
            'lihat-mahasiswa',
        ]);


    }
}
