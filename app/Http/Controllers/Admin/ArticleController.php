<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Category;
use App\Models\Data;
use App\Models\Tag;
use App\Models\Xunsearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends AdminBaseController
{
    public function index()
    {
        $data = Article::OrderBy('id','desc')
            ->paginate(10);

        return view('admin.article.index',['data'=>$data]);
    }

    /**
     * @return $category 分类模型
     * @return $tag 标签模型
     */
    public function add()
    {
//        获取分类模型
        $category = Category::orderBy('sort')
            ->get()
            ->toArray();
//        转为树形结构
        $category = Data::tree($category,'name');

//        获取标签模型
        $tag = Tag::orderBy('sort')->get();

        return view('admin.article.add',[
            'category' => $category,
            'tag' => $tag,
        ]);
    }

    /**
     * @param Request $request
     * @return $articleData 添加文章模型
     * @return $articleTagData 添加文章标签中间表模型
     */
    public function addData(Request $request)
    {
//        上传缩略图
        $path = Storage::disk('upyun')->put('/thumb',$request->file('Article.thumb'));
//        获取文章模型的请求数据
        $articleData = $request->input('Article');
//        添加文件路径到数组
        $articleData['thumb'] = $path;
//        批量赋值
        $active = Article::create($articleData);
//        失败返回
        if (!$active) return back()->withInput();

//        获取当前文章id
        $id = $active->id;
//        添加讯搜
        Xunsearch::add(['id'=>$id,'title'=>$articleData['title'],'keywords'=>$articleData['keywords']]);
//        获取文章_标签模型的请求数据，转化为字符串
        $tagId = $request->input('tag_id');
        foreach ($tagId as $v)
        {
            $articleTagData = ['article_id'=>$id,'tag_id'=>$v];
            $res = ArticleTag::create($articleTagData);
//            失败动作
            if (!$res) return back()->withInput();
        }
//        成功动作
        return redirect('admin/article/index');

    }

    /**
     * @param $id
     * @return $article 当前文章模型
     * @return $category 所有分类模型
     * @return $tag 所有标签模型
     * @return $activeTag 当前文章拥有的标签
     */
    public function edit($id)
    {
//        获取当前文章模型
        $article = Article::find($id);
//        获取所有分类模型
        $category = Category::orderBy('sort')
            ->get()
            ->toArray();
        $category = Data::tree($category,'name');
//        获取所有标签模型
        $tag = Tag::orderBy('sort')->get();
//        获取当前文章拥有的标签
        $activeTag = ArticleTag::where('article_id',$id)
            ->pluck('tag_id')
            ->toArray();

        return view('admin.article.edit',[
            'article' => $article,
            'category' => $category,
            'tag' => $tag,
            'activeTag' => $activeTag,
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return $article 更新文章模型
     * @return $articleTagData 更新文章标签中间表模型
     */
    public function editData(Request $request,$id)
    {

//        请求的文章数据
        $article = $request->input('Article');
//        把文件追加到数据
        if ($request->hasFile('Article.thumb')) {
            $article['thumb'] = Storage::disk('upyun')->put('/thumb',$request->file('Article.thumb'));
        }
        $res = Article::where('id',$id)->update($article);
        if (!$res) return back()->withInput();
//        修改讯搜
        Xunsearch::updateIndex(['id'=>$id,'title'=>$article['title'],'keywords'=>$article['keywords']]);
//        请求的标签数据
        $tagId = $request->input('tag_id');
//        先删除当前文章的旧标签
        ArticleTag::where('article_id',$id)->delete();
//        重新添加新标签
        foreach ($tagId as $v)
        {
            $articleTagData = ['article_id'=>$id,'tag_id'=>$v];
            $res = ArticleTag::create($articleTagData);
            if (!$res) return back()->withInput();
        }
        return redirect('admin/article/index');

    }
    public function del($id)
    {
//        删除文章
        Article::destroy($id);
//        删除文章标签
        ArticleTag::where('article_id',$id)->delete();

        return back();
    }

    /**
     * md上传图片
     * @return array
     */
    public function upload_image(Request $request)
    {
        try{
            // File Upload
            if ($request->hasFile('image')){
                $path = Storage::disk('upyun')->put('/markdown',$request->file('image'));
                $url = FILE_HOST. $path;
            }else{
//                self::addError('Not File');
            }
        }catch (\Exception $e){
//            self::addError($e->getMessage());
        }
        $data = [
            'status'=>empty($message)?0:1,
            'message'=>'',
//            'message'=>self::getLastError(),
            'url'=>!empty($url)?$url:''
        ];

        return json_encode($data);
    }











}