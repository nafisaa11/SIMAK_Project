@extends('layouts.master')

@section('title')
Nilai
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
        <h2 class="text-xl font-semibold text-gray-700">Data Nilai</h2>
        <a href="{{ route('nilai.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded">
            Tambah Nilai
        </a>
    </div>
    <div class="overflow-x-auto p-4">
        <table class="min-w-full table-auto">
            <thead>
                    <tr class="bg-blue-900 text-white">
                    <th class="px-6 py-3 text-center">No</th>
                    <th class="px-6 py-3 text-left">Mahasiswa</th>
                    <th class="px-6 py-3 text-left">Mata Kuliah</th>
                    <th class="px-6 py-3 text-left">Nilai Angka</th>
                    <th class="px-6 py-3 text-left">Nilai Huruf</th>
                    <th class="px-6 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700 divide-y divide-gray-200">
                @foreach($nilais as $key => $nilai)
                <tr class="hover:bg-gray-100 transition-colors duration-200">
                    <td class="px-6 py-3 text-center">{{ $loop->iteration }}</td>
                    <td class="px-6 py-3">
                        {{ $nilai->mahasiswa->nama }}<br>
                        <span class="text-xs text-gray-500">{{ $nilai->mahasiswa->nrp }}</span>
                    </td>
                    <td class="px-6 py-3 ">{{ $nilai->matkul->nama_matkul }}</td>
                    <td class="px-6 py-3">{{ $nilai->nilai_angka }}</td>
                    <td class="px-6 py-3">{{ $nilai->nilai_huruf }}</td>
                    <td class="px-6 py-3 flex gap-2">
                        <a href="{{ route('nilai.edit', $nilai->id_nilai) }}" class="text-indigo-600 hover:underline">Edit</a>
                        <form action="{{ route('nilai.destroy', $nilai->id_nilai) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
