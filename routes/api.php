<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'RegisterController@register');

Route::group(['prefix' => 'posts'], function ($app) {
    Route::get('/','PostsController@index');
    Route::middleware('auth:api')->post('/','PostsController@create');
    Route::get('{id}', 'PostsController@find');
    Route::middleware('auth:api')->put('{id}','PostsController@update');
    Route::middleware('auth:api')->delete('{id}','PostsController@delete');
});

Route::group(['prefix' => 'tags'], function ($app) {
    Route::get('/','TagsController@index');
    Route::middleware('auth:api')->post('/','TagsController@create');
    Route::get('{id}', 'TagsController@find');
    Route::middleware('auth:api')->put('{id}','TagsController@update');
    Route::middleware('auth:api')->delete('{id}','TagsController@delete');
});

Route::group(['prefix' => 'categories'], function ($app) {
    Route::get('/','CategoriesController@index');
    Route::middleware('auth:api')->post('/','CategoriesController@create');
    Route::get('{id}', 'CategoriesController@find');
    Route::middleware('auth:api')->put('{id}','CategoriesController@update');
    Route::middleware('auth:api')->delete('{id}','CategoriesController@delete');
});