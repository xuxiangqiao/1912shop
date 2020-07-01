<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Goods;
class CategoryController extends Controller
{
    public function index($cate_id,$type=1){
    	$orderfield ='goods_new';
    	if($type==2){
    		$orderfield = 'sale_number';
    	}
    	if($type==3){
    		$orderfield = 'goods_price';
    	}

    	$category = Category::all();
    	$cate_ids = createTree($category,$cate_id);
    	$cate_ids = json_decode(json_encode($cate_ids),true);
    	$cate_ids = array_column($cate_ids, 'cate_id');
    	array_unshift($cate_ids,$cate_id);

    	$goods = Goods::where(['goods_up'=>1])->whereIn('cate_id',$cate_ids)->orderBy($orderfield,'desc')->get();
    	return view('index.list',['goods'=>$goods,'cate_id'=>$cate_id,'type'=>$type]);
    }
}
