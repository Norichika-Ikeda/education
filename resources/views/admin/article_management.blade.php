@extends('admin.layouts.login_template')

@section('content')
<div class="back__btn">
    <a href="{{ route('admin_top') }}">←戻る</a>
</div>

<h2>お知らせ一覧</h2>
<div class="article__btn--regist my-4">
    <button type="submit" class="py-2 px-4" onclick="location.href=`{{ route('article_create_form') }}`">新規登録</button>
</div>

<div class="article">
    <table>
        <thead>
            <tr class="article__head">
                <th class="col-3 fw-normal">投稿日時</th>
                <th class="col-7 fw-normal">タイトル</th>
                <th class="col-1"></th>
                <th class="col-1"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
            <tr class="article__item">
                <td class="">{{ $article->posted_date->format('Y年n月j日') }}</td>
                <td class="article-title">{{ $article->title }}</td>
                {{ Form::open(['url' => 'admin/article_edit/' .$article->id, 'method' => 'GET']) }}
                <td><button type="submit" class="edit-article py-2">変更する</button></td>
                {{ Form::close() }}
                <td><button type="submit" class="remove-article py-2" id="{{ $article->id }}">削除</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
