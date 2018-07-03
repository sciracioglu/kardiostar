<?php
Route::get('login', 'LoginController@create');
Route::post('login', 'LoginController@store')->middleware('throttle:60,5');
Route::delete('logout', 'LoginController@destroy');

Route::group(['middleware' => ['login']], function () {
    Route::resource('siparis', 'SiparisController');
    Route::get('siparis_liste', 'SiparisListesiController@index');
    Route::get('siparisler', 'SiparisListesiController@show');
    Route::delete('siparis_liste/{id}', 'SiparisListesiController@destroy');
    Route::get('rapor', 'StokRaporController@index');
    Route::get('/', 'MusteriController@index');
    Route::post('/', 'MusteriController@store');
});
