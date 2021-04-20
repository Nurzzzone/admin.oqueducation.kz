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

      // admin.oqu.kz/api/v1/team-members 
      Route::apiResource('/students', 'Api\V1\StudentsController');
      // Route::post('/students', 'Api\V1\StudentsController@store');
    });
});