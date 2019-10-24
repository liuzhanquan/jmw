<?php  
namespace app\api\model;
use \app\common\model\Base;

class Zsclass extends Base{

	protected $auto = [];
	protected $insert = [];
	protected $update = [];
    protected $branchList = [];
    
    public function sAll(){
        $goods = $this->select();
        return $goods;
    }

    public function son(){
		return $this->hasMany('zsclass','parentid','classid')->where(['isshow'=>1])->field('classid,parentid,classname,img')->order('xuhao asc');
	}
	
    public function navAll(){
		$arr = $this->with('son')->where('parentid',0)->field('classid,parentid,classname,img')->order('xuhao asc')->select();
		$res = obj_arr($arr);
		foreach( $res as $key=>$item ){
			$res[$key]['img'] = photo_addpath($item['img']);
			if( !empty($item['son']) ){
				foreach( $item['son'] as $k=>$i ){
					$res[$key]['son'][$k]['img'] = photo_addpath($i['img']);
				}
			}
		}
		
		return $res;
	}
	
	public function navAll1(){
		$res[] = $this->wntj();
		$res[] = $this->rmfl();
		
		$na = $this->with('son')->where(['parentid'=>0,'isshow'=>1])->field('classid,parentid,classname')->order('xuhao asc')->select();
		$na = obj_arr($na);
		foreach($na as $item){
			$res[] = $item;
		}
		
		foreach( $res as $key=>$item ){
			if( !empty($item['son']) ){
				foreach( $item['son'] as $k=>$i ){
					$res[$key]['son'][$k]['img'] = photo_addpath($i['img']);
				}
			}
		}
		
		return $res;
	}
	
	public function wntj(){
		$classname = db('adclass')->where('classid','35')->field('classname')->find();
		$name = explode('-',$classname['classname']);
		$id = db('adclass')->where(['parentid'=>$classname['classname']])->column('dl_classid');
		$res = [];
		$res['classid'] = -1;
		$res['parentid'] = -1;
		if( !empty($name[1]) ){
			$res['classname'] = $name[1];
		}else{
			$res['classname'] = $name[0];
		}
		foreach( $id as $item ){
			$info = $this->where('classid',$item)->field('classname,classid,img')->find();
			$res['son'][] = $info;
		}
		$res = obj_arr($res);
		return $res;
	}
	
	public function rmfl(){
		$classname = db('adclass')->where('classid','36')->field('classname')->find();
		$name = explode('-',$classname['classname']);
		$id = db('adclass')->where(['parentid'=>$classname['classname']])->column('dl_classid');
		$res = [];
		$res['classid'] = -2;
		$res['parentid'] = -2;
		if( !empty($name[1]) ){
			$res['classname'] = $name[1];
		}else{
			$res['classname'] = $name[0];
		}
		
		foreach( $id as $item ){
			$info = $this->where(['classid'=>$item])->field('classname,classid,img')->find();
			$res['son'][] = $info;
		}
		$res = obj_arr($res);
		return $res;
	}
	

}