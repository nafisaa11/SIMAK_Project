@extends('layouts.master')

@section('title')
Tambah Kelas
@endsection

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Tambah Kelas</h2>
    <form action="{{ route('kelas.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="hari" class="block text-gray-700 text-sm font-bold mb-2">Program Studi</label>
            <select name="id_prodi" id="id_prodi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">Pilih Program Studi</option>
                @foreach($prodies as $prodi)
                <option value="{{ $prodi->id_prodi }}">{{ $prodi->jenjang }} {{ $prodi->nama_prodi }} ({{ $prodi->jenjang }})</option>
                @endforeach
            </select>
            @error('id_prodi')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="kelas" class="block text-gray-700 text-sm font-bold mb-2">Kelas</label>
            <select name="kelas" id="kelas" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">Pilih Kelas</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>
        </div>

        <div>
            <label for="id_dosen" class="block text-gray-700 text-sm font-bold mb-2">Dosen</label>
            <select name="id_dosen" id="id_dosen" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">Dosen Wali</option>
                @foreach($dosens as $ds)
                <option value="{{ $ds->id_dosen }}">{{ $ds->user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center justify-between pt-4">
            <a href="{{ route('kelas.index') }}" class="text-indigo-600 hover:text-indigo-800">Kembali</a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Simpan Kelas
            </button>
        </div>
    </form>
</div>
@if(session('error'))
<div class="mb-4 bg-red-100 text-red-800 p-3 rounded">{{ session('error') }}</div>
@endif

@if($errors->any())
<div class="mb-4 bg-red-100 text-red-800 p-3 rounded">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@endsection