<?php
namespace Home\Controller;
use Think\Controller;
class SystemController extends PublicsController {
	public function _initialize(){
		parent::_initialize();
	}
	//1001酒店系统视图 
    public function index(){
       	$db = M('atype_info');
		$design = $db->where('type_id = 94')->order('num desc')->select();//酒店与业态设计
		$tbox = $db->where('type_id = 96')->order('num desc')->select();//T-Box
        $theory = $db->where('id = 37')->find();//水源净化自循环系统原理 
        $system = $db->where('id = 36')->find();//水源净化自循环系统优点
        $zhibiao = $db->where('id = 35')->find();//净化系统核心指标
        $bucao = $db->where('id = 34')->find();//有机洗涤用品和布草
        $housekeeper = $db->where('type_id = 100')->order('num desc')->select();//智能管家
        $operation = $db->where('type_id = 107')->order('num desc')->select();//运营系统
        $counselor = $db->where('type_id = 109')->order('num desc')->select();//酒店顾问
        $join = $db->where('id = 75')->find();//加盟资料
		
		$video = $db->where('id = 97')->find();//视频
       
	    $this->assign('video',$video);//视频 
		$this->assign('design',$design);//酒店与业态设计
		$this->assign('tbox',$tbox);//T-Box
		$this->assign('theory',$theory);//水源净化自循环系统原理
		$this->assign('system',$system);//水源净化自循环系统优点
		$this->assign('zhibiao',$zhibiao);//净化系统核心指标
		$this->assign('bucao',$bucao);//有机洗涤用品和布草
		$this->assign('housekeeper',$housekeeper);//智能管家
		$this->assign('operation',$operation);//运营系统
		$this->assign('counselor',$counselor);//酒店顾问
		$this->assign('join',$join);//加盟资料
		
		$this->display();
    }
}