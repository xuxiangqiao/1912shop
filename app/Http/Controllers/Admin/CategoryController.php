<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //父级分类
        $category = Category::all();
        //dd($category);
        //无限极分类
        $category = createTree($category);
        //dd($category);
        return view('admin.category.index',['category'=>$category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //父级分类
        $category = Category::all();
        //dd($category);
        //无限极分类
        $category = createTree($category);
        //dd($category);
        return view('admin.category.create',['category'=>$category]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request->except('_token');

        // $category = new Category;
        // $category->cate_name = $post['cate_name'];
        // $category->parent_id = $post['parent_id'];
        // $category->is_show = $post['is_show'];
        // $res = $category->save();
        
        //$res = Category::insert($post);
        $res = Category::create($post);
        if($res){
            return redirect('/category');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //检查有没有子分类
        $count = Category::where('parent_id',$id)->count();
        if($count>0){
          echo "<script>alert('该分类下有子分类，不能删除此分类');history.go(-1);</script>";  die;
        }else{
            $res = Category::destroy($id);
            if($res){
                return redirect('category');
            }
        }
   }
        
}
