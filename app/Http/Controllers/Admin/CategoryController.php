<?php

namespace App\Http\Controllers\Admin;


use App\Models\Category;

class CategoryController extends AdminBaseController
{

    public function categories()
    {
        Category::all();
        return response()->json();
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
