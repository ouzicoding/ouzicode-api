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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//api
Route::middleware('auth:api')->get('/article', [ArticleController::class,'getList']);
Route::middleware('auth:api')->get('/article/{id}', [ArticleController::class,'find']);

//admin
Route::middleware('auth:api')->get('/article', [ArticleController::class,'getList']);

Route::group('');

