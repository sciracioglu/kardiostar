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
Route::get('cari' , 'MusteriController@cari');
Route::get('risk', 'MusteriController@risk');
Route::get('detay','MusteriController@bakiye_detay');
Route::get('geciken','MusteriController@geciken_bakiye');
Route::get('satis','MusteriController@satis');
Route::get('ceksenet','MusteriController@cekSenet');
Route::get('satis_analiz_miktar','MusteriController@satis_analiz_miktar');
});
