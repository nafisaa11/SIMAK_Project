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
    $jadwalKuliah = JadwalKuliah::whereHas('kelas.mahasiswa', function ($query) use ($id_mahasiswa) {
    $query->where('id_mahasiswa', $id_mahasiswa);
    })->get();

    $nilais = Nilai::with('jadwal')
                ->where('id_mahasiswa', $id_mahasiswa)
                ->get();

    $jadwal_kuliahs = $jadwalKuliah; // Pastikan relasi ini ada

    return view('nilai.index', compact('mahasiswa', 'nilais', 'jadwal_kuliahs'));
}

    public function create(Request $request)
{
    $id_mahasiswa = $request->query('id_mahasiswa');
    $id_jadwal_kuliah = $request->query('id_jadwal_kuliah');

    // Ambil data mahasiswa dan jadwal kuliah jika dibutuhkan di form
    $mahasiswa = Mahasiswa::with('user')->findOrFail($id_mahasiswa);
    $jadwal = JadwalKuliah::with('matkul')->findOrFail($id_jadwal_kuliah);

    return view('nilai.create', compact('id_mahasiswa', 'id_jadwal_kuliah', 'mahasiswa', 'jadwal'));
}


    public function store(Request $request)
{
    $request->validate([
        'id_mahasiswa' => 'required|exists:mahasiswas,id_mahasiswa',
        'id_jadwal_kuliah' => 'required|exists:jadwal_kuliahs,id_jadwal_kuliah',
        'nilai_angka' => 'required|numeric|min:0|max:100',
    ]);

    $nilai_angka = $request->input('nilai_angka');

    // Konversi ke nilai huruf
    $nilai_huruf = match (true) {
        $nilai_angka >= 86 => 'A',
        $nilai_angka >= 81 => 'AB',
        $nilai_angka >= 76 => 'A-',
        $nilai_angka >= 71 => 'B+',
        $nilai_angka >= 66 => 'B',
        $nilai_angka >= 61 => 'B-',
        $nilai_angka >= 56 => 'C',
        $nilai_angka >= 41 => 'D',
        $nilai_angka >= 0  => 'E',
        default => 'Tidak Teridentifikasi',
    };

    Nilai::create([
        'id_mahasiswa' => $request->id_mahasiswa,
        'id_jadwal_kuliah' => $request->id_jadwal_kuliah,
        'nilai_angka' => $nilai_angka,
        'nilai_huruf' => $nilai_huruf,
    ]);

    return redirect()->route('nilai.index', ['id_mahasiswa' => $request->id_mahasiswa])
        ->with('success', 'Nilai berhasil disimpan.');
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
