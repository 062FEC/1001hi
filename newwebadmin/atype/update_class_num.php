<?php include('../includes/php_conn.php'); ?>
<?php include('../includes/check.php'); ?>
<?php include('setup.php'); ?>
<?php

//属于独立表数据
if($_REQUEST['class_alone_table_name']){
  $table_name1 = $_REQUEST['class_alone_table_name'];
}
if($_REQUEST['info_alone_table_name']){
  $table_name2 = $_REQUEST['info_alone_table_name'];
}

$id=trim(rp($_REQUEST['id']));
check_id($id,$go_to_num);
$num=trim(rp($_REQUEST['num']));
check_drop('c_int',$num,'排列序号','',$go_to_num,'','','','','','','','','','');
$sql='update '.$table_name1.' set num='.$num.' where id='.$id;
mysql_query($sql,$conn);

//菜单更新处理
$old_conf_showmenu = file_get_contents(CC_SAVE_PATH.'conf_showmenu.ccset');
$conf_showmenu = unserialize($old_conf_showmenu);
unset($conf_showmenu[$new_id]);
if(!empty($conf_showmenu)){
	$query = mysql_query("SELECT * FROM `atype` WHERE `id` IN (".implode(',', $conf_showmenu).") ORDER BY `num` ASC");
	$conf_showmenu = array();
	while($_info = mysql_fetch_assoc($query)){
		$conf_showmenu[$_info['id']]=$_info['id'];
	}
}
$new_conf_showmenu = serialize($conf_showmenu);
file_put_contents(CC_SAVE_PATH.'conf_showmenu.ccset', $new_conf_showmenu);

if($old_conf_showmenu!=$new_conf_showmenu){
	echo '<script type="text/javascript">parent.leftFrame.location.reload();</script>';
}

is_err($go_to_num,'');
show_msg_ok('',5,'');
?>