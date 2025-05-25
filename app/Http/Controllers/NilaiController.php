<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\JadwalKuliah;

class NilaiController extends Controller
{
    // Custom index: menampilkan nilai mahasiswa tertentu
    
    public function index($id_mahasiswa)
    {
        // Ambil data mahasiswa beserta relasi yang diperlukan
        $mahasiswa = Mahasiswa::with('user', 'kelas.prodi', 'kelas.dosen.user')->findOrFail($id_mahasiswa);

        // Ambil jadwal kuliah mahasiswa
        $jadwal_kuliahs = JadwalKuliah::whereHas('kelas.mahasiswa', function ($query) use ($id_mahasiswa) {
            $query->where('id_mahasiswa', $id_mahasiswa);
        })->get();

        // Ambil nilai mahasiswa tersebut
        $nilais = Nilai::where('id_mahasiswa', $id_mahasiswa)->get();

        return view('nilai.index', compact('mahasiswa', 'nilais', 'jadwal_kuliahs'));
    }

    // Form input nilai (menggunakan query params)
    public function create(Request $request)
    {
        $id_mahasiswa = $request->query('id_mahasiswa');
        $id_jadwal_kuliah = $request->query('id_jadwal_kuliah');

        $mahasiswa = Mahasiswa::with('user')->findOrFail($id_mahasiswa);
        $jadwal = JadwalKuliah::with('matkul')->findOrFail($id_jadwal_kuliah);

        return view('nilai.create', compact('mahasiswa', 'jadwal'));
    }

    // Simpan nilai ke database
    public function store(Request $request)
    {
        $request->validate([
            'id_mahasiswa' => 'required|exists:mahasiswas,id_mahasiswa',
            'id_jadwal_kuliah' => 'required|exists:jadwal_kuliahs,id_jadwal_kuliah',
            'nilai_angka' => 'required|numeric|min:0|max:100',
        ]);

        $nilai_angka = $request->input('nilai_angka');

       

        Nilai::create([
            'id_mahasiswa' => $request->id_mahasiswa,
            'id_jadwal_kuliah' => $request->id_jadwal_kuliah,
            'nilai_angka' => $nilai_angka,
        ]);

        // Redirect ke halaman index nilai mahasiswa yang sama (custom route)
        return redirect()->route('nilai.index.byMahasiswa', ['id_mahasiswa' => $request->id_mahasiswa])
            ->with('success', 'Nilai berhasil disimpan.');
    }

    
    // ... method lain seperti edit, update, destroy bisa kamu sesuaikan seperti contoh tadi
}
