<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品品牌</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>

<center> <h1>微商城后台登录
        </h1>
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
@if (session('msg'))
<div class="alert alert-danger">{{session('msg')}}</div>
@endif

<form class="form-horizontal" action="{{url('logindo')}}" method="post" role="form" enctype="multipart/form-data">
@csrf
<!--{{csrf_field()}}
<input type="hidden" name="_token" value="{{csrf_token()}}">-->
    <div class="form-group">
		<label for="firstname" class="col-sm-4 control-label">用户名</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" name="admin_name" id="firstname" 
				   placeholder="请输入用户名">
				   
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-4 control-label">密码</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" name="pwd" id="lastname" 
				   placeholder="请输入密码">
				   
		</div>
	</div>
        
	<div class="checkbox">
    <label>
      <input name="rember" type="checkbox">七天免登陆请记住我
    </label>
  	</div>
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-4">
			<button type="submit" class="btn btn-default">登录</button>
		</div>
	</div>
</form>

</body>
</html>