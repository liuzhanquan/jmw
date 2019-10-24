<?php
namespace app\api\controller;
use app\common\controller\Home;
use app\api\model\Usermessage as UM;

class Usermessage extends Home{

    public function _initialize(){
        parent::_initialize();
		$this->wechatAauth();
    }

    /**
     * 我的足迹接口
     * author Jason
     * time    2019-09-30 
     * @return array
     */


    public function Index(){

		//有没有提交分页 ，没有默认第一页
		empty(input('page')) ? $page = 1 : $page = input('page');
		//有没有提交每页数量 ，没有默认查询5条
		empty(input('limit')) ? $limit = 5 : $limit = input('limit');
		
        $userInfo = userdecode(input('userInfo'));
        $data['list'] = UM::where('uid',$userInfo['id'])->limit(($page-1)*$limit,$limit)->order('sendtime desc')->select();
		
		
		
        return_ajax('成功',200,$data);
    }

    /**
     * 意见反馈添加
     * author  Jason
     * time    2019-10-17 
     * @cookie  userInfo    
     * @return array
     */
    public function updata(){
		
		
		if( empty(input('content')) ) 	return_ajax('内容不能为空',400);
		if( empty(input('phone')) ) 	return_ajax('手机号不能为空',400);
		if( !phoneNum(input('phone')) ) return_ajax('手机号格式不正确',400);
		
		if( !empty(input('username')) ){
			$data['username'] = input('username');
		}
		
		if( !empty(input('userInfo')) ){
			$userInfo = userdecode(input('userInfo'));
			$data['uid'] = $userInfo['id'];
		}
		$data['phone'] 		= input('phone');
		$data['content'] 	= input('content');
		$data['sendtime'] 	= date('Y-m-d H:i:s',time());
		
        $info = UM::insert($data);

        
        if( $info ){
            return_ajax('提交成功',200);
        }else{
            return_ajax('提交失败',400);
		}
       

    }
	/**
     * 用户个人信息查询
     * author  Jason
     * time    2019-10-17 
     * @cookie  userInfo    
     * @return array
     */
    public function infoModify(){
		
		$userInfo = userdecode(input('userInfo'));
		
		if( empty(input('username')) ) 	return_ajax('用户名不能为空',400);
		//if( empty(input('phone')) ) 	return_ajax('手机号不能为空',400);
		if( empty(input('somane')) ) 	return_ajax('真是姓名不能为空',400);
		if( empty(input('sex')) ) 		return_ajax('性别不能为空',400);
		//if( empty(input('code')) ) 		return_ajax('验证码',400);
		
		$data['username'] 	= input('username');
		$data['phone'] 		= input('phone');
		$data['somane'] 	= input('somane');
		$data['sex'] 		= input('sex');
		$data['regdate']	= date("Y-m-d H:i:s",time()); 
		if( !empty(input('code')) ){
			$this->checkPhoneCms(input('phone'),input('code'));
			$data['phone'] = input('phone');
		}
		$nameCount = db('user')->where(['username'=>$data['username']])->count();
		
		if($nameCount){
			return_ajax('用户名已存在！',400);
		}
		
        $info = db('user')->where('id',$userInfo['id'])->update($data);

        if( $info ){
			return_ajax('修改成功！',200);
		}else{
			return_ajax('修改失败！',400);
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
        if( (time() - (int)$info['add_time']) > 60 ){
            return_ajax('验证码已过期，请获取新的验证码',400);
        }

        if( md5($info['code']) !== md5($code) ){
            return_ajax('验证码错误',400);
        }
       

    }



    














    /**
     * 查看短信验证码 测试用
     * author  Jason
     * time    2019-09-30 
     * @param  phone      手机号
     * @return array
     */
    public function PhoneCmsFind(){
        $phone = input('phone');
        $info = db('sms')->where('phone',$phone)->find();


        //判断时间是否大于60秒
        // if( (time() - (int)$info['add_time']) > 60 ){
        //     return_ajax('请获取新的验证码',400);
        // }

        return_ajax('验证码：'.$info['code'],400);
       

    }

    /**
     * 查看激活卡  测试用
     * author  Jason
     * time    2019-09-30 
     * @return array
     */

    public function getCard(){
        $info = db('agent_card')->select();


        return_ajax($info,400);
       

    }














}
