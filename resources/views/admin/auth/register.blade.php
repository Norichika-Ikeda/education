@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="register__title mb-5">
        <h1 class="text-center">新規管理ユーザー登録
    </div>
    <div class="register__form">
        <form method="POST" action="{{ route('admin_register') }}">
            @csrf
            <div class="register__form--name row mb-3">
                <label for="name" class="col-md-4 col-form-label text-end">ユーザーネーム</label>
                <div class="col-md-5">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-end">メールアドレス</label>
                <div class="col-md-5">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-end">パスワード</label>
                <div class="col-md-5">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="password-confirm" class="col-md-4 col-form-label text-end">パスワード確認</label>
                <div class="col-md-5">
                    <input id="passwordConfirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>
            <div class="register__form--button my-5 text-center">
                <button type="submit">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection
