<?php

$head->appendScript('/assets/plugins/ckeditor/ckeditor.js');
$head->appendScript('/admin/facility/text.js');
$pageTitle = $pageSubTitle = trans('admin.facility_text.form.title');
$pageMenu = 'facility_text';
?>
@extends('core.layout')
@section('content')
    <form id="edit-form" class="form-horizontal" method="post" action="{{route('admin_facility_text_update')}}">
        <div class="box-body">

            @foreach($languages as $lng)
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{trans('admin.base.label.text')}} ({{$lng->code}})</label>
                    <div class="col-sm-9">
                        <textarea name="ml[{{$lng->id}}][text]" class="form-control ckeditor">{{isset($text[$lng->id]) ? $text[$lng->id]->text : ''}}</textarea>
                        <div id="form-error-ml_{{$lng->id}}_text" class="form-error"></div>
                    </div>
                </div>
            @endforeach

            {{csrf_field()}}
        </div>
        <div class="box-footer">
            <input type="submit" class="nav-btn nav-btn-save btn btn-primary" value="{{trans('admin.base.label.save')}}">
        </div>
    </form>
@stop