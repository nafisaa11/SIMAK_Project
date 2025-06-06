<?php

namespace App\Http\Controllers;

use App\Models\JadwalKuliah;
use App\Models\Matkul;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
    
        // Jika mahasiswa, filter berdasarkan mahasiswa yang login dan hanya FRS yang disetujui
        if ($user->hasRole('mahasiswa')) {
            $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
    
            if (!$mahasiswa) {
                return redirect()->route('mahasiswa.create')->with('error', 'Data mahasiswa belum lengkap.');
            }
    
            // Ambil semua nilai milik mahasiswa ini yang FRS-nya disetujui
            $jadwals = JadwalKuliah::whereHas('nilais', function ($query) use ($mahasiswa) {
                $query->where('id_mahasiswa', $mahasiswa->id_mahasiswa)
                    ->whereHas('frs', function ($q) {
                        $q->where('disetujui', 'disetujui');
                    });
            })
            ->with(['matkul', 'dosen.user', 'kelas.prodi'])
            ->get();
        } else {
            // Untuk admin/dosen: tampilkan semua jadwal
            $jadwals = JadwalKuliah::with(['matkul', 'dosen.user', 'kelas.prodi'])->get();
        }
    
        return view('jadwal.index', compact('jadwals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $matkuls = Matkul::all();
        $dosens = Dosen::all();
        $kelases = Kelas::with('prodi')->get(); // jika masih butuh
        $prodies = Prodi::all();
        return view('jadwal.create', compact('matkuls', 'dosens', 'kelases', 'prodies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_matkul' => 'required|exists:matkuls,id_matkul',
            'id_dosen'  => 'required|exists:dosens,id_dosen',
            'id_kelas'  => 'required|exists:kelases,id_kelas',
            'hari'      => 'required|string',
            'ruangan'   => 'required|string',
            'jam_awal'  => 'required',
            'jam_akhir' => 'required'
        ]);

        JadwalKuliah::create($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jadwal = JadwalKuliah::with(['matkul', 'dosen', 'kelas'])->findOrFail($id);
        return view('jadwal.show', compact('jadwal', 'matkuls', 'dosens', 'kelases'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $matkuls = Matkul::all();
        $dosens = Dosen::all();
        $kelases = Kelas::all();
        $prodies = Prodi::all();
        $jadwal = JadwalKuliah::findOrFail($id);
        return view('jadwal.edit', compact('jadwal', 'matkuls', 'dosens', 'kelases', 'prodies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'id_matkul' => 'required|exists:matkuls,id_matkul',
            'id_dosen'  => 'required|exists:dosens,id_dosen',
            'id_kelas'  => 'required|exists:kelases,id_kelas',
            'hari'      => 'required|string',
            'ruangan'   => 'required|string',
            'jam_awal'  => 'required',
            'jam_akhir' => 'required'
        ]);

        // Update tabel kelases
        // $mahasiswa->kelas()->update([
        //     'id_kelas' => $validatedData['id_kelas'],
        // ]);

        $jadwal = JadwalKuliah::findOrFail($id);
        $jadwal->update([
            'id_matkul' => $validatedData['id_matkul'],
            'id_dosen'  => $validatedData['id_dosen'],
            'id_kelas'  => $validatedData['id_kelas'],
            'hari'      => $validatedData['hari'],
            'ruangan'   => $validatedData['ruangan'],
            'jam_awal'  => $validatedData['jam_awal'],
            'jam_akhir' => $validatedData['jam_akhir']
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwal = JadwalKuliah::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }

    public function getJadwalByProdi($id)
    {
        $kelas = Kelas::where('id_prodi', $id)->get();
        return response()->json($kelas);
    }



}
