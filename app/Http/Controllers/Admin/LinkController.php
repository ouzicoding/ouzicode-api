<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class LinkController extends AdminBaseController
{


    public function create(Request $request)
    {
        $post = $request->input();
        return response()->json();
    }
    public function delete()
    {
        return response()->json();

    }
    public function update()
    {
        return response()->json();
    }
    public function links()
    {

        return response()->json();
    }



}
