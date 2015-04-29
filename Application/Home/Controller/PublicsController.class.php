<?php
namespace Home\Controller;
use Think\Controller;
class PublicsController extends Controller {
	public function _initialize(){
		$site = M('atype_info');
		$web = $site->where('id = 10')->find();
		$link = $site->where('type_id = 104')->order('num desc')->select();//底部链接数组 
		
		$this->assign('link',$link);
		$this->assign('site',$web);//网站配置
		
	}
	
	
	
	
}