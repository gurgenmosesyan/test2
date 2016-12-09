<?php
use App\Image\Image;

$title = $accommodation->title;
$page = 'accommodation';
?>
@extends('layout')

@section('content')

<div class="page">
    <div id="page-title">
        <h1 class="title">{{trans('www.menu.accommodation')}}</h1>
    </div>
</div>

<div class="page">

    <div id="slider-block">
        <div id="slider" class="owl-carousel">
            @foreach($accommodation->images as $image)
                <div class="slider-item" style="background-image: url('{{$image->getImage()}}');"></div>
            @endforeach
        </div>
        <div class="slider-title title">{{$accommodation->title}}</div>
    </div>

    <div id="acc-content">
        <div class="html-content">{!!$accommodation->text!!}</div>
    </div>

    <div id="acc-info">
        <div class="acc-left fl">
            <ul class="acc-facilities fl">
                @foreach($facilities as $facility)
                    <li>{{$facility->title}}</li>
                @endforeach
            </ul>
            <ul class="acc-room fl">
                <li><span>{{trans('www.accommodation.room_size')}}</span> {{$accommodation->room_size}} {{trans('www.accommodation.room_size.measurement')}}</li>
                <li><span>{{trans('www.accommodation.bed_type')}}</span> {{$accommodation->bed_type}}</li>
            </ul>
            <div class="cb"></div>
        </div>
        <div class="acc-right fr">
            <div class="price">{!! trans('www.accommodation.price_text', ['price' => '<strong>'.$accommodation->price.'</strong>']) !!}</div>
            @if($accommodation->room_quantity > 0)
                <div class="booking-btn">
                    <form action="{{route('booking2', cLng('code'))}}" method="post">
                        <input type="hidden" name="room_id" value="{{$accommodation->id}}" />
                        <input type="hidden" name="start_date" value="{{date('Y-m-d', time()+86400)}}" />
                        <input type="hidden" name="end_date" value="{{date('Y-m-d', time()+172800)}}" />
                        {{csrf_field()}}
                        <input type="submit" class="dib tc tu" value="{{trans('www.accommodation.booking')}}" />
                    </form>
                </div>
            @endif
        </div>
        <div class="cb"></div>
    </div>

    @if(!$accommodations->isEmpty())
        <div id="acc-car-block">
            <div id="acc-car" class="owl-carousel tc">
                @foreach($accommodations as $accommodation)
                    <div class="acc-item dib" style="background-image: url('{{url(Image::show($accommodation->images[0]->image, 'accommodation.thumb'))}}');">
                        <a href="{{url_with_lng('/accommodations/'.$accommodation->id, false)}}" class="db">
                            <span class="acc-title dib">{{$accommodation->title}}</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</div>
<script type="text/javascript">
    $main.initSlider();
    $main.initAccCarousel();
</script>

@stop
