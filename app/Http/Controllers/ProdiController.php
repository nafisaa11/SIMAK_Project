<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prodies = Prodi::orderby('id_prodi', 'asc')->paginate(10);
        return view('prodi.index', ['prodies' => $prodies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('prodi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'kode_prodi' => 'required|string',
            'nama_prodi' => 'required|string',
            'jenjang' => 'required|string',
        ]);

        Prodi::create($validate);

        return redirect()->route('prodi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id_prodi)
    {
        $prodi = Prodi::find($id_prodi);
        return view('prodi.show', compact('prodi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id_prodi)
    {
        $prodi = Prodi::find($id_prodi);
        return view('prodi.edit') ->with('prodi', $prodi);;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id_prodi)
    {
        $request->validate([
            'kode_prodi' => 'required|string',
            'nama_prodi' => 'required|string',
            'jenjang' => 'required|string',
        ]);

        Prodi::where('id_prodi', $id_prodi)->update([
            'kode_prodi' => $request->kode_prodi,
            'nama_prodi' => $request->nama_prodi,
            'jenjang' => $request->jenjang,
        ]);

        return redirect()->route('prodi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id_prodi)
    {
        Prodi::where('id_prodi', $id_prodi)->delete();
        return redirect()->route('prodi.index');
    }
}
