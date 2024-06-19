@extends('user.layouts.login_template')

@section('content')
<div class="back__btn">
    <a href="{{ route('top') }}">←戻る</a>
</div>

<div class="article__details m-4">
    <div class="article__details__date">
        <p>{{ $article->posted_date->format('Y年n月j日') }}</p>
    </div>
    <div class="article__details__title mb-4">
        <h3>{{ $article->title }}</h3>
    </div>
    <div class="article__details__contents fs-5">
        <p>{{ $article->article_contents }}</p>
    </div>
</div>
@endsection
