<?php
$head->appendScript('/admin/event/event.js');
$pageTitle = $pageSubTitle = trans('admin.event.form.title');
$pageMenu = 'event';
?>
@extends('core.layout')
@section('navButtons')
    <a href="{{route('admin_event_create')}}" class="btn btn-primary pull-right">{{trans('admin.base.label.add')}}</a>
@stop
@section('content')
<div class="box-body">
    <table id="data-table" class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>{{trans('admin.base.label.id')}}</th>
            <th>{{trans('admin.base.label.title')}}</th>
            <th>{{trans('admin.base.label.sort_order')}}</th>
            <th class="th-actions"></th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@stop