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

Route::get('/', 'HomeController@index')->name('home');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home');

//User
Route::get('/user/index','UserController@index');
Route::get('/user/create','UserController@create');
Route::post('/user/store','UserController@store');
Route::get('/user/changePassword','UserController@changePassword');
Route::post('/user/updatePassword','UserController@updatePassword');
Route::get('/user/details/{id}','UserController@details');
Route::post('/user/lock/{id}', 'UserController@lock');
Route::get('/user/changeUserPassword/{id}', 'UserController@changeUserPassword');

//Khachhang
Route::get('/customer/list', 'CustomerController@index');
Route::get('/customer/create','CustomerController@create');
Route::post('/customer/create','CustomerController@store');
Route::get('/customer/remove/{id}', 'CustomerController@destroy');
Route::get('/customer/details/{id}','CustomerController@details')->name('khachhang.details');
Route::get('/customer/edit/{id}','CustomerController@edit')->name('khachhang.edit');
Route::post('/customer/update/{id}','CustomerController@update');
Route::get('/customer/accounts','CustomerController@getAccounts');
Route::post('/customer/lock/{id}', 'CustomerController@lock');

//Order
Route::get('/order/create/{customerId?}', 'OrderController@create');
Route::get('/order/index','OrderController@index');
Route::post('/order/create','OrderController@store');
Route::get('/order/details/{orderId}','OrderController@details');
Route::post('/order/search','OrderController@search');

//Payment
Route::get('/payment/create/{customerId?}','PaymentController@create');
Route::post('/payment/store','PaymentController@store');
Route::get('payment/index','PaymentController@index');
Route::post('/payment/search','PaymentController@search');

//Product
Route::get('/product/index', 'ProductController@index');
Route::get('/product/create','ProductController@create');
Route::post('/product/create','ProductController@store');
Route::get('/product/remove/{id}', 'ProductController@destroy');
Route::get('/product/details/{id}','ProductController@details');
Route::get('/product/edit/{id}','ProductController@edit');
Route::post('/product/update/{id}','ProductController@update');
Route::post('/product/lock/{id}', 'ProductController@lock');

//Firebase
Route::get('firebase','FirebaseController@index');