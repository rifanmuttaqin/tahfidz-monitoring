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

    // Email reset Password
    $router->get('/reset',  ['as'=>'show-reset','uses' => 'ForgotPasswordController@showLinkRequestForm']);
    $router->post('/email',  ['as'=>'password.email', 'uses' => 'ForgotPasswordController@sendResetLinkEmail']);
    $router->get('/reset/token/{token}',  ['as'=>'password.reset.token','uses' => 'ResetPasswordController@showResetForm']);
    
    $router->post('/reset',  ['as'=>'password.reset','uses' => 'ResetPasswordController@reset']);
});

// Untuk Home
$router->group(['prefix' => '/'], function () use ($router) {
	$router->get('/',  ['as'=>'home','uses' => 'HomeController@index']);
    $router->get('/home',  ['as'=>'home-url','uses' => 'HomeController@index']);
});

// Untuk User
$router->group(['prefix' => 'user'], function () use ($router) {
	$router->get('/',  ['as'=>'index-user','uses' => 'UserController@index']);
    $router->post('/get-detail',  ['as'=>'detail','uses' => 'UserController@show']);
    $router->post('/update',  ['as'=>'update-user','uses' => 'UserController@update']);
    $router->post('/store',  ['as'=>'store-user','uses' => 'UserController@store']);
    $router->get('/create',  ['as'=>'create-user','uses' => 'UserController@create']);
    $router->post('/update-password',  ['as'=>'update-password-user','uses' => 'UserController@updatePassword']);
    $router->post('/delete',  ['as'=>'delete-user','uses' => 'UserController@delete']);
});

// Untuk Parent
$router->group(['prefix' => 'parent'], function () use ($router) {
	$router->get('/',  ['as'=>'index-parent','uses' => 'ParentController@index']);
	$router->get('/create',  ['as'=>'create-parent','uses' => 'ParentController@create']);
	$router->post('/store',  ['as'=>'store-parent','uses' => 'ParentController@store']);
	$router->post('/update',  ['as'=>'update-parent','uses' => 'ParentController@update']);
	$router->get('/get-siswa',  ['as'=>'get-siswa','uses' => 'ParentController@getSiswa']);
});

// Untuk Class
$router->group(['prefix' => 'student-class'], function () use ($router) {
	$router->get('/',  ['as'=>'student-class','uses' => 'StudentClassController@index']);
	$router->get('/create',  ['as'=>'create-student-class','uses' => 'StudentClassController@create']);
	$router->post('/store',  ['as'=>'store-student-class','uses' => 'StudentClassController@store']);
	$router->get('/get-user-teacher',  ['as'=>'get-user-teacher','uses' => 'StudentClassController@getUserTeacher']);
	$router->post('/delete',  ['as'=>'delete-student-class','uses' => 'StudentClassController@delete']);
	$router->post('/get-detail',  ['as'=>'detail-student','uses' => 'StudentClassController@show']);
	$router->post('/update',  ['as'=>'update-student','uses' => 'StudentClassController@update']);
});

// Untuk Siswa
$router->group(['prefix' => 'siswa'], function () use ($router) {
	$router->get('/',  ['as'=>'siswa','uses' => 'SiswaController@index']);
	$router->get('/create',  ['as'=>'create-siswa','uses' => 'SiswaController@create']);
	$router->post('/get-user-parent',  ['as'=>'get-user-parent','uses' => 'SiswaController@getUserParent']);	
	$router->get('/get-class',  ['as'=>'get-class','uses' => 'SiswaController@getClass']);
	$router->post('/store',  ['as'=>'store-siswa','uses' => 'SiswaController@store']);
	$router->post('/delete',  ['as'=>'delete-siswa','uses' => 'SiswaController@delete']);
	$router->post('/get-detail',  ['as'=>'detail-siswa','uses' => 'SiswaController@show']);
	$router->post('/update',  ['as'=>'update-siswa','uses' => 'SiswaController@update']);
});

// Untuk Role Dan Permission
$router->group(['prefix' => 'role'], function () use ($router) {
	$router->get('/',  ['as'=>'role','uses' => 'RoleController@index']);
	$router->get('/create',  ['as'=>'create-role','uses' => 'RoleController@create']);
	$router->get('/edit/{id}',  ['as'=>'update-role','uses' => 'RoleController@edit']);
	$router->post('/update/{id}',  ['as'=>'do-update-role','uses' => 'RoleController@update']);
	$router->post('/store',  ['as'=>'store-role','uses' => 'RoleController@store']);
	$router->post('/delete',  ['as'=>'delete-role','uses' => 'RoleController@delete']);
});

// Untuk Iqro
$router->group(['prefix' => 'iqro'], function () use ($router) {
	$router->get('/',  ['as'=>'iqro','uses' => 'IqroController@index']);
	$router->get('/create',  ['as'=>'create-iqro','uses' => 'IqroController@create']);
	$router->post('/store',  ['as'=>'store-iqro','uses' => 'IqroController@store']);
	$router->post('/delete',  ['as'=>'delete-iqro','uses' => 'IqroController@delete']);
	$router->post('/get-detail',  ['as'=>'detail-iqro','uses' => 'IqroController@show']);
	$router->post('/update',  ['as'=>'update-iqro','uses' => 'IqroController@update']);
});


// Untuk Alquran (Surah)
$router->group(['prefix' => 'alquran'], function () use ($router) {
	$router->get('/',  ['as'=>'alquran','uses' => 'AlquranController@index']);
	$router->get('/create',  ['as'=>'create-alquran','uses' => 'AlquranController@create']);
	$router->post('/store',  ['as'=>'store-alquran','uses' => 'AlquranController@store']);
	$router->post('/delete',  ['as'=>'delete-alquran','uses' => 'AlquranController@delete']);
	$router->post('/get-detail',  ['as'=>'detail-surah','uses' => 'AlquranController@show']);
	$router->post('/update',  ['as'=>'update-surah','uses' => 'AlquranController@update']);
});


// Untuk Profile
$router->group(['prefix' => 'profile'], function () use ($router) {
	$router->get('/',  ['as'=>'profile','uses' => 'ProfileController@index']);
	$router->post('/update',  ['as'=>'update-profile','uses' => 'ProfileController@update']);
	$router->post('/update-password',  ['as'=>'update-password-profile','uses' => 'ProfileController@updatePassword']);
	$router->post('/delete-image',  ['as'=>'delete-image','uses' => 'ProfileController@deleteImage']);
});


// Untuk Assessment
$router->group(['prefix' => 'assessment'], function () use ($router) {
	$router->get('/',  ['as'=>'assessment','uses' => 'AssessmentController@index']);
	$router->get('/assessment/{type}',  ['as'=>'create-assessment','uses' => 'AssessmentController@assessment']);
	$router->get('/get-surah',  ['as'=>'get-surah','uses' => 'AssessmentController@getSurah']);
	$router->get('/get-total-ayat',  ['as'=>'get-ayat','uses' => 'AssessmentController@getAyat']);
	$router->get('/get-total-page',  ['as'=>'get-page','uses' => 'AssessmentController@getPage']);
	$router->post('/do-assessment',  ['as'=>'do-assessment','uses' => 'AssessmentController@doAssessment']);
});

// Untuk Daily Report
$router->group(['prefix' => 'daily-report'], function () use ($router) {
	$router->get('/',  ['as'=>'daily-report','uses' => 'DailyReportController@index']);
	$router->post('/show',  ['as'=>'daily-report-show','uses' => 'DailyReportController@show']);
	$router->get('/print',  ['as'=>'daily-report-print','uses' => 'DailyReportController@printPdf']);
});

// Untuk Student Report
$router->group(['prefix' => 'student-report'], function () use ($router) {
	$router->get('/',  ['as'=>'student-report','uses' => 'StudentReportController@index']);
	$router->post('/show',  ['as'=>'student-report-show','uses' => 'StudentReportController@show']);
	$router->get('/print',  ['as'=>'student-report-print','uses' => 'StudentReportController@printPdf']);
});

// Untuk Action Log
$router->group(['prefix' => 'action-log'], function () use ($router) {
	$router->get('/',  ['as'=>'action-log','uses' => 'ActionLogController@index']);
	$router->post('/remove',  ['as'=>'action-log-remove','uses' => 'ActionLogController@destroy']);
});

// Untuk Notification
$router->group(['prefix' => 'notification'], function () use ($router) {
	$router->get('/',  ['as'=>'notification','uses' => 'NotificationController@index']);
	$router->post('/store',  ['as'=>'store-notification','uses' => 'NotificationController@store']);
	$router->post('/get-detail',  ['as'=>'notification-get-detail','uses' => 'NotificationController@getDetail']);
});