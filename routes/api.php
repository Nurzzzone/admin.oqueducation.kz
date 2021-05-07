<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function() {
    Route::group(['prefix' => 'auth'], function () {

      // admin.oqueducation.kz/api/v1/auth/login
      Route::post('/login', 'Api\V1\AuthController@login');

      // admin.oqueducation.kz/api/v1/auth/logout
      Route::get('/logout', 'Api\V1\AuthController@logout');

      // admin.oqueducation.kz/api/v1/auth/register
      Route::post('/register', 'Api\V1\ClientAuthController@register');
    });

    Route::group(['middleware' => 'jwt'], function() {
      // admin.nghrdc.kz/api/v1/user
      Route::get('/user', 'Api\V1\AuthController@user');

      // admin.oqu.kz/api/v1/students -> get all students
      Route::get('/students', 'Api\V1\StudentsController@index');

      // admin.oqu.kz/api/v1/teachers -> get all students
      Route::get('/teachers', 'Api\V1\TeachersController@index');

      // admin.oqu.kz/api/v1/classes -> get all classes
      Route::get('/classes', 'Api\V1\ClassesController@index');
    });

    Route::group(['middleware' => 'jwt.auth:student'], function() {
      Route::apiResource('/students', 'Api\V1\StudentsController', ['only' => ['show', 'destroy', 'update']]);
    });

    Route::group(['middleware' => 'jwt.auth:teacher'], function() {
      Route::apiResource('/teachers', 'Api\V1\TeachersController', ['only' => ['show', 'update']]);
    });
});