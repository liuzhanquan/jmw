<?php
namespace app\api\controller;
use app\common\controller\Home;
use \think\Validate;
use app\api\model\Dlmessage as DM;

class Dlmessage extends Home{

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
        $data['list'] = DM::where(['uid'=>$userInfo['id']])
						->limit(($page-1)*$limit,$limit)
						->order('sendtime desc')
						->field('id,phone,content,username,sex,did,sendtime,state')
						->select();
		
		$data['list'] = obj_arr($data['list']);
		
		if( !empty($data) ){
			foreach( $data['list'] as $key=>$item ){
				$info = db('dl')->alias('d')
						->join('dllist dl','dl.did = d.id')
						->where('d.id',$item['did'])
						->field('d.id,d.cp,d.photo,d.classid,d.title,dl.price_min,dl.price_max,dl.store_num,dl.join_num,dl.join_people')
						->find();
				$info['store_count'] = $info['store_num'] + $info['join_num'];
				$info['photo'] = photo_str_arr($info['photo']);
				$data['list'][$key]['dl'] = $info;
				$data['list'][$key]['sendtime'] = date('Y-m-d H:i:s',$item['sendtime']);
			}
		}
		
        return_ajax('成功',200,$data);
    }
	/**
     * 用户个人信息查询
     * author  Jason
     * time    2019-10-17 
     * @cookie  userInfo    
     * @return array
     */
    public function upmessage(){
		
		$userInfo = userdecode(input('userInfo'));
		
		if( empty(input('username')) ) 	return_ajax('用户名不能为空',400);
		if( empty(input('phone')) ) 	return_ajax('手机号不能为空',400);
		if( empty(input('content')) ) 	return_ajax('内容不能为空',400);
		if( empty(input('sex')) ) 		return_ajax('性别不能为空',400);
		if( empty(input('dl_id')) ) 	return_ajax('代理产品ID不能为空',400);
		if( !phoneNum(input('phone')) ) return_ajax('手机号格式不正确',400);
		
		$data['username'] 	= input('username');
		$data['phone'] 		= input('phone');
		$data['content'] 	= input('content');
		$data['sex'] 		= input('sex');
		$data['did'] 		= input('dl_id');
		$data['up_device'] 	= 1;
		$data['uid'] 		= $userInfo['id'];
		$data['sendtime']	= time(); 
		
		
		$Count = db('dlmessage')->where(['uid'=>$userInfo['id'],'did'=>input('dl_id')])->count();
		
		if($Count){
			return_ajax('您已提交申请，无需重复提交！',400);
		}
		
        $info = db('dlmessage')->insertGetId($data);

        if( $info ){
			return_ajax('提交成功！',200);
		}else{
			return_ajax('提交失败！',400);
		}
       

    }
	
   














}
