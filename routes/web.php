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

//Khachhang
Route::get('/khachhang/list', 'CustomerController@index');
Route::get('/khachhang/create','CustomerController@create');
Route::post('/khachhang/create','CustomerController@store');
Route::get('/khachhang/remove/{id}', 'CustomerController@destroy');
Route::get('/khachhang/details/{id}','CustomerController@details')->name('khachhang.details');
Route::get('/khachhang/edit/{id}','CustomerController@edit')->name('khachhang.edit');
Route::post('/khachhang/update/{id}','CustomerController@update');
Route::get('/khachhang/accounts','CustomerController@getAccounts');

//Order
Route::get('/order/create/{customerId?}', 'OrderController@create');
Route::get('/order/index','OrderController@index');
Route::post('/order/create','OrderController@store');