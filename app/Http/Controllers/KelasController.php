<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Mahasiswa;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelases = Kelas::all();
        return view('kelas.index', compact('kelases', 'dosen', 'prodi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dosens = Dosen::all();
        $prodies = Prodi::all();
        // $mahasiswas = Mahasiswa::all();
        return view('kelases.create', compact('dosens', 'prodies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_prodi' => 'required|exists:prodi,id_prodi',
            'id_dosen' => 'required|exists:dosens,id_dosen',
            'nama_kelas' => 'required|string|max:255',
        ]);

        $kelas = Kelas::create($request->all());

        // Hitung jumlah mahasiswa berdasarkan prodi dan nama_kelas
        $jumlahMahasiswa = Mahasiswa::where('id_prodi', $request->id_prodi)
            ->where('nama_kelas', $request->nama_kelas)
            ->count();

        // Jika kamu punya kolom jumlah_mahasiswa, simpan nilainya:
        $kelas->jumlah_mahasiswa = $jumlahMahasiswa;
        $kelas->save();

        return redirect()->route('kelases.index')->with('success', 'Kelas created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id_kelas)
    {
        return view('kelases.show', compact('kelas', 'dosen', 'prodi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id_kelas)
    {
        $dosen = Dosen::all();
        $prodi = Prodi::all();
        // $mahasiswas = Mahasiswa::all();
        return view('kelases.edit', compact('kelas', 'dosen', 'prodi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id_kelas)
    {
        $request->validate([
            'id_prodi' => 'required|exists:prodi,id_prodi',
            'id_dosen' => 'required|exists:dosens,id_dosen',
            'nama_kelas' => 'required|string|max:255',
            // 'angkatan' => 'required|string|max:255', // Uncomment if angkatan is needed
        ]);

        $kelas->update($request->all());

        return redirect()->route('kelases.index')->with('success', 'Kelas updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id_kelas)
    {
        $kelas->delete();

        return redirect()->route('kelases.index')->with('success', 'Kelas deleted successfully.');
    }
}
