  @extends('index.layouts.shop')
  @section('title','阿里妈妈注册')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <b style="color:red">{{session('msg')}}</b>
     <form action="{{url('/doreg')}}" method="post" class="reg-login">
      @csrf
      <h3>已经有账号了？点此<a class="orange" href="{{url('/login')}}">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" name="name" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList2"><input type="text" name="code" placeholder="输入短信验证码" /> <button type="button">获取验证码</button></div>
       <div class="lrList"><input type="password" name="password" placeholder="设置新密码（6-18位数字或字母）" /></div>
       <div class="lrList"><input type="password" name="repassword" placeholder="再次输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="button" value="立即注册" />
      </div>
     </form><!--reg-login/-->
    <script>
    $('button').click(function(){
        var name = $('input[name="name"]').val();
        $.get('/send',{name:name},function(res){
          if(res.code=='00000'){
            alert(res.msg);
          }
        },'json')
     });   
    $('input[type="button"]').click(function(){
       var name = $('input[name="name"]').val();
       if(!name){
          alert('请输入正确的手机号或者邮箱');
          return;
       }
       var code = $('input[name="code"]').val();
       if(!code){
          alert('请输入验证码');
          return;
       }
       var password = $('input[name="password"]').val();
       var reg = /^[a-zA-Z\d]{6,18}$/;
       //alert(reg.test(password));
       if(!reg.test(password)){
          alert('请输入密码（6-18位数字或字母）');
          return;
       }
       var repassword = $('input[name="repassword"]').val();
       if(password!==repassword){
          alert('两次密码不一致');
          return;
       }
       $('form').submit();

    })

     </script>

    @endsection
