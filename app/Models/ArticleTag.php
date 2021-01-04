<?php
/**
 * Created by PhpStorm.
 * User: hp-14
 * Date: 2016/11/2
 * Time: 0:54
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    protected $table = 'article_tag';
    protected $fillable = ['article_id','tag_id'];
    public $timestamps = false;

}