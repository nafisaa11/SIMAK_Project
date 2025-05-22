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
        $kelases = Kelas::with(['dosen', 'prodi'])->withCount('mahasiswa')->get();
        return view('kelas.index', compact('kelases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dosens = Dosen::all();
        $prodies = Prodi::all();
        return view('kelas.create', compact('dosens', 'prodies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_prodi' => 'required|exists:prodies,id_prodi',
            'id_dosen' => 'required|exists:dosens,id_dosen',
            'kelas' => 'required|string|max:255',
            'angkatan' => 'required|string|max:255', // Uncomment if angkatan is needed
        ]);

        $kelas = Kelas::create($request->all());

        // Hitung jumlah mahasiswa berdasarkan prodi dan kelas
        $jumlahMahasiswa = Mahasiswa::where('id_prodi', $request->id_prodi)
            ->where('kelas', $request->kelas)
            ->count();

        // Jika kamu punya kolom jumlah_mahasiswa, simpan nilainya:
        $kelas->jumlah_mahasiswa = $jumlahMahasiswa;
        $kelas->save();

        return redirect()->route('kelas.index')->with('success', 'Kelas created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id_kelas)
    {
        return view('kelas.show', compact('kelas', 'dosens', 'prodies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id_kelas)
    {
        $dosens = Dosen::all();
        $prodies = Prodi::all();
        $kelas = Kelas::findOrFail($id_kelas);
        return view('kelas.edit', compact('kelas', 'dosens', 'prodies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id_kelas)
    {
        $validated = $request->validate([
            'id_prodi' => 'required|exists:prodies,id_prodi',
            'id_dosen' => 'required|exists:dosens,id_dosen',
            'kelas' => 'required|string|max:255',
            'angkatan' => 'required|string|max:255', // Uncomment if angkatan is needed
        ]);

        $kelas = Kelas::findOrFail($id_kelas);

        $kelas->update($request->all());

        return redirect()->route('kelas.index')->with('success', 'Kelas updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id_kelas)
    {
        $kelas = Kelas::findOrFail($id_kelas);
        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', 'Kelas deleted successfully.');
    }
    
    public function getByProdi($id_prodi)
    {
        $kelas = Kelas::where('id_prodi', $id_prodi)->get();
        return response()->json($kelas);
    }

}
