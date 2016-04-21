<?php

Route::group(['middleware' => ['web']], function() {

    Route::get('/', 'IndexController@about');
    Route::get('/products', 'IndexController@products');
    Route::get('/products/{alias}', 'IndexController@productsCategory');
    Route::get('/partners', 'IndexController@partners');
    Route::get('/contact', 'IndexController@contact');

    Route::post('/api/products', 'ApiController@products');
    Route::post('/api/contact', 'ApiController@contact');

});
