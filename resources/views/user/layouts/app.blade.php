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
    @vite(['resources/sass/app.scss', 'resources/css/user.css', 'resources/js/user.js'])

</head>

<body>
    <div class="main">
        @guest
        @if (Request::is('login'))
        <nav class="register__form m-5 text-end">
            <a href="{{ route('register') }}">新規会員登録はこちら</a>
        </nav>
        @else
        <nav class="register__form m-5 text-end">
            <a href="{{ route('login') }}">ログインはこちら</a>
        </nav>
        @endif
        @endguest

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
