<?php
/**
 * description 评论
 * Created by ouhao@ouxiaohao.com
 * Date: 2017/5/19
 * User: ouhao
 */


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use YuanChao\Editor\EndaEditor;

class Comment extends Model
{
//    指定表名
    protected $table = 'comment';
//    关闭时间戳
    public $timestamps = false;
    protected $guarded = [];

    public function addData($add_data)
    {
        if ($add_data['comment_id']) {// 评论

        }else{// 回复

        }
        $result = true;

        return $result;
    }

    /*
     * 软删除 评论/回复
     */
    public function soft_delete($id)
    {
        $result = true;
        return $result;
    }


    /**
     * 评论的回复列表
     * @param $belong_comment_id
     * @return array
     */
    public function replay_list($belong_comment_id)
    {
        $replies = $this->where([['belong_comment_id',$belong_comment_id],['status',0]])
            ->orderBy('created_at','asc')
            ->select('id as comment_id','content','created_at','user_id','to_user_id')
            ->get()
            ->toArray();

        $data = [];
        $User = new User;
        foreach ($replies as $key => $reply) {
            $reply['content'] = EndaEditor::MarkDecode($reply['content']);
            $reply['created_format'] = date('Y-m-d H:i:s',$reply['created_at']);
//            回复者
            $user_info = $User->where('id',$reply['user_id'])
                ->select('username','avatar')
                ->first()
                ->toArray();
            $reply = array_merge($reply,$user_info);
//            被回复者
            $reply['to_username'] = $User->where('id',$reply['to_user_id'])->value('username');

            unset($reply['user_id']);
            unset($reply['to_user_id']);

            $data[] = $reply;
        }

        return $data;
    }















}