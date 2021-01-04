<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Data;
use App\Models\Link;
use App\Models\Tag;
use App\Models\Xunsearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    /**
     * @param $param  路由绑定的参数 可查询分类、标签、文章内容,可搜索
     * @return $categories 分类模型
     * @return $tags 标签模型
     * @return $articles 文章模型
     */
    public function index($param = null)
    {
        $articles = Article::getArticleList();

        return view('home.index.index',[
            'articles' => $articles,
        ]);
    }

    public function cate($cate_id)
    {
        $map = [
            'name'=>'category.id',
            'value'=>[$cate_id]
        ];
        $articles = Article::getArticleList($map);

        return view('home.index.index',[
            'articles' => $articles,
        ]);

    }

    public function tag($tag_id)
    {
        $map = [
            'name'=>'article_tag.tag_id',
            'value'=>[$tag_id]
        ];
        $articles = Article::getArticleList($map);

        return view('home.index.index',[
            'articles' => $articles,
        ]);
    }

    /**
     * @param Request $request
     * @return $search 用户请求的搜索
     * @url 跳转至index方法
     */
    public function search(Request $request)
    {
        if ($request->isMethod('post'))
        {
//            获取用户请求
            $search = $request->input('search');

//            搜索结果
            $res = Xunsearch::search($search);
            $arc_ids = [];
            foreach ($res as $value) {
                $arc_ids[] = $value->id;
            }
//            根据搜索结果查询数据
            $map = [
                'name'=>'article.id',
                'value'=>$arc_ids
            ];
            $articles = Article::getArticleList($map);

            return view('home.index.index',[
                'articles' => $articles,
            ]);
        }

        return back();
    }

    public function sidebar()
    {
        $data = Cache::remember('home:index:sidebar', 60,function () {
//          标签
            $tags = Tag::orderBy('sort')
                ->select('id','name','color')
                ->get();
//          推荐文章
            $hot_list = Article::orderBy('browse','desc')
                ->where('release',1)
                ->select('id','title')
                ->limit(9)
                ->get();

            $data = [
                'tags'=>$tags,
                'hot_list'=>$hot_list,
            ];

            return $data;
        });

        echo json_encode($data);
    }

    public function header()
    {
        $data = Cache::rememberForever('home:index:header', function () {
//        获取分类模型
            $categories = Category::orderBy('sort')
                ->get()
                ->toArray();
            $categories = Data::tree($categories,'name');
            $data = [
                'categories'=>$categories,
            ];

            return $data;
        });

        echo json_encode($data);
    }
    public function footer()
    {
        $cache_seconds = 3600;
        $data = Cache::remember('home:index:footer',$cache_seconds, function () {
//        获取分类模型
            $links = Link::orderBy('sort')
                ->get()
                ->toArray();
            $data = [
                'links'=>$links,
            ];

            return $data;
        });

        echo json_encode($data);
    }









}