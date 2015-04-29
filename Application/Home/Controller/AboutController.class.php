<?php
namespace Home\Controller;
use Think\Controller;
class AboutController extends PublicsController {
	public function _initialize(){
		parent::_initialize();
	}
    public function index(){
        //关于1001视图 
		$ab = M('atype_info');
		$banner = $ab->where('id = 57')->find();
		$jianjie = $ab->where('id = 11')->find();
		$bless = $ab->where('id = 12')->find();
		$bkone = $ab->where('id = 13')->find();
		$bktwo = $ab->where('id = 14')->find();
		$story_one = $ab->where('id = 15')->find();
		$story_two = $ab->where('id = 16')->find();
		$story_three = $ab->where('id = 17')->find();
		$story_four = $ab->where('id = 18')->find();
		$story_five = $ab->where('id = 19')->find();
		$story_go = $ab->where('id = 20')->find();
		$adword = $ab->where('type_id = 91')->order('num desc')->select();
		$brand = $ab->where('type_id = 92')->order('num desc')->select();
		
		
		$this->assign('jianjie',$jianjie);//公司简介 
		$this->assign('bless',$bless);//我们的愿景 
		$this->assign('bkone',$bkone);//业务板块1 
		$this->assign('bktwo',$bktwo);//业务板块2 
		$this->assign('story_one',$story_one);//1908年 
		$this->assign('story_two',$story_two);//1950年 
		$this->assign('story_three',$story_three);//2006年 
		$this->assign('story_four',$story_four);//2008年 
		$this->assign('story_five',$story_five);//2011年 
		$this->assign('story_go',$story_go);//梦想起航 
		$this->assign('adword',$adword);//所获奖项 根据num 按大到小排列 
		$this->assign('brand',$brand);//旗下品牌 根据num 按大到小排列 
		
		$this->assign('banner',$banner);//banner图 
		$this->display();
    }
}