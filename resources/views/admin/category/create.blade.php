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
        <a style="float:right;" href="{{url('/category')}}">
            <button type="button" class="btn btn-success">列表</button>
        </a></h1>
    </h1>
</center><hr/>

<!-- @if ($errors->any())
<div class="alert alert-danger">
	<ul>
	@foreach ($errors->all() as $error)
	<li>{{ $error }}</li> 
	@endforeach
	</ul> 
</div>
@endif -->
<form class="form-horizontal" action="{{url('category/store')}}" method="post" role="form" enctype="multipart/form-data">
@csrf
<!--{{csrf_field()}}
<input type="hidden" name="_token" value="{{csrf_token()}}">-->
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="cate_name" id="firstname" 
				   placeholder="请输入分类名称">
			<b style="color:red">{{$errors->first('cate_name')}}</b>	   
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">父级分类</label>
		<div class="col-sm-5">
			<select class="form-control" name="parent_id">
				<option value="0">请选择父级分类</option>
				@foreach($category as $v)
				<option value="{{$v->cate_id}}">{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</option>
				@endforeach
			</select>	   
		</div>
	</div>
        <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-2">
                    <input type="radio"  name="is_show"  checked="checked" value="1"> 是
                    <input type="radio"  name="is_show"   value="2"> 否
                    
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>

</body>
</html>