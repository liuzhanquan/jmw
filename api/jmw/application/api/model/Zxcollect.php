<?php  
namespace app\api\model;
use \app\common\model\Base;

class Zxcollect extends Base{

	protected $auto = [];
	protected $insert = [];
	protected $update = [];
    protected $branchList = [];
    

    public function zx(){
		$res = $this->hasOne('zx','id','zid')->field('id,title,laiyuan,bigclassname,smallclassname,content,sendtime,hit,editor');
		
		return $res;
	}
    
	
	
	

}