<?php

namespace App\Http\Controllers;

use App\Models\Frs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $frses = Frs::with('mahasiswa', 'jadwal', 'nilai', 'dosen')->get();
        return view('frs.index', compact('frses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mahasiswas = DB::table('mahasiswas')->get();
        $jadwals = DB::table('jadwals')->get();
        $dosens = DB::table('dosens')->get();
        $nilais = DB::table('nilais')->get();
        return view('frs.create', compact('mahasiswas', 'jadwals', 'dosens', 'nilais'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_mahasiswa' => 'required|exists:mahasiswas,id_mahasiswa',
            'id_dosen' => 'required|exists:dosens,id_dosen',
            'id_nilai' => 'required|exists:nilais,id_nilai',
            'id_jadwal_kuliah' => 'required|exists:jadwals,id_jadwal_kuliah',
            'tahun_ajaran' => 'required|string',
            'disetujui' => 'required|boolean',
            'semester' => 'required|integer|min:1|max:8',
        ]);

        try {
            Frs::create($request->all());
            return redirect()->route('frs.index')->with('success', 'FRS berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Frs $frs)
    {
        return view('frs.show', compact('frs'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Frs $frs)
    {
        $mahasiswas = DB::table('mahasiswas')->get();
        $jadwals = DB::table('jadwals')->get();
        $dosens = DB::table('dosens')->get();
        $nilais = DB::table('nilais')->get();
        return view('frs.edit', compact('frs', 'mahasiswas', 'jadwals', 'dosens', 'nilais'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Frs $frs)
    {
        $request->validate([
            'id_mahasiswa' => 'required|exists:mahasiswas,id_mahasiswa',
            'id_dosen' => 'required|exists:dosens,id_dosen',
            'id_nilai' => 'required|exists:nilais,id_nilai',
            'id_jadwal_kuliah' => 'required|exists:jadwals,id_jadwal_kuliah',
            'tahun_ajaran' => 'required|string',
            'disetujui' => 'required|boolean',
            'semester' => 'required|integer|min:1|max:8',
        ]);

        try {
            $frs->update($request->all());
            return redirect()->route('frs.index')->with('success', 'FRS berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Frs $frs)
    {
        try {
            $frs->delete();
            return redirect()->route('frs.index')->with('success', 'FRS berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
