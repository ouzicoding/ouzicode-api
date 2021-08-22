<?php

use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return 'hello admin';
});

//登录

Route::post('/login', [LoginController::class, 'login']);

//首页

//文章列表

//添加文章

//删除文章

//修改文章

