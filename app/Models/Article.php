<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
//    指定表名
    protected $table = 'article';
//    设置时间戳
    public $timestamps = true;
    protected $dateFormat = 'U';
//    批量赋值 黑名单
    protected $guarded = [];

//    取出时间戳


    /**
     * 首页文章列表
     * @return object
     */
    public static function getArticleList($map=[])
    {
//        获取文章模型
        $where = [['article.release','=',1]];
        if(session('user_info.is_admin')!=1){
            $where[] = ['article.access','=',1];
        }

        $articles = Article::join('category','article.cate_id','=','category.id')
            ->join('article_tag','article.id','=','article_tag.article_id')
            ->orderBy('article.created_at','desc')
            ->where($where);
        if (!empty($map)) {
            $articles = $articles->whereIn($map['name'],$map['value']);
        }

        $articles = $articles->select('article.id','article.title','article.digest','article.thumb','article.created_at',
                'article.cate_id','category.name as category_name'
            )
            ->groupBy('article.id')
            ->paginate(8);
//        追加文章的标签
        foreach ($articles as $article) {
            $article->tags = ArticleTag::join('tag','article_tag.tag_id','=','tag.id')
                ->where('article_id',$article->id)
                ->pluck('name','id');
        }

        return $articles;
    }

}