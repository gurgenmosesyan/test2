<?php
$title = trans('www.menu.partners');
$page = 'products';
?>
@extends('layout')
@section('content')
<script type="text/javascript">
    $main.token = '{{csrf_token()}}';
</script>

@include('index.slider')

<h1>{{trans('www.menu.products')}}</h1>

<div class="text">{!!$text->text!!}</div>

<div id="categories">
    <ul>
    @foreach($categories as $key => $value)<li>
            <a href="#" class="db {{$value->alias}}{{$value->id == $categoryId ? ' active' : ''}}" data-id="{{$value->id}}" data-alias="{{$value->alias}}">
                <img src="{{$value->getIcon()}}" align="{{$value->title}}" />
                <span class="title db">{{$value->title}}</span>
                @if($key > 0)
                    <span class="separator db"></span>
                @endif
            </a>
        </li>@endforeach
    </ul>
</div>

<div id="products">
    @foreach($products as $key => $value)
        <div class="product fl{{$key%3 == 0 ? ' mln' : ''}}">
            <img src="{{$value->getImage()}}" alt="{{$value->title}}" />
            <div class="product-title">
                <p>{{$value->title}}</p>
            </div>
        </div>
    @endforeach
    <div class="cb"></div>
</div>

@stop