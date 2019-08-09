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

Route::get('/', 'Auth\LoginController@showLoginForm')->name('home.guest');

Route::get('/dashboard', 'HomeController@index')->name('home');

Route::get('/home', function() {
    return 'huli ka';
});

Route::resources([
    'payroll' => 'PayrollController',
    'employee' => 'EmployeeController',
    'branch' => 'BranchController'
]);

Route::post('/branch/try', 'BranchController@try');
Route::post('/employee/upload', function() {
    return 'file has been uploaded';
})->name('employee.upload');

// Route::group(['prefix' => 'payroll'], function () {
//     Route::get('/', 'PayrollController@index')->name('payroll.index');
//     Route::get('/create', 'PayrollController@create')->name('payroll.create');
//     Route::post('/store', 'PayrollController@store')->name('payroll.store');
// });

// Route::group(['prefix' => 'employee'], function () {
//     Route::get('/', 'EmployeeController@index')->name('employee.index');
//     Route::get('/create', 'EmployeeController@create')->name('employee.create');
//     Route::get('/edit', 'EmployeeController@edit')->name('employee.edit');
//     Route::post('/store', 'EmployeeController@store')->name('employee.store');
// });
