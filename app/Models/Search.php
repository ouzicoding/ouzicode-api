<?php
/**
 * Created by PhpStorm.
 * User: hp-14
 * Date: 2016/11/4
 * Time: 10:34
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    protected $table = 'search';
    protected $guarded = [];
    public $timestamps = true;
    protected $dateFormat = 'U';




}