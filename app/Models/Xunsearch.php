<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Xunsearch extends Model
{

    /**
     * 添加索引
     * @param $data
     * @return bool
     */
    public static function add($data)
    {
        $xs = new \XS('search');
        $index = $xs->index;
        $doc = new \XSDocument;
//            添加文档
        $doc->setFields([
            'id'=>$data['id'],
            'title'=>$data['title'],
            'keywords'=>$data['keywords'],
            'chrono'=>time(),
        ]);
//            提交到索引中
        $index->add($doc);

        return true;
    }

    /**
     * 更新索引
     * @param $data
     * @return bool
     */
    public static function updateIndex($data)
    {
        $xs = new \XS('search');
        $index = $xs->index;
        $doc = new \XSDocument;
//        修改文档
        $doc->setFields([
            'id'=>$data['id'],
            'title'=>$data['title'],
            'keywords'=>$data['keywords'],
            'chrono'=>time(),
        ]);
//        提交到索引中
        $index->update($doc);

        return true;
    }

    /**
     * 删除指定id的索引
     * @param $ids [1,2,3]
     * @return bool
     */
    public static function delIndex($ids)
    {
        if (!is_array($ids)) {
            $ids = (array)$ids;
        }

        $xs = new \XS('search');
        $index = $xs->index;
        $index->del($ids);

        return true;
    }

    /**
     * 清空所有索引
     * @return bool
     */
    public static function clean()
    {
        $xs = new \XS('search');
        $index = $xs->index;
        $index->clean();

        return true;
    }

    public static function search($name)
    {
        $xs = new \XS('search');
        $data = $xs->search->search($name);

        return $data;
    }






}