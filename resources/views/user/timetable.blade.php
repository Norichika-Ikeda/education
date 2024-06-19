@extends('user.layouts.login_template')

@section('content')
<div class="back__btn">
    <a href="{{ route('top') }}">←戻る</a>
</div>

<div class="timetable__top d-flex mx-5">
    <div class="timetable__top--change d-flex me-4">
        <div class="timetable__top--change--prev" id="prevMonthTimetable"></div>
        <h3 class="mx-2" data-date="{{ $today->format('n') }}">{{ $today->format('Y年n月') }}スケジュール</h3>
        <div class="timetable__top--change--next" id="nextMonthTimetable"></div>
    </div>
    <div class="timetable__top--grade">
        <p class="py-1" data-num="{{ $now_class->id }}">{{$now_class->name}}</p>
    </div>
</div>

<div class="timetable row">
    <div class="curriculum__class__btn col-2 d-flex flex-column align-items-center">
        @foreach($classes as $class)
        @if($now_class->id < $class->id)
            <button type="submit" class="classes-btn my-2 py-1" data-num="{{ $class->id }}" disabled>{{ $class->name }}</button>
            @else
            <button type="submit" class="classes-btn my-2 py-1" data-num="{{ $class->id }}">{{ $class->name }}</button>
            @endif
            @endforeach
    </div>
    <div class="curriculum__card  col-10">
        @foreach($curriculums as $curriculum)
        <div class="curriculum__card__item card p-4 m-2">
            @if($curriculum->thumbnail)
            <div class="curriculum__card__item--thumbnail">
                <img src="{{ asset('storage/' . $curriculum->thumbnail) }}" alt="">
            </div>
            @else
            <div class="curriculum__card__item--thumbnail"></div>
            @endif
            <a href="#">{{ $curriculum->title }}</a>
            <div class="delivery-time-area">
                @if($curriculum->alway_delivery_flg == 1)
                <p>常時公開</p>
                @else
                @foreach($delivery_times as $delivery_time)
                @if($curriculum->id == $delivery_time->curriculums_id)
                <ul class="delivery-time-list d-flex justify-content-between mb-1">
                    <li>{{ $delivery_time->delivery_from->format('n月j日') }}</li>
                    <li>
                        {{ $delivery_time->delivery_from->format('H:i') }}
                        ～
                        {{ $delivery_time->delivery_to->format('H:i') }}
                    </li>
                </ul>
                @endif
                @endforeach
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
