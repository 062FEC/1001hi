<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends PublicsController {
	public function _initialize(){
		parent::_initialize();
	}
	//首页视图
    public function index(){
        $ban = M('atype_info');
		$banner = $ban->where('type_id = 102')->order('num desc')->select();//首页banner数组 
		
		//$vdo = M('videos');
		//$video = $vdo->where('id = 1 ')->find();//首页视频 
		$video = $ban->where('id = 98')->find();//首页视频
		
		$this->assign('video',$video);
		$this->assign('banner',$banner);
		$this->display();
    }
	
	
	
	
}