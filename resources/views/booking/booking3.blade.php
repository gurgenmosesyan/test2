<?php
$title = trans('www.booking.head_title');
$page = null;
$bookingPage = true;
?>
@extends('layout')

@section('content')

<div class="page">
    <div id="page-title">
        <h1 class="title">{{$title}}</h1>
    </div>
</div>

<div class="page">
    <div id="booking-steps">
        <div class="step-box fl tc first">
            <a href="{{url_with_lng('/booking?start_date='.$startDate.'&end_date='.$endDate, false)}}" class="step-item db">
                <span class="db fl left">1</span>
                <span class="db right"><span>{{trans('www.booking.step.1')}}</span></span>
                <span class="fl"></span>
            </a>
        </div>
        <div class="step-box fl tc">
            <a href="{{url_with_lng('/booking/rooms?start_date='.$startDate.'&end_date='.$endDate, false)}}" class="step-item db">
                <span class="db fl left">2</span>
                <span class="db right"><span>{{trans('www.booking.step.2')}}</span></span>
                <span class="fl"></span>
            </a>
        </div>
        @for($i = 3; $i < 6; $i++)
            <div class="step-box fl tc{{$i == 3 ? ' active' : ''}}">
                <span class="step-item db">
                    <span class="db fl left">{{$i}}</span>
                    <span class="db right"><span>{{trans('www.booking.step.'.$i)}}</span></span>
                    <span class="fl"></span>
                </span>
            </div>
        @endfor
        <div class="cb"></div>
    </div>

    <div id="booking-3">
        <form action="{{url_with_lng('/api/booking/info', false)}}" method="post">
            @foreach($accommodations as $acc)
                <h2>{{$acc->title}}</h2>
                <div class="col left fl"><label class="required">{{trans('www.booking.guests_name')}}</label></div>
                <div class="col middle fl">
                    <div class="form-box">
                        <input type="text" name="first_name" placeholder="{{trans('www.booking.first_name')}}" />
                    </div>
                </div>
                <div class="col right fl">
                    <div class="form-box">
                        <input type="text" name="last_name" placeholder="{{trans('www.booking.last_name')}}" />
                    </div>
                </div>
                <div class="cb"></div>
                <div class="col left fl"><label class="required">{{trans('www.booking.citizenship')}}</label></div>
                <div class="col middle fl">
                    <div class="select-box">
                        <div class="select-arrow"></div>
                        <div class="select-title"></div>
                        <select name="citizenship">
                            <option value="">{{trans('www.base.label.select')}}</option>
                            <option value="a">asdasd</option>
                            <option value="2">{{trans('www.base.label.select')}}</option>
                            <option value="f">{{trans('www.base.label.select')}}</option>
                        </select>
                    </div>
                </div>
                <div class="cb"></div>
                <div class="separator"></div>
            @endforeach
        </form>
    </div>

</div>

@stop