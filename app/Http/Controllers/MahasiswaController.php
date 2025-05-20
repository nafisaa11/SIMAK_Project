<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
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
            $query->role('mahasiswa'); // Menggunakan Spatie
        })->with('user')->get();

        return view('mahasiswa.dashboard', compact('mahasiswa'));
    }

    public function home()
    {
        return view('home');
    }

    /**
     * Tampilkan form untuk membuat data mahasiswa baru.
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Simpan data mahasiswa baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nrp' => 'required|string|max:255|unique:mahasiswas',
            'prodi' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
        ]);

        $validatedData['user_id'] = Auth::id();

        Mahasiswa::create($validatedData);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail mahasiswa berdasarkan ID.
     */
    public function show(string $id)
    {
        $mahasiswa = Mahasiswa::with('user')->findOrFail($id);
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Tampilkan form edit mahasiswa.
     */
    public function edit(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update data mahasiswa.
     */
    public function update(Request $request, string $id)
    {
        $mahasiswa = Mahasiswa::with('user')->findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255', // tambahkan validasi nama
            'nrp' => 'required|string|max:255|unique:mahasiswas,nrp,' . $mahasiswa->id_mahasiswa . ',id_mahasiswa',
            'prodi' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'email' => 'required|email|max:255', // untuk update email user
        ]);

        // Update tabel users (nama & email)
        $mahasiswa->user->update([
            'name' => $validatedData['nama'],
            'email' => $validatedData['email'],
        ]);

        // Update tabel mahasiswas
        $mahasiswa->update([
            'nrp' => $validatedData['nrp'],
            'prodi' => $validatedData['prodi'],
            'kelas' => $validatedData['kelas'],
            'no_telp' => $validatedData['no_telp'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'tempat_lahir' => $validatedData['tempat_lahir'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'agama' => $validatedData['agama'],
        ]);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }


    /**
     * Hapus data mahasiswa.
     */
    public function destroy(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Mahasiswa berhasil dihapus.');
    }
}
