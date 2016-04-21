<?php
$title = '404';
$page = null;
?>
@extends('layout')

@section('content')

<div id="separator"></div>

<div id="error">
    <h1>{{trans('www.404.title')}}</h1>
    <p class="text tc">{{trans('www.404.text')}}</p>
</div>

<script type="text/javascript">
    var height = $(window).height() - 405;
    $('#error').height(height);
</script>

@stop