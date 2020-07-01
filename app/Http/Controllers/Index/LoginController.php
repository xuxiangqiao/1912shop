<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Mail\SendCode;
use Illuminate\Support\Facades\Mail;
use App\Member;
class LoginController extends Controller
{
// 用户登录名称 xiangxiang@1620946937069960.onaliyun.com
// AccessKey ID LTAI4GAnf6PEAcZqFyCx4PN7
// SECRET 1WbPi6VkM5RV0YuLz8wJ4DPAF4cn9Q
    public function login(){
       // dd(encrypt(123456));
    	return view('index.login');
    }
    public function dologin(){
        $post = request()->all();
       // dd($post);
        //先根据用户名查询记录
        $user = Member::where('name',$post['name'])->first();
        //dd(decrypt($admin->pwd));
        if(!$user){
            return redirect('/login')->with('msg','用户名或者密码不对');
        }
        //解密密码跟￥post的对比是否一致
        if(decrypt($user->password)!=$post['password']){
            return redirect('/login')->with('msg','用户名或者密码不对');
        }

        request()->session()->put('member',$user);
        if(isset($post['refer'])){
            return redirect($post['refer']);
        }
        return redirect('/');

    }

    public function reg(){
    	return view('index.reg');
    }
    public function send(Request $request){
    	$name = $request->name;
    	//判断name是手机号还是邮箱
    	$reg = '/^1[3|4|5|6|7|8|9]\d{9}$/';
    	$reg_email = '/^\w{3,}@([a-z]{2,7}|[0-9]{3})\.(com|cn)$/';

    	$code = rand(1000,9999);
    	if(preg_match($reg,$name)){
    		//手机发送验证码
    		$res = $this->sendSms($name,$code);
    		//$res['Message']='OK';
    		if($res['Message']=='OK'){
    			$request->session()->put('code',$code);
    			return json_encode(['code'=>'00000','msg'=>'发送成功']);
    		}
    	}elseif(preg_match($reg_email,$name)){
    		//邮箱发送验证码
    		$this->sendMail($name,$code);
    		$request->session()->put('code',$code);
    		return json_encode(['code'=>'00000','msg'=>'发送成功']);
    	}else{
    		return json_encode(['code'=>'00000','msg'=>'请输入正确的手机号或者邮箱']);
    	}
    }
    /**
     * [邮件发送验证码]
     * @param  [type] $mail [要发送的地址]
     * @param  [type] $code [验证码]
     * @return [type]       [description]
     */
    public function sendMail($mail,$code){
    	return Mail::to($mail)->send(new SendCode($code));
    }


    public function sendSms($mobile,$code){

		// Download：https://github.com/aliyun/openapi-sdk-php
		// Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md

		AlibabaCloud::accessKeyClient('LTAI4GAnf6PEAcZqFyCx4PN7', '1WbPi6VkM5RV0YuLz8wJ4DPAF4cn9Q')
		                        ->regionId('cn-hangzhou')
		                        ->asDefaultClient();

		try {
		    $result = AlibabaCloud::rpc()
		                          ->product('Dysmsapi')
		                          // ->scheme('https') // https | http
		                          ->version('2017-05-25')
		                          ->action('SendSms')
		                          ->method('POST')
		                          ->host('dysmsapi.aliyuncs.com')
		                          ->options([
		                                        'query' => [
		                                          'RegionId' => "cn-hangzhou",
		                                          'PhoneNumbers' => $mobile,
		                                          'SignName' => "一品学堂",
		                                          'TemplateCode' => "SMS_184105081",
		                                          'TemplateParam' => "{code:$code}",
		                                        ],
		                                    ])
		                          ->request();
		    return $result->toArray();
		} catch (ClientException $e) {
		    return $e->getErrorMessage() . PHP_EOL;
		} catch (ServerException $e) {
		    return $e->getErrorMessage() . PHP_EOL;
		}
    }
    /**
     * [执行注册]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function doreg(Request $request){
    	$post = $request->except('_token');
    	//dump($post);
    	$code = $request->session()->get('code');
    	//dd($code);
    	//验证验证码是否正确
    	if($post['code']!=$code){
    		return redirect('/reg')->with('msg','验证码不对');
    	}
    	//判断两次密码是否一致
    	if($post['password']!=$post['repassword']){
			return redirect('/reg')->with('msg','两次密码不一致');
    	}

    	//入库
    	$reg = '/^1[3|4|5|6|7|8|9]\d{9}$/';
    	$reg_email = '/^\w{3,}@([a-z]{2,7}|[0-9]{3})\.(com|cn)$/';

    	if(preg_match($reg,$post['name'])){
    		$post['moblie'] = $post['name'];
    	}elseif(preg_match($reg_email,$post['name'])){
			$post['email'] = $post['name'];
    	}else{
    		return redirect('/reg')->with('msg','您的手机号或者邮箱不对');
    	}	

    	$post['password'] = encrypt($post['password']);
    	unset($post['repassword']);
    	unset($post['code']);
    	//dd($post);
    	$res = Member::create($post);
    	if($res){
    		return redirect('/login');
    	}
    }



}
