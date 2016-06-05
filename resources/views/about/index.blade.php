<?php
$title = trans('www.menu.about');
$page = 'about';
?>
@extends('layout')

@section('content')

<div class="page">
    <div id="page-title">
        <h1 class="title">{{$title}}</h1>
    </div>
</div>

<div class="page">

    <div id="about-content">
        <div class="html-content">{!!$about->text!!}</div>
    </div>

    @if(!$guests->isEmpty())
        <div id="guests-block">
            <h2 class="tu">{{trans('www.vip_guests.title')}}</h2>

            <div id="guests">
                <div id="guests-car" class="owl-carousel tc">
                    @foreach($guests as $guest)
                        <div class="guest-item dib">
                            <div class="guest-img" style="background-image: url('{{$guest->getImage()}}');"></div>
                            <p class="guest-title">{{$guest->name}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    @if(!$partners->isEmpty())
        <div id="partners">
            <h2 class="tu">{{trans('www.partners.title')}}</h2>
            <div class="tc">
                @foreach($partners as $partner)<div class="partner-item dib">
                    @if(empty($partner->link))
                        <img src="{{$partner->getImage()}}" alt="partner" />
                    @else
                        <a href="{{$partner->link}}" target="_blank">
                            <img src="{{$partner->getImage()}}" alt="partner" />
                        </a>
                    @endif
                </div>@endforeach
            </div>
        </div>
    @endif

    @if(!$vacancies->isEmpty())
        <div id="vacancies">
            <h2 class="tu"><a href="{{url_with_lng('/vacancies', false)}}">{{trans('www.vacancies.title')}}</a></h2>

            <table>
                <thead>
                    <tr>
                        <th>{{trans('www.vacancies.list.title')}}</th>
                        <th>{{trans('www.vacancies.list.function')}}</th>
                        <th class="last">{{trans('www.vacancies.list.published_on')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vacancies as $vacancy)
                        <tr>
                            <td>{{$vacancy->title}}</td>
                            <td>{{$vacancy->function}}</td>
                            <td class="published last">
                                <div class="date fl">{{date('d.m.Y', strtotime($vacancy->published_at))}}</div>
                                <div class="more fr">
                                    <a href="{{url_with_lng('/vacancies/'.$vacancy->id, false)}}" class="db">{{trans('www.vacancies.list.read_more')}}</a>
                                </div>
                                <div class="cb"></div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <?php /* <div class="vacancy-title fl">
                <div class="vacancy-item first">{{trans('www.vacancies.list.title')}}</div>
                @foreach($vacancies as $vacancy)
                    <div class="vacancy-item">{{$vacancy->title}}</div>
                @endforeach
            </div>
            <div class="vacancy-function fl">
                <div class="vacancy-item first">{{trans('www.vacancies.list.function')}}</div>
                @foreach($vacancies as $vacancy)
                    <div class="vacancy-item">{{$vacancy->function}}</div>
                @endforeach
            </div>
            <div class="vacancy-published  fl">
                <div class="vacancy-item first">{{trans('www.vacancies.list.published_on')}}</div>
                @foreach($vacancies as $vacancy)
                    <div class="vacancy-item">{{date('d.m.Y', strtotime($vacancy->published_at))}}</div>
                @endforeach
            </div>
            <div class="cb"></div> */ ?>

        </div>
    @endif

</div>
<script type="text/javascript">
    $main.initGuests();
</script>

@stop
