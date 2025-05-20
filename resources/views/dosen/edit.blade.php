@extends('layouts.master')
@section('title')
Edit Data Dosen
@endsection

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Tambah Data Dosen</h2>
    <form action="{{ route('dosen.update', $dosen->id_dosen) }}" method="post" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="nip" class="block text-gray-700 text-sm font-bold mb-2">nip</label>
            <input type="text" name="nip" id="nip" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('nip', $dosen->nip) }}" required>
        </div>
        <div>
            <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('nama', $dosen->nama) }}" required>
        </div>
        <div>
            <label for="alamat" class="block text-gray-700 text-sm font-bold mb-2">alamat</label>
            <input type="text" name="alamat" id="alamat" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('alamat', $dosen->alamat) }}" required>
        </div>
        <div>
            <label for="jenis_kelamin" class="block text-gray-700 text-sm font-bold mb-2">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">Pilih</option>
                <option value="Laki-laki" {{ old('jenis_kelamin', $dosen->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', $dosen->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        
        <div>
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('email', $dosen->email) }}" required>
        </div>
        <div>
            <label for="no_telp" class="block text-gray-700 text-sm font-bold mb-2">Nomor HP</label>
            <input type="tel" name="no_telp" id="no_telp" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('no_telp', $dosen->no_telp) }}">
        </div>
        <div>
            <label for="agama" class="block text-gray-700 text-sm font-bold mb-2">Agama</label>
            <select name="agama" id="agama" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Pilih</option>
                <option value="Islam" {{ old('agama', $dosen->agama ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
                <option value="Kristen" {{ old('agama', $dosen->agama ?? '') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                <option value="Katolik" {{ old('agama', $dosen->agama ?? '') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                <option value="Hindu" {{ old('agama', $dosen->agama ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                <option value="Buddha" {{ old('agama', $dosen->agama ?? '') == 'Budha' ? 'selected' : '' }}>Buddha</option>
                <option value="Konghucu" {{ old('agama', $dosen->agama ?? '') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
            </select>
        </div>
        <div class="flex justify-center gap-6 mt-8">
            <button type="button" onclick="window.history.back()" class="bg-gray-400 text-white font-semibold py-2 px-6 rounded shadow hover:bg-gray-500">
                Batalkan Perubahan
            </button>
            <button type="submit" class="bg-yellow-400 text-black font-semibold py-2 px-6 rounded shadow hover:bg-yellow-500">
                Ubah Data
            </button>
        </div>
    </form>
</div>
@endsection