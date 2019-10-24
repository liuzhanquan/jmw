<?php
namespace app\api\controller;
use app\common\controller\Home;
use app\api\model\Zxcollect as Zc;

class Plzan extends Home{

    public function _initialize(){
        parent::_initialize();
		$this->wechatAauth();
    }

    

    /**
     * 评论点赞接口
     * author  Jason
     * time    2019-10-18 
     * @param  id    产品id    
     * @cookie  userInfo    
     * @return array
     */
    public function zanAdd(){
		
		$userInfo = userdecode(input('userInfo'));
		
		if( empty(input('id')) ) return_ajax('评论ID不能为空',400);
		$id = input('id');
		$count = db('plzan')->where(['pid'=>$id,'uid'=>$userInfo['id']])->column('id');
		//dump($count);exit();
		if( $count ){
			$info = db('plzan')->where('id',$count[0])->delete();
			if( $info ){
				return_ajax('取消点赞成功！',200);
			}else{
				return_ajax('取消点赞失败！',400);
			}
			
		}else{
			$data['uid'] = $userInfo['id'];
			$data['pid'] = $id;
			$data['add_time'] = time();
			$data['up_device'] = 1;
			$info = db('plzan')->insert($data);
			if( $info ){
				return_ajax('点赞成功！',200);
			}else{
				return_ajax('点赞失败！',400);
			}
		}

    }


    

















}
