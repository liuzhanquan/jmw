<?php
namespace app\api\controller;
use app\common\controller\Home;
use app\api\model\Zsclass;
use app\api\model\Ad;

class Navclass extends Home{

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
		
		$data['banner'] = model('ad')->banner();
		$data['nav'] 	= model('dl')->nav(9);
		$data['rqpp']	= model('ad')->advert('16',1);
		
		
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
		//默认查询数量
		$limit = 5;
		//默认查找分页
		$page = 1;
		//默认查找数据 0 产品与文章  1 产品  2 文章
		$state = 0;
		$type = '为您推荐';
		if( !empty(input('type')) ) $type=input('type');
		if( !empty(input('limit')) ) $limit=(int)input('limit');
		if( !empty(input('page')) )  $page=(int)input('page');
		if( !empty(input('state')) ) $state=(int)input('state');
		
		$data = model('ad')->advert(input('type'),$state,$limit,$page);
		
		return_ajax('成功',200,$data);
	}
	
	/**
     * 广告接口
     * author  Jason        
     * time    2019-10-16 
     * @param  type      查找类型根据后台设置的广告api二级导航名 默认为您推荐
     * @param  page      分页
     * @param  limit     每次查找数量
     * @param  state     查找数据 0 产品与文章  1 产品  2 文章
     * @return array
     */
	public function recommend(){
		//默认查询数量
		$limit = 10;
		//默认查找分页
		$page = 1;
		//默认查找数据 0 产品与文章  1 产品  2 文章
		$state = 1;
		$type = '为您推荐';
		if( !empty(input('type')) ) $type=input('type');
		if( !empty(input('limit')) ) $limit=(int)input('limit');
		if( !empty(input('page')) )  $page=(int)input('page');
		if( !empty(input('state')) ) $state=(int)input('state');
		
		$data= model('ad')->recommend($type,$state,$limit,$page);
		//$data[] = model('ad')->zxrecommend($type,$state=2,$limit,$page);
		
		return_ajax('成功',200,$data);
	}
	/**
     * 广告接口
     * author  Jason        
     * time    2019-10-16 
     * @param  type      查找类型根据后台设置的广告api二级导航名 默认为您推荐
     * @param  page      分页
     * @param  limit     每次查找数量
     * @param  state     查找数据 0 产品与文章  1 产品  2 文章
     * @return array
     */
	public function zxrecommend(){
		//默认查询数量
		$limit = 5;
		//默认查找分页
		$page = 1;
		//默认查找数据 0 产品与文章  1 产品  2 文章
		$state = 0;
		$type = '首页资讯';
		if( !empty(input('type')) ) $type=input('type');
		if( !empty(input('limit')) ) $limit=(int)input('limit');
		if( !empty(input('page')) )  $page=(int)input('page');
		if( !empty(input('state')) ) $state=(int)input('state');
		
		$data = model('ad')->zxrecommend($type,$state,$limit,$page);
		
		return_ajax('成功',200,$data);
	}
	
	/**
     * 导航接口
     * author  Jason        
     * time    2019-10-16 
     * @param  type      查找类型根据后台设置的广告api二级导航名 默认为您推荐
     * @param  page      分页
     * @param  limit     每次查找数量
     * @param  state     查找数据 0 产品与文章  1 产品  2 文章
     * @return array
     */
	public function nav(){
		$data['nav'] 	= model('Zsclass')->navAll1();
		
		return_ajax('成功',200,$data);
	}
	
	

















}
