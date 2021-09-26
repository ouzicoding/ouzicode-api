<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;

//首页
Route::post('/', function () {
    return 'hello admin';
});

//登录
Route::post('/login', [LoginController::class, 'login']);

//文章
Route::post('article', [ArticleController::class, 'create']);
Route::delete('articles/{id}', [ArticleController::class, 'delete']);
Route::put('articles/{id}', [ArticleController::class, 'update']);
Route::get('articles', [ArticleController::class, 'articles']);

//标签
Route::post('tag', [TagController::class, 'create']);
Route::delete('tags/{id}', [TagController::class, 'delete']);
Route::put('tags/{id}', [TagController::class, 'update']);
Route::get('tags', [TagController::class, 'tags']);

//分类
Route::post('category', [CategoryController::class, 'create']);
Route::delete('categories/{id}', [CategoryController::class, 'delete']);
Route::put('categories/{id}', [CategoryController::class, 'update']);
Route::get('categories', [CategoryController::class, 'categories']);

