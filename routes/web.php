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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'DashboardController@index');

Auth::routes();

Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
Route::get('/test', 'DashboardController@test');

// Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    Route::get('/get-all-user', 'UserController@getAllUser');
});
