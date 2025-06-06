<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilais', function (Blueprint $table) {
            $table->id('id_nilai');
            $table->unsignedBigInteger('id_mahasiswa');
            $table->unsignedBigInteger('id_jadwal_kuliah');
            $table->double('nilai_angka')->nullable();
            $table->timestamps();

            // Foreign Key ke mahasiswa dan matakuliah
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswas')->onDelete('cascade');
            $table->foreign('id_jadwal_kuliah')->references('id_jadwal_kuliah')->on('jadwal_kuliahs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('nilais', function (Blueprint $table) {
            $table->double('nilai_angka')->nullable(false)->change();
        });
    }
};
