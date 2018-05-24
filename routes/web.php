<?php


Route::get('login', 'LoginController@create');
Route::post('login', 'LoginController@store');
Route::delete('logout', 'LoginController@destroy');

Route::get('/siparis/create', 'SiparisController@create');

Route::get('/', function () {
    return view('welcome');
});
