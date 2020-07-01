<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品分类</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">微商城</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="{{url('brand')}}">商品品牌</a></li>
        <li class="active"><a href="{{url('category')}}"">商品分类</a></li>
        <li><a href="{{url('goods')}}"">商品管理</a></li>
        <li><a href="{{url('admin')}}"">管理员管理</a></li>
        <li><a href="{{url('student')}}"">学生管理</a></li>
      </ul>
    </div>
  </div>
</nav>

<center> <h1>商品分类
        <a style="float:right;" href="{{url('/category/create')}}">
            <button type="button" class="btn btn-success">添加</button>
        </a></h1>
</center>
<hr/>

<table class="table table-bordered">
	
	<thead>
		<tr>
			<th>分类ID</th>
			<th>分类名称</th>
             <th>是否显示</th>
                        
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
            @foreach($category as $v)
		<tr>
			<td>{{$v->cate_id}}</td>
			<td>{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</td>
			<td>{{$v->is_show==1?'是':'否'}}</td>
            
			
			<td>
                            <a href="{{url('category/edit/'.$v->cate_id)}}">
                                <button type="button" class="btn btn-primary">编辑</button>
                            </a>|
                            <a href="{{url('category/destroy/'.$v->cate_id)}}">
                                <button type="button" class="btn btn-danger">删除</button>
                            </a>
                        </td>
		</tr>
            @endforeach
         
	</tbody>
</table>

</body>
</html>
