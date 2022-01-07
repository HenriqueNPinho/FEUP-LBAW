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

Route::get('projects', 'ProjectController@list')->name('projects');
Route::get('project/{id}', 'ProjectController@show');
Route::get('project/{project_id}/search/','ProjectController@taskSearch');

// API
Route::post('api/task/updateStatus/{id}', 'TaskController@updateStatus');
Route::put('api/task/{project_id}','TaskController@create');
Route::get('api/task/{task_id}','TaskController@get');
Route::post('api/task/{task_id}','TaskController@edit');
Route::delete('api/task/{task_id}','TaskController@delete');
Route::get('api/user/notifications','UserController@getNotifications');
Route::post('api/user/projectInvite','UserController@inviteResponse');
Route::put('api/project/create','ProjectController@create');
Route::post('api/user/removeFavorite/{project_id}','UserController@removeFavorite');
Route::post('api/user/addFavorite/{project_id}','UserController@addFavorite');
Route::post('api/project/archive/{project_id}','ProjectController@archive');

// Forum
Route::get('project/{project_id}/forum','ForumPostController@getProjectForum');
Route::post('project/{project_id}/forum','ForumPostController@create');
Route::put('project/{project_id}/forum','ForumPostController@edit');
Route::delete('project/{project_id}/forum','ForumPostController@delete');

//User Page
Route::get('userpage', 'UserController@showProfile')->name('userpage');
Route::get('edituserpage', 'UserController@edit');

//Edit User Page
Route::post('userpage', 'UserController@userpageUpdate')->name('edituserpage');
Route::get('deleteuser', 'UserController@delete')->name('deleteuser');
Route::get('api/user/deleteUserPhoto', 'UserController@deletePhoto')->name('deleteUserPhoto');

//Change Password
Route::get('changePassword', 'UserController@showChangePassword');
Route::post('changePassword', 'UserController@store')->name('changePassword');

Route::get('create-project', 'ProjectController@getCreateProject');


// ******************************************** 
// AUTHENTICATION

// ==============================================
// Authentication -> User
//register
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

//login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

//logout
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// ==============================================
// Authentication -> Administrator
// register
Route::get('registerAdministrator', 'Auth\RegisterAdminController@showRegistrationForm')->name('registerAdmin');
Route::post('registerAdministrator', 'Auth\RegisterAdminController@register');

//login
Route::get('logout', 'Auth\LoginAdminController@showLoginForm')->name('logout');
Route::post('loginAdmin', 'Auth\LoginAdminController@login')->name('loginAdmin');

//logout
Route::get('logout', 'Auth\LoginAdminController@logout')->name('logout');

// ==============================================
// ******************************************** 
//Admin Home

Route::get('home', 'AdminHomepageController@index');
