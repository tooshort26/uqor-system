<?php

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();


Route::group(['prefix' => 'admin'] , function () {
	  Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');
  	Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
  	Route::get('login', 'Auth\AdminLoginController@login')->name('admin.auth.login');
  	Route::post('login', 'Auth\AdminLoginController@loginAdmin')->name('admin.auth.loginAdmin');
  	Route::post('logout', 'Auth\AdminLoginController@logout')->name('admin.auth.logout');
});

Route::group(['prefix' => 'campus'] , function () {
	  Route::get('/', 'Campus\DashboardController@index')->name('campus.dashboard');
  	Route::get('dashboard', 'Campus\DashboardController@index')->name('campus.dashboard');
  	Route::get('login', 'Auth\CampusLoginController@login')->name('campus.auth.login');
  	Route::post('login', 'Auth\CampusLoginController@loginCampus')->name('campus.auth.loginCampus');
  	Route::post('logout', 'Auth\CampusLoginController@logout')->name('campus.auth.logout');
});

Route::group(['prefix' => 'president'] , function () {
	  Route::get('/', 'President\DashboardController@index')->name('president.dashboard');
  	Route::get('dashboard', 'President\DashboardController@index')->name('president.dashboard');
  	Route::get('login', 'Auth\PresidentLoginController@login')->name('president.auth.login');
  	Route::post('login', 'Auth\PresidentLoginController@loginPresident')->name('president.auth.loginPresident');
  	Route::post('logout', 'Auth\PresidentLoginController@logout')->name('president.auth.logout');
});


