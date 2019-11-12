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
//=============Cart option==================
//for single post
Route::get('/book/{slug}','PostDetailsController@details')->name('post.details');
//To show all of the post in one page
Route::get('/books','PostDetailsController@index')->name('post.index');
Route::get('/book/category/{slug}','PostDetailsController@bookCategory')->name('book.category');

//To show category wise post
Route::get('/category/{slug}','PostDetailsController@CategoryPost')->name('category.posts');
//To show tag wise post
Route::get('/tag/{slug}','PostDetailsController@tagPost')->name('tag.posts');
//search option
Route::get('/books/search','SearchController@bookSearch')->name('books.search');
Route::get('/blogs/search','SearchController@blogSearch')->name('blogs.search');

//===============Cart option=========================
Route::get('/cart/book/{id}','CartController@store')->name('cart.store');
Route::get('/cart','CartController@index')->name('cart.index');
Route::get('/cart/{id}','CartController@destroy')->name('cart.destroy');
Route::get('clear/cart','CartController@clear')->name('cart.clear');
Route::get('/cart/single/update/{id}','CartController@SingleProductUpdate')->name('cart.single.update');
Route::get('checkout/cart','CartController@checkout')->name('cart.checkout');
Route::get('cart/invoice/{id}','CartController@generateInvoice')->name('cart.invoice');





//Contact us
Route::get('/contact-us','ContactMessageController@ContactForm')->name('contact.form');
Route::post('/store','ContactMessageController@store')->name('contact.store');

Route::group(['prefix'=>'blog','namespace'=>'blog'], function () {

    route::get('/posts','BlogController@index')->name('blog.index');
    route::get('/post/{slug}','BlogController@singleblog')->name('blog.singleblog');
    route::get('/create','BlogController@create')->name('blog.create');
    route::post('/store','BlogController@store')->name('blog.store');
    Route::post('comment/store/{id}','BlogController@commentstore')->name('blog.commentstore');




});






Auth::routes(['verify'=>true]);

//Route::get('/home', 'HomeController@index')->name('home');

Route::post('/subscriber','SubscriberController@store')->name('subscriber.store');

// ==========Authenticated user group====================


Route::group(['middleware'=> ['auth']], function (){
   Route::post('/favourite/{id}/add','FavouriteController@add')->name('post.favourite');
   Route::post('/comment/{post}','CommentController@store')->name('comment.store');
   Route::post('/rating','CommentController@rating')->name('rating');

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
    Route::get('/index','ContactMessageController@index')->name('contact.index');
    Route::get('/contact/reply/{id}','ContactMessageController@reply')->name('contact.reply');
    Route::post('/reply/message/{id}','ContactMessageController@ReplyMessage')->name('contact.ReplyMessage');


    Route::delete('/destroy/{id}','ContactMessageController@destroy')->name('contact.destroy');



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