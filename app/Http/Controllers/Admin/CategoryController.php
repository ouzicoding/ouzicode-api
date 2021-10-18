<?php

namespace App\Http\Controllers\Admin;


use App\Models\Category;

class CategoryController extends AdminBaseController
{

    public function create()
    {
        $insertData = [];
        Category::insertGetId($insertData);

        return response()->json();
    }

    public function delete($id)
    {

        Category::deleted($id);
        return response()->json();
    }

    public function update($id)
    {
        $updateData = [];
        Category::where('id',$id)->update($updateData);
        return response()->json();
    }

    public function categories()
    {
        $list = Category::orderBy('sort')->get();

        return response()->json($list);
    }

}
