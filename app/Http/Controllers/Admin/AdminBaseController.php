<?php


use App\Http\Controllers\Controller;

class AdminBaseController extends Controller
{

    public function initialize()
    {
        $this->userId = request()->input('userid');
        
    }






}
