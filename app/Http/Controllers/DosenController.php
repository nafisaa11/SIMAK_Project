<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $dosen = Dosen::whereHas('user', function ($query) {
        $query->role('dosen'); // pakai helper dari Spatie
    })->with('user')->get();

    return view('dosen.dashboard', compact('dosen'));
}


    public function home(){
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:dosens,nip',
            'email' => 'required|email|max:255|unique:dosens,email',
            'no_telp' => 'nullable|string|max:15',
            'jenis_kelamin' => 'nullable|string|max:10',
            'alamat' => 'required|string|max:255',
            'agama' => 'nullable|string|max:50',
        ]);

        $validatedData['user_id'] = Auth::id();

        Dosen::create($validatedData);

        return redirect()->route('dosen.dashboard')->with('success', 'Data dosen berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('dosen.show', [
            'dosen' => Dosen::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
