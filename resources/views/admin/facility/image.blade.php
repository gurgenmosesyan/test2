<?php

$head->appendStyle('/admin/facility/facility.css');
$head->appendScript('/admin/facility/image.js');
$pageTitle = $pageSubTitle = trans('admin.facility_image.form.title');
$pageMenu = 'facility_image';
?>
@extends('core.layout')
@section('content')
    <script type="text/javascript">
        $image.images = <?php echo json_encode($images); ?>;
    </script>
    <form id="edit-form" class="form-horizontal" method="post" action="{{route('admin_facility_image_update')}}">
        <div class="box-body">

            <div id="image-group" class="form-group">
                <label class="col-sm-3 control-label">{{trans('admin.base.label.images')}}</label>
                <div class="col-sm-9">
                    <a href="#" id="upload-image" class="btn btn-default">{{trans('admin.base.label.upload')}}</a>
                    <div id="form-error-images" class="form-error"></div>
                    <div id="images-block"></div>
                </div>
            </div>

            {{csrf_field()}}
        </div>
        <div class="box-footer">
            <input type="submit" class="nav-btn nav-btn-save btn btn-primary" value="{{trans('admin.base.label.save')}}">
        </div>
    </form>
@stop