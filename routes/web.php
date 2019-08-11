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
Route::get('/user', ['as'=>'index-user', 'uses' => 'UserController@index']);
Route::post('/user/get-detail', ['as'=>'detail', 'uses' => 'UserController@show']);
Route::post('/user/update', ['as'=>'update-user', 'uses' => 'UserController@update']);
Route::post('/user/store', ['as'=>'store-user', 'uses' => 'UserController@store']);
Route::get('/user/create', ['as'=>'create-user', 'uses' => 'UserController@create']);
Route::post('/user/update-password', ['as'=>'update-password-user', 'uses' => 'UserController@updatePassword']);
Route::post('/user/delete', ['as'=>'delete-user', 'uses' => 'UserController@delete']);

// Untuk Class
Route::get('/student-class', ['as'=>'student-class', 'uses' => 'StudentClassController@index']);
Route::get('/student-class/create', ['as'=>'create-student-class', 'uses' => 'StudentClassController@create']);
Route::post('/student-class/store', ['as'=>'store-student-class', 'uses' => 'StudentClassController@store']);
Route::get('/student-class/get-user-teacher', ['as'=>'get-user-teacher', 'uses' => 'StudentClassController@getUserTeacher']);
Route::post('/student-class/delete', ['as'=>'delete-student-class', 'uses' => 'StudentClassController@delete']);
Route::post('/student-class/get-detail', ['as'=>'detail-student', 'uses' => 'StudentClassController@show']);
Route::post('/student-class/update', ['as'=>'update-student', 'uses' => 'StudentClassController@update']);

// Untuk Siswa
Route::get('/siswa', ['as'=>'siswa', 'uses' => 'SiswaController@index']);
Route::get('/siswa/create', ['as'=>'create-siswa', 'uses' => 'SiswaController@create']);
