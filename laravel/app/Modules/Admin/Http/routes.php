<?php

/*
|--------------------------------------------------------------------------
| Module Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for the module.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['prefix' => 'admin'], function() {
	//登陆控制器
	Route::get('login','AdminController@login');

	//提交表单
	Route::any('login','AdminController@login');
});
Route::group(['prefix' => 'admin','middleware' => ['web','admin']], function() {
	Route::any('logout','AdminController@logout');
	Route::get('editPwd','AdminController@editPwd');
	Route::post('editPwd','AdminController@editPwd');
});
