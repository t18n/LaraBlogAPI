<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'posts'], function ($app) {
    Route::get('/','PostsController@index');
    Route::post('/','PostsController@create');
    Route::get('{id}', 'PostsController@find');
    Route::put('{id}','PostsController@update');
    Route::delete('{id}','PostsController@delete');
});

Route::group(['prefix' => 'tags'], function ($app) {
    Route::get('/','TagsController@index');
    Route::post('/','TagsController@create');
    Route::get('{id}', 'TagsController@find');
    Route::put('{id}','TagsController@update');
    Route::delete('{id}','TagsController@delete');
});

Route::group(['prefix' => 'categories'], function ($app) {
    Route::get('/','CategoriesController@index');
    Route::post('/','CategoriesController@create');
    Route::get('{id}', 'CategoriesController@find');
    Route::put('{id}','CategoriesController@update');
    Route::delete('{id}','CategoriesController@delete');
});

Route::post('/register', 'RegisterController@register');
