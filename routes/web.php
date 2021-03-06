<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('top');
    
    Route::resource('posts', 'PostsController', [
        'only' => ['create', 'store', 'edit', 'update', 'destroy']
    ]);

    Route::post('/posts/{post_id}/likes', 'LikesController@toggle')->name('likes.toggle');
    
    Route::get('/posts/{post}/comments', 'CommentsController@index')->name('comments.index');
    Route::post('/posts/{post}/comments', 'CommentsController@store')->name('comments.store');
    Route::delete('/posts/{post}/comments/{comment}', 'CommentsController@destroy')->name('comments.destroy');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
