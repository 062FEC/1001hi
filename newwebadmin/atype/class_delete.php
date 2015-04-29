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

$old_conf_showmenu = file_get_contents(CC_SAVE_PATH.'conf_showmenu.ccset');

$id=trim(rp($_REQUEST['id']));
check_id($id,$go_to_num);
del_type($table_name1,$table_name2,$id);
is_err($go_to_num,'');

//整理自定义字段内容
include dirname(__FILE__).'/ccupdate.php';

$new_conf_showmenu = file_get_contents(CC_SAVE_PATH.'conf_showmenu.ccset');

if($old_conf_showmenu!=$new_conf_showmenu){
	echo '<script type="text/javascript">parent.leftFrame.location.reload();</script>';
}

show_msg_ok('',5,'');
?>