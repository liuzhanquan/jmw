<?php  
namespace app\api\model;
use \app\common\model\Base;

class Adclass extends Base{

	protected $auto = [];
	protected $insert = [];
	protected $update = [];
    protected $branchList = [];
    
	//发现广告
    public function discover($page,$limit){
        $nav = $this->where(['parentid'=>'发现'])->field('classid,classname')->select();
		foreach( $nav as $item ){
			$arr[$item['classname']] = db('ad')->alias('a')
										->join('dl d','d.id = a.dl_id')
										->join('dllist dl','dl.did = a.dl_id')
										->where(['a.bigclassname'=>'发现','a.smallclassname'=>$item['classname']])
										->field('d.cp,d.classid,d.title,d.photo,dl.price_min,dl.price_max,dl.dl_advantag,dl.store_num,dl.join_num,dl.join_people')
										->limit(($page-1)*$limit,$limit)
										->order('a.xuhao asc')
										->select();
		}
		
		$zsclass = db('zsclass')->field('classname,classid')->select();
		foreach( $arr as $key=>$item ){
			foreach( $item as $k=>$i ){
				$arr[$key][$k]['photo'] = photo_str_arr($i['photo']);
				$arr[$key][$k]['dl_advantag'] = dl_advantag_arr($i['dl_advantag']);
				foreach( $zsclass as $z ){
					if( $z['classid'] == $i['classid'] ){
						$arr[$key][$k]['classname'] = $z['classname'];
					}
				}
			}
		}
		
        return $arr;
    }
	
	//发现  加盟资讯
	public function zxrecommend($page=1,$limit=''){
		$classname = '加盟资讯';
		$ad = db('ad')->where(['smallclassname'=>$classname,'bigclassname'=>'加盟资讯'])->order('xuhao asc')->field('zx_id')->limit((($page-1)*$limit),$limit)->select();
		$adCount = db('ad')->where('smallclassname',$classname)->count();
		
		if( empty($ad)){
			$page = (int)$page - ceil($adCount/$limit)+1;
			$res = $this->selectzx($page,$limit);
			
			if( !empty($res) ){
				foreach( $res as $key=>$item ){
					$res[$key]['img'] = photo_str_arr($item['img']);
					$res[$key]['content'] = contentphotopath($item['content']);
				}
			}
			
		}else{
			$id_arr = [];
			foreach( $ad as $item ){
				if( !empty($item['zx_id']) ){
					$res[] = db('zx')->where(['id'=>$item['zx_id'],'passed'=>'1'])->field('id,bigclassname,smallclassname,title,laiyuan,hit,sendtime,content')->find();
					$id_arr = $item['zx_id'];
				}
			}
			
			if( count($res) < $limit ){
				$page = (int)$page - ceil($adCount/$limit)+1;
				$dl = $this->selectzx($page,$limit,$id_arr);
				foreach( $dl as $item ){
					$res[] = $item;
				}
			}
			
			if( !empty($res) ){
				foreach( $res as $key=>$item ){
					$res[$key]['content'] = contentphotoarr($item['content']);
				}
			}
		}
		
		if( empty($res) ) return_ajax('已到后一页',200);
		return $res;
	}
	
	public function selectzx($page,$limit,$id = []){
		if( !empty($id) ){
			$where['id'] = array('neq',$id);
		}
		$where['passed'] = 1;
		$res = db('zx')
					->where($where)->field('id,title,img,laiyuan,laiyuan,hit,sendtime,content')->order('elite desc,sendtime desc')->limit(($page-1)*$limit,$limit)->select();
		return $res;
	}
	
	//发现   加盟排行榜
    public function jmphb($pname){
        $nav = $this->where(['parentid'=>$pname])->field('classid,classname,remarks,photo')->select();
		$nav = obj_arr($nav);
		$arr = [];
		if(!empty($nav)){
			foreach( $nav as $item ){
				$count = db('ad')
						->where(['bigclassname'=>$pname,'smallclassname'=>$item['classname']])
						->count();
				if( $count ){
					$arr[$item['classname']]['count'] = $count;
					$arr[$item['classname']]['tag'] = $item['remarks'];
					$arr[$item['classname']]['classid'] = $item['classid'];
					$arr[$item['classname']]['photo'] = photo_str_arr($item['photo']);
				}
						
			}
		}
        return $arr;
    }
	
	//发现   加盟排行榜
    public function rmhy($pname){
        $nav = $this->where(['parentid'=>$pname])->field('classid,classname,remarks,photo,dl_classid')->select();
		$nav = obj_arr($nav);
		$arr = [];
		
		if(!empty($nav)){
			foreach( $nav as $item ){
				$pid = db('zsclass')->where('classid',$item['dl_classid'])->column('parentid');
				
				if( !$pid[0] ){
					$id = db('zsclass')->where('parentid',$item['dl_classid'])->column('classid');
					
				}else{
					$id = $item['dl_classid'];
				}
				$count = db('dl')
						//->where(['classid'=>array('in',$id)])
						->where(['classid'=>array('in',$id)])
						->count();
				if( $count ){
					$arr[$item['classname']]['count'] = $count;
					$arr[$item['classname']]['tag'] = $item['remarks'];
					$arr[$item['classname']]['classid'] = $item['classid'];
					$arr[$item['classname']]['photo'] = photo_str_arr($item['photo']);
				}
						
			}
		}
		
        return $arr;
    }
	
	//发现   加盟排行榜/热门行业  信息列表
    public function coverInfo($classid){
        //查询广告类详细信息
		$info = db('adclass')->where('classid',$classid)->field('classname,parentid,photo,remarks,dl_classid')->find();
		
		$info['photo'] = photo_str_arr($info['photo']);
		
		//查询广告类名称
		$zsclass = db('zsclass')->where('classid',$info['dl_classid'])->field('classname,parentid')->find();
		$info['dl_classname'] = $zsclass['classname'];
		//统计该类有多少广告数
		$info['count'] = db('ad')->where(['smallclassname'=>$info['classname'],'bigclassname'=>$info['parentid']])->count();
		
        return $info;
    }
	
	//发现   加盟排行榜/热门行业  信息列表
	public function coverList($classid,$page,$limit){
		//查询广告类详细信息
		$info = db('adclass')->where('classid',$classid)->field('classname,parentid,dl_classid')->find();
		//查询广告代理产品id集合
		$idArr = db('ad')->where(['smallclassname'=>$info['classname'],'bigclassname'=>$info['parentid']])->column('dl_id');
		//查询代理产品详细信息
		$list = db('dl')->alias('d')
						->join('dllist dl','dl.did = d.id')
						->where('d.id','in',$idArr)
						->field('d.cp,d.id,d.photo,d.hit,dl.dl_advantag,dl.price_min,dl.price_max,dl.store_num,dl.join_num,dl.join_people')
						->limit((($page-1)*$limit),$limit)
						->select();
						
		foreach( $list as $key=>$item ){
			$list[$key]['photo'] = photo_str_arr($item['photo']);
			$list[$key]['dl_advantag'] = dl_advantag_arr($item['dl_advantag']);
			$list[$key]['store_count'] = $item['store_num'] + $item['join_num'];
		}
		
		
		
		return $list;
		
	}
	
	
	
   
}