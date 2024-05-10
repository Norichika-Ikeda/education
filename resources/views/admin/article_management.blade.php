@extends('admin.layouts.login_template')

@section('content')
<div class="back-btn">
    <a href="{{ route('admin_top') }}">←戻る</a>
</div>

<h2>お知らせ一覧</h2>
<div class="top d-flex justify-content-between mt-1 mb-5 mx-3 w-25">
    <div class="create-curriculum">
        <button type="submit" class="py-2 px-4" onclick="location.href=`{{ route('article_create_form') }}`">新規登録</button>
    </div>
</div>

<div class="article-list">
    <table id="articleTable" class="w-100">
        <thead valign="top">
            <tr>
                <th class="col-3 fs-3 fw-normal">投稿日時</th>
                <th class="col-7 fs-3 fw-normal">タイトル</th>
                <th class="col-1"></th>
                <th class="col-1"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
            <tr>
                <td class="fs-4">{{ $article->posted_date }}</td>
                <td class="fs-4 article-title">{{ $article->title }}</td>
                {{ Form::open(['url' => 'admin/article_edit/' .$article->id, 'method' => 'GET']) }}
                <td><button type="submit" class="edit-article py-2 w-100">変更する</button></td>
                {{ Form::close() }}
                <td><button type="submit" class="remove-article py-2 w-100" id="{{ $article->id }}">削除</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
