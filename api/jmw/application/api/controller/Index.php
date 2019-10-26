<?php
namespace app\api\controller;
use app\common\controller\Home;
class Index extends Home{

    public function _initialize(){
        parent::_initialize();
    }

    public function index(){

        return $this->showtpl('user/index');

    }
	
	public function customer(){
		$list = db('config')->where('name','like','phone%')->select();
		
		return_ajax('成功',200,$list);
	}
	
	//获取所有配置信息
	public function getconfig(){
		$list = db('config')->where('id',1)->find();
		$list['logo'] = photo_userpath($list['logo']);
		return_ajax('成功',200,$list);
	}
	//获取单个配置信息
	public function getconfigInfo(){
		if(empty(input('id'))) return_ajax('数据错误',400);
		$list = db('config')->where('id',1)->find();
		return_ajax('成功',200,$list);
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
