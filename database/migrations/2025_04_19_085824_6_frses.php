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
            $table->unsignedBigInteger('id_nilai');
            $table->enum('disetujui', ['Belum Disetujui', 'Tidak Disetujui', 'Disetujui'])->default('Belum Disetujui');
            $table->timestamps();

            // Foreign Key ke tabel mahasiswa, dosen, nilai, dan jadwal_kuliah
            $table->foreign('id_nilai')->references('id_nilai')->on('nilais')->onDelete('cascade');
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
