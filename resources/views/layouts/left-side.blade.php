<aside class="w-64 bg-[#0A1931] text-white flex-shrink-0 fixed top-0 left-0 h-full">
    <!-- Logo -->
    <div class="flex flex-row items-center px-6 py-5 border-b border-gray-700">
        <img src="/build/assets/logo.svg" alt="Logo" style="width: 40px; height: auto; object-fit: contain;">
        <h1 class="text-3xl font-bold ml-2">
            <span class="text-white">SIM</span><span style="color: #FCC823">AK</span>
        </h1>
    </div>

    <!-- Menu -->
    <nav class="px-4 py-6 space-y-6">
        <ul class="space-y-2">

            <li>
                <a href="{{ route('home') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded transition duration-200
          {{ Request::is('home') ? 'bg-white text-gray-900 font-semibold' : 'hover:bg-gray-800' }}">
                    <svg class="w-5 h-5 {{ Request::is('home') ? 'text-gray-900' : 'text-white' }}"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 3h8v8H3V3zm0 10h8v8H3v-8zm10-10h8v8h-8V3zm0 10h8v8h-8v-8z" />
                    </svg>
                    Dashboard
                </a>
            </li>


            <li>
                <a href="{{ route('mahasiswa.dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded transition duration-200
                        {{ Request::is('mahasiswa*') ? 'bg-white text-gray-900 font-semibold' : 'hover:bg-gray-800' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="32" fill="currentColor"
                        viewBox="0 0 256 256">
                        <path d="M226.53,56.41l-96-32a8,8,0,0,0-5.06,0l-96,32A8,8,0,0,0,24,64v80a8,8,0,0,0,16,0V75.1L73.59,86.29a64,64,0,0,0,20.65,88.05c-18,7.06-33.56,19.83-44.94,37.29a8,8,0,1,0,13.4,8.74C77.77,197.25,101.57,184,128,184s50.23,13.25,65.3,36.37a8,8,0,0,0,13.4-8.74c-11.38-17.46-27-30.23-44.94-37.29a64,64,0,0,0,20.65-88l44.12-14.7a8,8,0,0,0,0-15.18ZM176,120A48,48,0,1,1,89.35,91.55l36.12,12a8,8,0,0,0,5.06,0l36.12-12A47.89,47.89,0,0,1,176,120ZM128,87.57,57.3,64,128,40.43,198.7,64Z"></path>
                    </svg>
                    Mahasiswa
                </a>
            </li>

            <li>
                <a href="{{ route('dosen.dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded transition duration-200
                        {{ Request::is('dosen*') ? 'bg-white text-gray-900 font-semibold' : 'hover:bg-gray-800' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="32" fill="currentcolor" viewBox="0 0 256 256">
                        <path d="M216,40H40A16,16,0,0,0,24,56V200a16,16,0,0,0,16,16H53.39a8,8,0,0,0,7.23-4.57,48,48,0,0,1,86.76,0,8,8,0,0,0,7.23,4.57H216a16,16,0,0,0,16-16V56A16,16,0,0,0,216,40ZM80,144a24,24,0,1,1,24,24A24,24,0,0,1,80,144Zm136,56H159.43a64.39,64.39,0,0,0-28.83-26.16,40,40,0,1,0-53.2,0A64.39,64.39,0,0,0,48.57,200H40V56H216ZM56,96V80a8,8,0,0,1,8-8H192a8,8,0,0,1,8,8v96a8,8,0,0,1-8,8H176a8,8,0,0,1,0-16h8V88H72v8a8,8,0,0,1-16,0Z"></path>
                    </svg>
                    Dosen
                </a>
            </li>

            @hasanyrole('admin')
            <li>
                <a href="{{ route('prodi.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded transition duration-200
                        {{ Request::is('prodi*') ? 'bg-white text-gray-900 font-semibold' : 'hover:bg-gray-800' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="32" fill="currentcolor" viewBox="0 0 256 256">
                        <path d="M240,208H224V96a16,16,0,0,0-16-16H144V32a16,16,0,0,0-24.88-13.32L39.12,72A16,16,0,0,0,32,85.34V208H16a8,8,0,0,0,0,16H240a8,8,0,0,0,0-16ZM208,96V208H144V96ZM48,85.34,128,32V208H48ZM112,112v16a8,8,0,0,1-16,0V112a8,8,0,1,1,16,0Zm-32,0v16a8,8,0,0,1-16,0V112a8,8,0,1,1,16,0Zm0,56v16a8,8,0,0,1-16,0V168a8,8,0,0,1,16,0Zm32,0v16a8,8,0,0,1-16,0V168a8,8,0,0,1,16,0Z"></path>
                    </svg>
                    Program Studi
                </a>
            </li>
            @endhasanyrole

            @hasanyrole('admin')
            <li>
                <a href="{{ route('mataKuliah.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded transition duration-200
                        {{ Request::is('mataKuliah*') ? 'bg-white text-gray-900 font-semibold' : 'hover:bg-gray-800' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="32" fill="currentcolor" viewBox="0 0 256 256">
                        <path d="M232,48H160a40,40,0,0,0-32,16A40,40,0,0,0,96,48H24a8,8,0,0,0-8,8V200a8,8,0,0,0,8,8H96a24,24,0,0,1,24,24,8,8,0,0,0,16,0,24,24,0,0,1,24-24h72a8,8,0,0,0,8-8V56A8,8,0,0,0,232,48ZM96,192H32V64H96a24,24,0,0,1,24,24V200A39.81,39.81,0,0,0,96,192Zm128,0H160a39.81,39.81,0,0,0-24,8V88a24,24,0,0,1,24-24h64ZM160,88h40a8,8,0,0,1,0,16H160a8,8,0,0,1,0-16Zm48,40a8,8,0,0,1-8,8H160a8,8,0,0,1,0-16h40A8,8,0,0,1,208,128Zm0,32a8,8,0,0,1-8,8H160a8,8,0,0,1,0-16h40A8,8,0,0,1,208,160Z"></path>
                    </svg>
                    Mata Kuliah
                </a>
            </li>
            @endhasanyrole

            <li>
                <a href="{{ route('jadwal.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded transition duration-200
                        {{ Request::is('jadwal*') ? 'bg-white text-gray-900 font-semibold' : 'hover:bg-gray-800' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="32" fill="currentcolor" viewBox="0 0 256 256">
                        <path d="M208,32H184V24a8,8,0,0,0-16,0v8H88V24a8,8,0,0,0-16,0v8H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32ZM72,48v8a8,8,0,0,0,16,0V48h80v8a8,8,0,0,0,16,0V48h24V80H48V48ZM208,208H48V96H208V208Zm-38.34-85.66a8,8,0,0,1,0,11.32l-48,48a8,8,0,0,1-11.32,0l-24-24a8,8,0,0,1,11.32-11.32L116,164.69l42.34-42.35A8,8,0,0,1,169.66,122.34Z"></path>
                    </svg>
                    Jadwal Kuliah
                </a>
            </li>

            {{-- @hasanyrole('dosen|mahasiswa')
            <li>
                <a href="{{  Auth::user()->hasRole('dosen') 
            ? route('kelas.index') 
            : route('nilai.index.byMahasiswa', Auth::user()->mahasiswa->id_mahasiswa) }}"
                    class="flex items-center gap-3 px-3 py-2 rounded transition duration-200
                        {{ Request::is('kelas*') ? 'bg-white text-gray-900 font-semibold' : 'hover:bg-gray-800' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="32" fill="currentcolor" viewBox="0 0 256 256">
                        <path d="M240,192h-8V56a16,16,0,0,0-16-16H40A16,16,0,0,0,24,56V192H16a8,8,0,0,0,0,16H240a8,8,0,0,0,0-16ZM40,56H216V192H200V168a8,8,0,0,0-8-8H120a8,8,0,0,0-8,8v24H72V88H184v48a8,8,0,0,0,16,0V80a8,8,0,0,0-8-8H64a8,8,0,0,0-8,8V192H40ZM184,192H128V176h56Z"></path>
                    </svg>
                    <h3>
                        {{ Auth::user()->hasRole('dosen') ? 'Manajemen Nilai' : 'Nilai' }}
                    </h3>
                </a>
            </li>
            @endhasanyrole --}}

            @hasanyrole('admin')
            <li>
                <a href="{{ route('kelas.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded transition duration-200
                        {{ Request::is('kelas*') ? 'bg-white text-gray-900 font-semibold' : 'hover:bg-gray-800' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="32" fill="currentcolor" viewBox="0 0 256 256">
                        <path d="M240,192h-8V56a16,16,0,0,0-16-16H40A16,16,0,0,0,24,56V192H16a8,8,0,0,0,0,16H240a8,8,0,0,0,0-16ZM40,56H216V192H200V168a8,8,0,0,0-8-8H120a8,8,0,0,0-8,8v24H72V88H184v48a8,8,0,0,0,16,0V80a8,8,0,0,0-8-8H64a8,8,0,0,0-8,8V192H40ZM184,192H128V176h56Z"></path>
                    </svg>
                    Kelas
                </a>
            </li>
            @endhasanyrole

            @hasanyrole('dosen')
            <li>
                <a href="{{ route('frs.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded transition duration-200
                        {{ Request::is('frs*') ? 'bg-white text-gray-900 font-semibold' : 'hover:bg-gray-800' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="32" fill="currentcolor" viewBox="0 0 256 256">
                        <path d="M213.66,82.34l-56-56A8,8,0,0,0,152,24H56A16,16,0,0,0,40,40V216a16,16,0,0,0,16,16H200a16,16,0,0,0,16-16V88A8,8,0,0,0,213.66,82.34ZM160,51.31,188.69,80H160ZM200,216H56V40h88V88a8,8,0,0,0,8,8h48V216Zm-32-80a8,8,0,0,1-8,8H96a8,8,0,0,1,0-16h64A8,8,0,0,1,168,136Zm0,32a8,8,0,0,1-8,8H96a8,8,0,0,1,0-16h64A8,8,0,0,1,168,168Z"></path>
                    </svg>
                    FRS
                </a>
            </li>
            @endhasanyrole
            
            @hasanyrole('mahasiswa')
            <li>
                <a href="{{ route('frs.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded transition duration-200
                        {{ Request::is('frs*') ? 'bg-white text-gray-900 font-semibold' : 'hover:bg-gray-800' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="32" fill="currentcolor" viewBox="0 0 256 256">
                        <path d="M213.66,82.34l-56-56A8,8,0,0,0,152,24H56A16,16,0,0,0,40,40V216a16,16,0,0,0,16,16H200a16,16,0,0,0,16-16V88A8,8,0,0,0,213.66,82.34ZM160,51.31,188.69,80H160ZM200,216H56V40h88V88a8,8,0,0,0,8,8h48V216Zm-32-80a8,8,0,0,1-8,8H96a8,8,0,0,1,0-16h64A8,8,0,0,1,168,136Zm0,32a8,8,0,0,1-8,8H96a8,8,0,0,1,0-16h64A8,8,0,0,1,168,168Z"></path>
                    </svg>
                    FRS
                </a>
            </li>
            @endhasanyrole

            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-3 w-full text-left px-3 py-2 rounded transition duration-200 hover:bg-gray-800">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M16 13v-2H7V8l-5 4 5 4v-3h9zm2-10H6c-1.1 0-2 .9-2 2v6h2V5h12v14H6v-6H4v6c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z" />
                        </svg>
                        Logout
                    </button>
                </form>
            </li>


        </ul>
    </nav>
</aside>