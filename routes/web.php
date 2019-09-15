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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/approval', 'HomeController@approval')->name('approval');

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
