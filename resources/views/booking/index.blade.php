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
        @for($i = 1; $i < 6; $i++)
            <div class="step-box fl tc{{$i == 1 ? ' first' : ''}}">
                <a href="" class="db">
                    <span class="db fl left">{{$i}}</span>
                    <span class="db right"><span>{{trans('www.booking.step.'.$i)}}</span></span>
                    <span class="fl"></span>
                </a>
            </div>
        @endfor
        <div class="cb"></div>
    </div>

    <div id="booking-1">
        <p class="tc">{{trans('www.booking.step1.text')}}</p>

        <form id="top-booking-form" action="" method="get">
            <input type="text" id="from" value="{{date('d/m/Y', strtotime($startDate))}}" placeholder="Arrival date" />
            <input type="hidden" id="from-hidden" name="start_date" value="{{date('Y-m-d', strtotime($startDate))}}" />
            <input type="text" id="to" value="{{date('d/m/Y', strtotime($endDate))}}" placeholder="Depart, date" />
            <input type="hidden" id="to-hidden" name="end_date" value="{{date('Y-m-d', strtotime($endDate))}}" />
            <input type="submit" class="tu" value="Find room" />
        </form>

    </div>

</div>

@stop