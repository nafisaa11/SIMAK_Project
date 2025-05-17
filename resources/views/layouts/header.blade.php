
  <!-- Header -->
  <header class="bg-[#003580] text-white p-4 rounded-lg flex items-center justify-between sticky top-6 z-20">
    <!-- Title -->
    <h1 class="text-xl font-semibold">@yield('title', 'Aplikasi')</h1>

    <!-- Search box -->
    <div class="relative">
      <input
        type="text"
        placeholder="Search"
        class="pl-4 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none text-black bg-white placeholder-gray-400 focus:ring-2 focus:ring-[#FCC823] focus:border-transparent" />
      <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="32" fill="#000000" viewBox="0 0 256 256">
          <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
        </svg>
      </div>
    </div>
  </header>

  