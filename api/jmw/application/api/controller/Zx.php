<?php
namespace app\api\controller;
use app\common\controller\Home;

class Zx extends Home{

    public function _initialize(){
        parent::_initialize();
    }

    /**
     * 资讯文章列表
     * author Jason
     * time    2019-10-21 
     * @return array
     */
    public function Index(){
		
		//有没有提交分页 ，没有默认第一页
		empty(input('page')) ? $page = 1 : $page = input('page');
		//有没有提交每页数量 ，没有默认查询5条
		empty(input('limit')) ? $limit = 5 : $limit = input('limit');
		
		
        $data = model('zx')->zxrecommend($page,$limit);
		
        return_ajax('成功',200,$data);
    }

    
	/**
     * 资讯文章详细
     * author Jason
     * time    2019-10-21 
     * @return array
     */
	
    public function info(){
		
		$where = [];
		$where['passed'] = 1;
		//判断是否传产品ID
		if(empty(input('id'))) return_ajax('数据错误',200);
		$where['id'] = input('id');
		
		//每次查看增加文章点击数量
		$num = db('zx')->where('id',input('id'))->column('hit');
		db('zx')->where('id',input('id'))->update(['hit'=>(++$num[0])]);
		
		$data['info'] = db('zx')->where($where)->field('id,bigclassname,smallclassname,did,title,laiyuan,sendtime,hit,content,editor')->find();
		
		$data['info']['content'] = contentphotopath($data['info']['content']);
		$data['info']['pl_count'] = model('pinglun')->plcount(input('id'));
		
		$data['info']['img'] = model('user')->getuserimg($data['info']['editor']);
		
		$data['collect'] = 0;
		$data['user'] = [];
		if( !empty(input('userInfo')) ){
			$userInfo = userdecode(input('userInfo'));
			$status = db('zxcollect')->where(['zid'=>input('id'),'uid'=>$userInfo['id']])->count();
			$data['collect'] = $status;
			$data['user'] = db('user')->where('id',$userInfo['id'])->field('username,somane,phone,sex')->find();
		}
		if( !empty($data['info']['did']) ){
			$data['dl'] = model('dl')->one($data['info']['did']);
		}
		
		return_ajax('成功',200,$data);
		
	}

	/**
     * 资讯文章评论
     * author Jason
     * time    2019-10-21 
     * @return array
     */
	public function pinglun(){
		//有没有提交分页 ，没有默认第一页
		empty(input('page')) ? $page = 1 : $page = input('page');
		//有没有提交每页数量 ，没有默认查询5条
		empty(input('limit')) ? $limit = 5 : $limit = input('limit');
		empty(input('id')) ? $id = 0 : $id = input('id');
		
		$pl = db('pinglun')->alias('p')
				->where(['p.about'=>$id,'p.passed'=>1,'p.pid'=>0])
				->order('sendtime desc')
				->field('p.id,p.about,p.pid,p.user_id,p.content,p.sendtime')
				->limit((($page-1)*$limit),$limit)
				->select();
		foreach( $pl as $key=>$item ){
			$pl[$key]['user'] = [];
			if( !empty($item['user_id']) ){
				$pl[$key]['user'] = db('user')->where('id',$item['user_id'])->field('diyname,img')->find();
				$pl[$key]['user']['img'] = photo_userpath($pl[$key]['user']['img']);
			}
		}
		
		
		$list = $this->pl($pl);
		
		return_ajax('成功',200,$list);
	}

	public function pl($pl){
		$arr = [];
		foreach( $pl as $item ){
			$p = $item;
			$p['zan'] = $this->zanstatus($item['id']);
			$p['son'] = $this->plorder($item,$item['id']);
			$arr[] = $p;
		}
		return $arr;
	}

	public function plorder($pl,$pid = 0){
		$arr = [];
		$n = db('pinglun')->where(['passed'=>1,'pid'=>$pid])->order('sendtime desc')->field('id,about,pid,user_id,content')->select();
		
		foreach( $n as $key=>$item ){
			$n[$key]['user'] = [];
			if( !empty($item['user_id']) ){
				$n[$key]['user'] = db('user')->where('id',$item['user_id'])->field('diyname,img')->find();
				$n[$key]['user']['img'] = photo_userpath($n[$key]['user']['img']);
			}
		}
		
		if( !empty($n) ){
			foreach( $n as $k=>$i ){
				$n[$k]['zan'] = $this->zanstatus($i['id']);
				$n[$k]['son'] = $this->plorder($i,$i['id']);
			}
			$arr = $n;
		}
		
		return $arr;
	}

	public function zanstatus($pid){
		$status = 0;
		if( !empty(input('userInfo')) ){
			$userInfo = userdecode(input('userInfo'));
			$status = db('plzan')->where(['pid'=>$pid,'uid'=>$userInfo['id']])->count();
			
		}
		return $status;
	}








}
