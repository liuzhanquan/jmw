<?php
namespace app\api\controller;
use app\common\controller\Home;
use app\api\model\Zsclass;
use app\api\model\Ad;
use think\Db;
class Product extends Home{

    public function _initialize(){
        parent::_initialize();
    }

    /**
     * 导航首页接口
     * author Jason
     * time    2019-10-16 
     * @return array
     */


    public function Index(){
		$where = [];
		$where['d.passed'] = 1;
		//判断是否有搜索关键词
		if( !empty(input('keyword')) ) $where['d.cp|d.title|dl.name|dl.title_list'] =['like','%'.input('keyword').'%'];
		//判断是否选择价格区间
		if(!empty(input('price'))){
			$bt = db('dlje')->where('id',input('price'))->find();
			
			$where['dl.price_min|dl.price_max'] = array('between',[$bt['price_min'],$bt['price_max']]);
		}
		if(!empty(input('classid'))){
			$class = dlclassarr(input('classid'));
			
			$where['d.classid'] = array('in',$class);
		}
		//有没有提交分页 ，没有默认第一页
		empty(input('page')) ? $page = 1 : $page = input('page');
		//有没有提交每页数量 ，没有默认查询5条
		empty(input('limit')) ? $limit = 5 : $limit = input('limit');
		
		
		
		
		$data['nav'] = model('Zsclass')->navAll();
		$data['section'] = db('dlje')->order('xuhao asc')->field('id,price_min,price_max')->select();
		
		/* $list = model('dl')->alias('d')
						->join('dllist dl','dl.did = d.id')
						->where($where)
						->limit((($page-1)*$limit),$limit)
						->order('d.xuhao asc,d.sendtime desc')
						->field('d.id,d.cp,d.title,d.classid,d.photo,dl.dl_advantag,dl.store_num,dl.join_num,dl.join_people,dl.price_min,dl.price_max')
						->select();
		$data['list'] = obj_arr($list);
		foreach( $data['list'] as $key=>$item ){
			$data['list'][$key]['photo'] = photo_str_arr($item['photo'])[0];
			//$data['list'][$key]['content'] = contentphotopath($item['content']);
			//$data['list'][$key]['dl_tag'] = dl_tag_arr($item['dl_tag']);
			$data['list'][$key]['dl_advantag'] = dl_advantag_arr($item['dl_advantag']);
			//$data['list'][$key]['price_list'] = price_list_arr($item['price_list']);
		} */
		
		
        return_ajax('成功',200,$data);
    }
	/**
     * 导航查询接口
     * author Jason
     * time    2019-10-23
     * @return array
     */
	public function selectlist(){
		$where = [];
		$where['d.passed'] = 1;
		//判断是否有搜索关键词
		if( !empty(input('keyword')) ) $where['d.cp|d.title|dl.name|dl.title_list'] =array('like','%'.input('keyword').'%');
		
		
		//判断是否选择价格区间
		if(!empty(input('price'))){
			$bt = db('dlje')->where('id',input('price'))->find();
			
			$where['dl.price_min|dl.price_max'] = array('between',[$bt['price_min'],$bt['price_max']]);
		}
		if(!empty(input('classid'))){
			$class = dlclassarr(input('classid'));
			
			$where['d.classid'] = array('in',$class);
		}
		//有没有提交分页 ，没有默认第一页
		empty(input('page')) ? $page = 1 : $page = input('page');
		//有没有提交每页数量 ，没有默认查询5条
		empty(input('limit')) ? $limit = 5 : $limit = input('limit');
		
		
		$list = model('dl')->alias('d')
						->join('dllist dl','dl.did = d.id')
						->where($where)
						->limit((($page-1)*$limit),$limit)
						->order('d.xuhao asc,d.sendtime desc')
						->field('d.id,d.cp,d.title,d.classid,d.photo,dl.dl_advantag,dl.store_num,dl.join_num,dl.join_people,dl.price_min,dl.price_max')
						->select(); 
		
		$data['list'] = obj_arr($list);
		foreach( $data['list'] as $key=>$item ){
			$data['list'][$key]['photo'] = photo_str_arr($item['photo'])[0];
			//$data['list'][$key]['content'] = contentphotopath($item['content']);
			//$data['list'][$key]['dl_tag'] = dl_tag_arr($item['dl_tag']);
			$data['list'][$key]['dl_advantag'] = dl_advantag_arr($item['dl_advantag']);
			//$data['list'][$key]['price_list'] = price_list_arr($item['price_list']);
		}
		
		
        return_ajax('成功',200,$data);
    }
	
	
	/**
     * 找相似
     * author  Jason        
     * time    2019-10-16 
     * @param  id        产品id
     * @param  userInfo  用户加密字符串
     * @return array
     */
	public function alike(){
		$this->wechatAauth();
		$userInfo = userdecode(input('userInfo'));
		empty(input('limit'))? $limit = 6: $limit = input('limit');
		$id = 0;
		$id = input('id');
		
		$data['info'] = db('dl')->alias('d')
						->join('dllist dl','dl.did = d.id')
						->where('d.id',$id)
						->field('d.id,d.cp,d.title,d.classid,dl.store_num,dl.join_num,dl.join_people,d.photo,dl.price_min,dl.price_max')
						->find();
		$data['info']['photo'] = photo_str_arr($data['info']['photo']);
		$data['info']['store_count'] =$data['info']['store_num'] + $data['info']['join_num'];
		$data['list'] = db('dl')->alias('d')
						->join('dllist dl','dl.did = d.id')
						->where(['d.classid'=>$data['info']['classid'],'d.id'=>array('neq',$id)])
						->field('d.id,d.cp,d.title,d.classid,dl.store_num,dl.join_num,dl.join_people,d.photo,dl.price_min,dl.price_max')
						->limit($limit)
						->select();
		
		foreach( $data['list'] as $key=>$item ){
			$data['list'][$key]['photo'] = photo_str_arr($data['list'][$key]['photo']);
			$data['list'][$key]['collect'] = db('usercollect')->where(['did'=>$item['id'],'uid'=>$userInfo['id']])->count();
		}
		
		
		return_ajax('成功',200,$data);
		
	}
	/**
     * 猜你喜欢
     * author  Jason        
     * time    2019-10-16 
     * @param  id        产品id
     * @return array
     */
	public function alove(){
		$userInfo = userdecode(input('userInfo'));
		empty(input('limit'))? $limit = 6: $limit = input('limit');
		$id = 0;
		$id = input('id');
		
		$info = db('dl')
						->where('id',$id)
						->field('classid')
						->find();
		
		$data['list'] = db('dl')->alias('d')
						->join('dllist dl','dl.did = d.id')
						->where(['d.classid'=>$info['classid'],'d.id'=>array('neq',$id)])
						->field('d.id,d.cp,d.title,d.classid,dl.store_num,dl.join_num,dl.dl_advantag,dl.join_people,d.photo,dl.price_min,dl.price_max')
						->limit($limit)
						->select();
		
		foreach( $data['list'] as $key=>$item ){
			$data['list'][$key]['meat'] = mt_rand(80,96).'%';
			$data['list'][$key]['photo'] = photo_str_arr($item['photo']);
			$data['list'][$key]['store_count'] = $item['store_num'] + $item['join_num'];
			$data['list'][$key]['dl_advantag'] = dl_advantag_arr($item['dl_advantag']);
		}
		
		
		return_ajax('成功',200,$data);
		
	}



	/**
     * 代理产品详细信息接口
     * author Jason
     * time    2019-10-16 
     * @return array
     */


    public function productlist(){
		$where = [];
		$where['d.passed'] = 1;
		//判断是否传产品ID
		if(empty(input('id'))) return_ajax('数据错误',200);
		$where['d.id'] = input('id');
		
		//每次查看增加产品点击数量
		$num = db('dl')->where('id',input('id'))->column('hit');
		db('dl')->where('id',input('id'))->update(['hit'=>(++$num[0])]);

		$data['info'] = model('dl')->alias('d')
						->join('dllist dl','dl.did = d.id')
						->where($where)
						->order('d.xuhao asc,d.sendtime desc')
						->field('d.id,d.cp,d.title,d.province,d.city,d.xiancheng,d.classid,d.photo,d.content,d.address,d.hit,dl.dl_tag,dl.name,dl.title_list,dl.reg_time,dl.store_num,dl.join_num,join_people,dl.price_min,dl.price_max,dl.price_total,dl.price_list,boss_name,boss_addr,boss_birthday,boss_nature,boss_job,boss_interst,boss_content')
						->find();
						
		$data['info']['photo'] 	= photo_str_arr($data['info']['photo']);
		$data['info']['content'] 	= contentphotopath($data['info']['content']);
		$data['info']['dl_tag'] 	= dl_tag_arr($data['info']['dl_tag']);
		$data['info']['price_list'] = price_list_arr($data['info']['price_list']);
		
		//添加关联文章
		$zx = db('zx')->where('did',input('id'))->field('id,bigclassname,smallclassname,title,laiyuan,content,hit')->limit(3)->select();
		foreach( $zx as $key=>$item ){
			$zx[$key]['content'] = contentphotoarr($item['content']);
			$zx[$key]['pl_count'] = db('pinglun')->where('about',$item['id'])->count();
		}
		$data['zx'] = $zx;
		$data['collect'] = 0;
		//获取客户留言申请
		$data['message'] = $this->dlmessage(input('id'));
		
		$data['user'] = [];
		if( !empty(input('userInfo')) ){
			$userInfo = userdecode(input('userInfo'));
			$status = db('usercollect')->where(['did'=>input('id'),'uid'=>$userInfo['id']])->count();
			$data['collect'] = $status;
			$data['user'] = db('user')->where('id',$userInfo['id'])->field('username,somane,phone,sex')->find();
		}
		
		if( !empty($data) ) $this->footPrintAdd(input('id'));
		
		
        return_ajax('成功',200,$data);
    }

	
	public function dlmessage($did){
		$res = db('dlmessage')->alias('dm')
				->join('user u','u.id = dm.uid')
				->where(['dm.did'=>$did])
				->limit(5)
				->field('dm.sendtime,dm.content,u.somane,u.img,u.sex,dm.up_device')
				->select();
		
		foreach($res as $key=>$item){
			$res[$key]['sendtime'] = date('Y-m-d H:i:s',$item['sendtime']);
		}
		
		return $res;
	}

	/**
     * 代理产品详细信息接口
     * author Jason
     * time    2019-10-16 
     * @return array
     */
	public function usersimulation(){
		$res['img'] = imgsimulation();
		$res['title'] = usersimulation();
		
		
		return_ajax( '成功',200,$res );
	}



}
