<?php 
namespace Home\Controller;
use Think\Controller;
class JoinController extends PublicsController{
	public function _initialize(){
		parent::_initialize();
	}
	//联系我们视图 
	public function index(){
		
		$f_db = M('atype');
		$type = $f_db->where('type_id = 126')->select();
		
		$db = M('atype_info');
		$address = $db->where('type_id = 124')->order('num desc')->select();
		
		
		$this->assign('address',$address);//办公室地址 
		$this->assign('type',$type);//留言资讯类型 
		$this->display();
	}
	
	//客户留言处理 
	public function handle(){
		if(IS_POST){
				//print_r($_POST);
				
			$to = 'info1001hotel@126.com';//要发送到的邮箱地址
			//$to = 'service@ibasso.com';
			//echo $to;
			
			$from = trim($_POST['cn_title']);//用户邮箱
			$content = rp($_POST['cn_description']);//留言内容
			$title = '1001酒店 客户留言';//留言标题
			
			if($from==''){
				$this->error('请输入您的邮箱地址！');
			}else{
				$a = preg_match('/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/',$from);
				if(!$a){
					$this->error('请输入正确的邮箱地址！');
				}
			}
			if($content==''){
				$this->error('留言内容不能为空！');
			}
			
			$cc = str_replace(array("\r","\n"),array('','<br>'),$content);
			$body = '客户 Email: '.$from."<br>留言内容：<br>".$cc;
			
			 if($from != '' && $content != ''){
				$db = M('atype');
				$types = $db->where('id = '.$_POST['cn_name'])->find();
				$type_name = $types['cn_type'];//留言类别名称 
			
				$data = array();
				$data['type_id'] = $_POST['cn_name'];
				$data['num'] = 20;
				$data['cn_name'] = $type_name.date('Y-m-d H:i:s',time());//留言标题 
				$data['cn_title'] = $from;//客户邮箱 
				$data['cn_description'] = $content;//留言内容 
				$data['date1'] = date('Y-m-d H:i:s',time());//留言时间 
				
				$comment = M('atype_info');
				$result = $comment->add($data);
				if($result){
					send_mail($to, $title, $body);//发送邮件 
					$this->success('留言成功！');
				}

			} 
				
		}else{
			$this->error('非法请求');
		}
	
	}
	
	
}





?>