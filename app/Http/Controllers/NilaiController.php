<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\JadwalKuliah;
use App\Models\Kelas;

class NilaiController extends Controller
{
public function index($id_mahasiswa)
{
    $mahasiswa = Mahasiswa::with('user', 'kelas.prodi', 'kelas.dosen.user')->findOrFail($id_mahasiswa);

    $nilais = Nilai::with('jadwal')
                ->where('id_mahasiswa', $id_mahasiswa)
                ->get();

    $jadwal_kuliahs = $mahasiswa->kelas->jadwalKuliah; // Pastikan relasi ini ada

    return view('nilai.index', compact('mahasiswa', 'nilais', 'jadwal_kuliahs'));
}

    public function create()
    {
        $mahasiswas = Mahasiswa::all();
        $jadwal_kuliahs = JadwalKuliah::all(); 

        return view('nilai.create', compact('mahasiswas', 'jadwal_kuliahs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_mahasiswa' => 'required|exists:mahasiswas,id_mahasiswa',
            'id_jadwal_kuliah' => 'required|exists:jadwal_kuliahs,id_jadwal_kuliah',
            'nilai_angka' => 'required|numeric',
            'nilai_huruf' => 'required|string|max:2',
            'ips' => 'required|numeric',
        ]);

        Nilai::create($validated);

        return redirect()->route('nilai.index', $validated['id_mahasiswa'])
                         ->with('success', 'Nilai berhasil ditambahkan.');
    }

    public function show($id)
    {
        $nilai = Nilai::with(['mahasiswa', 'jadwal'])->findOrFail($id);
        return view('nilai.show', compact('nilai'));
    }

    public function edit($id)
    {
        $nilai = Nilai::findOrFail($id);
        $mahasiswas = Mahasiswa::all();
        $jadwal_kuliahs = JadwalKuliah::all();

        return view('nilai.edit', compact('nilai', 'mahasiswas', 'jadwal_kuliahs'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_mahasiswa' => 'required|exists:mahasiswas,id_mahasiswa',
            'id_jadwal_kuliah' => 'required|exists:jadwal_kuliahs,id_jadwal_kuliah',
            'nilai_angka' => 'required|numeric',
            'nilai_huruf' => 'required|string|max:2',
            'ips' => 'required|numeric',
        ]);

        $nilai = Nilai::findOrFail($id);
        $nilai->update($validated);

        return redirect()->route('nilai.index', $validated['id_mahasiswa'])
                         ->with('success', 'Nilai berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $nilai = Nilai::findOrFail($id);
        $mahasiswaId = $nilai->id_mahasiswa;
        $nilai->delete();

        return redirect()->route('nilai.index', $mahasiswaId)
                         ->with('success', 'Nilai berhasil dihapus.');
    }

    public function showMahasiswaByKelas($id_kelas)
    {
        $kelas = Kelas::with(['mahasiswa.user'])->findOrFail($id_kelas);
        return view('nilai.daftar_mahasiswa', compact('kelas'));
    }
}
