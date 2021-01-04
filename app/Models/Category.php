<?php
/**
 * Created by PhpStorm.
 * User: hp-14
 * Date: 2016/11/2
 * Time: 14:45
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
//    指定表名
    protected $table = 'category';
//    关闭时间戳
    public $timestamps = false;
//    指定批量赋值字段
    protected $fillable = ['name','title','pid','sort'];
    















}