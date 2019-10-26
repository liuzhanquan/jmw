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
	



    







}
