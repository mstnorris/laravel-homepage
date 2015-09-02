<?php

Route::get('/', ['as' => 'home_path', 'uses' => 'PagesController@home']);

get('sites', ['as' => 'sites_path', 'uses' => 'SitesController@index']);

post('sites', ['as' => 'sites_path', 'uses' => 'SitesController@store']);
