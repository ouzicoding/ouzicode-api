<?php

namespace App\Http\Controllers\Admin;


use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends AdminBaseController
{

    public function create(Request $request)
    {
        $post = $request->input();

        $insertData = $input;
        Category::create($insertData);

        return response()->json();
    }

    public function delete(Request $request,$id)
    {

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
