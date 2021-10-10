<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::group(['prefix' => LaravelLocalization::setLocale()], function(){
    Route::prefix('admin')->namespace('Admin')->group( function(){
        Route::get('/', 'GeneralController@dashboard')->name('admin.dashboard');
        Route::resource('categories', 'CategoryController');
        Route::resource('products', 'ProductController');
        Route::resource('tags', 'TagController');
        Route::resource('articles', 'ArticleController');
        Route::resource('contacts', 'ContactController');
        Route::resource('comments', 'CommentController');
    });
});
