<?php

Auth::routes();

Route::get('/','HomeController@index');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'HomeController@home_index')->name('home');

/*
    * Cors Group App
*/
Route::group(['middleware' => 'cors'], function(){
    Route::get('/provider','HandlerApp@provider');
});
