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
        Schema::create('kelases', function (Blueprint $table) {
            $table->id('id_kelas');
            $table->unsignedBigInteger('id_prodi'); 
            $table->unsignedBigInteger('id_dosen'); // Foreign key to dosens table
            $table->unsignedBigInteger('id_mahasiswa'); // Foreign key to matkuls table
            $table->string('nama_kelas');
            $table->timestamps();
            // $table->string('angkatan');

            $table->foreign('id_prodi')->references('id_prodi')->on('prodi');
            $table->foreign('id_dosen')->references('id_dosen')->on('dosens');
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelases');
    }
};
