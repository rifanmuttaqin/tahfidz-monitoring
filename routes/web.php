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

// Untuk Auth controller
$router->group(['prefix' => 'auth', 'namespace'=>'Auth'], function () use ($router) {
    $router->get('/login',  ['uses' => 'LoginController@showLoginForm']);
    $router->post('/login',  ['as'=>'login', 'uses' => 'LoginController@login']);
    $router->get('/logout',  ['uses' => 'LoginController@logout']);
});

// Untuk Home
Route::get('/', 'HomeController@index');

// Untuk User
Route::get('/user', ['as'=>'user', 'uses' => 'UserController@index']);
Route::post('/user/get-detail', ['as'=>'detail', 'uses' => 'UserController@show']);
Route::post('/user/update', ['as'=>'update', 'uses' => 'UserController@update']);
Route::post('/user/store', ['as'=>'store', 'uses' => 'UserController@store']);
Route::get('/user/create', ['as'=>'create', 'uses' => 'UserController@create']);
Route::post('/user/update-password', ['as'=>'update-password', 'uses' => 'UserController@updatePassword']);
