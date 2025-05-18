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
                        <th class="px-4 py-3">NO</th>
                        <th class="px-4 py-3">NRP</th>
                        <th class="px-4 py-3">NAMA</th>
                        <th class="px-4 py-3">PROGRAM STUDI</th>
                        <th class="px-4 py-3">JENIS KELAMIN</th>
                        {{-- <th class="px-4 py-3">Tindakan</th> --}}
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @foreach ($mahasiswa as $mhs)
                        <tr onclick="window.location='{{ route('mahasiswa.show', $mhs->id_mahasiswa) }}';"class="hover:bg-gray-100 transition-colors duration-200 cursor-pointer">
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">{{ $mhs->nrp }}</td>
                            <td class="px-4 py-3">{{ $mhs->nama }}</td>
                            <td class="px-4 py-3">{{ $mhs->prodi }}</td>
                            <td class="px-4 py-3">{{ $mhs->jenis_kelamin }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection
