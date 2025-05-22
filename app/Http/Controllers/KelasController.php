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
            'angkatan' => 'required|string|max:255',
        ]);

        // Simpan kelas baru
        $kelas = Kelas::create($request->all());



        // Ubah status dosen menjadi 'Dosen wali'
        $dosen = Dosen::find($request->id_dosen);
        if ($dosen && $dosen->status !== 'Dosen wali') {
            $dosen->status = 'Dosen wali';
            $dosen->save();
        }

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dibuat dan status dosen diperbarui.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id_kelas)
    {
        return view('kelas.show', compact('kelas', 'dosens', 'prodies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_kelas)
    {
        $dosens = Dosen::all();
        $prodies = Prodi::all();
        $kelas = Kelas::findOrFail($id_kelas);
        return view('kelas.edit', compact('kelas', 'dosens', 'prodies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_kelas)
    {
        $validated = $request->validate([
            'id_prodi' => 'required|exists:prodies,id_prodi',
            'id_dosen' => 'required|exists:dosens,id_dosen',
            'kelas' => 'required|string|max:255',
            'angkatan' => 'required|string|max:255',
        ]);

        $kelas = Kelas::findOrFail($id_kelas);

        // Simpan dosen lama sebelum update
        $dosenLamaId = $kelas->id_dosen;

        // Update kelas dengan data baru
        $kelas->update($request->all());

        $dosenBaruId = $request->id_dosen;

        // 1. Jika dosen berubah
        if ($dosenLamaId != $dosenBaruId) {
            // a. Cek apakah dosen lama masih menjadi wali kelas lain
            $masihWali = Kelas::where('id_dosen', $dosenLamaId)->exists();

            // Jika tidak, ubah statusnya jadi Dosen Biasa
            if (!$masihWali) {
                $dosenLama = Dosen::find($dosenLamaId);
                if ($dosenLama) {
                    $dosenLama->status = 'Dosen Biasa';
                    $dosenLama->save();
                }
            }

            // b. Ubah status dosen baru jadi Dosen Wali jika belum
            $dosenBaru = Dosen::find($dosenBaruId);
            if ($dosenBaru && $dosenBaru->status !== 'Dosen wali') {
                $dosenBaru->status = 'Dosen wali';
                $dosenBaru->save();
            }
        }

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui dan status dosen diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_kelas)
    {
        $kelas = Kelas::findOrFail($id_kelas);

        // Simpan ID dosen sebelum hapus kelas
        $id_dosen = $kelas->id_dosen;

        // Hapus kelas
        $kelas->delete();

        // Cek apakah dosen tersebut masih menjadi dosen wali untuk kelas lain
        $dosenMasihWali = Kelas::where('id_dosen', $id_dosen)->exists();

        if (!$dosenMasihWali) {
            $dosen = Dosen::find($id_dosen);
            if ($dosen) {
                $dosen->status = 'Dosen Biasa';
                $dosen->save();
            }
        }

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }


    public function getByProdi($id_prodi)
    {
        $kelas = Kelas::where('id_prodi', $id_prodi)->get();
        return response()->json($kelas);
    }

}
