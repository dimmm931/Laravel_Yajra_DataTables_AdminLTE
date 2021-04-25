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

//Route::get('/home', 'HomeController@index')->name('home');

//Admin LTE with Datatables
Route::get('adminlte',       'AdminLTEController@adminlte')->name('/adminlte');
Route::get('/country-list',  'AdminLTEController@getList');
Route::get('user-lists',     'AdminLTEController@viewUsers')->name('/user-lists');



//Yajra Datatables-2 with CRUD => https://www.webslesson.info/2019/10/laravel-6-crud-application-using-yajra-datatables-and-ajax.html
Route::get('yajradt2', 'YajraDataTablesCrudController@index')->name('/yajradt2');

Route::resource('sample',            'YajraDataTablesCrudController');
Route::put('sample/update',          'YajraDataTablesCrudController@update')->name('sample.update');
Route::delete('sample/destroy/{id}', 'YajraDataTablesCrudController@destroy');

Route::get('/sample/edit/{id}',    'YajraDataTablesCrudController@getFormVal')->name('/sample.edit'); //Fill Edit form with values

/* CHANGE!!!!!!
Route::post('articles', 'Rest@store');
Route::put('articles/{id}', 'Rest@update');
Route::delete('articles/{id}', 'Rest@delete');
*/