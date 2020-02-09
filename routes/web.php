<?php

Route::get('/', 'WelcomeController@index');


Auth::routes();


Route::group(['prefix' => 'admin', 'middleware' => ['remind.form.submission']] , function () {
	  Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');
  	Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
    Route::get('/profile/update', 'Admin\ProfileController@edit')->name('admin.profile.edit');
    Route::put('/profile/update', 'Admin\ProfileController@update')->name('admin.profile.update');

  	Route::get('login', 'Auth\AdminLoginController@login')->name('admin.auth.login');
  	Route::post('login', 'Auth\AdminLoginController@loginAdmin')->name('admin.auth.loginAdmin');
  	Route::post('logout', 'Auth\AdminLoginController@logout')->name('admin.auth.logout');

    Route::get('/approved/campus/request/{campus}', 'Admin\CampusApprovalController@approve')->name('approved.campus.request');
    Route::get('/reject/campus/request/{campus}', 'Admin\CampusApprovalController@reject')->name('reject.campus.request');
    Route::resource('forms', 'Admin\FormController');

    Route::get('pending/forms', 'Admin\PendingFormsController@index')->name('pending-forms.index');
    Route::get('pending/forms/{campusId}/{formId}', 'Admin\PendingFormsController@show')->name('pending-forms.show');

    Route::post('pending/forms/add/comment/{formId}' , 'Admin\PendingFormsController@addComment')->name('pending-forms.add-comment');
    Route::get('pending/forms/{campusId}/{formId}/approve', 'Admin\PendingFormsController@approve')->name('pending-forms.approve');

    Route::post('/form/upload', 'Admin\FormController@uploadForm')->name('upload.form');
    Route::resource('campus', 'Admin\CampusController');
    Route::get('/download/submitted/campus/form/{filename}/{campus}', 'Admin\DownloadCampusSubmittedFormController@getFile')
                      ->name('download.campus.submitted.form');

    Route::get('/admin/download/{file}' , 'Admin\FormController@downloadForm')->name('download-admin.submitted.form');
    Route::resource('sms', 'Admin\SMSController');
    Route::resource('email', 'Admin\EmailController');
    Route::resource('report', 'Admin\ReportController');
  });


Route::group(['prefix' => 'campus'] , function () {
	  Route::get('/', 'Campus\DashboardController@index')->name('campus.dashboard');
  	Route::get('dashboard', 'Campus\DashboardController@index')->name('campus.dashboard');
  	Route::get('login', 'Auth\CampusLoginController@login')->name('campus.auth.login');
  	Route::post('login', 'Auth\CampusLoginController@loginCampus')->name('campus.auth.loginCampus');
    Route::get('register', 'Campus\CampusRegisterController@create')->name('campus.auth.register');
    Route::post('register', 'Campus\CampusRegisterController@store')->name('campus.register.submit');
  	Route::post('logout', 'Auth\CampusLoginController@logout')->name('campus.auth.logout');
    Route::get('account/setting', 'Campus\EditProfileController@edit')->name('campus.account.setting');
    Route::put('account/setting', 'Campus\EditProfileController@update')->name('campus.account.setting.update');

    Route::get('/download/{file}', 'Campus\DownloadFormController@getFile')->name('download.file');
    Route::get('/download/uploaded/{form}', 'Campus\DownloadFormController@getUploadedFile')->name('download.uploaded-file');


    Route::post('campus-form-upload/{formId}', 'Campus\SubmitFormController@upload')->name('campus-form-upload');
    Route::resource('campus-form', 'Campus\SubmitFormController');
    Route::get('pending/forms/{formId}', 'Campus\PendingFormsController@show')->name('campus-pending-forms.show');
});

Route::group(['prefix' => 'president'] , function () {
	  Route::get('/', 'President\DashboardController@index')->name('president.dashboard');
  	Route::get('dashboard', 'President\DashboardController@index')->name('president.dashboard');
  	Route::get('login', 'Auth\PresidentLoginController@login')->name('president.auth.login');
  	Route::post('login', 'Auth\PresidentLoginController@loginPresident')->name('president.auth.loginPresident');
  	Route::post('logout', 'Auth\PresidentLoginController@logout')->name('president.auth.logout');
    Route::get('/profile/update', 'President\ProfileController@edit')->name('president.profile.edit');
    Route::put('/profile/update', 'President\ProfileController@update')->name('president.profile.update');

    Route::get('/form/pending/preview/{campusId}/{formId}', 'President\FormController@show')->name('president-view.form');
});


