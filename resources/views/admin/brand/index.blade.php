<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品品牌</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        <a style="float:right;" href="{{url('/brand/create')}}">
            <button type="button" class="btn btn-success">添加</button>
        </a></h1>
</center>
<hr/>
<form>
	<input type="text" name="brand_name" value="{{$brand_name}}" placeholder='请输入品牌关键字'>
	<button>搜索</button>
</form>
<table class="table table-bordered">
	
	<thead>
		<tr>
			<th>品牌ID</th>
			<th>品牌名称</th>
                        <th>品牌网址</th>
                        <th>品牌LOGO</th>
                        <th>品牌描述</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
            @foreach($brand as $v)
		<tr>
			<td>{{$v->brand_id}}</td>
			<td>{{$v->brand_name}}</td>
			<td>{{$v->brand_url}}</td>
            <td>@if($v->brand_logo)<img src="{{env('UPLOADS_URL')}}{{$v->brand_logo}}" width="50">@endif
            </td>
			<td>{{$v->brand_desc}}</td>
			<td>
                            <a href="{{url('brand/edit/'.$v->brand_id)}}">
                                <button type="button" class="btn btn-primary">编辑</button>
                            </a>|
                            
                                <button type="button" id="{{$v->brand_id}}" class="btn btn-danger">删除</button>
                            
                        </td>
		</tr>
            @endforeach
        <tr>
        	<td colspan="6">{{$brand->appends(['brand_name'=>$brand_name])->links()}}</td>
        </tr>    
	</tbody>
</table>
<script>
    $('.btn-danger').click(function(){
        var brand_id = $(this).attr('id');
        var obj = $(this);
        //第一种ajax 删除
        // $.get('/brand/destroy/'+brand_id,function(res){
        //     if(res.code=='00000'){
        //         //obj.parent().parent().hide();
        //         location.reload();
        //     }
        // },'json');
        // 第二种ajax 删除
        $.ajaxSetup({ headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        } });
        $.post('/brand/destroy/'+brand_id,function(res){
            if(res.code=='00000'){
                obj.parent().parent().hide();
                //location.reload();
            }
        },'json');

    });




</script>
</body>
</html>
