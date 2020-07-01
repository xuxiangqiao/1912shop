<h1>添加学生</h1><hr/>
{{$name}}
<form method="post" action="{{url('create')}}">
    @csrf
    <input type="text" name="test">
    <button>添加学生</button>
</form>