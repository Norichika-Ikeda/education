@extends('admin.layouts.login_template')

@section('content')
<div class="back__btn">
    <a href="{{ route('admin_top') }}">←戻る</a>
</div>

<h2>授業一覧</h2>
<div class="curriculum">
    <div class="curriculum__top mt-1 mb-5 row">
        <div class="curriculum__top__btn--regist col-2">
            <button type="submit" class="py-2 px-4" onclick="location.href=`{{ route('curriculum_create_form') }}`">新規登録</button>
        </div>
        <div class="curriculum__top__btn--grade col-10">
            <p class="py-1" data-num="{{ $now_class->id }}">{{$now_class->name}}</p>
        </div>
    </div>


    <div class="curriculum__class row">
        <div class="curriculum__class__btn col-2 btn-group-vertical justify-content-start">
            @foreach($classes as $class)
            {{ Form::open(['url' => 'admin/curriculum_management/' .$class->id, 'method' => 'GET']) }}
            <button type="submit" class="classes-btn my-2 py-1" data-num="{{ $class->id }}">{{ $class->name }}</button>
            {{ Form::close() }}
            @endforeach
        </div>
        <div class="curriculum__card  col-10">
            @foreach($curriculums as $curriculum)
            <div class="curriculum__card__item card p-4 m-2">
                <div class="curriculum__card__item--thumbnail">
                    <img src="{{ asset('storage/' . $curriculum->thumbnail) }}" alt="">
                </div>
                <p>{{ $curriculum->title }}</p>
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
                            </;>
                    </ul>
                    @endif
                    @endforeach
                    @endif
                </div>
                <div class="curriculum__card__item--edit d-flex justify-content-between">
                    {{ Form::open(['url' => 'admin/curriculum_edit/' .$curriculum->id, 'method' => 'GET']) }}
                    <button type="submit" class="curriculum-edit">授業内容編集</button>
                    {{ Form::close() }}
                    {{ Form::open(['url' => 'admin/delivery_time_setting/' .$curriculum->id, 'method' => 'GET']) }}
                    <button type="submit" class="delivery-time-edit">配信日時編集</button>
                    {{ Form::close() }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
