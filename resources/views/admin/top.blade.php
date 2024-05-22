@extends('admin.layouts.login_template')

@section('content')
<div class="account mt-5 p-4 w-75">
    <p>ユーザーネーム：{{ Auth::guard('admin')->user()->name }}</p>
    <p class="mb-0">メールアドレス：{{ Auth::guard('admin')->user()->email }}</p>
</div>
@endsection
