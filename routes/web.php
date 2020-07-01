<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//闭包路由
// Route::get('/', function () {
//    // echo 123;
//     return view('welcome');
// });
Route::get('/index', function () {
    echo "hello";
});
Route::get('aaa',function(){
    echo "1912 Good";
});
//路由重定向 301 永久重定向 302 临时重定向  301永久重定向对seo优化比较友好 302对搜索引擎不好
Route::redirect('/index','/aaa');
//Route::permanentRedirect('/index','/aaa');

//走控制器方法的路由
Route::get('test','TestController@index');
Route::post('adddo','TestController@adddo');

Route::get('lists','StudentController@lists');
//Route::get('create','StudentController@create');
//Route::post('store','StudentController@store');

//一个路由支持多种请求方式
//Route::match(['get','post'],'create','StudentController@create');
Route::any('create','StudentController@create');


//路由视图
//Route::view('add','create',['name'=>'郑云龙']);
//Route::get('add', function () {
//    return view('create',['name'=>'郑云龙meimei']);
//});

Route::get('add','StudentController@create');
Route::get('exam','StudentController@exam');

Route::get('user', function () {
    return '没有参数 ' ; 
});
//路由传参  必填参数
//Route::get('user/{id}', function ($id) {
//    return 'User ' . $id; 
//});
//Route::get('user/{id}', 'StudentController@user');

Route::get('/goods/{id}/{name}','StudentController@goods');

//可选参数
// Route::get('category/{cate_id?}', function ($cate_id = 0) { 
//     return '分类id：'. $cate_id; 
// });

//Route::get('/goods/{id}/{name?}','StudentController@goods');

//正则约束
Route::get('user/{id}', 'StudentController@user')->where('id','\d+');
Route::get('/goods/{id}/{name}','StudentController@goods')->where(['id'=>'\d+','name'=>'[a-zA-Z]{2,12}']);

//cookie的练习
Route::get('setcookie','TestController@setcookie');
Route::get('getcookie','TestController@getcookie');

Route::domain('admin.1912.com')->group(function(){
    //品牌模块的增删改查
    Route::prefix('brand')->middleware('islogin')->group(function(){
        Route::get('/', 'Admin\BrandController@index');//列表
        Route::get('create', 'Admin\BrandController@create');//添加页面
        Route::post('store', 'Admin\BrandController@store');//执行添加
        Route::get('edit/{id}', 'Admin\BrandController@edit');//编辑页面
        Route::post('update/{id}', 'Admin\BrandController@update');//执行修改
       // Route::get('destroy/{id}', 'Admin\BrandController@destroy');//删除
        Route::match(['get','post'],'destroy/{id}', 'Admin\BrandController@destroy');
        Route::get('/checkname', 'Admin\BrandController@checkname');
    });
    //学生模块的增删改查
    Route::prefix('student')->middleware('islogin')->group(function(){
        Route::get('/', 'Admin\StudentController@index');//列表
        Route::get('create', 'Admin\StudentController@create');//添加页面
        Route::post('store', 'Admin\StudentController@store');//执行添加
        Route::get('edit/{id}', 'Admin\StudentController@edit');//编辑页面
        Route::post('update/{id}', 'Admin\StudentController@update');//执行修改
        Route::get('destroy/{id}', 'Admin\StudentController@destroy');//删除
        // Route::match(['post','get'],'destroy/{id}', 'Admin\StudentController@destroy');
    });

    Route::prefix('category')->middleware('islogin')->group(function(){
        Route::get('/','Admin\CategoryController@index');
        Route::get('/create','Admin\CategoryController@create');
        Route::post('/store', 'Admin\CategoryController@store');//执行添加
        Route::get('/destroy/{id}', 'Admin\CategoryController@destroy');
    });

    Route::view('/login','admin.login');
    Route::post('/logindo', 'Admin\LoginController@logindo');
});

Route::domain('www.1912.com')->group(function(){
    //前台展示
    Route::get('/', 'Index\IndexController@index');
    Route::get('/login', 'Index\LoginController@login');
    Route::post('/dologin', 'Index\LoginController@dologin');
    Route::get('/reg', 'Index\LoginController@reg');
    Route::get('/send', 'Index\LoginController@send');
    Route::post('/doreg', 'Index\LoginController@doreg');

    Route::get('/list/{cate_id}/{type?}', 'Index\CategoryController@index');
    Route::get('/goods/{id}', 'Index\GoodsController@index');
    Route::get('/addcart', 'Index\GoodsController@addcart');
});

 