<?php

namespace App\Http\Controllers\Admin;


use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends AdminBaseController
{

    public function create(Request $request)
    {
        $post = $request->input();

        $insertData = $post;
        Category::create($insertData);

        return response()->json();
    }

    public function delete(Request $request,$id)
    {
        $articleId = Article::where('category_id',$id)->value('id');
        if ($articleId) {
            return response()->json(['msg'=>'该分类下面有文章'],403);
        }
        Category::deleted($id);
        return response()->json();
    }

    public function update(Request $request,$id)
    {
        $put = $request->input();
        $updateData = $put;
        Category::where('id',$id)->update($updateData);
        return response()->json();
    }

    public function categories()
    {
        $list = Category::orderBy('sort')->get();

        return response()->json($list);
    }

}
