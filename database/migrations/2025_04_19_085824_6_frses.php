<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('frses', function (Blueprint $table) {
            $table->id('id_frs');
            $table->unsignedBigInteger('id_mahasiswa');
            $table->unsignedBigInteger('id_dosen');
            $table->unsignedBigInteger('id_nilai');
            $table->unsignedBigInteger('id_jadwal_kuliah');
            $table->integer('tahun_ajaran');
            $table->enum('semester', ['Ganjil', 'Genap']);
            $table->enum('disetujui', ['Belum', 'Ya', 'Tidak']);
            $table->timestamps();

            // Foreign Key ke tabel mahasiswa, dosen, nilai, dan jadwal_kuliah
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswas')->onDelete('cascade');
            $table->foreign('id_dosen')->references('id_dosen')->on('dosens')->onDelete('cascade');
            $table->foreign('id_nilai')->references('id_nilai')->on('nilais')->onDelete('cascade');
            $table->foreign('id_jadwal_kuliah')->references('id_jadwal_kuliah')->on('jadwal_kuliahs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frses');
    }
};
