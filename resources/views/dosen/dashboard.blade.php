@extends('layouts.master')

@section('title')
    Data Dosen
@endsection

@section('content')
    <div class="space py-3"></div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h2 class="text-lg font-semibold text-gray-800">Daftar Dosen</h2>
            <a href="{{ route('dosen.create') }}" class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold py-2 px-4 rounded">
                Tambah Data
            </a>
        </div>

        <div class="overflow-x-auto p-4">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead>
                    <tr class="bg-blue-900 text-white">
                        <th class="px-4 py-3">NO</th>
                        <th class="px-4 py-3">NIP</th>
                        <th class="px-4 py-3">NAMA</th>
                        <th class="px-4 py-3">ALAMAT</th>
                        {{-- <th class="px-4 py-3">Tindakan</th> --}}
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @foreach ($dosen as $item)
                        <tr onclick="window.location='{{ route('dosen.show', $mhs->id_dosen) }}';"class="hover:bg-gray-100 transition-colors duration-200 cursor-pointer">
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">{{ $item->nip }}</td>
                            <td class="px-4 py-3">{{ $item->nama }}</td>
                            <td class="px-4 py-3">{{ $item->alamat }}</td>
                            {{-- <td class="px-4 py-3">
                                <div class="flex space-x-2">
                                    <a href="{{ route('dosen.edit', $item->id_dosen) }}" class="bg-yellow-400 hover:bg-yellow-500 text-black p-2 rounded">
                                        <i class="ph ph-pencil"></i>
                                    </a>
                                    <form action="{{ route('dosen.destroy', $item->id_dosen) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-black p-2 rounded">
                                            <i class="ph ph-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
