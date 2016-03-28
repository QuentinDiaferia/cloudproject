<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['middleware' => 'web', function () {
    return view('welcome');
}]);

Route::get('dashboard', ['middleware' => ['web', 'auth'], function () {
	return view('dashboard');
}]);

Route::get('creategroup', 'GroupController@getForm');
Route::post('creategroup', 'GroupController@postForm');

Route::get('group/{n}', 'MemberController@getForm')->where('n', '[0-9]+');
Route::post('group/{n}', 'MemberController@postForm')->where('n', '[0-9]+');

Route::post('group/{n}/upload', 'DropzoneController@uploadFile')->where('n', '[0-9]+');
Route::get('group/{n}/download/{file}', 'DropzoneController@downloadFile')->where('n', '[0-9]+');
Route::get('group/{n}/delete/{file}', 'DropzoneController@deleteFile')->where('n', '[0-9]+');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
