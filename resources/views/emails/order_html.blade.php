<?php

$cLngId = cLng('id');
$interval = (strtotime($endDate) - strtotime($startDate)) / 86400;

?><html>
<head>
    <title>Golden Palace Order</title>
</head>
<style>
    @font-face {
        font-family: 'ubuntu_light';
        src: url('/fonts/Ubuntu-Light.woff') format('woff');
        font-weight: normal;
        font-style: normal;
    }
    @font-face {
        font-family: 'arial_unicode';
        src: url('/fonts/ArialUnicode.woff') format('woff');
        font-weight: normal;
        font-style: normal;
    }
    body * {
        font-family: 'ubuntu_light', 'tahoma', 'arial', 'helvetica', sans-serif;
    }
    body.hy,
    body.hy * {
        font-family: 'arial_unicode', 'tahoma', 'arial', 'helvetica', sans-serif;
    }
    html, body {
        color: #686A6B;
        margin: 0;
        padding: 0;
    }
    body a {
        color: #686A6B;
    }
    body a:hover {
        text-decoration: none;
    }
</style>
<body class="{{cLng('code')}}">

<div style="color: #686A6B; max-width: 620px;">
    <div  style="padding: 40px 0;">
        <div style="float: left; width: 250px; text-align: center">
            <img src="{{url('/images/logo.png')}}" alt="logo" />
        </div>
        <div style="padding-left: 250px;">
            <p style="background: url('{{url('/images/address.png')}}') no-repeat 0 6px; margin: 0 0 8px; padding-left: 27px;">{!!trans('www.address.text')!!}</p>
            <div style="background: url('{{url('/images/phone.png')}}') no-repeat 0 6px; padding-left: 30px;">
                <p style="margin: 2px 0;">{{trans('www.phone1.text')}}</p>
                <p style="margin: 2px 0;">{{trans('www.phone2.text')}}</p>
            </div>
            <p style="background: url('{{url('/images/website.png')}}') no-repeat left center; margin: 0; padding-left: 30px; min-height: 27px; line-height: 27px;">
                <a href="{{url_with_lng('')}}">{{trans('www.website.text')}}</a>
            </p>
            <p style="background: url('{{url('/images/email.png')}}') no-repeat left center; margin: 0; padding-left: 30px;  min-height: 27px; line-height: 27px;">
                <a href="mailto:{{trans('www.email.text')}}">{{trans('www.email.text')}}</a>
            </p>
        </div>
        <div style="clear: both;"></div>
    </div>

    <div style="background: #DEDFE0; height: 9px;"></div>

    <div style="padding: 15px;">
        <h1 style="color: #D1AB66; text-align: center; text-transform: uppercase;">{{trans('www.email.confirmation_letter')}}</h1>

        <table>
            <tr>
                <td style="font-weight: bold; padding: 10px 0; font-size: 1.2em; text-align: right;">{{trans('www.order.email.guests_name')}}</td>
                <td style="padding: 10px 0 10px 15px; font-size: 1.2em;">
                    <?php
                    $names = '';
                    foreach($info['info'] as $value) {
                        $names .= $value['first_name'].' '.$value['last_name'].', ';
                    }
                    echo rtrim($names, ', ');
                    ?>
                </td>
            </tr>
            <tr>
                <td style="font-weight: bold; padding: 10px 0; font-size: 1.2em; text-align: right;">{{trans('www.order.email.checkin_date')}}</td>
                <td style="padding: 10px 0 10px 15px; font-size: 1.2em;">{{date('d/m/Y', strtotime($startDate)).' 14:00'}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold; padding: 10px 0; font-size: 1.2em; text-align: right;">{{trans('www.order.email.checkout_date')}}</td>
                <td style="padding: 10px 0 10px 15px; font-size: 1.2em;">{{date('d/m/Y', strtotime($endDate)).' 12:00'}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold; padding: 10px 0; font-size: 1.2em; text-align: right;">{{trans('www.order.email.number_nights')}}</td>
                <td style="padding: 10px 0 10px 15px; font-size: 1.2em;">{{$interval}}</td>
            </tr>
            @foreach($accommodations as $value)
                <tr>
                    <td style="font-weight: bold; padding: 10px 0; font-size: 1.2em; text-align: right;">{{trans('www.order.email.room_type')}}</td>
                    <td style="padding: 10px 0 10px 15px; font-size: 1.2em;">{{isset($value['ml'][$cLngId]) ? $value['ml'][$cLngId] : array_shift($value['ml'])}}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold; padding: 10px 0; font-size: 1.2em; text-align: right;">{{trans('www.order.email.room_quantity')}}</td>
                    <td style="padding: 10px 0 10px 15px; font-size: 1.2em;">{{$value['quantity']}}</td>
                </tr>
            @endforeach
            <tr>
                <td style="font-weight: bold; padding: 10px 0; font-size: 1.2em; text-align: right;">{{trans('www.order.email.amount')}}</td>
                <td style="padding: 10px 0 10px 15px; font-size: 1.2em;">{{$price}}</td>
            </tr>
            <tr>
                <td style="font-weight: bold; padding: 10px 0; font-size: 1.2em; text-align: right;">{{trans('www.order.email.payment_type')}}</td>
                <td style="padding: 10px 0 10px 15px; font-size: 1.2em;">{{$paymentType}}</td>
            </tr>
        </table>

    </div>

    <div style="background: #B9985B; height: 9px; margin-top: 20px;"></div>

    <div style="background: #D2AB67; color: #ffffff; padding: 22px 0 7px; text-align: center;">
        <div>
            <a href="{{trans('www.social.facebook.link')}}" style="display: inline-block; margin: 0 12px;">
                <img src="{{url('/images/e-fb.png')}}" />
            </a>
            <a href="{{trans('www.social.google_plus.link')}}" style="display: inline-block; margin: 0 12px;">
                <img src="{{url('/images/e-google.png')}}" />
            </a>
            <a href="{{trans('www.social.youtube.link')}}" style="display: inline-block; margin: 0 12px;">
                <img src="{{url('/images/e-youtube.png')}}" />
            </a>
            <a href="{{trans('www.social.twitter.link')}}" style="display: inline-block; margin: 0 12px;">
                <img src="{{url('/images/e-twitter.png')}}" />
            </a>
            <a href="{{trans('www.social.linkedin.link')}}" style="display: inline-block; margin: 0 12px;">
                <img src="{{url('/images/e-linkedin.png')}}" />
            </a>
            <a href="{{trans('www.social.instagram.link')}}" style="display: inline-block; margin: 0 12px;">
                <img src="{{url('/images/e-instagram.png')}}" />
            </a>
            <a href="{{trans('www.social.viber.link')}}" style="display: inline-block; margin: 0 12px;">
                <img src="{{url('/images/e-viber.png')}}" />
            </a>
            <a href="{{trans('www.social.skype.link')}}" style="display: inline-block; margin: 0 12px;">
                <img src="{{url('/images/e-skype.png')}}" />
            </a>
        </div>
        <p style="font-size: 0.9em;">{{trans('www.copyright.text')}}</p>
    </div>
</div>
</body>
</html>