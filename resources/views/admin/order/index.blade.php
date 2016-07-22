<?php
$head->appendScript('/admin/order/order.js');
$pageTitle = $pageSubTitle = trans('admin.order.form.title');
$pageMenu = 'order';
?>
@extends('core.layout')
@section('navButtons')
    <a href="{{route('admin_order_create')}}" class="btn btn-primary pull-right">{{trans('admin.base.label.add')}}</a>
@stop
@section('content')
<div class="box-body">
    <table id="data-table" class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>{{trans('admin.base.label.id')}}</th>
            <th>{{trans('admin.order.label.accommodations')}}</th>
            <th>{{trans('admin.base.label.price')}}</th>
            <th>{{trans('admin.base.label.date_from')}}</th>
            <th>{{trans('admin.base.label.date_to')}}</th>
            <th>{{trans('admin.base.label.guest')}}</th>
            <th>{{trans('admin.base.label.phone')}}</th>
            <th>{{trans('admin.base.label.email')}}</th>
            <th class="th-actions"></th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<style>
    #data-table hr {
        margin: 5px 0;
    }
</style>
@stop