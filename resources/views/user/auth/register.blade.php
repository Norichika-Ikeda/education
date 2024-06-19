@extends('user.layouts.app')

@section('content')
<div class="container">
    <div class="register__title mb-5">
        <h1 class="text-center">新規会員登録</h1>
    </div>
    <div class="register__form">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="register__form--name row mb-3">
                <label for="name" class="col-md-4 col-form-label text-end">ユーザーネーム</label>
                <div class="col-md-5">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="register__form--ruby row mb-3">
                <label for="kanaName" class="col-md-4 col-form-label text-end">カナ</label>
                <div class="col-md-5">
                    <input type="text" class="form-control @error('kanaName') is-invalid @enderror" name="name_kana" value="{{ old('kanaName') }}" required autocomplete="kanaName" autofocus>
                    @error('kanaName')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="register__form--mail row mb-3">
                <label for="email" class="col-md-4 col-form-label text-end">メールアドレス</label>
                <div class="col-md-5">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="register__form--password row mb-3">
                <label for="password" class="col-md-4 col-form-label text-end">パスワード</label>
                <div class="col-md-5">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="register__form--password-confirm row mb-3">
                <label for="password-confirm" class="col-md-4 col-form-label text-end">パスワード確認</label>
                <div class="col-md-5">
                    <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>
            <div class="register__form--grade d-none">
                <input type="text" name="grade" value="1">
            </div>
            <div class="register__form--button my-5 text-center">
                <button type="submit">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection
