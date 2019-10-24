<?php  
namespace app\api\model;
use \app\common\model\Base;

class Dlmessage extends Base{

	protected $auto = [];
	protected $insert = [];
	protected $update = [];
    protected $branchList = [];
    

    public function dl(){
		$res = $this->hasOne('dl','id','did')->field('id,classid,cp,title,photo');
		
		return $res;
	}
    
	
	
	

}