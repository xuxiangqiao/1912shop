<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class TestController extends Controller
{
    public function index(){
        
        return view('add');
    }
    public function adddo(){
        
        echo "提交成功";
    }
    //设置cookie
    public function setcookie(){
    	//第一种
    	//return response('1912 hello')->cookie('user', '张静涛', 2);
    	//第二种
    	//Cookie::queue(Cookie::make('user', 'xiaozhang', 1));
    	//第三种
    	Cookie::queue('user', 'lisi', 1);
    }
    //取cookie
    public function getcookie(Request $request){
    	//第一种
    	//dd($request->cookie('user'));
    	//第二种
    	dd(Cookie::get('user'));
    }

}
