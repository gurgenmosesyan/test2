<?php
use App\Core\Language\Language;

$languages = Language::all();
$cLngId = cLng('id');

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>{{$title.' - gph.am'}}</title>
    <link rel="shortcut icon" href="{{url('/favicon.ico')}}" type="image/x-icon" />
    <?php
    use App\Core\Helpers\UserAgent;

    $head->appendMainStyle('/css/jquery-ui.css');
    $head->appendMainStyle('/css/main.css');
    $head->appendMainStyle('/css/media.css');
    $head->appendMainStyle('/css/owl.carousel.css');

    $head->appendMainScript('/js/jquery-2.1.4.min.js');
    $head->appendMainScript('/js/jquery-ui.min.js');
    $head->appendMainScript('/js/owl.carousel.min.js');
    //$head->appendMainScript('/js/jssor.slider.mini.js');
    $head->appendMainScript('/js/main.js');
    $head->appendMainScript('/js/mobile.js');

    $ua = new UserAgent();
    if ($ua->isIPhone() || $ua->isAndroidMobile() || $ua->isWinPhone()) {
        echo '<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1.0" />';
        $head->appendMainStyle('/css/mobile.css');
        $head->appendMainScript('/js/mobile.js');
        $jsTrans->addTrans([
            'www.menu.about',
            'www.menu.products',
            'www.menu.partners',
            'www.menu.contact'
        ]);
        echo '<script>var $locSettings = {"trans":'.json_encode($jsTrans->getTrans()).'};</script>';
    }

    $head->renderStyles();
    $head->renderScripts();
    ?>
</head>
<body class="{{cLng('code')}}">
<script type="text/javascript">
    $main.baseUrl = '{{url('')}}';
    $main.time = <?php echo time(); ?>;
</script>

<div id="page">

<div id="header">
    <div class="top">
        <div class="page">
            <div class="top-inner">
                <ul class="social fl">
                    <li class="facebook fl"><a href="{{trans('www.social.facebook.link')}}" class="db" target="_blank"></a></li>
                    <li class="g-plus fl"><a href="{{trans('www.social.google_plus.link')}}" class="db" target="_blank"></a></li>
                    <li class="youtube fl"><a href="{{trans('www.social.youtube.link')}}" class="db" target="_blank"></a></li>
                    <li class="twitter fl"><a href="{{trans('www.social.twitter.link')}}" class="db" target="_blank"></a></li>
                    <li class="linkedin fl"><a href="{{trans('www.social.linkedin.link')}}" class="db" target="_blank"></a></li>
                    <li class="instagram fl"><a href="{{trans('www.social.instagram.link')}}" class="db" target="_blank"></a></li>
                    <li class="viber fl"><a href="{{trans('www.social.viber.link')}}" class="db" target="_blank"></a></li>
                    <li class="skype last fl"><a href="{{trans('www.social.skype.link')}}" class="db" target="_blank"></a></li>
                    <li class="cb"></li>
                </ul>
                <div class="fr">
                    <ul id="lng-switcher" class="fr">
                        @foreach($languages as $lng)
                            <li class="fl{{$lng->id == $cLngId ? ' active' : ''}}">
                                <a href="{{url($lng->code)}}" class="ubuntu db">{{trans('www.language.'.$lng->code)}}</a>
                            </li>
                        @endforeach
                        <li class="cb"></li>
                    </ul>
                    <ul class="top-menu fr">
                        <li class="fr"><a href="{{url_with_lng('#contacts', false)}}" id="contact-link">{{trans('www.top_menu.contact_us')}}</a></li>
                        <li class="subscribe mln fr"><a href="#">{{trans('www.top_menu.subscribe')}}</a></li>
                        <li class="subscribe-box mln dpn fr">
                            <form id="subscribe-form" action="{{url_with_lng('/api/subscribe', false)}}" method="post">
                                <input type="text" name="email" value="" placeholder="{{trans('www.subscribe.placeholder')}}" /><input type="submit" value="" />
                                {{csrf_field()}}
                            </form>
                        </li>
                        <li class="cb"></li>
                    </ul>
                    <div class="cb"></div>
                </div>
                <div class="cb"></div>
            </div>
        </div>
    </div>
    <div class="page">
        <div class="white">
            <div class="header-overlay"></div>
            <div class="white-inner">
                <div id="header-left" class="fl">
                    <div id="logo">
                        <a href="{{url_with_lng('')}}" class="db"></a>
                    </div>
                </div>
                <div id="header-right" class="fr-">
                    <form id="search-form" action="{{url_with_lng('search', false)}}" method="get" class="dib">
                        <input type="text" name="q" /><input type="submit" value="" />
                    </form>
                    <ul id="nav">
                        <li class="first{{$page == 'about' ? ' active' : ''}}">
                            <a href="{{url_with_lng('/about', false)}}">{{trans('www.menu.about')}}</a>
                        </li><li{{$page == 'accommodation' ? ' class=active' : ''}}>
                            <a href="#">{{trans('www.menu.accommodation')}}</a>
                        </li><li{{$page == 'offer' ? ' class=active' : ''}}>
                            <a href="{{url_with_lng('/special-offers', false)}}">{{trans('www.menu.special_offers')}}</a>
                        </li><li>
                            <a href="#">{{trans('www.menu.hotel_facilities')}}</a>
                        </li><li>
                            <a href="#">{{trans('www.menu.meeting_events')}}</a>
                        </li>
                    </ul>
                </div>
                <div class="cb"></div>
            </div>
        </div>
    </div>
</div>

<div id="bg-block" style="background-image: url('/images/temp/bg.jpg');">
    <div class="page">
        <div id="calendar-block">
            <div class="calendar-overlay"></div>
            <div id="weather-block">
                <div class="weather fl">
                    <p class="tc">weather in Armenia</p>
                    <h4 class="tc">3<span>º</span>C</h4>
                </div>
                <div id="clock" class="fl">
                    <div id="hour"></div>
                    <div id="minute"></div>
                </div>
                <div class="currency fl">
                    <p class="tc">currency<br />exchange rates</p>
                </div>
                <div class="cb"></div>
            </div>
            <div id="top-calendar">
                <h3 class="tc">Online Rooms Booking</h3>
                <p class="tc">Get your guaranteed reservation right now!</p>
                <div class="calendar-separator"></div>
                <form id="top-booking-form" action="" method="get">
                    <input type="text" id="from" value="{{date('d/m/Y', time()+86400)}}" placeholder="Arrival date" />
                    <input type="hidden" id="from-hidden" name="start_date" value="{{date('Y-m-d', time()+86400)}}" />
                    <input type="text" id="to" value="{{date('d/m/Y', time()+172800)}}" placeholder="Depart, date" />
                    <input type="hidden" id="to-hidden" name="end_date" value="{{date('Y-m-d', time()+172800)}}" />
                    <input type="submit" class="tu" value="Find room" />
                </form>
            </div>
        </div>

        @if(isset($isHomepage))
            <h1 class="main-title tu">{{trans('www.homepage.main_title')}}</h1>
        @endif

    </div>
</div>

<div id="content">
@yield('content')
</div>

</div>
<div id="footer">
    <div class="page">
        <div class="footer-part address fl">
            <p class="dib">{!!trans('www.address.text')!!}</p>
        </div>
        <div class="footer-part phone fl tc">
            <div class="dib">
                <p>{{trans('www.phone1.text')}}</p>
                <p>{{trans('www.phone2.text')}}</p>
            </div>
        </div>
        <div class="footer-part info fr">
            <div class="dib fr">
                <p class="website">{{trans('www.website.text')}}</p>
                <p class="email"><a href="mailto:{{trans('www.email.text')}}">{{trans('www.email.text')}}</a></p>
            </div>
            <div class="cb"></div>
        </div>
        <div class="cb"></div>
        <div class="copyright tc">{{trans('www.copyright.text')}}</div>
    </div>
</div>

</body>
</html>