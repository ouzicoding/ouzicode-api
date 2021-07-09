<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class AdminBaseController extends Controller
{

    public function initialize()
    {

    }

    /**
     * @param $data
     * @param string $msg
     * @param int $code
     * @return JsonResponse
     */
    protected function response($data,string $msg,int $code): JsonResponse
    {
        $result = [
            'code'=>$code,
            'msg'=>$msg,
        ];
        if (!is_null($data)) {
            $result['data'] = (array)$data;
        }
        return response()->json($result);
    }

    protected function responseSuccess($data=[],$msg='success',$code = 0): JsonResponse
    {
        return $this->response($data,$msg,$code);
    }

    protected function responseError($msg='error',$code = -1): JsonResponse
    {
        return $this->response(null,$msg,$code);
    }





}
