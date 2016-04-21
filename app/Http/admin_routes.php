<?php

$params = [
    'middleware' => ['web', 'auth:admin', 'language'],
    'prefix' => 'admpanel',
    'namespace' => 'Admin'
];

Route::group($params, function () {

    Route::get('/', 'GuestController@table');

    Route::get('/guest', ['uses' => 'GuestController@table', 'as' => 'admin_guest_table']);
    Route::get('/guest/create', ['uses' => 'GuestController@create', 'as' => 'admin_guest_create']);
    Route::get('/guest/edit/{id}', ['uses' => 'GuestController@edit', 'as' => 'admin_guest_edit']);
    Route::post('/guest', ['uses' => 'GuestController@index', 'as' => 'admin_guest_index']);
    Route::post('/guest/store', ['uses' => 'GuestController@store', 'as' => 'admin_guest_store']);
    Route::post('/guest/update/{id}', ['uses' => 'GuestController@update', 'as' => 'admin_guest_update']);
    Route::post('/guest/delete/{id}', ['uses' => 'GuestController@delete', 'as' => 'admin_guest_delete']);

    Route::get('/partner', ['uses' => 'PartnerController@table', 'as' => 'admin_partner_table']);
    Route::get('/partner/create', ['uses' => 'PartnerController@create', 'as' => 'admin_partner_create']);
    Route::get('/partner/edit/{id}', ['uses' => 'PartnerController@edit', 'as' => 'admin_partner_edit']);
    Route::post('/partner', ['uses' => 'PartnerController@index', 'as' => 'admin_partner_index']);
    Route::post('/partner/store', ['uses' => 'PartnerController@store', 'as' => 'admin_partner_store']);
    Route::post('/partner/update/{id}', ['uses' => 'PartnerController@update', 'as' => 'admin_partner_update']);
    Route::post('/partner/delete/{id}', ['uses' => 'PartnerController@delete', 'as' => 'admin_partner_delete']);

    Route::get('/accommodation', ['uses' => 'AccommodationController@table', 'as' => 'admin_accommodation_table']);
    Route::get('/accommodation/create', ['uses' => 'AccommodationController@create', 'as' => 'admin_accommodation_create']);
    Route::get('/accommodation/edit/{id}', ['uses' => 'AccommodationController@edit', 'as' => 'admin_accommodation_edit']);
    Route::post('/accommodation', ['uses' => 'AccommodationController@index', 'as' => 'admin_accommodation_index']);
    Route::post('/accommodation/store', ['uses' => 'AccommodationController@store', 'as' => 'admin_accommodation_store']);
    Route::post('/accommodation/update/{id}', ['uses' => 'AccommodationController@update', 'as' => 'admin_accommodation_update']);
    Route::post('/accommodation/delete/{id}', ['uses' => 'AccommodationController@delete', 'as' => 'admin_accommodation_delete']);

    Route::get('/offer', ['uses' => 'OfferController@table', 'as' => 'admin_offer_table']);
    Route::get('/offer/create', ['uses' => 'OfferController@create', 'as' => 'admin_offer_create']);
    Route::get('/offer/edit/{id}', ['uses' => 'OfferController@edit', 'as' => 'admin_offer_edit']);
    Route::post('/offer', ['uses' => 'OfferController@index', 'as' => 'admin_offer_index']);
    Route::post('/offer/store', ['uses' => 'OfferController@store', 'as' => 'admin_offer_store']);
    Route::post('/offer/update/{id}', ['uses' => 'OfferController@update', 'as' => 'admin_offer_update']);
    Route::post('/offer/delete/{id}', ['uses' => 'OfferController@delete', 'as' => 'admin_offer_delete']);

    Route::get('/facility', ['uses' => 'FacilityController@table', 'as' => 'admin_facility_table']);
    Route::get('/facility/create', ['uses' => 'FacilityController@create', 'as' => 'admin_facility_create']);
    Route::get('/facility/edit/{id}', ['uses' => 'FacilityController@edit', 'as' => 'admin_facility_edit']);
    Route::post('/facility', ['uses' => 'FacilityController@index', 'as' => 'admin_facility_index']);
    Route::post('/facility/store', ['uses' => 'FacilityController@store', 'as' => 'admin_facility_store']);
    Route::post('/facility/update/{id}', ['uses' => 'FacilityController@update', 'as' => 'admin_facility_update']);
    Route::post('/facility/delete/{id}', ['uses' => 'FacilityController@delete', 'as' => 'admin_facility_delete']);

    Route::get('/facility/image', ['uses' => 'FacilityImageController@edit', 'as' => 'admin_facility_image_edit']);
    Route::post('/facility/image', ['uses' => 'FacilityImageController@update', 'as' => 'admin_facility_image_update']);

    Route::get('/facility/text', ['uses' => 'FacilityTextController@edit', 'as' => 'admin_facility_text_edit']);
    Route::post('/facility/text', ['uses' => 'FacilityTextController@update', 'as' => 'admin_facility_text_update']);

});
