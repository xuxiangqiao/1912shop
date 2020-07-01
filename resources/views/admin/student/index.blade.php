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
        <a style="float:right;" href="{{url('/student/create')}}">
            <button type="button" class="btn btn-success">添加</button>
        </a></h1>
</center>
<hr/>
<table class="table table-bordered">
	
	<thead>
		<tr>
			<th>学生ID</th>
			<th>学生名称</th>
                        <th>学生性别</th>
                        <th>学生年龄</th>
                        <th>所属班级</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
            @foreach($student as $v)
		<tr>
			<td>{{$v->s_id}}</td>
			<td>{{$v->name}}</td>
			<td>@if($v->sex==1)男@elseif($v->sex==2)女@else人妖@endif</td>
                        <td>{{$v->age}}</td>
			<td>@if($v->class==1)1910 @elseif($v->class==2) 1911 @else 1912 @endif</td>
			<td>
                            <a href="{{url('student/edit/'.$v->s_id)}}">
                                <button type="button" class="btn btn-primary">编辑</button>
                            </a>|
                            <a href="{{url('student/destroy/'.$v->s_id)}}">
                                <button type="button" class="btn btn-danger">删除</button>
                            </a>
                        </td>
		</tr>
            @endforeach
	</tbody>
</table>

</body>
</html>
