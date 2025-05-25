<?php

namespace App\Http\Controllers;

use App\Models\Frs;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\JadwalKuliah;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id_mahasiswa = null)
    {
        $user = Auth::user();
        
        // Jika role adalah dosen
        if ($user->hasRole('dosen')) {
            $dosen = $user->dosen;
            if (!$dosen) {
                return redirect()->back()->with('error', 'Data dosen tidak ditemukan.');
            }
            
            // Cari kelas yang diasuh oleh dosen ini sebagai dosen wali
            $kelasWali = Kelas::where('id_dosen', $dosen->id_dosen)->get();
            
            if ($kelasWali->isEmpty()) {
                // Jika bukan dosen wali, tampilkan pesan
                return view('frs.dosen.not-wali');
            }
            
            // Jika ada parameter id_mahasiswa, tampilkan FRS mahasiswa tersebut
            if ($id_mahasiswa) {
                return $this->showFrsByMahasiswa($id_mahasiswa);
            }
            
            // Ambil semua mahasiswa dari kelas yang diasuh dosen sebagai wali
            $mahasiswaList = Mahasiswa::with(['user', 'kelas'])
                                    ->whereIn('id_kelas', $kelasWali->pluck('id_kelas'))
                                    ->get();
            
            return view('frs.dosen.index', compact('kelasWali', 'mahasiswaList'));
        }
        
        // Jika role adalah mahasiswa
        if ($user->hasRole('mahasiswa')) {
            $mahasiswa = $user->mahasiswa;
            if (!$mahasiswa) {
                return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
            }
            
            return $this->showFrsByMahasiswa($mahasiswa->id_mahasiswa);
        }
        
        // Jika role admin atau lainnya
        return redirect()->route('home')->with('error', 'Akses tidak diizinkan.');
    }

    /**
     * Menampilkan FRS berdasarkan mahasiswa tertentu
     */
    public function showFrsByMahasiswa($id_mahasiswa)
    {
        $user = Auth::user();
        
        // Jika user adalah mahasiswa, pastikan hanya bisa melihat FRS sendiri
        if ($user->hasRole('mahasiswa')) {
            $mahasiswa = $user->mahasiswa;
            if (!$mahasiswa || $mahasiswa->id_mahasiswa != $id_mahasiswa) {
                return redirect()->back()->with('error', 'Akses tidak diizinkan.');
            }
            
            // Untuk mahasiswa, tampilkan view FRS mahasiswa
            $frses = Frs::with([
                'nilai.jadwal.matkul',
                'nilai.jadwal.dosen.user',
                'nilai.mahasiswa.kelas'
            ])->whereHas('nilai', function($query) use ($id_mahasiswa) {
                $query->where('id_mahasiswa', $id_mahasiswa);
            })->get();
            
            // Ambil jadwal kuliah yang tersedia untuk kelas mahasiswa
            $jadwalKuliahs = JadwalKuliah::with(['matkul', 'dosen.user', 'kelas.prodi'])
                                       ->where('id_kelas', $mahasiswa->id_kelas)
                                       ->get();
            
            return view('frs.index', compact('mahasiswa', 'frses', 'jadwalKuliahs'));
        }
        
        // Jika user adalah dosen, pastikan mahasiswa tersebut ada di kelas yang diasuh
        if ($user->hasRole('dosen')) {
            $dosen = $user->dosen;
            if (!$dosen) {
                return redirect()->back()->with('error', 'Data dosen tidak ditemukan.');
            }
            
            $mahasiswa = Mahasiswa::with(['kelas', 'user'])
                                 ->where('id_mahasiswa', $id_mahasiswa)
                                 ->whereHas('kelas', function($query) use ($dosen) {
                                     $query->where('id_dosen', $dosen->id_dosen);
                                 })
                                 ->first();
            
            if (!$mahasiswa) {
                return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan atau bukan dari kelas yang Anda asuh.');
            }
            
            // Ambil data FRS mahasiswa untuk dosen
            $frsList = Frs::with([
                'mataKuliah',
                'kelas',
                'mahasiswa'
            ])->where('id_mahasiswa', $id_mahasiswa)->get();
            
            return view('frs.dosen.frs-mahasiswa', compact('mahasiswa', 'frsList'));
        }
        
        return redirect()->back()->with('error', 'Akses tidak diizinkan.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jadwal_kuliah' => 'required|array|min:1|max:10',
            'jadwal_kuliah.*' => 'exists:jadwal_kuliah,id_jadwal_kuliah'
        ]);

        $user = Auth::user();
        
        // Pastikan hanya mahasiswa yang bisa menambah FRS
        if (!$user->hasRole('mahasiswa')) {
            return redirect()->back()->with('error', 'Akses tidak diizinkan.');
        }

        $mahasiswa = $user->mahasiswa;
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        try {
            foreach ($request->jadwal_kuliah as $id_jadwal) {
                // Cek apakah sudah ada nilai untuk mahasiswa dan jadwal ini
                $existingNilai = Nilai::where('id_mahasiswa', $mahasiswa->id_mahasiswa)
                                    ->where('id_jadwal_kuliah', $id_jadwal)
                                    ->first();
                
                if ($existingNilai) {
                    // Cek apakah sudah ada FRS untuk nilai ini
                    $existingFrs = Frs::where('id_nilai', $existingNilai->id_nilai)->first();
                    if ($existingFrs) {
                        continue; // Skip jika sudah ada
                    }
                    $nilai = $existingNilai;
                } else {
                    // Buat nilai baru
                    $nilai = Nilai::create([
                        'id_mahasiswa' => $mahasiswa->id_mahasiswa,
                        'id_jadwal_kuliah' => $id_jadwal,
                        'nilai_tugas' => 0,
                        'nilai_uts' => 0,
                        'nilai_uas' => 0,
                        'nilai_akhir' => 0,
                        'grade' => '-'
                    ]);
                }
                
                // Buat FRS
                Frs::create([
                    'id_nilai' => $nilai->id_nilai,
                    'status_persetujuan' => 'pending'
                ]);
            }
            
            return redirect()->route('frs.index')->with('success', 'FRS berhasil ditambahkan.');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        
        if (!$user->hasRole('mahasiswa')) {
            return redirect()->back()->with('error', 'Akses tidak diizinkan.');
        }

        try {
            $frs = Frs::findOrFail($id);
            
            // Pastikan FRS milik mahasiswa yang sedang login
            if ($frs->nilai->id_mahasiswa != $user->mahasiswa->id_mahasiswa) {
                return redirect()->back()->with('error', 'Akses tidak diizinkan.');
            }
            
            $frs->delete();
            
            return redirect()->back()->with('success', 'FRS berhasil dihapus.');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Update persetujuan FRS (untuk dosen)
     */
    public function updatePersetujuan(Request $request, $id)
    {
        $user = Auth::user();
        
        if (!$user->hasRole('dosen')) {
            return redirect()->back()->with('error', 'Akses tidak diizinkan.');
        }

        $request->validate([
            'status_persetujuan' => 'required|in:approved,rejected,pending',
            'catatan' => 'nullable|string|max:500'
        ]);

        try {
            $frs = Frs::findOrFail($id);
            
            // Pastikan mahasiswa ada di kelas yang diasuh dosen ini
            $dosen = $user->dosen;
            
            // Asumsi ada relasi untuk mendapatkan mahasiswa dari FRS
            $mahasiswa = $frs->mahasiswa ?? $frs->nilai->mahasiswa;
            
            if ($mahasiswa->kelas->id_dosen != $dosen->id_dosen) {
                return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menyetujui FRS ini.');
            }
            
            $frs->update([
                'status_persetujuan' => $request->status_persetujuan,
                'catatan' => $request->catatan
            ]);
            
            $status = $request->status_persetujuan == 'approved' ? 'disetujui' : 'ditolak';
            return redirect()->back()->with('success', "FRS berhasil {$status}.");
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    /**
     * Show FRS by mahasiswa ID (route helper)
     */
    public function indexByMahasiswa($id_mahasiswa)
    {
        return $this->showFrsByMahasiswa($id_mahasiswa);
    }
}