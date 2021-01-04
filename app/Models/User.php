<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
//    指定表名
    protected $table = 'users';
//    批量赋值 黑名单
    protected $guarded = [];

    public $timestamps = false;



}