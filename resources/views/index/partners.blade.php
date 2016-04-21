<?php
$title = trans('www.menu.partners');
$page = 'partners';
?>
@extends('layout')
@section('content')

@include('index.slider')

<h1>{{trans('www.menu.partners')}}</h1>

<div class="text">{!!$text->text!!}</div>

<div id="partners">
    @foreach($partners as $key => $partner)
        <?php
        if (empty($partner->link)) {
            $tag = '<>';
            $href = '#';
        } else {
            $href = $partner->link;
        }
        ?>
        <div class="partner fl{{$key%3 == 0 ? ' mln' : ''}}">
            <?php
            if(empty($partner->link)) {
                $tag = '<span class="partner-box db">';
                $endTag = '</span>';
            } else {
                $tag = '<a href="'.$partner->link.'" class="partner-box db" target="_blank">';
                $endTag = '</a>';
            }
            ?>
            {!!$tag!!}
                <img src="{{$partner->getImage()}}" />
                <span class="overlay db">
                    <span class="info db">
                        <span class="title db">{{$partner->title}}</span>
                        <span class="sub-title db">{{$partner->sub_title}}</span>
                    </span>
                </span>
            {!!$endTag!!}
            </a>
        </div>
    @endforeach
    <div class="cb"></div>
</div>

@stop