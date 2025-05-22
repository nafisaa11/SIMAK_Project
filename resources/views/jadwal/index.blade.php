@extends('layouts.master')

@section('title')
Daftar Jadwal Kuliah
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200 bg-gray-50">
        <a href="{{ route('jadwal.create') }}"  class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold py-2 px-4 rounded">
            Tambah Jadwal
        </a>
    </div>
    <div class="overflow-x-auto p-4">
        @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-800 p-3 rounded">{{ session('success') }}</div>
        @endif
        
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-900 text-white text-sm font-semibold uppercase">
                <tr class="bg-blue-900 text-white">
                    <th class="px-6 py-3 text-center">No</th>
                    <th class="px-6 py-3 text-left">Hari</th>
                    <th class="px-6 py-3 text-left">Daftar Jadwal</th>
                    <th class="px-6 py-3 text-left">Jam</th>
                    <th class="px-6 py-3 text-left">Kelas</th>
                    @role('admin')
                    <th class="px-6 py-3 text-left">Aksi</th>
                    @endrole
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700 divide-y divide-gray-200">
                @foreach($jadwals as $key => $jd)
                <tr class="hover:bg-gray-100 transition-colors duration-200">
                    <td class="px-6 py-3 text-center">{{ $loop->iteration }}</td>
                    <td class="px-6 py-3">{{ $jd->hari }}</td>
                    <td class="px-6 py-3">
                        <div class="font-semibold">{{ $jd->matkul->nama_matkul }}</div>
                        <div>{{ $jd->dosen->user->name }}</div>
                        <div>{{ $jd->ruangan }}</div>
                    </td>
                    <td class="px-6 py-3">{{ \Carbon\Carbon::parse($jd->jam_awal)->format('H:i') }} sd {{ \Carbon\Carbon::parse($jd->jam_akhir)->format('H:i') }}</td>
                    <td class="px-6 py-3">{{ $jd->kelas->prodi->kode_prodi ?? '-' }} {{ $jd->kelas->kelas }}</td>
                    @role('admin')
                    <td class="px-6 py-3 flex gap-2">
                        <div class="flex space-x-2">
                            <a href="{{ route('jadwal.edit', $jd->id_jadwal_kuliah) }}" class="bg-yellow-400 hover:bg-yellow-500 text-black p-2 rounded">
                                <i class="ph ph-pencil"></i>
                            </a>
                            <form action="{{ route('jadwal.destroy', $jd->id_jadwal_kuliah) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white p-2 rounded">
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