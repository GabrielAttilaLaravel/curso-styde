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

Route::get('/usuarios', 'UserController@index')->name('users.index');
Route::get('/usuarios/nuevo', 'UserController@create')->name('users.create');
Route::post('/usuarios', 'UserController@store')->name('users.post');
Route::get('/usuarios/{user}/editar', 'UserController@edit')->name('users.edit');
Route::put('/usuarios/{user}', 'UserController@update')->name('users.update');
Route::get('/usuarios/{user}', 'UserController@show')->name('users.show');
Route::delete('/usuarios/{user}', 'UserController@destroy')->name('users.destroy');

Route::get('/saludo/{name}/{nickname?}', 'WelcomeUserController@index');

