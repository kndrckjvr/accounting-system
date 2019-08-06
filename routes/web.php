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

Route::get('/', 'Auth\LoginController@showLoginForm');


Route::group(['prefix' => 'payroll'], function () {
    Route::get('/', 'PayrollController@index')->name('home');
    Route::get('/create', 'PayrollController@create')->name('payroll.create');
    Route::post('/store', 'PayrollController@store')->name('payroll.store');
});
