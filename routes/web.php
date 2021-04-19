<?php

use Illuminate\Support\Facades\Auth;
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

Route::group(['middleware' => ['auth']], function() 
{
  Route::resource('/','Admin\DashboardController', [
    'only' => ['index']
  ]);

  Route::resource('/teachers',    'Admin\TeachersController');
  Route::resource('/students',    'Admin\StudentsController');
  Route::resource('/classes',     'Admin\ClassesController');
  Route::resource('/classes-free','Admin\FreeClassesController');
  Route::resource('/tests',       'Admin\TestsController');

});


// locale Route
Route::get('lang/{locale}','LanguageController@swap');

Route::get('/login',  'Auth\LoginController@login')->name('login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Auth::routes();