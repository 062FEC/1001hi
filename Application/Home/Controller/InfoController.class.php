<?php
namespace Home\Controller;
use Think\Controller;
class InfoController extends PublicsController{
	public function _initialize(){
		parent::_initialize();
	}
	public function index(){
		$db = M('atype_info');
		$where= array();
		
		if($_GET['type_id']){//接收查询类型 
			$where["type_id"] = $_GET['type_id'];
			
		}else{
			$where["type_id"] = array("in",array(115,116,117,118,119));
			
		}
		
		if(isset($_GET['more'])){//加载更多 不限制搜索条数 全部显示 
			$info = $db->where($where)->order('num desc')->select();
		}else{//默认显示20条数据 
			$info = $db->where($where)->order('num desc')->limit(20)->select();
		}
		
		$month_arr = array(
				'01'=>'一月',
				'02'=>'二月',
				'03'=>'三月',
				'04'=>'四月',
				'05'=>'五月',
				'06'=>'六月',
				'07'=>'七月',
				'08'=>'八月',
				'09'=>'九月',
				'10'=>'十月',
				'11'=>'十一月',
				'12'=>'十二月'
		);
		$type_arr = array(
				'115'	=> '活动更新',
				'116'	=> '消费者故事',
				'117'	=> '报道',
				'118'	=> '视频',
				'119'   => '资讯'
		);
		
		foreach($info as $k=>$v){
			
			$date1 = strtotime($v['date1']);
			
			$new_date1 = date('Y/m/d',$date1);
			
			$month = date('m',$date1);
			
			$info[$k]['date1'] = $new_date1;
			$info[$k]['month'] = $month_arr[$month];
			$info[$k]['label']  = $type_arr[$v['type_id']];
		}
		
		$this->assign('info',$info);
		$this->display();
	}
	
	//搜索
	public function search(){
		$keywords = $_REQUEST['keywords'];
		$db = M('atype_info');
		$where["cn_name"] = array("like","%".$keywords."%");
		$info = $db->where($where)->select();
		
		$month_arr = array(
				'01'=>'一月',
				'02'=>'二月',
				'03'=>'三月',
				'04'=>'四月',
				'05'=>'五月',
				'06'=>'六月',
				'07'=>'七月',
				'08'=>'八月',
				'09'=>'九月',
				'10'=>'十月',
				'11'=>'十一月',
				'12'=>'十二月'
		);
		$type_arr = array(
				'115'	=> '活动更新',
				'116'	=> '消费者故事',
				'117'	=> '报道',
				'118'	=> '视频',
				'119'   => '资讯'
		);
		
		foreach($info as $k=>$v){
				
			$date1 = strtotime($v['date1']);
				
			$new_date1 = date('Y/m/d',$date1);
				
			$month = date('m',$date1);
				
			$info[$k]['date1'] = $new_date1;
			$info[$k]['month'] = $month_arr[$month];
			$info[$k]['label']  = $type_arr[$v['type_id']];
		}
		
		$this->assign('keyword',$keywords);
		$this->assign('info',$info);
		$this->display('index');
	}
	//打开播放视频页面 
	public function openvideo(){
		$id = $_REQUEST['id'];//视频id
		$db = M('atype_info');
		$video = $db->where('id = '.$id)->find();
		
		$this->assign('video',$video);
		$this->display('video');
	}
	
}