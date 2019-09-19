<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="relative min-h-screen bg-gray-100 text-blue-900">
    <header class="min-h-hero p-4 rounded-br-xl rounded-bl-xl bg-blue-500">
        @include('partials/nav')

        @yield('header-content')
    </header>

    <main class="-mt-8 px-8 pb-4">
        @yield('content')
    </main>

    @include('partials/achievement-unlocked')

    @yield('scripts')
</body>
</html>
