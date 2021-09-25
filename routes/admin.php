<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;

//首页
Route::post('/', function () {
    return 'hello admin';
});

//登录
Route::post('/login', [LoginController::class, 'login']);

//文章列表
Route::post('article', [ArticleController::class, 'create']);
Route::delete('articles/{id}', [ArticleController::class, 'delete']);
Route::put('articles/{id}', [ArticleController::class, 'update']);
Route::get('articles', [ArticleController::class, 'articles']);

//标签列表
Route::post('tag/create', [TagController::class, 'create']);
Route::delete('tags/{id}', [TagController::class, 'delete']);
Route::put('tags/{id}', [TagController::class, 'update']);
Route::get('tags', [TagController::class, 'tags']);




//修改标签

//删除标签

//分类列表

//添加分类

//编辑分类

//删除分类

