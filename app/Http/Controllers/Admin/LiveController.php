<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminBaseController;

/**
 * API 直播管理
 */
class LiveController extends AdminBaseController{
    /**
     * 开始直播
     */
    public function edit_status()
    {
        addlog(I('post.'),'edit_live_status','请求数据');

        $auction_id = I('post.auction_id');
        $status = I('post.status');
        $SaleAuction = D('SaleAuction');
        $this->check_empty_param(['auction_id'=>'拍场ID','status'=>'直播状态']);
        $roomId = $SaleAuction->where(['auction_id'=>$auction_id])->getField('tid');
//        改变直播状态
        $redisObj = createRedisObj();
        $hashkey = sprintf(C('SLDC_CASH_AUCTION_DETAIL_HASH'),$auction_id);
        $info = $redisObj->hGetAll($hashkey);
        $live = unserialize($info['live']);
//        if (!$live['live_auth']) ajax_return('','没有权限',0);
//        if ($status && $live['status']) ajax_return('','正在直播中',0);
        $live['status'] = $status;
        $live = serialize($live);
        $redis_res = $SaleAuction->updateAuctionRedisInfo($auction_id,['live'=>$live]);
//        推送消息
        if ($status) {
            $pushMsg = '直播开始';
            $pushType = 200;
        }else{
            $pushMsg = '直播结束';
            $pushType = 201;
        }
        pushLiveMsg($roomId, C('ACCID_SYSTEM'), $pushMsg, $pushType);
//        打印log
        $log = [
            'auction_id'=>$auction_id,
            'redis_res'=>$redis_res
        ];
        addlog($log,'edit_live_status',($status?'开始':'结束') .'直播');

        ajax_return('','ok',1);
    }
    /**
     * 获取直播状态
     */
    public function live_status()
    {
//        拍场id/频道ID
        $auction_id = I('post.auction_id');
        $SaleAuction = D('SaleAuction');
//        获取当前直播频道ID 状态
        $redisObj = createRedisObj();
        $hashkey = sprintf(C('SLDC_CASH_AUCTION_DETAIL_HASH'),$auction_id);
        $info = $redisObj->hGetAll($hashkey);
        $live = unserialize($info['live']);
        addlog($live,'live_status','获取当前直播频道ID 状态');
//        获取真实直播状态
        $p = new_yunxin();
        $channel_res = $p->channelStatus($live['channel_id']);
        addlog($live,'live_status','获取真实直播状态');
        if (!$channel_res['ret']['status']) {
//            如果redis正在直播 则关闭
            if ($live['status']) {
                $live['status'] = 0;
                $live = serialize($live);
                $SaleAuction->updateAuctionRedisInfo($auction_id,['live'=>$live]);
            }
            ajax_return('','直播已结束',0);
        }else{
            ajax_return('','马上进入 敬请期待...',1);
        }
    }












}