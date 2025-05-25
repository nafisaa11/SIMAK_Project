@extends('layouts.master')

@section('title', 'Daftar Mahasiswa Bimbingan')

@section('content')
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
        @foreach($kelasWali as $kelas)
            <h2 class="text-xl font-semibold text-gray-700">Daftar Mahasiswa {{ $kelas->prodi->jenjang }} {{ $kelas->prodi->nama_prodi }} {{ $kelas->kelas }}</h2>
        @endforeach
    </div>
{{-- 
    <!-- Info Kelas yang Diwali -->
    @if($kelasWali->count() > 0)
        <div class="m-6 p-4 bg-blue-50 rounded-lg">
            <h3 class="font-semibold text-blue-800 mb-2">Kelas yang Anda Wali:</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">

            </div>
        </div>
    @endif --}}

    <div class="overflow-x-auto p-4">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-blue-900 text-white">
                    <th class="px-6 py-3 text-center">NO</th>
                    <th class="px-6 py-3 text-left">NIM</th>
                    <th class="px-6 py-3 text-left">NAMA MAHASISWA</th>
                    <th class="px-6 py-3 text-left">KELAS</th>
                    <th class="px-6 py-3 text-center">SEMESTER</th>
                    <th class="px-6 py-3 text-center">AKSI</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700 divide-y divide-gray-200">
                @forelse($mahasiswaList as $index => $mhs)
                <tr class="hover:bg-gray-100">
                    <td class="px-6 py-3 text-center">{{ $index + 1 }}</td>
                    <td class="px-6 py-3 text-left">{{ $mhs->nrp }}</td>
                    <td class="px-6 py-3 text-left">{{ $mhs->user->name }}</td>
                    <td class="px-6 py-3 text-left">
                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">
                            {{ $mhs->kelas->prodi->jenjang }} {{ $mhs->kelas->prodi->nama_prodi }} {{ $mhs->kelas->kelas }}
                        </span> 
                    </td>
                    <td class="px-6 py-3 text-center">Semester {{ $mhs->semester }}</td>
                    <td class="px-6 py-3 text-center">
                        <a href="{{ route('frs.index.byMahasiswa', $mhs->id_mahasiswa) }}" 
                           class="text-sm bg-yellow-500 text-blue-900 px-3 py-1 rounded hover:bg-yellow-600">
                            Lihat FRS
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4">Tidak ada mahasiswa dalam bimbingan Anda</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection