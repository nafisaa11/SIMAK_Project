<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kelases', function (Blueprint $table) {
            $table->id('id_kelas');
            $table->unsignedBigInteger('id_prodi');
            $table->foreign('id_prodi')->references('id_prodi')->on('prodies')->onDelete('cascade');
            $table->unsignedBigInteger('id_dosen');
            $table->foreign('id_dosen')->references('id_dosen')->on('dosens')->onDelete('cascade');
            $table->string('kelas');
            $table->string('angkatan');
            $table->timestamps();
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
