<?php
/**
 * Created by PhpStorm.
 * User: hp-14
 * Date: 2016/11/3
 * Time: 10:10
 */

namespace App\Http\Controllers\Admin;


use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends AdminBaseController
{
    /**
     * @return $data 标签列表
     */
    public function index()
    {
        $data = Tag::orderBy('sort')->paginate(8);

        return view('admin.tag.index',['data'=>$data]);
    }

    /**
     * @param Request $request
     * @return 添加标签
     */
    public function add(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $post = $request->all();
            $sort = $post['sort'];
//            把标签组字符串转化为数组
            $names = explode('|', $post['name']);
            foreach ($names as $name)
            {
                $data = array(
                    'sort' => $sort,
                    'name' => $name,
                );
//                批量赋值
                $res = Tag::create($data);
//                失败
                if (!$res) return back()->withInput();
            }
//            成功
            return redirect('tag/index');
        }
        return view('admin.tag.add');
    }

    /**
     * @param Request $request
     * @param $id
     * @return $tag 当前模型
     */
    public function edit(Request $request,$id)
    {
        if ($request->isMethod('post'))
        {
            $post = $request->all();
//            更新
            $res = Tag::where('id', $id)->update($post);
//            成功
            if ($res) return redirect('tag/index');
//            失败
            return back()->withInput();
        }
//        获取当前模型
        $tag = Tag::find($id);

        return view('admin.tag.edit',['tag' => $tag]);
    }
    public function del($id)
    {
        Tag::destroy($id);
        return back();
    }







}