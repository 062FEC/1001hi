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
$hot1=trim(rp($_REQUEST['hot1']));
check_drop('c_bit',$hot1,'推荐信息','',$go_to_num,'','','','','','','','','','');
$sql='update '.$table_name2.' set hot1=\''.$hot1.'\' where id='.$id;
mysql_query($sql,$conn);
is_err($go_to_num,'');
show_msg_ok('',5,'');
?>