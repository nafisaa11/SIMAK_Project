    <!doctype html>
    <html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />\
        <script src="https://unpkg.com/phosphor-icons"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>@yield('title', 'Aplikasi')</title>
        <link rel="icon" href="/build/assets/logo.svg" type="image/x-icon">
    </head>
    <body class="bg-gray-100 min-h-screen flex flex-col">
    <div class="flex flex-col flex-1 ml-64 px-6">
        @include('layouts.header')

        <div class="flex flex-1 my-6">
            @include('layouts.left-side')

            <main class="flex-1 ">
                @yield('content')
            </main>
        </div>
    </div>

        @include('layouts.footer')
    </body>
    </html>
