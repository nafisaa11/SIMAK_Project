<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\Matkul;

class NilaiController extends Controller
{
    public function index()
    {
        // Ambil data nilai beserta relasi mahasiswa dan mata kuliah
        $nilais = Nilai::with(['mahasiswa', 'matkul'])->get();
        return view('nilai.index', compact('nilais'));
    }

    public function create()
    {
        $mahasiswas = Mahasiswa::all();
        $mataKuliahs = Matkul::all(); 
    
        return view('nilai.create', compact('mahasiswas', 'mataKuliahs'))->with('matkuls', $mataKuliahs);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_mahasiswa' => 'required|exists:mahasiswas,id_mahasiswa',
            'id_matkul' => 'required|exists:matkuls,id_matkul', // ubah disini
            'nilai_angka' => 'required|numeric',
            'nilai_huruf' => 'required|string|max:2',
        ]);
    
        // Simpan data nilai
        Nilai::create($validated);
        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil ditambahkan.');
    }
    
    


    public function show($id)
    {
        // Menampilkan nilai dengan relasi mahasiswa dan mata kuliah
        $nilai = Nilai::with(['mahasiswa', 'matkul'])->findOrFail($id);
        return view('nilai.show', compact('nilai'));
    }

    public function edit($id)
    {
        $nilai = Nilai::findOrFail($id);
        $mahasiswas = Mahasiswa::all();
        $mataKuliahs = Matkul::all();
    
        return view('nilai.edit', compact('nilai', 'mahasiswas', 'mataKuliahs'))->with('matkuls', $mataKuliahs);
    }
    

    public function update(Request $request, $id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->update($request->all());
        return redirect()->route('nilai.index');
    }

    public function destroy($id)
    {
        Nilai::destroy($id);
        return redirect()->route('nilai.index');
    }
}
