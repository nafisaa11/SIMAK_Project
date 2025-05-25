<!-- Header -->
<header class="bg-[#003580] backdrop-blur-md text-white py-4 px-6 rounded-lg flex items-center justify-between sticky top-0 z-50">
  <!-- Title -->
  <h1 class="text-xl font-semibold">@yield('title', 'Aplikasi')</h1>

  <!-- Nama Pengguna -->
  <div class="relative">
    @php
        $user = Auth::user(); 
        $nama = $user->name;
    @endphp
    
    <span>{{ $nama }}</span>
  </div>
</header>
