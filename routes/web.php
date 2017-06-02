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

Route::get('/', 'SiteController@index')->name('home');

Auth::routes();
Route::group(['middleware' => ['auth']], function (){
    Route::get('/doctors', 'DoctorController@index')->name('doctors.index');
	Route::get('/doctors/get-all', 'DoctorController@getAll')->middleware('ajax');
	Route::resource('doctors', 'DoctorController', ['except' => ['create', 'edit', 'show', 'index'], 'middleware' => ['ajax']]);
    Route::get('/doctor-types', 'DoctorTypeController@index')->name('doctor-types.index');
    Route::get('/doctor-types/get-all', 'DoctorTypeController@getAll')->middleware('ajax');
	Route::resource('doctor-types', 'DoctorTypeController', ['except' => ['create', 'edit', 'show', 'index'], 'middleware' => ['ajax']]);
	Route::post('/appointments/get-all', 'AppointmentController@getAll')->middleware('ajax');
	Route::resource('appointments', 'AppointmentController',['only' => ['store'], 'middleware' => ['ajax']]);
});
