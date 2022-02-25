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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group([
    'prefix' => ''
], function () { // AQUI ESTARAN TODAS LAS RUTAS QUE NO NECESTAN AUTENTICACION
    Route::post('signup', 'App\Http\Controllers\UserController@signUp');
    Route::post('login', 'App\Http\Controllers\UserController@login');
    Route::group([
      'middleware' => 'auth:api',
      'prefix' => ''
    ], function() { // AQUI ESTARAN TODAS LAS RUTAS QUE SI NECESTAN AUTENTICACION
        Route::get('logout', 'UserController@logout');
        Route::get('user', 'UserController@user');
    });
});
