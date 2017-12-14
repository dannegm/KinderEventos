<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//! Public =======================================================

//! Login =========================================================
Route::get ('/login', ['as' => 'login.login', 'uses'=>'AuthController@login']);
Route::post ('/login', ['as' => 'login.dologin', 'uses'=>'AuthController@doLogin']);

Route::get('/', function () {
	if (Auth::check()) {
		return redirect ()->route ('events.index');
	} else {
		return redirect ()->route ('login.login');
	}
})->name('index');

Route::post('api/request_token', ['as' => 'api.requestToken', 'uses' => 'ApiAuthController@requestToken']);
Route::group(['middleware' => 'restapi'], function () {
	Route::post('/api/picture/upload', ['as' => 'pictures.upload', 'uses'=>'PictureController@upload']);
	Route::any('api/events', ['as' => 'api.events', 'uses' => 'EventController@jsonEvents']);
	Route::any('api/logout', ['as' => 'api.logout', 'uses' => 'ApiAuthController@logout']);
});

//! Panel =========================================================
Route::group(['middleware' => 'auth'], function () {
	Route::get('/logout', ['as' => 'login.logout', 'uses'=>'AuthController@logout']);

	// Pages
	Route::get('/pages/download', ['as' => 'pages.download', 'uses' => 'PagesController@download']);

	// Pictures
	Route::post('/api/picture/delete', ['as' => 'pictures.delete', 'uses'=>'PictureController@delete']);
	Route::post('/api/picture/senByEmail', ['as' => 'pictures.senByEmail', 'uses'=>'PictureController@senByEmail']);
	Route::post('/api/picture/setAsPrinted', ['as' => 'pictures.setAsPrinted', 'uses'=>'PictureController@setAsPrinted']);

	// Events
	Route::get('/events', ['as' => 'events.index', 'uses' => 'EventController@viewIndex']);
	Route::get('/events/{permalink}', ['as' => 'events.event', 'uses' => 'EventController@viewEvent']);

	Route::get('/event/new', ['as' => 'events.new', 'uses' => 'EventController@viewNew']);
	Route::get('/event/{id}/edit', ['as' => 'events.edit', 'uses' => 'EventController@viewEdit']);

	Route::post('/event/{id}/update', ['as' => 'events.update', 'uses' => 'EventController@actionUpdate']);
	Route::get('/event/{id}/delete', ['as' => 'events.delete', 'uses' => 'EventController@actionDelete']);
	Route::post('/event/create', ['as' => 'events.create', 'uses' => 'EventController@actionCreate']);

	Route::get('/event/find/by/email', ['as' => 'events.findByEmail', 'uses' => 'EventController@findByEmail']);

	// Users
	Route::get('/users', ['as' => 'users.index', 'uses' => 'UserController@viewIndex']);
	Route::get('/user/new', ['as' => 'users.new', 'uses' => 'UserController@viewNew']);
	Route::get('/user/{id}/edit', ['as' => 'users.edit', 'uses' => 'UserController@viewEdit']);

	Route::post('/user/{id}/update', ['as' => 'users.update', 'uses' => 'UserController@actionUpdate']);
	Route::get('/user/{id}/delete', ['as' => 'users.delete', 'uses' => 'UserController@actionDelete']);
	Route::post('/user/create', ['as' => 'users.create', 'uses' => 'UserController@actionCreate']);
});
