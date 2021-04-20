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

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Admin LTE with Datatables
Route::get('adminlte',       'AdminLTEController@adminlte')->name('/adminlte');
Route::get('/country-list',  'AdminLTEController@getList');
Route::get('user-lists',     'AdminLTEController@viewUsers')->name('/user-lists');





//Yajra Datatables-2 with CRUD => https://www.webslesson.info/2019/10/laravel-6-crud-application-using-yajra-datatables-and-ajax.html
Route::get('yajradt2', 'YajraDataTablesCrudController@index')->name('/yajradt2');

Route::resource('sample',         'YajraDataTablesCrudController');
Route::post('sample/update',      'YajraDataTablesCrudController@update')->name('sample.update');
Route::get('sample/destroy/{id}', 'YajraDataTablesCrudController@destroy');

Route::get('/sample/edit/{id}',    'YajraDataTablesCrudController@getFormVal')->name('/sample.edit'); //Fill Edit form with values

