<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CSU-APARRI LIBRARY') }}</title>

    <link rel="shortcut icon" href="{{ asset('IMG/csulogo.png') }}" type="image/x-icon">

    {{-- Font Awesome --}}
    <script src="https://kit.fontawesome.com/5c14b0052b.js" crossorigin="anonymous"></script>

    {{--  CSS  --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    {{--  Sweet Alert  --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

    <style>
        .font {
            font-family: 'Nunito';
        }
    </style>
</head>

<body>
    <div id="app">
        @extends('adminlte::page')

        {{--  @section('title', 'Dashboard')

        @section('content_header')
            <h1>Dashboard</h1>
        @stop  --}}

        @section('content')
            <main class="py-4">
                {{ $slot }}
            </main>
        @stop

        @section('js')
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
            {{-- Bootstrap Script --}}
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
            </script>
            {{-- ION ICONS --}}
            <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

            <script>
                document.addEventListener('keydown', function(event) {
                    if (event.keyCode === 112) { // F1 key
                        event.preventDefault(); // Prevent the default F1 behavior
                        window.open("/admin/redirect", "_blank"); // Open the URL in a new tab
                    }

                    if (event.keyCode === 113) { // F2 key
                        event.preventDefault(); // Prevent the default F1 behavior
                        window.open("/admin/redirect-computer", "_blank"); // Open the URL in a new tab
                    }
                });
            </script>
        @stop
    </div>


</body>

</html>
