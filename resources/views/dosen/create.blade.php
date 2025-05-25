@extends('layouts.master')
@section('title')
    Tambah Data Dosen
@endsection

@section('content')
<div class="max-w-5xl mx-auto bg-white rounded-lg shadow-md p-8">
    <h2 class="text-center text-xl font-semibold mb-6 border-b pb-2 text-gray-700">Tambah Data Dosen</h2>
    <form action="{{ route('dosen.store') }}" method="post" class="space-y-6">
        @csrf
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label for="nip" class="block mb-1 text-sm font-medium text-gray-700">NIP</label>
                <input type="text" name="nip" id="nip" required
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-yellow-400"
                    placeholder="Masukkan NIP">
            </div>
            <div>
                <label for="nama" class="block mb-1 text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" readonly
                    class="w-full border rounded px-3 py-2 bg-gray-100 cursor-not-allowed"
                    value="{{ Auth::user()->name }}">
            </div>
            <div>
                <label for="alamat" class="block mb-1 text-sm font-medium text-gray-700">Alamat</label>
                <input type="text" name="alamat" id="alamat" required
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-yellow-400"
                    placeholder="Masukkan alamat">
            </div>
            <div>
                <label for="jenis_kelamin" class="block mb-1 text-sm font-medium text-gray-700">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" required
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-yellow-400">
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div>
                <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" readonly
                    class="w-full border rounded px-3 py-2 bg-gray-100 cursor-not-allowed"
                    value="{{ Auth::user()->email }}">
            </div>
            <div>
                <label for="no_telp" class="block mb-1 text-sm font-medium text-gray-700">Nomor HP</label>
                <input type="tel" name="no_telp" id="no_telp"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-yellow-400"
                    placeholder="Masukkan nomor HP">
            </div>
            <div>
                <label for="agama" class="block mb-1 text-sm font-medium text-gray-700">Agama</label>
                <select name="agama" id="agama"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-yellow-400">
                    <option value="">-- Pilih --</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Konghucu">Konghucu</option>
                </select>
            </div>
        </div>

        <div class="flex justify-center gap-6 mt-8">
            <button type="button" onclick="window.history.back()"
                class="bg-gray-400 text-white font-semibold py-2 px-6 rounded shadow hover:bg-gray-500 transition">
                Kembali
            </button>
            <button type="submit"
                class="bg-yellow-400 text-black font-semibold py-2 px-6 rounded shadow hover:bg-yellow-500 transition">
                Tambah Data
            </button>
        </div>
    </form>
</div>
@endsection
