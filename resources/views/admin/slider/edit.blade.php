<?php
use App\Core\Helpers\ImgUploader;

$head->appendScript('/admin/slider/slider.js');
$pageTitle = trans('admin.slider.form.title');
$pageMenu = 'slider';
if ($saveMode == 'add') {
    $pageSubTitle = trans('admin.slider.form.add.sub_title');
    $url = route('admin_slider_store');
} else {
    $pageSubTitle = trans('admin.slider.form.edit.sub_title', ['id' => $slider->id]);
    $url = route('admin_slider_update', $slider->id);
}
?>
@extends('core.layout')
@section('content')
<form id="edit-form" class="form-horizontal" method="post" action="{{$url}}">
    <div class="box-body">

        <div class="form-group">
            <label class="col-sm-3 control-label data-req">{{trans('admin.base.label.category')}}</label>
            <div class="col-sm-9">
                <select name="category" class="form-control">
                    <option value="">{{trans('admin.base.label.select')}}</option>
                    @foreach(config('slider.categories') as $category)
                        <option value="{{$category}}"{{$category == $slider->category ? ' selected="selected"' : ''}}>{{trans('admin.slider.category.'.$category)}}</option>
                    @endforeach
                </select>
                <div id="form-error-category" class="form-error"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label data-req">{{trans('admin.base.label.image')}}</label>
            <div class="col-sm-9">
                <?php ImgUploader::uploader('slider', 'image', 'image', $slider->image); ?>
            </div>
        </div>

        {{csrf_field()}}
    </div>
    <div class="box-footer">
        <input type="submit" class="nav-btn nav-btn-save btn btn-primary" value="{{trans('admin.base.label.save')}}">
        <a href="{{route('admin_slider_table')}}" class="nav-btn nav-btn-cancel btn btn-default">{{trans('admin.base.label.cancel')}}</a>
    </div>
</form>
@stop