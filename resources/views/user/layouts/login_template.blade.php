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
    <link rel="stylesheet" href="{{ asset('../resources/css/app.css') }}">

</head>

<body>
    <div class="main">
        <header>
            <nav class="navbar navbar-expand-md d-flex justify-content-between py-4 px-5">
                <div class="navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item me-4"><a href="timetable">時間割</a></li>
                        <li class="nav-item me-4"><a href="progress">授業進捗</a></li>
                        <li class="nav-item"><a href="profile">プロフィール設定</a></li>
                    </ul>
                </div>
                <div class="logout">
                    @if (Auth::guard('user')->check())
                    <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">ログアウト
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    @else
                    <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                    @endif
                </div>
            </nav>
        </header>
        <div class="py-4">
            @yield('content')
        </div>
    </div>
</body>

</html>
