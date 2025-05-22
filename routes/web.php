<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\FrsController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\JadwalKuliahController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\NilaiController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\FrsController;


// Home & Dashboard
// Route::get('/', function () {
//     return view('welcome');
// })->middleware(['auth', 'verified'])->name('welcome');

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

// Prodi
// Route::get('/prodi', function () {
//     return view('prodi');
// })->middleware(['auth', 'verified'])->name('prodi');

// // Mata Kuliah
// Route::get('/mataKuliah', function () {
//     return view('mataKuliah');
// })->middleware(['auth', 'verified'])->name('mataKuliah');

// dashboard bawaan breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ----------------------
// MAHASISWA ROUTES
// ----------------------

// Public access (by role: mahasiswa, dosen, admin)
// MAHASISWA ROUTES
Route::middleware(['auth', 'verified', 'role:mahasiswa|dosen|admin'])->group(function () {
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.dashboard');
    Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
    Route::post('/mahasiswa/store', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
});

// Admin only routes for Mahasiswa (edit, update, destroy)
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
});

// Harus diletakkan terakhir!
Route::middleware(['auth', 'verified', 'role:mahasiswa|dosen|admin'])->group(function () {
    Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');
    
});


// ----------------------
// DOSEN ROUTES
// ----------------------

// Public access (by role: dosen, mahasiswa, admin)
Route::middleware(['auth', 'verified', 'role:dosen|mahasiswa|admin'])->group(function () {
    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.dashboard');
    Route::get('/dosen/create', [DosenController::class, 'create'])->name('dosen.create');
    Route::post('/dosen/store', [DosenController::class, 'store'])->name('dosen.store');
    Route::get('/dosen/{id}', [DosenController::class, 'show'])->name('dosen.show');
});

// Resource routes
Route::resource('prodi', ProdiController::class);
Route::resource('mataKuliah', MatakuliahController::class);
Route::resource('jadwal', JadwalKuliahController::class);
Route::resource('nilai', NilaiController::class);
Route::resource('kelas', KelasController::class);
Route::resource('frs', FrsController::class);

// Route for get Data
// Untuk dosen melihat daftar mahasiswa berdasarkan kelas
Route::get('/kelas/{id_kelas}/mahasiswa', [App\Http\Controllers\NilaiController::class, 'showMahasiswaByKelas'])->name('nilai.mahasiswa');
// route input nilai mahasiswa tertentu
Route::get('/nilai/input/{id_mahasiswa}', [App\Http\Controllers\NilaiController::class, 'create'])->name('nilai.input');
Route::get('/nilai/mahasiswa/{id_mahasiswa}', [NilaiController::class, 'index'])->name('nilai.mahasiswa');



require __DIR__.'/auth.php';
// Admin only routes for Dosen (edit, update, destroy)
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/dosen/{id}/edit', [DosenController::class, 'edit'])->name('dosen.edit');
    Route::put('/dosen/{id}', [DosenController::class, 'update'])->name('dosen.update');
    Route::delete('/dosen/{id}', [DosenController::class, 'destroy'])->name('dosen.destroy');
});

// ----------------------
// PROFILE (opsional aktifkan jika ingin dipakai)
// ----------------------

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/get-kelas-by-prodi/{id_prodi}', [KelasController::class, 'getByProdi']);
Route::get('/get-jadwal-by-prodi/{id_prodi}', [JadwalKuliahController::class, 'getJadwalByProdi']);



require __DIR__ . '/auth.php';
