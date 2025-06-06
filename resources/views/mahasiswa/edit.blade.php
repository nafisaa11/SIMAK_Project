@extends('layouts.master')
@section('title')
    Edit Mahasiswa
@endsection

@section('content')
<div class="max-w-5xl mx-auto bg-white rounded-lg shadow-md p-8">
    <h2 class="text-center text-xl font-semibold mb-6 border-b pb-2">Edit Data Mahasiswa</h2>
    <form action="{{ route('mahasiswa.update', $mahasiswa->id_mahasiswa) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label for="nama" class="block mb-1 text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="nama" id="nama"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-yellow-400"
                    value="{{ $mahasiswa->user->name }}" readonly>
            </div>
            <div>
                <label for="nrp" class="block mb-1 text-sm font-medium text-gray-700">NRP</label>
                <input type="text" name="nrp" id="nrp"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-yellow-400"
                    value="{{ $mahasiswa->nrp }}" required>
            </div>
            <div>
                <label for="id_prodi" class="block mb-1 text-sm font-medium text-gray-700">Program Studi</label>
                <select name="id_prodi" id="id_prodi" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-yellow-400" required>
                    <option value="">-- Pilih Program Studi --</option>
                    @foreach($prodies as $prodi)
                        <option value="{{ $prodi->id_prodi }}" {{ $mahasiswa->id_prodi == $prodi->id_prodi ? 'selected' : '' }}>
                            {{ $prodi->jenjang }} {{ $prodi->nama_prodi }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="id_kelas" class="block mb-1 text-sm font-medium text-gray-700">Kelas</label>
                <select name="id_kelas" id="id_kelas"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-yellow-400"
                    required>
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelases as $kelas)
                        <option value="{{ $kelas->id_kelas }}" {{ $mahasiswa->id_kelas == $kelas->id_kelas ? 'selected' : '' }}>
                            {{ $kelas->kelas }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <h3 class="font-semibold text-gray-800 mb-4">Data Pribadi</h3>
        <div class="grid grid-cols-3 gap-6 mb-6">
            <div>
                <label for="jenis_kelamin" class="block mb-1 text-sm font-medium text-gray-700">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-yellow-400"
                    required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki" {{ $mahasiswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $mahasiswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div>
                <label for="agama" class="block mb-1 text-sm font-medium text-gray-700">Agama</label>
                <select name="agama" id="agama"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-yellow-400"
                    required>
                    <option value="">-- Pilih --</option>
                    @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                        <option value="{{ $agama }}" {{ $mahasiswa->agama == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-yellow-400 bg-gray-100"
                    value="{{ $mahasiswa->user->email }}" readonly>
            </div>
            <div>
                <label for="tempat_lahir" class="block mb-1 text-sm font-medium text-gray-700">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-yellow-400"
                    value="{{ $mahasiswa->tempat_lahir }}">
            </div>
            <div>
                <label for="tanggal_lahir" class="block mb-1 text-sm font-medium text-gray-700">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-yellow-400"
                    value="{{ $mahasiswa->tanggal_lahir }}">
            </div>
            <div>
                <label for="no_telp" class="block mb-1 text-sm font-medium text-gray-700">Nomer Telepon (Aktif)</label>
                <input type="tel" name="no_telp" id="no_telp"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-yellow-400"
                    value="{{ $mahasiswa->no_telp }}">
            </div>
        </div>

        <div class="flex justify-center gap-6 mt-8">
            <button type="button" onclick="window.history.back()"
                class="bg-gray-400 text-white font-semibold py-2 px-6 rounded shadow hover:bg-gray-500">
                Kembali
            </button>
            <button type="submit"
                class="bg-yellow-400 text-black font-semibold py-2 px-6 rounded shadow hover:bg-yellow-500">
                Simpan Perubahan
            </button>
        </div>
    </form>

    <script>
        document.getElementById('id_prodi').addEventListener('change', function () {
            const prodiId = this.value;
            const kelasSelect = document.getElementById('id_kelas');

            kelasSelect.innerHTML = '<option value="">Mencari kelas...</option>';

            fetch(`/get-kelas-by-prodi/${prodiId}`)
                .then(response => response.json())
                .then(data => {
                    let options = '<option value="">-- Pilih Kelas --</option>';
                    data.forEach(kelas => {
                        options += `<option value="${kelas.id_kelas}">${kelas.kelas}</option>`;
                    });
                    kelasSelect.innerHTML = options;
                })
                .catch(error => {
                    console.error('Error:', error);
                    kelasSelect.innerHTML = '<option value="">-- Pilih Prodi Terlebih Dahulu! --</option>';
                });
        });
    </script>
</div>
@endsection
