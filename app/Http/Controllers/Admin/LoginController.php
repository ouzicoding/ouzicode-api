<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\JsonResponse;

class LoginController extends AdminBaseController
{


    public function login(): JsonResponse
    {

        $data = [
            [
                'id'=>1,
                'name'=>'apple'
            ],
            [
                'id'=>2,
                'name'=>'pear'
            ]
        ];

        return response()->json($data);
    }





}
