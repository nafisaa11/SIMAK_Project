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
                    Verifikasi<br>Email Anda di <span class="text-yellow-400">SIMAK</span>
                </h1>
                <p class="text-2xl font-light mt-4">"Satu Langkah Lagi untuk Mengakses Semua Fitur."</p>
            </div>
        </div>

        <!-- Right Side - Verification (1/3 width) -->
        <div class="w-full lg:w-1/3 flex items-center justify-center bg-gray-100 border-l-4 border-blue-500">
            <div class="w-full max-w-2xl p-12">
                <div class="flex items-center mb-8">
                    <img src="/build/assets/logo.svg" alt="Logo" class="h-10 w-10 mr-3">
                    <span class="text-2xl font-bold text-blue-800">SIMAK</span>
                </div>
                
                <h2 class="text-3xl font-extrabold text-blue-800 mb-6">Verifikasi Email</h2>

                <!-- Pesan utama -->
                <div class="mb-6 p-4 bg-blue-50 rounded-lg border-l-4 border-blue-400">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-800 font-medium">
                                {{ __('Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan. Jika Anda tidak menerima email tersebut, kami akan dengan senang hati mengirimkan yang lain.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Pesan sukses -->
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-6 p-4 bg-green-50 rounded-lg border-l-4 border-green-400">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-800 font-medium">
                                    {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Form actions -->
                <div class="space-y-4">
                    <!-- Resend verification email -->
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit"
                            class="w-full py-3 px-6 bg-gradient-to-r from-yellow-400 to-orange-400 text-white text-lg font-bold rounded-lg hover:opacity-90 transition duration-300 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            {{ __('Kirim Ulang Email Verifikasi') }}
                        </button>
                    </form>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full py-3 px-6 bg-gray-200 text-gray-700 text-lg font-semibold rounded-lg hover:bg-gray-300 transition duration-300 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            {{ __('Keluar') }}
                        </button>
                    </form>
                </div>

                <!-- Info tambahan -->
                <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-gray-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 3a1 1 0 00-1.447-.894L8.763 6H5a3 3 0 000 6h.28l1.771 5.316A1 1 0 008 18h1a1 1 0 001-1v-4.382l6.553 3.276A1 1 0 0018 15V3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-gray-600">
                                <strong>Tips:</strong> Periksa folder spam/junk jika email verifikasi tidak ditemukan di kotak masuk Anda.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>