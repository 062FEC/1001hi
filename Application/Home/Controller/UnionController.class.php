<?php 
namespace Home\Controller;
use Think\Controller;
class UnionController extends PublicsController{
	public function _initialize(){
		parent::_initialize();
	}
	
	public function index(){
		
		$union = M('atype_info');
		$ceo = $union->where('id = 78 ')->find();
		$xuanze = $union->where('id = 77 ')->find();
		$join = $union->where('id = 76 ')->find();
		
		$this->assign('ceo',$ceo);//总裁致辞
		$this->assign('xuanze',$xuanze);//选择1001 D.H.A
		$this->assign('join',$join);//加入1001 D.H.A
		$this->display();
	}
	
	
	
	
}





?>