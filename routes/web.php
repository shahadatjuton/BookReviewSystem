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

Route::get('/', function () {
    return view('welcome');
})->name('index');

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home');


// ==========Admin group====================

Route::group(['as'=>'admin.','prefix'=>'admin', 'namespace'=>'admin', 'middleware'=>['auth','admin' ] ], function (){

    Route::get('/dashboard','DashboardController@index')->name('dashboard');
    Route::resource('/tag','TagController');

});


// ==========Publisher group====================

Route::group(['as'=>'publisher.','prefix'=>'publisher', 'namespace'=>'publisher', 'middleware'=>['auth','publisher' ] ], function (){

    Route::get('/dashboard','DashboardController@index')->name('dashboard');

});
// ==========Author group====================

Route::group(['as'=>'author.','prefix'=>'author', 'namespace'=>'author', 'middleware'=>['auth','author' ] ], function (){

    Route::get('/dashboard','DashboardController@index')->name('dashboard');


});


// ==========user group====================

Route::group(['as'=>'user.','prefix'=>'user', 'namespace'=>'user', 'middleware'=>['auth','user' ] ], function (){

    Route::get('/dashboard','DashboardController@index')->name('dashboard');


});