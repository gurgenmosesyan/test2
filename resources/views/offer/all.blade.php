<?php
$title = trans('www.menu.special_offers');
$page = 'offers';
?>
@extends('layout')

@section('content')

<div class="page">
    <div id="page-title">
        <h1 class="title">{{$title}}</h1>
    </div>
</div>

<div class="page">

    <div id="first-text" class="html-content">{!!$offerText->text!!}</div>

    <div id="offers">
        @foreach($offers as $key => $offer)
            <div class="offer-item {{$key%2 == 0 ? 'odd' : 'even'}}">
                <h2 class="tu">{{$offer->title}}</h2>
                <div class="html-content">{!!$offer->text!!}</div>
            </div>
        @endforeach
    </div>

</div>

@stop
