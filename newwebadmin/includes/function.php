<?php
@session_start();//开启session
if (!isset($_SESSION['superadmin']) || !$_SESSION['superadmin']){
	error_reporting(0);//屏蔽错误
}else{
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);//开发模式用
}
$s_charset = 'utf-8';

//控制配置存放路径/网站所在目录
define('SYSTEM_VER','3.6');
define('WEB_ROOT',dirname(dirname(dirname(__FILE__))).'/');
define('CC_SAVE_PATH', dirname(dirname(__FILE__)).'/data/ccset/');

//3.5加入后台配置
if(is_file(CC_SAVE_PATH.'/qbt_admin_config.ccset')){
    $qbt_admin_config = unserialize(file_get_contents(CC_SAVE_PATH.'/qbt_admin_config.ccset'));
}else{
    $qbt_admin_config = array();
}

if (!isset($_SERVER['REQUEST_URI']))
{
	$_SERVER['REQUEST_URI'] = substr($_SERVER['PHP_SELF'],1 );
		if (isset($_SERVER['QUERY_STRING'])) { $_SERVER['REQUEST_URI'].='?'.$_SERVER['QUERY_STRING']; }
}

//关闭魔术引号针对5.3以下版本
if(PHP_VERSION<5.3){
	@ini_set("magic_quotes_runtime", 0);
	function magic_gpc(&$string) {
		if(@get_magic_quotes_gpc()) {
			if(is_array($string)) {
				foreach($string as $key => $val) {
					$string[$key] = magic_gpc($val);
				}
			} else {
				$string = stripslashes($string);
			}
		}
		return $string;
	}
	magic_gpc($_GET);
	magic_gpc($_POST);
	magic_gpc($_REQUEST);
	magic_gpc($_COOKIE);
}

//时间差
date_default_timezone_set('Asia/Shanghai');
$now_datetime = date('Y-m-d H:i:s');

//级别设置
$level_num = 10000;

//后台管理默认10000
if (!$_REQUEST['manage_id']) $level_num = 10000;

$def_level_num = $level_num;

//版本设置，001为开启，000为关闭
$bb_cn = '001';
$bb_en = $qbt_admin_config['en_enable']?'001':'000';

//cookie时间及路径
$set_cookie_time = time()+7200;
$set_cookie_path = '/';

//上一页URL记录，带参数
$prev_url = $_SERVER["HTTP_REFERER"] ;

//当前URL记录，带参数
$this_url = explode('/',$_SERVER['REQUEST_URI']);
$this_url = $this_url[count($this_url)-1];

$admin_site_title = '后台管理';

//检查用户ID
if (!isset($_COOKIE['a_user_id']))
$a_user_id=0;
else
$a_user_id = $_COOKIE['a_user_id'];
//检查用户ID结束

//临时Frame
$tempFrame = 'tempFrame';
//临时Frame结束
$show_msg_title = '系统提示：\n\n';

$t_action=trim(rp($_REQUEST['t_action']));	//0001为添加，0002为更改，0003为复制。
	if (!$t_action) $t_action = '0001';

if ($t_action == '0001') $show_a = '添加';
if ($t_action == '0002') $show_a = '更改';
if ($t_action == '0003') $show_a = '复制';

$f_value = trim(rp($_REQUEST['f_value']));
$action = trim(rp($_REQUEST['action']));
$manage_id = trim(rp($_REQUEST['manage_id']));
	if (!$manage_id) $manage_id=0;
$type_id = trim(rp($_REQUEST['type_id']));
	if (!$type_id) $type_id = $manage_id;

if ($bb_cn == '001') $bb_en_show = '(英文)';
if ($bb_en == '001') $bb_cn_show = '(中文)';

if ($t_action == '0002') $show_select_name = '不指定分类';
else $show_select_name = '新建分类';

$on_m='onMouseOver="this.className=\'t02_1\';" onMouseOut="this.className=\'t02_2\';"';

//英文版配置判定
if(!defined('IS_ENG')){
	define('IS_ENG', false);
}

//过滤特殊字符
function rp($f_str)
{
	$f_str = preg_replace("/and/i","&#97;nd",$f_str);
	$f_str = preg_replace("/execute/i","&#101;xecute",$f_str);
	$f_str = preg_replace("/update/i","&#117;pdate",$f_str);
	$f_str = preg_replace("/count/i","&#99;ount",$f_str);
	$f_str = preg_replace("/chr/i","&#99;hr",$f_str);
	$f_str = preg_replace("/mid/i","&#109;id",$f_str);
	$f_str = preg_replace("/master/i","&#109;aster",$f_str);
	$f_str = preg_replace("/truncate/i","&#116;runcate",$f_str);
	$f_str = preg_replace("/char/i","&#99;har",$f_str);
	$f_str = preg_replace("/declare/i","&#100;eclare",$f_str);
	$f_str = preg_replace("/select/i","&#115;elect",$f_str);
	$f_str = preg_replace("/create/i","&#99;reate",$f_str);
	$f_str = preg_replace("/delete/i","&#100;elete",$f_str);
	$f_str = preg_replace("/insert/i","&#105;nsert",$f_str);
	$f_str = stripcslashes($f_str);		//防止单引号双号引被转义
	$f_str = str_replace('<','&lt;',$f_str);
	$f_str = str_replace(">",'&gt;',$f_str);
	$f_str = str_replace('\'','&#39;',$f_str);
	$f_str = str_replace('"','&quot;',$f_str);
	$f_str = str_replace('　','　',$f_str);
	$f_str = trim($f_str);
	return $f_str;
}

//过滤百度编辑器IE下英文不断行问题
function rp_content($str){
	$str = str_replace('\'','&#39;',$str);
	$str = str_replace('&nbsp;',' ',$str);
	$str = str_replace('  ',' &nbsp;',$str);
	return $str;
}

//过滤特殊字符
function rp_1($f_str)
{
	$f_str = preg_replace("/and/i","&#97;nd",$f_str);
	$f_str = preg_replace("/execute/i","&#101;xecute",$f_str);
	$f_str = preg_replace("/update/i","&#117;pdate",$f_str);
	$f_str = preg_replace("/count/i","&#99;ount",$f_str);
	$f_str = preg_replace("/chr/i","&#99;hr",$f_str);
	$f_str = preg_replace("/mid/i","&#109;id",$f_str);
	$f_str = preg_replace("/master/i","&#109;aster",$f_str);
	$f_str = preg_replace("/truncate/i","&#116;runcate",$f_str);
	$f_str = preg_replace("/char/i","&#99;har",$f_str);
	$f_str = preg_replace("/declare/i","&#100;eclare",$f_str);
	$f_str = preg_replace("/select/i","&#115;elect",$f_str);
	$f_str = preg_replace("/create/i","&#99;reate",$f_str);
	$f_str = preg_replace("/delete/i","&#100;elete",$f_str);
	$f_str = preg_replace("/insert/i","&#105;nsert",$f_str);
	$f_str = str_replace('<','&lt;',$f_str);
	$f_str = str_replace(">",'&gt;',$f_str);
	$f_str = str_replace('\'','&#39;',$f_str);
	$f_str = str_replace('"','&quot;',$f_str);
   return $f_str;
}

//显示特殊字符
function show_rp($f_str)
{
	$f_str = str_replace('&#97;nd','and',$f_str);
	$f_str = str_replace('&#101;xecute','execute',$f_str);
	$f_str = str_replace('&#117;pdate','update',$f_str);
	$f_str = str_replace('&#99;ount','count',$f_str);
	$f_str = str_replace('&#99;hr','chr',$f_str);
	$f_str = str_replace('&#109;id','mid',$f_str);
	$f_str = str_replace('&#109;aster','master',$f_str);
	$f_str = str_replace('&#116;runcate','truncate',$f_str);
	$f_str = str_replace('&#99;har','char',$f_str);
	$f_str = str_replace('&#100;eclare','declare',$f_str);
	$f_str = str_replace('&#115;elect','select',$f_str);
	$f_str = str_replace('&#99;reate','create',$f_str);
	$f_str = str_replace('&#100;elete','delete',$f_str);
	$f_str = str_replace('&#105;nsert','nsert',$f_str);
	$f_str = str_replace('&lt;','<',$f_str);
	$f_str = str_replace('&gt;','>',$f_str);
	$f_str = str_replace('&#39;','\'',$f_str);
	$f_str = str_replace('&quot;','"',$f_str);
	$f_str = trim($f_str);
    return $f_str;
}

function str_to_lower_num($f_value) {
	$f_value1 = array('０','１','２','３','４','５','６','７','８','９','Ａ','Ｂ','Ｃ','Ｄ','Ｅ','Ｆ','Ｇ','Ｈ','Ｉ','Ｊ','Ｋ','Ｌ','Ｍ','Ｎ','Ｏ','Ｐ','Ｑ','Ｒ','Ｓ','Ｔ','Ｕ','Ｖ','Ｗ','Ｘ','Ｙ','Ｚ');
	$f_value2 = array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	$f_len = count($f_value1);
		for ($f_i = 0; $f_i < $f_len; $f_i++)
		{
		$f_value = str_replace($f_value1[$f_i],$f_value2[$f_i],$f_value);
		}
	$f_value = strtolower($f_value);
	$l_value = $f_value;
	return $l_value;
}

/* 
函数名称：check_id() 
函数作用：校验提交的ID类值是否合法 
参　　数：$id: 提交的ID值 
返 回 值：返回处理后的ID 
*/   
function check_id($f_id,$f_show_id)
{
	global $s_charset;
	$f_id=str_replace("'","",$f_id);
	if (!$f_id) { 
		echo '<meta http-equiv="Content-Type" content="text/html; charset='.$s_charset.'" />';
		if(IS_ENG){
			echo '<script language="javascript">alert("Error, no parameters.")</script>';
		}else{
			echo '<script language="javascript">alert("错误提示：没有参数！")</script>';
		}
		go_to($f_show_id,'');
	} elseif (is_numeric($f_id) == false) { 
		echo '<meta http-equiv="Content-Type" content="text/html; charset='.$s_charset.'" />';
		if(IS_ENG){
			echo '<script language="javascript">alert("Error, the parameters is error.")</script>';
		}else{
			echo '<script language="javascript">alert("错误提示：提交的参数非法！")</script>';
		}
		go_to($f_show_id,'');
	}
	$f_id = intval($f_id);// 整型化
	return $f_id;
}

//校验记录
function check_rs($f_result,$f_show_id)
{
	if (mysql_num_rows($f_result)<1) {
		global $s_charset;
		echo '<meta http-equiv="Content-Type" content="text/html; charset='.$s_charset.'" />';
		if(IS_ENG){
			echo '<script language="javascript">alert("Error, information is error or be deleted, Thank you for your visit.")</script>';
		}else{
			echo '<script language="javascript">alert("错误提示：该信息并不存在或已经删除，谢谢您的访问！")</script>';
		}
		go_to($f_show_id,'');
	}
}

//编辑器
function show_editor($f_create,$f_value){
	echo '<textarea id="'.$f_create.'" name="'.$f_create.'" style="display:none" />'.$f_value.'</textarea><input type="hidden" id="'.$f_create.'___Config" value="" style="display:none" /><iframe id="'.$f_create.'___Frame" src="../../editor/editor/fckeditor.html?InstanceName='.$f_create.'&amp;Toolbar=Default" width="100%" height="500" frameborder="0" scrolling="no"></iframe>';
}

//跳转
function go_to($f_show_id,$f_value){
	switch ($f_show_id)
	{
	case 1:
	  echo '<script language="javascript">window.history.go(-1);</script>';
	  break;
	case 2:
	  echo '<script language="javascript">window.history.go(-2);</script>';
	  break; 
	case 3:
	  echo '<script language="javascript">window.close();</script>';
	  break;
	case 4:
	  echo '<script language="javascript">window.self.location="'.$f_value.'";</script>';
	  break;
	default:
	}
	exit();
}

//过滤html代码
function RemoveHTML($document)
{
$document = trim($document);
if (strlen($document) <= 0)
{
   return $document;
}
$search = array ("'<script[^>]*?>.*?</script>'si",  // 去掉 javascript
                  "'<[\/\!]*?[^<>]*?>'si",          // 去掉 HTML 标记
                  "'([\r\n])[\s]+'",                // 去掉空白字符
                  "'&(quot|#34);'i",                // 替换 HTML 实体
                  "'&(amp|#38);'i",
                  "'&(lt|#60);'i",
                  "'&(gt|#62);'i",
                  "'&(nbsp|#160);'i"
                  );                    // 作为 PHP 代码运行

$replace = array ("",
                   "",
                   "\\1",
                   "\"",
                   "&",
                   "<",
                   ">",
                   " "
                   );
return @preg_replace ($search, $replace, $document);
}

//屏蔽错误信息
function is_err($f_value=3,$f_go_to_url=''){
	if (!$f_value) $f_value='3';
	if (mysql_error())
	{
	global $s_charset;
	echo '<meta http-equiv="Content-Type" content="text/html; charset='.$s_charset.'" />';
	$show_mysql_error='\\n'.mysql_error();
	echo '<script language="javascript">';
	if(IS_ENG){
		echo 'alert("Error, operation failed, may be contain illegal string from the data.'.$show_mysql_error.'");';
	}else{
		echo 'alert("错误提示：操作失败，请确认所填资料不含特殊符号，若多次操作不成功，请联系技术支持人员！'.$show_mysql_error.'");';
	}
	if ($f_value == 1) echo 'window.history.go(-1);';
	if ($f_value == 2) echo 'window.history.go(-2);';
	if ($f_value == 3) echo 'window.close();';
	if ($f_value == 4) echo '<script language="javascript">window.self.location="'.$f_go_to_url.'";</script>';
	echo '</script>';
	exit();
	}
}

//超过长度时在尾处加上省略号
function cutstr($f_tempstr,$f_tempwid, $f_laststr='...'){
    $length  = strlen($f_tempstr);
    if ($length <=  $f_tempwid){
        return $f_tempstr;
    }
  
    $result_str = '';
    for($i=0;$i<$f_tempwid;$i++){
        $temp_str=substr($f_tempstr,0,1);
        if(ord($temp_str) > 127){
            if($i+1<$f_tempwid){  
                $result_str .= substr($f_tempstr,0,3);
                $f_tempstr = substr($f_tempstr,3);
            }
            $i++;
        }else{
            $result_str .= substr($f_tempstr,0,1);
            $f_tempstr=substr($f_tempstr,1);
        }
    }
  
    return $result_str.$f_laststr;
}

//日期格式
function show_date($f_value,$f_format){
	if (!$f_format) $f_format='Y-m-d';
	$f_value=date($f_format,strtotime($f_value));
	return $f_value;
}

//数值格式
function show_number($f_value,$f_format){
	if (!$f_format) $f_format='2';
	$f_value=number_format($f_value,$f_format);
	$f_value = str_replace(',','',$f_value);
	return $f_value;
}

//显示信息
function show_msg($f_msg_value,$f_go_to=0,$f_go_to_url='') {
	global $s_charset;
	echo '<meta http-equiv="Content-Type" content="text/html; charset='.$s_charset.'" />';
	if (!$f_go_to) $f_go_to=0;
	echo '<script language="javascript">';
	if ($f_msg_value) echo 'alert("'.$f_msg_value.'");';
	if ($f_go_to == 1) echo 'window.history.go(-1);';
	if ($f_go_to == 2) echo 'window.history.go(-2);';
	if ($f_go_to == 3) echo 'window.close();';
	if ($f_go_to == 4) echo 'window.self.location="'.$f_go_to_url.'";';
	echo '</script>';
	exit();
}

function show_msg_d($f_msg_value,$f_go_to,$f_go_to_url,$f_value101,$f_value102,$f_value103,$f_value104,$f_value105,$f_value106,$f_value107,$f_value108,$f_value109,$f_value110) {
	global $s_charset;
	echo '<meta http-equiv="Content-Type" content="text/html; charset='.$s_charset.'" />';
	$f_value101 = trim($f_value101);
	$f_value102 = trim($f_value102);
	$f_value103 = trim($f_value103);
	$f_value104 = trim($f_value104);
	$f_value105 = trim($f_value105);
	if (!$f_value102) $f_value102 = '001';
	if (!$f_value103) $f_value103 = '';
	if (!$f_value105) $f_value105 = 'parent.mainFrame.';
	
	if (!$f_go_to) $f_go_to=0;
	echo '<script language="javascript">';
	if ($f_msg_value) echo 'alert("'.$f_msg_value.'");';
	if ($f_go_to == 1) echo 'window.history.go(-1);';
	if ($f_go_to == 2) echo 'window.history.go(-2);';
	if ($f_go_to == 3) echo 'window.close();';
	if ($f_go_to == 4) echo 'window.self.location="'.$f_go_to_url.'";';
	
	if ($f_value101)
	{
		if ($f_value102 == '001') echo $f_value105.'document.getElementById("'.$f_value101.'").style.backgroundColor = "'.$f_value103.'";';
		elseif ($f_value102 == '002') echo $f_value105.'document.getElementById("'.$f_value101.'").className = "'.$f_value103.'";';
	echo $f_value105.'document.getElementById("'.$f_value101.'").focus();';
	}
	
	echo '</script>';
	exit();
}

//显示信息--完成时
function show_msg_ok($f_msg_value,$f_go_to=0,$f_go_to_url='') {
	global $s_charset;
	echo '<meta http-equiv="Content-Type" content="text/html; charset='.$s_charset.'" />';
	if (!$f_go_to) $f_go_to=0;
	echo '<script language="javascript">';
	if ($f_msg_value) echo 'alert("'.$f_msg_value.'");';
	if ($f_go_to == 1) echo 'parent.mainFrame.window.history.go(-1);';
	if ($f_go_to == 2) echo 'parent.mainFrame.window.history.go(-2);';
	if ($f_go_to == 3) echo 'window.close();';
	if ($f_go_to == 4) echo 'parent.mainFrame.location.href="'.$f_go_to_url.'";';
	if ($f_go_to == 5) echo 'parent.mainFrame.location.reload();';
	
	//echo 'parent.tempFrame.location.href="a.php";';
	echo '</script>';
	exit();
}

//显示信息--完成时
function show_msg_ok_10($f_msg_value,$f_go_to=0,$f_go_to_url='') {
	global $s_charset;
	echo '<meta http-equiv="Content-Type" content="text/html; charset='.$s_charset.'" />';
	if (!$f_go_to) $f_go_to=0;
	echo '<script language="javascript">';
	if ($f_msg_value) echo 'alert("'.$f_msg_value.'");';
	if ($f_go_to == 1) echo 'parent.window.history.go(-1);';
	if ($f_go_to == 2) echo 'parent.window.history.go(-2);';
	if ($f_go_to == 3) echo 'parent.window.close();';
	if ($f_go_to == 4) echo 'parent.location.href="'.$f_go_to_url.'";';
	if ($f_go_to == 5) echo 'parent.location.reload();';
	
	echo '</script>';
	exit();
}

//显示信息--完成时
function show_msg_ok_top($f_msg_value,$f_go_to=0,$f_go_to_url='') {
	global $s_charset;
	echo '<meta http-equiv="Content-Type" content="text/html; charset='.$s_charset.'" />';
	if (!$f_go_to) $f_go_to=0;
	echo '<script language="javascript">';
	if ($f_msg_value) echo 'alert("'.$f_msg_value.'");';
	if ($f_go_to == 1) echo 'top.window.history.go(-1);';
	if ($f_go_to == 2) echo 'top.window.history.go(-2);';
	if ($f_go_to == 3) echo 'top.window.close();';
	if ($f_go_to == 4) echo 'top.location.href="'.$f_go_to_url.'";';
	if ($f_go_to == 5) echo 'top.location.reload();';
	
	echo '</script>';
	exit();
}

//用于读取类型设定
function load_type_cc($f_table_name,$f_value,$f_sign,$f_now_id,$f_action,$f_level_num,$f_level_num_i){
	global $conn;
	if (!$f_now_id) $f_now_id=0;
	if (!$f_value) $f_value=0;
	if (!$f_level_num_i) $f_level_num_i=2;
	
	$f_sql='select * from `'.$f_table_name.'` where `type_id` =\''.$f_value.'\' ';
	//自定义排序
	if(!empty($cc_info['class_order_rule'])){
		$f_sql.='order by '.$cc_info['class_order_rule'];
	}else{
		$f_sql.='order by `num` desc';
	}
	$f_result=mysql_query($f_sql,$conn);
	
	$f_sql='select * from `'.$f_table_name.'` where `id` =\''.$f_now_id.'\' ';
	//自定义排序
	if(!empty($cc_info['class_order_rule'])){
		$f_sql.='order by '.$cc_info['class_order_rule'];
	}else{
		$f_sql.='order by `num` desc';
	}
	$f_result1=mysql_query($f_sql,$conn);
	$f_rs1=mysql_fetch_array($f_result1);
	$f_now_type_id=$f_rs1['type_id'];
	
	if (!$f_now_type_id) $f_now_type_id=0;
	while ($f_rs=mysql_fetch_array($f_result))
	{
		if ($f_rs)
		{

			//注意修改load_type_cc
			$GLOBALS['selcc_info'][$f_rs['id']] = array();
			if(is_file(CC_SAVE_PATH.($f_table_name!='atype'?"{$f_table_name}_":'').'conf_'.$f_rs['id'].'.ccset')){
				$GLOBALS['selcc_info'][$f_rs['id']] = unserialize(file_get_contents(CC_SAVE_PATH.($f_table_name!='atype'?"{$f_table_name}_":'').'conf_'.$f_rs['id'].'.ccset'));

				if($GLOBALS['selcc_info'][$f_rs['id']]['class_alone_table_name']){
					$f_table_name = $GLOBALS['selcc_info'][$f_rs['id']]['class_alone_table_name'];
				}
			}

			//跳过设置后台管理不展示分类
			if(empty($_GET['manage_id']) && $GLOBALS['selcc_info'][$f_rs['id']]['class_no_show_list']) continue;

			if ($f_action!='0002' || $f_now_id!=$f_rs['id']){
				if ($f_level_num>$f_level_num_i && ($_GET['manage_id'] >0 || $f_table_name == 'atype')) load_type_cc($f_table_name,$f_rs['id'],'&nbsp;&nbsp;'.$f_sign.'├',$f_now_id,$f_action,$f_level_num-1,$f_level_num_i);
			}
		}
	}
}


//表单显示类别
function show_type($f_table_name,$f_value,$f_sign,$f_now_id,$f_action,$f_level_num,$f_level_num_i){
	global $conn;
	if (!$f_now_id) $f_now_id=0;
	if (!$f_value) $f_value=0;
	if (!$f_level_num_i) $f_level_num_i=2;
	
	/* 控制设置读取 */
	$cc_info = array();
	if(is_file(CC_SAVE_PATH.($_REQUEST['class_alone_table_name']?"{$_REQUEST['class_alone_table_name']}_":'').'conf_'.$f_value.'.ccset')){
		$cc_info = unserialize(file_get_contents(CC_SAVE_PATH.($_REQUEST['class_alone_table_name']?"{$_REQUEST['class_alone_table_name']}_":'').'conf_'.$f_value.'.ccset'));
	}else{
		if(is_file(CC_SAVE_PATH.'conf_'.$f_value.'.ccset')){
			$cc_info = unserialize(file_get_contents(CC_SAVE_PATH.'conf_'.$f_value.'.ccset'));
		}
	}

	//独立表设置
	if($cc_info['class_alone_table_name']){
		$f_table_name = $cc_info['class_alone_table_name'];
	}

	//动态限制级数
	if($GLOBALS['level_num']==$GLOBALS['def_level_num'] && $cc_info['class_level_num']){
		$f_level_num = $GLOBALS['level_num'] = $cc_info['class_level_num'];
	}

	$f_sql='select * from `'.$f_table_name.'` where `type_id` =\''.$f_value.'\' ';
	//自定义排序
	if(!empty($cc_info['class_order_rule'])){
		$f_sql.='order by '.$cc_info['class_order_rule'];
	}else{
		$f_sql.='order by `num` desc';
	}
	$f_result=mysql_query($f_sql,$conn);
	
	$f_sql='select * from `'.$f_table_name.'` where `id` =\''.$f_now_id.'\' ';
	//自定义排序
	if(!empty($cc_info['class_order_rule'])){
		$f_sql.='order by '.$cc_info['class_order_rule'];
	}else{
		$f_sql.='order by `num` desc';
	}
	$f_result1=mysql_query($f_sql,$conn);
	$f_rs1=mysql_fetch_array($f_result1);
	$f_now_type_id=$f_rs1['type_id'];
	
	if (!$f_now_type_id) $f_now_type_id=0;
	while ($f_rs=mysql_fetch_array($f_result))
	{

		if ($f_rs)
		{

			//注意修改load_type_cc
			$GLOBALS['selcc_info'][$f_rs['id']] = array();
			if(is_file(CC_SAVE_PATH.($f_table_name!='atype'?"{$f_table_name}_":'').'conf_'.$f_rs['id'].'.ccset')){
				$GLOBALS['selcc_info'][$f_rs['id']] = unserialize(file_get_contents(CC_SAVE_PATH.($f_table_name!='atype'?"{$f_table_name}_":'').'conf_'.$f_rs['id'].'.ccset'));

				if($GLOBALS['selcc_info'][$f_rs['id']]['class_alone_table_name']){
					$f_table_name = $GLOBALS['selcc_info'][$f_rs['id']]['class_alone_table_name'];
				}
			}

			if (($f_action=='0002') && $f_now_id==$f_rs['id']){
				echo '';
			}else{
				echo '<option value="'.$f_rs['id'].'"';
				if ($f_action=='0002' || $f_action=='0003'){
					if ($f_now_type_id==$f_rs['id']) echo ' selected';
				}else{
					if ($f_now_id==$f_rs['id']) echo ' selected';
				}
				echo '>'.$f_sign.$f_rs['cn_type'].'</option>';

				//跳过设置后台管理不展示分类
				if(empty($_GET['manage_id']) && $GLOBALS['selcc_info'][$f_rs['id']]['class_no_show_list']) continue;

				if ($f_level_num>$f_level_num_i && ($_GET['manage_id'] >0 || $f_table_name == 'atype')) show_type($f_table_name,$f_rs['id'],'&nbsp;&nbsp;'.$f_sign.'├',$f_now_id,$f_action,$f_level_num-1,$f_level_num_i);
			}
		}
	}
}

//表单显示类别 -- 跳转
function show_type_jump($f_table_name,$f_value,$f_sign,$f_now_id,$f_action,$f_level_num,$f_level_num_i){
	global $conn,$this_page_name,$manage_id,$action,$keyword;
	if (!$f_now_id) $f_now_id=0;
	if (!$f_value) $f_value=0;
	if (!$f_level_num_i) $f_level_num_i=1;
	
	/* 控制设置读取 */
	$cc_info = array();
	if(is_file(CC_SAVE_PATH.($_REQUEST['class_alone_table_name']?"{$_REQUEST['class_alone_table_name']}_":'').'conf_'.$f_value.'.ccset')){
		$cc_info = unserialize(file_get_contents(CC_SAVE_PATH.($_REQUEST['class_alone_table_name']?"{$_REQUEST['class_alone_table_name']}_":'').'conf_'.$f_value.'.ccset'));
	}

	//独立表设置
	if($cc_info['class_alone_table_name']){
		$f_table_name = $cc_info['class_alone_table_name'];
	}

	//动态限制级数
	if($GLOBALS['level_num']==$GLOBALS['def_level_num'] && $cc_info['class_level_num']){
		$f_level_num = $GLOBALS['level_num'] = $cc_info['class_level_num'];
	}

	$f_sql='select * from `'.$f_table_name.'` where `type_id` =\''.$f_value.'\' ';
	//自定义排序
	if(!empty($cc_info['class_order_rule'])){
		$f_sql.='order by '.$cc_info['class_order_rule'];
	}else{
		$f_sql.='order by `num` desc';
	}
	$f_result=mysql_query($f_sql,$conn);
	
	$f_sql='select * from `'.$f_table_name.'` where `id` =\''.$f_now_id.'\' ';
	//自定义排序
	if(!empty($cc_info['class_order_rule'])){
		$f_sql.='order by '.$cc_info['class_order_rule'];
	}else{
		$f_sql.='order by `num` desc';
	}
	$f_result1=mysql_query($f_sql,$conn);
	$f_rs1=mysql_fetch_array($f_result1);
	$f_now_type_id=$f_rs1['type_id'];
	
	if (!$f_now_type_id) $f_now_type_id=0;
	while ($f_rs=mysql_fetch_array($f_result))
	{
		if ($f_rs)
		{

			//注意修改load_type_cc
			$GLOBALS['selcc_info'][$f_rs['id']] = array();
			if(is_file(CC_SAVE_PATH.($f_table_name!='atype'?"{$f_table_name}_":'').'conf_'.$f_rs['id'].'.ccset')){
				$GLOBALS['selcc_info'][$f_rs['id']] = unserialize(file_get_contents(CC_SAVE_PATH.($f_table_name!='atype'?"{$f_table_name}_":'').'conf_'.$f_rs['id'].'.ccset'));

				if($GLOBALS['selcc_info'][$f_rs['id']]['class_alone_table_name']){
					$f_table_name = $GLOBALS['selcc_info'][$f_rs['id']]['class_alone_table_name'];
				}
			}

			if (($f_action=='0002') && $f_now_id==$f_rs['id']) echo '';
			else
			{
		echo '<option value="'.$this_page_name.'?__action='.urlencode($_GET['__action']).'&action='.$action.'&keyword='.$Server.URLEncode($keyword).'&manage_id='.$manage_id.'&type_id='.$f_rs['id'].'&class_alone_table_name='.$_REQUEST['class_alone_table_name'].'&info_alone_table_name='.$_REQUEST['info_alone_table_name'].'"';
			if ($f_action=='0002' || $f_action=='0003')
			{
				if ($f_now_type_id==$f_rs['id']) echo ' selected';
			}
			else
			{
				if ($f_now_id==$f_rs['id']) echo ' selected';
			}
		echo '>'.$f_sign.$f_rs['cn_type'].'</option>';

		//跳过设置后台管理不展示分类
		if(empty($_GET['manage_id']) && $GLOBALS['selcc_info'][$f_rs['id']]['class_no_show_list']) continue;

		if ($f_level_num>$f_level_num_i && ($_GET['manage_id'] >0 || $f_table_name == 'atype')) show_type_jump($f_table_name,$f_rs['id'],'&nbsp;&nbsp;'.$f_sign.'├',$f_now_id,$f_action,$f_level_num-1,$f_level_num_i);
			}
		}
	}
}
	
//显示类别--表格
function show_type_table($f_table_name,$f_value1,$f_value,$f_sign,$f_key,$f_level_num){
	global $conn,$on_m,$tempFrame;
	$f_level_num_i=1;
	$f_on_m=$on_m;
	
	/* 控制设置读取 */
	$cc_info = array();
	$p_cc_info = array();
	if(is_file(CC_SAVE_PATH.($_REQUEST['class_alone_table_name']?"{$_REQUEST['class_alone_table_name']}_":'').'conf_'.$f_value1.'.ccset')){
		$p_cc_info = unserialize(file_get_contents(CC_SAVE_PATH.($_REQUEST['class_alone_table_name']?"{$_REQUEST['class_alone_table_name']}_":'').'conf_'.$f_value1.'.ccset'));
	}else{
		if(is_file(CC_SAVE_PATH.'conf_'.$f_value.'.ccset')){
			$p_cc_info = unserialize(file_get_contents(CC_SAVE_PATH.'conf_'.$f_value.'.ccset'));
		}
	}
	if(is_file(CC_SAVE_PATH.($_REQUEST['class_alone_table_name']?"{$_REQUEST['class_alone_table_name']}_":'').'conf_'.$f_value.'.ccset')){
		$cc_info = unserialize(file_get_contents(CC_SAVE_PATH.($_REQUEST['class_alone_table_name']?"{$_REQUEST['class_alone_table_name']}_":'').'conf_'.$f_value.'.ccset'));
	}elseif($p_cc_info){
		$cc_info = $p_cc_info;
	}

	//独立表设置
	if($cc_info['class_alone_table_name']){
		$f_table_name = $cc_info['class_alone_table_name'];
	}

	//动态限制级数
	if($cc_info['class_level_num']){
		$f_level_num = $GLOBALS['level_num'] = $cc_info['class_level_num'];
	}

	$f_class  ='';
	$f_b_left = '';
	$f_b_right = '';
	if ($f_level_num == $GLOBALS['level_num'] && $GLOBALS['level_num']>1){
		$f_on_m = '';
		$f_b_left = '<strong>';
		$f_b_right = '</strong>';
		$f_class = 'class="qbt_biaoshiwocunzai_50"';
	}

	$f_sql='select * from `'.$f_table_name.'` where `type_id` =\''.$f_value.'\' and `cn_type` like \'%'.$f_key.'%\' ';

	//多管理员
	if($GLOBALS['a_user_id']>1 && $GLOBALS['qbt_admin_config']['atype_m_admin']) $f_sql.=" AND `admin_id`='{$GLOBALS['a_user_id']}'";

	//自定义排序
	if(!empty($cc_info['class_order_rule'])){
		$f_sql.='order by '.$cc_info['class_order_rule'];
	}else{
		$f_sql.='order by `num` desc';
	}
	
	$source_cc_info = $cc_info;
	$f_result=mysql_query($f_sql,$conn);
	while ($f_rs=mysql_fetch_assoc($f_result))
	{
		if ($f_rs)
		{
		//回复原有设置，防止独立设置覆盖
		$cc_info = $source_cc_info;

		//分类自身独立控制加载
		$alone_cc_info = array();
		if(is_file(CC_SAVE_PATH.($_REQUEST['class_alone_table_name']?"{$_REQUEST['class_alone_table_name']}_":'').'conf_class_info_'.$f_rs['id'].'.ccset')){
			$alone_cc_info = unserialize(file_get_contents(CC_SAVE_PATH.($_REQUEST['class_alone_table_name']?"{$_REQUEST['class_alone_table_name']}_":'').'conf_class_info_'.$f_rs['id'].'.ccset'));
		}

		if($alone_cc_info['alone_ccset_class_extend_column']=='yes'){
			$cc_info['class']['order_change'] = $alone_cc_info['class']['order_change'];
			$cc_info['class_extend_column'] = $alone_cc_info['class_extend_column'];
		}
		if($alone_cc_info['alone_ccset_class_extend_action']=='yes'){
			$cc_info['class']['class_view'] = $alone_cc_info['class']['class_view'];
			$cc_info['class']['subclass_add'] = $alone_cc_info['class']['subclass_add'];
			$cc_info['class']['info_add'] = $alone_cc_info['class']['info_add'];
			$cc_info['class']['info_copy'] = $alone_cc_info['class']['info_copy'];
			$cc_info['class']['class_change'] = $alone_cc_info['class']['class_change'];
			$cc_info['class']['class_detete'] = $alone_cc_info['class']['class_detete'];
			$cc_info['class_extend_action'] = $alone_cc_info['class_extend_action'];
		}

		echo '<tr '.$f_class.' '.$f_on_m.'>';

		//管理员显示ID
		if($_SESSION['superadmin']){
			echo "<td>{$f_rs['id']}</td>";
		}

		//显示类目扩展栏目 first
		if($f_value1!=0) show_class_extend_column($cc_info,$f_rs,'first');

		if($f_value1==0 || ($cc_info['class']['class_change']['status']!='hide' && check_admin_action("class_change"))){
        	echo '<td align="left">　'.$f_sign.'<a href="class_save.php?manage_id='.$f_value1.'&t_action=0002&id='.$f_rs['id'].'&class_alone_table_name='.($_REQUEST['class_alone_table_name']?$_REQUEST['class_alone_table_name']:$cc_info['class_alone_table_name']).'&info_alone_table_name='.($_REQUEST['info_alone_table_name']?$_REQUEST['info_alone_table_name']:$cc_info['info_alone_table_name']).'" title="更改">'.$f_b_left.$f_rs['cn_type'].$f_b_right.'</a></td>';
        }elseif($cc_info['class']['class_change']['status']=='hide' || !check_admin_action("class_change")){
        	echo '<td height="20" align="left">　'.$f_sign.$f_b_left.$f_rs['cn_type'].$f_b_right.'</td>';
        }
        
        if($f_value1==0 || ($cc_info['class']['order_change']['status']!='hide' && check_admin_action("class_change"))){
	        echo '<td align="center">';
			echo '<script type="text/javascript">';
			echo 'function Check_ID'.$f_rs['id'].'()';
			echo '{';
			echo 'var num'.$f_rs['id'].'=document.getElementById("num'.$f_rs['id'].'").value;';
			echo 'window.parent.'.$tempFrame.'.location="update_class_num.php?num="+num'.$f_rs['id'].'+"&id='.$f_rs['id'].'&class_alone_table_name='.($_REQUEST['class_alone_table_name']?$_REQUEST['class_alone_table_name']:$cc_info['class_alone_table_name']).'&info_alone_table_name='.($_REQUEST['info_alone_table_name']?$_REQUEST['info_alone_table_name']:$cc_info['info_alone_table_name']).'";';
			echo '}';
			echo '</script>';
		    echo '<input name="num'.$f_rs['id'].'" type="text" id="num'.$f_rs['id'].'" value="'.$f_rs['num'].'" size="5" class="qbt_longjunfeng">';
            echo '<input type="hidden" name="class_alone_table_name" value="'.$cc_info['class_alone_table_name'].'" />';
            echo '<input type="hidden" name="info_alone_table_name" value="'.$cc_info['info_alone_table_name'].'" />';
	        echo '<button class="button button_white" onClick="javascript:Check_ID'.$f_rs['id'].'();return false;">修改</button>';
		    echo '</td>';
		}

		//显示类目扩展栏目 order_change
		if($f_value1!=0) show_class_extend_column($cc_info,$f_rs,'order_change');

		//显示类目扩展栏目 last
		if($f_value1!=0) show_class_extend_column($cc_info,$f_rs,'last');

        echo '<td align="right">';

        $fgx = false;

		//扩展操作链接 first
		show_class_extend_action($cc_info,$f_rs,'first',$fgx);

        if($f_value1==0 || ($cc_info['class']['class_view']['status']!='hide' && check_admin_action("class_view"))){
        	//if($fgx) echo ' | ';
			$fgx = true;
			echo '<button class="button button_white" onClick="location.href=\'class_save.php?manage_id='.$f_value1.'&t_action=0002&id='.$f_rs['id'].'&class_alone_table_name='.($_REQUEST['class_alone_table_name']?$_REQUEST['class_alone_table_name']:$cc_info['class_alone_table_name']).'&info_alone_table_name='.($_REQUEST['info_alone_table_name']?$_REQUEST['info_alone_table_name']:$cc_info['info_alone_table_name']).'&__save_view=1\';return false;">查看</button>';
    	}

        //扩展操作链接 class_view
        show_info_extend_action($cc_info,$rs,'class_view',$fgx);

        if($f_value1==0 || ($cc_info['class']['subclass_add']['status']!='hide' && check_admin_action("subclass_add"))){
        	//if($fgx) echo ' | ';
        	$fgx = true;
			if ($f_level_num>$f_level_num_i) echo '<button class="button button_white" onClick="location.href=\'class_save.php?manage_id='.$f_value1.'&t_action=0001&id='.$f_rs['id'].'&class_alone_table_name='.($_REQUEST['class_alone_table_name']?$_REQUEST['class_alone_table_name']:$cc_info['class_alone_table_name']).'&info_alone_table_name='.($_REQUEST['info_alone_table_name']?$_REQUEST['info_alone_table_name']:$cc_info['info_alone_table_name']).'\'; return false;">'.(empty($cc_info['class']['subclass_add']['title'])?'添加子类别':$cc_info['class']['subclass_add']['title']).'</button>';
		}

		//扩展操作链接 subclass_add
		show_class_extend_action($cc_info,$f_rs,'subclass_add',$fgx);

        if($f_value1==0 || ($cc_info['class']['info_add']['status']!='hide' && check_admin_action("info_add"))){
        	//if($fgx) echo ' | ';
        	$fgx = true;
			echo '<button class="button button_white" onClick="location.href=\'save.php?manage_id='.$f_value1.'&t_action=0001&type_id='.$f_rs['id'].'&class_alone_table_name='.($_REQUEST['class_alone_table_name']?$_REQUEST['class_alone_table_name']:$cc_info['class_alone_table_name']).'&info_alone_table_name='.($_REQUEST['info_alone_table_name']?$_REQUEST['info_alone_table_name']:$cc_info['info_alone_table_name']).'\'; return false;">'.(empty($cc_info['class']['info_add']['title'])?'添加资料':$cc_info['class']['info_add']['title']).'</button>';
		}

		//扩展操作链接 info_add
		show_class_extend_action($cc_info,$f_rs,'info_add',$fgx);

        if($f_value1==0 || ($cc_info['class']['info_copy']['status']!='hide' && check_admin_action("info_copy"))){
        	//if($fgx) echo ' | ';
        	$fgx = true;
        	echo '<button class="button button_white" onClick="location.href=\'class_save.php?manage_id='.$f_value1.'&t_action=0003&id='.$f_rs['id'].'&class_alone_table_name='.($_REQUEST['class_alone_table_name']?$_REQUEST['class_alone_table_name']:$cc_info['class_alone_table_name']).'&info_alone_table_name='.($_REQUEST['info_alone_table_name']?$_REQUEST['info_alone_table_name']:$cc_info['info_alone_table_name']).'\'; return false;">'.(empty($cc_info['class']['info_copy']['title'])?'复制添加':$cc_info['class']['info_copy']['title']).'</button>';
		}

		//扩展操作链接 info_copy
		show_class_extend_action($cc_info,$f_rs,'info_copy',$fgx);

        if($f_value1==0 || ($cc_info['class']['class_change']['status']!='hide' && check_admin_action("class_change"))){
        	//if($fgx) echo ' | ';
        	$fgx = true;
        	echo '<button class="button button_white" onClick="location.href=\'class_save.php?manage_id='.$f_value1.'&t_action=0002&id='.$f_rs['id'].'&class_alone_table_name='.($_REQUEST['class_alone_table_name']?$_REQUEST['class_alone_table_name']:$cc_info['class_alone_table_name']).'&info_alone_table_name='.($_REQUEST['info_alone_table_name']?$_REQUEST['info_alone_table_name']:$cc_info['info_alone_table_name']).'\'; return false;">'.(empty($cc_info['class']['class_change']['title'])?'更改':$cc_info['class']['class_change']['title']).'</button>';
		}

		//扩展操作链接 class_change
		show_class_extend_action($cc_info,$f_rs,'class_change',$fgx);

        if($f_value1==0 || ($cc_info['class']['class_detete']['status']!='hide' && check_admin_action("class_detete"))){
        	//if($fgx) echo ' | ';
        	$fgx = true;

        	//开启数据检测则检测是否有数据
        	$notdel = '';
        	if($GLOBALS['qbt_admin_config']['del_cat_check_data']){
        		if(mysql_result(mysql_query("SELECT COUNT(*) FROM `{$f_table_name}` where `type_id` ='{$f_rs['id']}'"), 0)>0){
        			$notdel = '请先删除该类别下的所有类别';
        		}elseif(mysql_result(mysql_query("SELECT COUNT(*) FROM `".($cc_info['info_alone_table_name']?$cc_info['info_alone_table_name']:'atype_info')."` where `type_id` ='{$f_rs['id']}'"), 0)>0){
        			$notdel = '请先删除该类别下的所有信息';
        		}
        	}

        	//不可删除
        	if($notdel){
        		echo '<button class="button button_white" onClick="alert(\''.$notdel.'\');return false;">'.(empty($cc_info['class']['class_detete']['title'])?'删除':$cc_info['class']['class_detete']['title']).'</button>';
        	}else{
        		echo '<button class="button button_white" onClick="if(class_delete()){ parent.'.$tempFrame.'.location.href=\'class_delete.php?manage_id='.$f_value1.'&id='.$f_rs['id'].'&class_alone_table_name='.($_REQUEST['class_alone_table_name']?$_REQUEST['class_alone_table_name']:$cc_info['class_alone_table_name']).'&info_alone_table_name='.($_REQUEST['info_alone_table_name']?$_REQUEST['info_alone_table_name']:$cc_info['info_alone_table_name']).'\'; } return false;">'.(empty($cc_info['class']['class_detete']['title'])?'删除':$cc_info['class']['class_detete']['title']).'</button>';
        	}
		}

		//扩展操作链接 class_detete
		show_class_extend_action($cc_info,$f_rs,'class_detete',$fgx);

		//扩展操作链接 last
		show_class_extend_action($cc_info,$f_rs,'last',$fgx);

        if ($_SESSION['superadmin']){
          if($fgx) echo ' | ';
          $fgx = true;
          echo '<a href="ccset.php?id='.$f_rs['id'].'&type=class_info&class_alone_table_name='.($_REQUEST['class_alone_table_name']?$_REQUEST['class_alone_table_name']:$cc_info['class_alone_table_name']).'&info_alone_table_name='.($_REQUEST['info_alone_table_name']?$_REQUEST['info_alone_table_name']:$cc_info['info_alone_table_name']).'">独立控制</a>';
          if(is_file(CC_SAVE_PATH.($_REQUEST['class_alone_table_name']?"{$_REQUEST['class_alone_table_name']}_":'').'conf_class_info_'.$f_rs['id'].'.ccset')){
            echo '(<a href="ccset.php?id='.$f_rs['id'].'&type=class_info&del=1&class_alone_table_name='.($_REQUEST['class_alone_table_name']?$_REQUEST['class_alone_table_name']:$cc_info['class_alone_table_name']).'&info_alone_table_name='.($_REQUEST['info_alone_table_name']?$_REQUEST['info_alone_table_name']:$cc_info['info_alone_table_name']).'" onclick="return confirm(\'确定要【解除独立控制】吗？\')">解除</a>)';
          }
          echo ' | ';
          echo '<a href="ccset.php?reset=1&id='.$f_rs['id'].'&type=class_info&class_alone_table_name='.($_REQUEST['class_alone_table_name']?$_REQUEST['class_alone_table_name']:$cc_info['class_alone_table_name']).'&info_alone_table_name='.($_REQUEST['info_alone_table_name']?$_REQUEST['info_alone_table_name']:$cc_info['info_alone_table_name']).'" onclick="return confirm(\'【重置控制】将删除所有的控制设置。若父类存在延伸设置则默认继承设置。确定要重置吗？\')">重置控制</a>';
          echo ' | ';

          //加载自身的CC控制
          $_cc_info = array();
		  if(is_file(CC_SAVE_PATH.$cc_info['class_alone_table_name'].'_conf_'.$f_rs['id'].'.ccset')){
			$_cc_info = unserialize(file_get_contents(CC_SAVE_PATH.$cc_info['class_alone_table_name'].'_conf_'.$f_rs['id'].'.ccset'));
		  }
		  if(is_file(CC_SAVE_PATH.$cc_info['class_alone_table_name'].'_conf_class_info_'.$f_rs['id'].'.ccset')){
			$_cc_info = unserialize(file_get_contents(CC_SAVE_PATH.$cc_info['class_alone_table_name'].'_conf_class_info_'.$f_rs['id'].'.ccset'));
		  }
		  if(!$_cc_info){
			if(is_file(CC_SAVE_PATH.'conf_'.$f_rs['id'].'.ccset')){
				$_cc_info = unserialize(file_get_contents(CC_SAVE_PATH.'conf_'.$f_rs['id'].'.ccset'));
			}
			if(is_file(CC_SAVE_PATH.'conf_class_info_'.$f_rs['id'].'.ccset')){
				$_cc_info = unserialize(file_get_contents(CC_SAVE_PATH.'conf_class_info_'.$f_rs['id'].'.ccset'));
			}
		  }

          echo '<a href="ccset.php?reset_sub=1&id='.$f_rs['id'].'&class_alone_table_name='.$_cc_info['class_alone_table_name'].'&info_alone_table_name='.$_cc_info['info_alone_table_name'].'" onclick="return confirm(\'【重置子级控制】将删除本分类下所有子分类的控制设置。若本分类存在延伸设置则子分类默认继承设置。确定要重置吗？\')">重置子级控制</a>';
        }

        echo '</td></tr>';
		$_REQUEST['class_alone_table_name'] = $cc_info['class_alone_table_name'];
		$_REQUEST['info_alone_table_name'] = $cc_info['info_alone_table_name'];

		//跳过设置后台管理不展示分类
		if($f_value1==0 && $_cc_info['class_no_show_list']) continue;

		if ($f_level_num>$f_level_num_i) show_type_table($f_table_name,$f_value,$f_rs['id'],'&nbsp;&nbsp;&nbsp;&nbsp;'.$f_sign.'├',$f_key,$f_level_num-1);
		}
	}
}

//显示类目扩展栏目
function show_class_extend_column($cc_info,$f_rs,$pos){
	if($cc_info['class_extend_column']){
	 	foreach($cc_info['class_extend_column'] as $val){
	 		if($val['status']=='hide' || $val['pos']!=$pos) continue;
	 		echo '<td height="20" align="center">';
	 		if($val['type']=='php'){
				if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_extend_column_class_info_'.$f_rs['id'].'_'.create_extend_column_mark($val['title']).'.php')){
	 				include CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_extend_column_class_info_'.$f_rs['id'].'_'.create_extend_column_mark($val['title']).'.php';
	 			}else{
		 			if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_extend_column_'.$f_rs['id'].'_'.create_extend_column_mark($val['title']).'.php')){
		 				include CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_extend_column_'.$f_rs['id'].'_'.create_extend_column_mark($val['title']).'.php';
		 			}else{
		 				echo 'PHP文件未找到！';
		 			}
	 			}
	 		}else{
		 		$val['content'] = str_replace('__ID__', $f_rs['id'], $val['content']);
		 		foreach($f_rs as $_key=>$_val){
		 			$val['content'] = str_replace('__F_'.$_key.'__', $_val, $val['content']);
		 		}
		 		foreach($_REQUEST as $_key=>$_val){
		 			$val['content'] = str_replace('__R_'.$_key.'__', $_val, $val['content']);
		 		}
		 		echo $val['content'];
	 		}
	 		echo '</td>';
	 	}
	}
}

//显示信息扩展栏目标题
function show_info_extend_column_title($cc_info,$pos){
	if($cc_info['info_extend_column']){
        foreach($cc_info['info_extend_column'] as $val){
          if($val['status']=='hide' || $val['pos']!=$pos) continue;
          echo '<td '.($GLOBALS['i_line']%2==0?'bgcolor="#fcfcfc"':'').' align="center"><strong>';
          echo $val['title'];
          echo '</strong></td>';
        }
	}
}

//显示信息扩展栏目内容
function show_info_extend_column_content($cc_info,$rs,$pos){
	if($cc_info['info_extend_column']){
	 	foreach($cc_info['info_extend_column'] as $val){
	 		if($val['status']=='hide' || $val['pos']!=$pos) continue;
	 		echo '<td align="center">';
	 		if($val['type']=='php'){
				if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_extend_column_class_info_'.$rs['type_id'].'_'.create_extend_column_mark($val['title']).'.php')){
	 				include CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_extend_column_class_info_'.$rs['type_id'].'_'.create_extend_column_mark($val['title']).'.php';
	 			}else{
		 			if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_extend_column_'.$rs['type_id'].'_'.create_extend_column_mark($val['title']).'.php')){
		 				include CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_extend_column_'.$rs['type_id'].'_'.create_extend_column_mark($val['title']).'.php';
		 			}else{
		 				echo 'PHP文件未找到！';
		 			}
	 			}
	 		}else{
		 		$val['content'] = str_replace('__ID__', $rs['id'], $val['content']);
		 		foreach($rs as $_key=>$_val){
		 			$val['content'] = str_replace('__F_'.$_key.'__', $_val, $val['content']);
		 		}
		 		foreach($_REQUEST as $_key=>$_val){
		 			$val['content'] = str_replace('__R_'.$_key.'__', $_val, $val['content']);
		 		}
		 		echo $val['content'];
	 		}
	 		echo '</td>';
	 	}
	}
}

//显示类别扩展链接
function show_class_extend_action($cc_info,$f_rs,$pos,$fgx){
 	if($cc_info['class_extend_action']){
	 	foreach($cc_info['class_extend_action'] as $val){
	 		if(empty($val['title']) || $val['status']=='hide' || $val['pos']!=$pos) continue;
	 		if(!check_admin_action($val['title'])) continue;
	 		if($pos!='first'){
	        	//if($fgx) echo ' | ';
	        	$fgx = true;
        	}
	 		$val['url'] = str_replace('__ID__', $f_rs['id'], $val['url']);
	 		if(!stripos($val['url'], 'class_alone_table_name')) $val['url'].=(strpos($val['url'], '?')?'&':'?').'class_alone_table_name='.($_REQUEST['class_alone_table_name']?$_REQUEST['class_alone_table_name']:$cc_info['class_alone_table_name']);
	 		if(!stripos($val['url'], 'info_alone_table_name')) $val['url'].=(strpos($val['url'], '?')?'&':'?').'info_alone_table_name='.($_REQUEST['info_alone_table_name']?$_REQUEST['info_alone_table_name']:$cc_info['info_alone_table_name']);
	 		foreach($f_rs as $_key=>$_val){
	 			$val['url'] = str_replace('__F_'.$_key.'__', $_val, $val['url']);
	 		}
	 		foreach($_REQUEST as $_key=>$_val){
	 			$val['url'] = str_replace('__R_'.$_key.'__', $_val, $val['url']);
	 		}
	 		echo '<button class="button button_white" '.$val['attr'].' onClick="location.href=\''.$val['url'].'\';return false;">'.$val['title'].'</button>';
	 		//if($pos=='first') echo ' | ';
	 	}
	}
}

//显示信息扩展链接
function show_info_extend_action($cc_info,$rs,$pos,$fgx){
 	if($cc_info['info_extend_action']){
	 	foreach($cc_info['info_extend_action'] as $val){
	 		if(empty($val['title']) || $val['status']=='hide' || $val['pos']!=$pos) continue;
	 		if(!check_admin_action($val['title'])) continue;
	 		if($pos!='first'){
	        	//if($fgx) echo ' | ';
	        	$fgx = true;
        	}
	 		$val['url'] = str_replace('__ID__', $rs['id'], $val['url']);
	 		if(!stripos($val['url'], 'class_alone_table_name')) $val['url'].=(strpos($val['url'], '?')?'&':'?').'class_alone_table_name='.$cc_info['class_alone_table_name'];
	 		if(!stripos($val['url'], 'info_alone_table_name')) $val['url'].=(strpos($val['url'], '?')?'&':'?').'info_alone_table_name='.$cc_info['info_alone_table_name'];
	 		foreach($rs as $_key=>$_val){
	 			$val['url'] = str_replace('__F_'.$_key.'__', $_val, $val['url']);
	 		}
	 		foreach($_REQUEST as $_key=>$_val){
	 			$val['url'] = str_replace('__R_'.$_key.'__', $_val, $val['url']);
	 		}
          	echo '<button class="button button_white" '.$val['attr'].' onClick="location.href=\''.$val['url'].'\';return false;">'.$val['title'].'</button>';
	 		//if($pos=='first') echo ' | ';
	 	}
	}
}
	
//显示类别名称
function show_type_name($f_table_name,$f_value,$f_value1){
	global $conn;
	$f_sql='select * from `'.$f_table_name.'` where `'.$f_value1.'` = \''.$f_value.'\'';
	$f_result=mysql_query($f_sql,$conn);
	$f_rs=mysql_fetch_array($f_result);
	$l_value=$f_rs['cn_type'];
	return $l_value;
	
}
	
//所属档案ID
function show_type_one($f_table_name,$f_value){
	global $conn;
	$f_sql='select * from `'.$f_table_name.'` where `fixed_value`=\''.$f_value.'\'';
	$f_result=mysql_query($f_sql,$conn);
	$f_rs=mysql_fetch_array($f_result);
	$l_value=$f_rs['id'];
	return $l_value;	
}

//删除类别
function del_type($f_table_name,$f_table_name2,$f_value){
	global $conn;
	if (!$now_id) $now_id=0;
	$_temp = mysql_fetch_assoc(mysql_query("SELECT * FROM `{$f_table_name}` where `id`='{$f_value}'"));

	$cc_info = array();
	if(is_file(CC_SAVE_PATH.'conf_'.$_temp['type_id'].'.ccset')){
		$cc_info = unserialize(file_get_contents(CC_SAVE_PATH.'conf_'.$_temp['type_id'].'.ccset'));
	}

	//加载父级类自定义规则
	if(is_file(CC_SAVE_PATH.'conf_class_info_'.$_temp['type_id'].'.ccset')){
		$__temp = unserialize(file_get_contents(CC_SAVE_PATH.'conf_class_info_'.$_temp['type_id'].'.ccset'));
		$cc_info['class_info'] = $__temp['class_info'];
		$cc_info['class_extend_field'] = $__temp['class_extend_field'];
	}

	//加载类别删除前的脚本
	if($cc_info['class_script']['del_top']['status']=='show' && $cc_info['class_script']['del_top']['content']!=''){
		if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_del_top_'.$_temp['type_id'].'.php')){
			include CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_del_top_'.$_temp['type_id'].'.php';
		}
	}

	//加载删除类别控制信息
	$__cc_info = unserialize(file_get_contents(CC_SAVE_PATH.($cc_info['class_alone_table_name']?$cc_info['class_alone_table_name'].'_':'').'conf_'.$f_value.'.ccset'));

	//加载删除类别独立控制信息
	if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?$cc_info['class_alone_table_name'].'_':'').'conf_class_info_'.$_temp['type_id'].'.ccset')){
		$__temp = unserialize(file_get_contents(CC_SAVE_PATH.'conf_class_info_'.$_temp['type_id'].'.ccset'));
		$__cc_info['class_info'] = $__temp['class_info'];
		$__cc_info['class_extend_field'] = $__temp['class_extend_field'];
	}
	
	$f_sql='select * from `'.($__cc_info['class_alone_table_name']?"{$__cc_info['class_alone_table_name']}":$f_table_name).'` where `type_id` ='.$f_value.' order by `num` desc';
	$f_result=mysql_query($f_sql,$conn);
	while ($f_rs=mysql_fetch_array($f_result))
	{
		if ($f_rs) del_type(($__cc_info['class_alone_table_name']?"{$__cc_info['class_alone_table_name']}":$f_table_name),($__cc_info['info_alone_table_name']?"{$__cc_info['info_alone_table_name']}":$f_table_name2),$f_rs['id']);
	}

	$f_sql='delete from `'.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}":$f_table_name).'` where `id`='.$f_value;
	mysql_query($f_sql,$conn);

	//删除自定义上传字段文件
	if($cc_info['class_extend_field']){
		foreach($cc_info['class_extend_field'] as $_key=>$_value){
			if($_value['type']=='img'){
				!empty($_temp[$_value['field']]) && @unlink(dirname(__FILE__).'/../../uploadfiles/'.$_temp[$_value['field']]);
			}
		}
	}

	//删除独立控制自定义上传字段文件
	if($__cc_info['class_extend_field']){
		foreach($__cc_info['class_extend_field'] as $_key=>$_value){
			if($_value['type']=='img'){
				!empty($_temp[$_value['field']]) && @unlink(dirname(__FILE__).'/../../uploadfiles/'.$_temp[$_value['field']]);
			}
		}
	}

	@unlink(CC_SAVE_PATH.($cc_info['class_alone_table_name']?$cc_info['class_alone_table_name'].'_':'').'conf_'.$f_value.'.ccset');
	@unlink(CC_SAVE_PATH.($cc_info['class_alone_table_name']?$cc_info['class_alone_table_name'].'_':'').'conf_class_info_'.$f_value.'.ccset');

  	//清除原有自定PHP文件
 	//扩展栏目
	$class_file_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_extend_column_'.$f_value.'_';
	$class_file_head_len = strlen($class_file_head);
	$info_file_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_extend_column_'.$f_value.'_';
	$info_file_head_len = strlen($info_file_head);

	//自定义菜单
	$custom_menu_top_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'custom_menu_top_'.$f_value;
	$custom_menu_top_head_len = strlen($custom_menu_top_head);
	$custom_menu_bottom_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'custom_menu_bottom_'.$f_value;
	$custom_menu_bottom_head_len = strlen($custom_menu_bottom_head);

	//类别扩展脚本
	$class_script_list_top_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_list_top_'.$f_value;
	$class_script_list_top_head_len = strlen($class_script_list_top_head);
	$class_script_add_top_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_add_top_'.$f_value;
	$class_script_add_top_head_len = strlen($class_script_add_top_head);
	$class_script_add_bottom_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_add_bottom_'.$f_value;
	$class_script_add_bottom_head_len = strlen($class_script_add_bottom_head);
	$class_script_edit_top_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_edit_top_'.$f_value;
	$class_script_edit_top_head_len = strlen($class_script_edit_top_head);
	$class_script_edit_bottom_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_edit_bottom_'.$f_value;
	$class_script_edit_bottom_head_len = strlen($class_script_edit_bottom_head);
	$class_script_del_top_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_del_top_'.$f_value;
	$class_script_del_top_head_len = strlen($class_script_del_top_head);
	$class_script_del_bottom_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_del_bottom_'.$f_value;
	$class_script_del_bottom_head_len = strlen($class_script_del_bottom_head);

	$class_script_list_js_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_list_js_'.$f_value;
	$class_script_list_js_head_len = strlen($class_script_list_js_head);
	$class_script_add_js_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_add_js_'.$f_value;
	$class_script_add_js_head_len = strlen($class_script_add_js_head);
	$class_script_edit_js_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_edit_js_'.$f_value;
	$class_script_edit_js_head_len = strlen($class_script_edit_js_head);

	//信息扩展脚本
	$info_script_list_top_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_list_top_'.$f_value;
	$info_script_list_top_head_len = strlen($info_script_list_top_head);
	$info_script_add_top_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_add_top_'.$f_value;
	$info_script_add_top_head_len = strlen($info_script_add_top_head);
	$info_script_add_bottom_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_add_bottom_'.$f_value;
	$info_script_add_bottom_head_len = strlen($info_script_add_bottom_head);
	$info_script_edit_top_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_edit_top_'.$f_value;
	$info_script_edit_top_head_len = strlen($info_script_edit_top_head);
	$info_script_edit_bottom_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_edit_bottom_'.$f_value;
	$info_script_edit_bottom_head_len = strlen($info_script_edit_bottom_head);
	$info_script_del_top_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_del_top_'.$f_value;
	$info_script_del_top_head_len = strlen($info_script_del_top_head);
	$info_script_del_bottom_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_del_bottom_'.$f_value;
	$info_script_del_bottom_head_len = strlen($info_script_del_bottom_head);

	$info_script_list_js_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_list_js_'.$f_value;
	$info_script_list_js_head_len = strlen($info_script_list_js_head);
	$info_script_add_js_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_add_js_'.$f_value;
	$info_script_add_js_head_len = strlen($info_script_add_js_head);
	$info_script_edit_js_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_edit_js_'.$f_value;
	$info_script_edit_js_head_len = strlen($info_script_edit_js_head);

	$info_script_search_html_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_search_html_'.$f_value;
	$info_script_search_html_head_len = strlen($info_script_search_html_head);
	$info_script_search_php_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_search_php_'.$f_value;
	$info_script_search_php_head_len = strlen($info_script_search_php_head);
	$info_script_batch_html_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_batch_html_'.$f_value;
	$info_script_batch_html_head_len = strlen($info_script_batch_html_head);
	$info_script_batch_php_head = ($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'info_script_batch_php_'.$f_value;
	$info_script_batch_php_head_len = strlen($info_script_batch_php_head);

	$info_script_head_len = strlen($info_script_head);
	$dh = opendir(CC_SAVE_PATH);
	while($fn = readdir($dh)){
		if(
			substr($fn,0,$class_file_head_len)==$class_file_head
			|| substr($fn,0,$info_file_head_len)==$info_file_head 
			
			|| substr($fn,0,$custom_menu_top_head_len)==$custom_menu_top_head 
			|| substr($fn,0,$custom_menu_bottom_head_len)==$custom_menu_bottom_head
			
			|| substr($fn,0,$class_script_list_top_head_len)==$class_script_list_top_head
			|| substr($fn,0,$class_script_add_top_head_len)==$class_script_add_top_head
			|| substr($fn,0,$class_script_add_bottom_head_len)==$class_script_add_bottom_head
			|| substr($fn,0,$class_script_edit_top_head_len)==$class_script_edit_top_head
			|| substr($fn,0,$class_script_edit_bottom_head_len)==$class_script_edit_bottom_head
			|| substr($fn,0,$class_script_del_top_head_len)==$class_script_del_top_head
			|| substr($fn,0,$class_script_del_bottom_head_len)==$class_script_del_bottom_head

			|| substr($fn,0,$class_script_list_js_head_len)==$class_script_list_js_head
			|| substr($fn,0,$class_script_add_js_head_len)==$class_script_add_js_head
			|| substr($fn,0,$class_script_edit_js_head_len)==$class_script_edit_js_head

			|| substr($fn,0,$info_script_list_top_head_len)==$info_script_list_top_head
			|| substr($fn,0,$info_script_add_top_head_len)==$info_script_add_top_head
			|| substr($fn,0,$info_script_add_bottom_head_len)==$info_script_add_bottom_head
			|| substr($fn,0,$info_script_edit_top_head_len)==$info_script_edit_top_head
			|| substr($fn,0,$info_script_edit_bottom_head_len)==$info_script_edit_bottom_head
			|| substr($fn,0,$info_script_del_top_head_len)==$info_script_del_top_head
			|| substr($fn,0,$info_script_del_bottom_head_len)==$info_script_del_bottom_head

			|| substr($fn,0,$info_script_list_js_head_len)==$info_script_list_js_head
			|| substr($fn,0,$info_script_add_js_head_len)==$info_script_add_js_head
			|| substr($fn,0,$info_script_edit_js_head_len)==$info_script_edit_js_head

			|| substr($fn,0,$info_script_search_html_head_len)==$info_script_search_html_head
			|| substr($fn,0,$info_script_search_php_head_len)==$info_script_search_php_head
			|| substr($fn,0,$info_script_batch_html_head_len)==$info_script_batch_html_head
			|| substr($fn,0,$info_script_batch_php_head_len)==$info_script_batch_php_head
			){
			@unlink(CC_SAVE_PATH.$fn);
		}
	}
	closedir($dh);

	$f_sql='select * from `'.($__cc_info['info_alone_table_name']?"{$__cc_info['info_alone_table_name']}":$f_table_name2).'` where `type_id`=\''.$f_value."'";
	$f_result=mysql_query($f_sql,$conn);
	while ($f_rs=mysql_fetch_array($f_result))
	{
		//删除默认字段(images1),(images2)文件
		!empty($f_rs['images1']) && @unlink(dirname(__FILE__).'/../../uploadfiles/'.$f_rs['images1']);
		!empty($f_rs['images2']) && @unlink(dirname(__FILE__).'/../../uploadfiles/'.$f_rs['images2']);

		//删除自定义上传字段文件
		if($__cc_info['info_extend_field']){
			foreach($__cc_info['info_extend_field'] as $_key=>$_value){
				if($_value['type']=='img'){
					!empty($f_rs[$_value['field']]) && @unlink(dirname(__FILE__).'/../../uploadfiles/'.$f_rs[$_value['field']]);
				}
			}
		}

		//删除信息独立设置自定义上传字段文件
		if($__cc_info['info_alone_table_name']){
			$alone_cc_info = unserialize(file_get_contents(CC_SAVE_PATH.$__cc_info['info_alone_table_name'].'_conf_info_'.$f_rs['id'].'.ccset'));
			if($alone_cc_info['info_extend_field']){
				foreach($alone_cc_info['info_extend_field'] as $_key=>$_value){
					if($_value['type']=='img'){
						!empty($f_rs[$_value['field']]) && @unlink(dirname(__FILE__).'/../../uploadfiles/'.$f_rs[$_value['field']]);
					}
				}
			}
		}

		//删除信息控制设置
		@unlink(CC_SAVE_PATH.($__cc_info['info_alone_table_name']?"{$__cc_info['info_alone_table_name']}_":'').'conf_info_'.$f_rs['id'].'.ccset');
	}

	$old_conf_showmenu = file_get_contents(CC_SAVE_PATH.'conf_showmenu.ccset');
	$conf_showmenu = unserialize($old_conf_showmenu);
	unset($conf_showmenu[$f_value]);
	$new_conf_showmenu = serialize($conf_showmenu);
	file_put_contents(CC_SAVE_PATH.'conf_showmenu.ccset', $new_conf_showmenu);

	$f_sql='delete from `'.($__cc_info['info_alone_table_name']?"{$__cc_info['info_alone_table_name']}":$f_table_name2).'` where `type_id`='.$f_value;
	mysql_query($f_sql,$conn);

	//加载类别删除后的脚本
	if($cc_info['class_script']['del_bottom']['status']=='show' && $cc_info['class_script']['del_bottom']['content']!=''){
		if(is_file(CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_del_bottom_'.$_temp['type_id'].'.php')){
			include CC_SAVE_PATH.($cc_info['class_alone_table_name']?"{$cc_info['class_alone_table_name']}_":'').'class_script_del_bottom_'.$_temp['type_id'].'.php';
		}
	}
}

//显示循环类别ID
function show_type_all_id($f_table_name,$f_value){
	global $conn;
	global $f_sql_name;
	$f_sql='select * from `'.$f_table_name.'` where `type_id`=\''.$f_value.'\' order by `num` desc';
	$f_result=mysql_query($f_sql,$conn);
	while ($f_rs=mysql_fetch_array($f_result))
	{
		if ($f_rs)
		{
		$f_sql_name=$f_sql_name.'`type_id` = \''.$f_rs['id'].'\' or ';
		show_type_all_id($f_table_name,$f_rs['id']);
		}
	}
}

//检查是否存在类别
function check_type_is_exist($f_table_name,$f_value){
	global $conn;
	global $show_msg_title;
	$f_sql='select * from `'.$f_table_name.'` where `type_id`=\''.$f_value.'\' order by `num` desc';
	$f_result=mysql_query($f_sql,$conn);
	$f_num=mysql_num_rows($f_result);

	if ($f_num<1) show_msg($show_msg_title.'未发现有相关类别信息，请先添加类别后再录入数据！',4,'class_save.php?manage_id='.$f_value);
}

//检查是否存在类别
function check_one_type_is_exist($f_table_name,$f_value_name,$f_value,$f_value_name2,$f_value2,$f_msg_value,$f_goto,$f_goto_url,$f_value101,$f_value102,$f_value103,$f_value104,$f_value105,$f_value106,$f_value107,$f_value108,$f_value109,$f_value110){
	global $conn;
	global $show_msg_title;
	
	$f_sql='select * from `'.$f_table_name.'` where `'.$f_value_name.'` = \''.$f_value.'\' and `'.$f_value_name2.'` = \''.$f_value2."'";
	$f_result=mysql_query($f_sql,$conn);
	$f_num=mysql_num_rows($f_result);
		
		if ($f_num>0) show_msg_d($show_msg_title.$f_msg_value,$f_goto,$f_goto_url,$f_value101,$f_value102,$f_value103,$f_value104,$f_value105,$f_value106,$f_value107,$f_value108,$f_value109,$f_value110);
}

function re_keyword($f_value,$f_keyword,$f_color){
	if (!$f_color) $f_color = '#FF0000';
	$l_value = str_replace($f_keyword,'<font color="'.$f_color.'";>'.$f_keyword.'</font>',$f_value);
	return $l_value;
}

function show_table_num($f_table_name,$f_table_name2){
	global $conn;
	global $manage_id;
	global $f_sql_name;
	$f_sql='select * from `'.$f_table_name2.'` where 1=1';
	$f_sql .= ' and (';
	$f_sql .= $f_sql_name;
	$f_sql .= '`type_id`=\''.$manage_id.'\')';
	$f_sql .= ' order by `num` desc';
	$f_result=mysql_query($f_sql,$conn);
	$f_rs=mysql_fetch_array($f_result);
	if ($f_rs) $l_value=$f_rs['num']+10;
	else $l_value=10;
	return $l_value;
}

function check_drop($f_value,$f_drop,$f_name,$f_from_value,$f_go_to,$f_value101,$f_value102,$f_value103,$f_value104,$f_value105,$f_value106,$f_value107,$f_value108,$f_value109,$f_value110){
	global $show_msg_title;
	if (!$f_go_to) $f_go_to = 3;
	switch ($f_value)
	{
	case 'c_int':
	  if (is_numeric($f_drop) == false || intval($f_drop) != $f_drop){
		if(IS_ENG){
			show_msg_d($show_msg_title.'【'.$f_name.'】is null or not integer.',$f_go_to,'',$f_value101,$f_value102,$f_value103,$f_value104,$f_value105,$f_value106,$f_value107,$f_value108,$f_value109,$f_value110);
		}else{
			show_msg_d($show_msg_title.'【'.$f_name.'】没有数据或数据数值不为整数，请检查数据！',$f_go_to,'',$f_value101,$f_value102,$f_value103,$f_value104,$f_value105,$f_value106,$f_value107,$f_value108,$f_value109,$f_value110);
		}
	  }
	  break;
	case 'c_number':
	  if (is_numeric($f_drop) == false){
		if(IS_ENG){
			show_msg_d($show_msg_title.'【'.$f_name.'】is null or not number.',$f_go_to,'',$f_value101,$f_value102,$f_value103,$f_value104,$f_value105,$f_value106,$f_value107,$f_value108,$f_value109,$f_value110);
		}else{
			show_msg_d($show_msg_title.'【'.$f_name.'】没有数据或数据不为数值，请检查数据！',$f_go_to,'',$f_value101,$f_value102,$f_value103,$f_value104,$f_value105,$f_value106,$f_value107,$f_value108,$f_value109,$f_value110);
		}
	  } 
	  break;
	case 'c_date':
	  if (show_date($f_drop,'') != $f_drop && show_date($f_drop,'Y-n-j') != $f_drop && show_date($f_drop,'y-n-j') != $f_drop && show_date($f_drop,'y-m-d') != $f_drop && show_date($f_drop,'Y/m/d') != $f_drop && show_date($f_drop,'Y-n-j') != $f_drop && show_date($f_drop,'y-m-d') != $f_drop && show_date($f_drop,'y-n-j') != $f_drop){
		if(IS_ENG){
			show_msg_d($show_msg_title.'【'.$f_name.'】is null or not date，date format like【'.date('Y-m-d').'】',$f_go_to,'',$f_value101,$f_value102,$f_value103,$f_value104,$f_value105,$f_value106,$f_value107,$f_value108,$f_value109,$f_value110);
		}else{
			show_msg_d($show_msg_title.'【'.$f_name.'】没有数据或数据不为日期，日期格式如【'.date('Y-m-d').'】，请检查数据！',$f_go_to,'',$f_value101,$f_value102,$f_value103,$f_value104,$f_value105,$f_value106,$f_value107,$f_value108,$f_value109,$f_value110);
		}
	  } 
	  break; 
	case 'c_datetime':
	  if (show_date($f_drop,'Y-m-d H:i:s') != $f_drop && show_date($f_drop,'Y-n-j H:i:s') != $f_drop && show_date($f_drop,'y-n-j H:i:s') != $f_drop && show_date($f_drop,'y-m-d H:i:s') != $f_drop && show_date($f_drop,'Y/m/d H:i:s') != $f_drop && show_date($f_drop,'Y-n-j H:i:s') != $f_drop && show_date($f_drop,'y-m-d H:i:s') != $f_drop && show_date($f_drop,'y-n-j H:i:s') != $f_drop){
		if(IS_ENG){
			show_msg_d($show_msg_title.'【'.$f_name.'】is null or not date，date format like【'.date('Y-m-d H:i:s').'】',$f_go_to,'',$f_value101,$f_value102,$f_value103,$f_value104,$f_value105,$f_value106,$f_value107,$f_value108,$f_value109,$f_value110);
		}else{
			show_msg_d($show_msg_title.'【'.$f_name.'】没有数据或数据不为日期，日期格式如【'.date('Y-m-d H:i:s').'】，请检查数据！',$f_go_to,'',$f_value101,$f_value102,$f_value103,$f_value104,$f_value105,$f_value106,$f_value107,$f_value108,$f_value109,$f_value110);
		}
	  } 
	  break;
	case 'c_bit':
	  if ($f_drop != '1' && $f_drop != '0'){
		if(IS_ENG){
			show_msg_d($show_msg_title.'【'.$f_name.'】is null or type is error.',$f_go_to,'',$f_value101,$f_value102,$f_value103,$f_value104,$f_value105,$f_value106,$f_value107,$f_value108,$f_value109,$f_value110);
		}else{
			show_msg_d($show_msg_title.'【'.$f_name.'】没有数据或数据类型不正确，请检查数据！',$f_go_to,'',$f_value101,$f_value102,$f_value103,$f_value104,$f_value105,$f_value106,$f_value107,$f_value108,$f_value109,$f_value110);
		}
	  } 
	  break; 
	case 'c_str':
	  if (!$f_drop){
		if(IS_ENG){
			show_msg_d($show_msg_title.'【'.$f_name.'】is null.',$f_go_to,'',$f_value101,$f_value102,$f_value103,$f_value104,$f_value105,$f_value106,$f_value107,$f_value108,$f_value109,$f_value110);
		}else{
			show_msg_d($show_msg_title.'【'.$f_name.'】没有数据或数据为空格，请检查数据！',$f_go_to,'',$f_value101,$f_value102,$f_value103,$f_value104,$f_value105,$f_value106,$f_value107,$f_value108,$f_value109,$f_value110);
		}
	  } 
	  break; 
	default:
	}

}

function set_cookie($f_value){
	global $this_url,$set_cookie_time,$set_cookie_path;
	setcookie($f_value,$this_url,$set_cookie_time,$set_cookie_path);	
}

function show_frame($f_value){
	if (!$f_value) $f_value = 'webtempframe';
	$l_value = '<iframe src="" width="0" height="0" id="'.$f_value.'" name="'.$f_value.'" style="display:none"></iframe>';
	return $l_value;
}

function show_m($f_value1,$f_value2,$f_value3,$f_value4,$f_value5){
	$f_value1 = trim($f_value1);
	$f_value2 = trim($f_value2);
	$f_value3 = trim($f_value3);
	if (!$f_value1) $f_value1 = "001";
	if (!$f_value2) $f_value2 = "#FFFFFF";
	if (!$f_value3) $f_value3 = "onKeyUp";
	
	if ($f_value1 == '001') $l_value = $f_value3.'="this.style.background=\''.$f_value2.'\'"';
	elseif ($f_value1 == '002') $l_value = $f_value3.'="this.className=\''.$f_value2.'\'"';
	return $l_value;

}

function show_info($f_table_name,$f_fvalue,$f_svalue,$f_value){
	global $conn;
	if (!$f_table_name) $f_table_name = 'atype_info';
	if (!$f_svalue) $f_svalue = 'id';
	if (!$f_value) $f_value = 'cn_name';
	$f_sql = 'select * from `'.$f_table_name.'` where `'.$f_svalue.'` = \''.$f_fvalue.'\'';
	$f_result = mysql_query($f_sql,$conn);
	$f_rs = mysql_fetch_array($f_result);
	$l_value = $f_rs[$f_value];
	return $l_value;
}

//生成扩展栏目标识
function create_extend_column_mark($title){
	return substr(md5($title),12,8);
}

//获取扩展字段数据
function get_extend_field_info($table,$type_id,$field,$opt){
	include CC_SAVE_PATH.'extend_field_info.php';
	if(empty($extend_field_info[$table][$type_id][$field])) return false;
	$_field = $extend_field_info[$table][$type_id][$field];
	if($opt=='option'){
		//读取类别
		if(substr($_field['option'],0,6)=='atype:'){
			$_temp = explode(':', $_field['option']);
			$_table = 'atype';
			$_cc_info = array();
			
			if(strpos($_temp[1],',')){
				$___temp = explode(',',$_temp[1]);
				$_temp[1] = $___temp[0];
			}
			
			if(is_file(CC_SAVE_PATH.'conf_'.$_temp[1].'.ccset')){
				$_cc_info = unserialize(file_get_contents(CC_SAVE_PATH.'conf_'.$_temp[1].'.ccset'));
				if($_cc_info['class_alone_table_name']) $_table = $_cc_info['class_alone_table_name'];
			}
			$_query = mysql_query("SELECT * FROM `{$_table}` WHERE `type_id`='{$_temp[1]}'");
			$option = array(''=>'');
			while($_info = mysql_fetch_assoc($_query)){
				$option[$_info['id']] = $_info[empty($___temp[1])?'cn_type':$___temp[1]];
			}
		//读取全部类别
		}elseif(substr($_field['option'],0,10)=='atype_all:'){
			if(!function_exists('_load_atypes')){
				function _load_atypes($_type_id,$i=0,$_fieldname='cn_type'){
					foreach($GLOBALS['_option'] as $__val){
						if($__val['type_id']==$_type_id){
							$GLOBALS['option'][$__val['id']] = str_pad('', $i*12,'&nbsp;&nbsp;',STR_PAD_LEFT).str_pad('', $i,'|-',STR_PAD_LEFT).$__val[$_fieldname];
							if($__val['subs']>0) _load_atypes($__val['id'],$i+2,$_fieldname);
						}
					}
				}				
			}
			$_temp = explode(':', $_field['option']);

			if(strpos($_temp[1],',')){
				$___temp = explode(',',$_temp[1]);
				$_temp[1] = $___temp[0];
			}

			global $f_sql_name;
			show_type_all_id('atype',$_temp[1]);
			$f_sql_name.="`type_id`={$_temp[1]}";
			$_table = 'atype';
			$_cc_info = array();
			if(is_file(CC_SAVE_PATH.'conf_'.$_temp[1].'.ccset')){
				$_cc_info = unserialize(file_get_contents(CC_SAVE_PATH.'conf_'.$_temp[1].'.ccset'));
				if($_cc_info['class_alone_table_name']) $_table = $_cc_info['class_alone_table_name'];
			}
			$_query = mysql_query("SELECT * FROM `{$_table}` WHERE {$f_sql_name}");
			global $_option;
			$_option = array();
			while($_info = mysql_fetch_assoc($_query)){
				$_info['subs'] = 0;
				$_option[$_info['id']] = $_info;
				$_option[$_info['type_id']]['subs']+=1;
			}
			unset($f_sql_name);
			global $option;
			$option = array();
			$option = array(''=>'');
			$option[$_temp[1]] = $_option[$_info['id']]['cn_type'];
			_load_atypes($_temp[1],0,$___temp[1]);
		//读取信息
		}elseif(substr($_field['option'],0,11)=='atype_info:'){
			$_temp = explode(':', $_field['option']);
			$_table = 'atype_info';
			$_cc_info = array();
			
			if(strpos($_temp[1],',')){
				$___temp = explode(',',$_temp[1]);
				$_temp[1] = $___temp[0];
			}
			
			if(is_file(CC_SAVE_PATH.'conf_'.$_temp[1].'.ccset')){
				$_cc_info = unserialize(file_get_contents(CC_SAVE_PATH.'conf_'.$_temp[1].'.ccset'));
				if($_cc_info['info_alone_table_name']) $_table = $_cc_info['info_alone_table_name'];
			}
			$_query = mysql_query("SELECT * FROM `{$_table}` WHERE `type_id`='{$_temp[1]}'");
			$option = array(''=>'');
			while($_info = mysql_fetch_assoc($_query)){
				$option[$_info['id']] = $_info[empty($___temp[1])?'cn_name':$___temp[1]];
			}
		//读取某个表的全部信息
		}elseif(substr($_field['option'],0,13)=='select_table:'){
			$_temp = explode(':', $_field['option']);
			
			if(strpos($_temp[1],',')){
				$___temp = explode(',',$_temp[1]);
				$_temp[1] = $___temp[0];
			}

			if($___temp[2]) $___temp[2] = 'WHERE '.$___temp[2];
			
			$_query = mysql_query("SELECT * FROM `{$_temp[1]}`{$___temp[2]}");
			$option = array(''=>'');
			while($_info = mysql_fetch_assoc($_query)){
				$option[$_info['id']] = $_info[$___temp[1]];
			}
		//设定值
		}elseif(strstr($_field['option'], '=')){
			$_temp = explode('|', $_field['option']);
			foreach($_temp as $_key=>$_value){
				$_tmp = explode('=', $_value);
				$option[$_tmp[0]] = $_tmp[1];
			}
		//设定值
		}else{
			$_temp = explode('|', $_field['option']);
			foreach($_temp as $_value){
				$option[$_value] = $_value;
			}
		}
		unset($option['']);
		return $option;
	}else{
		return $_field[$option];
	}
}

//解析复选字段内容
function parse_extend_checkbox_field_data($data){
	if($data=='' || $data=='||||'){
		return array();
	}else{
		if(stristr($data, '||')){
			$tmp = explode('||', $data);
			$result = array();
			for($i=1;$i<count($tmp)-1;$i++){
				$result[] = $tmp[$i];
			}
			return $result;
		}else{
			return explode('|', $data);
		}
	}
}

//构建自定义字段SQL
function get_extend_field_csql($table_name, $field_info){
	switch($field_info['type']){
		case 'string':
		case 'password':
		case 'img':
		case 'select':
		case 'radio':
		case 'checkbox':
			$GLOBALS['field_type_sql'] = 'VARCHAR(255)';
			$GLOBALS['field_defval_sql'] = "NULL DEFAULT ''";
			$GLOBALS['index_sql'] = "ALTER TABLE `{$table_name}` ADD INDEX `{$field_info['field']}` (`{$field_info['field']}`)";
			break;
		case 'int':
			$GLOBALS['field_type_sql'] = 'INT(11)';
			$GLOBALS['field_defval_sql'] = "NULL DEFAULT '0'";
			$GLOBALS['index_sql'] = "ALTER TABLE `{$table_name}` ADD INDEX `{$field_info['field']}` (`{$field_info['field']}`)";
			break;
		case 'password_md5':
			$GLOBALS['field_type_sql'] = 'CHAR(32)';
			$GLOBALS['field_defval_sql'] = "NULL DEFAULT ''";
			$GLOBALS['index_sql'] = "ALTER TABLE `{$table_name}` ADD INDEX `{$field_info['field']}` (`{$field_info['field']}`)";
			break;
		case 'text':
		case 'rtext':
			$GLOBALS['field_type_sql'] = 'TEXT';
			break;
		default:
			show_msg('未知类型');
			break;
	}
	if(empty($GLOBALS['field_type_sql'])) show_msg('未知字段结构');
	if($GLOBALS['field_defval_sql']!='' && $field_info['defval']!=='') $GLOBALS['field_defval_sql'] = "NULL DEFAULT '".mysql_real_escape_string($field_info['defval'])."'";
}

//二维数组排序
function array_sort($arr,$keys,$type='asc'){ 
	if(empty($arr)) return $arr;
	$keysvalue = $new_array = array();
	foreach ($arr as $k=>$v){
		$keysvalue[$k] = $v[$keys];
	}
	if($type == 'asc'){
		asort($keysvalue);
	}else{
		arsort($keysvalue);
	}
	reset($keysvalue);
	foreach ($keysvalue as $k=>$v){
		$new_array[$k] = $arr[$k];
	}
	return $new_array; 
} 

//检测自定义字段是否重定义默认字段
function check_default_field_in_extend_field($_extend_fields, $default_field){
	if(!is_array($_extend_fields) || empty($default_field)) return false;
	if($_extend_fields['field']){
		foreach($_extend_fields['field'] as $_key=>$_val){

			if($_val==$default_field) return true;
		}
	}
	return false;
}

//显示自定义字段
function insert_extend_field_box($_field){
	//if($_field['title']=='') return '';
	$posfield = "{$_field['type_id']}_{$_field['pos']}_{$_field['field']}";
	$name_id="extend_field_{$posfield}";
	$value = $GLOBALS[$name_id];

	//如果是添加数据，有默认值则读取默认值，或者有附带值就读取附带值
	if($GLOBALS['t_action']=='0001') $value = $_field['defval'];
	if(isset($_REQUEST[$_field['field']])){
		$value = $_REQUEST[$_field['field']];
	}

	//读取类别
	if(substr($_field['option'],0,6)=='atype:'){
		$_temp = explode(':', $_field['option']);
		$_table = 'atype';
		$_cc_info = array();
		
		if(strpos($_temp[1],',')){
			$___temp = explode(',',$_temp[1]);
			$_temp[1] = $___temp[0];
		}
		
		if(is_file(CC_SAVE_PATH.'conf_'.$_temp[1].'.ccset')){
			$_cc_info = unserialize(file_get_contents(CC_SAVE_PATH.'conf_'.$_temp[1].'.ccset'));
			if($_cc_info['class_alone_table_name']) $_table = $_cc_info['class_alone_table_name'];
		}
		$_query = mysql_query("SELECT * FROM `{$_table}` WHERE `type_id`='{$_temp[1]}'");
		$iefb_option = array(''=>'');
		while($_info = mysql_fetch_assoc($_query)){
			$iefb_option[$_info['id']] = $_info[empty($___temp[1])?'cn_type':$___temp[1]];
		}
	//读取全部类别
	}elseif(substr($_field['option'],0,10)=='atype_all:'){
		if(!function_exists('_load_atypes')){
			function _load_atypes($_type_id,$i=0,$_fieldname='cn_type'){
				if(empty($_fieldname)) $_fieldname='cn_type';
				if($GLOBALS['iefb__option']){
					foreach($GLOBALS['iefb__option'] as $__val){
						if($__val['type_id']==$_type_id){
							$GLOBALS['iefb_option'][$__val['id']] = str_pad('', $i*12,'&nbsp;&nbsp;',STR_PAD_LEFT).str_pad('', $i,'|-',STR_PAD_LEFT).$__val[$_fieldname];
							if($__val['subs']>0) _load_atypes($__val['id'],$i+2,$_fieldname);
						}
					}
				}
			}
		}
		$_temp = explode(':', $_field['option']);

		if(strpos($_temp[1],',')){
			$___temp = explode(',',$_temp[1]);
			$_temp[1] = $___temp[0];
		}

		$_table = 'atype';
		$_cc_info = array();
		if(is_file(CC_SAVE_PATH.'conf_'.$_temp[1].'.ccset')){
			$_cc_info = unserialize(file_get_contents(CC_SAVE_PATH.'conf_'.$_temp[1].'.ccset'));
			if($_cc_info['class_alone_table_name']) $_table = $_cc_info['class_alone_table_name'];
		}
		global $f_sql_name;
		$f_sql_name='';
		show_type_all_id($_table,$_temp[1]);
		$f_sql_name.='type_id='.$_temp[1];
		$_query = mysql_query("SELECT * FROM `{$_table}` WHERE {$f_sql_name}");
		global $iefb__option;
		while($_info = mysql_fetch_assoc($_query)){
			$_info['subs'] = 0;
			$iefb__option[$_info['id']] = $_info;
			$iefb__option[$_info['type_id']]['subs']+=1;
		}
		unset($f_sql_name);
		global $iefb_option;
		$iefb_option = array(''=>'');
		_load_atypes($_temp[1],0,$___temp[1]);
	//读取信息
	}elseif(substr($_field['option'],0,11)=='atype_info:'){
		$_temp = explode(':', $_field['option']);
		$_table = 'atype_info';
		$_cc_info = array();
		
		if(strpos($_temp[1],',')){
			$___temp = explode(',',$_temp[1]);
			$_temp[1] = $___temp[0];
		}
		
		if(is_file(CC_SAVE_PATH.'conf_'.$_temp[1].'.ccset')){
			$_cc_info = unserialize(file_get_contents(CC_SAVE_PATH.'conf_'.$_temp[1].'.ccset'));
			if($_cc_info['info_alone_table_name']) $_table = $_cc_info['info_alone_table_name'];
		}
		$_query = mysql_query("SELECT * FROM `{$_table}` WHERE `type_id`='{$_temp[1]}'");
		$iefb_option = array(''=>'');
		while($_info = mysql_fetch_assoc($_query)){
			$iefb_option[$_info['id']] = $_info[empty($___temp[1])?'cn_name':$___temp[1]];
		}
	//读取某个表的全部信息
	}elseif(substr($_field['option'],0,13)=='select_table:'){
		$_temp = explode(':', $_field['option']);
		
		if(strpos($_temp[1],',')){
			$___temp = explode(',',$_temp[1]);
			$_temp[1] = $___temp[0];
		}

		if($___temp[2]) $___temp[2] = 'WHERE '.$___temp[2];

		$_query = mysql_query("SELECT * FROM `{$_temp[1]}`{$___temp[2]}");
		$iefb_option = array(''=>'');
		while($_info = mysql_fetch_assoc($_query)){
			$iefb_option[$_info['id']] = $_info[$___temp[1]];
		}
	//设定值
	}elseif(strpos($_field['option'], '=')){
		$_temp = explode('|', $_field['option']);
		foreach($_temp as $_key=>$_value){
			$_tmp = explode('=', $_value);
			$iefb_option[$_tmp[0]] = $_tmp[1];
		}
	//设定值
	}else{
		$_temp = explode('|', $_field['option']);
		foreach($_temp as $_value){
			$iefb_option[$_value] = $_value;
		}
	}
?>
    <tr class="extend_field_tr" id="page_<?php echo $name_id; ?>_box" style="display:none">
      <td width="16%" align="right" bgcolor="#FFFFFF"><span id="page_<?php echo $name_id; ?>_txt"><?php echo $_field['title']; ?></span>：</td>
      <td width="27%" bgcolor="#FFFFFF">
      	<?php
      	if($_field['qtxt']) echo $_field['qtxt'];
      	if($_field['type']=='string'){
      	?>
      	<input name="<?php echo $name_id; ?>" type="text" id="<?php echo $name_id; ?>" value="<?php echo $value;?>" class="qbt_syzsf" <?php echo $_field['attr']; ?>>
      	<?php
      	}elseif($_field['type']=='int'){
      	?>
      	<input name="<?php echo $name_id; ?>" type="text" id="<?php echo $name_id; ?>" value="<?php echo $value;?>" class="qbt_syzsf" <?php echo $_field['attr']; ?>>
      	<?php
      	}elseif($_field['type']=='password'){
      	?>
      	<input name="<?php echo $name_id; ?>" type="password" id="<?php echo $name_id; ?>" value="<?php echo $value;?>" class="qbt_syzsf" <?php echo $_field['attr']; ?>>
      	<?php
      	}elseif($_field['type']=='password_md5'){
      	?>
      	<input name="<?php echo $name_id; ?>" type="password" id="<?php echo $name_id; ?>" class="qbt_syzsf" <?php echo $_field['attr']; ?>>
      	<?php
		}elseif($_field['type']=='img'){
		?>
			<input name="<?php echo $name_id; ?>" type="text" id="<?php echo $name_id; ?>" value="<?php echo $value;?>" class="qbt_syzsf">
	        <input name="shang" type="button"  class="button button_huise" id="shang" onClick="open_upload('<?php echo $name_id; ?>','','')" value="上传"> <a href="javascript:;" target="_blank" onmouseover="if($('#<?php echo $name_id; ?>').val().length>0){ this.href='../../uploadfiles/'+$('#<?php echo $name_id; ?>').val(); }else{ this.href='javascript:;'; }">预览</a>
		<?php
		}elseif($_field['type']=='select'){
			create_input_select_box($name_id,$name_id,$iefb_option,$value);
		}elseif($_field['type']=='radio'){
		?>
			<?php
			foreach($iefb_option as $_key=>$_value){
				$sel = '';
				if($_key==$value) $sel=' checked="checked"';
			?>
				<input name="<?php echo $name_id; ?>" type="radio" id="<?php echo $name_id; ?>_<?php echo $_key;?>" value="<?php echo $_key;?>" <?php echo $sel; ?> <?php echo $_field['attr']; ?>  class="qbt_danxuan_anniu"><label for="<?php echo $name_id; ?>_<?php echo $_key;?>"><span class="danxuankang_tjk"><?php echo $_value; ?>&nbsp;</span></label>
			<?php
			}
			?>
		<?php
		}elseif($_field['type']=='checkbox'){
		?>
			<?php
			$values = parse_extend_checkbox_field_data($value);
			foreach($iefb_option as $_key=>$_value){
				$sel = '';
				if(in_array($_key,$values)) $sel=' checked="checked"';
			?>
				<input name="<?php echo $name_id; ?>[<?php echo $_key; ?>]" type="checkbox" id="<?php echo $name_id; ?>[<?php echo $_key; ?>]" value="<?php echo $_key;?>" <?php echo $sel; ?> <?php echo $_field['attr']; ?> class="qbt_danxuan_anniu"><label for="<?php echo $name_id; ?>[<?php echo $_key; ?>]"><span class="danxuankang_tjk"><?php echo $_value; ?>&nbsp;</span></label>
			<?php
			}
			?>
		<?php
		}elseif($_field['type']=='text'){
      	?>
      	<textarea name="<?php echo $name_id; ?>" rows="5" class="qbt_syzsff" id="<?php echo $name_id; ?>" <?php echo $_field['attr']; ?>><?php echo $value;?></textarea>
      	<?php
		}elseif($_field['type']=='rtext'){
      	?>
      	<script type="text/plain" id="<?php echo $name_id; ?>" name="<?php echo $name_id; ?>"><?php echo $value;?></script>
      	<script type="text/javascript">
		    UE.getEditor('<?php echo $name_id; ?>');
		</script>
      	<?php
		}
		if($_field['htxt']) echo $_field['htxt'];
		?>
      </td>
    </tr>
<?php
	//移除全局选项防止重复
	$GLOBALS['iefb_option']=array();
}


//创建可输入的下拉框
$GLOBALS['create_input_select_box_num'] = 10000;
function create_input_select_box($id,$name,$data,$def){
?>
<script type="text/javascript"> 
var inputID<?php echo $id; ?> = "input<?php echo $id; ?>"; 
var selectID<?php echo $id; ?> = "<?php echo $id; ?>"; 
var widt<?php echo $id; ?> = 0; 
var inputWi<?php echo $id; ?> = 0; 
var he<?php echo $id; ?> = 0; 
$(function() { 
    inputID<?php echo $id; ?> = "input<?php echo $id; ?>"; 
    selectID<?php echo $id; ?> = "<?php echo $id; ?>"; 
    widt<?php echo $id; ?> = 200; 
    inputWi<?php echo $id; ?> = widt<?php echo $id; ?> - 20; 
    he<?php echo $id; ?> = 160; 
    var offset<?php echo $id; ?> = $("input[id=input<?php echo $id; ?>]").offset(); 

    $("#" + selectID<?php echo $id; ?>).change(function() { 
        var newvar<?php echo $id; ?> = $("#" + selectID<?php echo $id; ?>).find("option:selected").text(); 
        $("#" + inputID<?php echo $id; ?>).val(newvar<?php echo $id; ?>.replace(/\&nbsp;/g,' ')); 
    })
    .click(function() { 
        $("#select_div_on_key" + selectID<?php echo $id; ?>).remove(); 
    })
    .css({ "display": "block", "width": widt<?php echo $id; ?> + "px", "z-index": <?php echo $GLOBALS['create_input_select_box_num']--; ?>, "clip": "rect(0px " + widt<?php echo $id; ?> + "px 51px 151px)" }); 
    
    $("#" + inputID<?php echo $id; ?>).keyup(function() { 
        ShowSelectCombo<?php echo $id; ?>(false); 
    })
    .click(function() { 
        ShowSelectCombo<?php echo $id; ?>(false); 
    })
    .css({ "z-index": 2, "width": inputWi<?php echo $id; ?> + "px"});

    $("#" + inputID<?php echo $id; ?>).blur(function(){
        setTimeout('$("#select_div_on_key" + selectID<?php echo $id; ?>).remove()',200);
    });
	<?php
	if($def!==''){
		foreach($data as $_key=>$_value){
			if($_key==$def){
	?>
    $("#" + inputID<?php echo $id; ?>).val('<?php echo str_replace(array("'",'&nbsp;'),array("\\'",' '),$_value); ?>');
    $('#'+selectID<?php echo $id; ?>).val('<?php echo str_replace(array("'",'&nbsp;'),array("\\'",' '),$_key); ?>');
	<?php
			}
		}
	}else{
	?>
    $("#" + inputID<?php echo $id; ?>).val($('option:first',"#" + selectID<?php echo $id; ?>).text());
    $('#'+selectID<?php echo $id; ?>).val($('option:first',"#" + selectID<?php echo $id; ?>).val());
	<?php

	}
	?>
}); 
function ShowSelectCombo<?php echo $id; ?>(c) {
    var pob = $("#" + inputID<?php echo $id; ?>); 
    var v = pob.val(); 
    var off = pob.offset(); 
    var wi = pob.width() + 26; 
    var tp = off.top + pob.height()+8; 
    var lef = off.left; 
    var tms=0;
    var html = "<div class='select_div_list' id='select_div_on_key" + selectID<?php echo $id; ?> + "' style='width:" + wi + "px;top:" + tp + "px;left:" + lef + "px;z-index:<?php echo $GLOBALS['create_input_select_box_num']--; ?>'><ul class='select_div_list_ul'>"; 
    $("#" + selectID<?php echo $id; ?>).find("option").each(function() { 
        var tk = $(this); 
        if(tk.text().indexOf(v)>-1){
            tms+=1;
            html += "<li val='" + tk.val() + "' ht='" + encodeURIComponent(tk.text()) + "'>" + tk.text().replace(v, "<span class='selectSPAN'>" + v + "</span>") + "</li>"; 
        }
    });
    html += "</ul></div>"; 
    if(v.length<1){
	    $("#" + inputID<?php echo $id; ?>).val($('option:first',"#" + selectID<?php echo $id; ?>).text());
	    $('#'+selectID<?php echo $id; ?>).val($('option:first',"#" + selectID<?php echo $id; ?>).val());
    }
    var ulDIV = $("#select_div_on_key" + selectID<?php echo $id; ?>); 
    ulDIV.remove(); 
    $("#user<?php echo $id; ?>").append(html); 
    var ulDIV = $("#select_div_on_key" + selectID<?php echo $id; ?>); 
    var hei = ulDIV.find("ul").height(); 
    var newHeight = hei > he<?php echo $id; ?> ? he<?php echo $id; ?> : hei; 
    ulDIV.css({ height: (tms>10?150:(tms*15))+"px" }); 
    ulDIV.find("li").hover(function() { 
        $(this).css({ "background-color": "#316ac5" }); 
    }, function() { 
        $(this).css({ "background-color": "white" }); 
    }); 
    ulDIV.find("li").click(function() { 
        var ki = $(this); 
        var va = ki.attr("val"); 
        var htm = ki.attr("ht"); 
        htm = decodeURIComponent(htm); 
        $("#" + inputID<?php echo $id; ?>).val(htm.replace(/\&nbsp;/g,' ')); 
        $("#" + selectID<?php echo $id; ?>).val(va); 
        ulDIV.remove(); 
    }); 
}
</script>
<div id='user<?php echo $id; ?>'> 
	<div style='overflow: hidden; margin-top: 10px; height: 30px;'> 
		<input id="input<?php echo $id; ?>" type="text" class='cssINPUT' style='height: 27px; 
		*height: 17px; display: block; position: absolute; border-right: 0px;' autocomplete="off" /> 
		<select name="<?php echo $name; ?>" id="<?php echo $id; ?>" class="cssINPUT qbt_buyao_bawo_mjj" style=" 
		display: none; height: 27PX; position: absolute; cursor: pointer; margin-left: 2px; 
		padding: 0px;"> 
			<?php
			foreach($data as $_key=>$_value){
				$sel = '';
				if($_key==$def) $sel=' selected="selected"';
				echo "<option value='{$_key}'{$sel}>{$_value}</option>";
			}
			?>
		</select> 
	</div> 
</div> 
<?php
}

//获得已开通权限列表
function get_all_action(){
	$qbt_admin_config = &$GLOBALS['qbt_admin_config'];
	$allqx = array();
	if($qbt_admin_config['qxmenu']){
		foreach($qbt_admin_config['qxmenu'] as $key=>$val){
			$allqx["{$key}"] = 0;
			if($val['sub']){
				foreach($val['sub'] as $key2=>$val2){
					$allqx["{$key}_{$key2}"] = 0;
					if($val2['cats']){
						foreach($val2['cats'] as $key3=>$val3){
							$allqx["{$key}_{$key2}_{$key3}"] = 0;
						}
					}
					if($val2['custom']){
						foreach($val2['custom'] as $key3=>$val3){
							$allqx["{$key}_{$key2}_{$val3}"] = 0;
						}
					}
				}
			}
		}
	}
	return $allqx;
}

//权限检测
function check_admin_action($action_name, $is_full=false){
	$a_user_id = &$GLOBALS['a_user_id'];
	if(!$a_user_id) return false;
	
	//是否完整权限名称，非完整自动补全
	if(!$is_full && $_GET['__action']){
		$action_name = $_GET['__action'].'_'.$action_name;
	}

	//过滤是否属于需要控制的权限
	$allqx = get_all_action();
	if(!isset($allqx[$action_name])) return true;

	$admininfo = mysql_fetch_assoc(mysql_query("SELECT * FROM `web_admin` WHERE `id`='{$a_user_id}'"));
	if(!$admininfo) return false;
	if($admininfo['role_id']==1) return true; //超级管理员不限制权限

	$roleinfo = mysql_fetch_assoc(mysql_query("SELECT * FROM `web_admin_role` WHERE `id`='{$admininfo['role_id']}'"));
	if(!$roleinfo['action']){
		$role_action = array();
	}else{
		$role_action = unserialize($roleinfo['action']);
	}

	$action = array_merge($allqx,$role_action);
	if($action[$action_name]){
		return true;
	}else{
		return false;
	}
}
