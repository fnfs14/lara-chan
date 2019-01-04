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
		Route::get('data/task/desc/{id}', 'task@getDesc');
		Route::get('data/task/{parent}/{offset}', 'task@data');
		Route::get('update/task/{id}/{perc}', 'task@updatePerc');
});
// end of client routes

// start of admin routes
Route::group(['middleware' => ['admin']], function () {
	Route::get('/dashboard', 'admin\dashboard')->name('dashboard');
	Route::resource('/user', 'admin\user');
});
// end of admin routes

// start of testing routes
	Route::get('test/{id}', 'task@doDestroy');
// end of testing routes