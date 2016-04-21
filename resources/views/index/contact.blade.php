<?php
$title = trans('www.menu.contact');
$page = 'contact';
?>
@extends('layout')

@section('content')
<script type="text/javascript">
    $main.contactPage = true;
</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3"></script>
<div id="contact">

    <div id="separator"></div>

    <h1>{{trans('www.menu.contact')}}</h1>

    <div class="text">{!!$text->text!!}</div>

    <div class="contact-box left fl">
        <form id="contact-form" action="{{url('/api/contact')}}" method="post">
            <div class="form-group">
                <input type="text" name="name" placeholder="{{trans('www.placeholder.name')}}" />
                <div id="form-error-name" class="form-error"></div>
            </div>
            <div class="form-group">
                <input type="text" name="email" placeholder="{{trans('www.placeholder.email')}}" />
                <div id="form-error-email" class="form-error"></div>
            </div>
            <div class="form-group">
                <input type="text" name="subject" placeholder="{{trans('www.placeholder.subject')}}" />
                <div id="form-error-subject" class="form-error"></div>
            </div>
            <div class="form-group">
                <textarea name="message" placeholder="{{trans('www.placeholder.message')}}"></textarea>
                <div id="form-error-message" class="form-error"></div>
            </div>
            {{csrf_field()}}
            <div class="form-submit">
                <input type="submit" value="{{trans('www.contact.submit_btn')}}" />
            </div>
        </form>
    </div>

    <div class="contact-box fl">
        <div id="map"></div>
    </div>
    <div class="cb"></div>

</div>

@stop