<?php
/**
 * Created by PhpStorm.
 * User: hp-14
 * Date: 2016/11/2
 * Time: 11:07
 */

namespace App\Http\Controllers\Admin;


use App\Models\Category;
use App\Models\Data;
use Illuminate\Http\Request;

class CategoryController extends AdminBaseController
{
    /**
     * @return $categoryTree 分类的树形结构
     */
    public function index()
    {
//        序列化模型
        $category = Category::orderBy('sort')->get()->toArray();
//        树形结构
        $categoryTree = Data::tree($category,'name');

        return view('admin.category.index',['categoryTree'=>$categoryTree]);
    }

    /**
     * @param Request $request
     * @return category 分类的树形结构
     */
    public function add(Request $request)
    {
        if ($request->isMethod('post')){
//            获取请求数据
            $post = $request->all();
//            批量赋值
            $res = Category::create($post);
//            成功
            if ($res) return redirect('category/index');
//            失败
            return back()->withInput();
        }
//        序列化模型
        $category = Category::all()->toArray();
//        树形结构
        $category = Data::tree($category,'name');

        return view('admin.category.add',['category'=>$category]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return $category 当前分类
     * @return $categoryTree 分类的树形结构
     */
    public function edit(Request $request,$id)
    {
        if ($request->isMethod('post'))
        {
//            获取请求数据
            $post = $request->all();
//            更新
            $res = Category::where('id',$id)->update($post);
//            成功
            if($res) return redirect('category/index');
//            失败
            return back()->withInput();
        }
//        根据主键获取模型
        $category = Category::find($id);
//        获取全部数据
        $categoryAll = Category::select('id','pid','name')
            ->orderBy('sort')
            ->get()
            ->toArray();
        $categoryTree = Data::tree($categoryAll,'name');

        return view('admin.category.edit',['category' => $category,'categoryTree'=>$categoryTree]);
    }

    /**
     * @param $id
     */
    public function del($id)
    {
//        获取当前级别的所有子级id
        $ids = $this->getSonId($id);
//        加入当前级别
        $ids[] = $id;
//        执行删除
        $res = Category::destroy($ids);

        return back();
    }

    /*
     * @param $id 当前id
     * @return 所有子级id
     */
    private function getSonId($id)
    {
//        当前级别的下一级别
        $ids = Category::where('pid', $id)->pluck('id')->toArray();
//        递归获取所有子级的子级
        foreach ($ids as $pid)
        {
            $ids = array_merge($ids,$this->getSonId($pid));
        }

        return $ids;
    }









}