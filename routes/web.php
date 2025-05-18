<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\DosenController;
// use App\Http\Controllers\MataKuliahController;
// use App\Http\Controllers\FrsController;


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


//Mahasiswa
Route::middleware(['auth', 'verified', 'role:mahasiswa'])->group(function (){
    Route::get('mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.dashboard');
    Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
    Route::post('/mahasiswa/store', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::get('mahasiswa/home', [MahasiswaController::class, 'home'])->name('home');
    Route::get('mahasiswa/{id}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');
    // Route::get('dosen/dashboard', [DosenController::class, 'index'])->name('dosen.dashboard')
    // ->middleware(['auth', 'verified', 'role:dosen|mahasiswa']);
    // Route::resource('dosen', DosenController::class);
    // Route::resource('mataKuliah', MataKuliahController::class);
    // Route::resource('frs', FrsController::class);
});


require __DIR__.'/auth.php';
