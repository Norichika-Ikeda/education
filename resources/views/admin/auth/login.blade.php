@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="login__title mb-5">
        <h1 class="text-center">管理画面ログイン
    </div>
    <div class="login__form">
        <form method="POST" action="{{ route('admin_login') }}">
            @csrf
            <div class="login__form--mail row mb-3">
                <label for="email" class="col-md-4 col-form-label text-end">メールアドレス</label>
                <div class="col-md-5">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="login__form--password row mb-3">
                <label for="password" class="col-md-4 col-form-label text-end">パスワード</label>
                <div class="col-md-5">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="login__form--button my-5 text-center">
                <button type="submit">ログイン</button>
            </div>
        </form>
    </div>
</div>
@endsection
