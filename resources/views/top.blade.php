@extends('layouts.login_template')

@section('content')
<div class="banner">
    <div class="banner-area">

    </div>
    <div class="send-image">
        <p>●●●●</p>
    </div>
</div>

<div class="article">
    <h2>お知らせ</h2>
    <!-- DBからデータを取得し、foreachでループして表示させる。 -->
    @foreach ($articles as $article)
    {{ Form::open(['url' => 'article/' .$article->id, 'method' => 'GET']) }}
    @csrf
    <table>
        <thead>
            <tr></tr>
            <tr></tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $article->posted_date }}</td>
                <td>{{ $article->title }}</td>
            </tr>
        </tbody>
    </table>
    {{ Form::close() }}
    @endforeach
</div>
@endsection
