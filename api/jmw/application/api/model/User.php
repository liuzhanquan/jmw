<?php  
namespace app\api\model;
use \app\common\model\Base;

class User extends Base{

	protected $auto = [];
	protected $insert = [];
	protected $update = [];
    protected $branchList = [];
    

    public function getuserimg($username){
		$img = $this->where('username',$username)->field('img')->find();
		$res = photo_userpath($img['img']);
		
		
		return $res;
	}
    
	
	
	

}