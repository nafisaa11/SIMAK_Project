<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    /**
     * Tampilkan daftar mahasiswa.
     */
        public function index()
{
    $mahasiswa = Mahasiswa::whereHas('user', function ($query) {
        $query->role('mahasiswa'); // pakai helper dari Spatie
    })->with('user')->get();

    return view('mahasiswa.dashboard', compact('mahasiswa'));
}

    public function home(){
        return view('home');
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'nrp' => 'required|string|max:255|unique:mahasiswas',
            'prodi' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'no_telp' => 'nullable|string|max:15',
            'tanggal_lahir' => 'nullable|date',
            'tempat_lahir' => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|string|max:10',
            'agama' => 'nullable|string|max:50',
        ]);

        // Tambahkan user_id ke data validasi
        $validatedData['user_id'] = Auth::id();

        // Simpan ke database
        Mahasiswa::create($validatedData);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('mahasiswa.dashboard')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        return view('mahasiswa.show', [
            'mahasiswa' => Mahasiswa::findOrFail($id)
        ]);
    }
}
