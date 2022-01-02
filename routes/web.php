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
// Home
Route::get('/', 'HomepageController@index')->name("homepage");


Route::get('projects', 'ProjectController@list');
Route::get('project/{id}', 'ProjectController@show');
Route::get('project/{project_id}/search/','ProjectController@taskSearch');

// API
Route::post('api/task/updateStatus/{id}', 'TaskController@updateStatus');
Route::put('api/task/{project_id}','TaskController@create');
Route::get('api/task/{task_id}','TaskController@get');
Route::post('api/task/{task_id}','TaskController@edit');
Route::delete('api/task/{task_id}','TaskController@delete');
Route::get('api/user/notifications','UserController@getNotifications');


// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

//User Page
Route::get('userpage', 'UserController@showProfile')->name('userpage');
Route::get('edituserpage', 'UserController@edit');

//Edit User Page
Route::post('userpage', 'UserController@userpageUpdate')->name('edituserpage');
Route::get('deleteuser', 'UserController@delete')->name('deleteuser');
Route::get('deleteUserPhoto', 'UserController@deletePhoto')->name('deleteUserPhoto');

Route::get('create-project', 'ProjectController@createproject');
