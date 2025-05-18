@extends('layouts.master')

@section('title')
FRS
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200 bg-gray-50">
        <a href="{{ route('frs.create') }}" class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold py-2 px-4 rounded">
            Tambah FRS
        </a>
    </div>

    <div class="overflow-x-auto p-4">
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead>
                <tr class="bg-blue-900 text-white">
                    <th class="px-4 py-3">NO</th>
                    <th class="px-4 py-3">KODE MATA KULIAH</th>
                    <th class="px-4 py-3">MATA KULIAH - HARI - JAM</th>
                    <th class="px-4 py-3">DOSEN</th>
                    <th class="px-4 py-3">SKS</th>
                    <th class="px-4 py-3">TINDAKAN</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
                @foreach($frses as $frs)
                <tr class="hover:bg-gray-100 transition-colors duration-200">
                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3">{{ $frs->kode_matkul ?? '-' }}</td>
                    <td class="px-4 py-3">
                        {{ $frs->nama_matkul }}<br>
                        Hari: {{ $frs->hari }}<br>
                        Jam: {{ $frs->jam_awal }} - {{ $frs->jam_akhir }}
                    </td>
                    <td class="px-4 py-3">{{ $frs->dosen }}</td>
                    <td class="px-4 py-3">{{ $frs->sks }}</td>
                    <td class="px-4 py-3">
                        <div class="flex space-x-2">
                            <a href="{{ route('frs.edit', $frs->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-black p-2 rounded" title="Edit">
                                <i class="ph ph-pencil"></i>
                            </a>
                            <form action="{{ route('frs.destroy', $frs->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-black p-2 rounded" title="Hapus">
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
