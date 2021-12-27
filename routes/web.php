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
Route::get('/', 'HomepageController@index');

// Cards
Route::get('projects', 'ProjectController@list');
Route::get('project/{id}', 'ProjectController@show');

// API
Route::post('api/task/updateStatus/{id}', 'TaskController@updateStatus');
Route::put('api/project/{project_id}','TaskController@create');

Route::put('api/cards', 'CardController@create');
Route::delete('api/cards/{card_id}', 'CardController@delete');
Route::put('api/cards/{card_id}/', 'ItemController@create');

Route::delete('api/item/{id}', 'ItemController@delete');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

//User Page
Route::get('userpage', 'UserController@showProfile');
Route::get('edituserpage', 'UserController@edit');
Route::patch('updateuserpage', 'UserController@udpadte');