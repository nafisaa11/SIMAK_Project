@extends('layouts.master')

@section('title')
Tambah Program Studi
@endsection

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Tambah Program Studi</h2>
    <form action="{{ route('prodi.store') }}" method="post" class="space-y-4">
        @csrf
        <div>
            <label for="kode_prodi" class="block text-gray-700 text-sm font-bold mb-2">Kode Program Studi</label>
            <input type="text" name="kode_prodi" id="kode_prodi" value="{{ old('kode_prodi') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div>
            <label for="jenjang" class="block text-gray-700 text-sm font-bold mb-2">Jenjang</label>
            <input type="text" name="jenjang" id="jenjang" maxlength="2" value="{{ old('jenjang') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div>
            <label for="nama_prodi" class="block text-gray-700 text-sm font-bold mb-2">Nama Program Studi</label>
            <input type="text" name="nama_prodi" id="nama_prodi" step="0.01" value="{{ old('nama_prodi') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
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