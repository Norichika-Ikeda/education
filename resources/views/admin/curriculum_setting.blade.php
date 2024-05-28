@extends('admin.layouts.login_template')

@section('content')
<div class="back__btn">
    <a href="{{ route('curriculum_management', ['id' => '1']) }}">←戻る</a>
</div>

<h2>授業設定</h2>

<div class="curriculum__form">
    @if(Request::is('admin/curriculum_edit/*'))
    {{ Form::open(['route' => 'curriculum_edit', 'files' => true]) }}
    @csrf
    @else
    {{ Form::open(['route' => 'curriculum_create', 'files' => true]) }}
    @csrf
    @endif
    @if(isset($curriculum->id))
    <div class="curriculum__form--id">
        <input type="hidden" name="id" value="{{ $curriculum->id }}">
    </div>
    @endif
    <div class="curriculum__form--image row mb-3 mx-4">
        <div class="col-sm-3">
            @if(isset($curriculum->thumbnail))
            <img src="{{ asset('storage/' .$curriculum->thumbnail) }}" alt="" class="curriculum__form--image--preview w-100">
            @else
            <img src="{{ asset('storage/e100c43d8a26007a9bb811c9af8e756e_t.jpeg') }}" alt="" class="curriculum__form--image--preview w-100">
            @endif
        </div>
        <div class="col-sm-4">
            <label for="image">サムネイル</label>
            <input type="file" name="image" class="curriculum__form--image--btn @error('image') is-invalid @enderror" value="{{ old('image') }}" style="display:none">
            <button type="button" class="curriculum__form--image--select d-block">ファイルを選択</button>
        </div>
        @if($errors->has('image'))
        <p>{{ $errors->first('image') }}</p>
        @endif
    </div>
    <div class="curriculum__form--class row mb-3 form-group">
        <label for="grade" class="col-sm-2 col-form-label">学年</label>
        <div class="col-sm-8">
            <select name="grade" class="form-select @error('grade') is-invalid @enderror">
                @foreach ($classes as $class)
                <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
        </div>
        @if($errors->has('grade'))
        <p>{{ $errors->first('grade') }}</p>
        @endif
    </div>
    <div class="curriculum__form--title row mb-3">
        <label for="title" class="col-sm-2 col-form-label">授業名</label>
        <div class="col-sm-8">
            @if(isset($curriculum->title))
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ $curriculum->title }}">
            @else
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
            @endif
        </div>
        @if($errors->has('title'))
        <p>{{ $errors->first('title') }}</p>
        @endif
    </div>
    <div class="curriculum__form--url row mb-3">
        <label for="movie" class="col-sm-2 col-form-label">動画URL</label>
        <div class="col-sm-8">
            @if(isset($curriculum->video_url))
            <input type="text" name="movie" class="form-control @error('movie') is-invalid @enderror" value="{{ $curriculum->video_url }}">
            @else
            <input type="text" name="movie" class="form-control @error('movie') is-invalid @enderror" value="{{ old('movie') }}">
            @endif
        </div>
        @if($errors->has('movie'))
        <p>{{ $errors->first('movie') }}</p>
        @endif
    </div>
    <div class="curriculum__form--description row mb-3">
        <label for="description" class="col-sm-2 col-form-label">授業概要</label>
        <div class="col-sm-8">
            @if(isset($curriculum->description))
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" value="{{ $curriculum->description }}" rows="5">{{ $curriculum->description }}</textarea>
            @else
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" rows="5">{{ old('description') }}</textarea>
            @endif
        </div>
        @if($errors->has('description'))
        <p>{{ $errors->first('description') }}</p>
        @endif
    </div>
    <div class="curriculum__form--flag">
        @if(isset($curriculum->alway_delivery_flg) && $curriculum->alway_delivery_flg == "1")
        <input type="checkbox" name="flag" class="form-check-input me-2 @error('flag') is-invalid @enderror" checked>
        @else
        <input type="checkbox" name="flag" class="form-check-input me-2 @error('flag') is-invalid @enderror">
        @endif
        <label for="flag">常時公開</label>
        @if($errors->has('flag'))
        <p>{{ $errors->first('flag') }}</p>
        @endif
    </div>
    <div class="curriculum__form--regist my-5 text-center">
        <button type="submit">登録</button>
    </div>
    {{ Form::close() }}
</div>

@endsection
