<?php
use App\Models\Order\Order;
use App\Core\Helpers\Calendar;

Calendar::includeHeadData();

$head->appendScript('/admin/order/order.js');
$pageTitle = $pageSubTitle = trans('admin.order.form.title');
$pageMenu = 'order';
?>
@extends('core.layout')
@section('navButtons')

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
            <th>{{trans('admin.base.label.type')}}</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>

    <div id="filters">
        <div id="search-box" class="col-sm-12">
            <form id="search-form" class="form-horizontal">
                <table class="table-condensed">
                    <tr>
                        <td align="right"><label>{{trans('admin.base.label.accommodation')}}</label></td>
                        <td>
                            <select name="accommodation_id" class="form-control acc-id">
                                <option value="">{{trans('admin.base.label.select')}}</option>
                                @foreach($accommodations as $accommodation)
                                    <option value="{{$accommodation->id}}">{{$accommodation->title}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td align="right"><label>{{trans('admin.base.label.type')}}</label></td>
                        <td>
                            <select name="type" class="form-control type">
                                <option value="">{{trans('admin.base.label.select')}}</option>
                                <option value="{{Order::TYPE_CASH}}">{{trans('admin.base.label.cash')}}</option>
                                <option value="{{Order::TYPE_AMERIA}}">{{trans('admin.base.label.ameria')}}</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><label>{{trans('admin.base.label.date_from')}}</label></td>
                        <td>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" class="form-control pull-right date" value="">
                                <input type="hidden" name="from_date_from" class="from-date-from" value="" />
                            </div>
                        </td>
                        <td class="text-center"><i class="fa fa-arrow-right"></i></td>
                        <td>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" class="form-control pull-right date" value="">
                                <input type="hidden" name="to_date_from" class="to-date-from" value="" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><label>{{trans('admin.base.label.date_to')}}</label></td>
                        <td>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" class="form-control pull-right date" value="">
                                <input type="hidden" name="from_date_to" class="from-date-to" value="" />
                            </div>
                        </td>
                        <td class="text-center"><i class="fa fa-arrow-right"></i></td>
                        <td>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" class="form-control pull-right date" value="">
                                <input type="hidden" name="to_date_to" class="to-date-to" value="" />
                            </div>
                        </td>
                    </tr>
                    {{csrf_field()}}
                    <tr>
                        <td colspan="4" align="right">
                            <input type="submit" class="btn btn-default" value="{{trans('admin.base.label.search')}}">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="cb"></div>
    </div>

</div>
<style>
    #data-table_filter {
        display: none;
    }
    #filters select {
        width: 100%;
    }
    #data-table hr {
        margin: 5px 0;
    }
</style>
@stop