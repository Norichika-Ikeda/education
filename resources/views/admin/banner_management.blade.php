@extends('admin.layouts.login_template')

@section('content')
<div class="back__btn">
    <a href="{{ route('admin_top') }}">←戻る</a>
</div>

<h2>バナー管理</h2>

<div class="banner__form" id="bannerForm">
    {{ Form::open(['route' => 'banner_edit', 'file' => true, "enctype" => "multipart/form-data"]) }}
    @csrf
    @foreach($banners as $banner)
    <div class="banner__form--select align-items-center w-50">
        <input type="hidden" name="banner_id[]" class="banner-id" value="{{ $banner->id }}">
        <img src="{{ asset('storage/images/' .$banner->image) }}" alt="" width="240px" class="banner-image">
        <input type="file" name="banner[]" class="banner-form @error('banner[]') is-invalid @enderror" value="{{ $banner->image }}" style="display:none">
        <button type="button" name="{{ $banner->id }}" class="banner-select ms-5">ファイルを選択</button>
        @if($errors->has('banner'))
        <p>{{ $errors->first('banner') }}</p>
        @endif
        <div id="{{ $banner->id }}" class="delete-banner ms-5"></div>
    </div>
    @endforeach
    <div id="addBanner" class="banner__form--add"></div>
    <div class="banner__form--regist my-5 text-center">
        <button type="submit">登録</button>
    </div>
    {{ Form::close() }}
</div>

@endsection
