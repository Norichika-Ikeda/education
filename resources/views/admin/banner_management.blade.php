@extends('admin.layouts.login_template')

@section('content')
<div class="back-btn">
    <a href="{{ route('admin_top') }}">←戻る</a>
</div>

<h2>バナー管理</h2>
<div class="curriculum-title">

</div>
{{ Form::open(['route' => 'banner_edit']) }}
@csrf

<div class="banner-setting" id="bannerSetting">
    @foreach($banners as $banner)
    <div class="banner d-flex align-items-center">
        <input type="hidden" name="banner_id[]" class="banner-id" value="{{ $banner->id }}">
        <img src="{{ asset('storage/' .$banner->image) }}" alt="" width="200px" height="130px" class="banner-image">
        <input type="file" name="banner[]" class="banner-form @error('banner[]') is-invalid @enderror" value="{{ $banner->image }}" style="display:none">
        <button type="button" name="{{ $banner->id }}" class="banner-select ms-5">画像を選択</button>
        @if($errors->has('banner'))
        <p>{{ $errors->first('banner') }}</p>
        @endif
        <div id="{{ $banner->id }}" class="delete-banner ms-5"></div>
    </div>
    @endforeach
</div>
<div id="addBanner" class="add-banner"></div>

<button type="submit">登録</button>

{{ Form::close() }}


@endsection
