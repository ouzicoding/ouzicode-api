<?php
namespace App\Http\Controllers\Admin;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleController extends AdminBaseController
{

    /**
     * 修改文章
     */
    public function create(Request $request)
    {
        $post = $request->input();
        $articleId = Article::insertGetId($post);
        Tag::createArticleTag($articleId,$post['tags']);w
        return response()->json();
    }
    /**
     * 删除文章
     */
    public function delete($id)
    {
        Article::where('id',$id)->update(['is_deleted'=>1]);
        return response()->json();
    }
    /**
     * 修改文章
     */
    public function update(Request $request,$id)
    {
        $put = $request->input();
        Article::where('id',$id)->update($put);
        return response()->json();
    }
    /**
     * 获取文章列表
     */
    public function articles()
    {
        $list = Article::where([['is_deleted'=>0]])
            ->get();
        return response()->json($list);
    }






}
