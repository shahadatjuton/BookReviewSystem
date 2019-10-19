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

use Illuminate\Support\Facades\Auth;

Route::get('/','HomeController@index')->name('home');
//for single post
Route::get('/post/{slug}','PostDetailsController@details')->name('post.details');
//To show all of the post in one page
Route::get('/posts','PostDetailsController@index')->name('post.index');
//To show category wise post
Route::get('/category/{slug}','PostDetailsController@CategoryPost')->name('category.posts');
//To show tag wise post
Route::get('/tag/{slug}','PostDetailsController@tagPost')->name('tag.posts');




Auth::routes(['verify'=>true]);

//Route::get('/home', 'HomeController@index')->name('home');

Route::post('/subscriber','SubscriberController@store')->name('subscriber.store');

// ==========Authenticated user group====================


Route::group(['middleware'=> ['auth']], function (){
   Route::post('/favourite/{id}/add','FavouriteController@add')->name('post.favourite');
   Route::post('/comment/{post}','CommentController@store')->name('comment.store');
});

// ==========Admin group====================

Route::group(['as'=>'admin.','prefix'=>'admin', 'namespace'=>'admin', 'middleware'=>['auth','admin' ] ], function (){

    Route::get('/dashboard','DashboardController@index')->name('dashboard');
    Route::resource('/tag','TagController');
    Route::resource('/category','CategoryController');
    Route::resource('/user','UserController');
    Route::resource('/post','PostController');
    Route::resource('/settings','SettingsController');
    Route::put('/settings/{id}/change','SettingsController@pswupdate')->name('password.change');


    Route::get('/favourite/post','FavouriteController@index')->name('post.favourite');

    Route::get('/comments','CommentController@index')->name('comment.index');
    Route::post('/comments/{id}','CommentController@destroy')->name('comment.destroy');

    Route::get('/pending/post','PostController@pending')->name('post.pending');
    Route::put('/post/{id}/approve','PostController@approve')->name('post.approve');

    Route::resource('/subscriber','SubscriberController');


});


// ==========Publisher group====================

Route::group(['as'=>'publisher.','prefix'=>'publisher', 'namespace'=>'publisher', 'middleware'=>['auth','publisher' ] ], function (){

    Route::get('/dashboard','DashboardController@index')->name('dashboard');
    Route::resource('/post','PostController');
    Route::resource('/settings','SettingsController');
    Route::put('/settings/{id}/change','SettingsController@pswupdate')->name('password.change');


    Route::get('/favourite/post','FavouriteController@index')->name('post.favourite');

    Route::get('/comments','CommentController@index')->name('comment.index');
    Route::post('/comments/{id}','CommentController@destroy')->name('comment.destroy');



});
// ==========Author group====================

Route::group(['as'=>'author.','prefix'=>'author', 'namespace'=>'author', 'middleware'=>['auth','author' ] ], function (){

    Route::get('/dashboard','DashboardController@index')->name('dashboard');
    Route::resource('/post','PostController');
    Route::resource('/settings','SettingsController');
    Route::put('/settings/{id}/change','SettingsController@pswupdate')->name('password.change');


});


// ==========user group====================

Route::group(['as'=>'user.','prefix'=>'user', 'namespace'=>'user', 'middleware'=>['auth','user' ] ], function (){

    Route::get('/dashboard','DashboardController@index')->name('dashboard');


});