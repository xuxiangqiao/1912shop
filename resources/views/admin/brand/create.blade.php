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
        <li><a href="{{url('category')}}"">商品分类</a></li>
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

<!-- @if ($errors->any())
<div class="alert alert-danger">
	<ul>
	@foreach ($errors->all() as $error)
	<li>{{ $error }}</li> 
	@endforeach
	</ul> 
</div>
@endif -->
<form class="form-horizontal" action="{{url('brand/store')}}" method="post" role="form" enctype="multipart/form-data">
@csrf
<!--{{csrf_field()}}
<input type="hidden" name="_token" value="{{csrf_token()}}">-->
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="brand_name" id="firstname" 
				   placeholder="请输入品牌名称">
			<b style="color:red">{{$errors->first('brand_name')}}</b>	   
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌网址</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="brand_url" id="lastname" 
				   placeholder="请输入品牌网址">
			<b style="color:red">{{$errors->first('brand_url')}}</b>	   
		</div>
	</div>
        <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌LOGO</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" name="brand_logo" id="lastname" >
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌描述</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" name="brand_desc" id="lastname" 
                                  placeholder="请输入品牌描述"></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="button" class="btn btn-default">添加</button>
		</div>
	</div>
</form>
<script>
	$('input[name="brand_name"]').blur(function(){
		$(this).next().empty();
		var brand_name = $(this).val();
		var obj = $(this);
		var reg = /^[\u4e00-\u9fa5\w-]{2,15}$/;
		if(!reg.test(brand_name)){
			$(this).next().text('品牌名称需由中文、字母、数字、下划线长度2-15位组成');
			return;
		}
		//唯一性验证
		$.get('/brand/checkname',{brand_name:brand_name},function(res){
			if(res.count){
				obj.next().text('品牌名称已存在');
			}
		},'json');
	});
	$('input[name="brand_url"]').blur(function(){
		$(this).next().empty();
		var brand_url = $(this).val();
		if(!brand_url){
			$(this).next().text('品牌网址不能为空');
			return;
		}
	});

	$('button').click(function(){
		//品牌名称验证
		var brand_name = $('input[name="brand_name"]').val();
		var obj = $('input[name="brand_name"]');
		var reg = /^[\u4e00-\u9fa5\w-]{2,15}$/;
		if(!reg.test(brand_name)){
			obj.next().text('品牌名称需由中文、字母、数字、下划线长度2-15位组成');
			return;
		}
		//唯一性验证
		// $.get('/brand/checkname',{brand_name:brand_name},function(res){
		// 	if(res.count){
		// 		obj.next().text('品牌名称已存在');
		// 	}
		// },'json');
		var flag = false;
		$.ajax({
		   type: "get",
		   url: '/brand/checkname',
		   data: {brand_name:brand_name},
		   dataType:'json',
		   async:false,
		   success: function(res){
		     	if(res.count){
					obj.next().text('品牌名称已存在');
					flag = true;
				}
		   }
		});
		if(flag){
			return;
		}
		//网址验证
		var brand_url = $('input[name="brand_url"]').val();
		if(!brand_url){
			$('input[name="brand_url"]').next().text('品牌网址不能为空');
			return;
		}

		$('form').submit();

	});

</script>
</body>
</html>