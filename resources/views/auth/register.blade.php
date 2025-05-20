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
                    Selamat<br>Datang di <span class="text-yellow-400">SIMAK NAY</span>
                </h1>
                <p class="text-2xl font-light mt-4">“Karena Setiap Data Akademik Itu Berharga.”</p>
            </div>
        </div>

        <!-- Right Side - Register Form (1/3 width) -->
        <div class="w-full lg:w-1/3 flex items-center justify-center bg-gray-100 border-l-4 border-blue-500">
            <div class="w-full max-w-2xl p-12">
                <!-- Logo -->
                <div class="flex items-center mb-8">
                    <img src="/build/assets/logo.svg" alt="Logo" class="h-10 w-10 mr-3">
                    <span class="text-2xl font-bold text-blue-800">SIMAK</span>
                </div>

                <!-- Heading -->
                <h2 class="text-3xl font-extrabold text-blue-800 mb-8">Daftar Akun</h2>

                <!-- Form -->
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring focus:ring-blue-200 text-lg px-4 py-2"
                            placeholder="Masukkan Nama Lengkap">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring focus:ring-blue-200 text-lg px-4 py-2"
                            placeholder="Masukkan Email">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                        <input id="password" type="password" name="password" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring focus:ring-blue-200 text-lg px-4 py-2"
                            placeholder="Masukkan Kata Sandi">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Kata Sandi</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring focus:ring-blue-200 text-lg px-4 py-2"
                            placeholder="Ulangi Kata Sandi">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Submit -->
                    <div>
                        <button type="submit"
                            class="w-full py-3 px-6 bg-gradient-to-r from-yellow-400 to-orange-400 text-white text-lg font-bold rounded-lg hover:opacity-90 transition duration-300">
                            Daftar
                        </button>
                    </div>
                </form>

                <!-- Link to Login -->
                <p class="text-center text-sm text-gray-600 mt-6">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-blue-700 font-semibold hover:underline">Login</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
