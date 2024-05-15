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
    <div class="main">
        <header>
            <nav class="navbar navbar-expand-md d-flex justify-content-between py-4 px-5" data-type="admin">
                <div class="navbar__list d-flex">
                    {{ Form::open(['url' => 'admin/curriculum_management/' .'1', 'method' => 'GET']) }}
                    <button type="submit" class="navbar__list-btn me-4">授業管理</button>
                    {{ Form::close() }}
                    {{ Form::open(['url' => 'admin/article_management', 'method' => 'GET']) }}
                    <button type="submit" class="navbar__list-btn me-4" onclick="location.href=``">お知らせ管理</button>
                    {{ Form::close() }}
                    {{ Form::open(['url' => 'admin/banner_management', 'method' => 'GET']) }}
                    <button type="submit" class="navbar__list-btn" onclick="location.href=``">バナー管理</button>
                    {{ Form::close() }}
                </div>
                <div class="logout">
                    @if (Auth::guard('admin')->check())
                    <a class="navbar-link__logout" data-type="admin" href="{{ route('admin_logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">ログアウト
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
    </div>
</body>

</html>
