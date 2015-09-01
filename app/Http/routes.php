<?php

Route::get('/', ['as' => 'home_path', 'uses' => 'PagesController@home']);

get('sites', function () {
    return App\Site::all();
});

post('sites', function () {
    return App\Site::create(Request::all());
});
