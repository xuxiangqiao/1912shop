<?php
	/**
	 * [单文件上传]
	 * @param  [type] $filename [description]
	 * @return [type]           [description]
	 */
    function upload($filename){
        $file = request()->file($filename);
        if ($file->isValid()){
            $path = $file->store('uploads');
            return  $path;
        }
        exit('文件上传过程出错');   
    }

	/**
     * 无限极分类
     * @param  [type]  $data      [要处理的数据]
     * @param  integer $parent_id [父级分类ID]
     * @param  integer $level     [级别 1级最大]
     * @return [type]             [array]
     */
    function createTree($data,$parent_id=0,$level=0){
        if(!$data) return;

        static $newArray = [];
        foreach($data as $v){
            if($v->parent_id==$parent_id){
                $v->level = $level;
                $newArray[] = $v;
                createTree($data,$v->cate_id,$level+1);
            }
        }
        return $newArray;
    }