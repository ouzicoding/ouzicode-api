<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\JsonResponse;

class TagController extends AdminBaseController
{


    public function tags(): JsonResponse
    {

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

}
