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

Route::get('','HomeController@index')->name('home');

Route::get('/about-us','HomeController@about_us')->name('about');
//======Publisher Request

Route::get('/publisher/request','HomeController@publisherRequest')->name('request.publisher');
Route::post('/publisher/request/{id}','HomeController@publisherRequestStore')->name('request.publisher.store');




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
Route::get('/quotes/search','SearchController@quotesSearch')->name('quotes.search');


//================Quotes=========
Route::get('/quotes','CommunityController@index')->name('quote.index');



//===============Cart option=========================
Route::get('/cart/book/{id}','CartController@store')->name('cart.store');
Route::get('/cart','CartController@index')->name('cart.index');
Route::get('/cart/{id}','CartController@destroy')->name('cart.destroy');
Route::get('/clear/cart','CartController@clear')->name('cart.clear');
Route::get('/cart/single/update/{id}','CartController@SingleProductUpdate')->name('cart.single.update');
Route::get('/cart/invoice/{id}','CartController@generateInvoice')->name('cart.invoice');

Route::group(['middleware'=> ['auth']], function (){

    Route::get('/checkout/cart','CartController@checkout')->name('cart.checkout');
    Route::post('/order','CartController@order')->name('order.cart');
    Route::get('/order/transection','CartController@transection')->name('cart.transection');
    Route::post('/order/transection','CartController@transectionStore')->name('transection.store');

    Route::get('/order/stripe','CartController@stripe')->name('cart.stripe');


    Route::post('/order/successful','CartController@orderSuccess')->name('order.success');

    //Contact us ====Auth=====

    Route::post('/store','ContactMessageController@store')->name('contact.store');
//============Quote==================
    route::get('/quote/create','CommunityController@create')->name('quote.create');
    route::post('/quote/store','CommunityController@store')->name('quote.store');



});

//Contact us
Route::get('/contact-us','ContactMessageController@ContactForm')->name('contact.form');

//============Blog==================
Route::group(['prefix'=>'blog','namespace'=>'blog'], function () {

    route::get('/posts','BlogController@index')->name('blog.index');
    route::get('/post/{slug}','BlogController@singleblog')->name('blog.singleblog');
    route::get('/create','BlogController@create')->name('blog.create');
    route::post('/store','BlogController@store')->name('blog.store');
    Route::post('comment/store/{id}','BlogController@commentstore')->name('blog.commentstore');
    Route::post('reply/store/{comment}','BlogController@replystore')->name('blog.replystore');



});






Auth::routes(['verify'=>true]);

//Route::get('/home', 'HomeController@index')->name('home');

Route::post('/subscriber','SubscriberController@store')->name('subscriber.store');

// ==========Authenticated user group====================


Route::group(['middleware'=> ['auth']], function (){
    Route::post('/favourite/{id}/add','FavouriteController@add')->name('post.favourite');
    Route::post('/rating','CommentController@rating')->name('rating');
//Comment and reply
    Route::post('/comment/{post}','CommentController@store')->name('comment.store');

    //Review and reply
    Route::post('/review/{reply}','CommentController@reviewReply')->name('reviewReply.store');

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
//    ========Contact===============
    Route::get('/publisher/request','DashboardController@publisherRequest')->name('publisherRequest');
    Route::get('/request/accept/{id}','DashboardController@publisherRequestAccept')->name('publisherRequest.accept');




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
    //payment method
    Route::get('/paymentmethod/index','PaymentController@index')->name('paymentmethod.index');
    Route::get('/paymentmethod/create','PaymentController@create')->name('paymentmethod.create');
    Route::post('/paymentmethod/store','PaymentController@store')->name('paymentmethod.store');
    Route::post('/paymentmethod/destroy/{id}','PaymentController@destroy')->name('paymentmethod.destroy');

//    ========User===============

    Route::get('/weekly/user','UserController@weekly')->name('user.weekly');
    Route::get('/monthly/user','UserController@monthly')->name('user.monthly');

//    ========Post monthly & weekly ===============

    Route::get('/weekly/post','PostController@weekly')->name('post.weekly');
    Route::get('/monthly/post','PostController@monthly')->name('post.monthly');


    //    ========Subscriber monthly & weekly ===============

    Route::get('/weekly/subscriber','SubscriberController@weekly')->name('subscriber.weekly');
    Route::get('/monthly/subscriber','SubscriberController@monthly')->name('subscriber.monthly');

//    ========Quote===============

    Route::get('/Admin/Quotes','QuoteController@index')->name('quote.index');
    Route::get('/quote/show/{id}/','QuoteController@show')->name('quote.show');
    Route::get('/quote/pending','QuoteController@pending')->name('quote.pending');

    Route::put('/quote/{id}/approve','QuoteController@approve')->name('quote.approve');

//    ========Order===============

    Route::get('/Admin/orders','OrderController@index')->name('order.index');
    Route::get('/orders/show/{id}','OrderController@show')->name('order.show');
    Route::get('/order/orders','OrderController@order')->name('order.order');


//    ========reports===============

    Route::get('/report/users','DashboardController@userReport')->name('report.user');
    Route::get('/report/pending/post','DashboardController@PendingPostReport')->name('report.pending.post');
    Route::get('/report/favourite/post','DashboardController@FavouritePostReport')->name('report.favourite.post');
    Route::get('/report/subscriber/list','DashboardController@subscriberReport')->name('report.subscriber');

    Route::get('/weekly/post/report','PostController@weeklyreport')->name('report.post.weekly');
    Route::get('/monthly/post/report','PostController@monthlyreport')->name('report.post.monthly');

    Route::get('/weekly/subscriber/report','SubscriberController@weeklyreport')->name('report.subscriber.weekly');
    Route::get('/monthly/subscriber/report','SubscriberController@monthlyreport')->name('report.subscriber.monthly');



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

//    Collecting writings

    Route::get('/collectings/index','CollectingController@index')->name('collections.index');
    Route::get('/collecting/writings','CollectingController@create')->name('collections.create');
    Route::post('/store/writings','CollectingController@storeWriting')->name('collections.store');



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
    Route::resource('/settings','SettingsController');
    Route::put('/settings/{id}/change','SettingsController@pswupdate')->name('password.change');
    Route::get('/favourite/post','FavouriteController@index')->name('favourite');
    Route::get('/order/list','OrderController@order')->name('order');




});