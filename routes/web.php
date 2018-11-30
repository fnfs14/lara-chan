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

Auth::routes();

// start of abandoned routes
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register')->middleware('r');
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request')->middleware('r');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset')->middleware('r');
// end of abandoned routes

// start of public routes
Route::get('/', 'welcome')->name('welcome')->middleware('welcome');
// end of public routes

// start of client routes
Route::group(['middleware' => ['client']], function () {
	Route::get('/home', 'home')->name('home');
	Route::resource('/task', 'task');
	Route::get('task/status/36c103e0-f147-11e8-9b29-518cf6bb34d6', 'task@index')->name('not_started_yet');
	Route::get('task/status/3e5c5dc0-f147-11e8-8f69-d141cac2911b', 'task@index')->name('on_progress');
	Route::get('task/status/46775880-f147-11e8-b3b7-354b2a57508c', 'task@index')->name('done');
	Route::get('task/status/5bf650a0-f387-11e8-b632-df3d8c50d3d9', 'task@index')->name('canceled');
	Route::get('task/canceled', 'task@canceled');
	Route::get('data/task', 'task@data');
});
// end of client routes

// start of admin routes
// Route::group(['middleware' => ['admin']], function () {
	Route::get('/dashboard', 'admin\dashboard')->name('dashboard');
	Route::resource('/user', 'admin\user');
// });
// end of admin routes