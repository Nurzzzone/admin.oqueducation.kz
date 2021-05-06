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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['middleware' => 'api', 'prefix' => 'v1'], function() {
    Route::group(['prefix' => 'auth'], function () {
      Route::post('/login', 'Api\V1\AuthController@login');
      Route::get('/logout', 'Api\V1\AuthController@logout');
    });

    Route::group(['middleware' => 'jwt'], function() {
      // admin.nghrdc.kz/api/user
      Route::get('/user', 'Api\V1\AuthController@user');

      // admin.oqu.kz/api/v1/students -> get all students
      Route::get('/students', 'Api\V1\StudentsController@index');

      // admin.oqu.kz/api/v1/students/register -> register new student
      Route::post('/students/register', 'Api\V1\StudentsController@register');

      // admin.oqu.kz/api/v1/teachers -> get all students
      Route::get('/teachers', 'Api\V1\TeachersController@index');
    });

    // admin.oqu.kz/api/v1/teachers/login
    Route::post('/teachers/login', 'Api\V1\TeachersAuthController@login');

    // admin.oqu.kz/api/v1/teachers/logout
    Route::post('/teachers/logout', 'Api\V1\TeachersAuthController@logout');

    // admin.oqu.kz/api/v1/students/login
    Route::post('/students/login', 'Api\V1\StudentsAuthController@login');

    // admin.oqu.kz/api/v1/students/logout
    Route::post('/students/logout', 'Api\V1\StudentsAuthController@logout');

    Route::group(['middleware' => 'jwt.auth:student'], function() {
      Route::apiResource('/students', 'Api\V1\StudentsController', ['only' => ['show', 'destroy', 'update']]);
      Route::post('/students/reset', 'Api\V1\StudentsController@reset'); // *
    });

    Route::group(['middleware' => 'jwt.auth:teacher'], function() {
      Route::apiResource('/teachers', 'Api\V1\TeachersController', ['only' => ['show', 'update']]);
      Route::post('/teachers/reset', 'Api\V1\TeachersController@reset'); // *
    });
});