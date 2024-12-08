<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Pizza POS</title>

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

    <script src="https://kit.fontawesome.com/b1d79f2ea5.js" crossorigin="anonymous"></script>
</head>

<body class="bg-slate-100">
    <div class="m-auto max-w-4xl">
        <header class="mt-8 mb-7">
            <h1 class="text-lg text-center text-orange-800" data-test="heading"><a href="/">Pizza POS</a></h1>
        </header>

        <section>
            <div id="app">
                @yield('content')
            </div>
        </section>
    </div>

    {{-- Vite JS --}}
{{--     {{ module_vite('build-order', 'resources/assets/js/app.js', storage_path('vite.hot')) }}--}}
    @vite('resources/assets/js/app.js')
</body>
