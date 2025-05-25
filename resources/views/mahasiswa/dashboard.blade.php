@extends('layouts.master')

@section('title')
    Data Mahasiswa
@endsection

@section('content')
    <div class="space py-3"></div>
    <div class="bg-white rounded-lg shadow-md overflow-hidden">

        {{-- Filter Section --}}
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <form action="#" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                <div class="flex-1 w-full">
                    <label for="prodi_id" class="block text-sm font-medium text-gray-700 mb-1">Program Studi</label>
                    <select name="prodi_id" id="prodi_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2">
                        <option value="">Semua Program Studi</option>
                        @foreach($prodis as $prodi)
                            <option value="{{ $prodi->id_prodi }}" {{ request('prodi_id') == $prodi->id_prodi ? 'selected' : '' }}>
                                {{ $prodi->jenjang }} {{ $prodi->nama_prodi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex-1 w-full">
                    <label for="kelas_id" class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                    <select name="kelas_id" id="kelas_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2">
                        <option value="">Semua Kelas</option>
                        @foreach($kelasList as $kelas)
                            <option value="{{ $kelas->id_kelas }}" {{ request('kelas_id') == $kelas->id_kelas ? 'selected' : '' }}>
                                {{ $kelas->kelas }} ({{ $kelas->prodi->kode_prodi ?? '' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="w-full md:w-auto">
                    <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Filter
                    </button>
                </div>
            </form>
        </div>
        {{-- End Filter Section --}}

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
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @forelse ($mahasiswa as $mhs)
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
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-3 text-center text-gray-500">Tidak ada data mahasiswa yang ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
