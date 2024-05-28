@extends('admin.layouts.login_template')

@section('content')
<div class="back__btn">
    <a href="{{ route('curriculum_management', ['id' => '1']) }}">←戻る</a>
</div>

<h2>配信日時設定</h2>
<div class="curriculum-title my-4">
    <h3>{{ $curriculum_title->title }}</h3>
</div>
{{ Form::open(['route' => 'delivery_time_edit']) }}
@csrf
<div class="curriculum-id">
    <input type="hidden" name="curriculum_id" value="{{ $curriculum_title->id }}">
</div>
<div class="delivery-time__form" id="deliveryTimeSetting">
    @foreach($delivery_times as $delivery_time)
    <div class="delivery-time__form--date d-flex align-items-center">
        <input type="hidden" name="delivery_time_id[]" class="delivery-time-id" value="{{ $delivery_time->id }}">
        <input type="date" name="date_from[]" class="date-from is-blank @error('date_from[]') is-invalid @enderror" value="{{ $delivery_time->delivery_from->format('Y-m-d') }}" placeholder=" ">
        @if($errors->has('date_from[]'))
        <p>{{ $errors->first('date_from[]') }}</p>
        @endif
        <input type="time" name="time_from[]" class="time-from is-blank @error('time_from[]') is-invalid @enderror" value="{{ $delivery_time->delivery_from->format('H:i') }}" placeholder=" ">
        @if($errors->has('time_from[]'))
        <p>{{ $errors->first('time_from[]') }}</p>
        @endif
        <p>～</p>
        <input type="date" name="date_to[]" class="date-to is-blank @error('date_to[]') is-invalid @enderror" value="{{ $delivery_time->delivery_to->format('Y-m-d') }}" placeholder=" ">
        @if($errors->has('date_to[]'))
        <p>{{ $errors->first('date_to[]') }}</p>
        @endif
        <input type="time" name="time_to[]" class="time-to is-blank @error('time_to[]') is-invalid @enderror" value="{{ $delivery_time->delivery_to->format('H:i') }}" placeholder=" ">
        @if($errors->has('time_to[]'))
        <p>{{ $errors->first('time_to[]') }}</p>
        @endif
        <div id="{{ $delivery_time->id }}" class="delivery-time__form--delete ms-2"></div>
    </div>
    @endforeach
    <div id="addDeliveryTime" class="delivery-time__form--add m-4"></div>
    <div class="delivery-time__form--regist my-5 text-center">
        <button type="submit">登録</button>
    </div>
    {{ Form::close() }}
</div>

@endsection
