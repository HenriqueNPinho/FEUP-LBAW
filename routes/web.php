<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;



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
Route::get('/', 'HomepageController@index')->name("home");
Route::get('/home','HomepageController@index');

Route::get('projects', 'ProjectController@list')->name('projects')->middleware('verified');;
Route::get('project/{id}', 'ProjectController@show')->middleware('verified');;
Route::get('project/{project_id}/search/','ProjectController@taskSearch')->middleware('verified');;
Route::post('api/task/updateStatus/{id}', 'TaskController@updateStatus')->middleware('verified');;
Route::put('api/task/{project_id}','TaskController@create')->middleware('verified');;
Route::get('api/task/{task_id}','TaskController@get')->middleware('verified');;
Route::post('api/task/{task_id}','TaskController@edit')->middleware('verified');;
Route::delete('api/task/{task_id}','TaskController@delete')->middleware('verified');;
Route::put('api/task/{task_id}/addComment','TaskController@addComment')->middleware('verified');;
Route::get('api/user/notifications','UserController@getNotifications')->middleware('verified');;
Route::post('api/user/projectInvite','UserController@inviteResponse')->middleware('verified');;
Route::put('api/project/create','ProjectController@create')->middleware('verified');;
Route::post('api/user/removeFavorite/{project_id}','UserController@removeFavorite')->middleware('verified');;
Route::post('api/user/addFavorite/{project_id}','UserController@addFavorite')->middleware('verified');;
Route::post('api/project/archive/{project_id}','ProjectController@archive')->middleware('verified');;
Route::get('api/user/notifications/{project_id}','UserController@notifications')->middleware('verified');;

// Forum
Route::get('project/{project_id}/forum','ForumPostController@getProjectForum')->middleware('verified');;
Route::put('project/{project_id}/forum','ForumPostController@create')->middleware('verified');;
Route::post('project/forum/{post_id}','ForumPostController@edit')->middleware('verified');;
Route::delete('project/forum/{post_id}','ForumPostController@delete')->middleware('verified');;

//Project Settings
Route::get('project/{project_id}/settings','ProjectController@getSettings')->middleware('verified');;
Route::post('project/{project_id}/removeMember','ProjectController@removeMember')->middleware('verified');;
Route::post('project/{project_id}/addCoordinator','ProjectController@addCoordinator')->middleware('verified');;
Route::post('project/{project_id}/addMember','ProjectController@addMember')->middleware('verified');;
Route::post('project/{project_id}/archive','ProjectController@archive')->middleware('verified');;
Route::post('user/{project_id}/leave','UserController@leaveProject')->middleware('verified');;

//User Page
Route::get('project/userpage/{user_id}','UserController@showCoworkerPage')->middleware('verified');;
Route::get('userpage', 'UserController@showProfile')->name('userpage')->middleware('verified');;
Route::get('edituserpage', 'UserController@edit')->middleware('verified');;

//Edit User Page
Route::post('userpage', 'UserController@userpageUpdate')->name('edituserpage')->middleware('verified');;
Route::get('deleteuser', 'UserController@delete')->name('deleteuser')->middleware('verified');;
Route::get('api/user/deleteUserPhoto', 'UserController@deletePhoto')->name('deleteUserPhoto')->middleware('verified');;

//Change Password
Route::get('changePassword', 'UserController@showChangePassword')->middleware('verified');;
Route::post('changePassword', 'UserController@store')->name('changePassword')->middleware('verified');;

Route::get('create-project', 'ProjectController@getCreateProject')->middleware('verified');;

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


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');