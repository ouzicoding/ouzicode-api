<?php

use Illuminate\Http\Request;

class ArticleController extends ApiBaseController
{


    /**
     * 获取文章列表
     */
    public function getList()
    {
        $where = [
            ['is_deleted', '=', 0]
        ];
        $articles = Article::where($where)
            ->get();

        return response()->json();

    }


    /**
     * 获取文章详情
     */
    public function find(Request $request, $id)
    {
        $article = Article::get($id);


        return response()->json();
    }


}
