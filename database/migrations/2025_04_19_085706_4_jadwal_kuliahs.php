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
        Schema::create('jadwal_kuliahs', function (Blueprint $table) {
            $table->id('id_jadwal_kuliah');
            $table->unsignedBigInteger('id_matkul'); // Perubahan dari id_matakuliah menjadi id_matkul
            $table->unsignedBigInteger('id_dosen');
            $table->unsignedBigInteger('id_prodi'); 
            $table->string('hari');
            $table->string('ruangan');
            $table->string('kelas');
            $table->time('jam_awal');
            $table->time('jam_akhir');
            $table->timestamps();

            // Foreign key
            $table->foreign('id_matkul')->references('id_matkul')->on('matkuls');
            $table->foreign('id_dosen')->references('id_dosen')->on('dosens');
            $table->foreign('id_prodi')->references('id_prodi')->on('prodi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_kuliahs');
    }
};
