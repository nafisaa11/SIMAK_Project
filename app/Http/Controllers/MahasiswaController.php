<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Tampilkan daftar mahasiswa.
     */
    public function index()
    {
      $mahasiswa = Mahasiswa::with('user')->get();
return view('mahasiswa.dashboard', compact('mahasiswa'));

    }
}
