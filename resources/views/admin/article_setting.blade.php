@extends('admin.layouts.login_template')

@section('content')
<div class="back__btn">
    <a href="{{ route('article_management') }}">←戻る</a>
</div>

<h2>お知らせ変更</h2>

<div class="article-setting" id="articleSetting">
    @if(Request::is('admin/article_edit/*'))
    {{ Form::open(['route' => 'article_edit']) }}
    @csrf
    @else
    {{ Form::open(['route' => 'article_create']) }}
    @csrf
    @endif
    @if(isset($article->id))
    <div class="article-id">
        <input type="hidden" name="id" value="{{ $article->id }}">
    </div>
    @endif
    <div class="row mb-3 form-group">
        <label for="posted-date" class="col-sm-2 col-form-label">投稿日時</label>
        @if(isset($article->posted_date))
        <input type="date" name="posted_date" class="posted-date form-control w-75 @error('posted_date') is-invalid @enderror" value="{{ $article->posted_date }}" placeholder=" ">
        @else
        <input type="date" name="posted_date" class="posted-date form-control w-75 @error('posted_date') is-invalid @enderror" value="{{ old('posted_date') }}" placeholder=" ">
        @endif
        @if($errors->has('posted_date'))
        <p>{{ $errors->first('posted_date') }}</p>
        @endif
    </div>
    <div class="row mb-3 form-group">
        <label for="title" class="col-sm-2 col-form-label">タイトル</label>
        @if(isset($article->title))
        <input type="text" name="title" class="form-control w-75 @error('title') is-invalid @enderror" value="{{ $article->title }}">
        @else
        <input type="text" name="title" class="form-control w-75 @error('title') is-invalid @enderror" value="{{ old('title') }}">
        @endif
        @if($errors->has('title'))
        <p>{{ $errors->first('title') }}</p>
        @endif
    </div>
    <div class="row mb-3">
        <label for="article-contents" class="col-sm-2 col-form-label">本文</label>
        @if(isset($article->article_contents))
        <textarea name="content" class="form-control w-75 @error('content') is-invalid @enderror" value="{{ $article->article_contents }}">{{ $article->article_contents }}</textarea>
        @else
        <textarea name="content" class="form-control w-75 @error('content') is-invalid @enderror" value="{{ old('content') }}">{{ old('content') }}</textarea>
        @endif
        @if($errors->has('content'))
        <p>{{ $errors->first('content') }}</p>
        @endif
    </div>
    <button type="submit" class="me-4">登録</button>
    {{ Form::close() }}
</div>

@endsection
