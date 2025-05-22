@extends('layouts.master')

@section('title', 'Daftar Mahasiswa')

@section('content')
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
        <h2 class="text-xl font-semibold text-gray-700">Mahasiswa Kelas {{ $kelas->prodi->jenjang }} {{ $kelas->prodi->nama_prodi }} {{ $kelas->kelas }}</h2>
        <a href="{{ route('kelas.index') }}" class="text-sm text-blue-600 hover:underline">Kembali</a>
    </div>

    <div class="overflow-x-auto p-4">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-blue-900 text-white">
                    <th class="px-6 py-3 text-center">NO</th>
                    <th class="px-6 py-3 text-left">NRP</th>
                    <th class="px-6 py-3 text-left">NAMA MAHASISWA</th>
                    <th class="px-6 py-3 text-center">AKSI</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700 divide-y divide-gray-200">
                @forelse($kelas->mahasiswa as $index => $mhs)
                <tr class="hover:bg-gray-100">
                    <td class="px-6 py-3 text-center">{{ $index + 1 }}</td>
                    <td class="px-6 py-3 text-left">{{ $mhs->nrp }}</td>
                    <td class="px-6 py-3 text-left">{{ $mhs->user->name }}</td>
                    <td class="px-6 py-3 text-center">
                        <a href="{{  route('nilai.mahasiswa',  $mhs->id_mahasiswa) }}" class="text-sm bg-yellow-500 text-blue-900 px-3 py-1 rounded hover:bg-yellow-600">Input Nilai</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4">Belum ada mahasiswa.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
