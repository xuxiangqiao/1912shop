<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Category;
//use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class IndexController extends Controller
{
    public function index(){
    	//删除单个
    	//Redis::del('slice');
    	//删除多个
    	//Redis::flushall();
    	//$slice = Cache::get('slice');
    	$slice = Redis::get('slice');
    	//dump($slice);
    	if(!$slice){
    		echo "DB===";
    		//首页幻灯片数据读取
	    	$where = [
	    		'goods_up'=>1,
	    		'is_index_postion'=>1
	    	];
	    	$slice = Goods::select('goods_id','goods_goods_img')->where($where)->take(5)->orderBy('goods_id','desc')->get();

	    	//Cache::put('slice',$slice,24*60*60);
	    	$slice = serialize($slice);
	    	Redis::setex('slice',24*60*60,$slice);
    	}
    	$slice = unserialize($slice);
    	//$topcate = Cache::get('topcate');
    	$topcate = Redis::get('topcate');
    	if(!$topcate){
    		echo "db==top";
	    	//顶级分类
	    	$where = [
	    		'parent_id'=>0,
	    		'is_show'=>1
	    	];
	    	$topcate = Category::where($where)->take(4)->get();
	    	//Cache::put('topcate',$topcate,7*24*60*60);
	    	$topcate = serialize($topcate);
	    	Redis::setex('topcate',7*24*60*60,$topcate);
	    }
	    $topcate = unserialize($topcate);
	   // $hot = Cache::get('hot');
	    $hot = Redis::get('hot');
    	if(!$hot){
    		echo "db===hot";
	    	//热销数据
	    	$where = [
	    		'goods_up'=>1,
	    		'goods_hot'=>1
	    	];
	    	$hot = Goods::where($where)->take(8)->get();
	    	//Cache::put('hot',$hot,30*60);
	    	$hot = serialize($hot);
	    	Redis::setex('hot',7*24*60*60,$hot);
	    }
	    $hot = unserialize($hot);
    	return view('index.index',['slice'=>$slice,'topcate'=>$topcate,'hot'=>$hot]);
    }
}
