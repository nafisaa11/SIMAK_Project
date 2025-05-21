@extends('layouts.master')

@section('title')
    Data Dosen
@endsection

@section('content')
    <div class="space py-3"></div>
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto p-4">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead>
                    <tr class="bg-blue-900 text-white">
                        <th class="px-4 py- text-center">NO</th>
                        <th class="px-4 py-3">NIP</th>
                        <th class="px-4 py-3">NAMA</th>
                        <th class="px-4 py-3">ALAMAT</th>
                        @role('admin')
                            <th class="px-4 py-3">STATUS</th>
                            <th class="px-4 py-3">TINDAKAN</th>
                        @endrole
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @foreach ($dosen as $item)
                        <tr class="hover:bg-gray-100 transition-colors duration-200 cursor-pointer">
                            <td class="px-4 py-3 text-center" onclick="window.location='{{ route('dosen.show', $item->id_dosen) }}';">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-4 py-3" onclick="window.location='{{ route('dosen.show', $item->id_dosen) }}';">
                                {{ $item->nip }}
                            </td>
                            <td class="px-4 py-3" onclick="window.location='{{ route('dosen.show', $item->id_dosen) }}';">
                                {{ $item->user->name }}
                            </td>
                            <td class="px-4 py-3" onclick="window.location='{{ route('dosen.show', $item->id_dosen) }}';">
                                {{ $item->alamat }}
                            </td>
                            @role('admin')
                            <td class="px-4 py-3" onclick="window.location='{{ route('dosen.show', $item->id_dosen) }}';">
                                {{ $item->status }}
                            </td>
                            @endrole
                            <td class="px-4 py-3">
                                @role('admin')
                                    <div class="flex space-x-2">
                                        <a href="{{ route('dosen.edit', $item->id_dosen) }}"
                                            class="bg-yellow-400 hover:bg-yellow-500 text-black p-2 rounded"
                                            onclick="event.stopPropagation();">
                                            <i class="ph ph-pencil"></i>
                                        </a>
                                        <form action="{{ route('dosen.destroy', $item->id_dosen) }}" method="POST"
                                            onsubmit="event.stopPropagation(); return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-black p-2 rounded">
                                                <i class="ph ph-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endrole
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection
