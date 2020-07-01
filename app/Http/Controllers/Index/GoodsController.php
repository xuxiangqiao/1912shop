<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Cart;
use Illuminate\Support\Facades\Redis;
class GoodsController extends Controller
{
    public function index($goods_id){
    	//浏览量
    	$count = Redis::setnx('count_'.$goods_id,1)?:Redis::incr('count_'.$goods_id);

    	//$count = Redis::setnx('count_'.$goods_id,1)?1:Redis::incr('count_'.$goods_id);
    	
    	// $res = Redis::setnx('count_'.$goods_id,1);
    	// if($res){
    	// 	$count = 1;
    	// }else{
    	// 	$count = Redis::incr('count_'.$goods_id);
    	// }



    	//dd($res);
    	$goods = Goods::find($goods_id);

    	return view('index.goods',['goods'=>$goods,'count'=>$count]);
    }
    /**
     * [addcart 添加购物车]
     * 1: 判断 有没有登录 没：则登录 
     * 2：判断商品是否上下架 下架：提示 
     * 3 判断购买数量是否大于库存 大了：提示库存不足 
     * 4 判断之前用户有无添加过添加商品  添加过 ：购买数量  相加 ；加完后再判断库存  没有添加过：直接入库
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function addcart(Request $request){
    	$goods_id = $request->goods_id;
    	$buy_number = $request->buy_number;

    	//1判断 有没有登录 没：则登录 
    	$user = session('member');
    	if(!$user){
    		return response()->json(['code'=>'00001','msg'=>'未登录']);
    	}
    	//2：判断商品是否上下架 下架：提示 
    	$goods = Goods::find($goods_id);
    	if($goods->goods_up!=1){
    		return response()->json(['code'=>'00002','msg'=>'商品已下架']);
    	}
    	//3：判断购买数量是否大于库存 大了：提示库存不足 
    	if($buy_number>$goods['goods_number']){
    		return response()->json(['code'=>'00003','msg'=>'商品库存不足']);
    	}
    	//4判断之前用户有无添加过添加商品  添加过 ：购买数量  相加 ；加完后再判断库存  没有添加过：直接入库
    	$where = [
    		'user_id'=>$user->m_id,
    		'goods_id'=>$goods_id
    	];
    	$cart = Cart::where($where)->first();
    	if(!$cart){
    		//直接入库
    		$data = [
    			'user_id'=>$user->m_id,
    			'goods_id'=>$goods_id,
    			'buy_number'=>$buy_number,
    			'goods_name'=>$goods->goods_name,
    			'goods_img'=>$goods->goods_goods_img,
    			'goods_price'=>$goods->goods_price,
    		];
			$res = Cart::create($data);
			//dd($res);
    	}else{
    		//更新
    		$buy_number += $cart->buy_number;
    		if($buy_number>$goods['goods_number']){
    			$buy_number = $goods['goods_number'];
    		}

    		$res = Cart::where($where)->update(['buy_number'=>$buy_number]);
    	}
    	if($res){
    		return response()->json(['code'=>'00000','msg'=>'加入成功']);
    	}

    }





}
