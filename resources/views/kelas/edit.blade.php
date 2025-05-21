@extends('layouts.master')

@section('title')
Tambah Kelas
@endsection

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Tambah Kelas</h2>
    <form action="{{ route('kelas.index') }}" method="post" class="space-y-4">
        @csrf
        <div>
            <label for="kode_kelas" class="block text-gray-700 text-sm font-bold mb-2">Kode Kelas</label>
            <input type="text" name="kode_kelas" id="kode_kelas" value="{{ old('kode_kelas') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div>
            <label for="nama_prodi" class="block text-gray-700 text-sm font-bold mb-2">Nama Kelas</label>
            <input type="text" name="nama_prodi" id="nama_prodi" step="0.01" value="{{ old('nama_prodi') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div>
            <label for="kelas" class="block text-gray-700 text-sm font-bold mb-2">Jumlah kelas</label>
            <select name="kelas" id="kelas" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            @foreach(['A', 'B', 'C', 'D'] as $kelas)
                <option value="{{ $kelas }}" {{ $jadwal->kelas == $kelas ? 'selected' : '' }}>
                    {{ $kelas }}
                </option>
            @endforeach
            </select>
            @error('kelas')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-center gap-6 mt-8">
            <button type="button" onclick="window.history.back()"
                class="bg-gray-400 text-white font-semibold py-2 px-6 rounded shadow hover:bg-gray-500">
                Kembali
            </button>
            <button type="submit"
                class="bg-yellow-400 text-black font-semibold py-2 px-6 rounded shadow hover:bg-yellow-500">
                Tambah Data
            </button>
        </div>
    </form>
</div>
@endsection