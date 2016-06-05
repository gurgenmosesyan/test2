<?php

Route::group(['middleware' => ['web', 'front']], function() {

    Route::get('/', 'IndexController@index');

    Route::group(['prefix' => '{lngCode}'], function() {

        Route::get('/', 'IndexController@index');
        Route::get('/about', 'AboutController@index');
        Route::get('/vacancies', 'VacancyController@all');
        Route::get('/vacancies/{id}', 'VacancyController@index');
        Route::get('/accommodations/{id}', 'AccommodationController@index');
        Route::get('/special-offers', 'OfferController@all');
        Route::get('/hotel-facilities', 'FacilityController@all');
        Route::get('/hotel-facilities/{$id}', 'FacilityController@index');
        Route::get('/meeting-and-events', 'EventController@all');

        Route::post('/api/contact', 'ApiController@contact');
        Route::post('/api/subscribe', 'ApiController@subscribe');
    });

});
