<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function lists(){
        echo "学生列表";
    }
    public function goods($a,$b=null){
        echo $a;
        dd($b) ;
    }
    public function user($id){
        echo '控制器的方法：'.$id;
    }
    public function create(Request $request){
        //判断请求方式 是否是post
        $method = $request->method();
        dump($method);
        if($method =='POST'){
            $post = $request->all();
            //接收值 入库
            //code
            return redirect('/index');
        }
        return view('create',['name'=>'郑云龙xiaodi']);
    }
    public function store(Request $request){
        $post = $request->all();
        dump($post);
        dd($post);//dump die
        echo 123;
    }
    //数组题（可以使用数组函数，也可以自己封装方法）：
    //$array = [1,2,3,4,5];
    //1：请使用至少两种方法实现在3的前面添加一个元素 90，实
    //现最终的数组为$array = [1,2,90,3,4,5];
    public function exam(){
        //第一种： 下标
        $array = [1,2,3,4,5,6,7,8,9,10];
        //$this->addArray($array);
        //字符串
        //$this->addstr($array);
        //array_splice
        $this->addArray2($array);
    }
    public function addArray2($array){
        if(!count($array)){
           return;
       }
       foreach( $array as $k=>$v){
           if($v==3){
               $len = $k;
           }
       }
       $array2 = [90];
       array_splice($array, $len, 0,$array2 );
       dd($array);
       
    }
    public function addstr($array){
        if(!count($array)){
           return;
       }
       $str = implode(',',$array);
      // echo $str;
       $len = strpos($str,'3');
       $str = substr($str,0, $len).'90,'.substr($str,$len);
        $array = explode(',',$str);
      dd($array);
    }
    
    //array:5 [▼
//  0 => 1
//  1 => 2
//  2 => 90   
//  3 => 4   3=>3
//  4 => 5   4=>4
//           5=>5
//]
    //数组分割 array_chunk() 
    //数组追加（头部追加、 尾部追加）
    //合并数组 array_merge
    public function addArray($array){  
       if(!count($array)){
           return;
       }
       foreach( $array as $k=>$v){
           if($v==3){
               $len = $k;
           }
       }
       //数组分割 array_chunk() 
       $new_array = array_chunk($array,$len) ;
      // dump($new_array);
       list($a1,$a2,$a3) = $new_array;
      
       if(in_array(3,$a1)){
               array_unshift($a1,90);
       }
       if(in_array(3,$a2)){
               array_unshift($a2,90);
       }
       if(in_array(3,$a3)){
               array_unshift($a3,90);
       }
       $array = array_merge($a1,$a2,$a3);
       dump($array);
    }
    
    
}
