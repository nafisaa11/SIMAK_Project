<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified', 'role:admin'])->name('admin.dashboard');

Route::get('dosen', function () {
    return view('dosen.dashboard');
})->middleware(['auth', 'verified', 'role:dosen|admin'])->name('dosen.dashboard');

Route::get('mahasiswa', [MahasiswaController::class, 'index'])
    ->middleware(['auth', 'verified', 'role:mahasiswa|admin'])
    ->name('mahasiswa.dashboard');

require __DIR__.'/auth.php';
