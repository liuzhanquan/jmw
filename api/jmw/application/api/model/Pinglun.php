<?php  
namespace app\api\model;
use \app\common\model\Base;

class Pinglun extends Base{

	protected $auto = [];
	protected $insert = [];
	protected $update = [];
    protected $branchList = [];
    

    public function plcount($id){
		$res = $this->where(['about'=>$id,'passed'=>1])->count();
		
		
		return $res;
	}
    
	public function zx(){
		$res = $this->hasOne('zx','id','about')->field('id,title,content,hit');
		
		return $res;
	}
	
	

}