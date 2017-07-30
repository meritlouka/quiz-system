<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin', function () {
    return view('admin.admin');
	});

	Route::get('/settings', function () {
	    return view('admin.settings');
	});

	Route::get('/addAdmin', function () {
	    return view('settings.register_admin');
	});
	Route::post('/addAdmin', 'AdminController@store');


	Route::get('/changePassword', function () {
	    return view('settings.change_password');
	});
	Route::post('/changePassword', 'AdminController@changePassword');

	Route::get('/deleteMyAccount',  'AdminController@deleteMyAccount');
	Route::get('/resetAllTables',  'AdminController@resetAllTables');
    

  // Route::resource('questions', 'QuestionController');

    Route::get('/questions',  'QuestionController@index');
    Route::post('/questions',  'QuestionController@store');
    Route::get('/questions/createTrueFalse',  'QuestionController@createTrueFalse');
    Route::get('/questions/createMultiChoice',  'QuestionController@createMultiChoice');
    Route::get('/questions/{questions} ',  'QuestionController@show');
    Route::put('/questions/{questions}',  'QuestionController@update');
    Route::delete('/questions/{questions}',  'QuestionController@destory');
    Route::get('/questions/{questions}/edit',  'QuestionController@edit');
  
 
});
	


Route::get('/', function () {
	    return view('home');
	});
Route::auth();
Route::get('/home', 'HomeController@index');
