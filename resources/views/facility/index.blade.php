<?php
$title = $facility->title;
$page = 'facilities';

$desc = mb_substr(trim(strip_tags($facility->text)), 0, 300, 'utf-8');
$image = $facility->images->isEmpty() ? $background : $facility->images[0]->getImage();
$meta->title($title);
$meta->description($desc);
$meta->keywords(trans('www.homepage.keywords'));
$meta->ogTitle($title);
$meta->ogDescription($desc);
$meta->ogImage($image);
$meta->ogUrl(url_with_lng('/hotel-facilities/'.$facility->id, false));

?>
@extends('layout')

@section('content')

<div class="page">
    <div id="page-title">
        <h1 class="title">{{$title}}</h1>
    </div>
</div>

<div class="page">

    <div id="facility-text" class="html-content">{!!$facility->text!!}</div>

    <div id="slider-block" class="facility-slider">
        <div id="slider" class="owl-carousel">
            @foreach($facility->images as $image)
                <div class="slider-item" style="background-image: url('{{$image->getImage()}}');"></div>
            @endforeach
        </div>
    </div>

</div>
<script type="text/javascript">
    $main.initSlider();
</script>

@stop
