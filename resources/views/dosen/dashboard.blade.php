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
                    <th class="px-4 py-3">NO</th>
                    <th class="px-4 py-3">NIP</th>
                    <th class="px-4 py-3">NAMA</th>
                    <th class="px-4 py-3">ALAMAT</th>
                    <th class="px-4 py-3">STATUS</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
                @foreach ($dosen as $item)
                <tr onclick="window.location='{{ route('dosen.show', $item->id_dosen) }}';"
                class="hover:bg-gray-100 transition-colors duration-200">
                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3">{{ $item->nip }}</td>
                    <td class="px-4 py-3">{{ $item->user->name }}</td>
                    <td class="px-4 py-3">{{ $item->alamat }}</td>
                    <td class="px-4 py-3">{{ $item->status }}</td>

                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
