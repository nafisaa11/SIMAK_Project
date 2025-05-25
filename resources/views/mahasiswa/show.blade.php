@extends('layouts.master')

@section('title')
Detail Mahasiswa
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-br from-emerald-50 via-white to-teal-50 py-8">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Detail Mahasiswa</h1>
            <div class="w-24 h-1 bg-gradient-to-r from-emerald-500 to-teal-600 mx-auto rounded-full"></div>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header Card with Avatar -->
            <div class="bg-gradient-to-r from-emerald-600 to-teal-700 px-8 py-6">
                <div class="flex items-center space-x-6">
                    <!-- Avatar -->
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-lg">
                        <svg class="w-10 h-10 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <!-- Name and NRP -->
                    <div class="text-white">
                        <h2 class="text-2xl font-bold mb-1">{{ $mahasiswa->user->name }}</h2>
                        <p class="text-emerald-100 text-lg">NRP: {{ $mahasiswa->nrp }}</p>
                        <div class="mt-2 inline-block bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full">
                            <span class="text-sm font-medium">{{ $mahasiswa->kelas->prodi->jenjang }} {{ $mahasiswa->kelas->prodi->nama_prodi }} {{ $mahasiswa->kelas->kelas }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-8">
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Academic Information -->
                    <div class="space-y-6">
                        <h3 class="text-xl font-semibold text-gray-800 border-b-2 border-emerald-100 pb-2 mb-4">
                            Informasi Akademik
                        </h3>
                        
                        <!-- Program Studi -->
                        <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-lg hover:from-emerald-100 hover:to-teal-100 transition-all duration-200">
                            <div class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-600 font-medium">Program Studi</p>
                                <p class="text-gray-900 font-semibold">{{ $mahasiswa->prodi }}</p>
                            </div>
                        </div>

                        <!-- Kelas -->
                        <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-lg hover:from-emerald-100 hover:to-teal-100 transition-all duration-200">
                            <div class="w-10 h-10 bg-teal-500 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                    <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-600 font-medium">Kelas</p>
                                <p class="text-gray-900 font-semibold">{{ $mahasiswa->kelas->prodi->jenjang }} {{ $mahasiswa->kelas->prodi->nama_prodi }} {{ $mahasiswa->kelas->kelas }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <div class="space-y-6">
                        <h3 class="text-xl font-semibold text-gray-800 border-b-2 border-blue-100 pb-2 mb-4">
                            Informasi Personal
                        </h3>
                        
                        <!-- Gender -->
                        <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg hover:from-blue-100 hover:to-indigo-100 transition-all duration-200">
                            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zM8 6a2 2 0 114 0v1H8V6z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-600 font-medium">Jenis Kelamin</p>
                                <p class="text-gray-900 font-semibold">{{ $mahasiswa->jenis_kelamin }}</p>
                            </div>
                        </div>

                        <!-- Birth Information -->
                        <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg hover:from-blue-100 hover:to-indigo-100 transition-all duration-200">
                            <div class="w-10 h-10 bg-indigo-500 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-600 font-medium">Tempat, Tanggal Lahir</p>
                                <p class="text-gray-900 font-semibold">
                                    {{ $mahasiswa->tempat_lahir ?? '-' }},
                                    {{ $mahasiswa->tanggal_lahir ? \Carbon\Carbon::parse($mahasiswa->tanggal_lahir)->format('d M Y') : '-' }}
                                </p>
                            </div>
                        </div>

                        <!-- Religion -->
                        <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg hover:from-blue-100 hover:to-indigo-100 transition-all duration-200">
                            <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-600 font-medium">Agama</p>
                                <p class="text-gray-900 font-semibold">{{ $mahasiswa->agama ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Information Section -->
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-800 border-b-2 border-orange-100 pb-2 mb-6">
                        Informasi Kontak
                    </h3>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Email -->
                        <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-orange-50 to-red-50 rounded-lg hover:from-orange-100 hover:to-red-100 transition-all duration-200">
                            <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-600 font-medium">Email</p>
                                <p class="text-gray-900 font-semibold break-all">{{ $mahasiswa->user->email }}</p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-orange-50 to-red-50 rounded-lg hover:from-orange-100 hover:to-red-100 transition-all duration-200">
                            <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-600 font-medium">Nomor HP</p>
                                <p class="text-gray-900 font-semibold">{{ $mahasiswa->no_telp ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Section -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row gap-4 justify-between items-center">
                        <!-- Back Button -->
                        <a href="{{ route('mahasiswa.dashboard') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-gray-600 to-gray-700 text-white font-semibold rounded-lg shadow-md hover:from-gray-700 hover:to-gray-800 transform hover:scale-105 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                            </svg>
                            Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection