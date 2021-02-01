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


//Simple JQ DataTable
Route::get('/datatables',   'AdminLTEController@index')->name('/datatables');
Route::get('students/list', 'AdminLTEController@getStudents')->name('students.list');

//Admin LTE with Datatables
Route::get('adminlte',       'AdminLTEController@adminlte')->name('/adminlte');
Route::get('/country-list',  'AdminLTEController@getList');


//Yajra Datatables-2 with CRUD => https://www.webslesson.info/2019/10/laravel-6-crud-application-using-yajra-datatables-and-ajax.html
Route::get('yajradt2', 'YajraDataTablesCrudController@index')->name('/yajradt2');

Route::resource('sample', 'YajraDataTablesCrudController');
Route::post('sample/update', 'YajraDataTablesCrudController@update')->name('sample.update');
Route::get('sample/destroy/{id}', 'YajraDataTablesCrudController@destroy');


