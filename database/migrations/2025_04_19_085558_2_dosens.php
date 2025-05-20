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
        Schema::create('dosens', function (Blueprint $table) {
            $table->id('id_dosen');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nip')->unique();
            $table->string('no_telp');
            $table->string('alamat');
            $table->enum('status', ['Dosen Biasa', 'Dosen wali'])->default('Dosen Biasa');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosens');
    }
};
