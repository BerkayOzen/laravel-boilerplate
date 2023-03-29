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

Route::group(['namespace' => 'Api'], function (){
    Route::group(['prefix' => 'auth'],function (){
        Route::post('register', 'AuthController@register')->name('register');
        Route::post('login', 'AuthController@login')->name('login');
    });

    Route::group(['prefix' => 'auth', 'middleware' => ['auth:api']],function (){
        Route::post('logout', 'AuthController@logout')->name('logout');
        Route::get('refresh', 'AuthController@refresh')->name('refresh');
        Route::get('me', 'UserController@me')->name('me');
        Route::get('user', 'UserController@me')->name('me');

        Route::apiResource('users', 'UserController');
    });

});
