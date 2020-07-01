<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品品牌</title>
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
        <li class="active"><a href="{{url('brand')}}">商品品牌</a></li>
        <li><a href="{{url('cate_id')}}"">商品分类</a></li>
        <li><a href="{{url('goods')}}"">商品管理</a></li>
        <li><a href="{{url('admin')}}"">管理员管理</a></li>
        <li><a href="{{url('student')}}"">学生管理</a></li>
      </ul>
    </div>
  </div>
</nav>

<center> <h1>商品品牌
        <a style="float:right;" href="{{url('/brand')}}">
            <button type="button" class="btn btn-success">列表</button>
        </a></h1>
    </h1>
</center><hr/>
<form class="form-horizontal" action="{{url('brand/update/'.$brand->brand_id)}}" method="post" role="form" enctype="multipart/form-data">
@csrf
<!--{{csrf_field()}}
<input type="hidden" name="_token" value="{{csrf_token()}}">-->
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$brand->brand_name}}" name="brand_name" id="firstname" 
				   placeholder="请输入品牌名称">
			<b style="color:red">{{$errors->first('brand_name')}}</b>		   
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌网址</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$brand->brand_url}}" name="brand_url" id="lastname" 
				   placeholder="请输入品牌网址">
			<b style="color:red">{{$errors->first('brand_url')}}</b>		   
		</div>
	</div>
        <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌LOGO</label>
		<div class="col-sm-4">
			<input type="file" class="form-control" name="brand_logo" id="lastname" >
		</div>
		@if($brand->brand_logo)<img src="{{env('UPLOADS_URL')}}{{$brand->brand_logo}}" width="50">@endif
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌描述</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" name="brand_desc" id="lastname" 
                                  placeholder="请输入品牌描述">{{$brand->brand_desc}}</textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">编辑</button>
		</div>
	</div>
</form>

</body>
</html>