<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends AdminBaseController
{
    public function index()
    {
        $user = Auth::user();

        $last_login_time = $user->last_login_time;
        $signature = DB::table('signature')
            ->orderBy('created_time','desc')
            ->value('content');

        $data = [
            'last_login_time'=>$last_login_time,
            'signature'=>$signature,
        ];

        return view('admin.index.index',['data'=>$data]);
    }
}