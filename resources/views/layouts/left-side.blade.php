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
          {{ Request::is('dashboard') ? 'bg-white text-gray-900 font-semibold' : 'hover:bg-gray-800' }}">
                    <svg class="w-5 h-5 {{ Request::is('dashboard') ? 'text-gray-900' : 'text-white' }}"
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
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4s-4 1.79-4 4 1.79 4 4 4zm0 2c-3 0-8 1.5-8 4v2h16v-2c0-2.5-5-4-8-4z" />
                    </svg>
                    Mahasiswa
                </a>
            </li>

            {{-- <li>
                <a href="#"
                    class="flex items-center gap-3 px-3 py-2 rounded transition duration-200
          {{ Request::is('dosen*') ? 'bg-white text-gray-900 font-semibold' : 'hover:bg-gray-800' }}">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M21 3H3c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h5v2h8v-2h5c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM3 5h18v12H3V5zm9 6c1.66 0 3-1.34 3-3S13.66 5 12 5 9 6.34 9 8s1.34 3 3 3zm-7 5c0-2 4-3.1 7-3.1 3 0 7 1.1 7 3.1V17H5v-.1z" />
                    </svg>
                    Dosen
                </a>
            </li>

            <li>
                <a href="#"
                    class="flex items-center gap-3 px-3 py-2 rounded transition duration-200
          {{ Request::is('mataKuliah*') ? 'bg-white text-gray-900 font-semibold' : 'hover:bg-gray-800' }}">
                    <svg class="w-5 h-5 {{ Request::is('mataKuliah*') ? 'text-gray-900' : 'text-white' }}"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4 6v16h16V6H4zm2 2h12v12H6V8zm8-6v2H10V2h4z" />
                    </svg>
                    Mata Kuliah
                </a>
            </li>

            <li>
                <a href="#"
                    class="flex items-center gap-3 px-3 py-2 rounded transition duration-200
      {{ Request::is('frs*') ? 'bg-white text-gray-900 font-semibold' : 'hover:bg-gray-800' }}">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M19 3H5c-1.1 0-2 .9-2 2v16l4-4h12c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-4 10H9v-2h6v2zm2-4H7V7h10v2z" />
                    </svg>
                    FRS
                </a>
            </li> --}}

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
