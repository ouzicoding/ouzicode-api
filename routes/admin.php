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
Route::post('articles', [ArticleController::class, 'articles']);
//添加文章
Route::post('article/create', [ArticleController::class, 'create']);

//删除文章
Route::post('article/delete', [ArticleController::class, 'delete']);

//修改文章
Route::post('article/edit', [ArticleController::class, 'edit']);

//标签列表
Route::post('tags', [TagController::class, 'tags']);

//添加标签
Route::post('tag/create', [TagController::class, 'create']);

//修改标签

//删除标签

//分类列表

//添加分类

//编辑分类

//删除分类

