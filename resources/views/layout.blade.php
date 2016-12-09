<?php
use App\Core\Language\Language;
use App\Models\Accommodation\Accommodation;

$languages = Language::all();
$cLng = cLng();
$accommodations = Accommodation::joinMl()->ordered()->get();

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
    $head->appendMainStyle('/css/owl.carousel.css');
    $head->appendMainStyle('/css/main.css');
    $head->appendMainStyle('/css/media.css');

    $head->appendMainScript('/js/jquery-2.1.4.min.js');
    $head->appendMainScript('/js/jquery-ui.min.js');
    $head->appendMainScript('/js/owl.carousel.min.js');
    $head->appendMainScript('/js/main.js');

    $ua = new UserAgent();
    if ($ua->isIPhone() || $ua->isAndroidMobile() || $ua->isWinPhone()) {
        $head->appendMainStyle('/css/mobile.css');
        $head->appendMainScript('/js/mobile.js');
        $jsTrans->addTrans([
            'www.mobile.book_now',
        ]);
    }

    $head->renderStyles();
    $head->renderScripts();
    ?>
</head>
<body class="{{$cLng->code}}">
<script type="text/javascript">
    $main.baseUrl = '{{url('')}}';
    $main.time = <?php echo time(); ?>;
    var $locSettings = {"trans": <?php echo json_encode($jsTrans->getTrans()); ?>};
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
                    <?php /*<li class="viber fl"><a href="{{trans('www.social.viber.link')}}" class="db" target="_blank"></a></li>
                    <li class="skype last fl"><a href="{{trans('www.social.skype.link')}}" class="db" target="_blank"></a></li>*/ ?>
                    <li class="cb"></li>
                </ul>
                <div class="fr">
                    <ul id="lng-switcher" class="fr">
                        @foreach($languages as $lng)
                            <li class="fl{{$lng->id == $cLng->id ? ' active' : ''}}">
                                <a href="{{route('language', ['code' => $lng->code])}}" class="ubuntu db">{{trans('www.language.'.$lng->code)}}</a>
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
                <div id="header-right">
                    <?php /*<form id="search-form" action="{{url_with_lng('search', false)}}" method="get" class="dib">
                        <input type="text" name="q" /><input type="submit" value="" />
                    </form>*/ ?>
                    <h2 class="title top-title dib tc">{{trans('www.page.top_title')}}</h2>

                    <ul id="nav">
                        <li class="first{{$page == 'about' ? ' active' : ''}}">
                            <a href="{{url_with_lng('/about', false)}}">{{trans('www.menu.about')}}</a>
                        </li><li id="acc-top-menu"{{$page == 'accommodation' ? ' class=active' : ''}}>
                            <a href="#" class="acc-link">{{trans('www.menu.accommodation')}}</a>
                            <ul id="acc-sub-menu" class="dpn">
                                @foreach($accommodations as $acc)
                                    <li><a href="{{url_with_lng('/accommodations/'.$acc->id, false)}}">{{$acc->title}}</a></li>
                                @endforeach
                            </ul>
                        </li><li{{$page == 'offers' ? ' class=active' : ''}}>
                            <a href="{{url_with_lng('/special-offers', false)}}">{{trans('www.menu.special_offers')}}</a>
                        </li><li{{$page == 'facilities' ? ' class=active' : ''}}>
                            <a href="{{url_with_lng('/hotel-facilities', false)}}">{{trans('www.menu.hotel_facilities')}}</a>
                        </li><li{{$page == 'events' ? ' class=active' : ''}}>
                            <a href="{{url_with_lng('/meeting-and-events', false)}}">{{trans('www.menu.meeting_events')}}</a>
                        </li>
                    </ul>
                </div>
                <div class="cb"></div>
            </div>
        </div>
    </div>
</div>

<div id="bg-block"<?php echo isset($background) ? ' style="background-image: url(\''.$background.'\');"' : ''; ?>>
    <div class="page">
        @if(!isset($bookingPage))
            <div id="calendar-block">
                <div class="calendar-overlay"></div>
                <div id="weather-block">
                    <div class="weather fl">
                        <?php /*<p class="tc">weather in Armenia</p>
                        <h4 class="tc">3<span>º</span>C</h4>*/ ?>
                    </div>
                    <div id="clock" class="fl">
                        <div id="hour"></div>
                        <div id="minute"></div>
                    </div>
                    <div class="currency fl">
                        <p class="tc">
                            <a href="http://rates.am/en/armenian-dram-exchange-rates/banks/non-cash" target="_blank">
                                currency<br />exchange rates
                            </a>
                        </p>
                    </div>
                    <div class="cb"></div>
                </div>
                <div id="top-calendar">
                    <h3 class="tc">{{trans('www.top_booking.title')}}</h3>
                    <p class="tc">{{trans('www.top_booking.sub_title')}}</p>
                    <div class="calendar-separator"></div>
                    <form id="top-booking-form" action="{{route('booking2', $cLng->code)}}" method="post">
                        <input type="text" id="from" value="{{date('d/m/Y', time()+86400)}}" data-min-date="{{date('d/m/Y', time()+86400)}}" placeholder="{{trans('www.booking.arrival_date')}}" />
                        <input type="hidden" id="from-hidden" name="start_date" value="{{date('Y-m-d', time()+86400)}}" />
                        <input type="text" id="to" value="{{date('d/m/Y', time()+172800)}}" placeholder="{{trans('www.booking.depart_date')}}" />
                        <input type="hidden" id="to-hidden" name="end_date" value="{{date('Y-m-d', time()+172800)}}" />
                        <input type="hidden" name="room_id" value="" />
                        {{csrf_field()}}
                        <input type="submit" class="tu" value="{{trans('www.top_booking.find_room')}}" />
                    </form>
                </div>
            </div>
        @endif

        @if(isset($isHomepage))
            <h1 class="main-title tu">{{trans('www.homepage.main_title')}}</h1>
        @endif

        @if(isset($errorPage))
            <div class="error-section tc fb">
                <h2>{{trans('www.404.title')}}</h2>
                <p>{{trans('www.404.text')}}</p>
            </div>
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

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-59511131-1', 'auto');
    ga('send', 'pageview');

</script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter34114790 = new Ya.Metrika({
                    id:34114790,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/34114790" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

</body>
</html>