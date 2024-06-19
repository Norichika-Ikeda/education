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
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>

<body>
    <header>
        <nav class="navbar d-flex justify-content-between py-4 px-5">
            <div class="navbar__items d-flex">
                <button type="button" class="navbar__items--btn me-4"><a href="{{ route('timetable') }}">時間割</a></button>
                <button type="button" class="navbar__items--btn me-4"><a href="{{ route('progress') }}">授業進捗</a></button>
                <button type="button" class="navbar__items--btn"><a href="{{ route('profile') }}">プロフィール設定</a></button>
            </div>
            <div class="navbar--logout">
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
    <div class="py-4 px-5">
        @yield('content')
    </div>
</body>

</html>
