<!-- resources/views/frs/dosen/index.blade.php -->
@extends('layouts.app')

@section('title', 'FRS - Dosen Wali')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Daftar Mahasiswa Bimbingan</h1>
        
        <!-- Info Kelas yang Diwali -->
        @if($kelasWali->count() > 0)
            <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                <h3 class="font-semibold text-blue-800 mb-2">Kelas yang Anda Wali:</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                    @foreach($kelasWali as $kelas)
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                            {{ $kelas->nama_kelas }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif
        
        <!-- Tabel Daftar Mahasiswa -->
        @if($mahasiswaList->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Mahasiswa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semester</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($mahasiswaList as $index => $mahasiswa)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $mahasiswa->nim }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $mahasiswa->user->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">
                                        {{ $mahasiswa->kelas->nama_kelas }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    Semester {{ $mahasiswa->semester }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('frs.index.byMahasiswa', $mahasiswa->id) }}" 
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm transition duration-200">
                                        Lihat FRS
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-8">
                <div class="text-gray-500">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M34 40h10v-4a6 6 0 00-10.712-3.714M34 40H14m20 0v-4a9.971 9.971 0 00-.712-3.714M14 40H4v-4a6 6 0 0110.713-3.714M14 40v-4c0-1.313.253-2.566.713-3.714m0 0A9.971 9.971 0 0124 24c4.21 0 7.813 2.602 9.288 6.286" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <p class="mt-4 text-lg">Tidak ada mahasiswa dalam bimbingan Anda</p>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

<!-- resources/views/frs/dosen/not-wali.blade.php -->
@extends('layouts.app')

@section('title', 'FRS - Akses Ditolak')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-8 text-center">
        <div class="mb-6">
            <svg class="mx-auto h-16 w-16 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z">
                </path>
            </svg>
        </div>
        
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Akses Terbatas</h1>
        
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 max-w-md mx-auto">
            <p class="text-yellow-800 text-lg font-medium">
                Anda bukan dosen wali
            </p>
            <p class="text-yellow-700 text-sm mt-2">
                Halaman FRS hanya dapat diakses oleh dosen yang menjadi dosen wali kelas.
            </p>
        </div>
        
        <div class="mt-6">
            <a href="{{ route('dashboard') }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-md transition duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection

<!-- resources/views/frs/dosen/frs-mahasiswa.blade.php -->
@extends('layouts.app')

@section('title', 'FRS Mahasiswa - ' . $mahasiswa->user->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">FRS Mahasiswa</h1>
                <div class="mt-2 text-sm text-gray-600">
                    <p><span class="font-semibold">Nama:</span> {{ $mahasiswa->user->name }}</p>
                    <p><span class="font-semibold">NIM:</span> {{ $mahasiswa->nim }}</p>
                    <p><span class="font-semibold">Kelas:</span> {{ $mahasiswa->kelas->nama_kelas }}</p>
                    <p><span class="font-semibold">Semester:</span> {{ $mahasiswa->semester }}</p>
                </div>
            </div>
            <a href="{{ route('frs.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition duration-200">
                Kembali
            </a>
        </div>
    </div>
    
    <!-- Tabel FRS -->
    <div class="bg-white rounded-lg shadow-md p-6">
        @if($frsList->count() > 0)
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Daftar Mata Kuliah yang Diambil</h2>
            
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode MK</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKS</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($frsList as $index => $frs)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $frs->mataKuliah->kode_mk }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $frs->mataKuliah->nama_mk }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $frs->mataKuliah->sks }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $frs->kelas->nama_kelas }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($frs->status_persetujuan == 'pending')
                                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">Menunggu</span>
                                    @elseif($frs->status_persetujuan == 'approved')
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Disetujui</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">Ditolak</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    @if($frs->status_persetujuan == 'pending')
                                        <div class="flex space-x-2">
                                            <form action="{{ route('frs.updatePersetujuan', $frs->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status_persetujuan" value="approved">
                                                <button type="submit" 
                                                        class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs transition duration-200">
                                                    Setujui
                                                </button>
                                            </form>
                                            <button onclick="openRejectModal({{ $frs->id }})" 
                                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs transition duration-200">
                                                Tolak
                                            </button>
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-xs">{{ ucfirst($frs->status_persetujuan) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Summary -->
            <div class="mt-6 bg-gray-50 p-4 rounded-lg">
                <h3 class="font-semibold text-gray-800 mb-2">Ringkasan FRS</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600">Total SKS:</span>
                        <span class="font-semibold ml-2">{{ $frsList->sum('mataKuliah.sks') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Disetujui:</span>
                        <span class="font-semibold ml-2 text-green-600">{{ $frsList->where('status_persetujuan', 'approved')->count() }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Menunggu:</span>
                        <span class="font-semibold ml-2 text-yellow-600">{{ $frsList->where('status_persetujuan', 'pending')->count() }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Ditolak:</span>
                        <span class="font-semibold ml-2 text-red-600">{{ $frsList->where('status_persetujuan', 'rejected')->count() }}</span>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-8">
                <div class="text-gray-500">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M9 12h6m6 0h6m-6 6v6m6-9v9a3 3 0 01-3 3H9a3 3 0 01-3-3V9a3 3 0 013-3h9.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293H27a3 3 0 013 3v1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <p class="mt-4 text-lg">Mahasiswa belum mengisi FRS</p>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Modal untuk menolak FRS -->
<div id="rejectModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Tolak FRS</h3>
            <form id="rejectForm" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status_persetujuan" value="rejected">
                <div class="mb-4">
                    <label for="catatan" class="block text-sm font-medium text-gray-700 mb-2">
                        Catatan (Opsional)
                    </label>
                    <textarea name="catatan" id="catatan" rows="3" 
                              class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Berikan alasan penolakan..."></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeRejectModal()" 
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition duration-200">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-200">
                        Tolak FRS
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openRejectModal(frsId) {
    document.getElementById('rejectForm').action = `/frs/${frsId}/persetujuan`;
    document.getElementById('rejectModal').classList.remove('hidden');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
    document.getElementById('catatan').value = '';
}

// Close modal when clicking outside
document.getElementById('rejectModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeRejectModal();
    }
});
</script>
@endsection