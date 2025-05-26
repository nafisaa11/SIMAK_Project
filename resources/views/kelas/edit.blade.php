@extends('layouts.master')

@section('title')
Edit Kelas
@endsection

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Edit Kelas</h2>
    <form action="{{ route('kelas.update', $kelas->id_kelas) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="id_prodi" class="block text-gray-700 text-sm font-bold mb-2">Program Studi</label>
            <select name="id_prodi" id="id_prodi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">Pilih Program Studi</option>
                @foreach($prodies as $pd)
                <option value="{{ $pd->id_prodi }}" {{ $kelas->id_prodi == $pd->id_prodi ? 'selected' : '' }}>
                    {{ $pd->jenjang }} {{ $pd->nama_prodi }} ({{ $pd->kode_prodi }})
                </option>
                @endforeach
            </select>
            @error('id_prodi')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="kelas" class="block text-gray-700 text-sm font-bold mb-2">Kelas</label>
            <select name="kelas" id="kelas" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                @foreach(['A', 'B', 'C', 'D'] as $optKelas)
                    <option value="{{ $optKelas }}" {{ $kelas->kelas == $optKelas ? 'selected' : '' }}>
                        {{ $optKelas }}
                    </option>
                @endforeach
            </select>
            @error('kelas')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>


        <div>
            <label for="id_dosen" class="block text-gray-700 text-sm font-bold mb-2">Dosen</label>
            <select name="id_dosen" id="id_dosen" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">Pilih Dosen</option>
                @foreach($dosens as $ds)
                <option value="{{ $ds->id_dosen }}" {{ $kelas->id_dosen == $ds->id_dosen ? 'selected' : '' }}>
                    {{ $ds->user->name }}
                </option>
                @endforeach
            </select>
            @error('id_dosen')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="angkatan" class="block text-gray-700 text-sm font-bold mb-2">Angkatan</label>
            <select name="angkatan" id="angkatan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">Pilih Tahun Angkatan</option>
                @for ($year = date('Y'); $year >= 2023; $year--)
                    <option value="{{ $year }}" {{ (old('angkatan', $kelas->angkatan) == $year) ? 'selected' : '' }}>
                        {{ $year }}
                    </option>
                @endfor
            </select>
            @error('angkatan')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>


        <div class="flex items-center justify-between pt-4">
            <a href="{{ route('kelas.index') }}" class="bg-gray-400 text-white font-semibold py-2 px-6 rounded shadow hover:bg-gray-500">Kembali</a>
            <button type="submit" class="bg-yellow-400 hover:bg-yellow-600 text-black font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

@if(session('error'))
<div class="mt-4 max-w-md mx-auto bg-red-100 text-red-800 p-3 rounded">{{ session('error') }}</div>
@endif

@if($errors->any())
<div class="mt-4 max-w-md mx-auto bg-red-100 text-red-800 p-3 rounded">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@endsection