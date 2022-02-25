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
    

    Route::get('countries', 'App\Http\Controllers\CountryController@index');
    Route::get('states/{country_id}', 'App\Http\Controllers\StateController@index');
    Route::get('cities/{state_id}', 'App\Http\Controllers\CityController@index');
    Route::group([
      'middleware' => 'auth:api',
      'prefix' => ''
    ], function() { // AQUI ESTARAN TODAS LAS RUTAS QUE SI NECESTAN AUTENTICACION
        Route::get('logout', 'App\Http\Controllers\UserController@logout');
        Route::get('users', 'App\Http\Controllers\UserController@allUsers');
        Route::resource('emails', 'App\Http\Controllers\EmailController');
    });
});
