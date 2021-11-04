<?php
namespace App\Http\Controllers\Admin;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends AdminBaseController
{


    public function create(Request $request)
    {
        $post = $request->input();
        Link::create($post);
        return response()->json();
    }
    public function delete($id)
    {
        Link::where('id',$id)->delete();
        return response()->json();

    }
    public function update(Request $request,$id)
    {
        $put = $request->input();
        Link::where('id',$id)->update($put);
        return response()->json();
    }
    public function links()
    {
        $list = Link::get();
        return response()->json($list);
    }



}
