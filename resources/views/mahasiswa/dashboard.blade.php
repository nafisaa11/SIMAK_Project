@extends('layouts.master')

@section('title')
    Data Mahasiswa
@endsection

@section('content')
    <div class="space py-3"></div>
    <div class="bg-white rounded-lg shadow-md overflow-hidden">


        <div class="overflow-x-auto p-4">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead>
                    <tr class="bg-blue-900 text-white">
                        <th class="px-4 py-3 text-center ">NO</th>
                        <th class="px-4 py-3">NRP</th>
                        <th class="px-4 py-3">NAMA</th>
                        <th class="px-4 py-3">KELAS</th>
                        <th class="px-4 py-3">JENIS KELAMIN</th>
                        @role('admin')
                            <th class="px-4 py-3">TINDAKAN</th>
                        @endrole
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @foreach ($mahasiswa as $mhs)
                        <tr class="hover:bg-gray-100 transition-colors duration-200 cursor-pointer">
                            <td class="px-4 py-3 text-center"
                                onclick="window.location='{{ route('mahasiswa.show', $mhs->id_mahasiswa) }}';">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-4 py-3"
                                onclick="window.location='{{ route('mahasiswa.show', $mhs->id_mahasiswa) }}';">
                                {{ $mhs->nrp }}
                            </td>
                            <td class="px-4 py-3"
                                onclick="window.location='{{ route('mahasiswa.show', $mhs->id_mahasiswa) }}';">
                                {{ $mhs->user->name }}
                            </td>
                            <td class="px-4 py-3"
                                onclick="window.location='{{ route('mahasiswa.show', $mhs->id_mahasiswa) }}';">
                                {{ $mhs->kelas->prodi->kode_prodi }} {{ $mhs->kelas->kelas }}
                            </td>
                            <td class="px-4 py-3"
                                onclick="window.location='{{ route('mahasiswa.show', $mhs->id_mahasiswa) }}';">
                                {{ $mhs->jenis_kelamin }}
                            </td>
                            @role('admin')
                            <td class="px-4 py-3">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('mahasiswa.edit', $mhs->id_mahasiswa) }}"
                                            class="bg-yellow-400 hover:bg-yellow-500 text-black p-2 rounded"
                                            onclick="event.stopPropagation();">
                                            <i class="ph ph-pencil"></i>
                                        </a>
                                        <form action="{{ route('mahasiswa.destroy', $mhs->id_mahasiswa) }}" method="POST"
                                            onsubmit="event.stopPropagation(); return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-black p-2 rounded">
                                                <i class="ph ph-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                @endrole
                        </tr>
                    @endforeach
                </tbody>



            </table>
        </div>
    </div>
@endsection
