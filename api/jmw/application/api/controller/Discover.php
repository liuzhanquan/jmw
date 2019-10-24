<?php
namespace app\api\controller;
use app\common\controller\Home;
use app\api\model\Zsclass;
use app\api\model\Ad;

class Discover extends Home{

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
		
		//有没有提交分页 ，没有默认第一页
		empty(input('page')) ? $page = 1 : $page = input('page');
		//有没有提交每页数量 ，没有默认查询5条
		empty(input('limit')) ? $limit = 5 : $limit = input('limit');
		
		$data['all'] = model('adclass')->discover($page,$limit);
		$data['all']['加盟资讯'] = model('adclass')->zxrecommend($page,$limit);
		$data['all']['加盟排行榜'] = model('adclass')->jmphb('加盟排行榜');
		$data['all']['热门行业'] = model('adclass')->rmhy('热门行业');
		
		
        return_ajax('成功',200,$data);
    }
	
	
	
	/**
     * 广告接口
     * author  Jason        
     * time    2019-10-16 
     * @param  type      查找类型根据后台设置的广告api二级导航名
     * @param  page      分页
     * @param  limit     每次查找数量
     * @param  state     查找数据 0 产品与文章  1 产品  2 文章
     * @return array
     */
	public function coverllist(){
		//有没有提交分页 ，没有默认第一页
		empty(input('page')) ? $page = 1 : $page = input('page');
		//有没有提交每页数量 ，没有默认查询5条
		empty(input('limit')) ? $limit = 5 : $limit = input('limit');
		if( empty(input('classid')) ) return_ajax('发现类ID不能为空',400);
		
		$data['info']= model('adclass')->coverInfo(input('classid'));
		$data['list']= model('adclass')->coverList(input('classid'),$page,$limit);
		
		return_ajax('成功',200,$data);
	}
	
	
	/**
     * 发现导航接口
     * author  Jason        
     * time    2019-10-16 
     * @param  type      查找类型根据后台设置的广告api二级导航名
     * @param  page      分页
     * @param  limit     每次查找数量
     * @param  state     查找数据 0 产品与文章  1 产品  2 文章
     * @return array
     */
	public function nav(){
		$data['nav'] = db('adclass')->where(['parentid'=>'发现','nav_show'=>1])->field('classid,classname')->select();
		
		
		$nav = db('adclass')->where(['parentid'=>'A','nav_show'=>1,'classname'=>array('neq','发现')])->field('classid,classname,parentid')->order('xuhao asc,classid desc')->select();
		foreach( $nav as $item ){
			$data['nav'][] = $item;
		}
		
		
		return_ajax('成功',200,$data);
	}
	
	/**
     * 发现-内容获取接口
     * author  Jason        
     * time    2019-10-16 
     * @param  type      查找类型根据后台设置的广告api二级导航名
     * @param  page      分页
     * @param  limit     每次查找数量
     * @param  state     查找数据 0 产品与文章  1 产品  2 文章
     * @return array
     */
	public function navlist(){
		//有没有提交分页 ，没有默认第一页
		empty(input('page')) ? $page = 1 : $page = input('page');
		//有没有提交每页数量 ，没有默认查询5条
		empty(input('limit')) ? $limit = 5 : $limit = input('limit');
		
		$info = db('adclass')->where('classid',input('classid'))->field('classid,classname,parentid')->find();
		//判断是否是文章
		if( preg_match('/资讯/u',$info['classname']) ){
			$data['list'] = model('zx')->zxrecommend($page,$limit);
		}else{
			if( $info['parentid'] == 'A' ){
				$data = db('adclass')->where(['parentid'=>$info['classname'],'nav_show'=>1])->field('classid,classname,photo,remarks')->order('xuhao asc,classid desc')->select();
				foreach( $data as $key=>$item ){
					$data[$key]['count'] = db('ad')->where(['smallclassname'=>$item['classname'],'bigclassname'=>$info['classname']])->count();
				}
			}else{
				
				$data['info']= model('adclass')->coverInfo(input('classid'));
				$data['list']= model('adclass')->coverList(input('classid'),$page,$limit);
			}
		}
		
		return_ajax('成功',200,$data);
	}
	
	/**
     * 广告接口
     * author  Jason        
     * time    2019-10-16 
     * @param  type      查找类型根据后台设置的广告api二级导航名
     * @param  page      分页
     * @param  limit     每次查找数量
     * @param  state     查找数据 0 产品与文章  1 产品  2 文章
     * @return array
     */
	public function advert(){
		
		
		$data = model('ad')->advert(input('type'),$state,$limit,$page);
		
		return_ajax('成功',200,$data);
	}
	
	

	/**
     * 代理产品详细信息接口
     * author Jason
     * time    2019-10-16 
     * @return array
     */


    public function list(){
		$where = [];
		$where['d.passed'] = 1;
		//判断是否传产品ID
		if(empty(input('id'))) return_ajax('数据错误',200);
		$where['d.id'] = input('id');
		
		$data['info'] = model('dl')->alias('d')
						->join('dllist dl','dl.did = d.id')
						->where($where)
						->order('d.xuhao asc,d.sendtime desc')
						->field('d.id,d.cp,d.title,d.province,d.city,d.xiancheng,d.classid,d.photo,d.content,d.address,dl.dl_tag,dl.name,dl.reg_time,dl.store_num,dl.join_num,join_people,price_min,price_total,dl.price_list,boss_name,boss_addr,boss_birthday,boss_nature,boss_job,boss_interst,boss_content')
						->find();
						
		$data['info']['photo'] 	= photo_str_arr($data['info']['photo']);
		$data['info']['content'] 	= contentphotopath($data['info']['content']);
		$data['info']['dl_tag'] 	= dl_tag_arr($data['info']['dl_tag']);
		$data['info']['price_min'] 	= dl_price_arr($data['info']['price_min']);
		$data['info']['price_list'] = price_list_arr($data['info']['price_list']);
		
		$data['collect'] = 0;
		if( !empty(input('userInfo')) ){
			$userInfo = userdecode(input('userInfo'));
			$status = db('usercollect')->where(['did'=>input('id'),'uid'=>$userInfo['id']])->count();
			$data['collect'] = $status;
		}
		
		if( !empty($data) ) $this->footPrintAdd(input('id'));
		
		
        return_ajax('成功',200,$data);
    }


	




}
