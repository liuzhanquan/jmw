<?php  
namespace app\api\model;
use \app\common\model\Base;

class Zx extends Base{

    
    //发现  加盟资讯
	public function zxrecommend($page=1,$limit=''){
		$classname = '加盟资讯';
		$ad = db('ad')->where(['smallclassname'=>$classname,'bigclassname'=>'加盟资讯'])->order('elite desc,sendtime desc')->field('zx_id')->limit((($page-1)*$limit),$limit)->select();
		
			
			$res = $this->selectzx($page,$limit);
			
			if( !empty($res) ){
				foreach( $res as $key=>$item ){
					$res[$key]['img'] = contentphotoarr($item['content']);
					$res[$key]['content'] = contentphotopath($item['content']);
					$res[$key]['pl_count'] = db('pinglun')->where(['about'=>$item['id'],'passed'=>1])->count();
					$res[$key]['sendtime'] = date('Y-m-d',strtotime($item['sendtime']));
				}
			}
			
		
		
		if( empty($res) ) return_ajax('已到后一页',200);
		return $res;
	}
		

	public function selectzx($page,$limit){
		$where['passed'] = 1;
		$res = db('zx')
					->where($where)->field('id,bigclassid,bigclassname,smallclassid,smallclassname,title,img,laiyuan,laiyuan,hit,sendtime,content')->order('elite desc,sendtime desc')->limit(($page-1)*$limit,$limit)->select();
		return $res;
	}




}