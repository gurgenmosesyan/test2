<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>{{$title.' - leading-supply.com'}}</title>
    <link rel="shortcut icon" href="{{url('/favicon.ico')}}" type="image/x-icon" />
    <?php
    use App\Core\Helpers\UserAgent;

    $head->appendMainStyle('/css/main.css');
    $head->appendMainScript('/js/jquery-2.1.4.min.js');
    $head->appendMainScript('/js/jssor.slider.mini.js');
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
    <ul class="nav-left fl">
        <li class="fl{{$page == 'about' ? ' active' : ''}}">
            <a href="{{url('/')}}">{{trans('www.menu.about')}}</a>
        </li>
        <li class="fl{{$page == 'products' ? ' active' : ''}}">
            <a href="{{url('/products')}}">{{trans('www.menu.products')}}</a>
        </li>
        <li class="cb"></li>
    </ul>
    <div class="logo fl">
        <a href="{{url('/')}}" class="db"></a>
    </div>
    <ul class="nav-right fl">
        <li class="fr{{$page == 'contact' ? ' active' : ''}}">
            <a href="{{url('/contact')}}">{{trans('www.menu.contact')}}</a>
        </li>
        <li class="fr{{$page == 'partners' ? ' active' : ''}}">
            <a href="{{url('/partners')}}">{{trans('www.menu.partners')}}</a>
        </li>
        <li class="cb"></li>
    </ul>
    <div class="cb"></div>
</div>

<div id="content">
@yield('content')
</div>

</div>
<div id="footer">
    <div id="footer-inner">
        <div id="subscribe" class="fl"></div>
        <div id="footer-main" class="fl">
            <ul class="nav-footer">
                <li><a href="{{url('/')}}">{{trans('www.menu.about')}}</a></li>
                <li><a href="{{url('/products')}}">{{trans('www.menu.products')}}</a></li>
                <li><a href="{{url('/partners')}}">{{trans('www.menu.partners')}}</a></li>
                <li><a href="{{url('/contact')}}">{{trans('www.menu.contact')}}</a></li>
            </ul>
            <p class="copyright">{{trans('www.copyright.text')}}</p>
        </div>
        <div id="social" class="fl">
            <ul>
                <li class="fb fl mln"><a href="{{trans('www.social.fb.link')}}" target="_blank"></a></li>
                <li class="twitter fl"><a href="{{trans('www.social.twitter.link')}}" target="_blank"></a></li>
                <li class="instagram fl"><a href="{{trans('www.social.instagram.link')}}" target="_blank"></a></li>
                <li class="google fl"><a href="{{trans('www.social.google.link')}}" target="_blank"></a></li>
                <li class="pinterest fl"><a href="{{trans('www.social.pinterest.link')}}" target="_blank"></a></li>
                <li class="cb"></li>
            </ul>
        </div>
        <div class="cb"></div>
    </div>
</div>

</body>
</html>