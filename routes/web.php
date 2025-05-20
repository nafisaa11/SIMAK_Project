<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Home & Dashboard
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

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

require __DIR__ . '/auth.php';
