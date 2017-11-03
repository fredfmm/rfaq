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


Route::middleware(['auth'])->prefix('admin')->group(function() {
    Route::get('/', 'AdminController@index')->name('admin');
    
    Route::resource('/users', 'UserController', ['except', ['destroy']]);
    Route::prefix('/users')->group(function() {
        Route::post('/inactivate/{user}', 'UserController@inactivate')->name('users.inactivate');

        Route::post('/activate/{id}', 'UserController@activate')->name('users.activate');
    });

    Route::resource('/categories', 'CategoryController');

    Route::resource('/questions', 'QuestionController');

    Route::resource('/tags', 'TagController', ['only' => ['index', 'show', 'destroy']]);
});