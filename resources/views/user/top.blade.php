@extends('user.layouts.login_template')

@section('content')
<div class="banner">
    <div class="banner__area" id="bannerArea">
        @foreach ($banners as $banner)
        <div class="banner__area__image">
            <img src="{{ asset('storage/images/' . $banner->image) }}" alt="">
        </div>
        @endforeach
    </div>
    <ul class="banner__dot w-100 mt-2 mb-5 ps-0 text-center" id="bannerDot"></ul>
</div>

<div class="article">
    <h2>お知らせ</h2>
    <!-- DBからデータを取得し、foreachでループして表示させる。 -->
    <div class="article__list">
        @foreach ($articles as $article)
        <p>
            <a href="{{ route('article', ['id' => $article->id]) }}"> {{ $article->posted_date->format('Y年n月j日') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $article->title }}</a>
        </p>
        @endforeach
    </div>
</div>
@endsection
