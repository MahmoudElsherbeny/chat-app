<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'chat_app\HomeController@index')->middleware(['auth', 'verified'])->name('home');
Route::get('/chat', 'chat_app\HomeController@chat_start')->middleware(['auth', 'verified'])->name('chat_start');

//friends routes
Route::group(['middleware'=>['auth','verified'], 'prefix'=>'friends', 'as'=>'friends.'] , function() {

    Route::get('/requests','chat_app\FriendsController@requests')->name('requests');
    Route::get('/{type}','chat_app\FriendsController@index')->name('index');
    Route::post('/{user_id}/add','chat_app\FriendsController@add')->name('add');
    Route::post('/{user_id}/block','chat_app\FriendsController@block')->name('block');
    Route::post('/{user_id}/unblock','chat_app\FriendsController@unblock')->name('unblock');
    Route::post('/requests/{id}/accept','chat_app\FriendsController@accept')->name('accept');
    Route::post('/requests/{id}/delete','chat_app\FriendsController@delete')->name('delete');

});

//profile routes
Route::group(['middleware'=>['auth','verified'], 'prefix'=>'profile', 'as'=>'profile.'] , function() {

    Route::get('/{id}/{name}','chat_app\ProfileController@edit')->name('edit');
    Route::post('/{id}/{name}','chat_app\ProfileController@update')->name('update');

});

//chat routes
Route::group(['middleware'=>['auth','verified'], 'prefix'=>'chat', 'as'=>'chat.'] , function() {

    Route::get('/{user_id}','chat_app\ConversationController@conversation')->name('conversation');
    Route::post('/{user_id}','chat_app\ConversationController@send')->name('send');

});

Auth::routes(['verify' => true]);