<?php


namespace App\Http\Controllers\Api;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use YuanChao\Editor\EndaEditor;

class CommentController extends ApiBaseController
{

    /**
     * 添加评论、回复
     * @param string $content 内容
     * @param int $article_id 文章id
     * @param int $comment_id 评论id
     * @param int $to_user_id 被回复的用户id
     */
    public function add_comment(Request $request)
    {
        $this->check_login();

//        获取请求数据
        $post = $request->input();
//        判断 评论/一级回复/二级回复
        if (!$post['comment_id']) {// 评论
            $to_user_id = 0;
            $belong_comment_id = 0;
        }else{// 回复
            $to_comment = Comment::find($post['comment_id']);
            $to_user_id = $to_comment['user_id'];
            $to_username = User::where('id',$to_user_id)->value('username');
            if (!$to_comment['belong_comment_id']) {//一级回复
                $belong_comment_id = $to_comment['id'];
            }else{//二级回复
                $belong_comment_id = $to_comment['belong_comment_id'];
            }
        }

        $cur_time = time();
        $userId = session('user_info.uid');
        $data = [
            'content'=>$post['content'],
            'article_id'=>$post['article_id'],
            'user_id'=>$userId,
            'to_user_id'=>$to_user_id,
            'belong_comment_id'=>$belong_comment_id,
            'created_at'=>$cur_time,
            'updated_at'=>$cur_time,
        ];

        $comment = Comment::create($data);
        if (!$comment->id){
            $this->ajax_return('',-200,'操作失败');
        }

//        返回数据
        $data['content'] = EndaEditor::MarkDecode($data['content']);
        $data['created_format'] = date('Y-m-d H:i:s',$data['created_at']);
        $data['comment_id'] = $comment->id;
        $data['reply_list'] = [];
        !empty($to_username) && $data['to_username'] =$to_username;

        $result = [
            'data'=>$data
        ];

        $this->ajax_return($result);
    }
    /**
     * 评论列表
     * @param integer $xinxi_id 帖子ID
     */
    public function comment_list($article_id)
    {
        $data = Comment::join('users','comment.user_id','=','users.id')
            ->where([['comment.article_id',$article_id],['comment.status',0],['belong_comment_id',0]])
            ->orderBy('comment.created_at','desc')
            ->select('comment.id as comment_id','comment.content','comment.created_at','users.username','users.avatar')
            ->get()
            ->toArray();

        $list = [];
        $Comment = new Comment;
        foreach ($data as $k => $v) {
            $v['created_format'] = date('Y-m-d H:i:s',$v['created_at']);
            $v['content'] = EndaEditor::MarkDecode($v['content']);
            $v['reply_list'] = $Comment->replay_list($v['comment_id']);
            
            $list[] = $v;
        }

        $result = [
            'list'=>$list
        ];
        $this->ajax_return($result);
    }
    /**
     * 删除评论
     * @param integer $object_id 评论/回复 ID
     * @param integer $type [1 评论 2 一级回复 3 二级回复]
     */
    public function del_comment($id)
    {
        $Comment = new Comment;
        $result = $Comment->soft_delete($id);

        $this->ajax_return();
    }











}