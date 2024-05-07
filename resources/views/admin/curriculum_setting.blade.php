@extends('admin.layouts.login_template')

@section('content')
<div class="back-btn">
    <a href="{{ route('curriculum_management', ['id' => '1']) }}">←戻る</a>
</div>

<p>授業設定</p>

<div class="curriculum-setting">
    @if(Request::is('admin/curriculum_setting/*'))
    {{ Form::open(['route' => 'curriculum_edit', 'files' => true]) }}
    @csrf
    @else
    {{ Form::open(['route' => 'curriculum_create', 'files' => true]) }}
    @csrf
    @endif
    @if(isset($curriculum->id))
    <div class="curriculum-id">
        <input type="hidden" name="id" value="{{ $curriculum->id }}">
    </div>
    @endif
    <div class="mb-3 curriculum-image">
        @if(isset($curriculum->thumbnail))
        <img src="{{ asset('storage/' .$curriculum->thumbnail) }}" alt="" width="300px">
        @else
        <img src="{{ asset('storage/e100c43d8a26007a9bb811c9af8e756e_t.jpeg') }}" alt="" width="300px">
        @endif
        <input type="file" name="image" class="@error('image') is-invalid @enderror" value="{{ old('image') }}">
        @if($errors->has('image'))
        <p>{{ $errors->first('image') }}</p>
        @endif
    </div>
    <div class="row mb-3 form-group">
        <label for="grade" class="col-sm-2 col-form-label">学年</label>
        <select name="grade" class="form-select w-75 @error('grade') is-invalid @enderror">
            @foreach ($classes as $class)
            <option value="{{ $class->id }}">{{ $class->name }}</option>
            @endforeach
        </select>
        @if($errors->has('grade'))
        <p>{{ $errors->first('grade') }}</p>
        @endif
    </div>
    <div class="row mb-3">
        <label for="title" class="col-sm-2 col-form-label">授業名</label>
        @if(isset($curriculum->title))
        <input type="text" name="title" class="form-control w-75 @error('title') is-invalid @enderror" value="{{ $curriculum->title }}">
        @else
        <input type="text" name="title" class="form-control w-75 @error('title') is-invalid @enderror" value="{{ old('title') }}">
        @endif
        @if($errors->has('title'))
        <p>{{ $errors->first('title') }}</p>
        @endif
    </div>
    <div class="row mb-3">
        <label for="movie" class="col-sm-2 col-form-label">動画URL</label>
        @if(isset($curriculum->video_url))
        <input type="text" name="movie" class="form-control w-75 @error('movie') is-invalid @enderror" value="{{ $curriculum->video_url }}">
        @else
        <input type="text" name="movie" class="form-control w-75 @error('movie') is-invalid @enderror" value="{{ old('movie') }}">
        @endif
        @if($errors->has('movie'))
        <p>{{ $errors->first('movie') }}</p>
        @endif
    </div>
    <div class="row mb-3">
        <label for="description" class="col-sm-2 col-form-label">授業概要</label>
        @if(isset($curriculum->description))
        <textarea name="description" class="form-control w-75 @error('description') is-invalid @enderror" value="{{ $curriculum->description }}">{{ $curriculum->description }}</textarea>
        @else
        <textarea name="description" class="form-control w-75 @error('description') is-invalid @enderror" value="{{ old('description') }}">{{ old('description') }}</textarea>
        @endif
        @if($errors->has('description'))
        <p>{{ $errors->first('description') }}</p>
        @endif
    </div>
    <div class="custom-control custom-checkbox">
        @if(isset($curriculum->alway_delivery_flg) && $curriculum->alway_delivery_flg == "1")
        <input type="checkbox" name="flag" class="custom-control-input @error('flag') is-invalid @enderror" checked>
        @else
        <input type="checkbox" name="flag" class="custom-control-input @error('flag') is-invalid @enderror">
        @endif
        <label for="flag" class="custom-control-label">常時公開</label>
        @if($errors->has('flag'))
        <p>{{ $errors->first('flag') }}</p>
        @endif
    </div>
    <button type="submit" class="btn btn-warning me-4">登録</button>
    {{ Form::close() }}
</div>

@endsection
