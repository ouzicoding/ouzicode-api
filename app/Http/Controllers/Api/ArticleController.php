<?php

use Illuminate\Http\Request;

class ArticleController extends ApiBaseController
{


    /**
     * 获取文章列表
     */
    public function getList()
    {

        return response()->json();

    }


    /**
     * 获取文章详情
     */
    public function find(Request $request)
    {

        return response()->json();

    }





}
