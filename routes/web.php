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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
	Route::get('/2step', 'TwoStepController@index');
	Route::get('/resend2step', 'TwoStepController@resend2step')->name('resend2step');
	Route::post('/2step', 'TwoStepController@verifyTwoStep')->name('2step');
});




Route::middleware(['auth', '2step'])->group(function () {
	Route::get('/admin', 'HomeController@index')->name('admin');
	Route::get('/page/{slug}', 'HomeController@get_page')->name('page')->middleware(['subs']);
});

