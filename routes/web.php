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


Route::prefix('admin')->group(function() {
    Route::get('/', 'AdminController@index')->name('admin');
    
    Route::prefix('users')->group(function() {
        Route::get('/', 'UserController@index')->name('users');
        
        Route::get('/edit/{user}', 'UserController@form')->name('user.edit');
        
        Route::get('/new', 'UserController@form')->name('user.new');
        
        Route::post('/save', 'UserController@save')->name('user.save');
        
        Route::post('/update/{user}', 'UserController@save')->name('user.update');

        Route::post('/inactivate/{user}', 'UserController@destroy')->name('user.delete');

        Route::post('/activate/{id}', 'UserController@restore')->name('user.restore');
    });
});