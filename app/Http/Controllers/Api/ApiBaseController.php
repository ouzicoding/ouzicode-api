<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiBaseController extends Controller
{

    public function check_login()
    {
        if (session('user_info.uid')) {
            return true;
        }

        $this->ajax_return('',-100,'未登录');
    }
    /**
     * @param $code int 状态 0成功
     * @param $desc string 接口描述
     * @param $data array 数据
     */
    public function ajax_return($data=[],$code=0,$desc='')
    {
        $result=[
            'code'=>$code,
            'desc'=>$desc,
        ];
        if (!empty($data)) {
            // 禁止使用的字段
            $reserved_words = ['id','title','name'];
            foreach ($reserved_words as $v) {
                if (array_key_exists($v, $data)) {
                    $result['code'] = -1000;
                    $result['desc'] = '禁止key：'.$v;
                }
            }
            ($result['code']===0) && $result['data']=$data;
        }

        echo json_encode($result);
        exit(0);
    }
    /**
     * 创建时间格式化
     */
    public function create_time_format($timestamp)
    {
        $time_diff = time() - $timestamp;
    //    发帖日期/天
        $create_day = date('ymd',$timestamp);
    //    今天/天
        $now_day = date('ymd');
    //    昨天/天
        $before_day = date("ymd",strtotime("-1 day"));

        switch (true) {
            case ($create_day == $before_day) :
                $string = '昨天';
                break;
            case $time_diff <60 :
                $string = '刚刚';
                break;
            case 60 <= $time_diff && $time_diff <60 * 60 :
                $string = intval($time_diff/60). '分钟前';
                break;
            case (60*60 <= $time_diff) && ($create_day == $now_day) :
                $string = intval($time_diff/(60*60)). '小时前';
                break;
            case (24*60*60 <= $time_diff) && ($create_day != $before_day) && ($time_diff < 30*24*60*60) :
                $string = intval($time_diff/(24*60*60)). '天前';
                break;
            case (30*24*60*60 <= $time_diff) && ($time_diff < 365*24*60*60) :
                $string = intval($time_diff/(30*24*60*60)). '个月前';
                break;
            case (365*24*60*60 <= $time_diff) :
                $string = intval($time_diff/(365*24*60*60)). '年前';
                break;
            default:
                $string = date('Y-m-d',$timestamp);
                break;
        }
        return $string;
    }

    /*
    * 天气预报
    * @param string $city 城市名称
    */
    public function daily_forecast($city){
        $url = 'https://free-api.heweather.com/v5/weather';
        // 参数
        $data = array(
            'city' => $city,
            'key' => C('WEATHER_KEY'),
        );
        // 处理参数
        $o="";
        foreach ($data as $key => $value) {
            $o.= "$key=".urlencode($value)."&";
        }
        $data = substr($o, 0,-1);
        // 发送post请求
        $response = post_curl($data,$url);
        $result = str_replace("\"", '"', $response);
        $result = json_decode($response);

        return $result->HeWeather5[0]->daily_forecast;
    }

    /**
     * 将json字符串转化成php数组
     * @param  $json_str
     * @return $json_arr
     */
    public function json_to_array($json_str){
        if(is_array($json_str) || is_object($json_str)){
            $json_str = $json_str;
        }else if(is_null(json_decode($json_str))){
            $json_str = $json_str;
        }else{
            $json_str =  strval($json_str);
            $json_str = json_decode($json_str,true);
        }
        $json_arr=array();
        foreach($json_str as $k=>$w){
            if(is_object($w)){
                $json_arr[$k]= json_to_array($w); //判断类型是不是object
            }else if(is_array($w)){
                $json_arr[$k]= json_to_array($w);
            }else{
                $json_arr[$k]= $w;
            }
        }
        return $json_arr;
    }
    /**
     * 获取首字母
     */
    public function getfirstchar($s0)
    {
        $firstchar_ord = ord(strtoupper($s0{0}));
        if (($firstchar_ord >= 65 and $firstchar_ord <= 91) or ($firstchar_ord >= 48 and $firstchar_ord <= 57)) return $s0{0};
        $s = iconv("UTF-8", "gb2312", $s0);
        $asc = ord($s{0}) * 256 + ord($s{1}) - 65536;
        if ($asc >= -20319 and $asc <= -20284) return "A";
        if ($asc >= -20283 and $asc <= -19776) return "B";
        if ($asc >= -19775 and $asc <= -19219) return "C";
        if ($asc >= -19218 and $asc <= -18711) return "D";
        if ($asc >= -18710 and $asc <= -18527) return "E";
        if ($asc >= -18526 and $asc <= -18240) return "F";
        if ($asc >= -18239 and $asc <= -17923) return "G";
        if ($asc >= -17922 and $asc <= -17418) return "H";
        if ($asc >= -17417 and $asc <= -16475) return "J";
        if ($asc >= -16474 and $asc <= -16213) return "K";
        if ($asc >= -16212 and $asc <= -15641) return "L";
        if ($asc >= -15640 and $asc <= -15166) return "M";
        if ($asc >= -15165 and $asc <= -14923) return "N";
        if ($asc >= -14922 and $asc <= -14915) return "O";
        if ($asc >= -14914 and $asc <= -14631) return "P";
        if ($asc >= -14630 and $asc <= -14150) return "Q";
        if ($asc >= -14149 and $asc <= -14091) return "R";
        if ($asc >= -14090 and $asc <= -13319) return "S";
        if ($asc >= -13318 and $asc <= -12839) return "T";
        if ($asc >= -12838 and $asc <= -12557) return "W";
        if ($asc >= -12556 and $asc <= -11848) return "X";
        if ($asc >= -11847 and $asc <= -11056) return "Y";
        if ($asc >= -11055 and $asc <= -10247) return "Z";
        return null;
    }
    /**
     * 搜索关键字标红
     * @param [type] $key
     * @param [type] $content
     * @return void
     */
    public function returnred($key, $content)
    {
        return str_replace($key, '<font color="red">' . $key . '</font>', $content);
    }




}