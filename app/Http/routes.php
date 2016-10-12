<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['web']], function(){
    Route::get('/', function () {
        return view('welcome');
    });

    Route::auth();

    Route::get('/tasks', 'TaskController@index');
    Route::post('task','TaskController@store');
    Route::delete('/task/{task}','TaskController@destroy');
});

Route::group(['middleware' => ['web']], function (){
    Route::auth();
    Route::get('/list_file', 'FileentryController@index');
    Route::post('/upload_file', 'FileentryController@store');
    Route::post('/upload_file1', 'FileentryController@dropzone_store');
    Route::delete('/delete/{id}', 'FileentryController@delete');
    Route::get('/download/{id}','FileentryController@download');
});