<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/','HomeController@index');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'HomeController@home_index')->name('home');




/*
    * Cors Group App
*/
Route::group(['middleware' => 'cors'], function(){
    Route::get('/provider','HandlerApp@provider');

    /* provider data */
    Route::get('types/{data}','karrillo_app@add_types_phone')->name('types');
    Route::get('types_users/{data}','karrillo_app@add_types_user_data')->name('types_user');
    Route::post('addProvider','karrillo_app@add_provider_data');
});
