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
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

</head>

<body>
    <header>
        <nav class="navbar d-flex justify-content-between align-items-center py-4 px-5" data-type="admin">
            <div class="navbar__items d-flex">
                <button type="submit" class="navbar__items--btn me-4"><a href="{{ route('curriculum_management',['id' => 1]) }}">授業管理</a></button>
                <button type="submit" class="navbar__items--btn me-4" data-type="long-text"><a href="{{ route('article_management') }}">お知らせ管理</a></button>
                <button type="submit" class="navbar__items--btn"><a href="{{ route('banner_management') }}">バナー管理</a></button>
            </div>
            <div class="navbar--logout">
                @if (Auth::guard('admin')->check())
                <a href="{{ route('admin_logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" data-type="admin">ログアウト
                </a>
                <form id="logout-form" action="{{ route('admin_logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                @else
                <a class="navbar-link__login" href="{{ route('admin_login') }}">ログイン</a>
                @endif
            </div>
        </nav>
    </header>
    <div class="py-4 px-5">
        @yield('content')
    </div>
</body>

</html>
