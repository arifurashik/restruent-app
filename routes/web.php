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


Auth::routes();

Route::get('/', 'OrdersController@index');
Route::resource('orders', 'OrdersController');
Route::get('orders/{id}/invoice', 'OrdersController@invice')->name('orders.invoice');
Route::get('/todays-records', 'RecordsController@index')->name('today-records');
Route::get('/custom-records', 'RecordsController@custom_records')->name('custom_records');

Route::resource('product-category', 'CategoryController')->except(['show']);
Route::resource('product-type', 'ProductTypeController')->except(['show']);
Route::resource('product', 'ProductController');
Route::resource('package', 'PackageController');
Route::resource('stockdetails', 'StockDetailsController')->except(['show']);
Route::resource('totalstocks', 'TotalStocksController')->except(['store', 'show', 'destroy']);
Route::get('users/{id}/password', 'UserController@managePassword')->name('users.password');
Route::patch('users/password-update/{id}', 'UserController@updatePassword')->name('users.passwordupdate');
Route::resource('users', 'UserController')->except(['show']);

Route::patch('profile/password-update/{id}', 'ProfileController@updatePassword')->name('profile.passwordupdate');
Route::resource('profile', 'ProfileController')->except(['create', 'store', 'show', 'edit', 'destroy']);
