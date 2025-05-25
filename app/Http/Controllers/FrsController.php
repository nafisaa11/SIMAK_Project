<?php

namespace App\Http\Controllers;

use App\Models\Frs;
use App\Models\JadwalKuliah;
use App\Models\Nilai;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FrsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Variabel ini diinisialisasi untuk menghindari error "Undefined variable"
        // jika suatu role tidak membutuhkannya, namun di view tetap di-compact
        $jadwalKuliahs = collect(); // Inisialisasi sebagai collection kosong by default

        // Cek jika pengguna adalah mahasiswa
        if ($user->hasRole('mahasiswa')) {
            $mahasiswa = $user->mahasiswa;

            if (!$mahasiswa) {
                return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan untuk akun Anda.');
            }

            $frses = Frs::with('nilai.jadwal.matkul', 'nilai.jadwal.dosen')
                ->whereHas('nilai', fn($query) => $query->where('id_mahasiswa', $mahasiswa->id_mahasiswa))
                ->get();

            $jadwalKuliahs = JadwalKuliah::with(['matkul', 'dosen', 'kelas'])->get(); // Definisi di sini

            return view('frs.index', compact('frses', 'mahasiswa', 'jadwalKuliahs'));

            // Cek jika pengguna adalah dosen
        } elseif ($user->hasRole('dosen')) {
            $dosen = $user->dosen;

            if (!$dosen) {
                return redirect()->back()->with('error', 'Data dosen tidak ditemukan untuk akun Anda.');
            }

            $frses = Frs::with(['nilai.jadwal.matkul', 'nilai.jadwal.mahasiswa'])
                ->whereHas('nilai.jadwal', function ($query) use ($dosen) {
                    $query->where('id_dosen', $dosen->id_dosen);
                })
                ->get();

            // Jika dosen juga memerlukan jadwalKuliahs, definisikan di sini
            $jadwalKuliahs = JadwalKuliah::with(['matkul', 'dosen', 'kelas'])->get(); // Definisi untuk dosen

            return view('frs.index', compact('frses', 'dosen', 'jadwalKuliahs')); // Tambahkan jadwalKuliahs
        }

        // Jika tidak memiliki role yang diizinkan (misal admin, atau role tidak terdefinisi)
        return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman FRS ini.');
    }



    public function create()
    {
        return view('frs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_jadwal_kuliah' => 'required|exists:jadwal_kuliahs,id_jadwal_kuliah',
        ]);

        try {
            $user = Auth::user();
            $mahasiswa = $user->mahasiswa;

            if (!$mahasiswa) {
                return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan');
            }

            $jadwal = JadwalKuliah::with(['dosen'])->findOrFail($request->id_jadwal_kuliah);

            // Ambil atau buat nilai terlebih dahulu
            $nilai = Nilai::firstOrCreate([
                'id_mahasiswa' => $mahasiswa->id_mahasiswa,
                'id_jadwal_kuliah' => $jadwal->id_jadwal_kuliah,
            ]);

            // Buat entri FRS
            Frs::create([
                'id_mahasiswa' => $mahasiswa->id_mahasiswa,
                'id_dosen' => $jadwal->dosen->id_dosen,
                'id_jadwal_kuliah' => $jadwal->id_jadwal_kuliah,
                'id_nilai' => $nilai->id_nilai,
                'tahun_ajaran' => date('Y'), // Atau bisa ditarik dari form jika tersedia
                // 'semester' => $mahasiswa->semester ?? 1,
                'disetujui' => 'Belum Disetujui',
            ]);

            return redirect()->route('frs.index')->with('success', 'FRS berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan FRS: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Frs $frs)
    {
        return view('frs.show', compact('frs'));
    }

    public function edit(Frs $frs)
    {
        $mahasiswas = DB::table('mahasiswas')->get();
        $jadwals = DB::table('jadwal_kuliahs')->get();
        $dosens = DB::table('dosens')->get();
        $nilais = DB::table('nilais')->get();
        return view('frs.edit', compact('frs', 'mahasiswas', 'jadwals', 'dosens', 'nilais'));
    }

    public function update(Request $request, Frs $frs)
    {
        $request->validate([
            'id_mahasiswa' => 'required|exists:mahasiswas,id_mahasiswa',
            'id_dosen' => 'required|exists:dosens,id_dosen',
            'id_nilai' => 'required|exists:nilais,id_nilai',
            'id_jadwal_kuliah' => 'required|exists:jadwal_kuliahs,id_jadwal_kuliah',
            'tahun_ajaran' => 'required|string',
            'disetujui' => 'required|in:Belum Disetujui,Tidak Disetujui,Disetujui',
            // 'semester' => 'required|integer|min:1|max:8',
        ]);

        try {
            $frs->update($request->all());
            return redirect()->route('frs.index')->with('success', 'FRS berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy(Frs $frs)
    {
        if ($frs->nilai->mahasiswa->user->user_id !== Auth::user()->user_id) {
            return back()->with('error', 'Anda tidak memiliki akses untuk menghapus FRS ini');
        }

            try {
                $frs->delete();
                return redirect()->route('frs.index')->with('success', 'FRS berhasil dihapus');
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
            }
        } 
    
}
