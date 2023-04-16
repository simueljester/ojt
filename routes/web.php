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
Route::get('/list', 'BookController@list')->name('book.list');
Route::get('/create', 'BookController@create')->name('book.create');
Route::post('/save', 'BookController@save')->name('book.save');
Route::get('/edit/{book}', 'BookController@edit')->name('book.edit');
Route::post('/update', 'BookController@update')->name('book.update');
Route::post('/delete', 'BookController@delete')->name('book.delete');

Route::group(['prefix'=>'assignment','as'=>'assignment.'], function(){
    Route::get('/', ['as' => 'index', 'uses' => 'BookAssignmentController@index']);
    Route::post('/assign-books', ['as' => 'assign', 'uses' => 'BookAssignmentController@assign']);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
