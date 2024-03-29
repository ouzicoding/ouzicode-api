<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    /**
     * @param $articleId
     * @param $tags
     * 创建文章标签
     */
    public static function createArticleTag($articleId,$tags)
    {
//        批量创建
        $list = [];
        foreach ($tags as $tag) {
            $list[] = [
                'article_id'=>$articleId,
                'tag_id'=>$tag,
            ];
        }
        self::insert($list);
    }


}
