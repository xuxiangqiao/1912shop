<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>学生管理</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
        <li ><a href="{{url('brand')}}">商品品牌</a></li>
        <li><a href="{{url('cate_id')}}"">商品分类</a></li>
        <li><a href="{{url('goods')}}"">商品管理</a></li>
        <li><a href="{{url('admin')}}"">管理员管理</a></li>
        <li class="active"><a href="{{url('student')}}"">学生管理</a></li>
      </ul>
    </div>
  </div>
</nav>
<center> <h1>学生管理
        <a style="float:right;" href="{{url('/student')}}">
            <button type="button" class="btn btn-success">列表</button>
        </a></h1>
    </h1>
</center><hr/>
<form class="form-horizontal" action="{{url('student/store')}}" method="post" role="form">
@csrf
<!--{{csrf_field()}}
<input type="hidden" name="_token" value="{{csrf_token()}}">-->
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">学生名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="name" id="firstname" 
				   placeholder="请输入品牌名称">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">学生性别</label>
		<div class="col-sm-2">
                    <input type="radio"  name="sex"  checked="checked" value="1"> 男
                    <input type="radio"  name="sex"   value="2"> 女
                    <input type="radio"  name="sex"   value="3"> 人妖
		</div>
	</div>
        <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">学生年龄</label>
		<div class="col-sm-10">
			<input type="number" class="form-control" name="age" id="lastname" >
		</div>
	</div>
        <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">学生年级</label>
		<div class="col-sm-5">
			<select name="class" class="form-control">
                            <option value="">请选择年级</option>
                            <option value="1">1910</option>
                            <option value="2">1911</option>
                            <option value="3">1912</option>
                        </select>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">学生头像</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" name="head" id="lastname" >
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
