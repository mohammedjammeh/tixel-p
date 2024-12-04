<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

{{--    <title>{{ config('app.name', 'Laravel') }}</title>--}}
    <title>tixel p</title>

    <meta name="description" content="{{ $description ?? '' }}">
    <meta name="keywords" content="{{ $keywords ?? '' }}">
    <meta name="author" content="{{ $author ?? '' }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Vite CSS --}}
{{--    {{ module_vite('build-order', 'resources/assets/css/app.css', storage_path('vite.hot')) }}--}}
{{--    {{ module_vite('build-order', 'resources/assets/sass/app.scss', storage_path('vite.hot')) }}--}}
    @vite('resources/assets/css/app.css')
    @vite('resources/assets/sass/app.scss')
</head>

<body class="m-auto max-w-5xl">
    <header class="text-center m-5">
        <h1>tixel p</h1>
    </header>

    <div id="app">
        @yield('content')
    </div>

    <section>
        <p class="text-center m-5">&copy; 2024 tixel p</p>
    </section>

    {{-- Vite JS --}}
{{--     {{ module_vite('build-order', 'resources/assets/js/app.js', storage_path('vite.hot')) }}--}}
    @vite('resources/assets/js/app.js')
</body>
