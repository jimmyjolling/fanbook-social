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

Route::get('/', function () {
    if(auth::check()) {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('login');
    }
});

Auth::routes();

//Profile management
Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
Route::get('/profile/{id}', 'ProfileController@show')->name('profile');
Route::post('/profile/update/{id}', 'ProfileController@update')->name('profile.update');
Route::post('/profile/follow/{followed_id}/by/{follower_id}', 'ProfileController@followProfile')->name('profile.follow');
Route::post('/profile/unfollow/{followed_id}/by/{follower_id}', 'ProfileController@unfollowProfile')->name('profile.unfollow');
Route::post('/profile/search', 'ProfileController@search')->name('profile.search');

//Posts
Route::get('/post/my-posts/{id}', 'PostController@myPosts')->name('post.mine');
Route::post('/post/create', 'PostController@createPost')->name('post.create');
Route::post('/post/edit', 'PostController@editPost')->name('post.edit');
Route::post('/post/delete', 'PostController@deletePost')->name('post.delete');
Route::post('/post/like/{liked_id}/by/{liker_id}', 'PostController@like')->name('post.like');
Route::post('/post/unlike/{liked_id}/by/{liker_id}', 'PostController@unlike')->name('post.unlike');

//comments
Route::get('/post/{id}', 'CommentController@show')->name('comments.show');
Route::post('/post/comments', 'CommentController@store')->name('comments.store');
Route::post('/post/comments/edit', 'CommentController@edit')->name('comments.edit');
Route::post('/post/comments/delete', 'CommentController@delete')->name('comments.delete');

//Social media logins
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');