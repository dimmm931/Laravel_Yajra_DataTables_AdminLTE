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

Route::get('/',     'AdminLTEController@adminlte');
Route::get('/home', 'AdminLTEController@adminlte')->name('home');

Auth::routes();

//Admin LTE with Datatables
Route::get('adminlte',       'AdminLTEController@adminlte')->name('/adminlte');
Route::get('user-lists',     'AdminLTEController@viewUsers')->name('/user-lists');

//Route::resource('sample', 'YajraDataTablesCrudController');
Route::post('sample/store', 'YajraDataTablesCrudController@store')->name('sample.store');
Route::put('sample/update', 'YajraDataTablesCrudController@update')->name('sample.update');
Route::delete('sample/destroy/{id}', 'YajraDataTablesCrudController@destroy');

Route::get('/sample/edit/{id}',    'YajraDataTablesCrudController@getFormVal')->name('/sample.edit'); //Fill Edit form with values
