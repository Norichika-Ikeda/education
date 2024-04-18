@extends('layouts.login_template')

@section('content')
<button type="button" onClick="history.back()">←戻る</button>

<!-- {{ Form::open(['route' => 'top', 'method' => 'get']) }}
<button type="submit" class="btn btn-info">←戻る</button>
{{ Form::close() }} -->

<div class="article-date">
    <p>{{ $article->posted_date }}</p>
</div>
<div class="article-title">
    <h3>{{ $article->title }}</h3>
</div>
<div class="article-detail">
    <p>{{ $article->article_contents }}</p>
</div>
@endsection
