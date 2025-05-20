<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    /**
     * Tampilkan daftar dosen.
     */
    public function index()
    {
        $dosen = Dosen::with('user')->get();

        return view('dosen.dashboard', compact('dosen'));
    }

    /**
     * Halaman home (jika diperlukan).
     */
    public function home()
    {
        return view('home');
    }

    /**
     * Tampilkan form tambah dosen.
     */
    public function create()
    {
        return view('dosen.create');
    }

    /**
     * Simpan dosen baru.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nip' => 'required|string|max:255|unique:dosens,nip',
            'no_telp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'status' => 'required|in:Dosen Biasa,Dosen wali',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
        ]);

        $validatedData['user_id'] = Auth::id();

        Dosen::create($validatedData);

        return redirect()->route('dosen.dashboard')->with('success', 'Data dosen berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail dosen.
     */
    public function show(string $id)
    {
        $dosen = Dosen::with('user')->findOrFail($id);
        return view('dosen.show', compact('dosen'));
    }

    /**
     * Tampilkan form edit dosen.
     */
    public function edit(string $id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('dosen.edit', compact('dosen'));
    }

    /**
     * Update data dosen.
     */
    public function update(Request $request, string $id)
    {
        $dosen = Dosen::with('user')->findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $dosen->user->id,
            'nip' => 'required|string|max:255|unique:dosens,nip,' . $dosen->id_dosen . ',id_dosen',
            'no_telp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'status' => 'required|in:Dosen Biasa,Dosen wali',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
        ]);

        // Update tabel users
        $dosen->user->update([
            'name' => $validatedData['nama'],
            'email' => $validatedData['email'],
        ]);

        // Update tabel dosens
        $dosen->update([
            'nip' => $validatedData['nip'],
            'no_telp' => $validatedData['no_telp'],
            'alamat' => $validatedData['alamat'],
            'status' => $validatedData['status'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'agama' => $validatedData['agama'],
        ]);

        return redirect()->route('dosen.dashboard')->with('success', 'Data dosen berhasil diperbarui.');
    }


    /**
     * Hapus dosen.
     */
    public function destroy(string $id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();

        return redirect()->route('dosen.dashboard')->with('success', 'Data dosen berhasil dihapus.');
    }
}
