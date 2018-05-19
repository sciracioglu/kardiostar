<?php


Route::get('/siparis/create', 'SiparisController@create');

Route::get('/', function () {
	return view('welcome');
});
