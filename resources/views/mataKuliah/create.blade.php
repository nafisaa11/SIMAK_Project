@extends('layouts.master')

@section('title')
Tambah Mata Kuliah
@endsection

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Tambah Mata Kuliah</h2>
    <form action="{{ route('mataKuliah.index') }}" method="post" class="space-y-4">
        @csrf
        <div>
            <label for="kode_matkul" class="block text-gray-700 text-sm font-bold mb-2">Kode Mata Kuliah</label>
            <input type="text" name="kode_matkul" id="kode_matkul" value="{{ old('kode_matkul') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div>
            <label for="nama_matkul" class="block text-gray-700 text-sm font-bold mb-2">Nama Mata Kuliah</label>
            <input type="number" name="nama_matkul" id="nama_matkul" step="0.01" value="{{ old('nama_matkul') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div>
            <label for="semester" class="block text-gray-700 text-sm font-bold mb-2">Jumlah Semester</label>
            <input type="number" name="semester" id="semester" maxlength="2" value="{{ old('semester') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div>
            <label for="sks" class="block text-gray-700 text-sm font-bold mb-2">Jumlah SKS</label>
            <input type="number" name="sks" id="sks" maxlength="2" value="{{ old('sks') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
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