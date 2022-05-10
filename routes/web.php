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
Route::get('/', 'PostsController@index')->name('top');
Route::get('hello', 'HelloController@index');
Route::get('hello/other', 'HelloController@other');
Route::get('posts', 'PostsController@index');
Route::post('posts/confirms', 'PostsController@confirm');
Route::resource('comments', 'CommentsController', ['only' => ['store']]);
Route::resource('posts', 'PostsController', ['only' => ['store','update','index','show','create','destroy','edit']]);
Auth::routes(['/','PostsController@index']);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('phpinfo', 'phpinfoController@index');
Route::get('Comments', 'CommentsController@index');
