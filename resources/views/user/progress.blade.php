@extends('user.layouts.login_template')

@section('content')
<div class="back-btn">
    <a href="top">←戻る</a>
</div>

<p>授業進捗です。</p>

<div class="user-image">
    @if($user->profile_image)
    <img src="{{ asset('storage/images/' . $user->profile_image) }}" alt="">
    @else
    <img src="storage/360_F_505447855_pI5F0LDCyNfZ2rzNowBoBuQ9IgT3EQQ7.jpg" alt="" width="200">
    @endif
</div>
<div class="user-progress">
    <p>{{ $user->name }}さんの授業進捗</p>
    <p>現在の学年：</p>
</div>

@endsection
