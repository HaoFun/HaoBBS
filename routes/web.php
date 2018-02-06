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

Route::get('/','PagesController@root')->name('root');

Auth::routes();

/* User route */
Route::resource('users','UsersController',['only' => ['update','edit']]);
Route::get('/users/{user}','UsersController@show')->name('users.show');  //隱式綁定

Route::resource('posts','PostsController');


