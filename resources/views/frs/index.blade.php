@extends('layouts.master')

@section('title', 'FRS')

@section('content')
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="flex justify-between items-start px-6 py-4 border-b border-gray-200 bg-gray-50">
            <div>
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

            @role('mahasiswa')
                <div>
                    <button onclick="toggleModal()" class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold py-2 px-4 rounded">
                        Tambah FRS
                    </button>
                </div>
            @endrole
        </div>

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
                            <td class="px-4 py-3">
                                @role('dosen')
                                    <form action="{{ route('frs.updatePersetujuan', $frs->id_frs) }}" method="POST"
                                        id="form-persetujuan-{{ $frs->id_frs }}">
                                        @csrf
                                        @method('PATCH')
                                        <select name="disetujui" onchange="this.form.submit()" 
                                            class="w-full px-3 py-2 text-sm border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors
                                            @if($frs->disetujui == 'Disetujui') 
                                                bg-green-50 border-green-300 text-green-800
                                            @elseif($frs->disetujui == 'Tidak Disetujui') 
                                                bg-red-50 border-red-300 text-red-800
                                            @else 
                                                bg-yellow-50 border-yellow-300 text-yellow-800
                                            @endif">
                                            <option value="Belum Disetujui" {{ $frs->disetujui == 'Belum Disetujui' ? 'selected' : '' }}>
                                                Belum Disetujui
                                            </option>
                                            <option value="Disetujui" {{ $frs->disetujui == 'Disetujui' ? 'selected' : '' }}>
                                                Disetujui
                                            </option>
                                            <option value="Tidak Disetujui" {{ $frs->disetujui == 'Tidak Disetujui' ? 'selected' : '' }}>
                                                Tidak Disetujui
                                            </option>
                                        </select>
                                    </form>
                                @else
                                    @if($frs->disetujui == 'Disetujui')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            Disetujui
                                        </span>
                                    @elseif($frs->disetujui == 'Tidak Disetujui')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                            Tidak Disetujui
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                            </svg>
                                            Belum Disetujui
                                        </span>
                                    @endif
                                @endrole
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="frsModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-6xl max-h-[90vh] overflow-hidden">
            <div class="flex justify-between items-center px-6 py-4 border-b bg-gray-100">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Pilih Jadwal Kuliah</h2>
                    <p class="text-sm text-gray-600">Pilih maksimal 10 mata kuliah</p>
                    <p class="text-sm text-blue-600">Terpilih: <span id="selectedCount">0</span>/10</p>
                </div>
                <button onclick="toggleModal()" class="text-gray-500 hover:text-red-500 text-2xl font-bold">&times;</button>
            </div>

            <div class="flex max-h-[calc(90vh-180px)]">
                <div class="w-2/3 overflow-y-auto px-4 py-4 border-r">
                    <h3 class="font-semibold mb-3">Daftar Jadwal Kuliah</h3>

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
                                    @foreach ($jadwalKuliahs as $jadwal)
                                        <tr class="hover:bg-gray-50" id="row-{{ $jadwal->id_jadwal_kuliah }}">
                                            <td class="p-3 text-center">
                                                <input type="checkbox" name="jadwal_kuliah[]"
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
                                                        'kelas' => $jadwal->kelas->prodi->kode_prodi . ' ' . $jadwal->kelas->kelas,
                                                    ]) }}">
                                            </td>
                                            <td class="p-3">{{ $jadwal->matkul->kode_matkul }}</td>
                                            <td class="p-3">
                                                {{ $jadwal->matkul->nama_matkul }}<br>
                                                {{ $jadwal->hari }} | {{ $jadwal->jam_awal }} - {{ $jadwal->jam_akhir }}
                                            </td>
                                            <td class="p-3">{{ $jadwal->dosen->user->name }}</td>
                                            <td class="p-3 text-center">{{ $jadwal->matkul->sks }}</td>
                                            <td class="p-3">{{ $jadwal->kelas->prodi->kode_prodi }}
                                                {{ $jadwal->kelas->kelas }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>

                <div class="w-1/3 overflow-y-auto px-4 py-4 bg-gray-50">
                    <h3 class="font-semibold mb-3">FRS Terpilih</h3>
                    <div id="selectedFRS" class="space-y-2">
                        <p class="text-gray-500 text-sm">Belum ada mata kuliah dipilih</p>
                    </div>

                    <div class="mt-4 p-3 bg-blue-100 rounded">
                        <p class="font-semibold">Total SKS: <span id="totalSKS">0</span></p>
                    </div>
                </div>
            </div>

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

    @if (session('success'))
        <div id="successAlert" class="alert-notification alert-success">
            <div class="alert-content">
                <div class="alert-icon">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="alert-text">
                    <h4 class="alert-title">Berhasil!</h4>
                    <p class="alert-message">{{ session('success') }}</p>
                </div>
                <button onclick="closeAlert('successAlert')" class="alert-close">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="alert-progress"></div>
        </div>
    @endif

    @if (session('error'))
        <div id="errorAlert" class="alert-notification alert-error">
            <div class="alert-content">
                <div class="alert-icon">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1zm0 8a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="alert-text">
                    <h4 class="alert-title">Terjadi Kesalahan!</h4>
                    <p class="alert-message">{{ session('error') }}</p>
                </div>
                <button onclick="closeAlert('errorAlert')" class="alert-close">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="alert-progress"></div>
        </div>
    @endif

    <style>
        .alert-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            max-width: 400px;
            z-index: 1000;
            border-radius: 0.75rem; /* Equivalent to rounded-lg */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transform: translateX(100%);
            opacity: 0;
            animation: slideInRight 0.5s ease-out forwards, fadeOut 0.3s ease-in 4.7s forwards;
            display: flex; /* Ensure flex for content layout */
            flex-direction: column; /* Stack content and progress bar */
        }

        .alert-success {
            background-color: #d1fae5; /* green-100 */
            border: 1px solid #34d399; /* green-400 */
            color: #065f46; /* green-800 */
        }

        .alert-error {
            background-color: #fee2e2; /* red-100 */
            border: 1px solid #f87171; /* red-400 */
            color: #991b1b; /* red-800 */
        }

        .alert-content {
            display: flex;
            align-items: center;
            padding: 1rem 1.25rem; /* px-5 py-4 */
            gap: 0.75rem; /* gap-3 */
        }

        .alert-icon {
            flex-shrink: 0;
            width: 1.75rem; /* w-7 */
            height: 1.75rem; /* h-7 */
            /* Using currentColor for icons to inherit text color */
        }

        .alert-text {
            flex: 1;
            min-width: 0;
        }

        .alert-title {
            font-weight: 600; /* font-semibold */
            font-size: 1rem; /* text-base */
            margin-bottom: 0.25rem; /* mb-1 */
        }

        .alert-message {
            font-size: 0.875rem; /* text-sm */
            line-height: 1.5;
        }

        .alert-close {
            flex-shrink: 0;
            background: none;
            border: none;
            color: inherit;
            cursor: pointer;
            padding: 0.25rem; /* p-1 */
            border-radius: 0.375rem; /* rounded-md */
            transition: background-color 0.2s ease, opacity 0.2s ease;
            opacity: 0.7;
        }

        .alert-close:hover {
            background-color: rgba(0, 0, 0, 0.05); /* Slightly darker on hover */
            opacity: 1;
        }
        
        .alert-success .alert-close:hover {
            background-color: rgba(6, 95, 70, 0.1); /* Specific for success */
        }

        .alert-error .alert-close:hover {
            background-color: rgba(153, 27, 27, 0.1); /* Specific for error */
        }


        .alert-progress {
            height: 0.25rem; /* h-1 */
            background-color: rgba(0, 0, 0, 0.1); /* Lighter background for progress bar */
            position: relative;
            overflow: hidden;
        }

        .alert-success .alert-progress::after {
            background-color: #065f46; /* Deeper green for success progress */
            animation: progressBar 5s linear forwards;
        }

        .alert-error .alert-progress::after {
            background-color: #991b1b; /* Deeper red for error progress */
            animation: progressBar 5s linear forwards;
        }

        .alert-progress::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            0% { opacity: 1; transform: translateX(0); }
            80% { opacity: 0; transform: translateX(100%); }
            100% { opacity: 0; display: none; } /* Ensure it disappears completely */
        }

        @keyframes progressBar {
            from { width: 100%; }
            to { width: 0%; }
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {
            .alert-notification {
                top: 10px;
                right: 10px;
                left: 10px;
                max-width: none;
            }
            
            .alert-content {
                padding: 1rem; /* p-4 */
            }
            
            .alert-title {
                font-size: 0.9375rem; /* slightly smaller */
            }
            
            .alert-message {
                font-size: 0.8125rem; /* slightly smaller */
            }
        }
    </style>

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

        // Function to close alert manually
        function closeAlert(alertId) {
            const alert = document.getElementById(alertId);
            if (alert) {
                alert.style.animation = 'fadeOut 0.3s ease-in forwards';
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 300);
            }
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
                        selectedJadwal = selectedJadwal.filter(jadwal => jadwal.id != jadwalData
                            .id);
                    }

                    updateUI();
                });
            });

            // Auto hide alerts after 5 seconds
            setTimeout(() => {
                const successAlert = document.getElementById('successAlert');
                const errorAlert = document.getElementById('errorAlert');
                if (successAlert) closeAlert('successAlert');
                if (errorAlert) closeAlert('errorAlert');
            }, 5000);
        });
    </script>
@endsection