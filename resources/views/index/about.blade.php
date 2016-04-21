<?php
$title = trans('www.menu.about');;
$page = 'about';
?>
@extends('layout')
@section('content')

    @include('index.slider')

    <h1>{{trans('www.menu.about')}}</h1>

    <div class="text">{!!$text->text!!}</div>

@stop