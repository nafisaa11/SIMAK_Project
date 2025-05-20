@extends('layouts.master')
@section('title')
Edit Data Dosen
@endsection

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Edit Data Dosen</h2>
    <form action="{{ route('dosen.update', $dosen->id_dosen) }}" method="post" class="space-y-4">
        @csrf
        @method('PUT')
        
        <div>
            <label for="nip" class="block text-gray-700 text-sm font-bold mb-2">NIP</label>
            <input type="text" name="nip" id="nip" value="{{ old('nip', $dosen->nip) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div>
            <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" value="{{ old('nama', $dosen->user->name) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div>
            <label for="alamat" class="block text-gray-700 text-sm font-bold mb-2">Alamat</label>
            <input type="text" name="alamat" id="alamat" value="{{ old('alamat', $dosen->alamat) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div>
            <label for="jenis_kelamin" class="block text-gray-700 text-sm font-bold mb-2">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">Pilih</option>
                <option value="Laki-laki" {{ old('jenis_kelamin', $dosen->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', $dosen->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div>
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $dosen->user->email) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div>
            <label for="no_telp" class="block text-gray-700 text-sm font-bold mb-2">Nomor HP</label>
            <input type="tel" name="no_telp" id="no_telp" value="{{ old('no_telp', $dosen->no_telp) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div>
            <label for="agama" class="block text-gray-700 text-sm font-bold mb-2">Agama</label>
            <select name="agama" id="agama" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Pilih</option>
                @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                    <option value="{{ $agama }}" {{ old('agama', $dosen->agama) == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status</label>
            <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">Pilih</option>
                <option value="Dosen Biasa" {{ old('status', $dosen->status) == 'Dosen Biasa' ? 'selected' : '' }}>Dosen Biasa</option>
                <option value="Dosen wali" {{ old('status', $dosen->status) == 'Dosen wali' ? 'selected' : '' }}>Dosen Wali</option>
            </select>
        </div>

        <div class="flex justify-center gap-6 mt-8">
            <button type="button" onclick="window.history.back()" class="bg-gray-400 text-white font-semibold py-2 px-6 rounded shadow hover:bg-gray-500">
                Kembali
            </button>
            <button type="submit" class="bg-yellow-400 text-black font-semibold py-2 px-6 rounded shadow hover:bg-yellow-500">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
