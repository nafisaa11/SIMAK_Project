<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    <!-- Loading Screen -->
    <div class="loading-container">
        <div class="book">
            <div class="back-cover"></div>
            <div class="book-cover"></div>
            <div class="pages">
                <div class="page"></div>
                <div class="page"></div>
                <div class="page"></div>
                <div class="page"></div>
                <div class="page"></div>
            </div>
        </div>
        <div class="loading-text">
            Memuat<span class="dots"></span>
        </div>
    </div>

    <!-- Page Content -->
    <div class="min-h-screen bg-gray-100" style="display:none">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <main>
            {{ $slot }}
        </main>
    </div>

    <script>
        window.addEventListener('load', function() {
            const loadingContainer = document.querySelector('.loading-container');
            const appContent = document.querySelector('.min-h-screen');
            if (loadingContainer && appContent) {
                loadingContainer.style.display = 'none';
                appContent.style.display = 'block';
            }
        });
    </script>
</body>

</html>