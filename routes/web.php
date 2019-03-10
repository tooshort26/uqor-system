<?php

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();


Route::group(['prefix' => 'school'] , function () {
	Route::get('/', 'AdminController@index')->name('admin.dashboard');
  	Route::get('dashboard', 'AdminController@index')->name('admin.dashboard');
  	Route::get('login', 'Auth\AdminLoginController@login')->name('admin.auth.login');
  	Route::post('login', 'Auth\AdminLoginController@loginAdmin')->name('admin.auth.loginAdmin');
  	Route::post('logout', 'Auth\AdminLoginController@logout')->name('admin.auth.logout');
});

Route::group(['prefix' => 'student'] , function () {
	Route::get('/', 'StudentController@index')->name('student.dashboard');
  	Route::get('dashboard', 'StudentController@index')->name('student.dashboard');
  	Route::get('login', 'Auth\StudentLoginController@login')->name('student.auth.login');
  	Route::post('login', 'Auth\StudentLoginController@loginStudent')->name('student.auth.loginStudent');
  	Route::post('logout', 'Auth\StudentLoginController@logout')->name('student.auth.logout');
});

Route::group(['prefix' => 'superadmin'] , function () {
	Route::get('/', 'SuperAdminController@index')->name('super_admin.dashboard');
  	Route::get('dashboard', 'SuperAdminController@index')->name('super_admin.dashboard');
  	Route::get('login', 'Auth\SuperAdminLoginController@login')->name('super_admin.auth.login');
  	Route::post('login', 'Auth\SuperAdminLoginController@loginSuperAdmin')->name('super_admin.auth.loginSuperAdmin');
  	Route::post('logout', 'Auth\SuperAdminLoginController@logout')->name('super_admin.auth.logout');
});


