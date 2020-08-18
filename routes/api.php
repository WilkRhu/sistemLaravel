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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

//=========================Rota Loja API=================//
        Route::get("/loja", "lojaController@index");
        Route::get("/loja/{id}", "lojaController@show");
        Route::post("/loja", "lojaController@store");
        Route::put("/loja/{id}", "lojaController@update");
        Route::delete("/loja/{id}", "lojaController@destroy");
//=============================================================//
