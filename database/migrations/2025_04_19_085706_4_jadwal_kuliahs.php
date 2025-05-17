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
            $table->string('hari');
            $table->date('tanggal');
            $table->string('ruangan');
            $table->string('kelas');
            $table->integer('sks');
            $table->time('jam_awal');
            $table->time('jam_akhir');
            $table->timestamps();
        
            $table->foreign('id_matkul')->references('id_matkul')->on('matkuls'); // Perubahan referensi
            $table->foreign('id_dosen')->references('id_dosen')->on('dosens');
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