<?php
namespace app\api\controller;
use app\common\controller\Home;
use app\api\model\Order;
use app\api\model\User as UDb;
use \think\Validate;
class Pinglun extends Home{

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
     * 提交收藏接口
     * author  Jason
     * time    2019-10-18 
     * @param  id    产品id    
     * @cookie  userInfo    
     * @return array
     */
    public function pinglunAdd(){
		
		$userInfo = userdecode(input('userInfo'));
		if( empty(input('zid')) ) return_ajax('资讯文章ID不能为空',400);
		$data['user_id']= $userInfo['id'];
		$data['about'] 	= input('zid');
		$data['pid'] 	= input('pid');
		$data['content']= input('content');
		$data['ip']		= $_SERVER['REMOTE_ADDR'];
		$data['up_device']= 1;
		$data['sendtime'] = date("Y-m-d H:i:s",time());
		
		$info = db('pinglun')->insert($data);
		
		if( $info ){
			return_ajax('提交成功！',200);
		}else{
			return_ajax('提交失败！',400);
		}

    }




}
