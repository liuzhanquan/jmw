<?php
namespace app\common\controller;
use app\common\controller\Base;

class Home extends Base{

    protected $userLevel;
    protected $auth_user;

    public function _initialize(){
        parent::_initialize();
        //$this->wechatAauth();
        //$this->jssdk();
    }

    protected function wechatAauth(){
        //$cookie_user = userdecode(input('userInfo'))['id'];
        $cookie_user = userdecode(input('userInfo'));
		
        $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $user_data = db('user')->where('id',$cookie_user['id'])->find();
        if( empty($user_data) ){
            return_ajax('请先登录',400);
        }

        

    }

    protected function jssdk(){
        $weObj = initWechat();
        $auth = $weObj->checkAuth();
        $js_ticket = $weObj->getJsTicket();
        // if (!$js_ticket) {
        //     echo "获取js_ticket失败！<br>";
        //     echo '错误码：'.$weObj->errCode;
        //     echo ' 错误原因：'.ErrCode::getErrText($weObj->errCode);
        //     exit;
        // }
        $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $js_sign = $weObj->getJsSign($url);
        $this->assign('jssdk',$js_sign);
    }


    public function userInfo(){
        $userInfo = userdecode(input('userInfo'));
        //$userInfo = userdecode(input('userInfo'));

        $userlevel = db('user')->where('id',$userInfo['id'])->field('level,charge_time')->find();

        if( $userlevel['level'] == 0 ){
            return_ajax('请先激活会员',400);
        }
        if( $userlevel['charge_time'] < time() ){
            return_ajax('会员已过期，请激活',400);
        }

        return $userInfo;
    }

    public function configInfo(){
        $telPhone = db('config')->where('name','tel_phone')->column('value');
        $data['wx'] = $this->wx();
        $data['telPhone'] = $telPhone[0];
        return $data;
    }

    public function wx(){

        $wx = db('commentWeixin')->where('status',1)->select();
        $wx = $wx[mt_rand(0,count($wx)-1)];
        return $wx['wx'];

    }
	
	/**
     * 我的足迹添加
     * author  Jason
     * time    2019-10-17 
     * @cookie  userInfo    
     * @return array
     */
    public function footPrintAdd($did){
		
		if( !empty(input('userInfo')) ){
			$userInfo = userdecode(input('userInfo'));
			
			$id = db('footprint')->where(['did'=>$did,'uid'=>$userInfo['id']])->column('id');
			
			if( $id ){
				db('footprint')->where('id',$id[0])->update(['add_time'=>time()]);
			}else{
				$data['uid'] = $userInfo['id'];
				$data['did'] = $did;
				$data['add_time'] = time();
				$data['up_device'] = 1;
				$info = db('footprint')->insert($data);
			}
		}

    }
	

}



