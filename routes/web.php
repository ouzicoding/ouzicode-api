<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


//访问后台
Auth::routes();
Route::get('admin', 'Admin\IndexController@index');


//搜索
Route::post('search','Home\IndexController@search');
//访问首页
Route::get('/{param?}', 'Home\IndexController@index');

Route::get('cate/{cate_id?}', 'Home\IndexController@cate');
Route::get('tag/{tag_id?}', 'Home\IndexController@tag');


/**
 * 前端
 **/
//侧边栏
Route::get('home/header', 'Home\IndexController@header');
Route::get('home/sidebar', 'Home\IndexController@sidebar');
Route::get('home/footer', 'Home\IndexController@footer');
Route::get('home/article/index/{id}/{scroll_height?}', 'Home\ArticleController@index');


//后台文章
Route::get('admin/article/index', 'Admin\ArticleController@index');
Route::get('article/add', 'Admin\ArticleController@add');
Route::get('article/edit/{id}', 'Admin\ArticleController@edit');
Route::get('article/del/{id}', 'Admin\ArticleController@del');
Route::post('article/add_data', 'Admin\ArticleController@addData');
Route::post('article/edit_data/{id}', 'Admin\ArticleController@editData');
Route::post('md/upload_image', 'Admin\ArticleController@upload_image');
//Route::any('article/upload_image', 'Admin\ArticleController@upload_image');
//分类
Route::get('admin/cate/index', 'Admin\CategoryController@index');
Route::match(['get','post'],'category/add', 'Admin\CategoryController@add');
Route::match(['get','post'],'category/edit/{id}', 'Admin\CategoryController@edit');
Route::get('category/del/{id}', 'Admin\CategoryController@del');

//标签
Route::get('admin/tag/index', 'Admin\TagController@index');
Route::any('tag/add', 'Admin\TagController@add');
Route::any('tag/edit/{id}', 'Admin\TagController@edit');
Route::get('tag/del/{id}', 'Admin\TagController@del');

//评论
Route::post('api/comment/add_comment', 'Api\CommentController@add_comment');
Route::get('api/comment/comment_list/{article_id}', 'Api\CommentController@comment_list');
Route::post('api/comment/del_comment/{id}/', 'Api\CommentController@del_comment');

//github登录
Route::get('login/github/{login_before}', 'Home\LoginController@github');
Route::get('login/github_callback', 'Home\LoginController@github_callback');
Route::get('login/out_login', 'Home\LoginController@out_login');
Route::get('user/user_info', 'Api\UserController@user_info');

