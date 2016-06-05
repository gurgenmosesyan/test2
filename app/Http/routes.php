<?php

Route::group(['middleware' => ['web', 'front']], function() {

    Route::get('/', 'IndexController@index');

    Route::group(['prefix' => '{lngCode}'], function() {

        Route::get('/', 'IndexController@index');
        Route::get('/about', 'AboutController@index');
        Route::get('/vacancies', 'VacancyController@all');
        Route::get('/vacancies/{id}', 'VacancyController@index');
        Route::get('/accommodations/{id}', 'AccommodationController@index');


        //Route::post('/api/products', 'ApiController@products');
        Route::post('/api/contact', 'ApiController@contact');
        Route::post('/api/subscribe', 'ApiController@subscribe');
    });

});
