<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'DashboardController@index')->name('dashboard')->middleware(['auth','verified']);
Route::get('/status', 'DashboardController@show')->name('status')->middleware(['auth','verified']);
//Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/p/{username}', 'ProfileController@index')->name('profile');
Route::get('/p/{username}/status', 'ProfileController@show')->name('statusprofile');
Route::get('/makestatus', 'MakeStatusController@index')->name('Make Status')->middleware(['auth','verified']);
Route::get('/makestatus', 'StatusController@create')->name('makestatus')->middleware(['auth','verified']);
Route::post('/makestatus','StatusController@store')->name('sendstatus')->middleware(['auth','verified']);
Route::get('/edit/status/{username}/{id}', 'StatusController@edit')->name('editstatus')->middleware(['auth','verified']);
Route::post('/update/status/{username}/{id}', 'StatusController@update')->name('updatestatus')->middleware(['auth','verified']);
Route::post('/delete/status/{username}/{id}', 'StatusController@destroy')->name('deletestatus')->middleware(['auth','verified']);
Route::get('u/{url}', 'BioController@link')->name('link');
Route::get('/updatebio/{username}', 'BioController@edit')->name('updatebio')->middleware(['auth','verified']);
Route::post('/run/{username}', 'BioController@update')->name('updatebio_run')->middleware(['auth','verified']);
Route::post('/makebio/{username}/{id}', 'BioController@store')->name('makebio')->middleware(['auth','verified']);
Route::get('/createbio/{username}', 'BioController@create')->name('createbio')->middleware(['auth','verified']);
Route::post('/uploadphoto/{username}', 'PhotoProfileController@store')->name('uploadphoto')->middleware(['auth','verified']);
Route::post('/updatephoto/{username}/{id}', 'PhotoProfileController@update')->name('updatephoto')->middleware(['auth','verified']);
Route::post('/uploadbanner/{username}', 'BannerProfileController@store')->name('uploadbanner')->middleware(['auth','verified']);
Route::post('/updatebanner/{username}/{id}', 'BannerProfileController@update')->name('updatebanner')->middleware(['auth','verified']);
Route::post('/postphoto/{username}', 'PostPhotoController@store')->name('postphoto')->middleware(['auth','verified']);
Route::get('/follow/{id}', 'FollowController@follow')->name('followuser')->middleware(['auth','verified']);
Route::get('/unfollow/{users_id_followed}', 'FollowController@unfollow')->name('unfollowuser')->middleware(['auth','verified']);
Route::get('/chat/{username}', 'ChatController@show')->name('viewchat')->middleware(['auth','verified']);
Route::get('/chat/{username}/{id}', 'ChatController@create')->name('viewchatuser')->middleware(['auth','verified']);
Route::post('/chat/{users_id}/{id}', 'ChatController@store')->name('sendchat')->middleware(['auth','verified']);
Route::get('/search', 'SearchController@search')->name('search')->middleware(['auth','verified']);
Route::get('/settingName', 'SettingController@view')->name('setting')->middleware(['auth','verified']);
Route::get('/settingUsername', 'SettingController@show')->name('settingU')->middleware(['auth','verified']);
Route::post('/settingName', 'SettingController@updateName')->name('settingName')->middleware(['auth','verified']);
Route::post('/settingUsername', 'SettingController@updateUsername')->name('settingUsername')->middleware(['auth','verified']);
Route::post('/deletephoto/{username}/{id}', 'PostPhotoController@destroy')->name('deletephoto')->middleware(['auth','verified']);
Route::get('/settingPassword', 'SettingController@settingpassword')->name('settingP')->middleware(['auth','verified']);
Route::post('/changePassword', 'SettingController@changePassword')->name('changePassword')->middleware(['auth','verified']);



Auth::routes(['verify' => true]);

