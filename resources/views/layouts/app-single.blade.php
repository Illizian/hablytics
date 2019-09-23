<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- PWA -->
    <meta name="theme-color" content="#4299E1">
    <link rel="manifest" href="/app.webmanifest">
    <link rel="icon" sizes="192x192" href="/icons/icon-xxxhdpi.png">
    <link rel="apple-touch-icon" href="/icons/icon-xhdpi.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script>
        window._vapidPublicKey = "{{ config('webpush.vapid.public_key') }}";
    </script>
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 text-blue-900">
    <header class="min-h-hero p-4 rounded-bl-xl bg-blue-500">
        @include('partials/nav')

        @yield('header-content')
    </header>
    <div class="h-4 bg-blue-500"></div>
    <main class="-mt-4 px-4 py-4 bg-gray-100 rounded-tr-xl">
        @yield('content')
    </main>

    @include('partials/achievement-unlocked')

    @yield('scripts')
</body>
</html>
