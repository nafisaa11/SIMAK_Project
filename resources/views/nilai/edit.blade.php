@extends('layouts.master')

@section('title')
Edit Nilai Mahasiswa
@endsection

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Edit Nilai Mahasiswa</h2>
    <form action="{{ route('nilai.update', $nilai->id_nilai) }}" method="post" class="space-y-4">
        @csrf
        @method('PUT')

        <input type="hidden" name="id_jadwal_kuliah" value="{{ $jadwal->id_jadwal_kuliah }}">
        <input type="hidden" name="id_mahasiswa" value="{{ $mahasiswa->id_mahasiswa }}">

        <div>
            <label for="nilai_angka" class="block text-gray-700 text-sm font-bold mb-2">Nilai Angka</label>
            <input type="text" name="nilai_angka" id="nilai_angka" maxlength="2" value="{{ old('nilai_angka', $nilai->nilai_angka) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div>
            <label for="nilai_huruf" class="block text-gray-700 text-sm font-bold mb-2">Nilai Huruf</label>
            <input type="text" name="nilai_huruf" id="nilai_huruf" value="{{ old('nilai_huruf', $nilai->nilai_huruf) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly>
        </div>

        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Update Nilai
        </button>
    </form>
</div>

{{-- Script otomatis konversi angka ke huruf --}}
<script>
    document.getElementById('nilai_angka').addEventListener('input', function () {
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
        } else if (nilai >= 41 && nilai <= 55) {
            nilaiHuruf.value = 'D';
        } else if (nilai >= 0 && nilai <= 40) {
            nilaiHuruf.value = 'E';
        } else {
            nilaiHuruf.value = 'Tidak Teridentifikasi';
        }
    });

    // Inisialisasi konversi saat halaman pertama kali dimuat
    window.addEventListener('DOMContentLoaded', (event) => {
        const nilaiInput = document.getElementById('nilai_angka');
        const eventInput = new Event('input');
        nilaiInput.dispatchEvent(eventInput);
    });
</script>
@endsection
