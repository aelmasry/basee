<?php

use Illuminate\Http\Request;
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

Route::group(['middleware' => ['auth:api']], function () {

    Route::get('/user/logout', 'UserController@logout');
    Route::post('/user/settings', 'UserController@settings');
    Route::post('/user', 'UserController@user');

});

Route::post('/user/register', 'UserController@register');
Route::post('/user/login', 'UserController@login');
Route::post('/forgot-password', 'UserController@sendResetLinkEmail');

Route::post('/categories', 'CategoryController@index');
Route::post('/category/{id}', 'CategoryController@show');
