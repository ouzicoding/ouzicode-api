<?php
namespace App\Http\Controllers\Admin;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends AdminBaseController
{


    public function create(Request $request)
    {
        $post = $request->input();

        return response()->json();
    }
    public function delete($id)
    {
        Link::where('id',$id)->delete();
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
