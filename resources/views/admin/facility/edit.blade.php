<?php

$head->appendScript('/admin/facility/facility.js');
$pageTitle = trans('admin.facility.form.title');
$pageMenu = 'facility';
if ($saveMode == 'add') {
    $pageSubTitle = trans('admin.facility.form.add.sub_title');
    $url = route('admin_facility_store');
} else {
    $pageSubTitle = trans('admin.facility.form.edit.sub_title', ['id' => $facility->id]);
    $url = route('admin_facility_update', $facility->id);
}
$mls = $facility->ml->keyBy('lng_id');
?>
@extends('core.layout')
@section('content')
    <form id="edit-form" class="form-horizontal" method="post" action="{{$url}}">
        <div class="box-body">

            <div class="form-group">
                <label class="col-sm-3 control-label data-req">{{trans('admin.base.label.title')}}</label>
                <div class="col-sm-9">
                    @foreach($languages as $lng)
                        <div class="form-group form-group-inner">
                            <input type="text" name="ml[{{$lng->id}}][title]" class="form-control" value="{{isset($mls[$lng->id]) ? $mls[$lng->id]->title : ''}}" placeholder="{{$lng->name}}">
                            <div id="form-error-ml_{{$lng->id}}_title" class="form-error"></div>
                        </div>
                    @endforeach
                    <div id="form-error-ml" class="form-error"></div>
                </div>
            </div>

            {{csrf_field()}}
        </div>
        <div class="box-footer">
            <input type="submit" class="nav-btn nav-btn-save btn btn-primary" value="{{trans('admin.base.label.save')}}">
            <a href="{{route('admin_facility_table')}}" class="nav-btn nav-btn-cancel btn btn-default">{{trans('admin.base.label.cancel')}}</a>
        </div>
    </form>
@stop