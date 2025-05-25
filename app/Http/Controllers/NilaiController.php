<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\JadwalKuliah;
use App\Models\Kelas;

class NilaiController extends Controller
{
    // Custom index: menampilkan nilai mahasiswa tertentu
    public function index($id_mahasiswa)
    {
        $mahasiswa = Mahasiswa::with('user', 'kelas.prodi', 'kelas.dosen.user')->findOrFail($id_mahasiswa);
        $jadwal_kuliahs = JadwalKuliah::whereHas('kelas.mahasiswa', function ($query) use ($id_mahasiswa) {
            $query->where('id_mahasiswa', $id_mahasiswa);
        })->get();
        $nilais = Nilai::where('id_mahasiswa', $id_mahasiswa)->get();

        return view('nilai.index', compact('mahasiswa', 'nilais', 'jadwal_kuliahs'));
    }

    // Form input nilai (menggunakan query params) - Keep for backward compatibility
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

            // Check if nilai already exists for this mahasiswa and jadwal
            $existingNilai = Nilai::where('id_mahasiswa', $request->id_mahasiswa)
                                 ->where('id_jadwal_kuliah', $request->id_jadwal_kuliah)
                                 ->first();

            if ($existingNilai) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Nilai untuk mata kuliah ini sudah ada.',
                        'errors' => ['nilai_angka' => ['Nilai untuk mata kuliah ini sudah ada.']]
                    ], 422);
                }
                return redirect()->back()->withErrors(['nilai_angka' => 'Nilai untuk mata kuliah ini sudah ada.']);
            }

            Nilai::create([
                'id_mahasiswa' => $request->id_mahasiswa,
                'id_jadwal_kuliah' => $request->id_jadwal_kuliah,
                'nilai_angka' => $nilai_angka,
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Nilai berhasil disimpan.'
                ]);
            }

            return redirect()->route('nilai.index.byMahasiswa', ['id_mahasiswa' => $request->id_mahasiswa])
                ->with('success', 'Nilai berhasil disimpan.');

    }

    // Form edit nilai - Keep for backward compatibility
    public function edit($id_nilai)
    {
        $nilai = Nilai::findOrFail($id_nilai);
        $mahasiswa = Mahasiswa::with('user')->findOrFail($nilai->id_mahasiswa);
        $jadwal = JadwalKuliah::with('matkul')->findOrFail($nilai->id_jadwal_kuliah);

        return view('nilai.edit', compact('nilai', 'mahasiswa', 'jadwal'));
    }

    // Update nilai ke database
    public function update(Request $request, $id_nilai)
    {
            $request->validate([
                'nilai_angka' => 'required|numeric|min:0|max:100',
            ]);

            $nilai = Nilai::findOrFail($id_nilai);
            $nilai->nilai_angka = $request->nilai_angka;
            $nilai->save();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Nilai berhasil diperbarui.'
                ]);
            }

            return redirect()->route('nilai.index.byMahasiswa', ['id_mahasiswa' => $nilai->id_mahasiswa])
                ->with('success', 'Nilai berhasil diperbarui.');
    }

    // Hapus nilai
    public function destroy($id_nilai)
    {
            $nilai = Nilai::findOrFail($id_nilai);
            $id_mahasiswa = $nilai->id_mahasiswa;
            $nilai->delete();

            return redirect()->route('nilai.index.byMahasiswa', ['id_mahasiswa' => $id_mahasiswa])
                ->with('success', 'Nilai berhasil dihapus.');
    }

    // Menampilkan daftar mahasiswa dalam kelas tertentu (untuk dosen)
    public function showMahasiswaByKelas($id_kelas)
    {
        $kelas = Kelas::with(['mahasiswa.user']) // asumsikan relasi ke user lewat mahasiswa
                    ->findOrFail($id_kelas);

        return view('nilai.daftar_mahasiswa', compact('kelas'));
    }

    // API endpoint untuk mendapatkan data nilai (optional, untuk future enhancement)
    public function getNilaiData($id_mahasiswa)
    {
            $mahasiswa = Mahasiswa::with('user', 'kelas.prodi', 'kelas.dosen.user')->findOrFail($id_mahasiswa);
            $jadwal_kuliahs = JadwalKuliah::whereHas('kelas.mahasiswa', function ($query) use ($id_mahasiswa) {
                $query->where('id_mahasiswa', $id_mahasiswa);
            })->with('matkul')->get();
            $nilais = Nilai::where('id_mahasiswa', $id_mahasiswa)->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'mahasiswa' => $mahasiswa,
                    'jadwal_kuliahs' => $jadwal_kuliahs,
                    'nilais' => $nilais
                ]
            ]);
        
    }
}