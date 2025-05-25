@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="content-wrapper bg-gray-5">
        <!-- Welcome Header Section -->
        <section class="relative overflow-hidden bg-gradient-to-r text-white">
            <div class="container mx-auto px-6 py-6">
            </div>
        </section>

        <!-- Stats Section -->
        <section class="container mx-auto px-1 -mt-10 mb-8 relative z-10">
            <div class="flex flex-wrap gap-6">
                <!-- Stat Card 1 -->
                <div class="bg-white rounded-xl shadow-md p-6 border-l-5 border-blue-500 w-full md:w-1/2 lg:w-1/4">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500 uppercase tracking-wider">Total Mahasiswa</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ number_format($totalMahasiswa) }}</h3>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Stat Card 2 -->
                <div class="bg-white rounded-xl shadow-md p-6 border-l-5 border-green-500 w-full md:w-1/2 lg:w-1/4"">
                    <div class=" flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500 uppercase tracking-wider">Total Dosen</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ number_format($totalDosen) }}</h3>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Stat Card 3 -->
                <div class="bg-white rounded-xl shadow-md p-6 border-l-5 border-purple-500 w-full md:w-1/2 lg:w-1/4"">
                    <div class=" flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500 uppercase tracking-wider">Total Mata Kuliah</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ number_format($totalMatkul) }}</h3>
                        </div>
                        <div class="bg-purple-100 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Main Menu Section -->
                <section class="container mx-auto px-1 py-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Menu Utama</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 flex-wrap gap-6">
                        <!-- Menu Card 1 - Mahasiswa -->

                        <div
                            class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <div class="h-2 bg-blue-500"></div>
                            <div class="p-6">
                                <div class="flex items-center mb-4">
                                    <div class="bg-blue-100 p-3 rounded-full mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-semibold text-gray-800">
                                        @if (Auth::user()->hasRole('admin'))
                                            Manajemen Mahasiswa
                                        @elseif(Auth::user()->hasRole('dosen'))
                                            Data Mahasiswa
                                        @elseif(Auth::user()->hasRole('mahasiswa'))
                                            Daftar Mahasiswa
                                        @else
                                            Akses Tidak Diketahui
                                        @endif
                                    </h3>



                                </div>
                                <p class="text-gray-600 mb-6">
                                    @if (Auth::user()->hasRole('admin'))
                                        Kelola, update, dan perbarui data mahasiswa yang terdaftar
                                        di
                                        sistem. Termasuk informasi pribadi dan akademik.
                                    @elseif(Auth::user()->hasRole('dosen'))
                                        Melihat daftar data mahasiswa
                                    @elseif(Auth::user()->hasRole('mahasiswa'))
                                        Melihat daftar mahasiswa
                                    @else
                                        Akses Tidak Diketahui
                                    @endif
                                </p>
                                <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                    <span class="text-sm text-gray-500">
                                        <!-- Terakhir diupdate: {{ date('d M Y') }} -->
                                    </span>
                                    <a href="{{ route('mahasiswa.dashboard') }}"
                                        class="flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                        Lihat Data
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>


                        <!-- Menu Card 2 - Dosen -->
                        <div
                            class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <div class="h-2 bg-green-500"></div>
                            <div class="p-6">
                                <div class="flex items-center mb-4">
                                    <div class="bg-green-100 p-3 rounded-full mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-semibold text-gray-800">
                                        {{ Auth::user()->hasRole('admin') ? 'Manajemen Dosen' : 'Daftar Dosen' }}
                                    </h3>
                                </div>
                                <p class="text-gray-600 mb-6">
                                    {{ Auth::user()->hasRole('admin')
                                        ? 'Kelola data dosen aktif, termasuk informasi kontak, jadwal
                                                                        mengajar, dan riwayat akademik lengkap.'
                                        : 'Daftar Dosen' }}
                                </p>
                                <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                    <span class="text-sm text-gray-500">
                                        <!-- Terakhir diupdate: {{ date('d M Y') }} -->
                                    </span>
                                    <a href="{{ route('dosen.dashboard') }}"
                                        class="flex items-center text-green-600 hover:text-green-800 font-medium">
                                        Lihat Data
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Menu Card 3 - Nilai -->
                        @if (Auth::user()->hasAnyRole(['mahasiswa', 'dosen']))
                            <div
                                class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                <div class="h-2 bg-yellow-500"></div>
                                <div class="p-6">
                                    <div class="flex items-center mb-4">
                                        <div class="bg-yellow-100 p-3 rounded-full mr-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-xl font-semibold text-gray-800">
                                            {{ Auth::user()->hasRole('dosen') ? 'Manajemen nilai' : 'Nilai' }}
                                        </h3>
                                    </div>
                                    <p class="text-gray-600 mb-6"></p>
                                    <p class="text-gray-600 mb-6">
                                        {{ Auth::user()->hasRole('dosen')
                                            ? 'Input, kelola, dan review data nilai mahasiswa untuk
                                                                                evaluasi
                                                                                akademik. Termasuk analisis performa semester.'
                                            : 'Nilai' }}
                                    </p>
                                    <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                        <span class="text-sm text-gray-500">
                                            <!-- Terakhir diupdate: {{ date('d M Y') }} -->
                                        </span>
                                        <a href="{{ Auth::user()->hasRole('dosen')
                                            ? route('kelas.index')
                                            : route('nilai.index.byMahasiswa', Auth::user()->mahasiswa->id_mahasiswa) }}"
                                            class="flex items-center text-yellow-600 hover:text-yellow-800 font-medium">
                                            Lihat Data
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Menu Card 4 - Mata Kuliah -->
                        @hasanyrole('dosen|admin')
                        <div
                            class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <div class="h-2 bg-purple-500"></div>
                            <div class="p-6">
                                <div class="flex items-center mb-4">
                                    <div class="bg-purple-100 p-3 rounded-full mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-semibold text-gray-800">
                                        {{ Auth::user()->hasRole('admin') ? 'Manajemen Mata Kuliah' : 'Mata Kuliah' }}
                                    </h3>
                                </div>
                                    <p class="text-gray-600 mb-6">
                                        {{ Auth::user()->hasRole('admin') ? 'Kelola daftar mata kuliah, jadwal, ruangan, dan informasi
                                    pengajar untuk semester ini.' : 'Melihat daftar mata kuliah' }}
                                    </p>
                                <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                    <span class="text-sm text-gray-500">
                                        <!-- Terakhir diupdate: {{ date('d M Y') }} -->
                                    </span>
                                    <a href="{{ route('mataKuliah.index') }}"
                                        class="flex items-center text-purple-600 hover:text-purple-800 font-medium">
                                        Lihat Data
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endhasanyrole

                        <!-- Menu Card 5 - Jadwal -->
                        <div
                            class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <div class="h-2 bg-red-500"></div>
                            <div class="p-6">
                                <div class="flex items-center mb-4">
                                    <div class="bg-red-100 p-3 rounded-full mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-semibold text-gray-800">
                                        {{ Auth::user()->hasRole('admin') ? 'Manajemen Jadwal Kuliah' : 'Jadwal Kuliah' }}
                                    </h3>
                                </div>
                                    <p class="text-gray-600 mb-6">
                                        {{ Auth::user()->hasRole('admin') ? 'Atur dan kelola jadwal kuliah, termasuk pengaturan ruangan,
                                    waktu dan manajemen konflik jadwal.' : 'Melihat daftar jadwal' }}
                                    </p>
                                <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                    <span class="text-sm text-gray-500">
                                        <!-- Terakhir diupdate: {{ date('d M Y') }} -->
                                    </span>
                                    <a href="#"
                                        class="flex items-center text-red-600 hover:text-red-800 font-medium">
                                        Lihat Data
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Menu Card 6 - FRS -->
                        @hasanyrole('dosen|mahasiswa')
                        <div
                            class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <div class="h-2 bg-indigo-500"></div>
                            <div class="p-6">
                                <div class="flex items-center mb-4">
                                    <div class="bg-indigo-100 p-3 rounded-full mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-semibold text-gray-800">
                                        @if (Auth::user()->hasRole('dosen'))
                                            Persetujuan FRS
                                        @elseif(Auth::user()->hasRole('mahasiswa'))
                                            FRS
                                        @else
                                            Akses Tidak Diketahui
                                        @endif
                                    </h3>
                                </div>
                                    <p class="text-gray-600 mb-6">
                                        @if (Auth::user()->hasRole('dosen'))
                                            Memberikan Persetujuan FRS
                                        @elseif(Auth::user()->hasRole('mahasiswa'))
                                            Melakukan FRS
                                        @else
                                            Akses Tidak Diketahui
                                        @endif
                                    </p>
                                <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                    <span class="text-sm text-gray-500">
                                        <!-- Terakhir diupdate: {{ date('d M Y') }} -->
                                    </span>
                                    <a href="{{ route('frs.index') }}"
                                        class="flex items-center text-red-600 hover:text-red-800 font-medium">
                                        Lihat Data
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endhasanyrole
                    </div>
                </section>
            </div>
        @endsection

        @section('username')
            YAN-MIS
        @endsection
