<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/api', function (Request $request) {
    return $request->user();
});

Route::post('auth/login', 'AuthController@actionLogin');
Route::post('auth/logout', 'AuthController@actionLogout');
Route::post('auth/register', 'AuthController@actionRegister');
Route::post('auth/verify', 'AuthController@actionVerify');
Route::post('auth/profile', 'AuthController@actionGetUserProfile');