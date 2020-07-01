<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //指定表名
	protected $table = 'category';
	//指定主键
    protected $primaryKey = 'cate_id';
    //不自动添加时间 create_at update_at
    public $timestamps = false;
    //黑名单
    protected $guarded = [];


}
