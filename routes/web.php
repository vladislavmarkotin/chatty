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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@postStatus');

Route::post('login',[
    'uses' => 'Auth\LoginController@authenticate'
]);

Route::get('/logout', 'HomeController@LogOut');

/*
 * Search
 * */
Route::get('user/search', [
    'uses' => 'SearchController@getResults',
    'as' => 'results',
]);

/*ProfileController*/
Route::get('/user/{id}', [
    'uses' => 'ProfileController@getProfile',
    'as' => 'profile.index',
    'middleware' => ['auth']
]);

/* Edit profile */
Route::get('/user/{id}/edit', [
    'uses' => 'ProfileController@getEdit',
    'as' => 'profile.edit',
    'middleware' => ['auth']
]);

Route::post('/user/{id}/edit',[
    'uses' => 'ProfileController@postEdit',
    'middleware' => ['auth']
]);

/*
 * Friends
 */

Route::get('/friends', [
    'uses' => 'FriendsController@getIndex',
    'as' => 'friends.index',
    'middleware' => ['auth']
]);

Route::get('/friends/add/{id}', [
    'uses' => 'FriendsController@getAdd',
    'as' => 'friends.add',
    'middleware' => ['auth']
]);

/* Status */

Route::get('/timeline', [
    'uses' => 'timelineController@timeline',
    'as' => 'timeline.index',
    'middleware' => ['auth']
]);

Route::post('timeline',[
    'uses' => 'timelineController@postStatus',
    'middleware' => ['auth']
]);

Route::get('feed', [
    'uses' => 'feedController@feeds',
    'middleware' => ['auth']
]);

Route::post('feed', [
    'uses' => 'feedController@postStatus',
    'middleware' => ['auth']
]);

Route::post('timeline/reply/{parent_id}', [
    'uses' => '\App\Http\Controllers\timelineController@postReply',
    'as' => 'status.reply',
    'middleware' => ['auth']
]);

/* Reply status */

Route::post('/user/{id}', [
    'uses' => '\App\Http\Controllers\ReplyController@postReply',
    'middleware' => ['auth']
]);

