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
Route::get('/', ['as'=>'home', 'uses' => 'HomeController@index']);

// Untuk User
Route::get('/user', ['as'=>'index-user', 'uses' => 'UserController@index']);
Route::post('/user/get-detail', ['as'=>'detail', 'uses' => 'UserController@show']);
Route::post('/user/update', ['as'=>'update-user', 'uses' => 'UserController@update']);
Route::post('/user/store', ['as'=>'store-user', 'uses' => 'UserController@store']);
Route::get('/user/create', ['as'=>'create-user', 'uses' => 'UserController@create']);
Route::post('/user/update-password', ['as'=>'update-password-user', 'uses' => 'UserController@updatePassword']);
Route::post('/user/delete', ['as'=>'delete-user', 'uses' => 'UserController@delete']);

// Untuk Parent
Route::get('/parent', ['as'=>'index-parent', 'uses' => 'ParentController@index']);
Route::get('/parent/create', ['as'=>'create-parent', 'uses' => 'ParentController@create']);
Route::post('/parent/store', ['as'=>'store-parent', 'uses' => 'ParentController@store']);
Route::post('/parent/update', ['as'=>'parent-user', 'uses' => 'ParentController@update']);
Route::get('/parent/get-siswa', ['as'=>'get-siswa', 'uses' => 'ParentController@getSiswa']);

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
Route::get('/siswa/get-user-parent', ['as'=>'get-user-parent', 'uses' => 'SiswaController@getUserParent']);
Route::get('/siswa/get-class', ['as'=>'get-class', 'uses' => 'SiswaController@getClass']);
Route::post('/siswa/store', ['as'=>'store-siswa', 'uses' => 'SiswaController@store']);
Route::post('/siswa/delete', ['as'=>'delete-siswa', 'uses' => 'SiswaController@delete']);
Route::post('/siswa/get-detail', ['as'=>'detail-siswa', 'uses' => 'SiswaController@show']);
Route::post('/siswa/update', ['as'=>'update-siswa', 'uses' => 'SiswaController@update']);

// Untuk Role Dan Permission
Route::get('/role', ['as'=>'role', 'uses' => 'RoleController@index']);
Route::get('/role/create', ['as'=>'create-role', 'uses' => 'RoleController@create']);
Route::get('/role/edit/{id}', ['as'=>'update-role', 'uses' => 'RoleController@edit']);
Route::post('/role/update/{id}', ['as'=>'do-update-role', 'uses' => 'RoleController@update']);
Route::post('/role/store', ['as'=>'store-role', 'uses' => 'RoleController@store']);
Route::post('/role/delete', ['as'=>'delete-role', 'uses' => 'RoleController@delete']);

// Untuk Iqro
Route::get('/iqro', ['as'=>'iqro', 'uses' => 'IqroController@index']);
Route::get('/iqro/create', ['as'=>'create-iqro', 'uses' => 'IqroController@create']);
Route::post('/iqro/store', ['as'=>'store-iqro', 'uses' => 'IqroController@store']);
Route::post('/iqro/delete', ['as'=>'delete-iqro', 'uses' => 'IqroController@delete']);
Route::post('/iqro/get-detail', ['as'=>'detail-iqro', 'uses' => 'IqroController@show']);
Route::post('/iqro/update', ['as'=>'update-iqro', 'uses' => 'IqroController@update']);

// Untuk Alquran (Surah)
Route::get('/alquran', ['as'=>'alquran', 'uses' => 'AlquranController@index']);
Route::get('/alquran/create', ['as'=>'create-alquran', 'uses' => 'AlquranController@create']);
Route::post('/alquran/store', ['as'=>'store-alquran', 'uses' => 'AlquranController@store']);
Route::post('/alquran/delete', ['as'=>'delete-alquran', 'uses' => 'AlquranController@delete']);
Route::post('/alquran/get-detail', ['as'=>'detail-surah', 'uses' => 'AlquranController@show']);
Route::post('/alquran/update', ['as'=>'update-surah', 'uses' => 'AlquranController@update']);

// Untuk Profile
Route::get('/profile', ['as'=>'profile', 'uses' => 'ProfileController@index']);
Route::post('/profile/update', ['as'=>'update-profile', 'uses' => 'ProfileController@update']);
Route::post('/profile/update-password', ['as'=>'update-password-profile', 'uses' => 'ProfileController@updatePassword']);
Route::post('/profile/delete-image', ['as'=>'delete-image', 'uses' => 'ProfileController@deleteImage']);

// Untuk Assessment
Route::get('/assessment', ['as'=>'assessment', 'uses' => 'AssessmentController@index']);
Route::get('/assessment/assessment/{type}', ['as'=>'create-assessment', 'uses' => 'AssessmentController@assessment']);
Route::get('/assessment/get-surah', ['as'=>'get-surah', 'uses' => 'AssessmentController@getSurah']);
Route::get('/assessment/get-total-ayat', ['as'=>'get-ayat', 'uses' => 'AssessmentController@getAyat']);
Route::get('/assessment/get-total-page', ['as'=>'get-page', 'uses' => 'AssessmentController@getPage']);
Route::post('/assessment/do-assessment', ['as'=>'do-assessment', 'uses' => 'AssessmentController@doAssessment']);

// Untuk Daily Report
Route::get('/daily-report', ['as'=>'daily-report', 'uses' => 'DailyReportController@index']);
Route::post('/daily-report/show', ['as'=>'daily-report-show', 'uses' => 'DailyReportController@show']);
Route::get('/daily-report/print', ['as'=>'daily-report-print', 'uses' => 'DailyReportController@printPdf']);

// Untuk Student Report
Route::get('/student-report', ['as'=>'student-report', 'uses' => 'StudentReportController@index']);
Route::post('/student-report/show', ['as'=>'student-report-show', 'uses' => 'StudentReportController@show']);
Route::get('/student-report/print', ['as'=>'student-report-print', 'uses' => 'StudentReportController@printPdf']);