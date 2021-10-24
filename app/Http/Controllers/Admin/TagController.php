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

    public function delete(): JsonResponse
    {

        return response()->json();
    }

    public function update(): JsonResponse
    {

        return response()->json();
    }

    public function tags(): JsonResponse
    {

        return response()->json();
    }

}
