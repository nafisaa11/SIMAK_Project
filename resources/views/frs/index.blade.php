@extends('layouts.master')

@section('title', 'FRS')

@section('content')
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <!-- Header Mahasiswa dan Tombol -->
    <div class="flex justify-between items-start px-6 py-4 border-b border-gray-200 bg-gray-50">
        <!-- Informasi Mahasiswa -->
        <div>
            <table class="text-sm">
                <tr>
                    <td class="font-semibold pr-2">Nama</td>
                    <td>: {{ $mahasiswa?->user?->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="font-semibold pr-2">NRP</td>
                    <td>: {{ $mahasiswa?->nrp ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="font-semibold pr-2">Kelas</td>
                    <td>: {{ $mahasiswa?->kelas?->prodi?->kode_prodi ?? '-' }} {{ $mahasiswa?->kelas?->kelas ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="font-semibold pr-2">Semester</td>
                    <td>: Bentar Dlu</td>
                </tr>
            </table>
        </div>

        @role('mahasiswa')
        <!-- Tombol Tambah FRS -->
        <div>
            <button onclick="toggleModal()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Tambah FRS
            </button>
        </div>
        @endrole
    </div>

    <!-- TABEL FRS -->
    <div class="overflow-x-auto p-4">
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead>
                <tr class="bg-blue-900 text-white">
                    @role('mahasiswa')
                        <th class="px-4 py-3 text-center">Tindakan</th>
                    @endrole
                    <th class="px-4 py-3 text-center">NO</th>
                    <th class="px-4 py-3">KODE MATA KULIAH</th>
                    <th class="px-4 py-3">MATA KULIAH - HARI - JAM</th>
                    <th class="px-4 py-3">DOSEN</th>
                    <th class="px-4 py-3 text-center">SKS</th>
                    <th class="px-4 py-3 text-center">KELAS</th>
                    <th class="px-4 py-3">PERSETUJUAN</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
                @foreach ($frses as $frs)
                    @php
                        $jadwal = $frs->nilai->jadwal ?? null;
                        $matakuliah = $frs->nilai->jadwal->matkul ?? null;
                        $dosen = $frs->nilai->jadwal->dosen->user ?? null;
                        $kelas = $frs->nilai->mahasiswa->kelas ?? null;
                    @endphp
                    <tr class="hover:bg-gray-100 transition-colors duration-200">
                        @role('mahasiswa')
                        <td class="px-4 py-3 text-center">
                            <form action="{{ route('frs.destroy', $frs->id_frs) }}" method="POST"
                                onsubmit="event.stopPropagation(); return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white p-2 rounded">
                                        <i class="ph ph-trash"></i>
                                    </button>
                            </form>
                        </td>
                        @endrole
                        <td class="px-4 py-3 text-center">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $matakuliah->kode_matkul ?? '-' }}</td>
                        <td class="px-4 py-3">
                            {{ $matakuliah->nama_matkul ?? '-' }}<br>
                            Hari: {{ $jadwal->hari ?? '-' }}<br>
                            Jam: {{ $jadwal->jam_awal ?? '-' }} - {{ $jadwal->jam_akhir ?? '-' }}
                        </td>
                        <td class="px-4 py-3">{{ $dosen->name ?? '-' }}</td>
                        <td class="px-4 py-3 text-center">{{ $matakuliah->sks ?? '-' }}</td>
                        <td class="px-4 py-3 text-center">{{ $kelas->kelas ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $frs->disetujui ?? 'Belum Disetujui' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL PILIH JADWAL KULIAH -->
<div id="frsModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-6xl max-h-[90vh] overflow-hidden">
        <!-- HEADER -->
        <div class="flex justify-between items-center px-6 py-4 border-b bg-gray-100">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Pilih Jadwal Kuliah</h2>
                <p class="text-sm text-gray-600">Pilih maksimal 10 mata kuliah</p>
                <p class="text-sm text-blue-600">Terpilih: <span id="selectedCount">0</span>/10</p>
            </div>
            <button onclick="toggleModal()" class="text-gray-500 hover:text-red-500 text-2xl font-bold">&times;</button>
        </div>

        <!-- ISI YANG SCROLLABLE -->
        <div class="flex max-h-[calc(90vh-180px)]">
            <!-- TABEL PILIHAN JADWAL -->
            <div class="w-2/3 overflow-y-auto px-4 py-4 border-r">
                <h3 class="font-semibold mb-3">Daftar Jadwal Kuliah</h3>
                
                <!-- FORM -->
                <form id="frsForm" action="{{ route('frs.store') }}" method="POST">
                    @csrf
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left text-gray-700">
                            <thead class="bg-gray-100 text-sm font-semibold uppercase sticky top-0">
                                <tr>
                                    <th class="p-3 text-center">Pilih</th>
                                    <th class="p-3">Kode MK</th>
                                    <th class="p-3">Mata Kuliah - Hari - Jam</th>
                                    <th class="p-3">Dosen</th>
                                    <th class="p-3 text-center">SKS</th>
                                    <th class="p-3">Kelas</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($jadwalKuliahs as $jadwal)
                                    <tr class="hover:bg-gray-50" id="row-{{ $jadwal->id_jadwal_kuliah }}">
                                        <td class="p-3 text-center">
                                            <input type="checkbox" 
                                                   name="jadwal_kuliah[]" 
                                                   value="{{ $jadwal->id_jadwal_kuliah }}" 
                                                   class="jadwal-checkbox accent-blue-600"
                                                   data-jadwal="{{ json_encode([
                                                       'id' => $jadwal->id_jadwal_kuliah,
                                                       'kode' => $jadwal->matkul->kode_matkul,
                                                       'nama' => $jadwal->matkul->nama_matkul,
                                                       'hari' => $jadwal->hari,
                                                       'jam_awal' => $jadwal->jam_awal,
                                                       'jam_akhir' => $jadwal->jam_akhir,
                                                       'dosen' => $jadwal->dosen->user->name,
                                                       'sks' => $jadwal->matkul->sks,
                                                       'kelas' => $jadwal->kelas->prodi->kode_prodi . ' ' . $jadwal->kelas->kelas
                                                   ]) }}">
                                        </td>
                                        <td class="p-3">{{ $jadwal->matkul->kode_matkul }}</td>
                                        <td class="p-3">
                                            {{ $jadwal->matkul->nama_matkul }}<br>
                                            {{ $jadwal->hari }} | {{ $jadwal->jam_awal }} - {{ $jadwal->jam_akhir }}
                                        </td>
                                        <td class="p-3">{{ $jadwal->dosen->user->name }}</td>
                                        <td class="p-3 text-center">{{ $jadwal->matkul->sks }}</td>
                                        <td class="p-3">{{ $jadwal->kelas->prodi->kode_prodi }} {{ $jadwal->kelas->kelas }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>

            <!-- PREVIEW FRS TERPILIH -->
            <div class="w-1/3 overflow-y-auto px-4 py-4 bg-gray-50">
                <h3 class="font-semibold mb-3">FRS Terpilih</h3>
                <div id="selectedFRS" class="space-y-2">
                    <p class="text-gray-500 text-sm">Belum ada mata kuliah dipilih</p>
                </div>
                
                <!-- Total SKS -->
                <div class="mt-4 p-3 bg-blue-100 rounded">
                    <p class="font-semibold">Total SKS: <span id="totalSKS">0</span></p>
                </div>
            </div>
        </div>

        <!-- FOOTER -->
        <div class="flex justify-between items-center px-6 py-4 border-t bg-gray-50">
            <div class="text-sm text-gray-600">
                <span id="warningText" class="text-red-600 hidden">Maksimal 10 mata kuliah!</span>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="toggleModal()" class="text-gray-600 hover:text-red-500 px-4 py-2">
                    Batal
                </button>

                <button type="button" onclick="submitFRS()" 
                        class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 disabled:bg-gray-400"
                        id="submitBtn" disabled>
                    Tambah FRS
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ALERT MESSAGES -->
@if(session('success'))
    <div class="fixed top-4 right-4 bg-green-100 text-green-800 p-4 rounded shadow-lg z-50" id="successAlert">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="fixed top-4 right-4 bg-red-100 text-red-800 p-4 rounded shadow-lg z-50" id="errorAlert">
        {{ session('error') }}
    </div>
@endif

<!-- SCRIPT MODAL DAN CHECKBOX -->
<script>
let selectedJadwal = [];
const maxSelection = 10;

function toggleModal() {
    const modal = document.getElementById('frsModal');
    modal.classList.toggle('hidden');
    
    // Reset selections when opening modal
    if (!modal.classList.contains('hidden')) {
        resetSelections();
    }
}

function resetSelections() {
    selectedJadwal = [];
    document.querySelectorAll('.jadwal-checkbox').forEach(checkbox => {
        checkbox.checked = false;
    });
    updateUI();
}

function updateUI() {
    // Update counter
    document.getElementById('selectedCount').textContent = selectedJadwal.length;
    
    // Update submit button
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = selectedJadwal.length === 0;
    
    // Update warning text
    const warningText = document.getElementById('warningText');
    if (selectedJadwal.length >= maxSelection) {
        warningText.classList.remove('hidden');
    } else {
        warningText.classList.add('hidden');
    }
    
    // Disable unchecked checkboxes if max reached
    document.querySelectorAll('.jadwal-checkbox').forEach(checkbox => {
        if (!checkbox.checked && selectedJadwal.length >= maxSelection) {
            checkbox.disabled = true;
        } else {
            checkbox.disabled = false;
        }
    });
    
    // Update preview
    updatePreview();
}

function updatePreview() {
    const previewContainer = document.getElementById('selectedFRS');
    const totalSKSElement = document.getElementById('totalSKS');
    
    if (selectedJadwal.length === 0) {
        previewContainer.innerHTML = '<p class="text-gray-500 text-sm">Belum ada mata kuliah dipilih</p>';
        totalSKSElement.textContent = '0';
        return;
    }
    
    let totalSKS = 0;
    let previewHTML = '';
    
    selectedJadwal.forEach((jadwal, index) => {
        totalSKS += parseInt(jadwal.sks);
        previewHTML += `
            <div class="bg-white p-3 rounded border text-xs">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <p class="font-semibold">${jadwal.kode}</p>
                        <p class="text-gray-600">${jadwal.nama}</p>
                        <p class="text-gray-500">${jadwal.hari} | ${jadwal.jam_awal}-${jadwal.jam_akhir}</p>
                        <p class="text-gray-500">Dosen: ${jadwal.dosen}</p>
                        <p class="text-gray-500">SKS: ${jadwal.sks} | Kelas: ${jadwal.kelas}</p>
                    </div>
                    <button type="button" onclick="removeSelection('${jadwal.id}')" 
                            class="text-red-500 hover:text-red-700 ml-2">
                        ×
                    </button>
                </div>
            </div>
        `;
    });
    
    previewContainer.innerHTML = previewHTML;
    totalSKSElement.textContent = totalSKS;
}

function removeSelection(jadwalId) {
    // Uncheck the checkbox
    const checkbox = document.querySelector(`input[value="${jadwalId}"]`);
    if (checkbox) {
        checkbox.checked = false;
    }
    
    // Remove from selected array
    selectedJadwal = selectedJadwal.filter(jadwal => jadwal.id != jadwalId);
    
    updateUI();
}

function submitFRS() {
    if (selectedJadwal.length === 0) {
        alert('Pilih minimal 1 mata kuliah!');
        return;
    }
    
    // Submit the form
    document.getElementById('frsForm').submit();
}

// Event listener untuk checkbox
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.jadwal-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const jadwalData = JSON.parse(this.dataset.jadwal);
            
            if (this.checked) {
                if (selectedJadwal.length < maxSelection) {
                    selectedJadwal.push(jadwalData);
                } else {
                    this.checked = false;
                    alert('Maksimal hanya dapat memilih 10 mata kuliah!');
                    return;
                }
            } else {
                selectedJadwal = selectedJadwal.filter(jadwal => jadwal.id != jadwalData.id);
            }
            
            updateUI();
        });
    });
    
    // Auto hide alerts after 5 seconds
    setTimeout(() => {
        const successAlert = document.getElementById('successAlert');
        const errorAlert = document.getElementById('errorAlert');
        if (successAlert) successAlert.style.display = 'none';
        if (errorAlert) errorAlert.style.display = 'none';
    }, 5000);
});
</script>
@endsection