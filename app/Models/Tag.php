<?php
/**
 * Created by PhpStorm.
 * User: hp-14
 * Date: 2016/11/3
 * Time: 10:14
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';
    public $timestamps = false;
//    批量赋值黑名单
    protected $guarded = [];













}