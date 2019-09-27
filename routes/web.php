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

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');
Route::get('/approval', 'HomeController@approval')->name('approval');
Route::get('/terms', 'HomeController@terms')->name('terms');
Route::get('/privacy', 'HomeController@privacy')->name('privacy');

Route::get('/diary', 'DiaryController@index')->name('diary.index');
Route::get('/diary/create', 'DiaryController@create')->name('diary.create');
Route::post('/diary/create', 'DiaryController@postCreate');
Route::get('/diary/{id}', 'DiaryController@view')->name('diary.view');
Route::get('/diary/{id}/create', 'DiaryController@createEvent')->name('diary.createEvent');
Route::post('/diary/{id}/create', 'DiaryController@postCreateEvent');

Route::get('/diary-tag/{id}', 'DiaryTagController@view');
Route::delete('/diary-tag/{id}', 'DiaryTagController@delete');

Route::get('/tags', 'TagController@index')->name('tag.index');
Route::get('/tags/{id}', 'TagController@view')->name('tag.view');

Route::get('/profile', 'UserProfileController@index')->name('profile.index');
Route::post('/profile', 'UserProfileController@update')->name('profile.update');

Route::post('/user/subscription', 'UserController@updateSubscription')->name('user.updateSubscription');
Route::get('/user/subscription/test', 'UserController@testSubscription')->name('user.testSubscription');
Route::get('/user/reports/weekly', 'UserController@reportsWeekly')->name('user.reportsWeekly');

Route::get('/goals', 'GoalController@index')->name('goals.index');

Route::get('/integrate', 'IntegrateController@index')->name('integrate.index');

Route::get('/admin', 'AdminController@index')->name('admin.index');
Route::post('/admin', 'AdminController@update')->name('admin.update');
