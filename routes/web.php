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
Route::post('api/task/updateStatus/{id}', 'TaskController@updateStatus');
Route::put('api/task/{project_id}','TaskController@create');
Route::get('api/task/{task_id}','TaskController@get');
Route::post('api/task/{task_id}','TaskController@edit');
Route::delete('api/task/{task_id}','TaskController@delete');
Route::put('api/task/{task_id}/addComment','TaskController@addComment');
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

//Project Settings
Route::get('project/{project_id}/settings','ProjectController@getSettings');
Route::post('project/{project_id}/removeMember','ProjectController@removeMember');
Route::post('project/{project_id}/addCoordinator','ProjectController@addCoordinator');
Route::post('project/{project_id}/addMember','ProjectController@addMember');
Route::post('project/{project_id}/archive','ProjectController@archive');
Route::post('user/{project_id}/leave','UserController@leaveProject');

//User Page
Route::get('project/userpage/{user_id}','UserController@showCoworkerPage');
Route::get('userpage', 'UserController@showUserPage')->name('userpage');
Route::get('edituserpage', 'UserController@showEditUserPage');

//Edit User Page
Route::post('userpage', 'UserController@userpageUpdate')->name('edituserpage');
Route::get('deleteuser', 'UserController@delete')->name('deleteuser');
Route::get('api/user/deleteUserPhoto', 'UserController@deletePhoto')->name('deleteUserPhoto');

//Change Password
Route::get('changePassword', 'UserController@showChangePassword');
Route::post('changePassword', 'UserController@store')->name('changePassword');

Route::get('create-project', 'ProjectController@getCreateProject');

// ==============================================
// Authentication -> User
//login
Route::get('login', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login');

//register
Route::get('register', 'Auth\RegisterController@showRegistrationForm');
Route::post('register', 'Auth\RegisterController@register');

Route::get('register/admin', 'Auth\RegisterController@showAdminRegistrationForm');
Route::post('register/admin', 'Auth\RegisterController@register');

//logout
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

//adminHomePage
Route::get('adminHomePage', 'AdminController@showAdminPage');