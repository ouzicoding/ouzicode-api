<?php

namespace App\Http\Controllers\Admin;


use App\Models\Category;

class CategoryController extends AdminBaseController
{

    public function categories()
    {
        $list = Category::orderBy('sort')->get();

        return response()->json($list);
    }

    public function update()
    {

        return response()->json();
    }

    public function delete()
    {


        return response()->json();
    }

    public function create()
    {
        return response()->json();
    }

}
