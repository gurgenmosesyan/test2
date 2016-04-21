<?php
$appName = config('app.name');
$jsTrans->addTrans([
    'admin.delete.modal.text',
    'admin.base.label.delete',
    'admin.base.label.close',
    'admin.base.label.loading',
    'admin.base.label.saved',
    'admin.base.label.invalid_data'
]);
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{isset($pageTitle) ? $appName.' - '.$pageTitle : $appName}}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Ionicons -->
    {{--<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">--}}
    <!-- Date Picker -->
    {{--<link rel="stylesheet" href="/assets/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="/assets/plugins/timepicker/bootstrap-timepicker.min.css">--}}

    <?php
    $head->appendMainStyle('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');
    $head->appendMainStyle('/assets/bootstrap/css/bootstrap.min.css');
    $head->appendMainStyle('/assets/plugins/datatables/dataTables.bootstrap.css');
    $head->appendMainStyle('/assets/dist/css/main.css');
    $head->appendMainStyle('/assets/dist/css/skins/skin-blue.min.css');
    $head->appendMainStyle('/assets/plugins/iCheck/minimal/blue.css');

    $head->appendMainScript('/assets/plugins/jQuery/jQuery-2.1.4.min.js');
    $head->appendMainScript('https://code.jquery.com/ui/1.11.4/jquery-ui.min.js');
    $head->appendMainScript('/assets/bootstrap/js/bootstrap.min.js');
    $head->appendMainScript('/assets/plugins/datatables/jquery.dataTables.min.js');
    $head->appendMainScript('/assets/plugins/datatables/dataTables.bootstrap.min.js');
    $head->appendMainScript('/assets/plugins/iCheck/icheck.min.js');
    $head->appendMainScript('/assets/plugins/datepicker/bootstrap-datepicker.js');
    $head->appendMainScript('/assets/dist/js/app.js');
    $head->appendMainScript('/core/js/main.js');

    //$head->appendMainScript('/assets/plugins/timepicker/bootstrap-timepicker.min.js');

    $head->renderStyles();
    $head->renderScripts();

    $admin = Auth::guard('admin')->user();
    ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<script type="text/javascript">
    var $locSettings = {"trans":<?php echo json_encode($jsTrans->getTrans())?>};
    $main.path = '{{url('')}}';
    $main.token = '{{csrf_token()}}';
</script>
<div class="wrapper">

    <header class="main-header">
        <a href="{{url('/')}}" class="logo">
            <span class="logo-mini">{{config('app.short_name')}}</span>
            <span class="logo-lg">{{$appName}}</span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="hidden-xs">{{$admin->email}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{route('core_admin_edit', $admin->id)}}" class="btn btn-default btn-flat">{{trans('admin.profile.title')}}</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{route('core_admin_logout')}}" class="btn btn-default btn-flat">{{trans('admin.logout.title')}}</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <aside class="main-sidebar">
        <section class="sidebar">
            <ul class="sidebar-menu">
                <li{{$pageMenu == 'guest' ? ' class=active' : ''}}><a href="{{route('admin_guest_table')}}"><i class="fa fa-user"></i> <span>{{trans('admin.guest.form.title')}}</span></a></li>
                <li{{$pageMenu == 'partner' ? ' class=active' : ''}}><a href="{{route('admin_partner_table')}}"><i class="fa fa-suitcase"></i> <span>{{trans('admin.partner.form.title')}}</span></a></li>
                <li{{$pageMenu == 'accommodation' ? ' class=active' : ''}}><a href="{{route('admin_accommodation_table')}}"><i class="fa fa-hotel"></i> <span>{{trans('admin.accommodation.form.title')}}</span></a></li>
                <li{{$pageMenu == 'offer' ? ' class=active' : ''}}><a href="{{route('admin_offer_table')}}"><i class="fa fa-tags"></i> <span>{{trans('admin.offer.form.title')}}</span></a></li>
                <li class="treeview{{$pageMenu == 'facility' || $pageMenu == 'facility_image' || $pageMenu == 'facility_text' ? ' active' : ''}}">
                    <a href="#">
                        <i class="fa fa-th"></i> <span>{{trans('admin.admin_menu.hotel_facilities')}}</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li{{$pageMenu == 'facility' ? ' class=active' : ''}}><a href="{{route('admin_facility_table')}}"><i class="fa fa-list"></i> {{trans('admin.facility.form.title')}}</a></li>
                        <li{{$pageMenu == 'facility_image' ? ' class=active' : ''}}><a href="{{route('admin_facility_image_edit')}}"><i class="fa fa-file-image-o"></i> {{trans('admin.admin_menu.images')}}</a></li>
                        <li{{$pageMenu == 'facility_text' ? ' class=active' : ''}}><a href="{{route('admin_facility_text_edit')}}"><i class="fa fa-file-text-o"></i> {{trans('admin.admin_menu.text')}}</a></li>
                    </ul>
                </li>
                <li class="treeview{{$pageMenu == 'admin' || $pageMenu == 'language' || $pageMenu == 'dictionary' ? ' active' : ''}}">
                    <a href="#">
                        <i class="fa fa-wrench"></i> <span>{{trans('admin.admin_menu.system')}}</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li{{$pageMenu == 'admin' ? ' class=active' : ''}}><a href="{{route('core_admin_table')}}"><i class="fa fa-user"></i> {{trans('admin.admin.form.title')}}</a></li>
                        <li{{$pageMenu == 'language' ? ' class=active' : ''}}><a href="{{route('core_language_table')}}"><i class="fa fa-flag"></i> {{trans('admin.language.form.title')}}</a></li>
                        <li{{$pageMenu == 'dictionary' ? ' class=active' : ''}}><a href="{{route('core_dictionary_table')}}"><i class="fa fa-book"></i> {{trans('admin.dictionary.form.title')}}</a></li>
                    </ul>
                </li>
            </ul>
        </section>
    </aside>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>{{$pageTitle}}</h1>
            {{--<ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>--}}
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{$pageSubTitle}}</h3>
                            @yield('navButtons')
                        </div>
                        @yield('content')
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="control-sidebar-bg"></div>
</div>
<div id="win-status"></div>
</body>
</html>
