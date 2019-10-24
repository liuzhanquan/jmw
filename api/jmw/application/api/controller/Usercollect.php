<?php
namespace app\api\controller;
use app\common\controller\Home;
use app\api\model\Usercollect as UC;

class Usercollect extends Home{

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
        $data['list'] = db('usercollect')->alias('f')
						->join('dl d','d.id = f.did')
						->join('dllist dl','dl.did = f.did')
						->where('uid',$userInfo['id'])
						->field('f.id,f.did,f.uid,d.cp,d.title,d.photo,dl.price_min,dl.price_max,dl.store_num,dl.join_num,dl.join_people,f.add_time')
						->limit(($page-1)*$limit,$limit)
						->order('add_time desc')
						->select();
						
		$data['list'] = obj_arr($data['list']);
		
		foreach( $data['list'] as $key=>$item ){
			$data['list'][$key]['photo'] = photo_str_arr($item['photo']);
			$data['list'][$key]['store_count'] = $item['store_num'] + $item['join_num'];
			$data['list'][$key]['add_time'] = date('Y-m-d',$item['add_time']); 
			$data['list'][$key]['dlcollect'] = db('dlmessage')->where(['did'=>$item['did'],'uid'=>$userInfo['id']])->count();
			$data['list'][$key]['collect'] = db('usercollect')->where(['did'=>$item['did'],'uid'=>$userInfo['id']])->count();
			$data['list'][$key]['store_count'] = $item['store_num'] + $item['join_num'];
		}
		
		
        return_ajax('成功',200,$data);
    }

    /**
     * 我的足迹添加
     * author  Jason
     * time    2019-10-17 
     * @cookie  userInfo    
     * @return array
     */
    public function add(){
		
		$userInfo = userdecode(input('userInfo'));
		
		
		
        $info = db('user')->where('id',$userInfo['id'])->field('somane,phone,username,sex,regdate')->find();
		dump($info);exit();

        //判断时间是否大于60秒
        if( (time() - (int)$info['add_time']) > 60 ){
            return_ajax('验证码已过期，请获取新的验证码',400);
        }

        if( md5($info['code']) !== md5($code) ){
            return_ajax('验证码错误',400);
        }
       

    }
	/**
     * 用户个人信息查询
     * author  Jason
     * time    2019-10-17 
     * @cookie  userInfo    
     * @return array
     */
    public function infoModify(){
		
		$userInfo = userdecode(input('userInfo'));
		
		if( empty(input('username')) ) 	return_ajax('用户名不能为空',400);
		//if( empty(input('phone')) ) 	return_ajax('手机号不能为空',400);
		if( empty(input('somane')) ) 	return_ajax('真是姓名不能为空',400);
		if( empty(input('sex')) ) 		return_ajax('性别不能为空',400);
		//if( empty(input('code')) ) 		return_ajax('验证码',400);
		
		$data['username'] 	= input('username');
		$data['phone'] 		= input('phone');
		$data['somane'] 	= input('somane');
		$data['sex'] 		= input('sex');
		$data['regdate']	= date("Y-m-d H:i:s",time()); 
		if( !empty(input('code')) ){
			$this->checkPhoneCms(input('phone'),input('code'));
			$data['phone'] = input('phone');
		}
		$nameCount = db('user')->where(['username'=>$data['username']])->count();
		
		if($nameCount){
			return_ajax('用户名已存在！',400);
		}
		
        $info = db('user')->where('id',$userInfo['id'])->update($data);

        if( $info ){
			return_ajax('修改成功！',200);
		}else{
			return_ajax('修改失败！',400);
		}
       

    }
	
    /**
     * 短信验证
     * author  Jason
     * time    2019-09-30 
     * @param  phone   手机号
     * @param  code    验证码    
     * @return array
     */
    public function checkPhoneCms($phone,$code){

        $info = db('sms')->where('phone',$phone)->find();


        //判断时间是否大于60秒
        if( (time() - (int)$info['add_time']) > 60 ){
            return_ajax('验证码已过期，请获取新的验证码',400);
        }

        if( md5($info['code']) !== md5($code) ){
            return_ajax('验证码错误',400);
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
