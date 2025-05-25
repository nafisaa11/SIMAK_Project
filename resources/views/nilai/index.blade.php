@extends('layouts.master')

@section('title')
Nilai
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
        <table>
            <tbody>
                <tr>
                    <th class="px-3 py-1 text-left">Nama</th>
                    <td class="px-3 py-1 text-left">:</td>
                    <td class="px-3 py-1 text-left">{{ $mahasiswa->user->name}}</td>
                </tr>
                <tr>
                    <th class="px-3 py-1 text-left">NRP</th>
                    <td class="px-3 py-1 text-left">:</td>
                    <td class="px-3 py-1 text-left">{{ $mahasiswa->nrp }}</td>
                </tr>
                <tr>
                    <th class="px-3 py-1 text-left">Kelas</th>
                    <td class="px-3 py-1 text-left">:</td>
                    <td class="px-3 py-1 text-left">{{ $mahasiswa->kelas->prodi->jenjang }} {{ $mahasiswa->kelas->prodi->nama_prodi }} {{ $mahasiswa->kelas->kelas }}</td>
                </tr>
                <tr>
                    <th class="px-3 py-1 text-left">Dosen Wali</th>
                    <td class="px-3 py-1 text-left">:</td>
                    <td class="px-3 py-1 text-left">{{ $mahasiswa->kelas->dosen->user->name }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="overflow-x-auto p-4">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-blue-900 text-white">
                    <th class="px-6 py-3 text-center">NO</th>
                    <th class="px-6 py-3 text-left">MATA KULIAH</th>
                    <th class="px-6 py-3 text-center">SKS</th>
                    <th class="px-6 py-3 text-center">NILAI ANGKA</th>
                    <th class="px-6 py-3 text-center">NILAI HURUF</th>
                    @role('dosen')
                    <th class="px-6 py-3 text-left">AKSI</th>
                    @endrole
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700 divide-y divide-gray-200">
                @php
                    $totalSks = 0;
                    $totalNilaiAngka = 0;
                @endphp

                @foreach($jadwal_kuliahs as $index => $jadwal)
                    @php  
                        $nilai = $nilais->firstWhere('id_jadwal_kuliah', $jadwal->id_jadwal_kuliah); // perbaiki ID
                        $totalSks += $jadwal->matkul->sks;
                        if ($nilai && is_numeric($nilai->nilai_angka)) {
                            $totalNilaiAngka += $nilai->nilai_angka;
                        }
                    @endphp
                    <tr class="hover:bg-gray-100 transition-colors duration-200">
                        <td class="px-6 py-3 text-center">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3">{{ $jadwal->matkul->nama_matkul }}</td>
                        <td class="px-6 py-3 text-center">{{ $jadwal->matkul->sks }}</td>
                        <td class="px-6 py-3 text-center">{{ $nilai->nilai_angka ?? '-' }}</td>
                        <td class="px-6 py-3 text-center">{{ $nilai->nilai_huruf ?? '-' }}</td>
                        @role('dosen')
                        <td class="px-6 py-3 flex gap-2">
                            @if($nilai)
                                <a href="{{ route('nilai.edit', $nilai->id_nilai) }}" class="text-yellow-600 hover:underline">Edit</a>
                                <form action="{{ route('nilai.destroy', $nilai->id_nilai) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            @else
                                <a href="{{ route('nilai.create') }}?id_mahasiswa={{ $mahasiswa->id_mahasiswa }}&id_jadwal_kuliah={{ $jadwal->id_jadwal_kuliah }}" class="text-blue-600 hover:underline">Input</a>
                            @endif
                        </td>
                        @endrole
                    </tr>
                @endforeach

                <tr class="bg-gray-100 font-semibold">
                    <td></td>
                    <th class="px-6 py-3 text-center">Jumlah</th>
                    <td class="px-6 py-3 text-center">{{ $totalSks }}</td>
                    <td class="px-6 py-3 text-center">{{ $totalNilaiAngka }}</td>
                    <td class="px-6 py-3 text-center"></td>
                    <td></td>
                </tr>

                @php
                    $totalSks = 0;
                    $totalNilaiAngka = 0;
                    $totalBobotKaliSks = 0;
                @endphp

                @foreach($jadwal_kuliahs as $index => $jadwal)
                    @php  
                        $nilai = $nilais->firstWhere('id_jadwal_kuliah', $jadwal->id_jadwal_kuliah);
                        $sks = $jadwal->matkul->sks;
                        $totalSks += $sks;

                        if ($nilai && is_numeric($nilai->nilai_angka)) {
                            $totalNilaiAngka += $nilai->nilai_angka;

                            // Hitung bobot dari nilai huruf
                            $bobot = match ($nilai->nilai_huruf) {
                                'A' => 4.00,
                                'A-' => 3.75,
                                'AB' => 3.50,
                                'B+' => 3.25,
                                'B' => 3.00,
                                'BC' => 2.50,
                                'C' => 2.00,
                                'D' => 1.00,
                                'E' => 0.00,
                                default => 0.00,
                            };

                            $totalBobotKaliSks += $bobot * $sks;
                        }
                    @endphp

                    <!-- existing row -->
                @endforeach

                @php
                    $ips = $totalSks > 0 ? number_format($totalBobotKaliSks / $totalSks, 2) : '-';
                @endphp

                <!-- Tambahkan baris IPS -->
                <tr class="bg-gray-100 font-semibold">
                    <td></td>
                    <th class="px-6 py-3 text-center">IPS</th>
                    <td class="px-6 py-3 text-center"></td>
                    <td class="px-6 py-3 text-center"></td>
                    <td class="px-6 py-3 text-center">{{ $ips }}</td>
                    <td></td>
                </tr>

            </tbody>
        </table>
    </div>
</div>
@endsection