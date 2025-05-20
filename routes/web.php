<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\DosenController;
// use App\Http\Controllers\MataKuliahController;
// use App\Http\Controllers\FrsController;


Route::get('/', function () {
    return view('welcome');
});

// Route universal 'home' untuk semua role (konten disesuaikan di blade)
Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

// dashboard bawaan breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Admin
// Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
//     Route::get('/admin', function () {
//         return view('admin.dashboard');
//     })->name('admin.dashboard');
// });

// Mahasiswa
Route::middleware(['auth', 'verified', 'role:mahasiswa|dosen|admin'])->group(function () {
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.dashboard');
    Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
    Route::post('/mahasiswa/store', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');
});

// Dosen
Route::middleware(['auth', 'verified', 'role:dosen|mahasiswa|admin'])->group(function () {
    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.dashboard');
    Route::get('/dosen/create', [DosenController::class, 'create'])->name('dosen.create');
    Route::post('/dosen/store', [DosenController::class, 'store'])->name('dosen.store');
    Route::get('/dosen/{id}', [DosenController::class, 'show'])->name('dosen.show');
});

require __DIR__.'/auth.php';
