@extends('layouts.master')

@section('title')
Daftar Kelas
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
        <h2 class="text-xl font-semibold text-gray-700">Data Kelas</h2>
        <a href="{{ route('kelas.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded">
            Tambah Kelas
        </a>
    </div>
    <div class="overflow-x-auto p-4">
        <table class="min-w-full table-auto">
            <thead>
                 <tr class="bg-blue-900 text-white">
                    <th class="px-6 py-3 text-center">No</th>
                    <th class="px-6 py-3 text-center">Kelas</th>
                    <th class="px-6 py-3 text-center">Dosen Wali</th>
                    <th class="px-6 py-3 text-center">Angkatan</th>
                    <th class="px-6 py-3 text-center">Jumlah Mahasiswa</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700 divide-y divide-gray-200">
                @foreach($kelases as $key => $kelas)
                <tr class="hover:bg-gray-100 transition-colors duration-200">
                    <td class="px-6 py-3 text-center">{{ $loop->iteration }}</td>
                    <td class="px-6 py-3 text-center">
                        {{ $kelas->prodi->kode_prodi }} {{ $kelas->kelas }}
                    </td>
                    <td class="px-6 py-3 text-center">{{ $kelas->dosen->user->name }}</td>
                    <td class="px-6 py-3 text-center">{{ $kelas->angkatan}}</td>
                    <td class="px-6 py-3 text-center">
                            {{ $kelas->mahasiswa_count > 0 ? $kelas->mahasiswa_count : '-' }}
                    </td>

                    <td class="px-4 py-3 text-center align-middle">
                        <div class="flex justify-center items-center space-x-2">
                            <a href="{{ route('kelas.edit', $kelas->id_kelas) }}"
                            class="bg-yellow-400 hover:bg-yellow-500 text-black p-2 rounded">
                                <i class="ph ph-pencil"></i>
                            </a>
                            <form action="{{ route('kelas.destroy', $kelas->id_kelas) }}"
                                method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white p-2 rounded">
                                    <i class="ph ph-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
