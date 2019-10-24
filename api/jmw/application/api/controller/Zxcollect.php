<?php
namespace app\api\controller;
use app\common\controller\Home;
use app\api\model\Zxcollect as Zc;
use app\api\model\Pinglun;

class Zxcollect extends Home{

    public function _initialize(){
        parent::_initialize();
		$this->wechatAauth();
    }

    /**
     * 资讯收藏查看接口
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
        $data['list'] = Zc::with('zx')->where('uid',$userInfo['id'])->limit(($page-1)*$limit,$limit)->order('add_time desc')->select();
		$data['list'] = obj_arr($data['list']);
		foreach( $data['list'] as $key=>$item ){
			$data['list'][$key]['zx']['content'] = contentphotoarr($item['zx']['content']);
			$data['list'][$key]['zx']['sendtime'] = date('Y-m-d',strtotime($item['zx']['sendtime']));
			$data['list'][$key]['collect'] = db('zxcollect')->where(['zid'=>$item['zid'],'uid'=>$userInfo['id']])->count();
			$data['list'][$key]['zx']['img'] = model('user')->getuserimg($data['list'][$key]['zx']['editor']);
		}
		
		
        return_ajax('成功',200,$data);
    }
	
	/**
     * 我的评论查看接口
     * author Jason
     * time    2019-10-24 
     * @return array
     */
    public function pllist(){
		
		//有没有提交分页 ，没有默认第一页
		empty(input('page')) ? $page = 1 : $page = input('page');
		//有没有提交每页数量 ，没有默认查询5条
		empty(input('limit')) ? $limit = 5 : $limit = input('limit');
		
		
        $userInfo = userdecode(input('userInfo'));
        $data['list'] = Pinglun::with('zx')->where(['user_id'=>$userInfo['id'],'passed'=>1])->field('id,about,user_id,content,sendtime')->limit(($page-1)*$limit,$limit)->order('sendtime desc')->select();
		$data['list'] = obj_arr($data['list']);
		foreach( $data['list'] as $key=>$item ){
			$data['list'][$key]['zx']['content'] = contentphotoarr($item['zx']['content']);
			$data['list'][$key]['sendtime'] = date('Y-m-d',strtotime($item['sendtime']));
			$data['list'][$key]['collect'] = db('zxcollect')->where(['zid'=>$item['user_id'],'uid'=>$userInfo['id']])->count();
			$data['list'][$key]['user'] = db('user')->where('id',$userInfo['id'])->field('diyname,img')->find();
			$data['list'][$key]['user']['img'] = photo_userpath($data['list'][$key]['user']['img']);
		}
		
		
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
		
		if( empty(input('id')) ) return_ajax('资讯ID不能为空',400);
		$id = input('id');
		$count = db('zxcollect')->where(['zid'=>$id,'uid'=>$userInfo['id']])->column('id');
		//dump($count);exit();
		if( $count ){
			$info = db('zxcollect')->where('id',$count[0])->delete();
			if( $info ){
				return_ajax('取消关注成功！',200);
			}else{
				return_ajax('取消关注失败！',400);
			}
			
		}else{
			$data['uid'] = $userInfo['id'];
			$data['zid'] = $id;
			$data['add_time'] = time();
			$data['up_device'] = 1;
			$info = db('zxcollect')->insert($data);
			if( $info ){
				return_ajax('关注成功！',200);
			}else{
				return_ajax('关注失败！',400);
			}
		}

    }


    

















}
