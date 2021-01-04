<?php
/**
 * description 用户点赞
 * Created by ouhao@ouxiaohao.com
 * Date: 2017/6/17
 * User: ouhao
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class UserLikeController extends Controller
{
    /**
     * 用户列表跳板
     * @param integer $type 1 拍品点赞 2帖子点赞  3关注  4粉丝
     * @return json
     */
    public function like_list()
    {
        $type = I('post.type',1);
        switch ($type) {
            case 1:
                $this->lot_like_list();
                break;
            case 2:
                $this->forum_like_list();
                break;
            default:
                $Personal = A('PersonalCenter');
                $Personal->concerns_fans_list();
                break;
        }
    }
    /**
     * 拍品点赞列表
     * * @param integer $user_id 用户ID
     * @param integer $lot_id 拍场ID
     * @param integer $object_id 帖子ID
     */
    public function lot_like_list()
    {
        $lot_id = I('post.lot_id');
        $auciton_id= I('post.auction_id');
        $lot_id = empty($lot_id) ? I('post.object_id') : $lot_id;
        $auciton_id = empty($auciton_id) ? I('post.other_id') : $auciton_id;

//        约束
        $map = [
            'ul.object_id'=>$lot_id,
            'ul.other_id'=>$auciton_id,
            'ul.status'=>0,
        ];
        $field = 'mu.id as user_id,mu.headpic,mu.nickname,mu.level';
        $limit = 10;
        $data = D('UserLike')->like_list_page($map,$field,$limit);

//        是否还有下一页
        $next_page = $data['next_page'];
        unset($data['next_page']);
        ajax_return($data,'点赞列表',1,$next_page);
    }
    /**
     * 帖子点赞列表
     */
    private function forum_like_list()
    {
        $object_id = I('post.object_id');

//        约束
        $map = [
            'ul.object_id'=>$object_id,
            'ul.other_id'=>0,
            'ul.status'=>0,
        ];
        $field = 'mu.id as user_id,mu.headpic,mu.nickname,mu.level,mu.vip';
        $limit = 10;
        $data = D('UserLike')->like_list_page($map,$field,$limit);
//        是否还有下一页
        $next_page = $data['next_page'];
        unset($data['next_page']);

        ajax_return($data,'点赞列表',1,$next_page);
    }


    /**
     * 点赞/取消点赞
     * @param integer $user_id 用户ID
     * @param integer $lot_id 拍品ID
     * @param integer $auction_id 拍场ID
     */
    public function is_like()
    {
//        $this->check_base_param();
        $lot_id = I('post.lot_id');
        $auction_id = I('post.auction_id');
        $object_id = I('post.object_id');
        $like_type = I('post.type');
        if ($like_type == 3) $this->comment_like($object_id);
        $type = D('SaleAuction')->get_lot_type($auction_id);
        if (!empty($object_id)) return $this->forum_like($object_id);

//        约束条件
        $map = [
            'user_id'=>$this->userId,
            'type'=> $type,
            'object_id'=>$lot_id,
            'other_id'=>$auction_id,
        ];
//        旧状态
        $old_status = M('User_like','sl_')
            ->where($map)
            ->getField('status');
        if (!isset($old_status)) { // 从未点赞
            $add_data = $map;
            $add_data['create_time'] = time();
            $add_data['update_time'] = time();
            $add_data['type'] = $type;
            M('User_like','sl_')->add($add_data);

        }else{ // 已点赞过
            $status = $old_status<0 ? 0 : -1;
//        重新设置状态
            M('User_like','sl_')
                ->where($map)
                ->save(['status'=>$status,'update_time'=>time()]);
        }
//        改变次数
        $Sal = M('Sale_auction_lots','sl_');
        $lot_auction_like_num = $Sal->where(['auction_id'=>$auction_id,'lot_id'=>$lot_id])
            ->getField('lot_auction_like_num');
        if ($old_status !== '0') {
            $change_num = 1;
        }else{
            $change_num = -1;
        }
        $lot_auction_like_num = $lot_auction_like_num+$change_num;
        $Sal->where(['auction_id'=>$auction_id,'lot_id'=>$lot_id])
            ->setField('lot_auction_like_num',$lot_auction_like_num);
        D('SaleLots')->updateLotInfoByAuctionIdLotId(['like_num'=>$lot_auction_like_num],$auction_id,$lot_id,$map['type']);

//        操作提示
        if (!M('User_like','sl_')->getError()) {
            $data = [
                'status'=>!(int)$status ? 1 :0,
                'like_num'=>$lot_auction_like_num,
            ];

            ajax_return($data,($old_status<0 || is_null($old_status)) ? '已点赞' : '已取消',1);
        }else{
            ajax_return('','操作失败',0);
        }

    }

    private function forum_like($object_id)
    {
        $xinxi_id = $object_id;
        $other_id = 0;
        $vip = $this->userVip;
        $User_like = M('User_like','sl_');
//        约束条件
        $map = [
            'user_id'=>$this->userId,
            'type'=>2,
            'object_id'=>$object_id,
            'other_id'=>$other_id,
        ];
//        旧状态
        $old_status = $User_like
            ->where($map)
            ->getField('status');

        if (is_null($old_status)) { // 从未点赞
            $add_data = $map;
            $add_data['create_time'] = time();
            $add_data['update_time'] = time();
            $User_like->add($add_data);

            //@todo 获取用户信息
            if($map['type'] == 2){
                $xinxiInfo = M("my_xinxi")->where("id='".$object_id."'")->find();
                $type = 4;
                $common_pic = $this->getXinxiFirstPic($object_id);
                $this->jpush($this->nickName,'点赞了你',$xinxiInfo['userid'],$type,array(),array(),$this->userId,$type,$object_id,$common_pic);
            }
        }else{ // 已点赞过
            $status = $old_status<0 ? 0 : -1;
//        重新设置状态
            $User_like
                ->where($map)
                ->save(['status'=>$status,'update_time'=>time()]);
        }

//        改变次数redis
        $change_num = $old_status!=='0' ? 1 : -1;

        $info = D('Xinxi')->getXinxiInfoById($xinxi_id);
        $like_num = $User_like->where(['object_id'=>$xinxi_id,'status'=>0,'type'=>2])->count();
        $update_redis = ['like_num'=>$like_num];
//        是否总掌门人点赞
        if (in_array($vip, C('FORUM_VIP_CLICK_RECOMMEND'))) {
            M('Xinxi','my_')->where(['id'=>$xinxi_id])->setInc('vip_like',$change_num*C('FORUM_VIP_CLICK_BASE'));
            $update_redis['like_vip_level'] = $change_num +2;
        }
        D('Xinxi')->updateXinxiInfoById($xinxi_id,$update_redis);

//        操作提示
        if (!M('User_like','sl_')->getError()) {
            $data = [
                'status'=>!(int)$status ? 1 :0,
                'like_num'=>$like_num,
            ];
            // 点赞加积分 jxl
            if ($old_status<0 || is_null($old_status)) {
                // 被点赞加积分
                A('Common/ApiBase')->addOrReduceIntegral(4,$info['user_id'],true,$this->userId);
                // 点赞用户加积分
                A('Common/ApiBase')->addOrReduceIntegral(5,$this->userId);
            }

            //            兼容旧版本点赞
            if (I('post.is_return')) return true;
            ajax_return($data,($old_status<0 || is_null($old_status)) ? '已点赞' : '已取消',1);
        }else{
            ajax_return('','操作失败',0);
        }
    }

    /**
     * 评论点赞
     */
    public function comment_like($object_id)
    {
        $other_id = 0;

//        约束条件
        $map = [
            'user_id'=>$this->userId,
            'type'=>3,
            'object_id'=>$object_id,
            'other_id'=>$other_id,
        ];
//        旧状态
        $old_status = M('User_like','sl_')
            ->where($map)
            ->getField('status');
        if (is_null($old_status)) { // 从未点赞
            $add_data = $map;
            $add_data['create_time'] = time();
            $add_data['update_time'] = time();
            M('User_like','sl_')->add($add_data);
        }else{ // 已点赞过
            $status = $old_status<0 ? 0 : -1;
//        重新设置状态
            M('User_like','sl_')
                ->where($map)
                ->save(['status'=>$status,'update_time'=>time()]);
        }
//        改变次数redis
        $change_num = $old_status!=='0' ? 1 : -1;

        $redisObj = LinkCommonRedis();
        $old_num = $redisObj->get('FORUM_COMMENT_LIKE_NUM:'. $object_id);
        $like_num = $old_num + $change_num;
        $redisObj->set('FORUM_COMMENT_LIKE_NUM:'. $object_id,$like_num);
        M('Pinglun','my_')->where(['id'=>$object_id])->save(['like_num'=>$like_num]);

//        操作提示
        if (!M('User_like','sl_')->getError()) {
            $data = [
                'status'=>!(int)$status ? 1 :0,
                'like_num'=>$like_num,
            ];
            ajax_return($data,($old_status<0 || is_null($old_status)) ? '已点赞' : '已取消',1);
        }else{
            ajax_return('','操作失败',0);
        }
    }





}