<?php  
namespace app\api\model;
use \app\common\model\Base;

class Dl extends Base{

	protected $auto = [];
	protected $insert = [];
	protected $update = [];
    protected $branchList = [];
    

    public function nav($num , $pid=0){
		$res = db('zsclass')->where(['showindex'=>1])->limit($num)->field('classid,classname,img')->order('xuhao asc')->select();
		foreach( $res as $key=>$item ){
			$res[$key]['img'] = photo_str_arr($item['img']);
		}
		
		return $res;
	}
    
	public function one( $id ){
		$res = $this->alias('d')
				->join('dllist dl','dl.did = d.id')
				->where('d.id',$id)
				->field('d.id,d.cp,d.photo,d.title,dl.price_min,dl.price_max,dl.store_num,dl.join_num,dl.join_people')
				->find();
		$res['photo'] = photo_str_arr($res['photo']);
		$res['store_count'] = $res['store_num'] + $res['join_num'];
	
		return $res;
	}
	
	

}