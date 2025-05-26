    <!doctype html>
    <html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://unpkg.com/phosphor-icons"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>@yield('title', 'Aplikasi')</title>
        <link rel="icon" href="/build/assets/logo.svg" type="image/x-icon">
         <!-- Add your CSS links here -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        .select-approval {
            transition: all 0.2s ease-in-out;
        }
        
        .select-approval:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        /* Custom styling untuk option berdasarkan value */
        .select-approval option[value="Disetujui"] {
            background-color: #f0fdf4;
            color: #166534;
        }
        
        .select-approval option[value="Tidak Disetujui"] {
            background-color: #fef2f2;
            color: #991b1b;
        }
        
        .select-approval option[value="Belum Disetujui"] {
            background-color: #fefce8;
            color: #a16207;
        }
        </style>
    </head>
    <body class="bg-gray-100 min-h-screen flex flex-col">
    <div class="flex flex-col flex-1 ml-64 px-6">
        @include('layouts.header')

        <div class="flex flex-1 my-6 py-6">
            @include('layouts.left-side')

            <main class="flex-1 ">
                @yield('content')
            </main>
        </div>
    </div>

        @include('layouts.footer')

         <!-- Add your JS scripts here -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    </body>
    </html>
