@extends('layouts.master')

@section('title')
Tambah Jadwal Kuliah
@endsection

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Tambah Jadwal Kuliah</h2>
    <form action="{{ route('jadwal.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="id_matkul" class="block text-gray-700 text-sm font-bold mb-2">Mata Kuliah</label>
            <select name="id_matkul" id="id_matkul" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">Pilih Mata Kuliah</option>
                @foreach($matkuls as $mk)
                <option value="{{ $mk->id_matkul }}">{{ $mk->nama_matkul }} ({{ $mk->kode_matkul }})</option>
                @endforeach
            </select>
            @error('id_matkul')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="id_dosen" class="block text-gray-700 text-sm font-bold mb-2">Dosen</label>
            <select name="id_dosen" id="id_dosen" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">Pilih Dosen</option>
                @foreach($dosens as $ds)
                <option value="{{ $ds->id_dosen }}">{{ $ds->user->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="id_prodi" class="block mb-1 text-sm font-medium text-gray-700">Program Studi</label>
            <select name="id_prodi" id="id_prodi" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-yellow-400" required>
                <option value="">Pilih Program Studi</option>
                @foreach($prodies as $prodi)
                    <option value="{{ $prodi->id_prodi }}">{{ $prodi->jenjang }} {{ $prodi->nama_prodi }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="id_kelas" class="block mb-1 text-sm font-medium text-gray-700">Kelas</label>
            <select name="id_kelas" id="id_kelas"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-yellow-400"
                required>
                <option value="">Pilih Kelas</option>
                {{-- Akan diisi via AJAX --}}
            </select>
        </div>

        <div>
            <label for="hari" class="block text-gray-700 text-sm font-bold mb-2">Hari</label>
            <select name="hari" id="hari" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">Pilih Hari</option>
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
                <option value="Sabtu">Sabtu</option>
            </select>
        </div>

        <div>
            <label for="ruangan" class="block text-gray-700 text-sm font-bold mb-2">Ruangan</label>
            <input type="text" name="ruangan" id="ruangan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="flex space-x-4">
            <div class="w-1/2">
                <label for="jam_awal" class="block text-gray-700 text-sm font-bold mb-2">Jam Mulai</label>
                <input type="time" name="jam_awal" id="jam_awal" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="w-1/2">
                <label for="jam_akhir" class="block text-gray-700 text-sm font-bold mb-2">Jam Selesai</label>
                <input type="time" name="jam_akhir" id="jam_akhir" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
        </div>

        <div class="flex items-center justify-between pt-4">
            <a href="{{ route('jadwal.index') }}" class="text-indigo-600 hover:text-indigo-800">Kembali</a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Simpan Jadwal
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
{{-- 
<script>
    document.getElementById('id_prodi').addEventListener('change', function () {
        const prodiId = this.value;
        const kelasSelect = document.getElementById('id_kelas');

        // Kosongkan dulu pilihan kelas
        kelasSelect.innerHTML = '<option value="">Loading...</option>';

        fetch(`/get-kelas-by-prodi/${prodiId}`)
            .then(response => response.json())
            .then(data => {
                let options = '<option value="">Pilih Kelas</option>';
                data.forEach(kelas => {
                    options += `<option value="${kelas.id_kelas}">${kelas.kelas}</option>`;
                });
                kelasSelect.innerHTML = options;
            })
            .catch(error => {
                console.error('Error:', error);
                kelasSelect.innerHTML = '<option value="">Terjadi kesalahan</option>';
            });
    });
</script> --}}
@endif
@endsection