<?php

namespace App\Http\Controllers\Api;

use App\Models\User;

class UserController extends ApiBaseController
{

    public function user_info()
    {
        $this->check_login();
        $uid = session('user_info.uid');

        $data = User::where('id',$uid)
            ->select('id as uid','username','login_name','avatar')
            ->first();

        $this->ajax_return($data);
    }




}