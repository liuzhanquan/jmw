<?php
namespace app\api\controller;
use app\common\controller\Base;

class Login extends Base{

    public function _initialize(){
        parent::_initialize();
    }

    public function login(){
        
        //empty(input('phone')) ? return_ajax("数据错误",400) : $phone = input('phone');
        empty(input('username')) ? return_ajax("登录账号不能为空",400) : $username = input('username');
        empty(input('password')) ? return_ajax("登录账号不能为空",400) : $password = input('password');
		
        $info = db('user')->where('username',$username)->find();
		//用户名搜索为空的时候
		if( empty($info) ){
			$info = db('user')->where('phone',$username)->find();
		}
        if( empty($info) ){
			return_ajax('账号不存在，请先注册',400);
        }else{
			$state = $this->passvitify(input('password'),$info['password']);
        }
		if( $state ){
			$userinfo = ['id'=>$info['id'],'log_time'=>time()];
            $userinfo = userencode($userinfo);
			return_ajax('登录成功', 200, $userinfo);
		}
		return_ajax('登录失败', 400);
            

    }
	
	public function passvitify($postPass,$password){
		if( md5($postPass) === $password ){
			return true;
		}else{
			return_ajax('密码错误', 400);
		}
	}
	
	/**
     * 发送短信接口
     * author  Jason        
     * time    2019-09-30 
     * @param  phone      	手机号
     * @param  username     用户名
     * @param  password     密码
     * @param  code      	验证码
     * @return array
     */
    public function register(){

        if( !phoneNum(input('phone')) ) return_ajax('手机号格式不正确',400);
		if( !preg_match('/^[A-Za-z0-9_\x{4e00}-\x{9fa5}]+$/u',input('username')) ){
			return_ajax('用户名只能中文、字母、数字下划线，不能使用特殊符号',400);
		}
		
		if( !preg_match('/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/',input('email')) ){
			return_ajax('邮箱格式错误',400);
		}
		
		if( input('usersf') == 0 ){
			$data['usersf'] = '个人';
		}else{
			$data['usersf'] = '公司';
			$data['conpany'] = input('conpany');
		}
		
		$info = db('user')->where('phone',input('phone'))->column('id');
		if( $info )	return_ajax('该手机号已被绑定，无法重复使用',400);
		
		$info = db('user')->where('username',input('username'))->column('id');
		if( $info )	return_ajax('用户名已存在',400);
		
		if( input('passdefine') != input('password') ) return_ajax('两次密码不一致',400);
		
		$data['username'] 	= input('username');
		$data['phone']		= input('phone');
		$data['password']   = md5(input('password'));
		$data['passwordtrue']= input('password');
		$data['email']		= input('email');
		$data['somane']		= input('somane');
		$data['logins']		= 0;
		$data['lockuser']	= 0;
		$data['groupid']	= 0;
		$data['totleRMB']	= 0;
		$data['elite']		= 0;
		$data['renzheng']	= 0;
		$data['passed']		= 0;
		$data['regdate']	= date('Y-m-d H:i:s',time());
		$res = db('user')->insertGetId($data);
		$ndata['diyname']   = '用户10100'.$res;
		db('user')->where('id',$res)->update($ndata);
        if( $res ){
            return_ajax('注册成功',200);
        }else{
            return_ajax('注册失败',400);
        }

    }
	
	/**
     * 发送短信接口
     * author  Jason        
     * time    2019-09-30 
     * @param  phone      手机号
     * @return array
     */
    public function getsms(){

        if( !phoneNum(input('phone')) ) return_ajax('手机号格式不正确',400);

        $code = mt_rand(100000,999999);

        $data['phone'] = input('phone');
        $data['code']  = $code;
        $data['add_time'] = time();
        $info = db('sms')->where('phone',input('phone'))->column('add_time');
        

        if( empty($info[0]) ){
            $res = db('sms')->insert($data);
        }else{
			//判断时间是否大于60秒
			if( (time() - (int)$info[0]) < 60 ){
				return_ajax('一分钟内只能发送一次哦',400);
			}
            $res = db('sms')->where('phone',input('phone'))->update($data);
        }
        if( $res ){
            return_ajax('短信发送成功',200);
        }else{
            return_ajax('短信发送失败',400);
        }

    }
	
	/**
     * 短信验证
     * author  Jason
     * time    2019-09-30 
     * @param  phone   手机号
     * @param  code    验证码    
     * @return array
     */
    public function checkPhoneCms($phone,$code){

        $info = db('sms')->where('phone',$phone)->find();


        //判断时间是否大于60秒
        if( (time() - (int)$info['add_time']) > 70 ){
            return_ajax('验证码已过期，请获取新的验证码',400);
        }

        if( md5($info['code']) !== md5($code) ){
            return_ajax('验证码错误',400);
        }
       

    }
	
	
    public function errors(){
        // $msgLink = '<a href="'.urlDiy('/user/index').'">去审核</a>';
        // $msgData = "亲，你有下级代理授权申请\n申请人：王生\n手机号：13265961104\n申请时间：".date('Y-m-d H:i:s')."\n\n".$msgLink;
        // SendWxMessage($msgData,$this->user_data['openid']);
        $authorization = db('user_auth')->where('uid',$this->user_data['id'])->find();
        if($authorization['status'] > 0){
            return $this->redirect(url('/user/index'));die;
        }else{
            return $this->showtpl('user/error');
        }
    }
}
