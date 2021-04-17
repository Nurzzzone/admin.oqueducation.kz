<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Auth\LoginController;
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

// Route::group(['middleware' => ['auth']], function() 
// {
  Route::resource('/','Admin\DashboardController', [
    'only' => ['index']
  ]);

  Route::resource('/teachers','Admin\TeachersController');
  Route::resource('/students','Admin\StudentsController');
  Route::resource('/classes','Admin\ClassesController');
  Route::resource('/classes-free','Admin\FreeClassesController');
  Route::resource('/tests','Admin\TestsController');


// });


// locale Route
Route::get('lang/{locale}','LanguageController@swap');

Route::get('/login', [LoginController::class, 'login'])->name('admin.login');
Route::post('/', [LoginController::class, 'logout'])->name('admin.logout');

Auth::routes();