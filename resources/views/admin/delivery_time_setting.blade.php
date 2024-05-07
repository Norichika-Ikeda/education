@extends('admin.layouts.login_template')

@section('content')
<div class="back-btn">
    <a href="{{ route('curriculum_management', ['id' => '1']) }}">←戻る</a>
</div>

<h2>配信日時設定</h2>
<div class="curriculum-title">
    <h3>{{ $curriculum_title->title }}</h3>
</div>
{{ Form::open(['route' => 'delivery_time_edit']) }}
@csrf
<div class="curriculum-id">
    <input type="hidden" name="curriculum_id" value="{{ $curriculum_title->id }}">
</div>
<div class="delivery-time-setting" id="deliveryTimeSetting">
    @foreach($delivery_times as $delivery_time)
    <div class="delivery-time">
        <input type="hidden" name="delivery_time_id[]" class="delivery-time-id" value="{{ $delivery_time->id }}">
        <input type="date" name="date_from[]" class="date-from @error('date_from[]') is-invalid @enderror" value="{{ $delivery_time->delivery_from->format('Y-m-d') }}" placeholder=" ">
        @if($errors->has('date_from[]'))
        <p>{{ $errors->first('date_from[]') }}</p>
        @endif
        <input type="time" name="time_from[]" class="time-from @error('time_from[]') is-invalid @enderror" value="{{ $delivery_time->delivery_from->format('H:i') }}" placeholder=" ">
        @if($errors->has('time_from[]'))
        <p>{{ $errors->first('time_from[]') }}</p>
        @endif
        <p>～</p>
        <input type="date" name="date_to[]" class="date-to @error('date_to[]') is-invalid @enderror" value="{{ $delivery_time->delivery_to->format('Y-m-d') }}" placeholder=" ">
        @if($errors->has('date_to[]'))
        <p>{{ $errors->first('date_to[]') }}</p>
        @endif
        <input type="time" name="time_to[]" class="time-to @error('time_to[]') is-invalid @enderror" value="{{ $delivery_time->delivery_to->format('H:i') }}" placeholder=" ">
        @if($errors->has('time_to[]'))
        <p>{{ $errors->first('time_to[]') }}</p>
        @endif
        <div id="{{ $delivery_time->id }}" class="delete-delivery-time"></div>
    </div>
    @endforeach
</div>
<div id="addDeliveryTime" class="add-delivery-time"></div>

<button type="submit" name="delivery_time_edit">登録</button>

{{ Form::close() }}


@endsection
