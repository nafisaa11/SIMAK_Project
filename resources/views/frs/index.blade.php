@extends('layouts.master')

@section('title', 'FRS')

@section('content')
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <!-- Header Mahasiswa dan Tombol -->
    <div class="flex justify-between items-start px-6 py-4 border-b border-gray-200 bg-gray-50">
        <!-- Informasi Mahasiswa -->
        <div>
            <table class="text-sm">
                <tr>
                    <td class="font-semibold pr-2">Nama</td>
                    <td>: {{ $mahasiswa?->user?->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="font-semibold pr-2">NRP</td>
                    <td>: {{ $mahasiswa?->nrp ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="font-semibold pr-2">Kelas</td>
                    <td>: {{ $mahasiswa?->kelas?->prodi?->kode_prodi ?? '-' }} {{ $mahasiswa?->kelas?->kelas ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="font-semibold pr-2">Semester</td>
                    <td>: Bentar Dlu</td>
                </tr>
            </table>
        </div>

        <!-- Tombol Tambah FRS -->
        <div>
            <button onclick="toggleModal()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Tambah FRS
            </button>
        </div>
    </div>

    <!-- TABEL FRS -->
    <div class="overflow-x-auto p-4">
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead>
                <tr class="bg-blue-900 text-white">
                    <th class="px-4 py-3 text-center">NO</th>
                    <th class="px-4 py-3">KODE MATA KULIAH</th>
                    <th class="px-4 py-3">MATA KULIAH - HARI - JAM</th>
                    <th class="px-4 py-3">DOSEN</th>
                    <th class="px-4 py-3">SKS</th>
                    <th class="px-4 py-3">KELAS</th>
                    <th class="px-4 py-3">PERSETUJUAN</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
                @foreach ($frses as $frs)
                    @php
                        $jadwal = $frs->nilai->jadwal ?? null;
                        $matakuliah = $frs->nilai->jadwal->matkul ?? null;
                        $dosen = $frs->nilai->jadwal->dosen->user ?? null;
                        $kelas = $frs->nilai->mahasiswa->kelas ?? null;
                    @endphp
                    <tr class="hover:bg-gray-100 transition-colors duration-200">
                        <td class="px-4 py-3 text-center">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $matakuliah->kode_matkul ?? '-' }}</td>
                        <td class="px-4 py-3">
                            {{ $matakuliah->nama_matkul ?? '-' }}<br>
                            Hari: {{ $jadwal->hari ?? '-' }}<br>
                            Jam: {{ $jadwal->jam_awal ?? '-' }} - {{ $jadwal->jam_akhir ?? '-' }}
                        </td>
                        <td class="px-4 py-3">{{ $dosen->name ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $matakuliah->sks ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $kelas->kelas ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $frs->disetujui ?? 'Belum Disetujui' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL PILIH JADWAL KULIAH -->
<div id="frsModal" class="fixed z-10 inset-0 overflow-y-auto hidden bg-black bg-opacity-40">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full p-6">
            <h2 class="text-xl font-bold mb-4">Pilih Jadwal Kuliah</h2>
            <!-- Pesan sukses atau error -->
@if(session('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

            <form action="{{ route('frs.store') }}" method="POST" onsubmit="console.log('Form submitted')">

                @csrf
                <table class="table-auto w-full text-sm text-left text-gray-600">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="p-2 text-center">Pilih</th>
                            <th class="p-2">Kode MK</th>
                            <th class="p-2">Nama MK - Hari - Jam</th>
                            <th class="p-2">Dosen</th>
                            <th class="p-2">SKS</th>
                            <th class="p-2">Kelas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwalKuliahs as $jadwal)
                            <tr>
                                <td class="p-2 text-center">
                                    <input type="radio" name="id_jadwal_kuliah" value="{{ $jadwal->id_jadwal_kuliah }}" required>
                                </td>
                                <td class="p-2">{{ $jadwal->matkul->kode_matkul }}</td>
                                <td class="p-2">{{ $jadwal->matkul->nama_matkul }} - {{ $jadwal->hari }} - {{ $jadwal->jam_awal }} - {{ $jadwal->jam_akhir }}</td>
                                <td class="p-2">{{ $jadwal->dosen->user->name }}</td>
                                <td class="p-2">{{ $jadwal->matkul->sks }}</td>
                                <td class="p-2">{{ $jadwal->kelas->prodi->kode_prodi }} {{ $jadwal->kelas->kelas }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-right mt-4">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        Tambah FRS
                    </button>
                    <button type="button" onclick="toggleModal()" class="ml-2 text-gray-600">Batal</button>
                </div>
            </form>
            @error('id_jadwal_kuliah')
    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
@enderror

        </div>
    </div>
</div>

<!-- SCRIPT MODAL -->
<script>
function toggleModal() {
    const modal = document.getElementById('frsModal');
    modal.classList.toggle('hidden');
}
</script>
@endsection
