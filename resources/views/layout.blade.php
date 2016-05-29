<?php
use App\Core\Language\Language;

$languages = Language::all();
$cLngId = cLng('id');

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>{{$title.' - gph.am'}}</title>
    <link rel="shortcut icon" href="{{url('/favicon.ico')}}" type="image/x-icon" />
    <?php
    use App\Core\Helpers\UserAgent;

    $head->appendMainStyle('/css/main.css');
    $head->appendMainScript('/js/jquery-2.1.4.min.js');
    //$head->appendMainScript('/js/jssor.slider.mini.js');
    $head->appendMainScript('/js/main.js');

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
<body>
<script type="text/javascript">
    $main.baseUrl = '{{url('')}}';
</script>

<div id="page">

<div id="header">
    <div class="top">
        <div class="top-inner page">
            <ul class="social fl">
                <li class="facebook fl"><a href="{{trans('www.facebook.link')}}" class="db" target="_blank"></a></li>
                <li class="g-plus fl"><a href="{{trans('www.google_plus.link')}}" class="db" target="_blank"></a></li>
                <li class="youtube fl"><a href="{{trans('www.youtube.link')}}" class="db" target="_blank"></a></li>
                <li class="cb"></li>
            </ul>
            <div class="fr">
                <ul id="lng-switcher" class="fr">
                    @foreach($languages as $lng)
                        <li class="fl{{$lng->id == $cLngId ? ' active' : ''}}">
                            <a href="#" class="db">{{trans('www.language.'.$lng->code)}}</a>
                        </li>
                    @endforeach
                    <li class="cb"></li>
                </ul>
                <ul class="top-menu fr">
                    <li class="fr"><a href="#">Contact us</a></li>
                    <li class="fr"><a href="#">Subscribe</a></li>
                    <li class="cb"></li>
                </ul>
                <div class="cb"></div>
            </div>
            <div class="cb"></div>
        </div>
    </div>
    <div class="white page">
        <div class="header-overlay"></div>
        <div class="white-inner"></div>
    </div>
</div>

<div id="content">
@yield('content')
</div>

</div>
<div id="footer">
    <div id="footer-inner">

    </div>
</div>

</body>
</html>