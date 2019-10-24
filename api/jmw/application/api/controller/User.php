<?php
namespace app\api\controller;
use app\common\controller\Home;
use app\api\model\Order;
use app\api\model\User as UDb;
use \think\Validate;
class User extends Home{

    public function _initialize(){
        parent::_initialize();
		$this->wechatAauth();
    }

    /**
     * 个人中心接口
     * author Jason
     * time    2019-09-30 
     * @return array
     */


    public function Index(){

        $userInfo = userdecode(input('userInfo'));
       
		$data = [];
        return_ajax('成功',200,$data);
    }

    /**
     * 用户个人信息查询
     * author  Jason
     * time    2019-10-17 
     * @cookie  userInfo    
     * @return array
     */
    public function info(){
		
		$userInfo = userdecode(input('userInfo'));
		
		
		
        $info = db('user')->where('id',$userInfo['id'])->field('somane,phone,username,sex,regdate')->find();
		
		if($info){
			return_ajax('成功',200,$info);
		}else{
			return_ajax('失败',400);
		}
		
    }
	/**
     * 用户个人信息修改
     * author  Jason
     * time    2019-10-17 
     * @cookie  userInfo    
     * @return array
     */
    public function infoModify(){
		
		$userInfo = userdecode(input('userInfo'));
		
		if( empty(input('somane')) ) 	return_ajax('真是姓名不能为空',400);
		if( empty(input('diyname')) ) 	return_ajax('昵称不能为空',400);
		if( empty(input('sex')) ) 		return_ajax('性别不能为空',400);
		
		$data['somane'] 	= input('somane');
		$data['diyname'] 	= input('diyname');
		$data['sex'] 		= input('sex');
		$data['showlogintime']= date("Y-m-d H:i:s",time()); 
		
		
        $info = db('user')->where('id',$userInfo['id'])->update($data);

        if( $info ){
			return_ajax('修改成功！',200);
		}else{
			return_ajax('修改失败！',400);
		}
       

    }
	
	/**
     * 用户头像修改
     * author  Jason
     * time    2019-09-30 
     * @param  img      	提交服务器后返回图片路径
     * @param  userInfo      用户加密信息
     * @return array
     */
    public function headerimg(){
        $userInfo = userdecode(input('userInfo'));
		
		if( empty(input('img')) ) 	return_ajax('图片不能为空',400);

        $data['img'] 	= input('img');
		$data['showlogintime']= date("Y-m-d H:i:s",time()); 
		
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
     * 用户信息查看接口
     * author  Jason
     * time    2019-10-18 
     * @param  id    产品id    
     * @cookie  userInfo    
     * @return array
     */
    public function getuser(){
		$userInfo = userdecode(input('userInfo'));
		$data['user'] = db('user')->where('id',$userInfo['id'])->field('username,somane,phone,sex,regdate,img,diyname')->find();
		$data['user']['regdate'] = date('Y-m-d',strtotime($data['user']['regdate']));
		$data['user']['img'] = photo_userpath($data['user']['img']);
		return_ajax('成功',200,$data);
    }


	/**
     * 提交收藏接口
     * author  Jason
     * time    2019-10-18 
     * @param  id    产品id    
     * @cookie  userInfo    
     * @return array
     */
    public function collectAdd(){
		
		$userInfo = userdecode(input('userInfo'));
		
		if( empty(input('id')) ) return_ajax('代理产品ID不能为空',400);
		$id = input('id');
		$count = db('usercollect')->where(['did'=>$id,'uid'=>$userInfo['id']])->column('id');
		//dump($count);exit();
		if( $count ){
			$info = db('usercollect')->where('id',$count[0])->delete();
			if( $info ){
				return_ajax('取消关注成功！',200);
			}else{
				return_ajax('取消关注失败！',400);
			}
			
		}else{
			$data['uid'] = $userInfo['id'];
			$data['did'] = $id;
			$data['add_time'] = time();
			$data['up_device'] = 1;
			$info = db('usercollect')->insert($data);
			if( $info ){
				return_ajax('关注成功！',200);
			}else{
				return_ajax('关注失败！',400);
			}
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
