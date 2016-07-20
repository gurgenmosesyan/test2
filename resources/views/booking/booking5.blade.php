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
                <a href="{{url_with_lng('/booking', false)}}" class="step-item db">
                    <span class="db fl left">1</span>
                    <span class="db right"><span>{{trans('www.booking.step.1')}}</span></span>
                    <span class="fl"></span>
                </a>
            </div>
            <div class="step-box fl tc">
                <a href="{{url_with_lng('/booking/rooms', false)}}" class="step-item db">
                    <span class="db fl left">2</span>
                    <span class="db right"><span>{{trans('www.booking.step.2')}}</span></span>
                    <span class="fl"></span>
                </a>
            </div>
            <div class="step-box fl tc">
                <a href="{{url_with_lng('/booking/info', false)}}" class="step-item db">
                    <span class="db fl left">3</span>
                    <span class="db right"><span>{{trans('www.booking.step.3')}}</span></span>
                    <span class="fl"></span>
                </a>
            </div>
            <div class="step-box fl tc">
                <a href="{{url_with_lng('/booking/payment', false)}}" class="step-item db">
                    <span class="db fl left">4</span>
                    <span class="db right"><span>{{trans('www.booking.step.4')}}</span></span>
                    <span class="fl"></span>
                </a>
            </div>
            <div class="step-box fl tc active">
                <span class="step-item db">
                    <span class="db fl left">5</span>
                    <span class="db right"><span>{{trans('www.booking.step.5')}}</span></span>
                    <span class="fl"></span>
                </span>
            </div>
            <div class="cb"></div>
        </div>

        <div id="booking-5">

            <h2 class="tc">{{trans('www.booking.payment.select_type')}}</h2>

            <div class="tc">
                <a href="#" class="btn">{{trans('www.booking.payment.ameria')}}</a>
                <a href="#" class="btn">{{trans('www.booking.payment.cash')}}</a>
            </div>

        </div>

    </div>

@stop