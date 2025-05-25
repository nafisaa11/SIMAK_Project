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
                    @role('mahasiswa')
                        <th class="px-4 py-3 text-center">Tindakan</th>
                    @endrole
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
                        <td class="px-4 py-3 text-center">
                            <form action="{{ route('frs.destroy', $frs->id_frs) }}" method="POST"
                                onsubmit="event.stopPropagation(); return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white p-2 rounded">
                                        <i class="ph ph-trash"></i>
                                    </button>
                            </form>
                        </td>
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
<div id="frsModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-4xl max-h-[90vh] overflow-hidden">
        <!-- HEADER -->
        <div class="flex justify-between items-center px-6 py-4 border-b bg-gray-100">
            <h2 class="text-xl font-bold text-gray-800">Pilih Jadwal Kuliah</h2>
            <button onclick="toggleModal()" class="text-gray-500 hover:text-red-500 text-2xl font-bold">&times;</button>
        </div>

        <!-- ISI YANG SCROLLABLE -->
        <div class="overflow-y-auto px-6 py-4 space-y-4 max-h-[calc(90vh-120px)]"> {{-- dikurangi header/footer --}}
            <!-- ALERT -->
            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 text-red-800 p-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <!-- FORM -->
            <form action="{{ route('frs.store') }}" method="POST" class="space-y-4">
                @csrf

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-700">
                        <thead class="bg-gray-100 text-sm font-semibold uppercase">
                            <tr>
                                <th class="p-3 text-center">Pilih</th>
                                <th class="p-3">Kode MK</th>
                                <th class="p-3">Mata Kuliah - Hari - Jam</th>
                                <th class="p-3">Dosen</th>
                                <th class="p-3 text-center">SKS</th>
                                <th class="p-3">Kelas</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($jadwalKuliahs as $jadwal)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3 text-center">
                                        <input type="radio" name="id_jadwal_kuliah" value="{{ $jadwal->id_jadwal_kuliah }}" required class="accent-blue-600">
                                    </td>
                                    <td class="p-3">{{ $jadwal->matkul->kode_matkul }}</td>
                                    <td class="p-3">
                                        {{ $jadwal->matkul->nama_matkul }}<br>
                                        {{ $jadwal->hari }} | {{ $jadwal->jam_awal }} - {{ $jadwal->jam_akhir }}
                                    </td>
                                    <td class="p-3">{{ $jadwal->dosen->user->name }}</td>
                                    <td class="p-3 text-center">{{ $jadwal->matkul->sks }}</td>
                                    <td class="p-3">{{ $jadwal->kelas->prodi->kode_prodi }} {{ $jadwal->kelas->kelas }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @error('id_jadwal_kuliah')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </form>
        </div>

        <!-- FOOTER -->
        <div class="flex justify-end items-center gap-3 px-6 mb-6 border-t bg-gray-50 ">
            <button form="frsForm" type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Tambah FRS
            </button>
            <button type="button" onclick="toggleModal()" class="text-gray-600 hover:text-red-500">
                Batal
            </button>
            
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
