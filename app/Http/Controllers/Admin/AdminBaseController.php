<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminBaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 返回提示信息
     * @param $bool    判断条件
     * @param $data    返回数据
     * @param $message 返回信息
     * @param $result  返回状态码
     */
    protected function ajax_return($bool,$data=''){
        if ($bool) {
            ajax_return($data,'成功',1);
        }else{
            ajax_return($data,'失败',0);
        }
    }
    protected function handle_mp4_pic($source,$picFilename,$avopts='/o/1/n/1/f/jpg/ss/00:00:01')
    {
        $bucketConfig = new Config('himalayaimg', 'himalaya', 'ypyimg2016');
        $client = new Upyun($bucketConfig);
        $path = $source;
        $save_as = '/video/pic/'. date('Ymd'). '/'. $picFilename;
        $v = $client->process($path,[
                [
                    'type' => 'thumbnail',  // video 表示视频任务, audio 表示音频任务
                    'avopts' => $avopts, // 处理参数，`s` 表示输出的分辨率，`r` 表示视频帧率，`as` 表示是否自动调整分辨率
                    'save_as' => $save_as, // 新视频在又拍云存储的保存路径
                    'return_info'=>'true',
                ]
            ]
        );

        return $save_as;
    }

}
