@extends('user.layouts.login_template')

@section('content')
<div class="back__btn">
    <a href="top">←戻る</a>
</div>

<p>時間割です。</p>

<div class="row classes-timetable">
    <div class="col-2 classes btn-group-vertical">
        @foreach($classes as $class)
        {{ Form::open(['url' => 'timetable/class_id=' .$class->id, 'method' => 'GET']) }}
        <button type="submit" class="classes-btn">{{ $class->name }}</button>
        {{ Form::close() }}
        @endforeach
    </div>
    <div class="col-10 timetable">
        @foreach($curriculums as $curriculum)
        <p>{{ $curriculum->title }}</p>
        @foreach($delivery_times as $delivery_time)
        <p>{{ $delivery_time->delivery_from }}</p>
        <p>{{ $delivery_time->delivery_to }}</p>
        @endforeach
        @endforeach
        <div class="thumbnail">
        </div>
    </div>
</div>
@endsection
