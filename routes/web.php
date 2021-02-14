<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', "HomeController@index")->name('index');

Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
    Route::get('/', "BlogController@index")->name('index');
    Route::get('post/{post:slug}', "BlogController@showPost")->name('post.show');
    Route::get('author/{author:slug}', "BlogController@showAuthor")->name('author.show');
    Route::get('tags/{tag:slug}', "BlogController@showTag")->name('tag.show');
    Route::get('tags', "BlogController@tags")->name('tag.index');
});
