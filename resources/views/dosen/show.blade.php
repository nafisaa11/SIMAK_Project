@extends('layouts.master')

@section(section: 'title')
Detail Dosen
@endsection

@section('content')
<div class="max-w-xl mx-auto bg-white rounded-lg shadow-md p-6 mt-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Detail Dosen</h2>

    <div class="space-y-4">
        <div>
            <span class="font-semibold text-gray-700">NIP:</span>
            <span class="text-gray-900">{{ $dosen->nip }}</span>
        </div>
        <div>
            <span class="font-semibold text-gray-700">Nama:</span>
            <span class="text-gray-900">{{ $dosen->user->name }}</span>
        </div>
        <div>
            <span class="font-semibold text-gray-700">Jenis Kelamin:</span>
            <span class="text-gray-900">{{ $dosen->jenis_kelamin }}</span>
        </div>
        <div>
            <span class="font-semibold text-gray-700">Email:</span>
            <span class="text-gray-900">{{ $dosen->user->email }}</span>
        </div>
        <div>
            <span class="font-semibold text-gray-700">Nomor HP:</span>
            <span class="text-gray-900">{{ $dosen->no_telp ?? '-' }}</span>
        </div>
        <div>
            <span class="font-semibold text-gray-700">Agama:</span>
            <span class="text-gray-900">{{ $dosen->agama ?? '-' }}</span>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('dosen.dashboard') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">← Kembali ke Daftar</a>
    </div>
</div>
@endsection
