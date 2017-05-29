<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Authentication
Route::post('/register', 'RegisterController@register');

Route::post('password/email', 
    'Auth\ForgotPasswordController@getResetToken');

//Posts
Route::group(['prefix' => 'posts'], function ($app) {
    Route::get('/','PostsController@index');
    Route::get('{id}', 'PostsController@find');
});

Route::group(['middleware' => ['auth:api'], 'prefix' => 'posts'], function ($app) {
    Route::post('/','PostsController@create');
    Route::patch('{post}','PostsController@update');
    Route::delete('{post}','PostsController@delete');
});

//Tags
Route::group(['prefix' => 'tags'], function ($app) {
    Route::get('/','TagsController@index');
    Route::get('{id}', 'TagsController@find');
});

Route::group(['middleware' => ['auth:api'], 'prefix' => 'tags'],
    function ($app) {
    Route::post('/','TagsController@create');
    Route::put('{id}','TagsController@update');
    Route::delete('{id}','TagsController@delete');
});

//Categories
Route::group(['prefix' => 'categories'], function ($app) {
    Route::get('/','CategoriesController@index');
    Route::get('{id}', 'CategoriesController@find');
});

Route::group(['middleware' => ['auth:api'], 'prefix' => 'categories'],
    function ($app) {
    Route::post('/','CategoriesController@create');
    Route::patch('{category}','CategoriesController@update');
    Route::delete('{category}','CategoriesController@delete');
});