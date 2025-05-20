@extends('layouts.master')

@section('title')
Kelas
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
            <thead class="bg-gray-900 text-white text-sm font-semibold uppercase">
                <tr>
                    <th class="px-6 py-3 text-left">No</th>
                    <th class="px-6 py-3 text-left">Kelas</th>
                    <th class="px-6 py-3 text-left">Dosen Wali</th>
                    <th class="px-6 py-3 text-left">Jumlah Mahasiswa</th>
                    <th class="px-6 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700 divide-y divide-gray-200">
                @foreach($kelases as $key => $kelas)
                <tr class="hover:bg-gray-100 transition-colors duration-200">
                    <td class="px-6 py-3">{{ $loop->iteration }}</td>
                    <td class="px-6 py-3">
                        {{ $kelas->prodi->kode_prodi }} {{ $kelas->nama_kelas }}
                    </td>
                    <td class="px-6 py-3">{{ $kelas->dosen->nama_dosen}}</td>
                    <td class="px-6 py-3">{{ $kelas->mahasiswa->count() }}</td>
                    <td class="px-6 py-3 flex gap-2">
                        <a href="{{ route('kelas.edit', $kelas->id_kelas) }}" class="text-indigo-600 hover:underline">Edit</a>
                        <form action="{{ route('kelas.destroy', $kelas->id_kelas) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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
