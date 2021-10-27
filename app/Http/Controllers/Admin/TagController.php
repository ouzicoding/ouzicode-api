<?php

namespace App\Http\Controllers\Admin;


use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TagController extends AdminBaseController
{

    public function create(Request $request): JsonResponse
    {
        $post = $request->post();
        Tag::create($post);
        return response()->json();
    }

    public function delete($id): JsonResponse
    {

        Tag::where('id',$id)->delete();
        return response()->json();
    }

    public function update(Request $request,$id): JsonResponse
    {
        $put = $request->input();
        Tag::where('id',$id)->update($put);

        return response()->json();
    }

    public function tags(): JsonResponse
    {
        $list = Tag::select();
        return response()->json($list);
    }

}
