<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matkuls = Matkul::orderby('kode_matkul', 'asc')->paginate(10);
        return view('mataKuliah.index', ['matkuls' => $matkuls]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mataKuliah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_matkul' => 'string',
            'nama_matkul' => 'string',
            'semester' => 'numeric|min:1|max:8',
            'sks' => 'numeric|min:1|max:4',
        ]);

        Matkul::create([
            'kode_matkul' => $request->kode_matkul,
            'nama_matkul' => $request->nama_matkul,
            'semester' => $request->semester,
            'sks' => $request->sks,
        ]);
        return redirect()->route('mataKuliah.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id_matkul)
    {
        $matkul = Matkul::find($id_matkul);
        return view('mataKuliah.show', compact('matkul'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id_matkul)
    {
        $matkul = Matkul::find($id_matkul);
        return view('mataKuliah.edit') ->with('matkul', $matkul);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id_matkul)
    {
        $request->validate([
            'kode_matkul' => 'string',
            'nama_matkul' => 'string',
            'semester' => 'numeric|min:1|max:8',
            'sks' => 'numeric|max:4',
        ]);

        Matkul::where('id_matkul', $id_matkul)->update([
            'kode_matkul' => $request->kode_matkul,
            'nama_matkul' => $request->nama_matkul,
            'semester' => $request->semester,
            'sks' => $request->sks,
        ]);
        return redirect()->route('mataKuliah.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id_matkul)
    {
        Matkul::where('id_matkul', $id_matkul)->delete();
        return redirect()->route('mataKuliah.index');
    }
}
