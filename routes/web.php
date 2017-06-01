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
Route::group(['middleware' => ['auth']], function (){
	Route::resource('doctors', 'DoctorController');
	Route::resource('visitors', 'VisitorController');
	Route::resource('doctor-types', 'DoctorTypeController');
	Route::resource('appointments', 'AppointmentController');
});

Route::get('/home', 'HomeController@index')->name('home');
