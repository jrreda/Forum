<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @yield('styles')
</head>
<body class="pb-5">
    <div id="app">
        @include('layouts._nav')

        <main class="py-4">
            <!-- include the content for the current page -->
            @yield('content')

            <!-- display flash messages -->
            <div class="d-inline-flex py-1 px-3 float-end">
                <x-flash />
            </div>
        </main>

        @yield('scripts')
    </div>
</body>
</html>
