<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\FrsController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\JadwalKuliahController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\NilaiController;

// ----------------------
// Dashboard & Home
// ----------------------
Route::get('/', fn() => view('dashboard'))->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', fn() => view('dashboard'))->middleware(['auth', 'verified']);
Route::get('/home', fn() => view('home'))->middleware(['auth', 'verified'])->name('home');

// ----------------------
// Mahasiswa Routes
// ----------------------
Route::middleware(['auth', 'verified'])->group(function () {

    // Role: mahasiswa, dosen, admin
    Route::middleware('role:mahasiswa|dosen|admin')->group(function () {
        Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.dashboard');
        Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
        Route::post('/mahasiswa/store', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
        Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');
    });

    // Role: admin only
    Route::middleware('role:admin')->group(function () {
        Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
        Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
        Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
    });
});

// ----------------------
// Dosen Routes
// ----------------------
Route::middleware(['auth', 'verified'])->group(function () {

    // Role: dosen, mahasiswa, admin
    Route::middleware('role:dosen|mahasiswa|admin')->group(function () {
        Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.dashboard');
        Route::get('/dosen/create', [DosenController::class, 'create'])->name('dosen.create');
        Route::post('/dosen/store', [DosenController::class, 'store'])->name('dosen.store');
        Route::get('/dosen/{id}', [DosenController::class, 'show'])->name('dosen.show');
    });

    // Role: admin only
    Route::middleware('role:admin')->group(function () {
        Route::get('/dosen/{id}/edit', [DosenController::class, 'edit'])->name('dosen.edit');
        Route::put('/dosen/{id}', [DosenController::class, 'update'])->name('dosen.update');
        Route::delete('/dosen/{id}', [DosenController::class, 'destroy'])->name('dosen.destroy');
    });

    Route::middleware('role:mahasiswa|dosen')->group(function () {
        Route::get('/frs', [FrsController::class, 'index'])->name('frs.index');
        Route::get('/frs/create', [FrsController::class, 'create'])->name('frs.create');
        Route::post('/frs/store', [FrsController::class, 'store'])->name('frs.store');
        Route::get('/frs/destroy', [FrsController::class, 'destroy'])->name('frs.destroy');
    });
});

// ----------------------
// Nilai Routes
// ----------------------

// Menampilkan daftar mahasiswa dalam kelas tertentu (untuk dosen)
Route::get('/kelas/mahasiswa/{id_kelas}', [NilaiController::class, 'showMahasiswaByKelas'])->name('nilai.kelas');
// Route menampilkan daftar nilai berdasarkan mahasiswa (custom index dengan parameter)
Route::get('/nilai/mahasiswa/{id_mahasiswa}', [NilaiController::class, 'index'])->name('nilai.index.byMahasiswa');;

// Route form input nilai dengan query params
Route::get('/nilai/input', [NilaiController::class, 'create'])->name('nilai.create');

// Resource routes Nilai, kecuali index (karena sudah custom)
Route::resource('nilai', NilaiController::class)->except(['index']);

// Route lain (contoh, sesuaikan)
Route::resource('prodi', ProdiController::class);
Route::resource('mataKuliah', MatakuliahController::class);
Route::resource('jadwal', JadwalKuliahController::class);
Route::resource('kelas', KelasController::class);

// ----------------------
// Data Fetch AJAX
// ----------------------
Route::get('/get-kelas-by-prodi/{id_prodi}', [KelasController::class, 'getByProdi']);
Route::get('/get-jadwal-by-prodi/{id_prodi}', [JadwalKuliahController::class, 'getJadwalByProdi']);

// ----------------------
// Profile
// ----------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ----------------------
// Auth Routes
// ----------------------
require __DIR__ . '/auth.php';
