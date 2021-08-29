<?php

use App\Http\Controllers\Admin\LoginController;
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
Route::post('article/add', [ArticleController::class, 'add']);

//删除文章
Route::post('article/delete', [ArticleController::class, 'delete']);

//修改文章
Route::post('article/edit', [ArticleController::class, 'edit']);

//标签列表

//添加标签

//修改标签

//删除标签

//分类列表

//添加分类

//编辑分类

//删除分类

