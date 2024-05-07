@extends('user.layouts.login_template')

@section('content')
<div class="banner">
    <div class="banner-area" id="bannerArea">
        @foreach ($banners as $banner)
        <div class="banner-image">
            <img src="{{ asset('storage/' . $banner->image) }}" alt="">
        </div>
        @endforeach
    </div>
    <ul class="banner-dot" id="bannerDot"></ul>
</div>

<div class="article">
    <h2>お知らせ</h2>
    <!-- DBからデータを取得し、foreachでループして表示させる。 -->
    @foreach ($articles as $article)
    <p>
        <a href="{{ route('article', ['id' => $article->id]) }}"> {{ $article->posted_date }}
            {{ $article->title }}</a>
    </p>
    @endforeach
</div>
@endsection
