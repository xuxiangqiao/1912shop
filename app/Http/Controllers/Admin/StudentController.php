<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = DB::table('student')->orderBy('s_id','desc')->get();
        return view('admin.student.index',['student'=>$student]);
    }

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.student.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = $request->except('_token');
        $res = DB::table('student')->insert($student);
        if($res){
            return redirect('student');
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
     *编辑页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $student = DB::table('student')->where('s_id',$id)->first();
        return view('admin.student.edit',['student'=>$student]);
    }
    /**
     * Update the specified resource in storage.
     *执行编辑
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $student = $request->except('_token');
        $res = DB::table('student')->where('s_id',$id)->update($student);
        if($res!==false){
            return redirect('student');
        }
    }

    /**
     * Remove the specified resource from storage.
     *删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = DB::table('student')->where('s_id',$id)->delete();
        if($res){
            return redirect('student');
        }
    }
}
