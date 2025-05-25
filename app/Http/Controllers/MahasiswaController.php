<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    /**
     * Tampilkan daftar mahasiswa dengan opsi filter.
     */
    public function index(Request $request)
    {
        // Ambil semua Program Studi dan Kelas untuk dropdown filter
        // Memuat relasi 'prodi' untuk Kelas agar bisa menampilkan nama prodi di dropdown Kelas
        $prodis = Prodi::all();
        $kelasList = Kelas::with('prodi')->get();

        // Mulai query untuk mahasiswa
        // Pastikan eager loading untuk relasi 'user' dan 'kelas.prodi'
        $query = Mahasiswa::with(['user', 'kelas.prodi']);

        // Terapkan filter berdasarkan input dari request
        if ($request->filled('prodi_id')) {
            $prodiId = $request->input('prodi_id');
            $query->whereHas('kelas.prodi', function ($q) use ($prodiId) {
                $q->where('id_prodi', $prodiId);
            });
        }

        if ($request->filled('kelas_id')) {
            $kelasId = $request->input('kelas_id');
            $query->where('id_kelas', $kelasId);
        }

        // Jika Anda ingin memfilter hanya mahasiswa dengan role 'mahasiswa' dari tabel users,
        // pastikan relasi 'user' di model Mahasiswa sudah benar dan uncomment baris ini.
        // $query->whereHas('user', function ($q) {
        //     $q->role('mahasiswa'); // Asumsi Anda menggunakan Spatie Laravel-Permission
        // });

        // Ambil data mahasiswa yang sudah difilter
        $mahasiswa = $query->get();

        // Mengembalikan view 'mahasiswa.index' dengan data yang dibutuhkan
        return view('mahasiswa.dashboard', compact('mahasiswa', 'prodis', 'kelasList'));
    }

    public function home()
    {
        return view('home');
    }

    /**
     * Tampilkan form untuk membuat data mahasiswa baru.
     */
    public function create()
    {
        $kelases = Kelas::with('prodi')->get();
        $prodies = Prodi::all();
        return view('mahasiswa.create', compact('kelases', 'prodies'));
    }

    /**
     * Simpan data mahasiswa baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_kelas' => 'required|exists:kelases,id_kelas',
            'nrp' => 'required|string|max:255|unique:mahasiswas',
            'no_telp' => 'required|string|max:15',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
        ]);

        $validatedData['user_id'] = Auth::id();

        Mahasiswa::create($validatedData);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Mahasiswa berhasil ditambahkan.'); // Mengarahkan ke index
    }

    /**
     * Tampilkan detail mahasiswa berdasarkan ID.
     */
    public function show(string $id)
    {
        $kelases = Kelas::all();
        $mahasiswa = Mahasiswa::with('user', 'kelas.prodi')->findOrFail($id); // Eager load kelas.prodi
        return view('mahasiswa.show', compact('mahasiswa', 'kelases'));
    }

    /**
     * Tampilkan form edit mahasiswa.
     */
    public function edit(string $id)
    {
        $kelases = Kelas::with('prodi')->get(); // Load prodi untuk kelas
        $prodies = Prodi::all();
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa', 'kelases', 'prodies'));
    }

    /**
     * Update data mahasiswa.
     */
    public function update(Request $request, string $id)
    {
        $mahasiswa = Mahasiswa::with('user')->findOrFail($id);

        $validatedData = $request->validate([
            'id_kelas' => 'required|exists:kelases,id_kelas',
            'nrp' => 'required|string|max:255|unique:mahasiswas,nrp,' . $mahasiswa->id_mahasiswa . ',id_mahasiswa',
            'no_telp' => 'required|string|max:15',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'email' => 'required|email|max:255',
            'nama' => 'required|string|max:255', // Tambahkan validasi untuk nama
        ]);

        // Update tabel users
        $mahasiswa->user->update([
            'name' => $validatedData['nama'],
            'email' => $validatedData['email'],
        ]);

        // Update tabel mahasiswas
        $mahasiswa->update([
            'id_kelas' => $validatedData['id_kelas'],
            'nrp' => $validatedData['nrp'],
            'no_telp' => $validatedData['no_telp'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'tempat_lahir' => $validatedData['tempat_lahir'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'agama' => $validatedData['agama'],
        ]);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Data mahasiswa berhasil diperbarui.'); // Mengarahkan ke index
    }

    /**
     * Hapus data mahasiswa.
     */
    public function destroy(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Mahasiswa berhasil dihapus.'); // Mengarahkan ke index
    }
}
