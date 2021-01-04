<?php
/**
 * Created by PhpStorm.
 * User: hp-14
 * Date: 2016/11/4
 * Time: 3:17
 */

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Category;
use App\Models\Data;
use YuanChao\Editor\EndaEditor;

class ArticleController extends Controller
{
    public function index($id)
    {
//        获取分类模型
        $categories = Category::orderBy('sort')
            ->get()
            ->toArray();
//        转化为树形结构
        $categories = Data::tree($categories,'name');
//        获取文章模型
        $where = [['article.id','=',$id],['article.release','=',1]];
        if(session('user_info.is_admin') != 1){
            $where[] = ['article.access','=',1];
        }
        $article = Article::join('category','article.cate_id','=','category.id')
            ->where($where)
            ->select('keywords','digest','article.title','created_at','content',
                'article.cate_id','category.name as category_name','article.id as article_id'
            )
            ->first();
        if (empty($article)) {
            return view('errors.503');
        }
        $article = $article->toArray();
        
        $article['content'] = EndaEditor::MarkDecode($article['content']);
        $article['tag'] = ArticleTag::join('tag','article_tag.tag_id','=','tag.id')
            ->where('article_id',$id)
            ->pluck('name','id')
            ->toArray();
//        增加浏览量
        Article::where('id',$id)->increment('browse');

        return view('home.article.index',[
            'categories' => $categories,
            'article' => $article,
        ]);
    }







}