<?php


Route::get('login', 'LoginController@create');
Route::post('login', 'LoginController@store');
Route::delete('logout', 'LoginController@destroy');

Route::resource('siparis', 'SiparisController');

Route::get('rapor', 'StokRaporController@index');

Route::get('/', function () {
    return view('welcome');
});
