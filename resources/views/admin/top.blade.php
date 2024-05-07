@extends('admin.layouts.login_template')

@section('content')
<div class="account">
    <p>ユーザーネーム：{{ Auth::guard('admin')->user()->name }}</p>
    <p>メールアドレス：{{ Auth::guard('admin')->user()->email }}</p>
</div>
@endsection
