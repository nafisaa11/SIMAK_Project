@extends('layouts.master')

@section('title')
Edit Nilai
@endsection

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Edit Nilai Mahasiswa</h2>
    <form action="{{ route('nilai.update', $nilai->id_nilai) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="id_matkul" class="block text-gray-700 text-sm font-bold mb-2">Mata Kuliah</label>
            <select name="id_matkul" id="id_matkul" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">Pilih Mata Kuliah</option>
                @foreach($matkuls as $mk)
                <option value="{{ $mk->id_matkul }}" {{ $mk->id_matkul == $nilai->id_matkul ? 'selected' : '' }}>
                    {{ $mk->nama_matkul }} ({{ $mk->kode_matkul }})
                </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="nilai_angka" class="block text-gray-700 text-sm font-bold mb-2">Nilai Angka</label>
            <select name="nilai_angka" id="nilai_angka" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                @php
                $nilaiOptions = [0, 1, 2, 2.5, 2.75, 3, 3.25, 3.5, 3.75, 4];
                @endphp
                @foreach($nilaiOptions as $opt)
                <option value="{{ $opt }}" {{ $nilai->nilai_angka == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Update Nilai
        </button>
        {{-- <a href="{{ route('nilai.index') }}" class="inline-block text-sm text-gray-600 ml-4 hover:underline">Kembali</a> --}}
    </form>
</div>

{{-- Script otomatis konversi angka ke huruf --}}
<script>
    document.getElementById('nilai_angka').addEventListener('change', function () {
        const nilai = parseFloat(this.value);
        const nilaiHuruf = document.getElementById('nilai_huruf');

        if (nilai >= 86 && nilai <= 100) {
            nilaiHuruf.value = 'A';
        } else if (nilai >= 81 && nilai <= 85) {
            nilaiHuruf.value = 'AB';
        } else if (nilai >= 76 && nilai <= 80) {
            nilaiHuruf.value = 'A-';
        } else if (nilai >= 71 && nilai <= 75) {
            nilaiHuruf.value = 'B+';
        } else if (nilai >= 66 && nilai <= 70) {
            nilaiHuruf.value = 'B';
        } else if (nilai >= 61 && nilai <= 65) {
            nilaiHuruf.value = 'B-';
        } else if (nilai >= 56 && nilai <= 60) {
            nilaiHuruf.value = 'C';
        } else if (nilai >= 41 && nilai <= 100) {
            nilaiHuruf.value = 'D';
        } else if (nilai >= 0 && nilai <= 41) {
            nilaiHuruf.value = 'E';
        } else {
            nilaiHuruf.value = 'Tidak Teridentifikasi';
        }
    });
</script>
@endsection