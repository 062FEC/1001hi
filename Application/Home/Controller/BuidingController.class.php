<?php 
namespace Home\Controller;
use Think\Controller;
class BuidingController extends PublicsController{
	public function _initialize(){
		parent::_initialize();
	}
	
	public function index(){
		
		$db = M('atype_info');
		if(isset($_GET['more'])){//加载更多 不限制搜索条数 全部显示 
			$buiding = $db->where('type_id = 121')->order('num desc')->select();
		}else{//默认显示20条数据 
			$buiding = $db->where('type_id = 121')->order('num desc')->limit(20)->select();
		}
		
		$code = $db->where('id = 91')->find();
		
		$this->assign('code',$code);//二维码
		$this->assign('buiding',$buiding);
		$this->display();
	}
	
	
	
	
}





?>