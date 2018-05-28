<?php
Route::get('login', 'LoginController@create');
Route::post('login', 'LoginController@store')->middleware('throttle:60,5');
Route::delete('logout', 'LoginController@destroy');

Route::group(['middleware' => ['login']], function () {
    Route::resource('siparis', 'SiparisController');
    Route::get('rapor', 'StokRaporController@index');
    Route::get('/', 'MusteriController@index');
    Route::post('/', 'MusteriController@store');
});
