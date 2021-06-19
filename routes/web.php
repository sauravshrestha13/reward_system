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

Route::get('/', 'Admin\OrderController@index')->name('home');
Route::post('/orders/create', 'Admin\OrderController@store')->name('home');
Route::get('/orders/complete-order', 'Admin\OrderController@completeOrder')->name('home');

Route::get('/customers', 'Admin\CustomerController@index')->name('home');
Route::get('/customers/rewards', 'Admin\CustomerController@rewards')->name('home');
Route::get('/customers/expiry-logs', 'Admin\CustomerController@expiryLogs')->name('home');


Route::get('/task-expire-rewards','TaskController@expireRewards');

