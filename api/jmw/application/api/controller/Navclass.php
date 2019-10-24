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
		$limit = 5;
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
	
	

    /**
     * 发送短信接口
     * author  Jason        
     * time    2019-09-30 
     * @param  phone      手机号
     * @return array
     */
    public function usersms(){

        if( !phoneNum(input('phone')) ) return_ajax('手机号格式不正确',400);

        $code = mt_rand(100000,999999);

        $data['phone'] = input('phone');
        $data['code']  = $code;
        $data['add_time'] = time();
        $info = db('sms')->where('phone',input('phone'))->column('add_time');
        

        if( empty($info[0]) ){
            $res = db('sms')->insert($data);
        }else{
			//判断时间是否大于60秒
			if( (time() - (int)$info[0]) < 60 ){
				return_ajax('一分钟内只能发送一次哦',400);
			}
            $res = db('sms')->where('phone',input('phone'))->update($data);
        }
        if( $res ){
            return_ajax('短信发送成功',200);
        }else{
            return_ajax('短信发送失败',400);
        }

    }














    /**
     * 查看短信验证码 测试用
     * author  Jason
     * time    2019-09-30 
     * @param  phone      手机号
     * @return array
     */
    public function PhoneCmsFind(){
        $phone = input('phone');
        $info = db('sms')->where('phone',$phone)->find();


        //判断时间是否大于60秒
        // if( (time() - (int)$info['add_time']) > 60 ){
        //     return_ajax('请获取新的验证码',400);
        // }

        return_ajax('验证码：'.$info['code'],400);
       

    }

    /**
     * 查看激活卡  测试用
     * author  Jason
     * time    2019-09-30 
     * @return array
     */

    public function getCard(){
        $info = db('agent_card')->select();


        return_ajax($info,400);
       

    }














}
