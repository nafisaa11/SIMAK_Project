<x-guest-layout>
    <div class="min-h-screen flex">
        <!-- Left Side - Welcome (2/3 width) -->
        <div class="hidden lg:flex w-2/3 relative bg-cover bg-center items-center justify-center"
            style="background-image: url('/build/assets/banner.png');">
            <!-- Overlay warna gelap -->
            <div class="absolute inset-0 bg-[#0A1931] opacity-80 z-0"></div>

            <!-- Konten teks -->
            <div class="relative text-white px-10 z-10">
                <h1 class="text-5xl font-bold mb-4 leading-tight">
                    Selamat<br>Datang di <span class="text-yellow-400">SIMAK</span>
                </h1>
                <p class="text-2xl font-light mt-4">“Karena Setiap Data Akademik Itu Berharga.”</p>
            </div>
        </div>

        <!-- Right Side - Login (1/3 width) -->
        <div class="w-full lg:w-1/3 flex items-center justify-center bg-gray-100 border-l-4 border-blue-500">
            <div class="w-full max-w-2xl p-12"> {{-- Dihilangkan bg-white, rounded-xl, dan shadow-xl --}}
                <div class="flex items-center mb-8">
                    <img src="/build/assets/logo.svg" alt="Logo" class="h-10 w-10 mr-3">
                    <span class="text-2xl font-bold text-blue-800">SIMAK</span>
                </div>
                
                <h2 class="text-3xl font-extrabold text-blue-800 mb-8">Masuk Akun</h2>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autofocus
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring focus:ring-blue-200 text-lg px-4 py-2"
                            placeholder="Masukkan Email">
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                        <input id="password" type="password" name="password" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring focus:ring-blue-200 text-lg px-4 py-2"
                            placeholder="Masukkan Kata Sandi">
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="w-full py-3 px-6 bg-gradient-to-r from-yellow-400 to-orange-400 text-white text-lg font-bold rounded-lg hover:opacity-90 transition duration-300">
                            Login
                        </button>
                    </div>
                </form>

                <!-- Link to Register -->
                <p class="text-center text-sm text-gray-600 mt-6">
                    Belum punya akun? Yuk langsung
                    <a href="{{ route('register') }}" class="text-blue-700 font-semibold hover:underline">Daftar!</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
