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

/* Post route */
Route::resource('posts','PostsController',['only' => ['index','create','store','edit','update','destroy']]);
Route::get('/posts/{post}/{slug?}','PostsController@show')->name('posts.show');
Route::post('upload_image','PostsController@uploadImage')->name('posts.upload_image'); //上傳圖片

/* Topic route */
Route::resource('topics','TopicsController',['only' => ['show']]);

/* Reply route */
Route::resource('replies','RepliesController',['only' => ['store','destroy']]);

/* Notification route */
Route::resource('notifications','NotificationsController',['only' => ['index']]);
