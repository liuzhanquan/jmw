<?php  
namespace app\api\model;
use \app\common\model\Base;

class Ad extends Base{

	protected $auto = [];
	protected $insert = [];
	protected $update = [];
    protected $branchList = [];
    
    public function sAll(){
        $goods = $this->select();
        return $goods;
    }

    public function banner(){
		$classArr = db('adclass')->where('classid','14')->field('classid,classname')->find();
		$id = db('ad')->where(['bigclassname'=>$classArr['classname'],'smallclassname'=>'banner'])->order('xuhao')->column('dl_id');
		$bannerArr = [];
		//$bannerArr = db('dl')->where(['id'=>['in',$id],'passed'=>'1'])->field('id,photo')->select();
		foreach( $id as $item ){
			$bannerArr[] = db('dl')->where(['id'=>$item,'passed'=>'1'])->field('id,photo')->find();
		}
		foreach( $bannerArr as $key=>$item ){
			$bannerArr[$key]['photo'] = photo_str_arr($item['photo']);
		}
		
		return $bannerArr;
	}
    
	//$type  查询的类型  默认全部  1 代理产品 2 资讯
	public function advert($classid,$type = 0,$limit=5,$page=1){
		$classArr = db('adclass')->where('classid',$classid)->field('classid,classname,parentid')->find();
		
		$ad = db('ad')->where(['smallclassname'=>$classArr['classname'],'bigclassname'=>$classArr['parentid']])->order('xuhao asc')->field('dl_id,zx_id')->limit((($page-1)*$limit),$limit)->select();
		
		if( !empty($ad) ){
			if( $type == 0 || $type == 1 ){
				foreach( $ad as $item ){
					if( !empty($item['dl_id']) ){
						$res['dl'][] = db('dl')->alias('d')
						->join('zsclass z','z.classid = d.classid')
						->join('dllist dl','dl.did = d.id')
						->where(['d.id'=>$item['dl_id'],'passed'=>'1'])->field('d.id,d.photo,d.cp,d.title,z.classname,dl.price_min,dl.price_max')->find();
					}
				}
				
				foreach( $res['dl'] as $key=>$item ){
					$res['dl'][$key]['photo'] = photo_str_arr($item['photo']);
				}
			}
			if( $type == 0 || $type == 2 ){
				foreach( $ad as $item ){
					if( !empty($item['zx_id']) ){
						$res['zx'][] = db('zx')->where(['id'=>$item['zx_id'],'passed'=>'1'])->field('id,bigclassname,smallclassname,title,content')->find();
					}
				}
				
				foreach( $res['zx'] as $key=>$item ){
					$res['zx'][$key]['content'] = contentphotopath($item['content']);
				}
			}
		}else{
			return_ajax('已到后一页',200);
		}
		
		return $res;
	}
	
	//$type  查询的类型  默认全部  1 代理产品 2 资讯
	public function recommend($classname,$type = 0,$limit='',$page=1){
		$res = [];
		$ad = db('ad')->where(['smallclassname'=>$classname,'bigclassname'=>'api'])->order('xuhao asc')->field('dl_id,zx_id')->limit((($page-1)*$limit),$limit)->select();
		$adCount = db('ad')->where('smallclassname',$classname)->count();
		
		
		
			foreach( $ad as $item ){
				if( !empty($item['dl_id']) ){
					$res[] = db('dl')->alias('d')
						->join('zsclass z','z.classid = d.classid')
						->join('dllist dl','dl.did = d.id')
						->where(['d.id'=>$item['dl_id'],'passed'=>'1'])->field('d.id,d.photo,d.cp,d.title,dl.price_min,dl.price_max,dl.dl_advantag,dl.store_num,dl.join_num,dl.join_people')->find();
				}
			}
			
			if(!empty($res)){
				foreach( $res as $key=>$item ){
					$res[$key]['photo'] = photo_str_arr($item['photo']);
					$res[$key]['type'] = 1;
					$res[$key]['dl_advantag'] = dl_advantag_arr($item['dl_advantag']);
					$res[$key]['store_count'] = $item['store_num'] + $item['join_num'];
				}
			}
		
		$zx = $this->selectzx1($page,1);
		if( !empty($zx) && !empty($res) && count($res) >= $limit  ){
			$res[] = $zx;
		}
		
		return $res;
		
	}
	
	//$type  查询的类型  默认全部  1 代理产品 2 资讯
	public function zxrecommend($classname,$type = 0,$limit='',$page=1){
		
		$ad = db('ad')->where(['smallclassname'=>$classname,'bigclassname'=>'api'])->order('xuhao asc')->field('dl_id,zx_id')->limit((($page-1)*$limit),$limit)->select();
		$adCount = db('ad')->where('smallclassname',$classname)->count();
		
		if( empty($ad) && ($type == 0 || $type == 20) ){
			$page = (int)$page - ceil($adCount/$limit)+1;
			$res['zx'] = $this->selectzx($page,$limit);
			
			if( !empty($res['zx']) ){
				foreach( $res['zx'] as $key=>$item ){
					$res['zx'][$key]['img'] = photo_str_arr($item['img']);
					$res['zx'][$key]['content'] = contentphotopath($item['content']);
				}
			}
			
		}else{
			
			if( $type == 0 || $type == 2 ){
				foreach( $ad as $item ){
					if( !empty($item['zx_id']) ){
						$res['zx'][] = db('zx')->where(['id'=>$item['zx_id'],'passed'=>'1'])->field('id,bigclassname,smallclassname,title,laiyuan,hit,sendtime,content')->find();
					}
				}
				
				if( count($res['zx']) < $limit ){
					$page = (int)$page - ceil($adCount/$limit)+1;
					$dl = $this->selectzx($page,$limit);
					foreach( $dl as $item ){
						$res['dl'][] = $item;
					}
				}
				
				if( !empty($res['zx']) ){
					foreach( $res['zx'] as $key=>$item ){
						$res['zx'][$key]['content'] = contentphotoarr($item['content']);
					}
				}
			}
		}
		
		if( empty($res) ) return_ajax('已到后一页',200);
		return $res;
	}
	
	public function selectdl($page,$limit){
		$res = db('dl')->alias('d')
					->join('zsclass z','z.classid = d.classid')
					->join('dllist dl','dl.did = d.id')
					->where(['passed'=>'1'])->field('d.id,d.photo,d.cp,d.title,z.classname,dl.price_min,dl.price_max,dl.store_num,dl.join_num,dl.join_people')->order('d.xuhao asc,sendtime desc')->limit(($page-1)*$limit,$limit)->select();
		return $res;
	}
	
	public function selectzx($page,$limit){
		$res = db('zx')
					->where(['passed'=>'1'])->field('id,title,img,laiyuan,laiyuan,hit,sendtime,content')->order('elite desc,sendtime desc')->limit(($page-1)*$limit,$limit)->select();
		return $res;
	}
	public function selectzx1($page,$limit){
		$res = db('zx')
					->where(['passed'=>'1'])->field('id,title,img,laiyuan,laiyuan,hit,sendtime,content,smallclassname')->order('elite desc,sendtime desc')->limit(($page-1)*$limit,$limit)->select();
		if(!empty($res)){			
			$res[0]['type'] = 2;
			$res[0]['img'] = contentphotoarr($res[0]['content']);
			return $res[0];
		}
	}

}