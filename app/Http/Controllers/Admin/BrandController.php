<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Brand;
use App\Http\Requests\StoreBrandPost;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cache;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *  列表页
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $page = request()->page??1;
        //echo $page;
        // die;
        $brand_name = request()->brand_name;
       // dump($brand_name);
        $where = [];
        if($brand_name){
            $where[] = ['brand_name','like',"%$brand_name%"];
        }
      //  dump('brand_'.$page);
        $brand = Cache::get('brand_'.$page);
        //dump($brand);
        if(!$brand){
            //echo "DB ===";
            //DB操作
            //$brand = DB::table('brand')->orderBy('brand_id','desc')->get();
            //dump($brand);
            //orm操作
            $pageSize = config('app.pageSize');
            //DB::connection()->enableQueryLog();
            $brand = Brand::where($where)->orderBy('brand_id','desc')->paginate($pageSize);
            //$log = DB::getQueryLog();
            //dd($log);
            Cache::put('brand_'.$page,$brand,60);
        }
        return view('admin.brand.index',['brand'=>$brand,'brand_name'=>$brand_name]);
    }

    /**
     * Show the form for creating a new resource.
     * 添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/brand/create');
    }

    /**
     * Store a newly created resource in storage.
     * 执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    //第二章表单验证
    //public function store(StoreBrandPost $request)
    public function store(Request $request)
    {
        //第一种表单验证
        // $validatedData = $request->validate([
        //         'brand_name' => 'required|unique:brand',
        //         'brand_url' => 'required', 
        // ],[
        //     'brand_name.required'=>'品牌名称必填',
        //     'brand_name.unique'=>'品牌名称已存在',
        //     'brand_url.required'=>'品牌网址必填',
        // ]);
        
        //第三种验证
        $validator = Validator::make($request->all(), [
                //'brand_name' => 'required|unique:brand',
                'brand_name' => 'regex:/^[\x{4e00}-\x{9fa5}\w-]{2,15}$/u|unique:brand',
                'brand_url' => 'required', 
            ],[
            'brand_name.regex'=>'品牌名称需由中文、字母、数字、下划线长度2-15位组成',
            'brand_name.unique'=>'品牌名称已存在',
            'brand_url.required'=>'品牌网址必填',
        ]);
        if ($validator->fails()) {
                return redirect('brand/create')
                ->withErrors($validator) 
                ->withInput();
        }

        //$brand = $request->except('_token');
        //判断有无文件上传
        if($request->hasFile('brand_logo')){
            //文件上传
            $brand_logo = upload('brand_logo');
        }
        //DB操作
        //$res = DB::table('brand')->insert($brand);
        //orm操作
        $brand = new Brand;
        $brand->brand_name = $request->brand_name;
        $brand->brand_url = $request->brand_url;
        if(isset($brand_logo)){
            $brand->brand_logo = $brand_logo;
        }
        $brand->brand_desc = $request->brand_desc;
        $res = $brand->save();

        if($res){
            return redirect('brand');
        }
    }
    

    /**
     * Display the specified resource.
     * 预览详情
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * 编辑页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //DB
        //$brand = DB::table('brand')->where('brand_id',$id)->first(); 
        //ORM
       // $brand = Brand::find($id);    
        $brand = Brand::where('brand_id',$id)->first(); 
        return view('admin.brand.edit',['brand'=>$brand]);
    }

    /**
     * Update the specified resource in storage.
     * 执行编辑
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function update(StoreBrandPost $request, $id)
    public function update(Request $request, $id)
    {
         //第一种表单验证
        // $validatedData = $request->validate([
        //         //'brand_name' => 'required|unique:brand',
                // 'brand_name' => [
                //     'required',
                //     Rule::unique('brand')->ignore($id,'brand_id')
                // ],
        //         'brand_url' => 'required', 
        // ],[
        //     'brand_name.required'=>'品牌名称必填',
        //     'brand_name.unique'=>'品牌名称已存在',
        //     'brand_url.required'=>'品牌网址必填',
        // ]);
        
         $validator = Validator::make($request->all(), [
                'brand_name' => [
                    'required',
                    Rule::unique('brand')->ignore($id,'brand_id')
                ],
                'brand_url' => 'required', 
            ],[
            'brand_name.required'=>'品牌名称必填',
            'brand_name.unique'=>'品牌名称已存在',
            'brand_url.required'=>'品牌网址必填',
        ]);
        if ($validator->fails()) {
                return redirect('brand/edit/'.$id)
                ->withErrors($validator) 
                ->withInput();
        }

        //$brand = $request->except('_token');
        //判断有无文件上传
        if($request->hasFile('brand_logo')){
            //文件上传
            $brand_logo = upload('brand_logo');
        }
        //DB
        //$res = DB::table('brand')->where('brand_id',$id)->update($brand);
        //ORM
        $brand = Brand::find($id);
        $brand->brand_name = $request->brand_name;
        $brand->brand_url = $request->brand_url;
        if(isset($brand_logo)){
            $brand->brand_logo = $brand_logo;
        }
        $brand->brand_desc = $request->brand_desc;
        $res = $brand->save();

        if($res!==false){
            return redirect('brand');
        }
    }

    /**
     * Remove the specified resource from storage.
     * 删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // dd(request()->ajax());//判断是否是ajax请求

        //DB
        //$res = DB::table('brand')->where('brand_id',$id)->delete();
        //ORM
        $res = Brand::destroy($id);
        if($res){
            if(request()->ajax()){
                return json_encode(['code'=>'00000','msg'=>'删除成功']);
            }
            return redirect('brand');
        }
    }
    /**
     * 检查品牌名称的唯一性
     * @return [type] [description]
     */
    public function checkname(){
        $brand_name = request()->brand_name;
        $count = Brand::where('brand_name',$brand_name)->count();
        return json_encode(['code'=>'00000','count'=>$count]);

    }

}
