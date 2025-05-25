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

            // Ambil jadwal kuliah yang belum dipilih oleh mahasiswa ini
            $existingJadwalIds = $frses->pluck('nilai.jadwal.id_jadwal_kuliah')->filter()->toArray();
            
            $jadwalKuliahs = JadwalKuliah::with(['matkul', 'dosen.user', 'kelas.prodi'])
                ->whereNotIn('id_jadwal_kuliah', $existingJadwalIds)
                ->get();

            return view('frs.index', compact('frses', 'mahasiswa', 'jadwalKuliahs'));

            // Cek jika pengguna adalah dosen
        } elseif ($user->hasRole('dosen')) {
            $dosen = $user->dosen;

            if (!$dosen) {
                return redirect()->back()->with('error', 'Data dosen tidak ditemukan untuk akun Anda.');
            }

            $frses = Frs::with(['nilai.jadwal.matkul', 'nilai.mahasiswa.user'])
                ->whereHas('nilai.jadwal', function ($query) use ($dosen) {
                    $query->where('id_dosen', $dosen->id_dosen);
                })
                ->get();

            // Untuk dosen, mungkin tidak memerlukan jadwalKuliahs, tapi tetap didefinisikan untuk konsistensi
            $jadwalKuliahs = collect();

            return view('frs.index', compact('frses', 'dosen', 'jadwalKuliahs'));
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
        // Validasi untuk multiple selection
        $request->validate([
            'jadwal_kuliah' => 'required|array|min:1|max:10',
            'jadwal_kuliah.*' => 'exists:jadwal_kuliahs,id_jadwal_kuliah',
        ], [
            'jadwal_kuliah.required' => 'Pilih minimal 1 mata kuliah',
            'jadwal_kuliah.max' => 'Maksimal hanya dapat memilih 10 mata kuliah',
            'jadwal_kuliah.*.exists' => 'Jadwal kuliah tidak valid',
        ]);

        try {
            $user = Auth::user();
            $mahasiswa = $user->mahasiswa;

            if (!$mahasiswa) {
                return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan');
            }

            $successCount = 0;
            $errors = [];

            DB::beginTransaction();

            foreach ($request->jadwal_kuliah as $jadwalId) {
                try {
                    $jadwal = JadwalKuliah::with(['dosen'])->findOrFail($jadwalId);

                    // Cek apakah mahasiswa sudah mengambil mata kuliah ini
                    $existingFrs = Frs::whereHas('nilai', function($query) use ($mahasiswa, $jadwalId) {
                        $query->where('id_mahasiswa', $mahasiswa->id_mahasiswa)
                              ->where('id_jadwal_kuliah', $jadwalId);
                    })->first();

                    if ($existingFrs) {
                        $errors[] = "Mata kuliah {$jadwal->matkul->nama_matkul} sudah dipilih sebelumnya";
                        continue;
                    }

                    // Cek konflik jadwal (hari dan jam yang sama)
                    $conflictingFrs = Frs::whereHas('nilai', function($query) use ($mahasiswa) {
                        $query->where('id_mahasiswa', $mahasiswa->id_mahasiswa);
                    })->whereHas('nilai.jadwal', function($query) use ($jadwal) {
                        $query->where('hari', $jadwal->hari)
                              ->where(function($q) use ($jadwal) {
                                  $q->whereBetween('jam_awal', [$jadwal->jam_awal, $jadwal->jam_akhir])
                                    ->orWhereBetween('jam_akhir', [$jadwal->jam_awal, $jadwal->jam_akhir])
                                    ->orWhere(function($q2) use ($jadwal) {
                                        $q2->where('jam_awal', '<=', $jadwal->jam_awal)
                                           ->where('jam_akhir', '>=', $jadwal->jam_akhir);
                                    });
                              });
                    })->first();

                    if ($conflictingFrs) {
                        $errors[] = "Mata kuliah {$jadwal->matkul->nama_matkul} bentrok dengan jadwal yang sudah dipilih";
                        continue;
                    }

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
                        'tahun_ajaran' => date('Y'),
                        'disetujui' => 'Belum Disetujui',
                    ]);

                    $successCount++;

                } catch (\Exception $e) {
                    $errors[] = "Gagal menambahkan mata kuliah: " . $e->getMessage();
                }
            }

            DB::commit();

            // Buat pesan response
            $message = '';
            if ($successCount > 0) {
                $message = "Berhasil menambahkan {$successCount} mata kuliah ke FRS";
            }
            
            if (!empty($errors)) {
                $errorMessage = implode(', ', $errors);
                if ($successCount > 0) {
                    $message .= ". Namun ada beberapa error: " . $errorMessage;
                } else {
                    return redirect()->route('frs.index')->with('error', $errorMessage);
                }
            }

            return redirect()->route('frs.index')->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
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
        try {
            // Hapus FRS beserta nilai terkait jika diperlukan
            $nilai = $frs->nilai;
            
            $frs->delete();
            
            // Opsional: hapus nilai jika tidak ada FRS lain yang menggunakannya
            if ($nilai && !Frs::where('id_nilai', $nilai->id_nilai)->exists()) {
                $nilai->delete();
            }
            
            return redirect()->route('frs.index')->with('success', 'FRS berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus FRS: ' . $e->getMessage());
        }
    }
        
    // Menampilkan daftar mahasiswa dalam kelas tertentu (untuk dosen)
    public function showMahasiswaByKelas($id_kelas)
    {
        $kelas = Kelas::with(['mahasiswa.user'])
                    ->findOrFail($id_kelas);

        return view('frs.daftar_mahasiswa', compact('kelas'));
    }

    // Method tambahan untuk mendapatkan total SKS mahasiswa (opsional)
    public function getTotalSKS($mahasiswaId)
    {
        $totalSKS = Frs::whereHas('nilai', function($query) use ($mahasiswaId) {
            $query->where('id_mahasiswa', $mahasiswaId);
        })->whereHas('nilai.jadwal.matkul')
          ->with('nilai.jadwal.matkul')
          ->get()
          ->sum(function($frs) {
              return $frs->nilai->jadwal->matkul->sks ?? 0;
          });

        return $totalSKS;
    }
}