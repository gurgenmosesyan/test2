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
        @for($i = 2; $i < 6; $i++)
            <div class="step-box fl tc{{$i == 2 ? ' active' : ''}}">
                <span class="step-item db">
                    <span class="db fl left">{{$i}}</span>
                    <span class="db right"><span>{{trans('www.booking.step.'.$i)}}</span></span>
                    <span class="fl"></span>
                </span>
            </div>
        @endfor
        <div class="cb"></div>
    </div>

    <div id="booking-2">

        @if($accommodations->isEmpty())
            <p class="empty tc">{{trans('www.booking.empty_rooms')}}</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>{{trans('www.booking.room_type')}}</th>
                        <th class="price">{{trans('www.booking.room_price', ['interval' => $interval])}}</th>
                        <th class="quantity">{{trans('www.booking.room_quantity')}}</th>
                        <th class="rate">{{trans('www.booking.rate_amd')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accommodations as $acc)
                        <tr>
                            <td>
                                <p class="acc-title">{{$acc->title}}</p>
                                <a href="#" class="details dib">{{trans('www.booking.details')}}</a>
                            </td>
                            <td class="price tc" data-price="{{$acc->price}}">{{number_format($acc->price, 0, '.', '.')}}</td>
                            <td class="quantity tc">
                                <div class="select-box dib">
                                    <div class="select-arrow"></div>
                                    <div class="select-title"></div>
                                    <select>
                                        <option value="">{{trans('www.base.label.select')}}</option>
                                        @for($i = $acc->room_quantity; $i > 0; $i--)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </td>
                            <td class="rate tc">
                                <img src="{{url('/images/booking-rate.png')}}" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>

</div>

@stop