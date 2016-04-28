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
    <li{{$pageMenu == 'vacancy' ? ' class=active' : ''}}><a href="{{route('admin_vacancy_table')}}"><i class="fa fa-cube"></i> <span>{{trans('admin.vacancy.form.title')}}</span></a></li>
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